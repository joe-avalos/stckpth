<?php


namespace App\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MainControllerTests extends WebTestCase
{

    public function testNewCounter(){
        $client = static::createClient();
        $client->request('GET', '/new');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertStringContainsStringIgnoringCase('New counter id:',
            $client->getResponse()->getContent(),
            sprintf('%s contains %s',
                $client->getResponse()->getContent(),
                'New counter id:'
                )
        );
    }

    /**
     * @dataProvider provideClicker
     * @param int $clicker
     */
    public function testClickIncrement($clicker = 0){
        $client = static::createClient();
        $crawler = $client->request('GET', '/');
        $prevCount = $crawler
            ->filter('p')
            ->eq($clicker)
            ->text();
        $link =  $crawler
            ->filter('a.js-increment')
            ->eq($clicker)
            ->link('POST');
        $click = $client->click($link);
        $crawler = $client->request('GET', '/');
        $currCount = $crawler
            ->filter('p')
            ->eq($clicker)
            ->text();
        $this->assertEquals($prevCount + 1,
            $currCount,
            sprintf('Assert %d + 1 equals %d', $prevCount, $currCount).PHP_EOL
            );
    }

    public function provideClicker(){
        $testArray = [];
        $client = static::createClient();
        $crawler = $client->request('GET', '/');
        $pCount = $crawler
            ->filter('p')
            ->count();
        for ($i = 0; $i < 100; $i++){
            array_push($testArray, [rand(0,$pCount)]);
        }
        return $testArray;
    }
}

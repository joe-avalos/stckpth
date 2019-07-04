<?php


namespace App\Controller;


use App\Entity\BBCounter;
use App\Repository\BBCounterRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MainController
 * @package App\Controller
 */
class MainController extends AbstractController
{
    /**
     * @Route("/", name="bb_homepage")
     * @return Response
     */
    public function index(BBCounterRepository $repository){

        $counter = $repository->findOneBy(['id'=>1]);

        return $this->render('homepage.html.twig', [
            'greeting'=>'Hello World!',
            'countId'=>$counter->getId(),
            'countNum'=>$counter->getCountNum()
        ]);
    }

    /**
     * @param EntityManagerInterface $em
     * @Route("/new")
     * @return Response
     */
    public function newCounter(EntityManagerInterface $em){
        $counter = new BBCounter();
        $em->persist($counter);
        $em->flush();
        return new Response(sprintf(
            'New counter id: #%d',
            $counter->getId()
        ));
    }

    /**
     * @Route("/api/increment/{id}", name="bb_api_increment", methods={"POST"})
     * @return JsonResponse
     */
    public function increment(BBCounter $counter, EntityManagerInterface $em){

        $counter->setCountNum($counter->getCountNum() + 1);
        $em->flush();
        return new JsonResponse(['count'=>$counter->getCountNum()]);
    }
}

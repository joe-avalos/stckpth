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
     * @param BBCounterRepository $repository
     * @return Response
     */
    public function index(BBCounterRepository $repository){

        $counters = $repository->findAll();

        return $this->render('homepage.html.twig', [
            'greeting'=>'Hello World!',
            'counters'=>$counters
        ]);
    }

    /**
     * @param EntityManagerInterface $em
     * @Route("/new", name="bb_new_counter")
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
     * @param BBCounter $counter
     * @param EntityManagerInterface $em
     * @return JsonResponse
     */
    public function increment(BBCounter $counter, EntityManagerInterface $em){

        $counter->setCountNum($counter->getCountNum() + 1);
        $em->flush();
        return new JsonResponse(['count'=>$counter->getCountNum(), 'id'=> $counter->getId()]);
    }
}

<?php


namespace App\Controller;


use App\Entity\Products;
use App\Repository\ProductsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

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
    public function index(ProductsRepository $repository){

        $products = $repository->findAll();

        return $this->render('homepage.html.twig', [
            'products'=>$products
        ]);
    }

    /**
     * @param EntityManagerInterface $em
     * @Route("/api/update/{id}", name="bb_api_update", methods={"POST"})
     * @return Response
     */
    public function updateProduct(Products $products, EntityManagerInterface $em, ProductsRepository $repository){
        $name = 'Product '.$products->getId() * rand(1,32);
        $products->setName($name);
        $em->flush();
        $encoder = [new JsonEncoder()];
        $normalizer = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizer,$encoder);
        $check = $serializer->serialize($products, 'json');
        $response = JsonResponse::fromJsonString($check);
        return $response;
    }

    /**
     * @Route("/api/delete/{id}", name="bb_api_delete", methods={"POST"})
     * @param EntityManagerInterface $em
     * @return JsonResponse
     */
    public function deleteProduct(Products $products, EntityManagerInterface $em){

        $products->setActive(false);
        $em->flush();
        return new JsonResponse(['id'=>$products->getId()]);
    }

    /**
     * @Route("/api/create", name="bb_api_create", methods={"POST"})
     * @param EntityManagerInterface $em
     * @return JsonResponse
     */
    public function createProduct(EntityManagerInterface $em){

        $product = new Products();
        $product->setName($_POST['name']);
        $product->setDescription($_POST['description']??'');
        $product->setPrice($_POST['price']);
        $product->setActive(true);
        $em->persist($product);
        $em->flush();
        $encoder = [new JsonEncoder()];
        $normalizer = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizer,$encoder);
        $check = $serializer->serialize($product, 'json');
        $response = JsonResponse::fromJsonString($check);
        return $response;
    }
}

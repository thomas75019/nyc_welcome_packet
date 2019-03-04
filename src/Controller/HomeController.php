<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use App\Repository\ArticleRepository;


class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home", methods={"GET"})
     */
    public function index(ArticleRepository $articleRepository) : Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'articles' => $articleRepository->findAll()
        ]);
    }
}

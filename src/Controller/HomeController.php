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

    /**
     * @Route("/read/{id}", name="read_article", methods={"GET"})
     */
    public function read(Article $article) : Response
    {
        return $this->render('article/show.html.twig', [
            'article' => $article,
        ]);
    }

    /**
     * @Route("/category/{name}", name="category", methods={"GET"})
     */
    public function category(ArticleRepository $article)
    {
    }
}

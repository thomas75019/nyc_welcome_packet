<?php

namespace App\Controller;

use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;



class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home", methods={"GET"})
     */
    public function index(ArticleRepository $articleRepository, CategoryRepository $categoryRepository) : Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'articles' => $articleRepository->findAll(),
            'categories' => $categoryRepository->findAll()

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
     * @Route("/view/{category_name}", name="category", methods={"GET"})
     *
     */
    public function category(ArticleRepository $articleRepository, $category_name) : Response
    {
        return $this->render('home/listByCategory.html.twig', [
            'articles' => $articleRepository->findArticlesByCategory($category_name)
        ]);
    }
}

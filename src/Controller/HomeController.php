<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use App\Form\NewsletterType;
use App\Entity\Newsletter;
use Symfony\Component\HttpFoundation\Request;



class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home", methods={"GET"})
     */
    public function index(ArticleRepository $articleRepository, CategoryRepository $categoryRepository, Request $request) : Response
    {

        $newsletter = new Newsletter();
        $form = $this->createForm(NewsletterType::class, $newsletter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();

            $em->persist($newsletter);
            $em->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'articles' => $articleRepository->findAll(),
            'categories' => $categoryRepository->findAll(),
            'form' => $form->createView(),


        ]);
    }

    /**
     * @Route("/read/{slug}", name="read_article", methods={"GET"})
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

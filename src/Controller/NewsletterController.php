<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Newsletter;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Form\NewsletterType;

Class NewsletterController extends AbstractController
{
    /**
     * @Route("/newsletter", name="newsletter_form", methods={"GET", "POST"})
     */
    public function newsletter(Request $request) : Response
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

    }
}
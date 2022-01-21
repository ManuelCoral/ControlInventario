<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class VueController extends AbstractController
{
    /**
     * @Route("/app/{route}", name="vue_utils")
     */
    public function index(Request $request, $route): Response
    {
        return $this->render('vue/index.html.twig', [
            'vueProject' => $route,
        ]);
    }
}
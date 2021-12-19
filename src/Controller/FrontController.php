<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/front")
 */
class FrontController extends AbstractController
{
    /**
     * @Route("/", name="front" , methods={"GET"})
     */
    public function index(HttpClientInterface $httpClient): Response
    {
        $response = $httpClient->request('GET', 'https://127.0.0.1:8080/api/compagnies');
        // $response = $httpClient->request(
        //     'POST',
        //     'https://127.0.0.1:8080/api/login_check',
        //     [
        //         'body' => ['username' => 'compagny4@test.com', 'name' => 'compagny4']
        //     ]
        // );

        // dd($response);
        dd($response->getContent());
        // dd($response->toArray());

        return $this->render('front/index.html.twig', [
            'controller_name' => 'FrontController',
            'repos' => $response->toArray()
        ]);
    }

    /**
     * @Route("/loginCheck", name="loginCheck", methods={"GET"})
     */
    public function loginCheck(HttpClientInterface $httpClient): Response
    {
        $response = $httpClient->request(
            'POST',
            'https://127.0.0.1:8080/api/login_check',
            [
                'body' => ['username' => 'compagny4@test.com', 'name' => 'compagny4']
            ]
        );

        // dd($response);
        dd($response->getContent());
        // dd($response->toArray());

        return $this->render('front/index.html.twig', [
            'controller_name' => 'FrontController',
            'repos' => $response->toArray()
        ]);
    }
}

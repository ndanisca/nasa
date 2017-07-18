<?php

namespace NasaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class DefaultController
 * @package NasaBundle\Controller
 */
class DefaultController extends Controller
{
    /**
     * @Route("/")
     * @return JsonResponse
     */
    public function indexAction()
    {
        return new JsonResponse(['hello' => 'world!'], 200, ['Content-Type' => 'application/json']);
    }
}

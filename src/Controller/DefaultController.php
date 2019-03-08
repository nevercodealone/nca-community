<?php

namespace App\Controller;

use App\Service\TwitterService;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="default")
     */
    public function index(TwitterService $twitter)
    {
        dump($twitter->getTweets());
        return $this->render('default/index.html.twig');
    }
}

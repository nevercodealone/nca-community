<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="default")
     */
    public function index()
    {
        $facebook = 'https//facebook.com/nevercodealone';
        $logo = '/nca/logo.png';
        return $this->render('default/index.html.twig', [
            'facebook' => $facebook,
            'logo' => $logo,
        ]);
    }
}

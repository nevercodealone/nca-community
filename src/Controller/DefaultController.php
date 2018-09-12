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
        $facebook = 'https://facebook.com/nevercodealone';
        $logo = '/nca/logo.png';
        return $this->render('default/index.html.twig', [
            'logo' => $logo,
            'facebook' => $facebook,
            'twitter' => 'https://twitter.com/nevercodealone',
            'youtube' => 'https://www.youtube.com/channel/UCjVT6iJ_wg7OM0DkV5TpNCQ',
            'instagram' => 'https://www.instagram.com/nevercodealone/',
            'phone' => '004917624747727',
            'email' => 'nevercodealone@gmail.com',
            'nevercodealone' => 'https://nevercodealone.de',
            'blog' => 'https://blog.nevercodealone.de'
        ]);
    }
}

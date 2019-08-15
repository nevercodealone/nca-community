<?php


namespace App\Controller;


use App\Entity\Job;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JobDetailController extends AbstractController
{
    /**
     * @Route("/jobs/{id}", name="job_detail", methods={"GET"}, requirements={"id":"\d+"})
     */
    public function detailAction(Job $job): Response
    {
        return $this->render('jobs_detail.html.twig', ['job' => $job]);
    }
}

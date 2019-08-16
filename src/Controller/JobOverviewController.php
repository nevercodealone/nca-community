<?php

namespace App\Controller;

use App\Repository\JobRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JobOverviewController extends AbstractController
{
    /**
     * @Route("/jobs", name="jobs_overview", methods={"GET"})
     */
    public function overviewAction(JobRepository $jobRepository): Response
    {
        return $this->render(
            'jobs/jobs_overview.html.twig',
            [
                'jobs' => $jobRepository->findAll()
            ]
        );
    }
}

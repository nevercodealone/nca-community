<?php


namespace App\Controller;


use App\Entity\Job;
use App\Form\JobType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JobController extends AbstractController
{
    /**
     * @Route("/jobs/create", name="jobs_create", methods={"GET", "POST"})
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function createAction(Request $request): Response
    {
        $form = $this->createForm(JobType::class, new Job($this->getUser()))->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            /** @var Job $job */
            $job = $form->getData();
            $entityManager->persist($job);
            $entityManager->flush();

            $this->addFlash('green', 'Job angelegt.');

            return $this->redirectToRoute('job_detail', ['id' => $job->getId()]);
        }

        return $this->render('jobs_form.html.twig', ['form' => $form->createView()]);
    }
}

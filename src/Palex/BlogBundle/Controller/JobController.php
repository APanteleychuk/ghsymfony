<?php

namespace Palex\BlogBundle\Controller;

use Palex\BlogBundle\Entity\Job;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


class JobController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $job = $this->getDoctrine()->getManager()->getRepository(
            'PalexBlogBundle:Job')->findAllJobs();
        if(!$job){
            throw $this->createNotFoundException(
                'Jobs not found, please add job!');
        }
        return $this->render('PalexBlogBundle:Blog:index.html.twig', [
            'posts'=>$job,
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addJobAction()
    {
        $em = $this->getDoctrine()->getManager();

        $job = new Job();
        $job->setName('Developer');
        $job->setDescription('blablablabla');
        $job->setCity('Kyiv');
        $job->setVacancy('Developer');
        $job->setRequirements('needneedneedneedneedneedneedneedneed');
        $job->setCompany('MMM');
        $em->persist($job);
        $em->flush();

        return new Response('Job '.$job->getName().' saved!');
    }

}


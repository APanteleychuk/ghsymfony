<?php

namespace Palex\BlogBundle\Controller;

use Palex\BlogBundle\Entity\Post;
use Palex\BlogBundle\Form\Type\PostType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class BlogController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $posts = $this->getDoctrine()->getManager()->getRepository('PalexBlogBundle:Post')->findAll();
        return $this->render('PalexBlogBundle:Blog:index.html.twig', [
            'posts'=>$posts,
        ]);
    }

    public function addPostAction(Request $request)
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $post = $form->getData();
            $file = $post->getImage();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            $file->move(
                $this->getParameter('post_image_directory'),
                $fileName
            );
            $post->setImage($fileName);

            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();
        }

        return $this->render('PalexBlogBundle:Blog:form.html.twig', [
            'form' => $form->createView(),
        ]);

    }
}


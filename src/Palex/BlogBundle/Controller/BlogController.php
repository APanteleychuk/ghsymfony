<?php

namespace Palex\BlogBundle\Controller;

use Palex\BlogBundle\Entity\Post;
use Palex\BlogBundle\Entity\Category;
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
        $posts = $this->getDoctrine()
            ->getManager()
            ->getRepository('PalexBlogBundle:Post')
            ->findAll();
        if(!$posts){
            throw $this->createNotFoundException('The posts does not exist!');
        }
        $categories = $this->getDoctrine()
            ->getManager()
            ->getRepository('PalexBlogBundle:Category')
            ->findAll();
        return $this->render('PalexBlogBundle:Blog:index.html.twig', [
            'posts'=>$posts,
            'categories'=>$categories,
        ]);
    }

    public function postAction($postId)
    {
        $comments = $this->getDoctrine()
            ->getManager()
            ->getRepository('PalexBlogBundle:Comment')->findComments($postId);

        $post = $this->getDoctrine()
            ->getManager()
            ->getRepository('PalexBlogBundle:Post')
            ->findOneBy(['id'=> $postId ]);
        if(!$post){
            throw $this->createNotFoundException('The post does not exist!');
        }
        return $this->render('PalexBlogBundle:Blog:view.html.twig', [
            'post'=>$post,
            'comments'=>$comments,
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

    public function showByCategoryAction($slug)
    {
        $categories = $this->getDoctrine()
            ->getManager()
            ->getRepository('PalexBlogBundle:Category')
            ->findAll();
        $category = $this->getDoctrine()
            ->getManager()
            ->getRepository('PalexBlogBundle:Category')
            ->findBy(
                ['slug' => $slug]
            );
        $posts = $this->getDoctrine()
            ->getManager()
            ->getRepository('PalexBlogBundle:Post')
            ->findBy(
                ['category' => $category]
            );

        return $this->render('PalexBlogBundle:Blog:index.html.twig', [
            'posts'=>$posts,
            'categories'=>$categories,
        ]);
    }
}


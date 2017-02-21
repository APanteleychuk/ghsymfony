<?php

namespace Palex\BlogBundle\Controller;

use Palex\BlogBundle\Entity\Comment;
use Palex\BlogBundle\Entity\Post;
use Palex\BlogBundle\Entity\Category;
use Palex\BlogBundle\Form\Type\PostType;
use Palex\BlogBundle\Form\Type\CommentType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class BlogController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $posts = $this->getDoctrine()
            ->getManager()
            ->getRepository('PalexBlogBundle:Post')
            ->findAllQuery();
        if(!$posts){
            throw $this->createNotFoundException('The posts does not exist!');
        }
        $categories = $this->getDoctrine()
            ->getManager()
            ->getRepository('PalexBlogBundle:Category')
            ->findAll();
        $paginator  = $this->get('knp_paginator');
        $pageRange = $this->getParameter('knp_paginator.page_range');
        $pagination = $paginator->paginate($posts, $request->query->getInt('page', 1), $pageRange);
        return $this->render('PalexBlogBundle:Blog:index.html.twig', [
            'posts'=>$pagination,
            'categories'=>$categories,
        ]);
    }

    /**
     * @ParamConverter("post", options={"mapping": {"slug": "slug"}})
     * @param Request $request
     * @param Post $post
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function postAction(Request $request,Post $post)
    {
        if(!$post){
            throw $this->createNotFoundException('The post does not exist!');
        }
        $comment = new Comment();
        $comment->setPost($post);
        $form = $this->createForm(CommentType::class, $comment, [
            'method' => 'POST',
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $comment = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();
            $this->addFlash('comment', 'Comment was successfully added!');
            return $this->redirect($request->getUri());
        }
        $categories = $this->getDoctrine()
            ->getManager()
            ->getRepository('PalexBlogBundle:Category')
            ->findAll();
        $postId = $post->getId();
        $comments = $this->getDoctrine()
            ->getManager()
            ->getRepository('PalexBlogBundle:Comment')->findComments($postId);

        return $this->render('PalexBlogBundle:Blog:view.html.twig', [
            'post'=>$post,
            'comments'=>$comments,
            'categories'=>$categories,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addPostAction(Request $request)
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $post = $form->getData();
            $file = $post->getImage();
            if($file){
                $fileName = md5(uniqid()).'.'.$file->guessExtension();
                $file->move(
                    $this->getParameter('post_image_directory'),
                    $fileName
                );
                $post->setImage($fileName);
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();
            $this->addFlash('notice', 'Post was successfully added!');
            return $this->redirect($request->getUri());
        }
        return $this->render('PalexBlogBundle:Blog:form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Category $category
     * @param $slug
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showByCategoryAction(Category $category, $slug)
    {
        $categories = $this->getDoctrine()
            ->getManager()
            ->getRepository('PalexBlogBundle:Category')
            ->findAll();
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


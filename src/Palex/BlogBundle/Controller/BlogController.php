<?php

namespace Palex\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class BlogController extends Controller
{
    public function indexAction()
    {
        $blogs = [1,2,3,4,5];
        return $this->render('PalexBlogBundle:Blog:index.html.twig', [
            'blogs'=>$blogs,
        ]);
    }

    public function postAction($postId)
    {
        $post = 'Test content'; //get post
        return $this->render('PalexBlogBundle:Blog:index.html.twig', [
            'postId'=>$postId,
            'post'=>$post,
        ]);
    }
}

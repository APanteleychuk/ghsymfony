<?php

namespace Palex\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class BlogController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $posts = [1,2,3,4,5];
        return $this->render('PalexBlogBundle:Blog:index.html.twig', [
            'posts'=>$posts,
        ]);
    }

    /**
     * @param $postId
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function postAction($postId)
    {
        $post = 'Test content';
        return $this->render('PalexBlogBundle:Blog:index.html.twig', [
            'postId'=>$postId,
            'post'=>$post,
        ]);
    }
}

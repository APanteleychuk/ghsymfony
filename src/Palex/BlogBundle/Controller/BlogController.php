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
        $post = 'Was King of England for two years, from 1483 until his death in 1485 in the Battle of Bosworth Field. He was the last king of the House of York and the last of the Plantagenet dynasty. His defeat at Bosworth Field, the decisive battle of the Wars of the Roses, is sometimes regarded as the end of the Middle Ages in England.';
        return $this->render('PalexBlogBundle:Blog:view.html.twig', [
            'postId'=>$postId,
            'post'=>$post,
        ]);
    }
}


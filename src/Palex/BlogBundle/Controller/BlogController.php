<?php

namespace Palex\BlogBundle\Controller;

use Palex\BlogBundle\Entity\Comment;
use Palex\BlogBundle\Entity\Post;
use Palex\BlogBundle\Entity\Category;
use Palex\BlogBundle\Form\Type\PostType;
use Palex\BlogBundle\Form\Type\CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\HttpFoundation\Response;



class BlogController extends Controller
{
    /**
     * @return Response
     */
    public function indexAction()
    {
        $posts = $this->getDoctrine()
            ->getManager()
            ->getRepository('PalexBlogBundle:Post')
            ->findAll();
        $categories = $this->getDoctrine()
            ->getManager()
            ->getRepository('PalexBlogBundle:Category')
            ->findAll();
        if(!$posts || !$categories){
            return new Response(
                '<html><body><h1>The posts or categories does not exist!</h1></body></html>');
        }
        return $this->render('PalexBlogBundle:Blog:index.html.twig', [
            'posts'=>$posts,
            'categories'=>$categories,
        ]);
    }

    /**
     * @param Request $request
     * @param $slug
     * @return Response
     */

    public function postAction(Request $request, $slug)
    {
        $comment = new Comment();
        $post = $this->getDoctrine()
            ->getManager()
            ->getRepository('PalexBlogBundle:Post')
            ->findOneBy(['slug'=> $slug ]);
        $comment->setPost($post);
        $form = $this->createForm(CommentType::class, $comment, [
            'method' => 'POST',
        ]);

        $form->handleRequest($request);
        $text = '';

        if ($form->isSubmitted() && $form->isValid()) {
            $comment = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();
            $text = 'Comment added!';
        }

        $categories = $this->getDoctrine()
            ->getManager()
            ->getRepository('PalexBlogBundle:Category')
            ->findAll();
        $postId = $post->getId();
        $comments = $this->getDoctrine()
            ->getManager()
            ->getRepository('PalexBlogBundle:Comment')->findComments($postId);


        if(!$post){
            throw $this->createNotFoundException('The post does not exist!');
        }
        return $this->render('PalexBlogBundle:Blog:view.html.twig', [
            'post'=>$post,
            'comments'=>$comments,
            'categories'=>$categories,
            'form' => $form->createView(),
            'text' => $text,
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     */

    public function addPostAction(Request $request)
    {
        $post = new Post();
        $fs = new Filesystem();
        $form = $this->createForm(PostType::class, $post);

        $form->handleRequest($request);
        $text = '';

        if ($form->isSubmitted() && $form->isValid()) {
            $post = $form->getData();
            $file = $post->getImage();
            if($file !== null){
                $fileName = md5(uniqid()).'.'.$file->guessExtension();
                if($fs->exists($this->getParameter('post_image_directory'))){
                    try {
                        $fs->mkdir('%kernel.root_dir%/../web/uploads/images'.mt_rand());
                    } catch (IOExceptionInterface $e) {
                        echo "An error occurred while creating your directory at ".$e->getPath();
                    }
                }
                $file->move(
                    $this->getParameter('post_image_directory'),
                    $fileName
                );
                $post->setImage($fileName);
            }


            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();
            $text = "Post added!";
        }

        return $this->render('PalexBlogBundle:Blog:form.html.twig', [
            'form' => $form->createView(),
            'text' => $text,
        ]);

    }

    /**
     * @param $slug
     * @return Response
     */

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


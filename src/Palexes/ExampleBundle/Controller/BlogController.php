<?php

namespace Palexes\ExampleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class BlogController extends Controller
{
    public function indexAction()
    {
        return $this->render('PalexesExampleBundle:Default:blog_list.html.twig');
    }

    public function postAction($id)
    {
        return new Response(
            '<html><body>This is content post#: '.$id.'</body></html>'
        );
    }

    public function aboutAction($action, $slug)
    {
        return new Response(
            '<html><body>This is action name: '.$action.'<br>This is slug name: '.$slug.'</body></html>'
        );
    }
}
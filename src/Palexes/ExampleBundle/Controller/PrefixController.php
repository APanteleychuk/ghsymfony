<?php

namespace Palexes\ExampleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class PrefixController extends Controller
{
    public function indexAction()
    {
        return new Response('Use PrefixController indexAction');
    }

    /**
     * @param $id string
     * @return Response     Return generate content
     */
    public function generateAction($id)
    {
        $url = $this->generateUrl('palexes_example_prefix_generate', array('id' => '2'));
        return new Response(
            "<a href=\"$url\">This is generate link with id - \"$id\", after click will use another controller</a>");
    }

    /**
     * @return Response     Return json response
     */
    public function jsonAction()
    {
        $response = new Response();
        $response->setContent(json_encode(array(
            'data' => 'Json Example'    ,
        )));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

}
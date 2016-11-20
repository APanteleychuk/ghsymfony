<?php

namespace Palexes\ExampleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('PalexesExampleBundle:Default:index.html.twig');
    }
}

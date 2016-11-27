<?php

namespace Palexes\ExampleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class PrefixController extends Controller
{
    public function indexAction()
    {
        return new Response('Use PrefixController indexAction');
    }

    public function testAction()
    {
        return new Response('Use PrefixController testAction');
    }
}
<?php

namespace Palex\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class AdminController extends Controller
{
    public function indexAction()
    {
        return $this->render('PalexBlogBundle:Admin:index.html.twig');
    }

}

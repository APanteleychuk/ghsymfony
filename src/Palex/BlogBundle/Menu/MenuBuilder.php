<?php

namespace Palex\BlogBundle\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Palex\BlogBundle\Entity\Category;
use Doctrine\ORM\EntityManager;


class MenuBuilder
{
    private $factory;
    private $em;
    private $current;
    /**
     * MenuBuilder constructor.
     * @param FactoryInterface $factory
     * @param EntityManager $em
     * @param bool $current
     */
    public function __construct(FactoryInterface $factory, EntityManager $em, $current = false)
    {
        $this->factory = $factory;
        $this->em = $em;
        $this->current = $current;
    }

    public function createMainMenu(array $options)
    {
        $categories = $this->em->getRepository('PalexBlogBundle:Category')->findAll();
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav navbar-nav');

        $menu->addChild('Home', ['uri' => '/']);

        $menu->addChild('Categories', [
            'route' => 'palex_blog_homepage',
            'attributes'=> [
                'class' => 'dropdown',
                ],
            'childrenAttributes'=> [
                'class' => 'dropdown-menu',
            ]
        ]);

        $menu->addChild('Add post', array('route' => 'palex_blog_post_add'));

        foreach ($categories as $category) {
            $menu['Categories']->addChild($category->getName(), [
                'route' => 'palex_blog_category_post',
                'routeParameters' => ['slug' => $category->getSlug()],
            ]);
        }

        return $menu;
    }

}
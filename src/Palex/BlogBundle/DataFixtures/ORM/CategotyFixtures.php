<?php

namespace Palex\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Palex\BlogBundle\Entity\Category;

class CategoryFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $category1 = new Category();
        $category1->setName('Category#1');
        $category1->setSlug('category1');
        $category1->setDescription('Description Category#1');
        $this->addReference('category1', $category1);
        $manager->persist($category1);

        $category2 = new Category();
        $category2->setName('Category#2');
        $category2->setSlug('category2');
        $category2->setDescription('Description Category#2');
        $this->addReference('category2', $category2);
        $manager->persist($category2);

        $manager->flush();
    }
    public function getOrder()
    {
        return 10;
    }
}
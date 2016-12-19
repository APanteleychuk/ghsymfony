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
        $category1->setName('CategoryName#1');
        $category1->setDescription('BlaBlaBla#1');
        $category1->setCity($this->getReference('city#1'));

        $category2 = new Category();
        $category2->setName('CategoryName#2');
        $category2->setDescription('BlaBlaBla#2');
        $category2->setCity($this->getReference('city#2'));


        $manager->persist($category1);
        $manager->persist($category2);
        $manager->flush();

        $this->addReference('category#1', $category1);
        $this->addReference('category#2', $category2);
    }

    public function getOrder()
    {
        return 10;
    }
}
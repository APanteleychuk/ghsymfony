<?php

namespace Palex\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Palex\BlogBundle\Entity\Tag;
use Palex\BlogBundle\Entity\Post;

class TagFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $tag1 = new Tag();
        $tag1->setTag('Tag1');
        $manager->persist($tag1);
        $tag2 = new Tag();
        $tag2->setTag('Tag2');
        $manager->persist($tag2);
        $tag3 = new Tag();
        $tag3->setTag('Tag3');
        $manager->persist($tag3);
        $tag4 = new Tag();
        $tag4->setTag('Tag4');
        $manager->persist($tag4);
        $this->getReference('post1')->addTag($tag1);
        $this->getReference('post1')->addTag($tag3);
        $this->getReference('post2')->addTag($tag2);
        $this->getReference('post2')->addTag($tag1);
        $this->getReference('post2')->addTag($tag4);
        $this->getReference('post3')->addTag($tag1);
        $this->getReference('post3')->addTag($tag4);
        $this->getReference('post4')->addTag($tag2);
        $this->getReference('post4')->addTag($tag3);
        $manager->flush();
    }
    public function getOrder()
    {
        return 40;
    }
}
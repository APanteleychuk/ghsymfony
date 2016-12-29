<?php

namespace Palex\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Palex\BlogBundle\Entity\Comment;
use Faker\Factory;

class CommentFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        $comment1 = new Comment();
        $comment1->setComment('Test comment! 1');
        $comment1->setPost($this->getReference('post1'));
        $comment1->setCreatedAt($faker->dateTime);
        $comment1->setUpdatedAt($faker->dateTime);
        $manager->persist($comment1);

        $comment2 = new Comment();
        $comment2->setComment('Test comment! 2');
        $comment2->setPost($this->getReference('post1'));
        $comment2->setCreatedAt($faker->dateTime);
        $comment2->setUpdatedAt($faker->dateTime);
        $manager->persist($comment2);

        $comment3 = new Comment();
        $comment3->setComment('Test comment! 3');
        $comment3->setPost($this->getReference('post2'));
        $comment3->setCreatedAt($faker->dateTime);
        $comment3->setUpdatedAt($faker->dateTime);
        $manager->persist($comment3);

        $comment4 = new Comment();
        $comment4->setComment('Test comment! 4');
        $comment4->setPost($this->getReference('post3'));
        $comment4->setCreatedAt($faker->dateTime);
        $comment4->setUpdatedAt($faker->dateTime);
        $manager->persist($comment4);

        $comment5 = new Comment();
        $comment5->setComment('Test comment! 5');
        $comment5->setPost($this->getReference('post4'));
        $comment5->setCreatedAt($faker->dateTime);
        $comment5->setUpdatedAt($faker->dateTime);
        $manager->persist($comment5);

        $manager->flush();
    }
    public function getOrder()
    {
        return 30;
    }
}
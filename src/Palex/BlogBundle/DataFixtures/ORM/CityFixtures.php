<?php

namespace Palex\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Palex\BlogBundle\Entity\City;

class CityFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $city1 = new City();
        $city1->setName('City#1');

        $city2 = new City();
        $city2->setName('City#2');

        $city3 = new City();
        $city3->setName('City#3');

        $manager->persist($city2);
        $manager->persist($city2);
        $manager->persist($city3);
        $manager->flush();

        $this->addReference('city#1', $city1);
        $this->addReference('city#2', $city2);
        $this->addReference('city#3', $city3);
    }

    public function getOrder()
    {
        return 10;
    }

}
<?php

namespace Palex\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Palex\BlogBundle\Entity\Job;

class JobFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $job1 = new Job();
        $job1->setName('Job name #1');
        $job1->setCategory($this->getReference('category#1'));
        $job1->setDescription('Job Description #1');
        $job1->setCity('Job City #1');
        $job1->setCompany('Job Company #1');
        $job1->setRequirements('Job Requirements #1');
        $job1->setVacancy('Job Vacancy #1');

        $job2 = new Job();
        $job2->setName('Job name #2');
        $job2->setCategory($this->getReference('category#2'));
        $job2->setDescription('Job Description #2');
        $job2->setCity('Job City #2');
        $job2->setCompany('Job Company #2');
        $job2->setRequirements('Job Requirements #2');
        $job2->setVacancy('Job Vacancy #2');

        $manager->persist($job1);
        $manager->persist($job2);
        $manager->flush();

        $this->addReference('job#1', $job1);
        $this->addReference('job#2', $job2);
    }

    public function getOrder()
    {
        return 20;
    }
}
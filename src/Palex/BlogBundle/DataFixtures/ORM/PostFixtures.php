<?php

namespace Palex\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Palex\BlogBundle\Entity\Post;

class PostFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $post1 = new Post();
        $post1->setCategory($this->getReference('category1'));
        $post1->setTitle('A Lower East Side Gallery is Completely Falling Apart — Or Is It?');
        $post1->setContent('The latest installations by Serra Victoria Bothwell Fels are like frozen tableaux of not-quite-natural events. A rounded, wooden structure erupts through the floor; seed-like clusters pop out of enlarged pores in the wall; and plaster is dripping from a crack in the ceiling, pulled down by gravity. Time seems to have stopped midway through the process, and we\'re left wondering how much energy is still bubbling beneath the surface? Will this burgeoning growth in the floor eventually climb so high as to puncture the ceiling? Will the wrinkles in the wall keep spreading? The pending transformation feels inevitable, so we wait—wait to see what will be generated, and what will be destroyed.');
        $post1->setImage('images/ee2ac3f4eae968a122a844bca8f41d85.jpg');
        $post1->setAuthor('Anonymous');
        $this->addReference('post1',$post1);
        $manager->persist($post1);

        $post2 = new Post();
        $post2->setCategory($this->getReference('category1'));
        $post2->setTitle('Meet the Death Photographers of India’s Holiest City');
        $post2->setContent('When photographer Matteo de Mayda traveled to India to photograph the country’s best inventors, the project collapsed at the very last moment. Desperate for a subject, he stumbled upon a local video report on the photographers in the holy city of Varanasi. An hour later he booked a 30-hour third class train ride to the city, where he eventually came across a death photographer who worked along the Ganges River by the name of Indra Kumar Jha. De Mayda, a photographer and art director who focuses on good causes through collaborations with NGOs or by making documentaries, knew he’d found his photographic story. The initial idea was to photograph Jha at work at the “burning ghats” (funeral pyres) of Varanasi. But when de Mayda saw prints on Jha’s shop wall, he quickly realized that the most interesting part of the work were his images.');
        $post2->setImage('images/558efb1292b427428fdd4dda74f41cff.jpg');
        $post2->setAuthor('Anonymous');
        $this->addReference('post2',$post2);
        $manager->persist($post2);

        $post3 = new Post();
        $post3->setCategory($this->getReference('category2'));
        $post3->setTitle('4 Experiential Artists Who Brightened Up 2016 | The Wrap-Up');
        $post3->setContent('The winter solstice is behind us, the days are getting longer, and the calendar year is coming to an end, which can only mean one thing: It’s time to check back with some of the experiential artists we hailed as up-and-comers last winter, and see what they’ve been up to the last few months. Liz West has been painting rainbows all over England. NONOTAK Studio spent their year on the road, playing with light, mirrors and motion. Moment Factory is melding the real and the virtual, sprinkling their magic outdoors. And Jeremy Couillard is figuring out how to make computers weird again. Catch up with them all, below.');
        $post3->setImage('images/4d7a79a68ad53fb958124a57826af96a.jpg');
        $post3->setAuthor('Anonymous');
        $this->addReference('post3',$post3);
        $manager->persist($post3);

        $post4 = new Post();
        $post4->setCategory($this->getReference('category2'));
        $post4->setTitle('You Have to Geocache Central Park to Find This Art');
        $post4->setContent('It started when an artist got tired of paying two high rents. Brad Troemel was switching between Airbnb-ing his apartment to pay for his studio, and renting out his studio to pay for his apartment, sleeping in one or the other. As an artist, sculptor, teacher and web entrepreneur in New York City, he needed both: a place to live, and a place to store his work. In his search to make it all cheaper, he posed a question: What if he could store it somewhere for free until the time of purchase? In the tree trunks and cliffs of Central Park, Troemel found his solution.');
        $post4->setImage('images/36117a04529459639a841d67a64cee73.jpg');
        $post4->setAuthor('Anonymous');
        $this->addReference('post4',$post4);
        $manager->persist($post4);

        $manager->flush();
    }
    public function getOrder()
    {
        return 20;
    }
}
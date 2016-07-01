<?php

namespace AppBundle\DataFixtures\ORM\Fixtures;

use AppBundle\Entity\Tags;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;


class TagData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $samples = [
            ['A la Une','homepage'],
            ['Politique' ,'politics'],
            ['Economie', 'economy'],
            ['International', 'international'],
        ];

        foreach ($samples as $sample)
        {
            list($name, $international) = $sample;

            $tag = new Tags();
            $tag->setName($name);
            $manager->persist($tag);
        }
        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }

}
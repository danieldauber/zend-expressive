<?php

namespace CodeEmailMKT\Infrastructure\Persistence\Doctrine\DataFixture;

use CodeEmailMKT\Domain\Entity\Campaign;
use CodeEmailMKT\Domain\Entity\Customer;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory as Faker;

class CampaignFixture extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {

        $faker = Faker::create();
        $template = "<p>{$faker->paragraph(2)}</p><p><a href='#'>Link</a></p>";

        foreach (range(1, 20) as $key => $value) {
            $campaign = new Campaign();
            $campaign
                ->setName($faker->country)
                ->setSubject($faker->sentence(3))
                ->setTemplate($template);

            $manager->persist($campaign);
            $this->addReference("campaign-$key", $campaign);
        }
        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 100;
    }
}

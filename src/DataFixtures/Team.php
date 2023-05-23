<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class Team extends Fixture
{
    protected $faker;
    public function load(ObjectManager $manager): void
    {
        $this->faker = Factory::create();
        $team = new \App\Entity\Team();
        $team->setName($this->faker->name);
        $team->setIsActive($this->faker->boolean([0,1]));
        $manager->persist($team);
        $manager->flush();
    }
}

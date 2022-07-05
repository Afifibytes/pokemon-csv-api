<?php

namespace App\DataFixtures;

use App\Entity\Pokemon;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PokemonFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++){
            $pokemon = new Pokemon();
            $pokemon->setId($faker->unique()->randomDigit());
            $pokemon->setName($faker->name);
            $pokemon->setType1($faker->name);
            $pokemon->setType2($faker->name);
            $pokemon->setTotal($faker->randomNumber());
            $pokemon->setHP($faker->randomNumber());
            $pokemon->setAttack($faker->randomNumber());
            $pokemon->setDefense($faker->randomNumber());
            $pokemon->setSpAtk($faker->randomNumber());
            $pokemon->setSpDef($faker->randomNumber());
            $pokemon->setSpeed($faker->randomNumber());
            $pokemon->setGeneration($faker->randomNumber());
            $pokemon->setLegendary($faker->boolean());

            $manager->persist($pokemon);
        }

        $manager->flush();
    }
}

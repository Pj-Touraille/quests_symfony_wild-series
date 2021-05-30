<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    const SEASON = [
        [
            'description' => 'Première saison',
            'number' => '1',
            'year' => '2011',
            'program' => 'Black mirror'],
        [
            'description' => 'Deuxième saison',
            'number' => '2',
            'year' => '2013',
            'program' => 'Black mirror'],
        [
            'description' => 'Troisième saison',
            'number' => '3',
            'year' => '2016',
            'program' => 'Black mirror']
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::SEASON as $seasons) {
            $season = new Season();
            $season->setProgram($this->getReference($seasons['program']));
            $season->setNumber($seasons['number']);
            $season->setYear($seasons['year']);
            $season->setDescription($seasons['description']);
            $manager->persist($season);
            $this->addReference($seasons['number'], $season);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ProgramFixtures::class,
        ];
    }
}

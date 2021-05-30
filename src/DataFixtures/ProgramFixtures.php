<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    const PROGRAM = [
        [
            'title' => 'Black mirror',
            'summary' => "Les épisodes sont liés par le thème commun de la mise en œuvre d'une technologie dystopique.",
            'poster' => "black-mirror.png",
            'category' => 'Fantastique'],
        [
            'title' => 'La ligue des justiciers',
            'summary' => "Les plus grands super-héros du monde, menés par Superman, Batman, Green Lantern, Wonder Woman, Martian Manhunter, Flash et Hawkgirl collaborent avec le soutien de leurs amis pour lutter plus efficacement contre la criminalité grandissante et les nouvelles menaces d'invasions extra-terrestres.",
            'poster' => "justice-league.png",
            'category' => 'Animation']
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::PROGRAM as $key => $programs) {
            $program = new Program();
            $program->setTitle($programs['title']);
            $program->setSummary($programs['summary']);
            $program->setPoster($programs['poster']);
            $program->setCategory($this->getReference($programs['category']));
            $manager->persist($program);
            $this->addReference($programs['title'], $program);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
        ];
    }
}
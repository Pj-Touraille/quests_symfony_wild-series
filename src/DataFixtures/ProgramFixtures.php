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
            'summary' => "Les épisodes sont liés par le thème commun de la mise en œuvre d'une technologie dystopique. Le titre « Black Mirror » fait référence aux écrans omniprésents qui nous renvoient notre reflet. Sous un angle noir et souvent satirique, la série envisage un futur proche, voire immédiat. Elle interroge les conséquences inattendues que pourraient avoir les nouvelles technologies, et comment ces dernières influent sur la nature humaine de ses utilisateurs et inversement",
            'poster' => "black-mirror.png",
            'category' => 'Fantastique'],
        [
            'title' => 'La ligue des justiciers',
            'summary' => "Les plus grands super-héros du monde, menés par Superman, Batman, Green Lantern, Wonder Woman, Martian Manhunter, Flash et Hawkgirl collaborent avec le soutien de leurs amis pour lutter plus efficacement contre la criminalité grandissante et les nouvelles menaces d'invasions extra-terrestres. Gardiens de la justice, ils sont le dernier rempart pour déjouer les conspirations les plus machiavéliques.",
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

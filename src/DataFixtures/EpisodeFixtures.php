<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use App\Service\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    const EPISODE = [
        [
            'number' => "1",
            'title' => "L'hymne national",
            'synopsis' => "Après l'enlèvement de la princesse royale, le Premier ministre britannique incarné par Rory Kinnear, est confronté à un énorme et choquant dilemme. L'épisode examine non seulement la question du libre-arbitre dans un environnement politique où la notion de popularité est aisément biaisée et peut être manipulée, mais aussi l'interaction entre les différents acteurs des domaines politiques et médiatiques ainsi que du public devant une situation de crise.",
            'season' => '1'],
        [
            'number' => "2",
            'title' => "Quinze millions de mérites",
            'synopsis' => "L'épisode est une satire sur les spectacles de divertissement et notre insatiable soif de distraction projetée dans un univers de science-fiction.",
            'season' => '1'],
        [
            'number' => "3",
            'title' => "Retour sur image",
            'synopsis' => "Dans un futur proche, une partie de la société a accès à une technologie qui permet d'enregistrer tout ce qu'un individu peut voir et entendre grâce à une puce située derrière l'oreille. À l'aide d'une petite télécommande, l'individu en question peut ensuite revisionner ses souvenirs autant de fois qu'il le désire, directement sur ses yeux ou bien en les projetant sur un écran. Dans ce dernier cas, l'expérience devient collective et toutes les personnes présentes peuvent voir les souvenirs de l'individu qui choisit ou est contraint de les projeter.",
            'season' => '1'],
        [
            'number' => "1",
            'title' => "Bientôt de retour",
            'synopsis' => "Ash et Martha s'installent à la campagne, dans la maison où Ash a passé son enfance. Hélas, le lendemain, le jeune homme se tue sur la route. Aux funérailles, Martha apprend l'existence d'un service qui se sert de l'historique Internet des défunts pour simuler des conversations entre morts et vivants. Le soir même, la jeune femme reçoit un message électronique d'Ash... Martha s'habitue alors à vivre avec cette personnalité virtuelle animée par les nombreuses traces numériques qu'Ash a laissées sa vie durant.",
            'season' => '2'],
        [
            'number' => "2",
            'title' => "La Chasse",
            'synopsis' => "Une jeune femme presque totalement amnésique se réveille dans une chambre lugubre. Pour comprendre ce qui l'a menée là, elle explore d'abord la maison où elle se trouve, puis finit par sortir. Elle découvre un quartier froid et désolé : les habitants qu'elle aperçoit l'épient à l'aide de leurs smartphones, ignorent ses appels à l'aide, et s'enfuient quand elle se rapproche d'eux ; soudain un homme cagoulé descend d'une voiture, prend un fusil de chasse et commence à tirer sur elle...",
            'season' => '2'],
        [
            'number' => "3",
            'title' => "Le Show de Waldo",
            'synopsis' => "Jamie Salter est un comédien de seconde zone qui prête sa voix à Waldo, un ours bleu en images de synthèse. Après l'entrevue corsée d'un politicien du Parti conservateur qui pensait participer à une émission pour enfants, Waldo acquiert une popularité surprenante. De plus en plus impliqué dans la vie politique, Waldo en vient à se présenter aux élections locales ; mais Jamie ne se satisfait pas du succès de son personnage.",
            'season' => '2'],
        [
            'number' => "4",
            'title' => "Blanc comme neige",
            'synopsis' => "Sous la forme de trois histoires centrées sur le personnage interprété par Jon Hamm, l'épisode - poursuivant la tradition de la série - met en scène un futur imminent où la technologie remet en question notre humanité",
            'season' => '2'],
        [
            'number' => "1",
            'title' => "Chute libre",
            'synopsis' => "Dans une société régie par la cote personnelle, Lacie veut tout faire pour obtenir l'appartement de ses rêves. Quand son amie d'enfance au statut irréprochable lui demande d'être sa demoiselle d'honneur, Lacie voit l'opportunité d'améliorer sa note et réaliser ses rêves.",
            'season' => '3'],
        [
            'number' => "2",
            'title' => "Phase d'essai",
            'synopsis' => "Pour financer la fin de son tour du monde, un jeune homme en quête d'aventure accepte de tester un système de jeu vidéo en réalité augmentée directement relié à son cerveau. Il va vivre une expérience plus intense que prévu.",
            'season' => '3'],
        [
            'number' => "3",
            'title' => "Tais-toi et danse",
            'synopsis' => "Plusieurs personnes se font pirater et sous la menace de voir leurs vies ruinées par la mise en ligne d'informations compromettantes les concernant, se retrouvent à suivre les instructions absurdes et risquées des pirates.",
            'season' => '3']
    ];

    private Slugify $slugify;

    public function __construct(Slugify $slugify)
    {
        $this->slugify = $slugify;
    }

    public function load(ObjectManager $manager)
    {
        foreach (self::EPISODE as $episodes) {
            $episode = new Episode();
            $episode->setSeason($this->getReference($episodes['season']));
            $episode->setNumber($episodes['number']);
            $episode->setTitle($episodes['title']);
            $episode->setSynopsis($episodes['synopsis']);
            $episode->setSlug($this->slugify->generate($episodes['title']));
            $manager->persist($episode);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            SeasonFixtures::class,
        ];
    }
}

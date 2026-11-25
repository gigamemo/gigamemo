<?php

namespace App\DataFixtures;

use App\Entity\Deck;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        // 1 First root deck + one branch
        $symfonyDeck = (new Deck())
            ->setName('Symfony & Architecture')
            ->setPosition(0);

        $stimulusDeck = (new Deck())
            ->setName('Stimulus & Gestionnaire d\'arbre')
            ->setPosition(0);
        $symfonyDeck->addDeckChild($stimulusDeck);

        $subLevels = ['Événements & cibles', 'Déplacement & tri', 'Persistance asynchrone'];
        foreach ($subLevels as $index => $label) {
            $leafDeck = (new Deck())
                ->setName($label)
                ->setPosition($index);
            $stimulusDeck->addDeckChild($leafDeck);
            $manager->persist($leafDeck);
        }

        // 2. Second root deck with deck children manage by Faker
        $frenchDeck = (new Deck())
            ->setName('Vocabulaire & Grammaire')
            ->setPosition(1);

        for ($i = 0; $i < 4; $i++) {
            $title = mb_substr(ucfirst($faker->words(3, true)), 0, 70);

            $childDeck = (new Deck())
                ->setName($title)
                ->setPosition($i);

            $frenchDeck->addDeckChild($childDeck);
            $manager->persist($childDeck);
        }

        // 3. Third root deck without child.
        $miscDeck = (new Deck())
            ->setName('Notes & Expérimentations')
            ->setPosition(2);

        $manager->persist($symfonyDeck);
        $manager->persist($stimulusDeck);
        $manager->persist($frenchDeck);
        $manager->persist($miscDeck);

        $manager->flush();
    }
}

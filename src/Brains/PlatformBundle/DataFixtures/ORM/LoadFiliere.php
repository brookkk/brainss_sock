<?php

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Brains\PlatformBundle\Entity\Filiere;

class LoadFiliere implements FixtureInterface
{
  // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
  public function load(ObjectManager $manager)
  {
    // Liste des noms de catégorie à ajouter
    $names = array(
      'Sciences Math',
      'Siences Physiques'
      
    );

    foreach ($names as $name) {
      // On crée la catégorie
      $filiere = new Filiere();
      $nn=array();
      $nn=explode(" ", $name);
      $filiere->setNome($name);
      $filiere->setShort($nn[0]);

      // On la persiste
      $manager->persist($filiere);
    }

    // On déclenche l'enregistrement de toutes les catégories
    $manager->flush();
  }
}



?>
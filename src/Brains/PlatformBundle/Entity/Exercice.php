<?php

namespace Brains\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Exercice
 *
 * @ORM\Table(name="exercice")
 * @ORM\Entity(repositoryClass="Brains\PlatformBundle\Repository\ExerciceRepository")
 */
class Exercice
{

/**
   * @ORM\ManyToOne(targetEntity="Brains\PlatformBundle\Entity\Annee")
   * @ORM\JoinColumn(nullable=false)
   */
  
    private $annee;


 /**
   * @ORM\ManyToOne(targetEntity="Brains\PlatformBundle\Entity\Filiere")
   * @ORM\JoinColumn(nullable=false)
   */
  
    private $filiere;



    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="public", type="string", length=255)
     */
    private $public;

 



   

    /**
     * @var string
     *
     * @ORM\Column(name="auteur", type="string", length=255)
     */
    private $auteur;

  

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_creation", type="datetimetz")
     */
    private $date_creation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_maj", type="datetimetz")
     */
    private $dateMaj;


//Date par défaut lors de la creation d'un new Exo
public function __construct()
  {
    $this->date_creation = new \Datetime();
    $this->dateMaj = new \Datetime();
  }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Exercice
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set public
     *
     * @param string $public
     *
     * @return Exercice
     */
    public function setPublic($public)
    {
        $this->public = $public;

        return $this;
    }

    /**
     * Get public
     *
     * @return string
     */
    public function getPublic()
    {
        return $this->public;
    }

    /**
     * Set annee
     *
     * @param string $annee
     *
     * @return Exercice
     */
    public function setAnnee(Annee $annee)
    {
        $this->annee = $annee;

        return $this;
    }

    /**
     * Get annee
     *
     * @return string
     */
    public function getAnnee()
    {
        return $this->annee;
    }

    /**
     * Set filiere
     *
     * @param string $filiere
     *
     * @return Exercice
     */
    public function setFiliere(Filiere $filiere)
    {
        $this->filiere = $filiere;

        return $this;
    }

    /**
     * Get filiere
     *
     * @return string
     */
    public function getFiliere()
    {
        return $this->filiere;
    }

    /**
     * Set auteur
     *
     * @param string $auteur
     *
     * @return Exercice
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * Get auteur
     *
     * @return string
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

     
    
    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     *
     * @return Exercice
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set dateMaj
     *
     * @param \DateTime $dateMaj
     *
     * @return Exercice
     */
    public function setDateMaj($dateMaj)
    {
        $this->dateMaj = $dateMaj;

        return $this;
    }

    /**
     * Get dateMaj
     *
     * @return \DateTime
     */
    public function getDateMaj()
    {
        return $this->dateMaj;
    }
}


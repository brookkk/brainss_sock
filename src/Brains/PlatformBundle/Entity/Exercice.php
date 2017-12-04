<?php

namespace Brains\PlatformBundle\Entity;
use Brains\PlatformBundle\Entity\Annee;
use Brains\PlatformBundle\Entity\Exo_Partie;



use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Exercice
 *
 * @ORM\Table(name="exercice")
 * @ORM\Entity(repositoryClass="Brains\PlatformBundle\Repository\ExerciceRepository")
 */
class Exercice
{






 /**
   * @ORM\ManyToOne(targetEntity="Brains\PlatformBundle\Entity\Filiere" ,fetch="LAZY")
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
    * 
   * @ORM\OneToMany(targetEntity="Brains\PlatformBundle\Entity\Exo_Partie", mappedBy="exercice")
   * 
   */

private $exo_parties;





 public function addExo_Partie(Exo_Partie $exo_partie)
  {
    $this->exo_parties[] = $exo_partie;
  }

  public function removeExo_Partie(Exo_Partie $exo_partie)
  {
    $this->exo_parties->removeElement($exo_partie);
  }


    public function getExo_Parties()
    {
        return $this->exo_parties;
    }






    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;





  

    /**
     * @var string
     *
     * @ORM\Column(name="public", type="boolean")
     */
    private $public;

    /**
     * @var string
     *
     * @ORM\Column(name="auteur", type="string", length=255)
     */
    private $auteur;


    /**
     * @var string
     *
     * @ORM\Column(name="rating", type="decimal", precision=3)
    ** @Assert\Range(
     *      min = 1,
     *      max = 5,
     *      minMessage = "Le rating ne doit pas être inférieur à 1",
     *      maxMessage = "Le rating ne doit pas être supérieur à 5",
     * )
     */
    private $rating;

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


 





      /**
     * @var \int
     ** @Assert\Range(
     *      min = 1,
     *      minMessage = "Le temps ne doit pas être inférieur à 1 minute",
     * )
     ** @ORM\Column(name="temps", type="integer")
          */
    private $temps;





     /**
     * @var \int
     ** @ORM\Column(name="nbViews", type="integer")
          */
    private $nbViews;


       /**
     * @var \int
     ** @ORM\Column(name="nbSolves", type="integer")
          */
    private $nbSolves;





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
     * Set nbViews
     *
     * @param string $nbViews
     *
     * @return NbViews
     */
    public function setNbViews($nbViews)
    {
        $this->nbViews = $nbViews;

        return $this;
    }

     

    /**
     * Get nbViews
     *
     * @return int
     */
    public function getNbViews()
    {
        return $this->nbViews;
    }




      /**
     * Set nbSolves
     *
     * @param string $nbSolves
     *
     * @return NbViews
     */
    public function setNbSolves($nbSolves)
    {
        $this->nbSolves = $nbSolves;

        return $this;
    }

     

    /**
     * Get nbSolves
     *
     * @return int
     */
    public function getNbSolves()
    {
        return $this->nbSolves;
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
     * Set rating
     *
     * @param string $rating
     *
     * @return Rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

     

    /**
     * Get rating
     *
     * @return string
     */
    public function getRating()
    {
        return $this->rating;
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


 

 



 



 
 




    /**
     * Set temps
     *
     * @param string $temps
     *
     * @return Exercice
     */
    public function setTemps($temps)
    {
        $this->temps = $temps;

        return $this;
    }

    /**
     * Get temps
     *
     * @return string
     */
    public function getTemps()
    {
        return $this->temps;
    }




 






}


<?php

namespace Brains\PlatformBundle\Entity;
use Brains\PlatformBundle\Entity\Annee;


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
   * @ORM\ManyToOne(targetEntity="Brains\PlatformBundle\Entity\Annee", inversedBy="exercices")
   * @ORM\JoinColumn(nullable=false)
   */

private $annee;




 /**
   * @ORM\ManyToOne(targetEntity="Brains\PlatformBundle\Entity\Filiere")
   * @ORM\JoinColumn(nullable=false)
   */

 private $filiere;



/**
* @Assert\IsTrue(message="Il faut choisir la bonne année/filière")
*/
public function is_good_annee_filiere(){
    if($this->filiere->getAnnee()->getShort() == $this->annee->getShort())
        return true;
    else return false;    
}

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
     * @ORM\Column(name="link", type="string", length=255)
     */
    private $link;


     /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="text", length=255)
     */
    private $contenu;

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
     * Set contenu
     *
     * @param string $contenu
     *
     * @return Exercice
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
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

      public function setLink($link)
    {
        $this->link = $link;

        return $link;
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

     public function getLink()
    {
        return $this->link;
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


 

 




     /**
     * Set bareme
     *
     * @param string $bareme
     *
     * @return Exercice
     */
    public function setBareme($bareme)
    {
        $this->bareme = $bareme;

        return $this;
    }

    /**
     * Get bareme
     *
     * @return string
     */
    public function getBareme()
    {
        return $this->bareme;
    }




      /**
     * Set nb_questions
     *
     * @param string $nb_questions
     *
     * @return Exercice
     */
    public function setNbQuestions($nb_questions)
    {
        $this->nb_questions = $nb_questions;

        return $this;
    }

    /**
     * Get nb_questions
     *
     * @return string
     */
    public function getNbQuestions()
    {
        return $this->nb_questions;
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





    /**
     * Set bonus
     *
     * @param string $bonus
     *
     * @return Exercice
     */
    public function setBonus($bonus)
    {
        $this->bonus = $bonus;

        return $this;
    }

    /**
     * Get bareme
     *
     * @return string
     */
    public function getBonus()
    {
        return $this->bonus;
    }







}


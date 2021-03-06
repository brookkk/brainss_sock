<?php

namespace Brains\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Cours
 *
 * @ORM\Table(name="cours")
 * @ORM\Entity(repositoryClass="Brains\PlatformBundle\Repository\CoursRepository")
 */
class Cours
{
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
     * @ORM\Column(name="nom", type="string", length=255, unique=true)
     */
    private $nom;



    /**
     * @var string
     *
     * @ORM\Column(name="public", type="boolean")
     */
    private $public;

   

    /**
   * @ORM\ManyToOne(targetEntity="Brains\PlatformBundle\Entity\Filiere")
   * @ORM\JoinColumn(nullable=false)
   */
    private $filiere;






/**
    * 
   * @ORM\OneToMany(targetEntity="Brains\PlatformBundle\Entity\Cours_Partie", mappedBy="cours")
   * 
   */

private $cours_parties;





 public function addCours_Partie(Cours_Partie $cours_parties)
  {
    $this->cours_parties[] = $cours_parties;
  }

  public function removeCours_Partie(Cours_Partie $cours_parties)
  {
    $this->cours_parties->removeElement($cours_parties);
  }


    public function getCours_Partie()
    {
        return $this->cours_parties;
    }





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
    private $dateCreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_maj", type="datetimetz")
     */
    private $dateMaj;



//Date par défaut lors de la creation d'un new cours
    public function __construct()
    {
        $this->dateCreation = new \Datetime();
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
     * @return Cours
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
     * @return Cours
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
     * @return Cours
     */
    public function setFiliere($filiere)
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
     * @return Cours
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
     * @return Cours
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
     * @return Cours
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


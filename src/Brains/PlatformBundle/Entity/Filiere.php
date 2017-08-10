<?php

namespace Brains\PlatformBundle\Entity;
use Brains\PlatformBundle\Entity\Exercice;
use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

/**
 * Filiere
 *
 * @ORM\Table(name="filiere")
 * @ORM\Entity(repositoryClass="Brains\PlatformBundle\Repository\FiliereRepository")
 */
class Filiere
{


 /**
   * @ORM\ManyToMany(targetEntity="Brains\PlatformBundle\Entity\Cours", cascade={"persist"})
   */
  private $cours;

 /**
   * @ORM\ManyToMany(targetEntity="Brains\PlatformBundle\Entity\Exercice", cascade={"persist"})
   */
  private $exercices;


 public function addExercices(Exercice $exercice)
  {
    $this->exercices[] = $exercice;
  }

  public function removeExercices(Exercice $exercice)
  {
    $this->exercices->removeElement($exercice);
  }



  /**
   * @ORM\ManyToOne(targetEntity="Brains\PlatformBundle\Entity\Annee")
   * @ORM\JoinColumn(nullable=false)
   */
  
    private $annee;

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
     * @ORM\Column(name="short", type="string", length=255, unique=false)
     */
    private $short;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=255)
     */
    private $nome;



 public function __construct()
  {
     $this->cours = new ArrayCollection();
     $this->exercices = new ArrayCollection();

  }


public function addCours(Cours $cours)
{
    $this->cours[] = $cours;
}

public function addExercice(Exercice $exercice)
{
    $this->exercices[] = $exercice;
}

public function removeCours(Cours $cours)
{
    $this->cours->removeElement($cours);
}

public function removeExercice(Exercice $exercice)
{
    $this->exercices->removeElement($exercice);
}

public function getExercices()
{
    return $this->exercices;
}

public function getCours()
{
    return $this->cours;
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
     * Set short
     *
     * @param string $short
     *
     * @return Filiere
     */
    public function setShort($short)
    {
        $this->short = $short;

        return $this;
    }

      public function setAnnee($annee)
    {
        $this->annee = $annee;

        return $this;
    }
 public function getAnnee()
    {
        return $this->annee;
    }


    /**
     * Get short
     *
     * @return string
     */
    public function getShort()
    {
        return $this->short;
    }

    /**
     * Set nome
     *
     * @param string $nome
     *
     * @return Filiere
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }







}


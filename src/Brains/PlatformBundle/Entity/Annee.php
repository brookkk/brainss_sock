<?php

namespace Brains\PlatformBundle\Entity;
use Brains\PlatformBundle\Entity\Exercice;
use Brains\PlatformBundle\Entity\Filiere;
use Doctrine\Common\Collections\ArrayCollection;


use Doctrine\ORM\Mapping as ORM;

/**
 * Annee
 *
 * @ORM\Table(name="annee")
 * @ORM\Entity(repositoryClass="Brains\PlatformBundle\Repository\AnneeRepository")
 */
class Annee
{



    /**
    * 
   * @ORM\OneToMany(targetEntity="Brains\PlatformBundle\Entity\Exercice", mappedBy="annee" , fetch="LAZY")
   * 
   */

private $exercices;

 
  public function __construct()
  {
    $this->exercices = new ArrayCollection();
    $this->filieres = new ArrayCollection();
    // ...
  }

 public function addExercices(Exercice $exercice)
  {
    $this->exercices[] = $exercice;
  }

  public function removeExercices(Exercice $exercice)
  {
    $this->exercices->removeElement($exercice);
  }


    public function getExercices()
    {
        return $this->exercices;
    }


/**
    * 
   * @ORM\OneToMany(targetEntity="Brains\PlatformBundle\Entity\Filiere", mappedBy="annee")
   * 
   */

private $filieres;


 public function addFiliere(Filiere $filiere)
  {
    $this->filieres[] = $filiere;
  }

  public function removeFiliere(Filiere $filiere)
  {
    $this->filieres->removeElement($filiere);
  }


    public function getFilieres()
    {
        return $this->filieres;
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
     * @ORM\Column(name="short", type="string", length=255, unique=true)
     */
    private $short;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=255)
     */
    private $nome;


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
     * @return Annee
     */
    public function setShort($short)
    {
        $this->short = $short;

        return $this;
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
     * @return Annee
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


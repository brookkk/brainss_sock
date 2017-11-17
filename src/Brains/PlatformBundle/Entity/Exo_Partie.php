<?php

namespace Brains\PlatformBundle\Entity;
use Brains\PlatformBundle\Entity\Exo_Question;


use Doctrine\ORM\Mapping as ORM;

/**
 * Exo_Partie
 *
 * @ORM\Table(name="exo__partie")
 * @ORM\Entity(repositoryClass="Brains\PlatformBundle\Repository\Exo_PartieRepository")
 */
class Exo_Partie
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
   * @ORM\ManyToOne(targetEntity="Brains\PlatformBundle\Entity\Exercice")
   * @ORM\JoinColumn(nullable=false)
   */

 private $exercice;










/**
    * 
   * @ORM\OneToMany(targetEntity="Brains\PlatformBundle\Entity\Exo_Question", mappedBy="partie")
   * 
   */

private $exo_questions;





 public function addExo_Question(Exo_Question $exo_question)
  {
    $this->exo_questions[] = $exo_question;
  }

  public function removeExo_Question(Exo_Question $exo_question)
  {
    $this->exo_questions->removeElement($exo_question);
  }


    public function getExo_Questions()
    {
        return $this->exo_questions;
    }



    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="text")
     */
    private $contenu;


    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string")
     */
    private $titre;


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
     * @return Exo_Partie
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
     * Set titre
     *
     * @param string $titre
     *
     * @return Exo_Partie
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }


   /**
     * Set exercice
     *
     * @param string $exercice
     *
     * @return Exo_partie
     */
    public function setExercice(Exercice $exercice)
    {
        $this->exercice = $exercice;

        return $this;
    }

    /**
     * Get exercice
     *
     * @return string
     */
    public function getExercice()
    {
        return $this->exercice;
    }


}


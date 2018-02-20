<?php

namespace Brains\PlatformBundle\Entity;
use Brains\PlatformBundle\Entity\Exo_Question;


use Doctrine\ORM\Mapping as ORM;

/**
 * Cours_Partie
 *
 * @ORM\Table(name="cours__partie")
 * @ORM\Entity(repositoryClass="Brains\PlatformBundle\Repository\Cours_PartieRepository")
 */
class Cours_Partie
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
   * @ORM\ManyToOne(targetEntity="Brains\PlatformBundle\Entity\Cours")
   * @ORM\JoinColumn(nullable=false)
   */

 private $cours;










/**
    * 
   * @ORM\OneToMany(targetEntity="Brains\PlatformBundle\Entity\Exo_Question", mappedBy="partie")
   * 
   */

private $exo_questions;




/*
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
*/


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
     * Set cours
     *
     * @param string $cours
     *
     * @return Cours_partie
     */
    public function setCours(Cours $cours)
    {
        $this->cours = $cours;

        return $this;
    }

    /**
     * Get cours
     *
     * @return string
     */
    public function getCours()
    {
        return $this->cours;
    }


}


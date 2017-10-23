<?php

namespace Brains\PlatformBundle\Entity;

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
     * @var string
     *
     * @ORM\Column(name="contenu", type="text")
     */
    private $contenu;


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


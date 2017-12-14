<?php

namespace Brains\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * exo_views
 *
 * @ORM\Table(name="exo_views")
 * @ORM\Entity(repositoryClass="Brains\PlatformBundle\Repository\exo_viewsRepository")
 */
class exo_views
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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }




      /**
     * Set exercice
     *
     * @param string $exercice
     *
     * @return exo_views
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


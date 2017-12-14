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
     * @var int
   * @ORM\Column(name="exercice", type="integer")
   */

 private $exercice;




  /**
     * @var int
   * @ORM\Column(name="user", type="integer")
   */

 private $user;



  /**
     * @var int
   * @ORM\Column(name="nb_views", type="integer", nullable=true)
   */

 private $nb_views;


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
     * @param int $exercice
     *
     * @return exo_views
     */
    public function setExercice($exercice)
    {
        $this->exercice = $exercice;

        return $this;
    }

    /**
     * Get exercice
     *
     * @return int
     */
    public function getExercice()
    {
        return $this->exercice;
    }


      /**
     * Set nb_views
     *
     * @param int $nb_views
     *
     * @return exo_views
     */
    public function setNbViews($nb_views)
    {
        $this->nb_views = $nb_views;

        return $this;
    }

    /**
     * Get nb_views
     *
     * @return int
     */
    public function getNbViews()
    {
        return $this->nb_views;
    }



        /**
     * Set user
     *
     * @param int $user
     *
     * @return exo_views
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }


}


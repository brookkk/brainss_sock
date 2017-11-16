<?php

namespace Brains\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Security\Core\User\UserInterface;

use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 *
 * @ORM\Table(name="fos_user")
 * @ORM\Entity(repositoryClass="Brains\UserBundle\Repository\UserRepository")
 */

class User extends BaseUser
{
  /**
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  protected $id;


  /**
     * @var string
     *
     * @ORM\Column(name="annee", type="string", length=500, nullable=true)
     */
    private $annee;

      /**
     * @var string
     *
     * @ORM\Column(name="filiere", type="string", length=500, nullable=true)
     */
    private $filiere;

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
     * Set year
     *
     * @param string $annee
     *
     * @return Book
     */
    public function setAnnee($annee)
    {
        $this->annee = $annee;

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
     * Set filiere
     *
     * @param string $annee
     *
     * @return Book
     */
    public function setFiliere($filiere)
    {
        $this->filiere = $filiere;

        return $this;
    }


}


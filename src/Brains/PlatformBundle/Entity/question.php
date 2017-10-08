<?php

namespace Brains\PlatformBundle\Entity;
//use Brains\PlatformBundle\Entity\Exercice;
//use Brains\PlatformBundle\Entity\Filiere;


use Doctrine\ORM\Mapping as ORM;

/**
 * question
 *
 * @ORM\Table(name="question")
 * @ORM\Entity(repositoryClass="Brains\PlatformBundle\Repository\questionRepository")
 */
class question
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
   * @ORM\JoinColumn
   */

 private $exercice;


    /**
     * @var string
     *
     * @ORM\Column(name="question", type="string", length=255)
     */
    private $question;

    /**
     * @var string
     *
     * @ORM\Column(name="reponse", type="string", length=255)
     */
    private $reponse;


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
     * Set question
     *
     * @param string $question
     *
     * @return question
     */
    public function setQuestion($question)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return string
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set reponse
     *
     * @param string $reponse
     *
     * @return question
     */
    public function setReponse($reponse)
    {
        $this->reponse = $reponse;

        return $this;
    }

    /**
     * Get reponse
     *
     * @return string
     */
    public function getReponse()
    {
        return $this->reponse;
    }


     /**
     * Set exercice
     *
     * @param string $exercice
     *
     * @return Question
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


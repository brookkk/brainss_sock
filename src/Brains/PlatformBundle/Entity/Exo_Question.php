<?php

namespace Brains\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Exo_Question
 *
 * @ORM\Table(name="exo__question")
 * @ORM\Entity(repositoryClass="Brains\PlatformBundle\Repository\Exo_QuestionRepository")
 */
class Exo_Question
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
     * @var int
     *
     * @ORM\Column(name="bareme", type="integer")
     */
    private $bareme;

    /**
     * @var int
     *
     * @ORM\Column(name="valeur", type="integer")
     */
    private $valeur;

    /**
     * @var string
     *
     * @ORM\Column(name="indice", type="string", length=255)
     */
    private $indice;

    /**
     * @var string
     *
     * @ORM\Column(name="choix1", type="string", length=255)
     */
    private $choix1;

    /**
     * @var string
     *
     * @ORM\Column(name="choix2", type="string", length=255)
     */
    private $choix2;

    /**
     * @var string
     *
     * @ORM\Column(name="choix3", type="string", length=255)
     */
    private $choix3;

    /**
     * @var string
     *
     * @ORM\Column(name="choix4", type="string", length=255)
     */
    private $choix4;


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
     * @return Exo_Question
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
     * @return Exo_Question
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
     * Set bareme
     *
     * @param integer $bareme
     *
     * @return Exo_Question
     */
    public function setBareme($bareme)
    {
        $this->bareme = $bareme;

        return $this;
    }

    /**
     * Get bareme
     *
     * @return int
     */
    public function getBareme()
    {
        return $this->bareme;
    }

    /**
     * Set valeur
     *
     * @param integer $valeur
     *
     * @return Exo_Question
     */
    public function setValeur($valeur)
    {
        $this->valeur = $valeur;

        return $this;
    }

    /**
     * Get valeur
     *
     * @return int
     */
    public function getValeur()
    {
        return $this->valeur;
    }

    /**
     * Set indice
     *
     * @param string $indice
     *
     * @return Exo_Question
     */
    public function setIndice($indice)
    {
        $this->indice = $indice;

        return $this;
    }

    /**
     * Get indice
     *
     * @return string
     */
    public function getIndice()
    {
        return $this->indice;
    }

    /**
     * Set choix1
     *
     * @param string $choix1
     *
     * @return Exo_Question
     */
    public function setChoix1($choix1)
    {
        $this->choix1 = $choix1;

        return $this;
    }

    /**
     * Get choix1
     *
     * @return string
     */
    public function getChoix1()
    {
        return $this->choix1;
    }

    /**
     * Set choix2
     *
     * @param string $choix2
     *
     * @return Exo_Question
     */
    public function setChoix2($choix2)
    {
        $this->choix2 = $choix2;

        return $this;
    }

    /**
     * Get choix2
     *
     * @return string
     */
    public function getChoix2()
    {
        return $this->choix2;
    }

    /**
     * Set choix3
     *
     * @param string $choix3
     *
     * @return Exo_Question
     */
    public function setChoix3($choix3)
    {
        $this->choix3 = $choix3;

        return $this;
    }

    /**
     * Get choix3
     *
     * @return string
     */
    public function getChoix3()
    {
        return $this->choix3;
    }

    /**
     * Set choix4
     *
     * @param string $choix4
     *
     * @return Exo_Question
     */
    public function setChoix4($choix4)
    {
        $this->choix4 = $choix4;

        return $this;
    }

    /**
     * Get choix4
     *
     * @return string
     */
    public function getChoix4()
    {
        return $this->choix4;
    }
}


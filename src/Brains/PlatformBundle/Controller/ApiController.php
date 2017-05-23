<?php

namespace Brains\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\View;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\Annotations as Rest;

use Brains\PlatformBundle\Entity\Annee;
use Brains\PlatformBundle\Entity\Filiere;
use Brains\PlatformBundle\Entity\Exercice;
use Brains\PlatformBundle\Entity\Cours;



class ApiController extends Controller
{
  public function indexAction()
  {
    return $this->render('BrainsPlatformBundle:Default:index.html.twig');
  }



    /**
     * @Rest\Get(
     *     path = "/exercices/{id}",
     *     name = "exercice_show",
     *     requirements = {"id"="\d+"}
     * )
     * @Rest\View
     */

    public function exerciceShowAction(Exercice $exercice)
    {
      return $exercice;
    }


 /**
     * @Rest\Get("/exercices", name="exercices_list")
     * @Rest\View()
     */
    public function exercicesListAction()
    {
        $articles = $this->getDoctrine()->getRepository('BrainsPlatformBundle:Exercice')->findAll();
        
        return $articles;
    }














}



?>

<?php

namespace Brains\PlatformBundle\Controller;

use Symfony\Component\HttpFoundation\Response;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\View;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\Annotations as Rest;

use Brains\PlatformBundle\Entity\Annee;
use Brains\PlatformBundle\Entity\Filiere;
use Brains\PlatformBundle\Entity\Exercice;
use Brains\PlatformBundle\Entity\Exo_Partie;
use Brains\PlatformBundle\Entity\Cours;
use Brains\UserBundle\Entity\User;




class ApiController extends Controller
{
  public function indexAction()
  {
    return $this->render('BrainsPlatformBundle:Default:index.html.twig');
  }





     /**
     * @Rest\Get(
     *     path = "/cours/{id}",
     *     name = "cours_show",
     *     requirements = {"id"="\d+"}
     * )
     * @Rest\View
     */

    public function coursShowAction(Cours $cours)
    {
      return $cours;
    }


 /**
     * @Rest\Get("/cours", name="cours_list")
     * @Rest\View()
     */
    public function coursListAction()
    {
        $cours = $this->getDoctrine()->getRepository('BrainsPlatformBundle:Cours')->findAll();
        
        return $cours;
    }





    /**
     * @Rest\Get("/annees", name="annees_list")
     * @Rest\View()
     */
    public function anneesListAction()
    {
        $annees = $this->getDoctrine()->getRepository('BrainsPlatformBundle:Annee')->findAll();

        return $annees;
    }


    /**
     * @Rest\Get(
     *     path = "/annees/{id}",
     *     name = "annee_show",
     *     requirements = {"id"="\d+"}
     * )
     * @Rest\View
     */

    public function anneeShowAction(Annee $annee)
    {
        return $annee;
    }



      /**
     * @Rest\Get("/filieres", name="filieres_list")
     * @Rest\View()
     */
    public function filieresListAction()
    {
        $filieres = $this->getDoctrine()->getRepository('BrainsPlatformBundle:Filiere')->findAll();

        return $filieres;
    }


    /**
     * @Rest\Get(
     *     path = "/filieres/{id}",
     *     name = "filiere_show",
     *     requirements = {"id"="\d+"}
     * )
     * @Rest\View
     */

    public function filiereShowAction(Filiere $filiere)
    {
        return $filiere;
    }




 



    /**
     * @Rest\Post("/exercices")
     * @Rest\View
     * @ParamConverter("exercice", converter="fos_rest.request_body")
     */
    public function createAction(Exercice $exercice)
    {
        dump($article); die;
    }






          /**
     * @Rest\Get("/exercices", name="exercices_list")
     * @Rest\View()
     */
    public function exercicesListAction()
    {
        $exercices = $this->getDoctrine()->getRepository('BrainsPlatformBundle:Exercice')->findAll();

        return $exercices;
    }


    /**
     * @Rest\Get(
     *     path = "/exercices/{id}/parties",
     *     name = "parties_show",
     *     requirements = {"id"="\d+"}
     * )
     * @Rest\View
     */

    public function partiesShowAction( $id)
    {

     $parties = $this->getDoctrine()->getRepository('BrainsPlatformBundle:Exercice')->find($id)->getExo_Parties();

        
      return $parties;
    }


 



       /**
     * @Rest\Get("/users", name="users_list")
     * @Rest\View()
     */
    public function usersListAction()
    {
        $users = $this->getDoctrine()->getRepository('BrainsUserBundle:User')->findAll();

        return $users;
    }
 

}



?>

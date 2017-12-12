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

use FOS\UserBundle\Model;
use FOS\UserBundle\Entity\UserManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;




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
     * @Rest\Put("/exercices/{id}/view")
     * @Rest\View
     */
    public function exoViewsAction($id)
    {
    $exercice = $this->getDoctrine()->getRepository('BrainsPlatformBundle:Exercice')->find($id);
    $exercice->setNbViews($exercice->getNbViews() +1 );
     $em= $this->getDoctrine()->getManager();
      $em->persist($exercice);
      $em->flush();

        return "new nb_views : " .$exercice->getNbViews();

    }



     /**
     * @Rest\Put("/exercices/{id}/solve")
     * @Rest\View
     */
    public function exoSolvesAction($id)
    {
    $exercice = $this->getDoctrine()->getRepository('BrainsPlatformBundle:Exercice')->find($id);
    $exercice->setNbSolves($exercice->getNbSolves() +1 );
     $em= $this->getDoctrine()->getManager();
      $em->persist($exercice);
      $em->flush();

        return "new nb_solves : " .$exercice->getNbSolves();

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




      /**
     * @Rest\Post("/authenticate")
     * @Rest\View(StatusCode = 201)
     *@ParamConverter("user", converter="fos_rest.request_body")
     */
    public function authenticateAction(User $user)
    {


        //Méthode qui vérifie que l'utilisateur a les bons idntifiants
        //en input : $user de type User ayant un "username" et "password"
        //en output : si "good credentials" : un 'token' === l'heure actuelle transformée en un entier ( => unique)
        // + l'objet "user" trouvé au niveau de la BD
        // sinon "user non trouvé" ou "mdp erroné"
 
        $factory = $this->get('security.encoder_factory');

        // pour vérifier si le user existe au niveau de la BD
        $found = false;

        // pour vérifier si le psw est correct pour le user
        $good_psw=false;

        // on vérifie l'existance d'un user avec l'identifiant "username"
        $bd_user = $this->get('fos_user.user_manager')->findUserByUsername($user->getUsername());

        if($bd_user)
        {
            //on a trouvé un user avec l'idntifiant "username"
            $found = true;
            //on va encoder le psw de user (de l'input) et vérifier les deux psw encodés
            $encoder = $factory->getEncoder($bd_user);
            $pass=$user->getPassword();
            $good_psw = $encoder->isPasswordValid($bd_user->getPassword(),$pass,$bd_user->getSalt());

        }

 
        //on crée le token à partir de DateTime()
        $date = new \DateTime();
        $token = $date->format('YmdHis');
 
        if(!$found)
            return "user non trouvé";
        else if(!$good_psw)
            return "mdp erroné;";
        else{
            $bd_user->setLastLogin($date);
             //l'objet retour est le "token" + "user trouvé"
        $retour = array('token'=> $token, 'user'=> array('username'=>$bd_user->getUsername(), 'email' => $bd_user->getEmail(),
        'annee' => $bd_user->getAnnee(), 'filiere' => $bd_user->getFiliere() ));
            return $retour;}
 
    }
 

}



?>

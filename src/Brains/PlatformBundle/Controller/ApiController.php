<?php

namespace Brains\PlatformBundle\Controller;

use Symfony\Component\HttpFoundation\Response;


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
use Brains\PlatformBundle\Entity\Question;
use Brains\PlatformBundle\Form\questionType;




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
        $exercices = $this->getDoctrine()->getRepository('BrainsPlatformBundle:Exercice')->findAll();
        
        return $exercices;
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
    public function fiflieresListAction()
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
     * @Rest\Post(
     *    path = "/question",
     *    name = "question_ajouter"
     * )
     * @Rest\View(StatusCode = 201)
     * @ParamConverter("question", converter="fos_rest.request_body")
     */
    public function createQuestionAction(Question $question)
    {
        $em = $this->getDoctrine()->getManager();

        $em->persist($question);
        $em->flush();

        return $question;
    }



  /**
     * @Rest\Post(
     *    path = "/testApi"
     * )
     * @Rest\View(StatusCode = 201)
     */
    public function testApiAction()
    {





        $data = $this->get('jms_serializer')->deserialize($request->getContent(), 'array', 'json');
 /*       $question = new Question();

        $form = $this->get('form.factory')->create(QuestionType::class, $question);
        $form->submit($data);

        $em = $this->getDoctrine()->getManager();

        $em->persist($question);
        $em->flush();*/

       return new Response('{
"question": "Le titre de ma deuxieme question ",
    "reponse": "La réponse 2."
}');
    }


}



?>

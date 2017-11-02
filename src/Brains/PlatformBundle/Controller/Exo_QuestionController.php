<?php

namespace Brains\PlatformBundle\Controller;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


use Brains\PlatformBundle\Form\ExerciceType;
use Brains\PlatformBundle\Form\Exo_QuestionType;

 
use Brains\PlatformBundle\Entity\Exo_Partie;
use Brains\PlatformBundle\Entity\Exo_Question;
use Brains\PlatformBundle\Entity\Exercice;
 
 


class Exo_QuestionController extends Controller
{
  public function indexAction()
  {
    return $this->render('BrainsPlatformBundle:Default:index.html.twig');
  }

  public function n_exo_questionAction(Request $request, $id)
  {
//nouvelle instance de l'entité question
    $question= new Exo_Question();


$repository = $this  ->getDoctrine()  ->getManager()  ->getRepository('BrainsPlatformBundle:Exo_Partie');

  $partie = $repository->find($id);


   $form = $this->createForm(Exo_QuestionType::class, $question);




//si le formulaire est bien rempli, on l'enregistre dans la BD
    if($request->isMethod('POST')){

      $form->handleRequest($request);

 



       if($form->isValid()  )  
        { 
          $question->setPartie($partie);

         $em= $this->getDoctrine()->getManager();
      $em->persist($question);
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'Question Bien enregistrée.');
 

          return $this->redirectToRoute('BP_show_exo_question', array('id'=>$question->getPartie()->getId()));
    }
  }

//sinon (ou bien premier landing sur le form), on affiche le formulaire
  return $this->render('BrainsPlatformBundle:New:exo_question.html.twig', array(
   'form'=>$form->createView(), 'partie_id'=>$id
   ));

}



 public function show_exo_questionAction(Request $request, $id=1)
{
  $em= $this  ->getDoctrine()  ->getManager();

  $repository = $em  ->getRepository('BrainsPlatformBundle:Exo_Question');


    $listQuestions = $repository->findBy([
      'partie' => $id ,
    ]);

  if (null === $listQuestions) {
    throw new NotFoundHttpException("Aucune partie na été trouvé");
  }

  return $this->render('BrainsPlatformBundle:Show:exo_question.html.twig', array(
    'listQuestions' => $listQuestions , 'partie_id'=>$id ) );
}




public function update_exo_questionAction(Request $request, $id)
{

  $repository = $this  ->getDoctrine()  ->getManager()  ->getRepository('BrainsPlatformBundle:Exo_Question');

  $question = $repository->find($id);

    
 
  if (null === $question) {
    throw new NotFoundHttpException("Votre question na pas été trouvé");
  }


  $form = $this->createForm(Exo_QuestionType::class, $question);



  if($request->isMethod('POST')){

    $form->handleRequest($request);

    if($form->isValid()){
      $em= $this->getDoctrine()->getManager();
      $em->persist($question);
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'question Bien enregistrée.');

  
 
 
     // return $this->redirectToRoute('BP_show_all_exo_partie');
          return $this->redirectToRoute('BP_show_exo_question', array('id'=>$question->getPartie()->getId()));

    }

  }

  return $this->render('BrainsPlatformBundle:New:exo_question.html.twig', array(
   'form'=>$form->createView(), 'partie_id' =>$question->getPartie()->getId(),
   ));


}



public function delete_exo_questionAction(Request $request, $id)
{
  $em= $this->getDoctrine()->getManager();

  $repository = $em  ->getRepository('BrainsPlatformBundle:Exo_Question');

  $question = $repository->find($id);

  if (null === $question) {
    throw new NotFoundHttpException("Votre question na pas été trouvée");
  }


  $em->remove($question);
  $em->flush();

  $request->getSession()->getFlashBag()->add('notice', 'question a été supprimée');

 
 

  //return $this->redirectToRoute('BP_show_all_exo_partie');
  return $this->redirectToRoute('BP_show_exo_question', array('id'=>$question->getPartie()->getId()));



}



}



?>

<?php

namespace Brains\PlatformBundle\Controller;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


use Brains\PlatformBundle\Form\CoursType;
use Brains\PlatformBundle\Form\Cours_QuestionType;

 
use Brains\PlatformBundle\Entity\Cours_Partie;
use Brains\PlatformBundle\Entity\Cours_Question;
use Brains\PlatformBundle\Entity\Cours;
 
 


class Cours_QuestionController extends Controller
{
  public function indexAction()
  {
    return $this->render('BrainsPlatformBundle:Default:index.html.twig');
  }

  public function n_cours_questionAction(Request $request, $id)
  {
//nouvelle instance de l'entité question
    $question= new Cours_Question();


$repository = $this  ->getDoctrine()  ->getManager()  ->getRepository('BrainsPlatformBundle:Cours_Partie');

  $partie = $repository->find($id);


   $form = $this->createForm(Cours_QuestionType::class, $question);




//si le formulaire est bien rempli, on l'enregistre dans la BD
    if($request->isMethod('POST')){

      $form->handleRequest($request);

          $question->setPartie($partie);
 



       if($form->isValid()  )  
        { 



          $question->getPartie()->addCours_Question($question);

         $em= $this->getDoctrine()->getManager();
      $em->persist($question);
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'Question Bien enregistrée.');
 

          return $this->redirectToRoute('BP_show_cours_question', array('id'=>$question->getPartie()->getId()));
    }
  }

//sinon (ou bien premier landing sur le form), on affiche le formulaire
  return $this->render('BrainsPlatformBundle:New:cours_question.html.twig', array(
   'form'=>$form->createView(), 'partie_id'=>$id, 'cours_id' => $partie->getCours()->getId(),
   ));

}



 public function show_cours_questionAction(Request $request, $id=1)
{
  $em= $this  ->getDoctrine()  ->getManager();

  $repository = $em  ->getRepository('BrainsPlatformBundle:Cours_Question');


    $listQuestions = $repository->findBy([
      'partie' => $id ,
    ]);



    $repository = $this  ->getDoctrine()  ->getManager()  ->getRepository('BrainsPlatformBundle:Cours_Partie');

  $partie = $repository->find($id);

  if (null === $listQuestions) {
    throw new NotFoundHttpException("Aucune question na été trouvé");
  }
  $part_exp='';
  foreach($listQuestions as $lq)
  {$part_exp=$lq;}

  return $this->render('BrainsPlatformBundle:Show:cours_question.html.twig', array(
    'listQuestions' => $listQuestions , 'partie_id'=>$id, 'cours_id'=>$partie->getCours()->getId() ) );
}




public function update_cours_questionAction(Request $request, $id)
{

  $repository = $this  ->getDoctrine()  ->getManager()  ->getRepository('BrainsPlatformBundle:Cours_Question');

  $question = $repository->find($id);

    
 
  if (null === $question) {
    throw new NotFoundHttpException("Votre question na pas été trouvée");
  }


  $form = $this->createForm(Cours_QuestionType::class, $question);



  if($request->isMethod('POST')){

    $form->handleRequest($request);

    if($form->isValid()){
      $em= $this->getDoctrine()->getManager();
      $em->persist($question);
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'question Bien enregistrée.');

  
 
 
          return $this->redirectToRoute('BP_show_cours_question', array('id'=>$question->getPartie()->getId()));

    }

  }

  return $this->render('BrainsPlatformBundle:New:cours_question.html.twig', array(
   'form'=>$form->createView(), 'partie_id' =>$question->getPartie()->getId(),
    'cours_id'=>$question->getPartie()->getCours()->getId(),
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

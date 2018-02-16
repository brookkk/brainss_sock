<?php

namespace Brains\PlatformBundle\Controller;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Brains\PlatformBundle\Form\ExerciceType;
use Brains\PlatformBundle\Form\Exo_PartieType;
use Brains\PlatformBundle\Entity\Exo_Partie;
use Brains\PlatformBundle\Entity\Exercice;
 
 


class Cours_PartieController extends Controller
{
  public function indexAction()
  {
    return $this->render('BrainsPlatformBundle:Default:index.html.twig');
  }

  public function n_exo_partieAction(Request $request, $id)
  {
//nouvelle instance de l'entité partie
    $partie= new Exo_Partie();


$repository = $this  ->getDoctrine()  ->getManager()  ->getRepository('BrainsPlatformBundle:Exercice');

  $exercice = $repository->find($id);


   $form = $this->createForm(Exo_PartieType::class, $partie);




//si le formulaire est bien rempli, on l'enregistre dans la BD
    if($request->isMethod('POST')){

      $form->handleRequest($request);

            print_r($partie);
            
          $partie->setExercice($exercice);
    



       if($form->isValid()  )  
        { 
          $partie->getExercice()->addExo_Partie($partie);
          

         $em= $this->getDoctrine()->getManager();
      $em->persist($partie);
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'Partie Bien enregistrée.');
 

          return $this->redirectToRoute('BP_show_exo_partie', array('id'=>$partie->getExercice()->getId()));
    }
  }

//sinon (ou bien premier landing sur le form), on affiche le formulaire
  return $this->render('BrainsPlatformBundle:New:exo_partie.html.twig', array(
   'form'=>$form->createView(), 'exo_id'=>$id
   ));

}


 




 public function show_cours_partieAction(Request $request, $id=35)
{
  $em= $this  ->getDoctrine()  ->getManager();

  $repository = $em  ->getRepository('BrainsPlatformBundle:Cours_Partie');


  //$listParties = $repository->findAll();

    $listParties = $repository->findBy([
      'exercice' => $id ,
    ]);

  if (null === $listParties) {
    throw new NotFoundHttpException("Aucun Exercice na été trouvé");
  }

  $nb_questions=array();
foreach($listParties as $part){
  $nb_questions[$part->getId()] = $this->nb_questionsAction( $part->getId());
}





  return $this->render('BrainsPlatformBundle:Show:exo_partie.html.twig', array(
    'listParties' => $listParties , 'exo_id'=>$id, 'nb_questions'=>$nb_questions  ) );
}




 


 



public function update_exo_partieAction(Request $request, $id)
{

  $repository = $this  ->getDoctrine()  ->getManager()  ->getRepository('BrainsPlatformBundle:Exo_Partie');

  $partie = $repository->find($id);

    
 
  if (null === $partie) {
    throw new NotFoundHttpException("Votre partie na pas été trouvé");
  }


  $form = $this->createForm(Exo_PartieType::class, $partie);



  if($request->isMethod('POST')){

    $form->handleRequest($request);

    if($form->isValid()){
      $em= $this->getDoctrine()->getManager();
      $em->persist($partie);
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'partie Bien enregistrée.');

  
 
 
     // return $this->redirectToRoute('BP_show_all_exo_partie');
          return $this->redirectToRoute('BP_show_exo_partie', array('id'=>$partie->getExercice()->getId()));

    }




  }

  return $this->render('BrainsPlatformBundle:New:exo_partie.html.twig', array(
   'form'=>$form->createView(), 'exo_id' =>$partie->getExercice()->getId(),
   ));


}



public function delete_exo_partieAction(Request $request, $id)
{
  $em= $this->getDoctrine()->getManager();

  $repository = $em  ->getRepository('BrainsPlatformBundle:Exo_Partie');

  $partie = $repository->find($id);

  if (null === $partie) {
    throw new NotFoundHttpException("Votre partie na pas été trouvée");
  }


  $em->remove($partie);
  $em->flush();

  $request->getSession()->getFlashBag()->add('notice', 'Exercice a été supprimée');

 
 

  //return $this->redirectToRoute('BP_show_all_exo_partie');
  return $this->redirectToRoute('BP_show_exo_partie', array('id'=>$partie->getExercice()->getId()));



}


     //Action pour calculer le nb de questions d'une partie donnée
public function nb_questionsAction( $id)
{
  $em= $this  ->getDoctrine()  ->getManager();

  $repository = $em  ->getRepository('BrainsPlatformBundle:Exo_Question');


  $listQuestions = $repository->findBy([
      'partie' => $id ,
    ]);

  if (null === $listQuestions) {
    throw new NotFoundHttpException("Aucune question na été trouvée");
  }


$count=0;

foreach($listQuestions as $q){
  $count++;
}
  return $count;



}

 
 

public function get_questionsAction($id){


   $em= $this  ->getDoctrine()  ->getManager();

  $repository = $em  ->getRepository('BrainsPlatformBundle:Exo_Question');


  $listQuestions = $repository->findBy([
      'partie' => $id ,
    ]);
//$listQuestions="hh";
 // print_r($listQuestions);
  return $listQuestions;

}




}



?>

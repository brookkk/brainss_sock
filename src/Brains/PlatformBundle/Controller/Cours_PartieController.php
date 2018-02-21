<?php

namespace Brains\PlatformBundle\Controller;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Brains\PlatformBundle\Form\CoursType;
use Brains\PlatformBundle\Form\Cours_PartieType;
use Brains\PlatformBundle\Entity\Cours_Partie;
use Brains\PlatformBundle\Entity\Cours;
 
 


class Cours_PartieController extends Controller
{
  public function indexAction()
  {
    return $this->render('BrainsPlatformBundle:Default:index.html.twig');
  }

  public function n_cours_partieAction(Request $request, $id)
  {
//nouvelle instance de l'entité partie
    $partie= new Cours_Partie();


$repository = $this  ->getDoctrine()  ->getManager()  ->getRepository('BrainsPlatformBundle:Cours');

  $cours = $repository->find($id);


   $form = $this->createForm(Cours_PartieType::class, $partie);




//si le formulaire est bien rempli, on l'enregistre dans la BD
    if($request->isMethod('POST')){

      $form->handleRequest($request);

            //print_r($partie);
            
          $partie->setCours($cours);
    



       if($form->isValid()  )  
        { 
          $partie->getCours()->addCours_Partie($partie);
          

         $em= $this->getDoctrine()->getManager();
      $em->persist($partie);
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'Partie Bien enregistrée.');
 

          return $this->redirectToRoute('BP_show_cours_partie', array('id'=>$partie->getCours()->getId()));
    }
  }

//sinon (ou bien premier landing sur le form), on affiche le formulaire
  return $this->render('BrainsPlatformBundle:New:cours_partie.html.twig', array(
   'form'=>$form->createView(), 'cours_id'=>$id
   ));

}


 




 public function show_cours_partieAction(Request $request, $id=35)
{
  $em= $this  ->getDoctrine()  ->getManager();

  $repository = $em  ->getRepository('BrainsPlatformBundle:Cours_Partie');


  //$listParties = $repository->findAll();

    $listParties = $repository->findBy([
      'cours' => $id ,
    ]);

  if (null === $listParties) {
    throw new NotFoundHttpException("Aucun Cours na été trouvé");
  }

  $nb_questions=array();
foreach($listParties as $part){
  $nb_questions[$part->getId()] = $this->nb_questionsAction( $part->getId());
}





  return $this->render('BrainsPlatformBundle:Show:cours_partie.html.twig', array(
    'listParties' => $listParties , 'cours_id'=>$id, 'nb_questions'=>$nb_questions  ) );
}




 


 



public function update_cours_partieAction(Request $request, $id)
{

  $repository = $this  ->getDoctrine()  ->getManager()  ->getRepository('BrainsPlatformBundle:Cours_Partie');

  $partie = $repository->find($id);

    
 
  if (null === $partie) {
    throw new NotFoundHttpException("Votre partie na pas été trouvée");
  }


  $form = $this->createForm(Cours_PartieType::class, $partie);



  if($request->isMethod('POST')){

    $form->handleRequest($request);

    if($form->isValid()){
      $em= $this->getDoctrine()->getManager();
      $em->persist($partie);
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'partie Bien enregistrée.');

  
 
 
     // return $this->redirectToRoute('BP_show_all_exo_partie');
          return $this->redirectToRoute('BP_show_cours_partie', array('id'=>$partie->getCours()->getId()));

    }




  }

  return $this->render('BrainsPlatformBundle:New:cours_partie.html.twig', array(
   'form'=>$form->createView(), 'cours_id' =>$partie->getCours()->getId(),
   ));


}



public function delete_cours_partieAction(Request $request, $id)
{
  $em= $this->getDoctrine()->getManager();

  $repository = $em  ->getRepository('BrainsPlatformBundle:Cours_Partie');

  $partie = $repository->find($id);

  if (null === $partie) {
    throw new NotFoundHttpException("Votre partie na pas été trouvée");
  }


  $em->remove($partie);
  $em->flush();

  $request->getSession()->getFlashBag()->add('notice', 'Cours Partie a été supprimée');

 
 

  //return $this->redirectToRoute('BP_show_all_exo_partie');
  return $this->redirectToRoute('BP_show_cours_partie', array('id'=>$partie->getCours()->getId()));



}


     //Action pour calculer le nb de questions d'une partie donnée
public function nb_questionsAction( $id)
{
  $em= $this  ->getDoctrine()  ->getManager();

  $repository = $em  ->getRepository('BrainsPlatformBundle:Cours_Question');


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

  $repository = $em  ->getRepository('BrainsPlatformBundle:Cours_Question');


  $listQuestions = $repository->findBy([
      'partie' => $id ,
    ]);
//$listQuestions="hh";
 // print_r($listQuestions);
  return $listQuestions;

}




}



?>

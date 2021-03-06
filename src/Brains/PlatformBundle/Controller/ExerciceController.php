<?php

namespace Brains\PlatformBundle\Controller;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


use Brains\PlatformBundle\Form\ExerciceType;

use Brains\PlatformBundle\Entity\Annee;
use Brains\PlatformBundle\Entity\Filiere;
use Brains\PlatformBundle\Entity\Exercice;

//use Symfony\Component\Filesystem\Filesystem;
//use Symfony\Component\Filesystem\Exception\IOExceptionInterface;


class ExerciceController extends Controller
{
  public function indexAction()
  {
    return $this->render('BrainsPlatformBundle:Default:index.html.twig');
  }

  public function n_exerciceAction(Request $request)
  {
//nouvelle instance de l'entité Année
    $exercice= new Exercice();


 //too old too long
//$form = $this->get('form.factory')->create(ExerciceType::class, $exercice);

    $form = $this->createForm(ExerciceType::class, $exercice);


//si le formulaire est bien rempli, on l'enregistre dans la BD
    if($request->isMethod('POST')){

      $form->handleRequest($request);

      //$exercice->getAnnee()->addExercices($exercice);
      $exercice->getFiliere()->addExercices($exercice);

      //$exercice->setAnnee($exercice->getAnnee());
      $exercice->setFiliere($exercice->getFiliere());



      $fs = new Filesystem();
      if($form->isValid()   
        ){

       
      

        $em= $this->getDoctrine()->getManager();
      $em->persist($exercice);
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'Exercice Bien enregistré.');

  


       



          return $this->redirectToRoute('BP_show_exercice');
    }
  }

//sinon (ou bien premier landing sur le form), on affiche le formulaire
  return $this->render('BrainsPlatformBundle:New:exercice.html.twig', array(
   'form'=>$form->createView(),
   ));

}


    //Action pour Afficher toutes les filières existantes
public function show_exerciceAction(Request $request)
{
  $em= $this  ->getDoctrine()  ->getManager();

  $repository = $em  ->getRepository('BrainsPlatformBundle:Exercice');


  $listExercices = $repository->findAll();

  if (null === $listExercices) {
    throw new NotFoundHttpException("Aucun Exercice na été trouvé");
  }
  $nb_parties=array();
foreach($listExercices as $exo){
  $nb_parties[$exo->getid()] = $this->nb_partiesAction( $exo->getid());
}

  return $this->render('BrainsPlatformBundle:Show:exercice.html.twig', array(
    'listExercices' => $listExercices, 'nb_parties'=>$nb_parties  ) );
}



public function update_exerciceAction(Request $request, $id)
{

  $repository = $this  ->getDoctrine()  ->getManager()  ->getRepository('BrainsPlatformBundle:Exercice');

  $exercice = $repository->find($id);

  $fs = new Filesystem();
 

  if (null === $exercice) {
    throw new NotFoundHttpException("Votre exercice na pas été trouvé");
  }


  $form = $this->createForm(ExerciceType::class, $exercice);



  if($request->isMethod('POST')){

    $form->handleRequest($request);

    if($form->isValid()){
      $exercice -> setDateMaj(new \Datetime());  
      $em= $this->getDoctrine()->getManager();
      $em->persist($exercice);
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'Exercice Bien enregistré.');

     

      return $this->redirectToRoute('BP_show_exercice');
    }




  }

  return $this->render('BrainsPlatformBundle:New:exercice.html.twig', array(
   'form'=>$form->createView(),
   ));


}



public function delete_exerciceAction(Request $request, $id)
{
  $em= $this->getDoctrine()->getManager();

  $repository = $em  ->getRepository('BrainsPlatformBundle:Exercice');

  $exercice = $repository->find($id);

  if (null === $exercice) {
    throw new NotFoundHttpException("Votre exercice na pas été trouvé");
  }


  $em->remove($exercice);
  $em->flush();

  $request->getSession()->getFlashBag()->add('notice', 'Exercice a été supprimée');

  


  return $this->redirectToRoute('BP_show_exercice');


}

     //Action pour calculer le nb de parties d'un exercice donné
public function nb_partiesAction( $id)
{
  $em= $this  ->getDoctrine()  ->getManager();

  $repository = $em  ->getRepository('BrainsPlatformBundle:Exo_Partie');


  $listParties = $repository->findBy([
      'exercice' => $id ,
    ]);

  if (null === $listParties) {
    throw new NotFoundHttpException("Aucune partie na été trouvée");
  }


$count=0;

foreach($listParties as $p){
  $count++;
}
  return $count;



}
}


?>

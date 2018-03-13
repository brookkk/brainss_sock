<?php

namespace Brains\PlatformBundle\Controller;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


use Brains\PlatformBundle\Form\CoursType;

use Brains\PlatformBundle\Entity\Annee;
use Brains\PlatformBundle\Entity\Filiere;
use Brains\PlatformBundle\Entity\Cours;



class CoursController extends Controller
{
  public function indexAction()
  {
    return $this->render('BrainsPlatformBundle:Default:index.html.twig');
  }

  public function n_coursAction(Request $request)
  {
//nouvelle instance de l'entité Année
    $cours= new Cours();

 //too old too long
//$form = $this->get('form.factory')->create(ExerciceType::class, $exercice);

    $form = $this->createForm(CoursType::class, $cours);


//si le formulaire est bien rempli, on l'enregistre dans la BD
    if($request->isMethod('POST')){

      $form->handleRequest($request);

 
      if($form->isValid()   
        ){
        $em= $this->getDoctrine()->getManager();
      $em->persist($cours);
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'Cours Bien enregistré.');




        return $this->redirectToRoute('BP_show_cours');
      }
    }

//sinon (ou bien premier landing sur le form), on affiche le formulaire
    return $this->render('BrainsPlatformBundle:New:cours.html.twig', array(
     'form'=>$form->createView(),
     ));

  }


    //Action pour Afficher toutes les filières existantes
  public function show_coursAction(Request $request)
  {
    $em= $this  ->getDoctrine()  ->getManager();

    $repository = $em  ->getRepository('BrainsPlatformBundle:Cours');
    

    $listCours = $repository->findAll();

    if (null === $listCours) {
      throw new NotFoundHttpException("Aucun Cours na été trouvé");
    }


 $nb_parties=array();
foreach($listCours as $cours){
  $nb_parties[$cours->getid()] = $this->nb_partiesAction( $cours->getid());
}



    return $this->render('BrainsPlatformBundle:Show:cours.html.twig', array(
      'listCours' => $listCours  , 'nb_parties'=>$nb_parties) );
  }



  public function update_coursAction(Request $request, $id)
  {

    $repository = $this  ->getDoctrine()  ->getManager()  ->getRepository('BrainsPlatformBundle:Cours');

    $cours = $repository->find($id);



 

    if (null === $cours) {
      throw new NotFoundHttpException("Votre cours na pas été trouvé");
    }


    $form = $this->createForm(CoursType::class, $cours);



    if($request->isMethod('POST')){

      $form->handleRequest($request);

      if($form->isValid()){
        $em= $this->getDoctrine()->getManager();
        $em->persist($cours);
        $em->flush();

        $request->getSession()->getFlashBag()->add('notice', 'Cours Bien enregistré.');

       


        return $this->redirectToRoute('BP_show_cours');
      }




    }

    return $this->render('BrainsPlatformBundle:New:cours.html.twig', array(
     'form'=>$form->createView(),
     ));


  }



  public function delete_coursAction(Request $request, $id)
  {
    $em= $this->getDoctrine()->getManager();

    $repository = $em  ->getRepository('BrainsPlatformBundle:Cours');

    $cours = $repository->find($id);

    if (null === $cours) {
      throw new NotFoundHttpException("Votre Cours na pas été trouvé");
    }


    $em->remove($cours);
    $em->flush();

    $request->getSession()->getFlashBag()->add('notice', 'Cours a été supprimée');

  


    return $this->redirectToRoute('BP_show_cours');


  }



     //Action pour calculer le nb de parties d'un cours donné
public function nb_partiesAction( $id)
{
  $em= $this  ->getDoctrine()  ->getManager();

  $repository = $em  ->getRepository('BrainsPlatformBundle:Cours_Partie');


  $listParties = $repository->findBy([
      'cours' => $id ,
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

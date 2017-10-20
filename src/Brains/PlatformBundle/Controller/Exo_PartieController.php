<?php

namespace Brains\PlatformBundle\Controller;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


use Brains\PlatformBundle\Form\ExerciceType;
use Brains\PlatformBundle\Form\Exo_PartieType;

use Brains\PlatformBundle\Entity\Annee;
use Brains\PlatformBundle\Entity\Filiere;
use Brains\PlatformBundle\Entity\Exo_Partie;
use Brains\PlatformBundle\Entity\question;

//use Symfony\Component\Filesystem\Filesystem;
//use Symfony\Component\Filesystem\Exception\IOExceptionInterface;


class Exo_PartieController extends Controller
{
  public function indexAction()
  {
    return $this->render('BrainsPlatformBundle:Default:index.html.twig');
  }

  public function n_exo_partieAction(Request $request)
  {
//nouvelle instance de l'entité Année
    $partie= new Exo_Partie();


   $form = $this->createForm(Exo_PartieType::class, $partie);


//si le formulaire est bien rempli, on l'enregistre dans la BD
    if($request->isMethod('POST')){

      $form->handleRequest($request);

 



       if($form->isValid()  )  
        { 
         $em= $this->getDoctrine()->getManager();
      $em->persist($partie);
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'Partie Bien enregistrée.');
 
          return $this->redirectToRoute('BP_show_exo_partie');
    }
  }

//sinon (ou bien premier landing sur le form), on affiche le formulaire
  return $this->render('BrainsPlatformBundle:New:exo_partie.html.twig', array(
   'form'=>$form->createView(),
   ));

}


    //Action pour Afficher toutes les filières existantes
public function show_questionAction(Request $request, $id)
{
  $em= $this  ->getDoctrine()  ->getManager();

  $repository = $em  ->getRepository('BrainsPlatformBundle:question');


  $listQuestions = $repository->findBy([
      'exercice' => $id ,
    ]);

  if (null === $listQuestions) {
    throw new NotFoundHttpException("Aucune question na été trouvée");
  }



  return $this->render('BrainsPlatformBundle:Show:question.html.twig', array(
    'listQuestions' => $listQuestions, 'id' => $id  ) );
}


 public function show_exo_partieAction(Request $request)
{
  $em= $this  ->getDoctrine()  ->getManager();

  $repository = $em  ->getRepository('BrainsPlatformBundle:Exo_Partie');


  $listParties = $repository->findAll();

  if (null === $listParties) {
    throw new NotFoundHttpException("Aucun Exercice na été trouvé");
  }



  return $this->render('BrainsPlatformBundle:Show:exo_partie.html.twig', array(
    'listParties' => $listParties  ) );
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

  
 
 
      return $this->redirectToRoute('BP_show_exo_partie');
    }




  }

  return $this->render('BrainsPlatformBundle:New:exo_partie.html.twig', array(
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

  $fs = new Filesystem();

  $fs->remove($this->container->getParameter('BrainsPlatformBundle.racine').'/'.$exercice->getAnnee()->getShort().'/'
    .$exercice->getFiliere()->getShort() .'/exercices/'.$exercice->getNom().'.html');


  return $this->redirectToRoute('BP_show_exercice');


}

public function fileAction()
{
  $fs = new Filesystem();

//try {
    //$fs->mkdir('/hahahoho/');
  $fs->mkdir($this->container->getParameter('BrainsPlatformBundle.racine').'/hello', 0700);
    //$fs->touch('test_file.txt');
  return $this->render('BrainsPlatformBundle:Default:index.html.twig');
    /*
} catch (IOExceptionInterface $e) {
    echo "An error occurred while creating your directory at ".$e->getPath();
}


return $this->render('BrainsPlatformBundle:Default:index.html.twig');*/




}



}



?>

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

    if($form->isValid()){
        $em= $this->getDoctrine()->getManager();
        $em->persist($exercice);
        $em->flush();

        $request->getSession()->getFlashBag()->add('notice', 'Exercice Bien enregistré.');

/*
        $fs = new Filesystem();
        $fs->mkdir('./test/test');*/

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



    return $this->render('BrainsPlatformBundle:Show:exercice.html.twig', array(
      'listExercices' => $listExercices  ) );
  }



         public function update_exerciceAction(Request $request, $id)
    {
      
$repository = $this  ->getDoctrine()  ->getManager()  ->getRepository('BrainsPlatformBundle:Exercice');

$exercice = $repository->find($id);

 

if (null === $exercice) {
      throw new NotFoundHttpException("Votre exercice na pas été trouvé");
    }


$form = $this->createForm(ExerciceType::class, $exercice);



if($request->isMethod('POST')){

    $form->handleRequest($request);

    if($form->isValid()){
        $em= $this->getDoctrine()->getManager();
        $em->persist($exercice);
        $em->flush();

        $request->getSession()->getFlashBag()->add('notice', 'Exercice Bien enregistré.');



        return $this->redirectToRoute('BP_show_exercice');
    }



 
}

return $this->render('BrainsPlatformBundle:New:annee.html.twig', array(
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

     public function fileAction()
    {
$fs = new Filesystem();

//try {
    //$fs->mkdir('/hahahoho/');
    $fs->mkdir('./hahahoho', 0700);
    $fs->touch('hahahoho.txt');
      return $this->render('BrainsPlatformBundle:Default:index.html.twig');
    /*
} catch (IOExceptionInterface $e) {
    echo "An error occurred while creating your directory at ".$e->getPath();
}


        return $this->render('BrainsPlatformBundle:Default:index.html.twig');*/




    }



 }



?>

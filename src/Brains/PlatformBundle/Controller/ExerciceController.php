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

        return $this->redirectToRoute('BP_show_annee');
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

    $repository = $this  ->getDoctrine()  ->getManager()  ->getRepository('BrainsPlatformBundle:Exercice');
    $repository2 = $this  ->getDoctrine()  ->getManager()  ->getRepository('BrainsPlatformBundle:Exercice');
    $repository3 = $this  ->getDoctrine()  ->getManager()  ->getRepository('BrainsPlatformBundle:Exercice');


    $listExercices = $repository->findAll();
 
    if (null === $listExercices) {
      throw new NotFoundHttpException("Aucun Exercice na été trouvé");
        }

        $annees=array();
/*
        foreach ($listExercices as $exercice){
          $annee[]=$repository2->find($exercice->annee);
        }*/


    return $this->render('BrainsPlatformBundle:Show:exercice.html.twig', array(
      'listExercices' => $listExercices    ) );
  }



         public function update_anneeAction(Request $request, $id)
    {
      
$repository = $this  ->getDoctrine()  ->getManager()  ->getRepository('BrainsPlatformBundle:Annee');

$annee = $repository->find($id);

 

if (null === $annee) {
      throw new NotFoundHttpException("Votre année na pas été trouvée");
    }



$formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $annee);

$form=$formBuilder
      ->add('short',   TextType::class)
      ->add('nome',   TextType::class)
      ->add('Sauvegarder',      SubmitType::class)
      ->getForm()      ;

if($request->isMethod('POST')){

    $form->handleRequest($request);

    if($form->isValid()){
        $em= $this->getDoctrine()->getManager();
        $em->persist($annee);
        $em->flush();

        $request->getSession()->getFlashBag()->add('notice', 'Année Bien enregistrée.');

        return $this->redirectToRoute('BP_show_annee');
    }
}

return $this->render('BrainsPlatformBundle:New:annee.html.twig', array(
 'form'=>$form->createView(),
  ));
 

    }



         public function delete_anneeAction(Request $request, $id)
    {
      
$repository = $this  ->getDoctrine()  ->getManager()  ->getRepository('BrainsPlatformBundle:Annee');

$annee = $repository->find($id);
 
if (null === $annee) {
      throw new NotFoundHttpException("Votre année na pas été trouvée");
    }
 
        $em= $this->getDoctrine()->getManager();
        $em->remove($annee);
        $em->flush();

        $request->getSession()->getFlashBag()->add('notice', 'Année a été supprimée');

        return $this->redirectToRoute('BP_show_annee');
 
 
    }



 }



?>

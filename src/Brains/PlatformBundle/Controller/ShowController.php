<?php

namespace Brains\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Brains\PlatformBundle\Entity\Annee;
use Brains\PlatformBundle\Entity\Filiere;

class ShowController extends Controller
{
    public function indexAction()
    {
        return $this->render('BrainsPlatformBundle:Default:index.html.twig');
    }





//Action pour Afficher toutes les filières existantes
  public function filiereAction(Request $request)
  {

    $repository = $this  ->getDoctrine()  ->getManager()  ->getRepository('BrainsPlatformBundle:Filiere');

    $listFilieres = $repository->findAll();
 
    if (null === $listFilieres) {
      throw new NotFoundHttpException("Aucune filière na été trouvée");
        }

    return $this->render('BrainsPlatformBundle:Show:filiere.html.twig', array(
      'listFilieres' => $listFilieres    ) );
  }



       public function update_filiereAction(Request $request, $id)
    {
      
$repository = $this  ->getDoctrine()  ->getManager()  ->getRepository('BrainsPlatformBundle:Filiere');

$filiere = $repository->find($id);

 

if (null === $filiere) {
      throw new NotFoundHttpException("Votre filière na pas été trouvée");
    }



$formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $filiere);

$form=$formBuilder
      ->add('short',   TextType::class)
      ->add('nome',   TextType::class)
      ->add('Sauvegarder',      SubmitType::class)
      ->getForm()      ;

if($request->isMethod('POST')){

    $form->handleRequest($request);

    if($form->isValid()){
        $em= $this->getDoctrine()->getManager();
        $em->persist($filiere);
        $em->flush();

        $request->getSession()->getFlashBag()->add('notice', 'Filière Bien enregistrée.');

        return $this->redirectToRoute('BP_show_filiere');
    }
}

return $this->render('BrainsPlatformBundle:New:filiere.html.twig', array(
 'form'=>$form->createView(),
  ));
/*
return $this->render('BrainsPlatformBundle:Show:filiere.html.twig', array(
      'filiere' => $filiere
    ) );*/




    }








 }



?>

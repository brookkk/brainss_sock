<?php

namespace Brains\PlatformBundle\Controller;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


use Brains\PlatformBundle\Form\ContributionType;


use Brains\PlatformBundle\Entity\Filiere;
use Brains\PlatformBundle\Entity\Contribution;

//use Symfony\Component\Filesystem\Filesystem;
//use Symfony\Component\Filesystem\Exception\IOExceptionInterface;


class ContributionController extends Controller
{
  public function indexAction()
  {
    return $this->render('BrainsPlatformBundle:Default:index.html.twig');
  }

  public function n_contributionAction(Request $request)
  {
     $contribution= new Contribution();



    $form = $this->createForm(ContributionType::class, $contribution);


//si le formulaire est bien rempli, on l'enregistre dans la BD
    if($request->isMethod('POST')){

      $form->handleRequest($request);

      // $contribution->getFiliere()->addExercices($exercice);

       //$exercice->setFiliere($exercice->getFiliere());



       if($form->isValid()   ){
        $em= $this->getDoctrine()->getManager();
      $em->persist($contribution);
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'Contribution Bien enregistré.');



          return $this->redirectToRoute('BP_show_contribution');
    }
  }

//sinon (ou bien premier landing sur le form), on affiche le formulaire
  return $this->render('BrainsPlatformBundle:New:contribution.html.twig', array(
   'form'=>$form->createView(),
   ));

}


    //Action pour Afficher toutes les filières existantes
public function show_contributionAction(Request $request)
{
  $em= $this  ->getDoctrine()  ->getManager();

  $repository = $em  ->getRepository('BrainsPlatformBundle:Contribution');


  $listContributions = $repository->findAll();

  if (null === $listContributions) {
    throw new NotFoundHttpException("Aucune Contribution na été trouvée");
  }



  return $this->render('BrainsPlatformBundle:Show:contribution.html.twig', array(
    'listContributions' => $listContributions  ) );
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





}



?>

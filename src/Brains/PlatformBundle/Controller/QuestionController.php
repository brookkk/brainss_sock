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
use Brains\PlatformBundle\Entity\question;

//use Symfony\Component\Filesystem\Filesystem;
//use Symfony\Component\Filesystem\Exception\IOExceptionInterface;


class QuestionController extends Controller
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

      $exercice->getAnnee()->addExercices($exercice);
      $exercice->getFiliere()->addExercices($exercice);

      $exercice->setAnnee($exercice->getAnnee());
      $exercice->setFiliere($exercice->getFiliere());



      $fs = new Filesystem();
      if($form->isValid()   &&     
        $fs->exists($this->container->getParameter('BrainsPlatformBundle.racine').'/'.$exercice->getAnnee()->getShort().'/'
         .$exercice->getFiliere()->getShort().'/exercices' )  
        ){

        $new_file_path = $this->container->getParameter('BrainsPlatformBundle.racine').'/'.$exercice->getAnnee()->getShort().'/'
      .$exercice->getFiliere()->getShort() .'/exercices/'.$exercice->getNom().'.html';
      $fs->touch($new_file_path);

      //$link = explode("")

        $exercice->setLink($new_file_path);
        $em= $this->getDoctrine()->getManager();
      $em->persist($exercice);
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'Exercice Bien enregistré.');

  


          $file = fopen($new_file_path, 'a+');
          fputs($file, $exercice->getContenu() );



          return $this->redirectToRoute('BP_show_exercice');
    }
  }

//sinon (ou bien premier landing sur le form), on affiche le formulaire
  return $this->render('BrainsPlatformBundle:New:exercice.html.twig', array(
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



public function update_exerciceAction(Request $request, $id)
{

  $repository = $this  ->getDoctrine()  ->getManager()  ->getRepository('BrainsPlatformBundle:Exercice');

  $exercice = $repository->find($id);

  $fs = new Filesystem();
  $first_part=$this->container->getParameter('BrainsPlatformBundle.racine').'/'.$exercice->getAnnee()->getShort().'/'
  .$exercice->getFiliere()->getShort() .'/exercices/';
  $old=$exercice->getNom().'.html';

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

      $new=$exercice->getNom().'.html';
if($old!=$new)
      $fs->rename($first_part.$old, $first_part.$new);
    $exercice->setLink($first_part.$new);
    $file = fopen($first_part.$new, 'w');

          fputs($file, $exercice->getContenu() );

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

  $fs = new Filesystem();

  $fs->remove($this->container->getParameter('BrainsPlatformBundle.racine').'/'.$exercice->getAnnee()->getShort().'/'
    .$exercice->getFiliere()->getShort() .'/exercices/'.$exercice->getNom().'.html');


  return $this->redirectToRoute('BP_show_exercice');


}

 



}



?>

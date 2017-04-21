<?php

namespace Brains\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


//use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Brains\PlatformBundle\Entity\Annee;
use Brains\PlatformBundle\Entity\Filiere;

class DeleteController extends Controller
{
    public function indexAction()
    {
        return $this->render('BrainsPlatformBundle:Default:index.html.twig');
    }



       public function delete_filiereAction(Request $request, $id)
    {
      
$repository = $this  ->getDoctrine()  ->getManager()  ->getRepository('BrainsPlatformBundle:Filiere');

$filiere = $repository->find($id);

 

if (null === $filiere) {
      throw new NotFoundHttpException("Votre filière na pas été trouvée");
    }



        $em= $this->getDoctrine()->getManager();
        $em->remove($filiere);
        $em->flush();

        $request->getSession()->getFlashBag()->add('notice', 'Filière a été supprimée');

        return $this->redirectToRoute('BP_show_filiere');
     
 
/*
return $this->render('BrainsPlatformBundle:New:year.html.twig', array(
 'form'=>$form->createView(),
  ));*/
 
    }


 }



?>

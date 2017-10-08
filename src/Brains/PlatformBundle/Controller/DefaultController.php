<?php

namespace Brains\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Brains\PlatformBundle\Entity\Exercice;
use Symfony\Component\HttpFoundation\Request;
use Brains\PlatformBundle\Form\ExerciceType;

use Brains\PlatformBundle\Entity\Question;
use Brains\PlatformBundle\Form\questionType;





class DefaultController extends Controller
{
    public function indexAction()
    {
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED'))
        return $this->render('BrainsPlatformBundle:Default:index.html.twig');
        else return $this->redirectToRoute('login');
    }


    public function send_mailAction()
    {
    	for($i=0;$i<2;$i++){
    	 $message = \Swift_Message::newInstance()
        ->setSubject('Hello Email'.($i+1))
        ->setFrom('tessssts.rmay.no2@gmail.com')
        ->setTo('grini.abdellah@gmail.com')
        ->setBody("watta lah yhdik !!");
        $this->get('mailer')->send($message);
}


   
    $this->get('mailer')->send($message);
     //$this->getMailer()->send("tets");

     return $this->render('BrainsPlatformBundle:Default:index.html.twig');


    }



       public function uiAction()
    {
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED'))
        return $this->render('BrainsPlatformBundle:Default:ui.html.twig');
        else return $this->redirectToRoute('login');
    }





public function n_uiAction(Request $request)
  {
//nouvelle instance de l'entité Année
    $question= new question();


    $form = $this->createForm(questionType::class, $question);


//si le formulaire est bien rempli, on l'enregistre dans la BD
    if($request->isMethod('POST')){

      $form->handleRequest($request);

 
      
      if($form->isValid()    
        ){

        

        
        $em= $this->getDoctrine()->getManager();
      $em->persist($question);
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'question Bien enregistré.');

  





          return $this->redirectToRoute('BP_show_exercice');
    }
  }

//sinon (ou bien premier landing sur le form), on affiche le formulaire
  return $this->render('BrainsPlatformBundle:Default:n_ui.html.twig', array(
   'form'=>$form->createView(),
   ));

}





}

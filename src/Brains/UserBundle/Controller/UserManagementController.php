<?php

namespace Brains\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use FOS\UserBundle\Entity\UserManager;


use Brains\UserBundle\Entity\User;
use Brains\PlatformBundle\Entity\Annee;
use Brains\PlatformBundle\Entity\Filiere;


class UserManagementController extends Controller
{
 

  public function profileAction()
  {
    //return $this->render('BrainsUserBundle:Security:user.html.twig');
    return $this->render('BrainsUserBundle:User:show_user.html.twig');
  }



  public function getUsersAction()
  {



    $users = $this->get('fos_user.user_manager')->findUsers();


    return $this->render('BrainsUserBundle:User:show_users.html.twig',  array('users' => $users )

  );


  }
 

}

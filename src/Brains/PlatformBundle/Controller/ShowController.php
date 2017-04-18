<?php

namespace Brains\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


//use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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


$repository = $this
  ->getDoctrine()
  ->getManager()
  ->getRepository('BrainsPlatformBundle:Filiere')
;

$listFilieres = $repository->findAll();
/*
foreach ($listFilieres as $filiere) {
  // $advert est une instance de Advert
  echo $filiere->getNome();*/

//print_r($listFilieres);

return $this->render('BrainsPlatformBundle:Show:filiere.html.twig', $listFilieres);




    }








 }



?>

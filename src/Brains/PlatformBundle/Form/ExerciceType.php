<?php

namespace Brains\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Brains\PlatformBundle\Form\AnneeType;
use Brains\PlatformBundle\Form\FiliereType;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Brains\PlatformBundle\Entity\Annee;
use Brains\PlatformBundle\Entity\Filiere;

//use Symfony\Component\Form\Extension\Core\Type\TextType;

//use kms\froala-editor-bundle\Form\FroalaEditorType;

//use Kms\FroalaEditorBundle\Form\Type\FroalaEditorType;
use KMS\FroalaEditorBundle\Form\Type\FroalaEditorType;



//C:\wamp64\www\brainss\vendor\kms\froala-editor-bundle\Form\Type


class ExerciceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',   TextType::class)
            ->add('public',   TextType::class)
            ->add('auteur',   TextType::class)
            ->add('annee', EntityType::class, array(
                'class'        => 'BrainsPlatformBundle:Annee',
                'choice_label' => 'nome',
                'multiple'     => false,
                ))
            ->add('filiere', EntityType::class, array(
                'class'        => 'BrainsPlatformBundle:Filiere',
                'choice_label' => 'nome',
                'multiple'     => false,
                ))
            ->add( 'contenu', FroalaEditorType::class )
            ->add('Sauvegarder',      SubmitType::class);
            /*->add('annee')
            ->add('filiere');*/
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Brains\PlatformBundle\Entity\Exercice'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'brains_platformbundle_exercice';
    }


}

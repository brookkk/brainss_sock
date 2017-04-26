<?php

namespace Brains\PlatformBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CoursType extends AbstractType
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
            ->add('Sauvegarder',      SubmitType::class);

    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Brains\PlatformBundle\Entity\Cours'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'brains_platformbundle_cours';
    }


}

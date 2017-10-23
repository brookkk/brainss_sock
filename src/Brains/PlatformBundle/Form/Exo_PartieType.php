<?php

namespace Brains\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Brains\PlatformBundle\Entity\Exercice;



class Exo_PartieType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('contenu')
                ->add('exercice', EntityType::class, array(
                'class'        => 'BrainsPlatformBundle:Exercice',
                'choice_label' => 'nom',
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
            'data_class' => 'Brains\PlatformBundle\Entity\Exo_Partie'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'brains_platformbundle_exo_partie';
    }


}

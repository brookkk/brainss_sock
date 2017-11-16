<?php

namespace Brains\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use KMS\FroalaEditorBundle\Form\Type\FroalaEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Brains\PlatformBundle\Entity\Filiere;



class ContributionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom')->add('public')->add('auteur')->add('validateur')->add('filiere', EntityType::class, array(
                'class'        => 'BrainsPlatformBundle:Filiere',
                'choice_label' => 'nome',
                'multiple'     => false,
                ))->add('contenu', FroalaEditorType::class)->add('Sauvegarder',      SubmitType::class);


            
             
     }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Brains\PlatformBundle\Entity\Contribution'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'brains_platformbundle_contribution';
    }


}

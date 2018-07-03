<?php

namespace LW\LouvreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class TicketType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('firstname', TextType::class, array(
                  'label' => 'Nom',
                     'attr'  => array(
                  'class' => 'form-control',
                  'label' => 'Nom',
                  'placeholder'=> 'votre nom',
                   ),
                     ))
                ->add('lastname', TextType::class, array(
                  'label' => 'Prénom',
                     'attr'  => array(
                  'class' => 'form-control',
                  'label' => 'Prénom',
                  'placeholder'=> 'Prénom',
                   ),
                     ))
                ->add('country', TextType::class, array(
                  'label' => 'Pays',
                     'attr'  => array(
                  'class' => 'form-control',
                  'label' => 'Pays',
                  'placeholder'=> 'Pays',
                   ),
                     ))
                ->add('birthday', DateType::class, array(
                  'label' => 'Date de naissance',
                     'attr'  => array(
                  'class' => 'form-control',
                   ),
                     ))
                ->add('reduit', CheckboxType::class, array(
                  'label' => 'Tarif reduit',
                  'required' => false,
                   'attr'  => array(
                  'class' => 'form-check',
                   ),
                     ))
                ->add('reduction',HiddenType::class);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LW\LouvreBundle\Entity\Ticket'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'lw_louvrebundle_ticket';
    }


}

<?php

namespace LW\LouvreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;

class OrdersType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('createdDate',HiddenType::class)
               
                ->add('visiteDate', DateType::class, array(
                  'label' => 'Date de la visite',
                  'widget' => 'single_text',
                  'html5' => false,
                     'attr' => ['class' => 'datepicker'],
                ))
                ->add('typeOrder',ChoiceType::class, array(
                       'choices' => array(
                        'Journée'       => 'Journée',
                        'Demi-journée'  => 'Demi-journée',
                      ),
                    ))
                ->add('price',HiddenType::class)
                ->add('codeReservation',HiddenType::class)

                ->add('email',HiddenType::class)
                ->add('tickets', CollectionType::class, array(
                          'entry_type'   => TicketType::class,
                           'allow_add'    => true
                      ))
                 ->add('save',SubmitType::class);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LW\LouvreBundle\Entity\Orders'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'lw_louvrebundle_orders';
    }


}

<?php

namespace App\Form;

use App\Config\UserTypeEnum;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'name',
                TextType::class,
                [
                    'label' => 'Name',
                    'label_attr' => [
                        'class' => 'col-sm-1 col-form-label'
                    ],
                    'attr' => [
                        'placeholder' => 'Name',
                        'class' => 'form-control'
                    ],
                    'row_attr' => [
                        'class' => 'mb-3 d-flex'
                    ]
                ]
            )
            ->add(
                'type_id',
                EnumType::class,
                [
                    'class' => UserTypeEnum::class,
                    'placeholder' => 'Choose an option',
                    'label' => 'User Type',
                    'label_attr' => [
                        'class' => 'col-sm-1 col-form-label'
                    ],
                    'attr' => [
                        'class' => 'form-select'
                    ],
                    'row_attr' => [
                        'class' => 'mb-3 d-flex'
                    ]
                ],
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

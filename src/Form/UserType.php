<?php
// src/Form/UserType.php
namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $basicThemeOptions = [
            'attr' =>
                [
                    'class' => 'form-control g-color-black g-bg-white g-bg-white--focus g-brd-gray-light-v4 g-brd-primary--hover rounded g-py-15 g-px-15'
                ],
            'label_attr' =>
                [
                    'class' => 'g-color-gray-dark-v2 g-font-weight-600 g-font-size-13'
                ]
            ];


        $builder
            ->add('username', TextType::class, $basicThemeOptions)
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options'  => [
                    'label' => 'Password',
                    'attr' =>
                        [
                            'class' => 'form-control g-color-black g-bg-white g-bg-white--focus g-brd-gray-light-v4 g-brd-primary--hover rounded g-py-15 g-px-15'
                        ],
                    'label_attr' =>
                        [
                            'class' => 'g-color-gray-dark-v2 g-font-weight-600 g-font-size-13'
                        ]
                ],
                'second_options' => [
                    'label' => 'Repeat Password',
                    'attr' =>
                        [
                            'class' => 'form-control g-color-black g-bg-white g-bg-white--focus g-brd-gray-light-v4 g-brd-primary--hover rounded g-py-15 g-px-15'
                        ],
                    'label_attr' =>
                        [
                            'class' => 'g-color-gray-dark-v2 g-font-weight-600 g-font-size-13'
                        ]

                ]
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-md u-btn-primary rounded g-py-13 g-px-25'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => User::class
        ));
    }
}
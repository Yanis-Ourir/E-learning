<?php

namespace App\Form;

use App\Entity\Exercice;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ExerciceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('category', ChoiceType::class, [
                'choices' => [
                    'HTML' => 'HTML',
                    'CSS' => 'CSS',
                    'Javascript' => 'Javascript',
                ],
                'attr' => [
                    'class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 
                                block w-full p-2.5',
                ],
                'label' => 'Langage de l\'exercice',
                'label_attr' => [
                    'class' => 'block mb-2 text-2xl font-medium text-gray-900 dark:text-white',
                ],
            ])

            ->add('title', TextType::class, [
                'attr' => [
                    'class' => 'p-2 bg-gray-900 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full placeholder-gray-400',
                ],
                'label' => 'Titre de l\'exercice',
                'label_attr' => [
                    'class' => 'block mb-2 text-2xl font-medium text-gray-900 dark:text-white mt-4'
                ],
            ])

            ->add('statement', TextType::class,[
            'attr' => [
                'class' => 'p-2 bg-gray-900 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full placeholder-gray-400',
            ],
            'label' => 'Consignes de l\'exercice',
            'label_attr' => [ 
                'class' => 'block mb-2 text-2xl font-medium text-gray-900 dark:text-white mt-4'
            ],
            ])

            ->add('description', TextType::class,[
            'attr' => [
                'class' => 'p-2 bg-gray-900 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full placeholder-gray-400',
            ],
            'label' => 'Description de l\'exercice',
            'label_attr' => [
                'class' => 'block mb-2 text-2xl font-medium text-gray-900 dark:text-white mt-4'
            ],
            ])

            ->add('codepen_exercice', TextType::class,[
            'attr' => [
                'class' => 'p-2 bg-gray-900 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full placeholder-gray-400',
            ],
            'label' => 'Lien de l\'exercice',
            'label_attr' => [
                'class' => 'block mb-2 text-2xl font-medium text-gray-900 dark:text-white mt-4'
            ],
            ])
            ->add('codepen_link', TextType::class,[
            'attr' => [
                'class' => 'p-2 bg-gray-900 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full placeholder-gray-400',
            ],
            'label' => 'Lien du codepen',
            'label_attr' => [
                'class' => 'block mb-2 text-2xl font-medium text-gray-900 dark:text-white mt-4'
            ],
            ])
            ->add('difficulty', TextType::class, [
                'attr' => [
                    'class' => 'p-2 bg-gray-900 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full placeholder-gray-400',
                ],
                'label' => 'Difficulté de l\'exercice',
                'label_attr' => [
                    'class' => 'block mb-2 text-2xl font-medium text-gray-900 dark:text-white mt-4'
                ],
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'w-1/2 m-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800',
                ],
                'label' => "Nouveau Exercice"
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Exercice::class,
        ]);
    }
}

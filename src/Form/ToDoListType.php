<?php

namespace App\Form;

use App\Entity\ToDoList;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints as Assert;

class ToDoListType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('name', TextType::class, [
            'attr' => [
                'class' => 'p-2 bg-gray-900 text-sm 
                focus:ring-blue-500 focus:border-blue-500 block w-max placeholder-gray-400 
                text-white mb-4',
                'minlength' => '2',
                'maxlength' => '180'
            ],
            'label' => 'Nom de votre liste',
            'label_attr' => [
                'class' => 'block mb-2 text-sm font-medium text-white',
            ],
            'constraints' => [
                new Assert\NotBlank(),
                new Assert\Length(['min' => 2, 'max' => 180]),
            ]
            
        ])
        ->add('submit', SubmitType::class, [
            'attr' => [
                'class' => 'text-white hover:bg-blue-800 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800',
            ],
            'label' => "Nouvelle liste"
        ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ToDoList::class,
        ]);
    }
}

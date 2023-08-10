<?php

namespace App\Form;

use App\Entity\Profil;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints as Assert;

class ProfilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pseudo', TextType::class, [
                'attr' => [
                    'class' => 'p-2 bg-gray-900 text-sm 
                    focus:ring-blue-500 focus:border-blue-500 block w-full placeholder-gray-400 
                    text-white',
                    'minlength' => '2',
                    'maxlength' => '180'
                ],
                'label' => 'Pseudo',
                'label_attr' => [
                    'class' => 'block mb-2 text-sm font-medium text-white',
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length(['min' => 2, 'max' => 180]),
                ]
                
            ])
            ->add('profil_picture', FileType::class, [
                'attr' => [
                    'class' => 'block w-full text-sm border rounded-lg cursor-pointer text-gray-400 focus:outline-none bg-gray-700 mt-4 border-gray-600 placeholder-gray-400 id="file_input" type="file"',
                ],
                'label' => 'Image de profile',
                'label_attr' => [
                    'class' => 'block mb-2 text-sm font-medium text-white',
                ]
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'w-1/2 m-4  hover:bg-blue-800 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800',
                ],
                'label' => "Mettre à jour votre profil"
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Profil::class,
        ]);
    }
}

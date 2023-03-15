<?php

namespace App\Form;

use App\Entity\Contacts;
use App\Entity\Firms;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Regex;

class AddContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class,[

                'attr'=>[
                    'class'=>'form-control form-control-user',
                    'placeholder'=>'Prénom'
                ],
                'label'=>'Prénom',
            ])
            ->add('lastname',TextType::class,[
                'attr'=>[
                    'class'=>'form-control form-control-user',
                    'placeholder'=>'Nom'
                ],
                'label'=>'Prénom',
            ])
            ->add('email', EmailType::class,[
            'attr'=>[
        'class'=>'form-control form-control-user',
        'placeholder'=>'Addresse Email'
    ],
                'label'=>' ',
                'constraints' => [
        new Regex('/^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/',
            " Veuillez entrer une adresse email valide")
    ],])
            ->add('address', TextType::class,[
                'attr'=>[
                    'class'=>'form-control form-control-user',
                    'placeholder'=>'Addresse'
                ],
                'label'=>'Addresse',
            ])
            ->add('zipcode',TextType::class,[
                'attr'=>[
                    'class'=>'form-control form-control-user',
                    'placeholder'=>'Code Region'
                ],
                'label'=>'Code Region',
            ])
            ->add('country', TextType::class,[
                'attr'=>[
                    'class'=>'form-control form-control-user',
                    'placeholder'=>'Pays'
                ],
                'label'=>'Pays',
            ])
            ->add('number', TextType::class,[
                'attr'=>[
                    'class'=>'form-control form-control-user',
                    'placeholder'=>'Numéro de téléphone'
                ],
                'label'=>'Numéro de téléphone',
            ])


            ->add('id_firm', EntityType::class, [
                'class' => Firms::class,
                'choice_label'  => 'firm_name'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contacts::class,
        ]);
    }
}

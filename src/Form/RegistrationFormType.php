<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class,[
                'attr'=>[
                    'class'=>'form-control form-control-user',
                    'placeholder'=>'Prénom'
                ],
                'label'=>' ',
//                'constraints' => [
//                    new Regex('/d+/',
//                        " Les champs 'Nom' et 'Prénom' ne doivent contenir que des caractères alphabétiques")
//               ],
            ])
            ->add('lastname', TextType::class,[
                'attr'=>[
                    'class'=>'form-control form-control-user',
                    'placeholder'=>'Nom'
                ],
                'label'=>' ',
//                'constraints' => [
//                    new Regex('/D+/',
//                        " Ce champ ne doit contenir que des lettres et pas de caractère vide")
//                ],
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
                ],
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter les termes RGDP.',
                    ]),
                ],
                'label' => 'Mentions RGPD',
                'attr'=>[
                    'class'=>'form-control-label mx-2 mt-2',
                    'for'=>'form-check'
                    ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => [
                    'autocomplete' => 'new-password',
                    'class'=>'form-control form-control-user',
                    'placeholder'=>'Mot de Passe'
                ],
                'label'=>' ',
                'constraints' => [
                    new Regex('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
                    " Le mot de passe doit être valide")
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}

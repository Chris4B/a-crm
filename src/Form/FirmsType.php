<?php

namespace App\Form;

use App\Entity\Firms;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FirmsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firm_name', TextType::class, [
                'label' => 'Nom',
                'attr'=>[
                    'class'=>'form-control form-control-user',
                    'placeholder'=>'Nom de l\'entreprise'
                ],
            ])
            ->add('address', TextType::class, [
                'label' => 'Adresse',
                'attr'=>[
                    'class'=>'form-control form-control-user',
                    'placeholder'=>'Adresse de l\'entreprise'
                ],
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'attr'=>[
                    'class'=>'form-control form-control-user',
                    'placeholder'=>'Email de l\'entreprise'
                ],
            ])
            ->add('zip_code', TextType::class, [
                'label' => 'Code postal',
                'attr'=>[
                    'class'=>'form-control form-control-user',
                    'placeholder'=>'Code postal de l\'entreprise'
                ],
            ])
            ->add('phone_number', TextType::class, [
                'label' => 'Téléphone',
                'attr'=>[
                    'class'=>'form-control form-control-user',
                    'placeholder'=>'Numéro téléphone de l\'entreprise'
                ],
            ])
            ->add('siret', TextType::class, [
                'label' => 'Siret',
                'attr'=>[
                    'class'=>'form-control form-control-user',
                    'placeholder'=>'SIRET de l\'entreprise'
                ],
            ])
            ->add('country', TextType::class, [
                'label' => 'Pays',
                'attr'=>[
                    'class'=>'form-control form-control-user',
                    'placeholder'=>'Pays où est installé l\'entreprise'
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Firms::class,
        ]);
    }
}

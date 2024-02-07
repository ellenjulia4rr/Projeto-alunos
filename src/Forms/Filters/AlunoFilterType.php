<?php

namespace App\Forms\Filters;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class AlunoFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'required' => false,
                'attr' => ['class' => 'form-control-sm form-control', 'placeholder' => 'Nome']
            ])
            ->add('code', IntegerType::class, [
                'required' => false,
                'attr' => ['class' => 'form-control-sm form-control', 'placeholder' => 'Código']
            ])
            ->add('birthDate', DateType::class, [
                'required' => false,
                'attr' => ['class' => 'form-control-sm form-control', 'placeholder' => 'Data de Nascimento'],
            ])
            ->add('gender', ChoiceType::class, [
                'required' => false,
                'choices' => [
                    'Feminino' => 'FEMININO',
                    'Masculino' => 'MASCULINO',
                    'Outros' => 'OUTRO'
                ],
                'attr' => ['class' => 'form-control-sm form-control'],
                'placeholder' => 'Selecione um gênero'
            ])
            ->add('phone', TextType::class, [
                'required' => false,
                'attr' => ['class' => 'form-control-sm form-control', 'placeholder' => 'Telefone']
            ])
            ->add('email', TextType::class, [
                'required' => false,
                'attr' => ['class' => 'form-control-sm form-control', 'placeholder' => 'E-mail']
            ])
            ->add('creationDate', DateType::class, [
                'required' => false,
                'attr' => ['class' => 'form-control-sm form-control', 'placeholder' => 'Data de Criação']
            ])
       ;
    }
}
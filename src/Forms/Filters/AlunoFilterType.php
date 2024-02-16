<?php

namespace App\Forms\Filters;

use App\Entity\Curso;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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
                'attr' => ['class' => 'form-control-sm form-control', 'placeholder' => 'Nome'],
                'label' => 'Nome'
            ])
            ->add('code', IntegerType::class, [
                'required' => false,
                'attr' => ['class' => 'form-control-sm form-control', 'placeholder' => 'Código'],
                'label' => 'Código'
            ])
            ->add('birthDate', DateType::class, [
                'widget' => 'single_text',
                'html5' => false,
                'required' => false,
                'attr' => ['class' => 'form-control-sm form-control dates js-datepicker', 'placeholder' => 'Data de Nascimento'],
                'label' => 'Data de Nascimento',
                'format' => 'dd/mm/yyyy',
            ])
            ->add('gender', ChoiceType::class, [
                'required' => false,
                'choices' => [
                    'Feminino' => 'FEMININO',
                    'Masculino' => 'MASCULINO',
                    'Outros' => 'OUTRO'
                ],
                'attr' => ['class' => 'form-control-sm form-control'],
                'placeholder' => 'Selecione um gênero',
                'label' => 'Gênero'
            ])
            ->add('phone', TextType::class, [
                'required' => false,
                'attr' => ['class' => 'form-control-sm form-control', 'placeholder' => 'Telefone'],
                'label' => 'Telefone'
            ])
            ->add('email', TextType::class, [
                'required' => false,
                'attr' => ['class' => 'form-control-sm form-control', 'placeholder' => 'E-mail'],
                'label' => 'E-mail'
            ])
            ->add('creationDate', DateType::class, [
                'widget' => 'single_text',
                'html5' => false,
                'required' => false,
                'attr' => ['class' => 'form-control-sm form-control dates js-datepicker', 'placeholder' => 'Data de Criação'],
                'label' => 'Data de Criação'
            ])
            ->add('cursos', EntityType::class, [
                'class' => Curso::class,
                'choice_label' => 'courseName',
                'multiple' => true,
                'required' => false,
                'attr' => ['class' => 'form-select'],
                'label' => 'Cursos',

            ])
       ;
    }
}
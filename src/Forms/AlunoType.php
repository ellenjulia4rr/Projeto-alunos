<?php

namespace App\Forms;

use App\Entity\Curso;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;


class AlunoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Digite o nome do aluno'],
                'label' => 'Nome Completo',
                'required' => true
            ])
            ->add('birthDate', DateType::class, [
                'widget' => 'single_text',
                'html5' => false,
                'label' => 'Data de Nascimento',
                'attr' => ['class' => 'form-control-sm form-control dates js-datepicker', 'placeholder' => 'Data de Nascimento'],
                'format' => 'dd/mm/yyyy'
            ])
            ->add('gender', ChoiceType::class, [
                'choices' => [
                    'Feminino' => 'FEMININO',
                    'Masculino' => 'MASCULINO',
                    'Outros' => 'OUTRO'
                ],
                'attr' => ['class' => 'form-control'],
                'label' => 'Gênero',
                'placeholder' => 'Selecione um gênero'
            ])
            ->add('phone', TextType::class,[
                'attr' => ['class' => 'form-control'],
                'label' => 'Telefone'
            ])
            ->add('email', TextType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'E-mail'
            ])
            ->add('cursos', EntityType::class, [
                'class' => Curso::class,
                'choice_label' => 'courseName',
                'multiple' => true,
                'required' => false,
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
        ;
    }
}
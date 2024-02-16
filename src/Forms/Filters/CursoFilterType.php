<?php

namespace App\Forms\Filters;

use App\Entity\Aluno;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class CursoFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'required' => false,
                'attr' => ['class' => 'form-control-sm form-control', 'placeholder' => 'Código ou nome'],
                'label' => 'Nome'
            ])
            ->add('modality', ChoiceType::class, [
                'required'=> false,
                'choices' => [
                    'Presencial' => 'PRESENCIAL',
                    'Online' => 'ONLINE'
                ],
                'attr' => ['class' => 'form-control-sm form-control'],
                'placeholder' => 'Modalidade',
                'label' => 'Modalidade'
            ])
            ->add('code', IntegerType::class, [
                'required' => false,
                'attr' => ['class' => 'form-control-sm form-control', 'placeholder' => 'Código'],
                'label' => 'Código'
            ])
            ->add('workload', IntegerType::class, [
                'required' => false,
                'attr' => ['class' => 'form-control-sm form-control', 'placeholder' => 'Carga Horária'],
                'label' => 'Carga Horária'
            ])
            ->add('alunos', EntityType::class, [
                'class' => Aluno::class,
                'choice_label' => 'name',
                'multiple' => true,
                'required' => false,
                'attr' => ['class' => 'form-control'],
                'label' => 'Alunos'
            ])
        ;
    }
}
<?php

namespace App\Forms;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class CursoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       $builder
           ->add('courseName', TextType::class, [
           'attr' => ['class' => 'form-control', 'placeholder' => 'Informe o nome do curso'],
                'label' => 'Curso',
            ])
           ->add('workload', IntegerType::class,[
               'attr' => ['class' => 'form-control', 'placeholder' => 'Informe  a carga horária'],
               'label' => 'Carga Horária',
           ])
           ->add('modality', ChoiceType::class, [
               'choices' => [
                   'Presencial' => 'PRESENCIAL',
                   'Online' => 'ONLINE',
               ],
               'attr' => ['class' => 'form-control'],
               'label' => 'Modalidade',
               'placeholder' => 'Selecione uma Modalidade'
           ])
       ;
    }
}
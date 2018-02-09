<?php


namespace App\Forms;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CalcForm
{

    public function buildForm(FormBuilderInterface $builder){

        $builder
            ->add('cb', NumberType::class, array('label' => 'Base liquid concentrate, mg/ml'))
            ->add('cn', NumberType::class, array('label' => 'Nicotine (booster) concentrate, mg/ml'))
            ->add('cv', NumberType::class, array('label' => 'Needed concentrate, mg/ml'))
            ->add('Vv', NumberType::class, array('label' => 'Needed volume, ml'))
            ->add('save', SubmitType::class, array('label' => 'Calculate this','attr' => array('class' => 'btn-primary')));

        return $builder->getForm();
    }

}
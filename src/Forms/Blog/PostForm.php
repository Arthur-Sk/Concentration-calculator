<?php


namespace App\Forms\Blog;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PostForm
{

    public function buildForm(FormBuilderInterface $builder){

        $builder
            ->add('title', null, array('label' => 'Title'))
            ->add('body', TextType::class, array('label' => 'Text'))
            ->add('username', TextType::class, array('label' => 'Name'))
            ->add('save', SubmitType::class, array('label' => 'Add post','attr' => array('class' => 'btn btn-primary btn-add')));

        return $builder->getForm();
    }

}
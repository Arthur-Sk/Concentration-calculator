<?php

namespace App\Controller;

use App\Entity\Calc;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

//use Symfony\Component\Cache\Adapter\PdoAdapter;

class DefController extends Controller
{
    /**
     * @Route("/", name="welcome")
     */


    public function index()
    {
        return $this->render('index.html.twig');
    }

    /**
     * @Route("/calc", name="calc")
     */

    public function new(Request $request)
    {
        // create a task and give it some dummy data for this example
        $task = new Calc();
        $task->setCb('0');
        $task->setCn('72');
        $task->setCv('6');
        $task->setVv('500');

        $form = $this->createFormBuilder($task)
            ->add('cb', TextType::class)
            ->add('cn', TextType::class)
            ->add('cv', TextType::class)
            ->add('Vv', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Calculate this'))
            ->getForm();

        return $this->render('calc/index.html.twig', array(
            'form' => $form->createView(),
        ));
    }

//    public function calcIndex()
//    {
//        return $this->render('calc/index.html.twig');
//    }

    /**
     * @Route("/blog", name="blog")
     */

    public function blogResponse() {
        return new Response('nothing here');
    }


}
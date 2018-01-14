<?php

namespace App\Controller;

use App\Entity\Calc;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
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

        $calc = new Calc();
        $calc->setCb('0');
        $calc->setCn('72');
        $calc->setCv('6');
        $calc->setVv('500');

        $calc_form = $this->createFormBuilder($calc)
            ->add('cb', NumberType::class, array('label' => 'Base liquid concentrate, mg/ml'))
            ->add('cn', NumberType::class, array('label' => 'Nicotine concentrate, mg/ml'))
            ->add('cv', NumberType::class, array('label' => 'Needed concentrate, mg/ml'))
            ->add('Vv', NumberType::class, array('label' => 'Needed volume, ml'))
            ->add('save', SubmitType::class, array('label' => 'Calculate this'))
            ->getForm();

        $calc_form->handleRequest($request);

        if ($calc_form->isSubmitted() && $calc_form->isValid()) {

            $values = $calc_form->getData();

            return $this->render('calc/index.html.twig', array(
                'calc_form' => $calc_form->createView(),
                'values' => $values,
                'Vn' => $calc->getVn($calc->getVv(),$calc->getCv(),$calc->getCb(),$calc->getCn()),
                'Vb' => $calc->getVb($calc->getVv(),$calc->getCv(),$calc->getCb(),$calc->getCn())
            ));
        }

        return $this->render('calc/index.html.twig', array(
            'calc_form' => $calc_form->createView(),
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
        return $this->render('blog/index.html.twig');
    }

}
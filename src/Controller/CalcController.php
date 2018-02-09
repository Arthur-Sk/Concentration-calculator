<?php

namespace App\Controller;

use App\Entity\Calc;
use App\Forms\CalcForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CalcController extends Controller
{
    /**
     * @Route("/", name="welcome")
     */


    public function index()
    {
        return $this->render('index.html.twig');
    }

    /**
     * @Route("/calc/", name="calc")
     */

    public function calc(Request $request)
    {

        $calc = new Calc();
        $calcForm = new CalcForm();
        $builder = $this->createFormBuilder($calc);
        $calcForm = $calcForm->buildForm($builder);
        $calcForm->handleRequest($request);

        if ($calcForm->isSubmitted() && $calcForm->isValid()) {

            $values = $calcForm->getData();

            if ($calc->getBaseConc()>$calc->getNicConc()){
                $calcForm->addError(new FormError('Nicotine concentrate must be greater than the base liquid concentrate'));
                return $this->render('calc/index.html.twig', array(
                    'calcForm' => $calcForm->createView(),
                ));
            }

            if ($calc->getFinalConc()>$calc->getNicConc() || $calc->getFinalConc()<$calc->getBaseConc()){
                $calcForm->addError(new FormError('Needed concentrate must be greater than the base liquid concentrate and less than the nicotine concentrate'));
                return $this->render('calc/index.html.twig', array(
                    'calcForm' => $calcForm->createView(),
                ));
            }

            return $this->render('calc/index.html.twig', array(
                'calcForm' => $calcForm->createView(),
                'values' => $values,
                'NicVol' => $calc->getNicVol($calc->getFinalVol(),$calc->getFinalConc(),$calc->getBaseConc(),$calc->getNicConc()),
                'BaseVol' => $calc->getBaseVol($calc->getFinalVol(),$calc->getFinalConc(),$calc->getBaseConc(),$calc->getNicConc())
            ));
        }

        return $this->render('calc/index.html.twig', array(
            'calcForm' => $calcForm->createView(),
        ));
    }
}
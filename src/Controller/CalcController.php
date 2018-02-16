<?php

namespace App\Controller;

use App\Entity\Calc;
use App\Forms\CalcForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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

    public function calcIndex(Request $request)
    {

        $calc = new Calc();
        $calcForm = new CalcForm();
        $builder = $this->createFormBuilder($calc);
        $calcForm = $calcForm->buildForm($builder);
        $calcForm->handleRequest($request);

        if ($calcForm->isSubmitted() && $calcForm->isValid()) {
            return $this->render('calc/index.html.twig', array(
                'calcForm' => $calcForm->createView(),
                'values' => $calcForm->getData(),
                'NicVol' => $calc->getNicVol($calc->getFinalVol(),$calc->getFinalConc(),$calc->getBaseConc(),$calc->getNicConc()),
                'BaseVol' => $calc->getBaseVol($calc->getFinalVol(),$calc->getFinalConc(),$calc->getBaseConc(),$calc->getNicConc())
            ));
        }


        return $this->render('calc/index.html.twig', array(
            'calcForm' => $calcForm->createView(),
            'formErrors' => $calcForm->getErrors()
        ));
    }
}
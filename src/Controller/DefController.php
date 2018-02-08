<?php

namespace App\Controller;

use App\Entity\Calc;
use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
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
     * @Route("/calc/", name="calc")
     */

    public function calc(Request $request)
    {

        $calc = new Calc();
        $calc->setCb('0');
        $calc->setCn('72');
        $calc->setCv('6');
        $calc->setVv('500');

        $calc_form = $this->createFormBuilder($calc)
            ->add('cb', NumberType::class, array('label' => 'Base liquid concentrate, mg/ml'))
            ->add('cn', NumberType::class, array('label' => 'Nicotine (booster) concentrate, mg/ml'))
            ->add('cv', NumberType::class, array('label' => 'Needed concentrate, mg/ml'))
            ->add('Vv', NumberType::class, array('label' => 'Needed volume, ml'))
            ->add('save', SubmitType::class, array('label' => 'Calculate this','attr' => array('class' => 'btn-primary')))
            ->getForm();

        $calc_form->handleRequest($request);

        if ($calc_form->isSubmitted() && $calc_form->isValid()) {

            $values = $calc_form->getData();

            if ($calc->getCb()>$calc->getCn()){
                $calc_form->addError(new FormError('Nicotine concentrate must be greater than the base liquid concentrate'));
                return $this->render('calc/index.html.twig', array(
                    'calc_form' => $calc_form->createView(),
                ));
            }

            if ($calc->getCv()>$calc->getCn() || $calc->getCv()<$calc->getCb()){
                $calc_form->addError(new FormError('Needed concentrate must be greater than the base liquid concentrate and less than the nicotine concentrate'));
                return $this->render('calc/index.html.twig', array(
                    'calc_form' => $calc_form->createView(),
                ));
            }

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

    /**
     * @Route("/blog/", name="blog")
     */

    public function blog(Request $request)
    {

        $post = new Post();
        $post->setTitle('test title');
        $post->setBody('test body');
        $post->setUsername('test username');


        $post_form= $this->createFormBuilder($post)
            ->add('title', TextType::class, array('label' => 'Title'))
            ->add('body', TextType::class, array('label' => 'Body'))
            ->add('username', TextType::class, array('label' => 'Name'))
            ->add('save', SubmitType::class, array('label' => 'Add post','attr' => array('class' => 'btn btn-primary')))
            ->getForm();

        $post_form->handleRequest($request);

        if ($post_form->isSubmitted() && $post_form->isValid()) {
            $post_values = $post_form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($post_values);
            $em->flush();
        }
        $post_values = $this->getDoctrine()
            ->getRepository(Post::class)
            ->findAll();
        return $this->render('blog/index.html.twig', array(
            'post_form' => $post_form->createView(),
            'post_values' => $post_values
            ));
    }


//    Show posts by id, test
    /**
     * @Route("/blog/del{id}", name="delete_post")
     */

    public function deletePost($id)
    {

        $em = $this->getDoctrine()->getManager();

        $post = $this->getDoctrine()
            ->getRepository(Post::class)
            ->findOneBy(array('id'=>$id));

        if (!$post) {
            throw $this->createNotFoundException(
                'No post found for id ' . $id
            );
        }

        $em->remove($post);
        $em->flush();

        return new Response('Success with id = '. $id);

    }
}
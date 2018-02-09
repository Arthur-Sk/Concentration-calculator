<?php

namespace App\Controller;

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

class BlogController extends Controller
{
   
    /**
     * @Route("/blog/", name="blog")
     */

    public function postForm(Request $request)
    {

        $post = new Post();

        $post_form= $this->createFormBuilder($post)
            ->add('title', null, array('label' => 'Title'))
            ->add('body', TextType::class, array('label' => 'Text'))
            ->add('username', TextType::class, array('label' => 'Name'))
            ->add('save', SubmitType::class, array('label' => 'Add post','attr' => array('class' => 'btn btn-primary btn-add')))
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
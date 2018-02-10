<?php

namespace App\Controller;

use App\Entity\Post;
use App\Forms\Blog\PostForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends Controller
{

    /**
     * @Route("/blog/", name="blog")
     */

//     Builds the post form

    public function postForm(Request $request)
    {

        $post = new Post();
        $postForm = new PostForm();
        $builder = $this->createFormBuilder($post);
        $postForm = $postForm->buildForm($builder);
        $postForm->handleRequest($request);

        if ($postForm->isSubmitted() && $postForm->isValid()) {
            $postValues = $postForm->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($postValues);
            $em->flush();
        }
        $postValues = $this->getDoctrine()
            ->getRepository(Post::class)
            ->findAll();
        return $this->render('blog/index.html.twig', array(
            'postForm' => $postForm->createView(),
            'postValues' => $postValues
        ));
    }


//    Delete posts by id
    /**
     * @Route("/blog/del{id}", name="deleteById")
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

        return new Response('',200);

    }

    //    Delete posts by id
    /**
     * @Route("/blog/edit{id}", name="editById")
     */

    public function updatePost($id)
    {

        $em = $this->getDoctrine()->getManager();
        $post = $em
            ->getRepository(Post::class)
            ->findOneBy(array('id'=>$id));

        if (!$post) {
            throw $this->createNotFoundException(
                'No post found for id ' . $id
            );
        };

        $title = $_GET['title'];
        $body = $_GET['body'];

        $post->setTitle($title);
        $post->setBody($body);

        $em->flush();

        return new Response('',200);

    }
}
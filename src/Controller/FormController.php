<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\PostType;
use App\Entity\Post;
use Symfony\Component\HttpFoundation\Request;
class FormController extends AbstractController
{
    /**
     * @Route("/form", name="form")
     */
    public function index(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
    	$post = $em->getRepository(Post::class)->findOneBy([
            'id'=> 2,
        ]);
    	$form = $this->createForm(PostType::class, $post, [
            'action' => $this->generateUrl('form'),
            
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
        
        }
            $em->remove($post);
            $em->flush();
        return $this->render('form/index.html.twig', [
            'controller_name' => 'FormController',
            'post_form' => $form->createView(),
        ]);
    }
}

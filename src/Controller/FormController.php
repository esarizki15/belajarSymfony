<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\PostType;
use App\Entity\Post;
use Symfony\Component\HttpFoundation\Request;
use App\Services\Fetcher;
use App\Services\Paginator;

class FormController extends AbstractController
{
    /**
     * @Route("/form", name="form")
     */
    public function index(Request $request)
    {
     //    $em = $this->getDoctrine()->getManager();
    	// $post = $em->getRepository(Post::class)->findOneBy([
     //        'id'=> 2,
     //    ]);
    	// $form = $this->createForm(PostType::class, $post, [
     //        'action' => $this->generateUrl('form'),
            
     //    ]);

     //    $form->handleRequest($request);
     //    if ($form->isSubmitted() && $form->isValid()) {
        
     //    }
     //        $em->remove($post);
     //        $em->flush();
        return $this->render('form/index.html.twig', [
            'controller_name' => 'FormController',
            'post_form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/newpost", name="new_post")
     */
    public function newpost(Request $request, Fetcher $fetcher, Paginator $paginator)
    {
        //URL : https://api.coinmarketcap.com/v2/listings/



        $post = new Post();
        $form = $this->createForm(PostType::class, $post);

        $form->handleRequest($request);
        $image = 'f3d331740bad1e6ca1b89e822ee8fcba.jpeg';

        if ($form->isSubmitted() && $form->isValid()) {
            $uploads_directory = $this->getParameter('uploads_directory');
            
            $files = $request->files->get('post')['my_file'];
            foreach ($files as $file) {
                $filename = md5(uniqid()) . '.' . $file->guessExtension();
                $file->move(
                    $uploads_directory,
                    $filename
                );
                
            }

            // dd($files);
            // Save to DB
            $em = $this->getDoctrine()->getManager();
            // $em->persist($post);
            // $em->flush();
        }

        $result = $fetcher->get('https://api.coinmarketcap.com/v2/listings/');
        // $result = $fetcher->get('www.google.com');
        $partialArray = $paginator->getPartial($result['data'], 0, 15);


        return $this->render('form/index.html.twig', [
            'controller_name' => 'FormController',
            'post_form' => $form->createView(),
            'image' => $image,
            'partial_array' => $partialArray,
        ]);
    }

    /**
     * @Route("/showpost/{id}", name="show_post")
     */
    public function showPost(Request $request, Post $post){
        return $this->render('form/show_post.html.twig', [
            'post' => $post,
        ]);   
    }

}

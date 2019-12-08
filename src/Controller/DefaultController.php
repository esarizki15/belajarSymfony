<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Entity\Post;
/**
 * @Route("/home", name="home.")
 */
class DefaultController extends AbstractController
{
    /**
     * @Route("/default", name="default")
     */
    public function index()
    {
    	$coba = 11;
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'coba' => $coba
        ]);
    }

    /**
     * @Route("/lihat/{nama}", name="lihat")
     */

    public function lihat(Request $request, $nama)
    {
        $form = $this->createFormBuilder()
        ->add('fullname', TextType::class)
        ->getForm();

        $person = [
            'name' => 'Esa',
            'lastname' => 'Rizki',
            'age' => 22,
        ];

        $post = new Post();
        $post->setTitle("Overseas Media");
        $post->setDescription("Youtube Channel");
        $em = $this->getDoctrine()->getManager();
        $retrievedPost = $em->getRepository(Post::class)->findOneBy([
            'id'=>1,
        ]);
        // dd($retrievedPost);
        // $em->persist($post);
        // $em->flush();

        $em->remove($retrievedPost);
        $em->flush();

        return $this->render('default/tes.html.twig', [
            'controller_name' => 'DefaultController',
            // 'nama' => $nama,
            'person' => $person,
            'post' => $retrievedPost,
            'user_form' => $form->createView(),
        ]);
    }
}

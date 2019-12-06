<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;

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
        $person = [
            'name' => 'Esa',
            'lastname' => 'Rizki',
            'age' => 22,
        ];

        $form = $this->createFormBuilder()
        ->add('fullname', TextType::class)
        ->getForm();

        return $this->render('default/tes.html.twig', [
            'controller_name' => 'DefaultController',
            // 'nama' => $nama,
            'person' => $person,
            'user_form' => $form->createView(),
        ]);
    }
}

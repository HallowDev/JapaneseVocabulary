<?php

namespace App\Controller;

use App\Entity\Word;
use App\Form\WordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VocabularyController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->em = $entityManager;
    }

    #[Route('/vocabulary', name: 'app_vocabulary')]
    public function index(Request $request): Response
    {
        $word = new Word();
        $form = $this->createForm(WordType::class, $word);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($word);
            $this->em->flush();
            return $this->redirectToRoute('app_vocabulary');
        }


        return $this->render('vocabulary/index.html.twig', [
            'controller_name' => 'VocabularyController',
            'form' => $form,
        ]);
    }
}

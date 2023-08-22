<?php

namespace App\Controller;

use App\Entity\Word;
use App\Repository\WordRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RandomController extends AbstractController
{

    private $em;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->em = $entityManager;
    }

    #[Route('/random', name: 'app_random')]
    public function index(WordRepository $wordRepository): Response
    {
        $random = $wordRepository->findRandom();

        return $this->render('random/index.html.twig', [
            'controller_name' => 'RandomController',
            'random' => $random,
        ]);
    }
}

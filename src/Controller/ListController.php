<?php

namespace App\Controller;

use App\Entity\Word;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListController extends AbstractController
{

    private $em;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->em = $entityManager;
    }

    #[Route('/list', name: 'app_list')]
    public function index(): Response
    {
        $list = $this->em->getRepository(Word::class)->findAll();

        return $this->render('list/index.html.twig', [
            'controller_name' => 'ListController',
            'list' => $list,
        ]);
    }
}

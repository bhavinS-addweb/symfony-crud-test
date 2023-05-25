<?php

namespace App\Controller;

use App\Config\UserTypeEnum;
use App\Entity\Player;
use App\Form\PlayerType;
use App\Repository\PlayerRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/player')]
class PlayerController extends AbstractController
{
    #[Route('/', name: 'app_player_index', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('player/index.html.twig', [
            'players' => $userRepository->finaAllByUserType(UserTypeEnum::Player),
        ]);
    }

    #[Route('/{id}', name: 'app_player_show', methods: ['GET'])]
    public function show($id,UserRepository $userRepository): Response
    {
        return $this->render('player/show.html.twig', [
            'player' => $userRepository->find($id),
        ]);
    }
}

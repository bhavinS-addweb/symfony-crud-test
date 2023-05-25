<?php

namespace App\Controller;

use App\Config\UserTypeEnum;
use App\Form\ManagerAssignTeamType;
use App\Form\TeamType;
use App\Repository\TeamRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/manager')]
class ManagerController extends AbstractController
{
    #[Route('/', name: 'app_manager_index', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('manager/index.html.twig', [
            'managers' => $userRepository->finaAllByUserType(UserTypeEnum::Manager),
        ]);
    }

    #[Route('/{id}', name: 'app_manager_show', methods: ['GET'])]
    public function show($id,UserRepository $userRepository): Response
    {
        return $this->render('manager/show.html.twig', [
            'manager' => $userRepository->find($id),
        ]);
    }

    #[Route('/{id}/edit', name: 'app_manager_edit', methods: ['GET','POST'])]
    public function edit($id,UserRepository $userRepository,TeamRepository $teamRepository,Request $request): Response
    {
        $user = $userRepository->find($id);
        $form = $this->createForm(ManagerAssignTeamType::class,$user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dump($request);
        }

        return $this->renderForm('manager/edit.html.twig', [
            'player' => $userRepository->find($id),
            'form' => $form
        ]);
    }
}

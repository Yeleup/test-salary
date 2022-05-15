<?php

namespace App\Controller;

use App\Repository\SalaryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SalaryController extends AbstractController
{
    #[Route('/salary', name: 'app_salary', methods: ['GET'])]
    public function index(SalaryRepository $salaryRepository): Response
    {
        return $this->render('salary/index.html.twig', [
            'salaries' => $salaryRepository->findAll(),
        ]);
    }
}

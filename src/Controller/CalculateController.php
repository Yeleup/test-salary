<?php

namespace App\Controller;

use App\Entity\Calculate;
use App\Form\CalculateType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Calculate as ServiceCalculate;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/calculate')]
class CalculateController extends AbstractController
{
    #[Route('/', name: 'app_calculate_index', methods: ['GET'])]
    public function index()
    {
        return $this->renderForm('calculate/index.html.twig');
    }

    #[Route('/calculate', name: 'app_calculate_calculate', methods: ['GET'])]
    public function calculate(Request $request, ServiceCalculate $serviceCalculate, SerializerInterface $serializer): Response
    {
        $calculate = new Calculate();

        $form = $this->createForm(CalculateType::class, $calculate, [
            'method' => 'GET'
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $salary = $serviceCalculate->calculate($calculate, 'GET');

            return JsonResponse::fromJsonString($serializer->serialize($salary, 'json'));
        }

        return $this->renderForm('calculate/new.html.twig', [
            'title' => 'Калькуляция',
            'calculate' => $calculate,
            'form' => $form,
        ]);
    }

    #[Route('/new', name: 'app_calculate_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ServiceCalculate $serviceCalculate): Response
    {
        $calculate = new Calculate();

        $form = $this->createForm(CalculateType::class, $calculate);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $serviceCalculate->calculate($calculate, 'POST');
            return $this->redirectToRoute('app_salary', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('calculate/new.html.twig', [
            'title' => 'Запись в БД',
            'calculate' => $calculate,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_calculate_show', methods: ['GET'])]
    public function show(Calculate $calculate): Response
    {
        return $this->render('calculate/show.html.twig', [
            'calculate' => $calculate,
        ]);
    }
}

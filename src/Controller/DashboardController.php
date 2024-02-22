<?php

namespace App\Controller;

use App\Entity\Curso;
use App\Repository\AlunoRepository;
use App\Repository\CursoRepository;
use Symfony\Bridge\Twig\Attribute\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/Dashboard')]
class DashboardController extends AbstractController
{
    #[Template('Dashboard/index.html')]
    #[Route('/index.html.twig', name: 'dashboard_index')]
    public function dashboard(CursoRepository $cursoRepository, AlunoRepository $alunoRepository): Response
    {
        $cursoMaisRealizados = $cursoRepository->findCursosMaisRealizados();
        $totalCursos = $cursoRepository->countTotalCursos();
        $totalAlunos = $alunoRepository->countTotalAlunos();


        return $this->render('Dashboard/index.html.twig', [
            'cursosMaisRealizados' => $cursoMaisRealizados,
            'totalCursos' => $totalCursos,
            'totalAlunos' => $totalAlunos
        ]);
    }
}
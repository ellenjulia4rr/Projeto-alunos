<?php

namespace App\Controller;

use App\Entity\Curso;
use App\Filters\CursoFilter;
use App\Forms\CursoType;
use App\Forms\Filters\CursoFilterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Attribute\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/cursos')]
class CursoController extends AbstractController
{
    #[Template('Curso/index.html.twig')]
    #[Route('/', name: 'cursos_index')]
    public function indexAction(EntityManagerInterface $em, Request $request): array
    {
        $filter = new CursoFilter();
        $form = $this->createForm(CursoFilterType::class, $filter);
        $form->handleRequest($request);
//        die(dump(json_encode($request->request->all())));
        $cursos = $em->getRepository(Curso::class)->getCursosByFilter($filter);
        return [
            'cursos' => $cursos,
            'form' => $form->createView()
            ];
    }

    #[Template('Curso/new.html.twig')]
    #[Route('/new', name: 'curso_create')]
    public function newAction(EntityManagerInterface  $em, Request $request) : array | RedirectResponse
    {
        $novoCurso = new Curso();

        $form = $this->createForm(CursoType::class, $novoCurso);
        $form-> handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($novoCurso);
            $em->flush();

            return $this->redirectToRoute('cursos_index');
        }

        return [
            'form' => $form->createView()
        ];
    }
    #[Template('Curso/edit.html.twig')]
    #[Route('/{curso}/edit', name: 'cursos_edit')]
    public function editAction(EntityManagerInterface $em, Request $request, Curso $curso) : array | RedirectResponse
    {
        $form = $this->createForm(CursoType::class, $curso);
        $form-> handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($curso);
            $em->flush();

            return $this->redirectToRoute('cursos_index');
        }

        return [
            'form' => $form->createView()
        ];
    }

    #[Template('Curso/new.html.twig')]
    #[Route('/{curso}/delete', name: 'curso_delete')]
    public function deleteAction(EntityManagerInterface $em, Curso $curso) : Response
    {
        $em->remove($curso);
        $em->flush();

        return $this->redirectToRoute('cursos_index');
    }
}
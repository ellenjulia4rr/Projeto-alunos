<?php

namespace App\Controller;

use App\Entity\Curso;
use App\Filters\CursoFilter;
use App\Forms\CursoType;
use App\Forms\Filters\CursoFilterType;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
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
    public function indexAction(EntityManagerInterface $em, Request $request, PaginatorInterface $paginator): array
    {
        $menssagem = null;
        try {
            $filter = new CursoFilter();
            $form = $this->createForm(CursoFilterType::class, $filter);
            $form->handleRequest($request);

            $cursos = $em->getRepository(Curso::class)->getCursosByFilter($filter);
            $countCursos = $em->getRepository(Curso::class)->getCountCursosByFilter($filter);

            $pagination = $paginator->paginate(
                $cursos,
                $request->query->getInt('page', 1),
                10
            );
        } catch (\Exception $exception) {
            $menssagem = "Ocorreu um erro ao tentar cadastrar um novo curso.";
        }


        return [
            'form' => $form->createView(),
            'contagem' => $countCursos[0]['qtde'],
            'pagination' => $pagination,
            ];
    }

    #[Template('Curso/new.html.twig')]
    #[Route('/new', name: 'curso_create')]
    public function newAction(EntityManagerInterface  $em, Request $request) : array | RedirectResponse
    {
        $menssagem = null;
        $novoCurso = new Curso();

        $form = $this->createForm(CursoType::class, $novoCurso);
        $form-> handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($novoCurso);
            $em->flush();
            $this->addFlash('success', 'Curso cadastrado com sucesso');

            return $this->redirectToRoute('cursos_index');
        }

        return [
            'form' => $form->createView(),
             'menssagem' => $menssagem
        ];
    }
    #[Template('Curso/edit.html.twig')]
    #[Route('/{curso}/edit', name: 'cursos_edit')]
    public function editAction(EntityManagerInterface $em, Request $request, Curso $curso) : array | RedirectResponse
    {
        $menssagem = null;
        $form = $this->createForm(CursoType::class, $curso);
        $form-> handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($curso);
            $em->flush();
            $this->addFlash('success', 'Curso editado com sucesso');

            return $this->redirectToRoute('cursos_index');
        }

        return [
            'form' => $form->createView(),
            'menssagem' => $menssagem
        ];
    }

    #[Template('Curso/new.html.twig')]
    #[Route('/{curso}/delete', name: 'curso_delete')]
    public function deleteAction(EntityManagerInterface $em, Curso $curso) : Response
    {
        $em->remove($curso);
        $em->flush();
        $this->addFlash('success', 'Curso excluído com sucesso');

        return $this->redirectToRoute('cursos_index');
    }
}
<?php

namespace App\Controller;

use App\Entity\Aluno;
use App\Filters\AlunoFilter;
use App\Forms\AlunoType;
use App\Forms\Filters\AlunoFilterType;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use SebastianBergmann\Diff\Exception;
use Symfony\Bridge\Twig\Attribute\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/alunos')]
class AlunoController extends AbstractController
{
    #[Template('Aluno/index.html.twig')]
    #[Route('/', name: 'alunos_index')]
    public function indexAction(EntityManagerInterface $em, Request $request, PaginatorInterface $paginator): array
    {
        $filter = new AlunoFilter();
        $form = $this->createForm(AlunoFilterType::class, $filter);
        $form->handleRequest($request);

        $alunos = $em->getRepository(Aluno::class)->getAlunosByFilter($filter);
        $countAlunos = $em->getRepository(Aluno::class)->getCountAlunosByFilter($filter);

        $pagination = $paginator->paginate(
            $alunos,
            $request->query->getInt('page', 1),
            10
        );

        return [
            'form' => $form->createView(),
            'contagem' => $countAlunos[0]['qtde'],
            'pagination' => $pagination,
        ];
    }

    #[Template('Aluno/new.html.twig')]
    #[Route('/new', name: 'alunos_create')]
    public function newAction(EntityManagerInterface $em, Request $request): array | RedirectResponse
    {
        $menssagem = null;
        try {
            $novoAluno = new Aluno();
            $novoAluno
                ->setRegistrationDate(new \DateTime());

            $form = $this->createForm(AlunoType::class, $novoAluno);
            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()) {
                $em->persist($novoAluno);
                $em->flush();
                $this->addFlash('success', 'Aluno cadastrado com sucesso');

                return $this->redirectToRoute('alunos_index');
            }

        } catch (\Exception $exception) {
            $menssagem = "Ocorreu um erro ao tentar cadastrar um novo aluno.";
        }

        return [
            'form' => $form->createView(),
            'menssagem' => $menssagem
        ];
    }

    #[Template('Aluno/edit.html.twig')]
    #[Route('/{id}', name: 'alunos_edit')]
    public function editAction(EntityManagerInterface $em, Request $request, $id): array | RedirectResponse
    {
        $menssagem = null;
        $aluno = $em->getRepository(Aluno::class)->find($id);
        $aluno
        ->setRegistrationDate(new \DateTime());

        $form = $this->createForm(AlunoType::class, $aluno);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em->persist($aluno);
            $em->flush();
            $this->addFlash('success', 'Aluno editado com sucesso');

            return $this->redirectToRoute('alunos_index');
        }

        return [
            'form' => $form->createView(),
            'menssagem' => $menssagem
        ];
    }

    #[Template('Aluno/new.html.twig')]
    #[Route('/{aluno}/delete', name: 'alunos_confirm_delete')]
    public function deleteAction(EntityManagerInterface $em, Aluno $aluno): Response
    {
        $em->remove($aluno);
        $em->flush();
        $this->addFlash('success', 'Aluno excluído com sucesso');

        return $this->redirectToRoute('alunos_index');
    }
}
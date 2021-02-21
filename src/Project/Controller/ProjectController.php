<?php

declare(strict_types=1);

namespace App\Project\Controller;

use App\Issue\Repository\IssueRepositoryInterface;
use App\Project\Form\Data\ProjectData;
use App\Project\Form\Type\ProjectType;
use App\Project\Message\CreateProject;
use App\Project\Message\UpdateProject;
use App\Project\Repository\ProjectRepositoryInterface;
use App\Shared\Controller\AbstractController;
use App\Shared\Exception\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class ProjectController extends AbstractController
{
    private ProjectRepositoryInterface $projectRepository;
    private IssueRepositoryInterface $issueRepository;

    public function __construct(ProjectRepositoryInterface $projectRepository, IssueRepositoryInterface $issueRepository)
    {
        $this->projectRepository = $projectRepository;
        $this->issueRepository = $issueRepository;
    }

    #[Route('/projects', name: 'projects.index', methods: ['GET'])]
    public function index(): Response
    {
        $projects = $this->projectRepository->all();

        return $this->render('project/index.html.twig', [
            'projects' => $projects,
        ]);
    }

    #[Route('/projects/create', name: 'projects.create', methods: ['GET', 'POST'])]
    public function create(Request $request): Response
    {
        $form = $this->createForm(ProjectType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $this->dispatchMessage(new CreateProject(
                name: $data->name,
                description: $data->description,
            ));

            return $this->redirectToRoute('projects.index');
        }

        return $this->render('project/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/projects/{slug}', name: 'projects.show', methods: ['GET'])]
    public function show(Request $request): Response
    {
        try {
            $project = $this->projectRepository->getBySlug($request->attributes->get('slug'));
        } catch (ModelNotFoundException) {
            throw new NotFoundHttpException();
        }

        $issues = $this->issueRepository->getByProjectId($project->getId());

        return $this->render('project/show.html.twig', [
            'project' => $project,
            'issues' => $issues,
        ]);
    }

    #[Route('/projects/{slug}/edit', name: 'projects.edit', methods: ['GET', 'POST'])]
    public function edit(Request $request): Response
    {
        try {
            $project = $this->projectRepository->getBySlug($request->attributes->get('slug'));
        } catch (ModelNotFoundException) {
            throw new NotFoundHttpException();
        }

        $form = $this->createForm(ProjectType::class, ProjectData::createFromProject($project));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $this->dispatchMessage(new UpdateProject(
                projectId: $project->getId(),
                name: $data->name,
                description: $data->description,
            ));

            return $this->redirectToRoute('projects.index');
        }

        return $this->render('project/edit.html.twig', [
            'form' => $form->createView(),
            'project' => $project,
        ]);
    }
}
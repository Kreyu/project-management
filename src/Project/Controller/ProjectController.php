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

/**
 * TODO: refactor into multiple single action controllers (maybe?)
 */
class ProjectController extends AbstractController
{
    private ProjectRepositoryInterface $projectRepository;
    private IssueRepositoryInterface $issueRepository;

    public function __construct(
        ProjectRepositoryInterface $projectRepository,
        IssueRepositoryInterface $issueRepository
    ) {
        $this->projectRepository = $projectRepository;
        $this->issueRepository = $issueRepository;
    }

    public function index(Request $request): Response
    {
        $page = $request->query->getInt('page', 1);
        $perPage = $request->query->getInt('per_page', 25);

        if ($perPage < 1 || $perPage > 50) {
            $perPage = 25;
        }

        $paginator = $this->projectRepository->paginate($page, $perPage);

        return $this->render('project/index.html.twig', [
            'paginator' => $paginator,
        ]);
    }

    public function create(Request $request): Response
    {
        $form = $this->createForm(ProjectType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $this->dispatchMessage(CreateProject::createFromProjectData($data));

            return $this->redirectToRoute('projects_index');
        }

        return $this->render('project/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

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

            $this->dispatchMessage(
                UpdateProject::createFromProjectData($data, $project->getId())
            );

            return $this->redirectToRoute('projects_index');
        }

        return $this->render('project/edit.html.twig', [
            'form' => $form->createView(),
            'project' => $project,
        ]);
    }
}
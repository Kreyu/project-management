<?php

declare(strict_types=1);

namespace App\Issue\Controller;

use App\Issue\Repository\IssueRepositoryInterface;
use App\Project\Repository\ProjectRepositoryInterface;
use App\Shared\Controller\AbstractController;
use App\Shared\Exception\ModelNotFoundException;
use App\Task\Repository\TaskRepositoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Uid\Uuid;

/**
 * TODO: refactor into multiple single action controllers (maybe?)
 */
class IssueController extends AbstractController
{
    private IssueRepositoryInterface $issueRepository;
    private ProjectRepositoryInterface $projectRepository;

    public function __construct(
        IssueRepositoryInterface $issueRepository,
        ProjectRepositoryInterface $projectRepository,
    ) {
        $this->issueRepository = $issueRepository;
        $this->projectRepository = $projectRepository;
    }

    public function index(Request $request): Response
    {
        try {
            $project = $this->projectRepository->getBySlug($request->attributes->get('slug'));
        } catch (ModelNotFoundException) {
            throw new NotFoundHttpException();
        }

        $issues = $this->issueRepository->getByProjectId($project->getId());

        return $this->render('issue/index.html.twig', [
            'project' => $project,
            'issues' => $issues,
        ]);
    }

    public function show(Request $request): Response
    {
        try {
            $issue = $this->issueRepository->get(Uuid::fromString($request->attributes->get('id')));
        } catch (ModelNotFoundException) {
            throw new NotFoundHttpException();
        }

        return $this->render('issue/show.html.twig', [
            'issue' => $issue,
        ]);
    }

    public function create()
    {
        
    }

    public function edit()
    {
        
    }
}
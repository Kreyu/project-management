<?php

declare(strict_types=1);

namespace App\Issue\Controller;

use App\Issue\Repository\IssueRepositoryInterface;
use App\Project\Repository\ProjectRepositoryInterface;
use App\Shared\Controller\AbstractController;
use App\Shared\Exception\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
}
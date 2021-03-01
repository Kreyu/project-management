<?php

declare(strict_types=1);

namespace App\Settings\Controller;

use App\Issue\Repository\IssuePriorityRepositoryInterface;
use App\Issue\Repository\IssueStatusRepositoryInterface;
use App\Shared\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class SettingsController extends AbstractController
{
    private IssuePriorityRepositoryInterface $issuePriorityRepository;
    private IssueStatusRepositoryInterface $issueStatusRepository;

    public function __construct(
        IssuePriorityRepositoryInterface $issuePriorityRepository,
        IssueStatusRepositoryInterface $issueStatusRepository,
    ) {
        $this->issuePriorityRepository = $issuePriorityRepository;
        $this->issueStatusRepository = $issueStatusRepository;
    }

    public function issuePriorities(): Response
    {
        return $this->render('settings/issue_priorities.html.twig', [
            'priorities' => $this->issuePriorityRepository->all(),
        ]);
    }

    public function issueStatuses(): Response
    {
        return $this->render('settings/issue_statuses.html.twig', [
            'statuses' => $this->issueStatusRepository->all(),
        ]);
    }
}
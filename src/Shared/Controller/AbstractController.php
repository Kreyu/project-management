<?php

declare(strict_types=1);

namespace App\Shared\Controller;

use App\Shared\View\ViewRendererInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Contracts\Service\Attribute\Required;

abstract class AbstractController
{
    private ViewRendererInterface $viewRenderer;
    private UrlGeneratorInterface $urlGenerator;
    private FormFactoryInterface $formFactory;
    private MessageBusInterface $messageBus;

    #[Required]
    public function setViewRenderer(ViewRendererInterface $viewRenderer): void
    {
        $this->viewRenderer = $viewRenderer;
    }

    #[Required]
    public function setUrlGenerator(UrlGeneratorInterface $urlGenerator): void
    {
        $this->urlGenerator = $urlGenerator;
    }

    #[Required]
    public function setFormFactory(FormFactoryInterface $formFactory): void
    {
        $this->formFactory = $formFactory;
    }

    #[Required]
    public function setMessageBus(MessageBusInterface $messageBus): void
    {
        $this->messageBus = $messageBus;
    }

    protected function render(string $template, array $context = []): Response
    {
        if (!isset($this->viewRenderer)) {
            throw new \LogicException('You have to provide view renderer using the setter injection.');
        }

        return new Response($this->viewRenderer->render($template, $context));
    }

    protected function generateUrl(string $routeName, array $parameters = []): string
    {
        if (!isset($this->urlGenerator)) {
            throw new \LogicException('You have to provide url generator using the setter injection.');
        }

        return $this->urlGenerator->generate($routeName, $parameters);
    }

    protected function createForm(string $type, mixed $data = null, array $options = []): FormInterface
    {
        if (!isset($this->formFactory)) {
            throw new \LogicException('You have to provide form factory using the setter injection.');
        }

        return $this->formFactory->create($type, $data, $options);
    }

    protected function dispatchMessage(object $message, array $stamps = []): void
    {
        if (!isset($this->messageBus)) {
            throw new \LogicException('You have to provide message bus using the setter injection.');
        }

        $this->messageBus->dispatch($message, $stamps);
    }

    protected function redirectToRoute(string $routeName, array $parameters = []): RedirectResponse
    {
        return new RedirectResponse($this->generateUrl($routeName, $parameters));
    }
}
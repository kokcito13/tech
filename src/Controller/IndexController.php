<?php

namespace App\Controller;

use App\Dto\Command;
use App\Event\ApplyEvent;
use App\Form\ApplyType;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;
use Twig\Environment;

final class IndexController
{
    /**
     * @Route("", name="homepage")
     */
    public function __invoke(
        Request $request,
        Environment $twig,
        FormFactoryInterface $formFactory,
        UrlGeneratorInterface $urlGenerator,
        EventDispatcherInterface $eventDispatcher
    ): Response {

        $form = $formFactory->create(ApplyType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $eventDispatcher->dispatch(new ApplyEvent($form->getData()));

            return new RedirectResponse(
                $urlGenerator->generate('homepage')
            );
        }

        return new Response(
            $twig->render("pages/index.html.twig", [
                'form' => $form->createView()
            ])
        );
    }

}

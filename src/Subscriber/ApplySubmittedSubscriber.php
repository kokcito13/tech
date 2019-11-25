<?php

namespace App\Subscriber;

use App\Event\ApplyEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Twig\Environment;

final class ApplySubmittedSubscriber implements EventSubscriberInterface
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;
    /**
     * @var Environment
     */
    private $environment;

    public function __construct(\Swift_Mailer $mailer, Environment $environment)
    {
        $this->mailer = $mailer;
        $this->environment = $environment;
    }

    public static function getSubscribedEvents()
    {
        return [
            ApplyEvent::class => "onSubmitted"
        ];
    }

    public function onSubmitted(ApplyEvent $applyEvent)
    {
        $command = $applyEvent->getCommand();

        $message = (new \Swift_Message('Hello Email'))
            ->setFrom('send@example.com')
            ->setTo('recipient@example.com')
            ->setBody(
                $this->environment->render(
                    'emails/submitted.html.twig',
                    ['command' => $command]
                ),
                'text/html'
            )

        ;

        $this->mailer->send($message);
    }
}
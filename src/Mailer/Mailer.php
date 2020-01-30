<?php

namespace GlobeGroup\MailerBundle\Mailer;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @author Mateusz Kaczmarek <mateusz.kaczmarek@globegroup.pl>
 */
abstract class Mailer
{
    /** @var MailerInterface */
    protected $mailer;

    /** @var MailerParameters */
    protected $parameters;

    /** @var TranslatorInterface */
    protected $translator;

    public function __construct(
        MailerInterface $mailer,
        MailerParameters $mailerParameters,
        TranslatorInterface $translator
    ) {
        $this->mailer = $mailer;
        $this->parameters = $mailerParameters;
        $this->translator = $translator;
    }

    protected function addBasicVariables($variables): array
    {
        $appVariables = [
            'ngHostWithScheme' => $this->parameters->getNgHostWithScheme(),
            'apiHostWithScheme' => $this->parameters->getApiHostWithScheme(),
        ];

        return array_merge($appVariables, $variables);
    }

    protected function getTemplatedEmail(): TemplatedEmail
    {
        $email = new TemplatedEmail();
        $email
            ->from($this->parameters->getFromEmail())
            ->addReplyTo($this->parameters->getNoReplyEmail())
        ;

        return $email;
    }

    protected function getTranslatedSubject(string $id): string
    {
        return $this->translator->trans($id, [], 'emails');
    }
}

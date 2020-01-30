<?php

namespace GlobeGroup\MailerBundle\Mailer;

use UnexpectedValueException;

/**
 * @author Mateusz Kaczmarek <mateusz.kaczmarek@globegroup.pl>
 */
class MailerParameters
{
    /** @var string */
    private $fromEmail;

    /** @var string */
    private $noReplyEmail;

    /** @var string */
    private $apiHostWithScheme;

    /** @var string */
    private $ngHostWithScheme;

    public function __construct(array $parameters)
    {
        if (null === $parameters['fromEmail']) {
            throw new UnexpectedValueException('Define parameter fromEmail for mailer.');
        }
        $this->fromEmail = $parameters['fromEmail'];

        $this->noReplyEmail = $parameters['noReplyEmail'] ?? $this->fromEmail;

        if (null === $parameters['apiHostWithScheme']) {
            throw new UnexpectedValueException('');
        }
        $this->apiHostWithScheme = $parameters['apiHostWithScheme'];

        if (null === $parameters['ngHostWithScheme']) {
            throw new UnexpectedValueException('Define parameter ngHostWithScheme for mailer.');
        }
        $this->ngHostWithScheme = $parameters['ngHostWithScheme'];
    }

    public function getFromEmail(): string
    {
        return $this->fromEmail;
    }

    public function getNoReplyEmail(): string
    {
        return $this->noReplyEmail;
    }

    public function getApiHostWithScheme(): string
    {
        return $this->apiHostWithScheme;
    }

    public function getNgHostWithScheme(): string
    {
        return $this->ngHostWithScheme;
    }
}

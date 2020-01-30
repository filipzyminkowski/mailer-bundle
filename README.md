GlobeGroup Mailer
=============

Features included:

- Configuration with .env.local for NG and API host, 

Installation
------------
<a name="installation" />

1.  [symfony/mailer](https://github.com/symfony/mailer) is required in version 4.4.*
1.  Execute command:
    ```
    composer require globegroup/emaillabs-mailer
    ```
1.  In `.env.local` use the configuration listed below:
    ```dotenv
    API_HOST=api.globegroup.test
    API_SCHEME=http
    NG_HOST=globegroup.test
    NG_SCHEME=http
    FROM_EMAIL=test@globegroup.test
    NO_REPLY_EMAIL=test@globegroup.test
    ### konfiguracja API oraz frontendu ###
    ```
1.  Also remember to configure `MAILER_DSN` from [symfony/mailer](https://github.com/symfony/mailer).

LOCAL TESTING
------------
<a name="local-testing" />

1.  Clone repository into `symfony/localVendor` folder.
1.  Add into composer.json:
    ```json
    "repositories": [
        {
            "type": "path",
            "url": "localVendor/globegroup-emaillabs-mailer"
        }
    ],
    ```
1.  Check if `minimum-stability` is set to `dev`.
1.  Proceed to [Installation](#installation).

USAGE
------------
<a name="usage" />

1.  Create class `App\Mailer\TestMailer`:
    ```php
    <?php
    
    namespace App\Mailer;
    
    use GlobeGroup\MailerBundle\Mailer\Mailer;
    
    class TestMailer extends Mailer
    {
    
    }
    ```
1.  Create method which will be sending email or emails.
    ```php
    public function sendMessage(User $user): void
    {
        $this->setVariables([
            'user' => $user,
        ]);

        $email = $this->getTemplatedEmail()
            ->subject($this->getTranslatedSubject('authorization.subject'))
            ->htmlTemplate('emails/authorization.html.twig')
            ->addTo($user->getEmail())
            ->context($this->getVariables())
        ;

        $this->mailer->send($email);
    }
    ```
1.  `$variables` is an array which are passed to Twig email template. 
    
    Also there are two variables which are passed by default by method `$this->addBasicVariables($variables)`:
    ```twig
    {{ ngHostWithScheme }} = link with http/https to frontend 
    {{ apiHostWithScheme }} = link with http/https to backend
    ```
1.  If you need to pass extra configuration variables like url you can use dependency injection:
    ```php
    <?php
    
    namespace App\Mailer;
    
    use GlobeGroup\MailerBundle\Mailer\Mailer;
    use GlobeGroup\MailerBundle\Mailer\MailerParameters;
    use Symfony\Component\Mailer\MailerInterface;
    use Symfony\Contracts\Translation\TranslatorInterface;
    
    class AuthorizationMailer extends Mailer
    {
        /** @var string $link */
        private $link;
    
        public function __construct(
            MailerInterface $mailer,
            MailerParameters $mailerParameters,
            TranslatorInterface $translator,
            string $link
        ) {
            parent::__construct($mailer, $mailerParameters, $translator);
    
            $this->link = $link;
        }
    }
    ```
1.  And in `services.yaml` you need to pass values:
    ```yaml
    
    parameters:
        link: '%ngHostWithScheme%/link'
    
    services:
    
        [...]
    
        App\Mailer\AuthorizationMailer:
            $link: '%link%'

    ```
1.  Variables `%ngHostWithScheme%` and `%apiHostWithScheme%` are configured inside bundle.
1.  When setting array of template variables use method `$this->setVariables([])`;
1.  When passing variables into email template use method `$this->getVariables()`;

License
-------

This bundle is under the MIT license. See the complete [LICENSE](LICENSE)

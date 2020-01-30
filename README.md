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

License
-------

This bundle is under the MIT license. See the complete [LICENSE](LICENSE)

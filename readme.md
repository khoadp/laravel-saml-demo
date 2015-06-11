Saml Laravel Demo
=================

This is a demo of saml login using Laravel Framework

----------
**Requirements**
Php 5.4+


----------
**I/ Saml login using 3rd party Service Provider**
* Prepare:
- Create account on ssocircle.com (free IDP for testing)
- Create account on auth0.com (SP - only free for developer testing)
There is a tutorial for setup auth0 to work with ssocircle at: https://auth0.com/docs/saml/identity-providers/ssocircle


----------
**II/ Saml login using simplsamlphp library as SP**

+Create account on ssocircle.com
+Download simplesamlphp

Simplesamlphp source package has 2 section: 
+ Service provide: *located at www directory of source package*
+ The rest of library

**Installation**

1/Setup SP
+ Move Service provider section to public directory of laravel project

Do some config at ***app/library/saml/config***
 + config.php: 

    'baseurlpath' => 'www/' //location of SP folder
    ...
    'auth.adminpassword' => 'your password admin here',
+ authsources.php:

 

      'default-sp' => array(
            'saml:SP',
            'entityID' => 'samlsample' ,
            'idp' => 'http://idp.ssocircle.com',
            'discoURL' => null,
            'certificate' => 'sample.crt', 
         )

Do some config for metadata at app/config/saml.php

    $metadata['http://idp.ssocircle.com'] = array(
    'name' => array(
        'en' => 'Circle SSO',
    ),
    'description'          => '',
    //ssocircle login url
    'SingleSignOnService'  => 'https://idp.ssocircle.com:443/sso/SSORedirect/metaAlias/ssocircle',
    //ssocircle logout url
    'SingleLogoutService'  => 'https://idp.ssocircle.com:443/sso/IDPSloRedirect/metaAlias/ssocircle',
    // fingerprint of ssocircle certificate
    'certFingerprint'      => '9F:08:98:77:0D:9F:09:48:C4:5B:F5:D6:DB:55:CB:03:7C:3B:28:0C',
    );

 these config get from soocircle metadata. The certFingerptint get by following command line:

     openssl x509 -noout -in ssocircle.pem -fingerprint
with ssocircle.pem is the certificate file created by *X509Certificate* section in ssocircle metadata xml file

Test to check if your SP work well by visiting this url: http://YOUR_DOMAIN/www/index.php

Your metadata stays here:
http://YOUR_DOMAIN/www/module.php/saml/sp/metadata.php/default-sp?output=xhtml

2/Setup IDP (ssocircle)
Login to ssocircle.com . Click on Manage metadata link on the left. fill infomation and save.

You can test if your SP is work well with IDP by visiting this URL:
http://YOUR_DOMAIN/www/module.php/core/authenticate.php
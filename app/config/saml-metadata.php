<?php
/**
 * Created by PhpStorm.
 * User: Khanh
 * Date: 11/6/2015
 * Time: 11:30 AM
 */
return array(
    'http://idp.ssocircle.com' => array(
        'name' => array(
            'en' => 'Circle SSO',
        ),
        'description'          => '',
        //ssocircle login url
        'SingleSignOnService'  => 'https://idp.ssocircle.com:443/sso/SSORedirect/metaAlias/ssocircle',
        //ssocircle logout url
        'SingleLogoutService'  => 'https://idp.ssocircle.com:443/sso/IDPSloRedirect/metaAlias/ssocircle',
        // fingerprint of ssocircle certificate

        'SingleSignOnIdpInitUrl' => 'https://idp.ssocircle.com/sso/idpssoinit?metaAlias=/ssocircle&spEntityID=samlsample',

        'certFingerprint'      => '9F:08:98:77:0D:9F:09:48:C4:5B:F5:D6:DB:55:CB:03:7C:3B:28:0C',
    )
);
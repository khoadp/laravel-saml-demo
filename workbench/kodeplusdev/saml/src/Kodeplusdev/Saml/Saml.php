<?php
/**
 * Created by PhpStorm.
 * User: Khanh
 * Date: 10/6/2015
 * Time: 6:00 PM
 */

namespace Kodeplusdev\Saml;


class Saml {

    protected $saml;

    public function __construct($authSource)
    {
        $this->saml = new \SimpleSAML_Auth_Simple($authSource);
    }


    public function getIssuer() {
        //echo '<pre>',print_r(unserialize($_SESSION['SimpleSAMLphp_SESSION']));die;
        return $this->saml->getAuthData('saml:sp:IdP');
    }

    public function __call($method, $args){
        if(method_exists($this->saml, $method)){
            return call_user_func_array(array($this->saml, $method), $args);
        }
        throw new \BadMethodCallException('Function not exist!');
    }


} 
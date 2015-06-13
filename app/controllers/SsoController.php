<?php
/**
 * Created by PhpStorm.
 * User: Khanh
 * Date: 8/6/2015
 * Time: 9:15 PM
 */
class SsoController extends BaseController {

    protected $layout = 'master';

    protected $authSource;

    protected $saml = null;

    public function __construct()
    {
        $this->authSource = Request::get('authSource', 'default-sp');

    }

    public function login()
    {
        if(!Saml::isAuthenticated()){
            if(Config::get('saml.ssoType') == 'idp-initiated'){
                $idp = Config::get("saml-authsources.$this->authSource.idp");
                $metadataConfig = Config::get("saml-metadata.$idp");
                //login by idp initiated
                $ssoUrl = $metadataConfig['SingleSignOnIdpInitUrl'] . '&RelayState=' . URL::current();
                return \Redirect::to($ssoUrl);
            } else {
                //login by sp initiated
                Saml::login();
            }
        } else {
            if(!Auth::check()){
                $attributes = Saml::getAttributes();
                $issuer = Saml::getIssuer();
                $user = User::where('email', '=',$attributes['EmailAddress'][0])->where('issuer', '=', $issuer)->first();
                if(!$user){
                    $user = new User();
                    $user->email = $attributes['EmailAddress'][0];
                    $user->first_name = $attributes['FirstName'][0];
                    $user->last_name = $attributes['LastName'][0];
                    $user->issuer = Saml::getIssuer();
                    $user->save();
                }
                Auth::login($user);
            }
        }

        return \Redirect::intended();
    }

    public function logout()
    {
        if(Saml::isAuthenticated()){
            Saml::logout();
        }
        Auth::logout();
        return Redirect::route('home.index');
    }
} 
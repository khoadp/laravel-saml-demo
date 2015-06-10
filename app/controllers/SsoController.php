<?php
/**
 * Created by PhpStorm.
 * User: Khanh
 * Date: 8/6/2015
 * Time: 9:15 PM
 */
class SsoController extends BaseController {

    protected $layout = 'master';

    public function __construct()
    {

    }

    public function login()
    {
        if(\Session::has('auth0__user_info')){
            return Redirect::intended();
        } else {
            if(\Request::has('code')){
                $auth0Config = Config::get('auth0::config');
                $auth0 = new Auth0\Login\Auth0Service($auth0Config);
                $userInfo = $auth0->getUserInfo();
                $user = User::where('idp_user_id','=', $userInfo->user_id)->first();
                //dd($userInfo);
                if(!$user){
                    $user = new User();
                    $user->email = $userInfo->EmailAddress;
                    $user->nickname = $userInfo->nickname;
                    $user->issuer = $userInfo->issuer;
                    $user->first_name = $userInfo->FirstName;
                    $user->last_name = $userInfo->LastName;
                    $user->idp_user_id = $userInfo->user_id;
                    $user->save();
                }
                //log user in
                return Redirect::to(Session::get('intended','/'));
            }else{
                Session::set('intended', Session::get('url.intended'));
                $this->_getCode();
            }
        }
    }

    public function logout()
    {
        Auth0::logout();
        return Redirect::route('home.index');
    }
    private function _getCode()
    {
        $auth0Config = Config::get('auth0::config');
        $params = http_build_query(array(
            'response_type' => 'code',
            'client_id'     => $auth0Config['client_id'],
            'redirect_uri'  => Request::url(),
            'state'         => rand(),
            'connection'    => $auth0Config['connection_name'],
        ));
        $url = 'https://'. $auth0Config['domain'] . '/authorize/?' . $params;
        header("location: $url");exit;
    }
} 
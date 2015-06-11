<?php
/**
 * Kandy AddressBook facade
 */

namespace Kodeplusdev\Saml\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Facade for the AddressBook class
 *
 * @package Kodeplusdev\Kandylaravel\Facades
 * @see     Kodeplusdev\Kandylaravel\AddressBook
 */
class Saml extends Facade
{
    /**
     * {@inheritdoc}
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'saml';
    }

}

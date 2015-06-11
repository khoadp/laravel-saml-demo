<?php namespace Kodeplusdev\Saml;

use Illuminate\Support\ServiceProvider;

class SamlServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
        $this->app->singleton("saml", function() {
            return new Saml('default-sp');
        });

	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

    public function boot()
    {
        $this->package('kodeplusdev/saml','saml');
    }

}

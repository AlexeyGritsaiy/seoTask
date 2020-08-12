<?php

namespace App\Providers;

use App\Services\DataForSeoHttpClient;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $config = $this->app['config']->get('dataforseo');

        $this->app->singleton(DataForSeoHttpClient::class, function ()use ($config) {
            $client = new Client([
                'base_uri' => $config['api_host'],
                'headers' => [
                    'Authorization' => 'Basic '.base64_encode($config['username'].':'.$config['password']),
                ]
            ]);

            return new DataForSeoHttpClient($client);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

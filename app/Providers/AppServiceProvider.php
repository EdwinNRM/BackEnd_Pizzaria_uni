<?php

namespace App\Providers;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\FlavorRepository;
use App\Repositories\FlavorRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Ligando a interface ao repositório (COMENTÁRIO GENERICO PAIZAO)
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(FlavorRepositoryInterface::class, FlavorRepository::class);

    }

    public function boot()
    {
        //
    }
}
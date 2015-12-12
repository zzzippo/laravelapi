<?php namespace App\Providers;
/**
 * Created by PhpStorm.
 * User: 77849
 * Date: 2015/12/11
 * Time: 9:21
 */

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider {


    public function register()
    {
        $this->app->bind('App\Repositories\DBInterface\UserRepositoryInterface', 'App\Repositories\DBImplement\UserRepository');
    }
}
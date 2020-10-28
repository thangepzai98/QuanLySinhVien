<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Repositories\Contracts\UserRepository::class, \App\Repositories\Eloquent\UserRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\ProductRepository::class, \App\Repositories\Eloquent\ProductRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\CategoryRepository::class, \App\Repositories\Eloquent\CategoryRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\SubCategoryRepository::class, \App\Repositories\Eloquent\SubCategoryRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\ProductDetailRepository::class, \App\Repositories\Eloquent\ProductDetailRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\PasswordResetRepository::class, \App\Repositories\Eloquent\PasswordResetRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\OrderRepository::class, \App\Repositories\Eloquent\OrderRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\OrderDetailRepository::class, \App\Repositories\Eloquent\OrderDetailRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\ProductVoteRepository::class, \App\Repositories\Eloquent\ProductVoteRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\SliderRepository::class, \App\Repositories\Eloquent\SliderRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\PostRepository::class, \App\Repositories\Eloquent\PostRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\StatisticRepository::class, \App\Repositories\Eloquent\StatisticRepositoryEloquent::class);
        //:end-bindings:
    }
}

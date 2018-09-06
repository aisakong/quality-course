<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
         \App\Topic::class => \App\Policies\TopicPolicy::class,
		 \App\Reply::class => \App\Policies\ReplyPolicy::class,        
        'App\User' => 'App\Policies\UserPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        \App\Topic::observe(\App\Observers\TopicObserver::class);      
        \App\Reply::observe(\App\Observers\ReplyObserver::class);
        \App\Video::observe(\App\Observers\VideoObserver::class);

        // \Horizon::auth(function ($request) {
        //     // 是否是教师
        //     return \Auth::user()->hasRole('Teacher');
        // });
    }
}

<?php

namespace App\Providers;

use App\Enums\Roles\Status as RoleStatus;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Video;
use App\Policies\PostPolicy;
use App\Policies\VideoPolicy;
use Carbon\Carbon;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Post::class => PostPolicy::class,
        Video::class => VideoPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin', function($user){
            return !$user->roles()->where('name', RoleStatus::USER)->count();
        });

        Gate::define('admin-main', function($user){
            return $user->roles()->where('name', RoleStatus::ADMIN)->count() > 0;
        });

        Gate::define('admin-moderator', function($user){
            return $user->roles()->where('name', RoleStatus::MODER)->count() > 0;
        });

        Gate::define('admin-writer', function($user){
            return $user->roles()->where('name', RoleStatus::WRITER)->count() > 0;
        });

        Gate::define('comment-update', function($user, Comment $comment){
            return $user->id === $comment->user_id;
        });

        Gate::define('comment-timeout', function($user, Comment $comment){
            $checkingDate = $comment->created_at;
            $currentDate = Carbon::now();
            $difference = $checkingDate->diffInHours($currentDate);
            return $difference < 2;
        });
    }
}

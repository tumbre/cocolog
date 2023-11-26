<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Post $post): bool
    {
        return $user->id==$post->user_id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Post $post): bool
    {
        return $user->id==$post->user_id;
    }

    public function delete(User $user, Post $post): bool
    {
        if ($user->id==$post->user_id) {
            return true;
        }
        foreach ($user->roles as $role) {
            if ($role->name=='admin') {
                return true;
            }
        }
        return false;
    }

    public function restore(User $user, Post $post): bool
    {
        //
    }

    public function forceDelete(User $user, Post $post): bool
    {
        //
    }
}

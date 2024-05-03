<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Posts;

class PostPolicy
{
    public function update(User $user, Posts $post)
    {
        return $user->id === $post->user_id;
    }

    public function delete(User $user, Posts $post)
    {
        return $user->id === $post->user_id;
    }
}

<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CategoryPolicy
{
    /**
     * Create a new policy instance.
     */
    public function modify(User $user, Category $category): Response
    {
        //

        return $user->id === $category->user_id
            ? Response::allow()
            : Response::deny('You are not allowed to modify this post.');
    }
}

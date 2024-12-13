<?php

namespace App\Policies;

use App\Models\Enterproduct;
use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class EnterPolicy
{
    /**
     * Create a new policy instance.
     */
    public function modify(User $user, Enterproduct $enterproduct): Response
    {
        //

        return $user->id === $enterproduct->user_id
            ? Response::allow()
            : Response::deny('You are not allowed to modify this post.');
    }
}

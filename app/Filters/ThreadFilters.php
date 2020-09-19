<?php

namespace App\Filters;

use App\User;


class ThreadFilters extends Filters
{
    protected $filters = ['by','popular'];
    /** Filter the query by a given user name */ 
    public function by($username)
    {

        $user = User::where('name', $username)->firstOrFail();
        return $this->builder->where('user_id', $user->id);
    }

    public function popular()
    {
        // override order by latest which is the default in the controller
        $this->builder->getQuery()->orders = [];
        return $this->builder->orderBy('replies_count', 'desc');
    }

}
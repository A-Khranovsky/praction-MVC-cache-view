<?php

namespace MVC\Models;

class Users
{
    public $collection;

    public function __construct($users = null)
    {
        if (is_null($users)) {
            $users = [
                new User(
                    'nick@ukr.net',
                    'nick',
                    'Nick',
                    'Nick'
                ),

                new User(
                    'jack@ukr.net',
                    'jack',
                    'Jack',
                    'Jack'
                )
            ];
        }
        $this->collection = $users;
    }
}

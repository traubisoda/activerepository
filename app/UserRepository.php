<?php

namespace App;

class UserRepository extends Repository {
    public function __construct(User $user) {
        $this->model = $user->newQuery();
    }
}
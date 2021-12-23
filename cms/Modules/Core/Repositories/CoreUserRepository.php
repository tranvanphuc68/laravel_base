<?php

namespace Cms\Modules\Core\Repositories;

use Cms\Modules\Core\Models\User;
use Cms\Modules\Core\Repositories\Contracts\CoreUserRepositoryContract;

class CoreUserRepository implements CoreUserRepositoryContract
{

    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function store($data)
    {
        return $this->model->create($data);
    }
}

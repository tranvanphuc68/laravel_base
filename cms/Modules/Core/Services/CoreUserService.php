<?php

namespace Cms\Modules\Core\Services;

use Cms\Modules\Core\Repositories\Contracts\CoreUserRepositoryContract;
use Illuminate\Support\Facades\Hash;

class CoreUserService
{
    protected $user;

    public function __construct(CoreUserRepositoryContract $user)
    {
        $this->user = $user;
    }

    public function store($data)
    {
        $data['password'] = Hash::make($data['password']);

        return $this->user->store($data);
    }
}

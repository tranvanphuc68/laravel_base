<?php

namespace Cms\Modules\Core\Repositories;

use Cms\Modules\Core\Repositories\Contracts\CoreTodoListRepositoryContract;
use Cms\Modules\Core\Models\TodoList;

class CoreTodoListRepository implements CoreTodoListRepositoryContract
{
    protected $model;

    public function __construct(TodoList $model) {
        $this->model = $model;
    }

    
}


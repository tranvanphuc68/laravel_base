<?php

namespace Cms\Modules\TodoList\Services\Contracts;

use Cms\Modules\Core\Services\Contracts\CoreTodoListServiceContract;

interface TodoListTodoListServiceContract extends CoreTodoListServiceContract
{
    public function find($id);

    public function getAll();

    public function store($data);

    public function update($id, $data);

    public function delete($id);
}

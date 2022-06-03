<?php

namespace Cms\Modules\TodoList\Repositories\Contracts;

use Cms\Modules\Core\Repositories\Contracts\CoreTodoListRepositoryContract;


interface TodoListTodoListRepositoryContract extends CoreTodoListRepositoryContract
{
    public function find($id);

    public function getAll();

    public function store($data);

    public function update($id, $data);

    public function delete($id);
}

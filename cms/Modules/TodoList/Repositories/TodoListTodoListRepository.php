<?php

namespace Cms\Modules\TodoList\Repositories;

use Cms\Modules\Core\Models\TodoList;
use Cms\Modules\TodoList\Repositories\Contracts\TodoListTodoListRepositoryContract;
use Cms\Modules\Core\Repositories\CoreTodoListRepository;

class TodoListTodoListRepository extends CoreTodoListRepository implements TodoListTodoListRepositoryContract
{
    protected $model;

    public function __construct(TodoList $model)
    {
        $this->model = $model;
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function getAll()
    {
        return auth()->user()->hasRole('admin') ? $this->model->with('user')->get() : $this->model->where('user_id', auth()->id())->with('user')->get();
    }

    public function store($data)
    {
        return $this->model->create($data);
    }

    public function update($id, $data)
    {
        $todo = $this->model->findOrFail($id);
        return auth()->user()->hasRole('admin') || ($data['user_id'] == auth()->id()) ? $todo->update($data) : abort(403);
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }
}

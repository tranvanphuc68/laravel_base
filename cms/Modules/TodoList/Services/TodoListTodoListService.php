<?php

namespace Cms\Modules\TodoList\Services;

use Cms\Modules\TodoList\Services\Contracts\TodoListTodoListServiceContract;
use Cms\Modules\Core\Services\CoreTodoListService;
use Cms\Modules\TodoList\Repositories\Contracts\TodoListTodoListRepositoryContract;

class TodoListTodoListService extends CoreTodoListService implements TodoListTodoListServiceContract
{
	protected $repository;

	function __construct(TodoListTodoListRepositoryContract $repository)
	{
	    parent::__construct($repository);

	    $this->repository = $repository;
	}

	public function find($id)
	{
        return $this->repository->find($id);
	}

    public function getAll()
	{
        return $this->repository->getAll();
	}

    public function store($data)
	{
        return $this->repository->store($data);
	}

    public function update($id, $data)
	{
        return $this->repository->update($id, $data);
	}

    public function delete($id)
	{
        return $this->repository->delete($id);
	}
}



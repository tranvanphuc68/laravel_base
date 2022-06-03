<?php

namespace Cms\Modules\TodoList;

use Cms\CmsServiceProvider;
use Cms\Modules\TodoList\Repositories\Contracts\TodoListTodoListRepositoryContract;
use Cms\Modules\TodoList\Repositories\TodoListTodoListRepository;
use Cms\Modules\TodoList\Services\TodoListTodoListService;
use Cms\Modules\TodoList\Services\Contracts\TodoListTodoListServiceContract;
use Illuminate\Routing\Router;

class TodoListServiceProvider extends CmsServiceProvider
{
    public function boot(Router $router)
    {
        parent::boot($router);
    }

	public function register()
	{
	    $this->app->bind(TodoListTodoListServiceContract::class, TodoListTodoListService::class);
	    $this->app->bind(TodoListTodoListRepositoryContract::class, TodoListTodoListRepository::class);
	}
}

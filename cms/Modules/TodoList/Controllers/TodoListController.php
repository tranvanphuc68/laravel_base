<?php

namespace Cms\Modules\TodoList\Controllers;

use App\Http\Controllers\Controller;
use Cms\Modules\TodoList\Services\TodoListTodoListService;
use Illuminate\Http\Request;

class TodoListController extends Controller
{
    protected $service;

    public function __construct(TodoListTodoListService $service)
    {
        $this->service = $service;
    }

    public function getAll()
	{
        $todoLists = $this->service->getAll();
        return view('TodoList::index', compact('todoLists'));
	}

    public function store(Request $request)
	{
        $data['content'] = $request->content;
        $data['user_id'] = auth()->id();
        $data['status'] = 0;
        $this->service->store($data);
        return redirect()->route('todoList.getAll');
	}

    public function edit($id)
	{
        $todo = $this->service->find($id);
        return view('TodoList::edit', compact('todo'));
	}

    public function update(Request $request, $id)
	{   
        $data['user_id'] = $this->service->find($id)->user_id;
        $data['content'] = $request->content;
        $data['status'] = ($request->status == true) ? 1 : 0;
        $this->service->update($id, $data);
        return redirect()->route('todoList.getAll');
	}

    public function delete($id)
	{
        $this->service->delete($id);
        return redirect()->route('todoList.getAll');
	}
}


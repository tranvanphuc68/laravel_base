@extends('Core::layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">TodoList</div>

                <div class="card-body">
                    @foreach ($todoLists as $item)
                        <div class="d-flex justify-content-between m-2">
                            <div class="w-50">{{ $item->content }}</div>
                            <div>{{ $item['user']->name }}</div>
                            <div>{{ $item->status }}</div>
                            <a class="btn btn-info" href="{{ route('todoList.edit', ['id' => "$item->id"]) }}">Edit</a>
                            <div>
                                <form method="POST" action="{{ route('todoList.delete', ['id' => "$item->id"]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Create
                    </button>
                    
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create a to-do-thing</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <form action="{{ route('todoList.store') }}" method="post">
                                @csrf
                                <div class="modal-body">
                                    <input type="text" name='content'>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

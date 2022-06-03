@extends('Core::layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">TodoList</div>

                <div class="card-body">
                    <div class="d-flex justify-content-between m-2">
                        <form method="POST" action="{{ route('todoList.update', ['id' => "$todo->id"]) }}">
                            @csrf
                            @method('PUT')
                            <input type="text" class="form-control" name="content" value="{{ $todo->content }}">
                            <input type="checkbox" name="status" value="true" @php echo ($todo->status == 1) ?  'checked' : ''; @endphp >Check
                            <button class="btn btn-primary m-2" type="submit">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<?php

namespace Cms\Modules\Core\Models;
use Illuminate\Database\Eloquent\Model;

class TodoList extends Model
{
    protected $table = "todolists";

    protected $guarded = [];

    protected $hidden = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


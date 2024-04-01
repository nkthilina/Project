<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TodoServices {

    protected $todo;
    public function all(){

        return $this->todo->all();
    }

    public function __construct(){
        $this->todo = new Todo();
    }

    public function create(){

    }

    public function store(Request $request){
        $this->todo->create($data);
    }

    public function delete(Request $request){
        $todo = $this->todo->find($request->id);
        $todo->delete();
    }

    public function update(Request $request){

        $this->todo->update($data);

    }

    public function edit(Todo $todo){
        //
    }

    public function done($todo){
        $todo = $this->todo->find($todo);
        $todo->done = 1;
        $todo->update();    }
}

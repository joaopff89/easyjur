<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class Repository
{
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function filter($field, $value)
    {
        $this->model = $this->model->where($field, $value);
    }

    public function result()
    {
        return $this->model->orderBy('id', 'desc')->get();
    }

    public function resultPaged($n)
    {
        return $this->model->orderBy('id', 'desc')->paginate($n);
    }
}
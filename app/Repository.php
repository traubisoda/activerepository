<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

abstract class Repository {
    protected $model;

    public function __construct(Model $user) {
        $this->model = $user->newQuery();
    }

    protected function checkQuery() {
        if(get_class($this->model) !== \Illuminate\Database\Eloquent\Builder::class) {
            $this->model = $this->model->newQuery();
        }
    }

    public function with($relations) {
        if(is_string($relations)) $relations = func_get_args();

        $this->checkQuery();
        foreach($relations as $relation) $this->model->with($relation);

        return $this;
    }

    public function where($criteria) {
        $this->checkQuery();

        $this->model->where($criteria);

        return $this;
    }

    public function select($cols) {
        $this->checkQuery();

        $this->model->select($cols);

        return $this;
    }

    public function orderBy($attr, $direction = 'asc') {
        $this->checkQuery();

        $this->model->orderBy($attr, $direction);

        return $this;
    }

    public function limit($num) {
        $this->checkQuery();

        $this->model->limit($num);

        return $this;
    }

    public function take($num) {
        return $this->offset($num);
    }

    public function offset($num) {
        $this->checkQuery();

        $this->model->offset($num);

        return $this;
    }

    public function withTrashed() {
        $this->model = $this->model->withTrashed();

        return $this;
    }

    public function all() {
        return $this->get();
    }

    public function get() {
        return $this->model->get()->toArray();
    }

    public function collect() {
        return collect($this->get());
    }

    public function findBy($attr, $criteria) {
        return $this->model->where($attr, $criteria)->get()->toArray();
    }

    public function find($id) {
        return $this->model->findOrFail($id)->toArray();
    }

    public function restore($data) {
        return $this->model->restore($data);
    }

    public function update($id, $data) {
        return !!$this->model->where('id', $id)->update($data);
    }

    public function delete($id) {
        return !!$this->model->where('id', $id)->delete();
    }

    public function create($data) {
        return $this->model->create($data)->toArray();
    }
}
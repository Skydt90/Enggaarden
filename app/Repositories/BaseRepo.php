<?php

namespace App\Repositories;

class BaseRepo implements BaseRepoInterface
{
    /**
     * This points to the model related to the implementing repo
     */
    protected $model;

    public function get()
    {
        return $this->model->all();
    }

    public function getById(int $id)
    {
        return $this->model->findOrFail($id);
    }

    public function getWhere(string $column, $value)
    {
        return $this->model->where($column, $value)->first();
    }

    public function getOrderBy($column, $value)
    {
        return $this->model->orderBy($column, $value)->first();
    }

    public function getPaginated(int $amount)
    {
        return $this->model->paginate($amount);
    }

    public function getWithRelations(array $relations)
    {
        return $this->model->with($relations)->get();
    }

    public function getPaginatedWithRelations(array $relations, int $amount)
    {
        return $this->model->with($relations)->paginate($amount);
    }

    public function getByIdWithRelations(int $id, array $relations)
    {
        return $this->model->with($relations)->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function firstOrCreate(array $values)
    {
        return $this->model->firstOrCreate($values);
    }

    public function updateById(array $data, int $id)
    {
        $model = $this->model->findOrFail($id);
        $model->fill($data);
        $model->save();
        return $model;
    }

    public function updateWhere(array $data, string $column, $value)
    {
        $model = $this->model->where($column, $value)->firstOrFail();
        $model->fill($data);
        $model->save();
        return $model;
    }

    public function delete(int $id): bool
    {
        return $this->model->findOrFail($id)->destroy($id);
    }
}

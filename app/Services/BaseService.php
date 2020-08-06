<?php

namespace App\Services;

use Illuminate\Http\Request;

class BaseService implements BaseServiceInterface
{
    /**
     * This points to the repo related to the implementing service
     */
    protected $repo;

    public function get()
    {
        return $this->repo->get();
    }

    public function getById(int $id)
    {
        return $this->repo->getById($id);
    }

    public function getWhere(string $column, $value)
    {
        return $this->repo->getWhere($column, $value);
    }

    public function getPaginated(int $amount)
    {
        return $this->repo->getPaginated($amount);
    }

    public function getWithRelations(array $relations)
    {
        return $this->repo->getWithRelations();
    }

    public function getByIdWithRelations(int $id, array $relations)
    {
        return $this->repo->getByIdWithRelations($id, $relations);
    }

    public function getPaginatedWithRelations(array $relations, int $amount)
    {
        return $this->repo->getPaginatedWithRelations($relations, $amount);
    }

    public function create(Request $request)
    {
        return $this->repo->create($request->all());
    }

    public function updateById(Request $request, int $id)
    {
        return $this->repo->updateById($request->all(), $id);
    }

    public function updateWhere(Request $request, string $column, $value)
    {
        return $this->repo->updateWhere($request->all(), $column, $value);
    }

    public function delete(int $id): bool
    {
        return $this->repo->delete($id);
    }

    public function deleteWhere($column, $value): bool
    {
        return $this->repo->deleteWhere($column, $value);
    }
}

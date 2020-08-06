<?php

namespace App\Services;

use Illuminate\Http\Request;

interface BaseServiceInterface
{
    /*
      Get
    */
    public function get();
    public function getById(int $id);
    public function getWhere(string $column, $value);
    public function getPaginated(int $amount);
    public function getWithRelations(array $relations);
    public function getByIdWithRelations(int $id, array $relations);
    public function getPaginatedWithRelations(array $relations, int $amount);

    /*
      Create
    */
    public function create(Request $request);

    /*
      Update
    */
    public function updateById(Request $request, int $id);
    public function updateWhere(Request $request, string $column, $value);

    /*
      Delete
    */
    public function delete(int $id): bool;
    public function deleteWhere($column, $value): bool;
}

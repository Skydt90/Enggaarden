<?php

namespace App\Repositories;

interface BaseRepoInterface
{
    /*
      Get
    */
    public function get();
    public function getById(int $id);
    public function getWhere(string $column, $value);
    public function getOrderBy(string $column, $value);
    public function getPaginated(int $amount);
    public function getWithRelations(array $relations);
    public function getByIdWithRelations(int $id, array $relations);
    public function getPaginatedWithRelations(array $relations, int $amount);

    /*
      Create
    */
    public function create(array $data);
    public function firstOrCreate(array $values);

    /*
      Update
    */
    public function updateById(array $data, int $id);
    public function updateWhere(array $data, string $column, $value);

    /*
      Delete
    */
    public function delete(int $id): bool;
}

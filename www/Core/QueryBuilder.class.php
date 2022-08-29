<?php

namespace App\Core;

interface QueryBuilder
{
    public function select(array $columns): QueryBuilder;

    public function leftJoin($table, $column_one, $column_two): QueryBuilder;

    public function rightJoin(array $columns): QueryBuilder;

    public function insert(array $columns): QueryBuilder;

    public function update(array $columns): QueryBuilder;

    public function createTable(array $columns): void;

    public function createDatabase($dbName): void;

    public function dropTable(): void;

    public function deleteTable(): void;

    public function alterTable(array $columns): QueryBuilder;

    public function save(): bool;

    public function where(string $column, string $value, string $operator = "="): QueryBuilder;

    public function limit(int $from, int $offset): QueryBuilder;

    public function getQuery(): string;

    public function delete(): QueryBuilder;

    public function orderBy($field, $filter): QueryBuilder;
}

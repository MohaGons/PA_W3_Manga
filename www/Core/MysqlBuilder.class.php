<?php

namespace App\Core;

use App\Core\QueryBuilder;
use App\Core\Verificator;

use PDO;

abstract class MysqlBuilder implements QueryBuilder
{
    protected $pdo;
    private $query;
    private $table;

    public function __construct()
    {
        $connectionPDO = ConnectionPDO::getInstance();
        $this->pdo = $connectionPDO->pdo;

        $getCalledClassExploded = explode("\\", strtolower(get_called_class())); // App\Model\User
        $this->table = DB_PREFIXE . end($getCalledClassExploded);
    }

    public function getColums()
    {
        $colums = get_object_vars($this);
        $varToExclude = get_class_vars(get_class());
        $colums = array_diff_key($colums, $varToExclude);

        return $colums;
    }
    private function reset()
    {
        $this->query = new \stdClass();
    }

    public function save(): bool
    {
        $this->reset();
        $colums = get_object_vars($this);
        $varToExclude = get_class_vars(get_class());
        $colums = array_diff_key($colums, $varToExclude);

        if (is_null($this->getId())) {
            $this->insert($colums);
        } else {
            $update = [];
            foreach ($colums as $key => $value) {
                if (!empty($value)){
                    $update[] = $key . "=:" . $key;
                }
                else{
                    unset($colums[$key]);
                }
            }
            $this->update($update);
        }

        $queryPrepared = $this->pdo->prepare($this->getQuery());
        if ($queryPrepared->execute($colums)) {
            $result = true;
        }
        else {
            $result = false;
        }


        return $result;
    }

    public function select(array $columns): QueryBuilder
    {
        $this->reset();
        $this->query->base = "SELECT " . implode(", ", $columns) . " FROM " . $this->table;
        return $this;
    }

    public function delete(): QueryBuilder
    {
        $this->reset();
        $this->query->base = "DELETE FROM " . $this->table;
        return $this;
    }

    public function insert(array $columns): QueryBuilder
    {
        $this->reset();
        $this->query->base = "INSERT INTO " . $this->table . " (" . implode(",", array_keys($columns)) . ") VALUES (:" . implode(",:", array_keys($columns)) . ")";
        return $this;
    }

    public function update(array $columns): QueryBuilder
    {
        $this->reset();
//        die(var_dump(implode(",", $columns)));
        $this->query->base = "UPDATE " . $this->table . " SET " . implode(",", $columns) . " WHERE id=:id";
        return $this;
    }

    public function leftJoin($table, $column_one, $column_two): QueryBuilder
    {
        //$this->reset();
        $this->query->join[] = " LEFT JOIN " . $table . " ON " . $column_one . " = " . $column_two;

        return $this;
    }

    public function rightJoin(array $columns): QueryBuilder
    {
        $this->reset();
        $this->query->base = "UPDATE " . $this->table . " SET " . implode(",", $columns) . " WHERE id=:id";
        return $this;
    }

    public function orderBy($field, $filter): QueryBuilder
    {
        $this->query->order = " ORDER BY " . $field . " " . $filter;

        return $this;
    }

    public function createDatabase($dbName): void
    {
        $this->reset();
        $this->query->base = "CREATE DATABASE " . $dbName . ";";

        $queryPrepared = $this->pdo->prepare($this->getQuery());
        $queryPrepared->execute();
    }

    public function createTable(array $columns): void
    {
        $showTable = $this->pdo->prepare("SHOW TABLES;");
        $showTable->execute();
        $tablesExists = $showTable->fetchAll();

        $tables = array_column($tablesExists, "0");


        if (in_array($this->table, $tables)) {
            $this->dropTable();
            $this->createTable($columns);
        } else {
            $this->reset();
            $this->query->base = "CREATE TABLE " . $this->table . " (";
            foreach ($columns as $key => $value) {
                $this->query->base .= $key . " " . $value;
            }
            $this->query->base .= ") ENGINE=InnoDB DEFAULT CHARSET=latin1;";
            $queryPrepared = $this->pdo->prepare($this->getQuery());
            $queryPrepared->execute();
        }
    }

    public function dropTable(): void
    {
        $this->reset();
        $this->query->base = "DROP TABLE " . $this->table . ";";

        $queryPrepared = $this->pdo->prepare($this->getQuery());
        $queryPrepared->execute();
    }

    public function deleteTable(): void
    {
        $this->reset();
        $this->query->base = "TRUNCATE TABLE " . $this->table . ";";

//        die($this->getQuery());
        $queryPrepared = $this->pdo->prepare($this->getQuery());
        $queryPrepared->execute();
    }

    public function alterTable(array $columns): QueryBuilder
    {
        $this->reset();
        $this->query->base = "UPDATE " . $this->table . " SET " . implode(",", $columns) . " WHERE id=:id";
        return $this;
    }

    public function where(string $column, string $value, string $operator = "="): QueryBuilder
    {
        $this->query->where[] = $column . $operator . "'" . $value . "'";
        return $this;
    }

    public function limit(int $from, int $offset): QueryBuilder
    {
        $this->query->limit = " LIMIT " . $from . ", " . $offset;
        return $this;
    }

    public function getQuery(): string
    {
        $query = $this->query;

        $sql = $query->base;

        if (!empty($query->join)) {
            $sql .= implode(' ', $query->join);
        }

        if (!empty($query->where)) {
            $sql .= " WHERE " . implode(' AND ', $query->where);
        }

        if (isset($query->order)) {
            $sql .= $query->order;
        }

        if (isset($query->limit)) {
            $sql .= $query->limit;
        }

        return $sql;
    }

    
}

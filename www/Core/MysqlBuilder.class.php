<?php

namespace App\Core;

use App\Core\QueryBuilder;
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
        $this->table = DBPREFIXE.end($getCalledClassExploded);

    }

    public function getColums() {
        $colums = get_object_vars($this);
        $varToExclude = get_class_vars(get_class());
        $colums = array_diff_key($colums, $varToExclude);

        return $colums;
    }
    private function reset()
    {
        $this->query = new \stdClass();
    }

    public function save(): void
    {
        $this->reset();
        $colums = get_object_vars($this);
        $varToExclude = get_class_vars(get_class());
        $colums = array_diff_key($colums, $varToExclude);

        if(is_null($this->getId())){
            $this->insert($colums);
        }else{
            $update = [];
            foreach ($colums as $key=>$value) {
                $update[] = $key."=:".$key;
            }
            $this->update($colums);
        }

        $queryPrepared = $this->pdo->prepare($this->getQuery());
        $queryPrepared->execute( $colums );
    }

    public function select(array $columns): QueryBuilder
    {
        $this->reset();
        $this->query->base = "SELECT " . implode(", ", $columns) . " FROM " . $this->table;
        return $this;
    }

    public function insert(array $columns): QueryBuilder
    {
        $this->reset();
        $this->query->base = "INSERT INTO ".$this->table." (". implode(",", array_keys($columns)) .") VALUES (:". implode(",:", array_keys($columns)) .")";
        return $this;
    }

    public function update(array $columns): QueryBuilder
    {
        $this->reset();
        $this->query->base = "UPDATE ".$this->table." SET ".implode(",", $columns)." WHERE id=:id";
        return $this;
    }

    public function leftJoin(array $columns): QueryBuilder
    {
        $this->reset();
        $this->query->base = "INSERT INTO ".$this->table." (". implode(",", array_keys($columns)) .") VALUES (:". implode(",:", array_keys($columns)) .")";
        return $this;
    }

    public function rightJoin(array $columns): QueryBuilder
    {
        $this->reset();
        $this->query->base = "UPDATE ".$this->table." SET ".implode(",", $columns)." WHERE id=:id";
        return $this;
    }

    public function createTable(array $columns): void
    {
        $showTable = $this->pdo->prepare("SHOW TABLES;");
        $showTable->execute();
        $tablesExists = $showTable->fetchAll();

        $tables = array_column($tablesExists, "0");


        if (in_array($this->table, $tables)) {
            $this->deleteTable();
            $this->createTable($columns);
        }
        else {
            $this->reset();
            $this->query->base = "CREATE TABLE ".$this->table." (";
            foreach ($columns as $key => $value) {
                $this->query->base.= $key." ".$value;
            }
            $this->query->base.= ") ENGINE=InnoDB DEFAULT CHARSET=latin1;";
            $queryPrepared = $this->pdo->prepare($this->getQuery());
            $queryPrepared->execute();
        }

    }

    public function deleteTable(): void
    {
        $this->reset();
        $this->query->base = "DROP TABLE ".$this->table.";";

        $queryPrepared = $this->pdo->prepare($this->getQuery());
        $queryPrepared->execute();

    }

    public function alterTable(array $columns): QueryBuilder
    {
        $this->reset();
        $this->query->base = "UPDATE ".$this->table." SET ".implode(",", $columns)." WHERE id=:id";
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

        if (!empty($query->where)) {
            $sql .= " WHERE " . implode(' AND ', $query->where);
        }

        if (isset($query->limit)) {
            $sql .= $query->limit;
        }

        return $sql;

    }

    public function getCategories(){
		$query = $this->pdo->prepare("SELECT * FROM mnga_category");
		$query->execute();
		$categorie_data = $query->fetchall();
		return $categorie_data;
	}

    public function deleteCategory($category_Id){
        $query = $this->pdo->prepare("DELETE FROM mnga_category WHERE id= :id");
        $query->bindValue(':id', $category_Id);
        $query->execute();
	}

    public function getForums(){
		$query = $this->pdo->prepare("SELECT * FROM mnga_forum");
		$query->execute();
		$forums_data = $query->fetchall();
		return $forums_data;
	}

    public function getForum($forum_Id){
		$query = $this->pdo->prepare("SELECT * FROM mnga_forum WHERE id= :id");
        $query->bindValue(':id', $forum_Id);
		$query->execute();
		$forums_data = $query->fetchall();
		return $forums_data;
	}

    public function deleteForum($forum_Id){
        $query = $this->pdo->prepare("DELETE FROM mnga_forum WHERE id= :id");
        $query->bindValue(':id', $forum_Id);
        $query->execute();
	}
    public function getMangas(){
		$query = $this->pdo->prepare("SELECT * FROM mnga_manga");
		$query->execute();
		$manga_data = $query->fetchall();
		return $manga_data;
	}

    public function deleteManga($manga_Id){

		$query = $this->pdo->prepare("DELETE FROM mnga_manga WHERE id= :id");
		$query->bindValue(':id', $manga_Id);
		$query->execute();
		
    }
    
}
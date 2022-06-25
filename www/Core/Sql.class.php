<?php

namespace App\Core;

abstract class Sql
{

    protected $pdo;
    private $table;

    public function __construct()
    {
        //Plus tard il faudra penser au singleton
        try{
            $this->pdo = new \PDO( DBDRIVER.":host=".DBHOST.";port=".DBPORT.";dbname=".DBNAME , DBUSER , DBPWD
                , [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING]);
        }catch(\Exception $e){
            die("Erreur SQL : ".$e->getMessage());
        }

        $getCalledClassExploded = explode("\\", strtolower(get_called_class())); // App\Model\User
        $this->table = DBPREFIXE.end($getCalledClassExploded);
    }
    
    public function save(): void
    {
        $colums = get_object_vars($this);
        $varToExclude = get_class_vars(get_class());
        $colums = array_diff_key($colums, $varToExclude);

        if(is_null($this->getId())){
            $sql = "INSERT INTO ".$this->table." (". implode(",", array_keys($colums)) .") VALUES (:". implode(",:", array_keys($colums)) .")";
        }else{
            $update = [];
            foreach ($colums as $key=>$value) {
                $update[] = $key."=:".$key;
            }
            $sql ="UPDATE ".$this->table." SET ".implode(",", $update)." WHERE id=:id";
        }

        $queryPrepared = $this->pdo->prepare($sql);
        $queryPrepared->execute( $colums );

        //Si ID null alors insert sinon update
    }

    public function getCategories(){
		$query = $this->pdo->prepare("SELECT * FROM mnga_category");
		$query->execute();
		$categorie_data = $query->fetchall();
		return $categorie_data;
	}

    public function getCategory($category_Id){
		$query = $this->pdo->prepare("SELECT * FROM mnga_category WHERE id= :id");
        $query->bindValue(':id', $category_Id);
		$query->execute();
		$category_data = $query->fetch();
		return $category_data;
	}

    public function getCategoryNames(){
        $category_name = [];
        $category_id = [];
		$query = $this->pdo->prepare("SELECT id, name FROM mnga_category");
		$query->execute();
		$categorie_data = $query->fetchall();
        foreach ($categorie_data as $key => $value){
            $category_id[] = $value["id"];
            $category_name[] = $value["name"];
        }
        $category_infos = array_combine($category_id, $category_name);
		return $category_infos;
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
		$forums_data = $query->fetch();
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
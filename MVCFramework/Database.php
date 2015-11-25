<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Yulia
 * Date: 25.11.2015
 * Time: 16:51
 */
namespace MVCFramework;

class Database{
    protected $connection = 'default';
    // to extend use protected $connection = 'session';

    /**
     * @var \PDO
     */
    private $db = null;

    /**
     * @var \PDOStatement
     */
    private $stmt = null;
    private $params = array();
    private $sqlQuery;

    public function __construct(string $connection = null){
        if($connection != NULL){
            $this->connection = $connection;
        }

        $this->db = \MVCFramework\App::getInstance()->getDbConnection($this->connection);
    }

    public function prepare(string $sqlQuery, array $params = [], array $pdoOptions = []): Database{
        $this->stmt = $this->db->prepare($sqlQuery, $pdoOptions);
        $this->params = $params;
        $this->sqlQuery = $sqlQuery;

        return $this;
    }

    public function execute(array $params = []) : Database{
        if($params){
            $this->params = $params;
        }

        $this->stmt->execute($this->params);

        return $this;
    }

    public function fetchAllAssoc(){
        return $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function fetchRowAssoc(){
        return $this->stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function fetchAllNum(){
        return $this->stmt->fetchAll(\PDO::FETCH_NUM);
    }

    public function fetchRowNum(){
        return $this->stmt->fetch(\PDO::FETCH_NUM);
    }

    public function fetchAllObject(){
        return $this->stmt->fetchAll(\PDO::FETCH_OBJ);
    }

    public function fetchRowObject(){
        return $this->stmt->fetch(\PDO::FETCH_OBJ);
    }

    public function fetchAllColumn($column){
        return $this->stmt->fetchAll(\PDO::FETCH_COLUMN, $column);
    }

    public function fetchRowColumn($column){
        return $this->stmt->fetch(\PDO::FETCH_BOUND, $column);
    }

    public function fetchAllClass($class){
        return $this->stmt->fetchAll(\PDO::FETCH_CLASS, $class);
    }

    public function fetchRowClass($class){
        return $this->stmt->fetchAll(\PDO::FETCH_BOUND, $class);
    }

    public function getLastInsertId(){
        return $this->db->lastInsertId();
    }

    public function getAffectedRows(){
        return $this->stmt->rowCount();
    }

    public function getSTMT(){
        return $this->stmt;
    }
}
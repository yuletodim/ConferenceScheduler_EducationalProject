<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Yulia
 * Date: 26.11.2015
 * Time: 17:20
 */
namespace MVCFramework\Sessions;

class DBSession extends \MVCFramework\Database implements \MVCFramework\Sessions\ISession{
    private $sessionName;
    private $tableName;
    private $lifetime;
    private $path;
    private $domain;
    private $secure;
    private $sessionId = null;
    private $sessionData = array();

    public function __construct(
            $dbConnection,
            $name,
            $tableName = 'session',
            $lifetime = 3600,
            $path = null,
            $domain = null,
            $secure = false){
        parent::__construct($dbConnection);
        $this->tableName = $tableName;
        $this->sessionName = $name;
        $this->lifetime = $lifetime;
        $this->path = $path;
        $this->domain = $domain;
        $this->secure = $secure;
        $this->sessionId = $_COOKIE[$name];

        if(strlen($this->sessionId) < 32){
            $this->_startNewSession();
        }
        else if(!$this->_isSessionValid()){
            $this->_startNewSession();
        }

        if(rand(0, 50) == 1){
            $this->_garbageCollect();
        }
    }

    private function _isSessionValid() : bool{
        if($this->sessionId){
            $stmt = $this->prepare('SELECT * FROM ' . $this->tableName .
                ' WHERE sess_id = ? AND valid_until <= ?');
            $result = $stmt->execute(
                [
                    $this->sessionId,
                    (time() + $this->lifetime)
                ])->fetchAllAssoc();

            if(is_array($result) && count($result) == 1 && $result[0]){
                $this->sessionData = unserialize($result[0]['sess_data']);
                return true;
            }
        }

        return false;
    }

    private function _startNewSession(){
        $this->sessionId = md5(uniqid('MVC', true));
        $stmt = $this->prepare('INSERT INTO ' . $this->tableName .
            ' (sess_id, valid_until) VALUES(?, ?)');
        $stmt->execute([$this->sessionId, (time() + $this->lifetime)]);

        setcookie(
            $this->sessionName,
            $this->sessionId,
            (time() + $this->lifetime),
            $this->path,
            $this->domain,
            $this->secure, true);
    }

    private function _garbageCollect(){
        $stmt = $this->prepare('DELETE * FROM ' . $this->tableName . ' WHERE valid_until < ?');
        $stmt->execute([time()]);
    }

    public function __get(string $name)
    {
        return $this->sessionData[$name];
    }

    public function __set(string $name, string $value)
    {
        $this->sessionData[$name] = $value;
    }

    public function saveSession()
    {
        if($this->sessionId){
            $stmt = $this->prepare('UPDATE ' . $this->tableName .
                ' SET sess_data = ?, valid_until = ? WHERE sess_id = ?');
            $stmt->execute(
                [
                    serialize($this->sessionData),
                    (time() + $this->lifetime),
                    $this->sessionId
                ]);
            setcookie(
                $this->sessionName,
                $this->sessionId,
                (time() + $this->lifetime),
                $this->path,
                $this->domain,
                $this->secure, true);
        }
    }

    public function getSessionId() : string
    {
        return $this->sessionId;
    }

    public function destroySession()
    {
        if($this->sessionId){
            $stmt = $this->prepare('DELETE FROM ' . $this->tableName . ' WHERE sess_id = ?');
            $stmt->execute([$this->sessionId]);
        }
    }
}
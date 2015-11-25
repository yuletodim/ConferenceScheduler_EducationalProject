<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Yulia
 * Date: 26.11.2015
 * Time: 00:35
 */
namespace MVCFramework\Sessions;

class NativeSession implements \MVCFramework\Sessions\ISession{
    public function __construct(
            string $name,
            int $lifetime = 3600,
            string $path = null,
            string $domain = null,
            bool $secure = false){
        if(strlen($name) < 1){
            $name = '_sess';
        }

        session_name($name);
        session_set_cookie_params($lifetime, $path, $domain, $secure, true);
        session_start();
    }

    public function __get(string $name): string{
        return $_SESSION[$name];
    }

    public function __set(string $name, string $value){
        $_SESSION[$name] = $value;
    }

    public function destroySession(){
        session_destroy();
    }

    public function getSessionId():string{
        return session_id();
    }

    public function saveSession(){
        session_write_close();
    }
}
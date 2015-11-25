<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Yulia
 * Date: 26.11.2015
 * Time: 00:29
 */
namespace MVCFramework\Sessions;

interface ISession{
    public function getSessionId();

    public function saveSession();

    public function destroySession();

    public function __get(string $name);

    public function __set(string $name, string $value);
}

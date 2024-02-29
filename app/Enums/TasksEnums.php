<?php
namespace App\Enums;

enum TasksEnums: string{

    case ACTIVE = 'На рассмотрении';
    case RESOLVED = 'Завершена';

    public static function get($key){
        return self::fromName($key);
    }

    public static function fromName(string $name){
        return constant("self::$name")->value;
    }

}
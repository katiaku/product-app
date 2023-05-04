<?php

interface DatabaseManager
{
    public static function connect(): mysqli;
    public static function disconnect(): void;
}

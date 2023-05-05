<?php

require_once './databaseManager.php';

class Database implements DatabaseManager
{
    protected static $conn;

    const HOST = "localhost";
    const USERNAME = "root";
    const PASSWORD = "";
    const DB = "product-app-scandiweb";

    public static function connect(): mysqli {
        self::$conn = mysqli_connect(self::HOST, self::USERNAME, self::PASSWORD, self::DB);
        if (!self::$conn) {
            throw new Exception("Connection failed: " . mysqli_connect_error());
        }
        return self::$conn;
    }

    public static function disconnect(): void {
        if (self::$conn) {
            mysqli_close(self::$conn);
            self::$conn = null;
        }
    }
}

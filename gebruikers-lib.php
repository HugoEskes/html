<?php

class Gebruiker {

    private $pdo = null
    private $stmt = null
    public $error;
    function __construct () { try {
        $this->pdo = new PDO(
            "mysql:host=".DB_HOST";dbname=".DB_NAME";charset=".DB_CHARSET,
            DB_USER, DB_PASSWORD
        )
    }}


}


$_GEB = new Gebruiker();

>
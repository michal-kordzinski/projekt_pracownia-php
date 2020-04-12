<?php

//klasa łącząca się z baza danych
//metody poprzedzone '_' odwoluja sie tylko do bazy danych

class Database 
{
    private static $_instance;

    private $_host = DB_HOST,
			$_username = DB_USER,
			$_password = DB_PASS,
			$_dbname = DB_NAME;

	private $_pdo,
            $_query,
            $_results,
            $_error;
                    
    private $_charset = DB_CHARSET;
    private function __construct()
    {
        //ustawianie dsn
        $dsn = "mysql:host={$this->_host};dbname={$this->_dbname};charset={$this->_charset}";
        //opcje dodatkowe do konfiguracji polaczenia
        $options  = array(
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_EMULATE_PREPARES   => FALSE,
            PDO::ATTR_PERSISTENT         => TRUE,
        );
        //polaczenie
        try {
			$this->_pdo = new PDO($dsn, $this->_username, $this->_password, $options);

		} catch(PDOException $error) { //TODO: ZMIENIC OBSLUGE WYJATKU NA KOD HTTP
			// Zwrócenie 
			http_response_code(500);
		}
    }
    //zwraca caly obiket Database
    public static function getInstance() {
        if (!isset(self::$_instance)) {
           self::$_instance = new Database();
       }		
       return self::$_instance;
    }
    //
    public function query($query, $params = array()) {
		$this->_error = false;
		$this->_results = [];

		$stmt = $this->_pdo->prepare($query);

	    if (!$stmt->execute($params)) {
			$this->_error = true;
	    } else {
	    	$this->_results = $stmt->fetchAll();
        }
        
	    return $this;
    }
    
    public function results() {
		return $this->_results;
    }

    public function first() {
		return @$this->_results[0];
	}

	public function error() {
		return $this->_error;
	}
}
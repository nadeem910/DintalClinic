<?php
session_start();

//connection to the database
class DatabaseHandler
{    
    private $conn;
    private $servername;
    private $username;
    private $password;
    private $dbname;
    private $charset;
	
    public function __construct($server,$username,$password,$db,$charset='utf8')
	{
        $this->__set('server',$server);
		$this->__set('username',$username);
		$this->__set('password',$password);
		$this->__set('db',$db);
		$this->__set('charset',$charset);
    } 

	//Setters
	public function __set($fieldName,$fieldValue)
	{
		switch($fieldName)//Setting a field according to the field name
		{
			case 'connection'://setting the database connection object
				$this->conn=$fieldValue;
			case 'server'://Setting the server to connect to
				$this->servername=$fieldValue;
			case 'username'://Setting the username to connect with
				$this->username=$fieldValue;
			case 'password'://Setting the password to connect eith
				$this->password=$fieldValue;
			case 'db'://Setting the database to connect to
				$this->dbname=$fieldValue;
			case 'charset'://Setting the charset for the connection
				$this->charset=$fieldValue;
		}
	}
	
	//Getters
	public function __get($fieldName)
	{
		switch($fieldName)//Getting a field according to the field name
		{
			case 'connection'://Returning the database connection object
				return $this->conn;
			case 'server'://Server to connect to
				return $this->servername;
			case 'username'://Username to connect with
				return $this->username;
			case 'password'://Password to connect eith
				return $this->password;
			case 'db'://Database to connect to
				return $this->dbname;
			case 'charset'://Charset for the connection
				return $this->charset;
		}
	}
	
	/*
	Method that establishes a new databse connection
	*/
    public function connect()
    {
		try
		{
			$this->conn = new PDO("mysql:host=".$this->__get('server').";dbname=".$this->__get('db').";charset=".$this->__get('charset'), $this->__get('username'), $this->__get('password'));
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
		}
		catch(Exception $e)
		{
			echo "לא ניתן להתחבר לבסיס נתונים";
		}
    }   
	
	//Method that disconnects from the server
    public function disconnect()
    {
        $this->conn = null;
    }  
	
	/*
	Method that returns an array of records according to the query that is passed as a parameter (SELECT)
	*/
	public function getRecords($query,$conditions=array())
	{
		$this->connect();//Connecting the database
		
		$get=$this->__get('connection')->prepare($query); 
        $get->execute($conditions);             
        $records=$get->fetchAll();//Getting the records
		
		$this->disconnect();//Disconnecting the database
		
		return $records;//Returning the records we are getting from the database
	}
	
	/*
	Method that updates/deletes/inserts
	*/
	public function commitQuery($query,$conditions=array())
	{
		$this->connect();//Connecting the database
		
		$get=$this->__get('connection')->prepare($query); 
        $get->execute($conditions);//תנאים לשאילתה
		$this->disconnect();//Disconnecting the database		
	}
}
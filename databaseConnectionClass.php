<?php

class databaseConnection {
    //put your code here
    
 
  var $host = "localhost";
  var $username = "root"; // specify the sever details for mysql
  var $password = '';
  var $database = "mer_system";
  var $myconn;
  
  public function connectToDatabase() { // create a function for connect database
  $conn = mysqli_connect($this->host, $this->username, $this->password,$this->database);
  return $conn;
  }

  function selectDatabase($conn) { // selecting the database.
  return $conn;
  }

  function closeConnection($conn) { // close the connection
  mysqli_close($conn);
   
  }

}



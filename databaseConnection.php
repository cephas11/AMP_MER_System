â<?php

class databaseConnection //create a class for make connection
 {

    var $host = "localhost";
    var $username = "root";    // specify the sever details for mysql
    var $password = 'p@$$w0rd';
    var $database = "mer_system";
    var $myconn;
 
    public function connectToDatabase() { // create a function for connect database
	 $conn = mysqli_connect($this->host, $this->username, $this->password,"mer_system");
	///$conn = mysql_connect("localhost","root","");
        //$conn = mysql_connect($this->host, $this->username, $this->password);
        /*if (!$conn) {// testing the connection
            die("Cannot connect to the database");
        } else {
            $this->myconn = $conn;
            echo "Connection established";
        }*/
        return $conn;
    }

    function selectDatabase() { // selecting the database.
//        mysql_select_db($this->database);  //use php inbuild functions for select database
 //       if (mysql_error()) { // if error occured display the error message
  //          echo "Cannot find the database " . $this->database;
   //     }
        //   echo "Database selected..";
    }

    function closeConnection() { // close the connection
     //   mysql_close($this->myconn);
        //    echo "Connection closed";
    }

}

?>

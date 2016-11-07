<?php

class databaseConnection {

    //put your code here



    var $host = "localhost";
    var $username = "root"; //  
    var $password = 'p@$$w0rd';
    //var $password = '';
    var $database = "mer_system";
    var $myconn;

    public function connectToDatabase() { // create a function for connect database
        $conn = mysqli_connect($this->host, $this->username, $this->password, $this->database);
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        $query = mysqli_query($conn, "set @@session.tx_isolation='READ-UNCOMMITTED");

        // conn.commit(True);
        return $conn;
    }

    function selectDatabase($conn) { // selecting the database.
        return $conn;
    }

    function closeConnection($conn) { // close the connection
        mysqli_close($conn);
    }

}

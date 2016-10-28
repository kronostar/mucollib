<?php
//DB.class.php

class DB {
  protected $db_name = 'mucollib';
  protected $db_user = 'mucollib';
  protected $db_pass = 'mucollib';
  protected $db_host = 'localhost';
  protected $connection;

  //open a connection to the database.  Must be called on every page that
  //needs to use the database.
  public function connect() {
    $this->connection = mysql_connect($this->db_host, $this->db_user, $this->db_pass);
    if(!$this-connection) {
      die('Connection to $this->db_host not established: ' . mysql_errot());
    }

    $db_selected = mysql_select_db($this->db_name);
    if(!$db_slected) {
      die('Can\'t use $this->db_name: ' . mysql_error());
    }

    return true;
  }

  //close a database connection
  //must be called on every page taht uses the database
  public function disconnect() {
    mysql_close($this->connection);
  }

  //get an associative array of rows, keys are are the column names.
  //if singleRow = true then returns one row instead of an array of rows
  public function processRowSet($rowSet, $singleRow = false) {
    $resultArray = array();

    while($row = mysql_fetch_assoc($rowSet)) {
      array_push($resultArray, $row);
    }

    if($singleRow === true) return $resultArray[0];

    return $resultArray;
  }

  //select rows fromn the database
  //returns a full row or rows from $table using $where as the where clause
  //return value is an associative array with column names as keys
  public function select($table, $where) {
    $sql = "SELECT * FROM $table WHERE $where";
    $result = mysql_query($sql);

    if(mysql_num_rows($result) == 1) return $this->processRowSet($result, true);

    return $this->processRowSet($result);
  }

  //updates a current row in the database
  //takes an array of data, where the keys are the column names
  //and the values are the data that will be inserted into these columns
  //$table is the name of the tabe and $where is the sql where clause
  public function update($data, $table, $where) {
    foreach($data as $column => $value) {
      $sql = "UPDATE $table SET $column = $value WHERE $where";
      mysql_query($sql) or die(mysql_error());
    }
  }

  //inserts a row into the database
  //takes an array of data, where the keys are the column names
  //and the values are the data that will be inserted into those columns
  //$table is the name of the table
  public function insert($data, $table) {
    $columns = "";
    $values = "";

    foreach($data as $column => $value) {
      $columns .= ($columns == "") ? "" : ", ";
      $columns .= $column;
      $values .= ($values == "") ? "" : ", ";
      $values .= $value;
    }

    $sql = "INSERT INTO $table ($columns) values ($values)";
    mysql_query($sql) or die(mysql_error());
  }

  //deletes a row from a database
  //$table is the name of the tabe and $where is the sql where clause
  public function delete($table, $where) {
    $sql = "DELETE FROM $table WHERE $where";
    mysql_query($sql) or die(mysql_error());
  }
}

?>

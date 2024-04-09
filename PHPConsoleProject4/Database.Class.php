<?php

/**
 * Database short summary.
 *
 * Database description.
 *
 * @version 1.0
 * @author bertdegenhartdrenth
 */
class Database
{
  public function __construct(string $host, string $database, string $user, string $password)
  {
    $this->Host = $host;
    $this->Database = $database;
    $this->User = $user;
    $this->Password = $password;
    $this->database = new PDO("mysql:host={$this->Host};dbname={$this->Database}", 
      $this->User, $this->Password);
  }

  public function Insert(string $table, object $o)
  {
    $columns = "";
    $params = "";
    $first = true;
    foreach ($o as $key => $value )
    {
      if (!$first)
      {
        $columns .= ", ";
        $params .= ", ";
      }
      $columns .= $key;
      $params .= ":$key";
      $first = false;
    }

    $statement = $this->database->prepare("insert into $table ($columns) values ($params)");

    foreach ($o as $key => $value)
    {
      $statement->bindParam($key, $value);
    }

    $statement->execute();
  }

  public function Select(string $table, array $columns, string $where = "", array $params = [])
  {
    $c = implode(", ", $columns);
    $sql = "select $c from $table $where";

  }

  private string $User;
  private string $Password;
  private string $Database;
  private string $Host;
  private PDO $database;

}
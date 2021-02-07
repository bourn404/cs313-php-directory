<?php

function connectDB() {
  $dbUrl = getenv('DATABASE_URL');

  if (empty($dbUrl)) {
      // example localhost configuration URL with postgres username and a database called cs313db
      $dbUrl = "postgres://axbukkoxjszrqe:ddd8aa8da886b00f6b607b5d2144a71151a3f725b0cc7666b9c2189752c77046@ec2-52-4-177-4.compute-1.amazonaws.com:5432/d7ojiim1rrunjs";
  }

  $dbopts = parse_url($dbUrl);

  $dbHost = $dbopts["host"];
  $dbPort = $dbopts["port"];
  $dbUser = $dbopts["user"];
  $dbPassword = $dbopts["pass"];
  $dbName = ltrim($dbopts["path"],'/');

  $dsn = "pgsql:host=$dbHost;port=$dbPort;dbname=$dbName";
  $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
  // Create the actual connection object and assign it to a variable
  try {
      $link = new PDO($dsn, $dbUser, $dbPassword, $options);
      if(is_object($link)) {
          return $link;
      }
  } catch(PDOException $e) {
      var_dump($e);
      exit;
  }
}

?>
<?php
try{
  $db= new PDO("mysql:host=localhost;dbname=sociality;charset=utf8",'root','4736');
}

catch (PDOException $e) {
  echo $e->getMessage();
}

?>

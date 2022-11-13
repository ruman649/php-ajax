<?php

include_once 'config.php';
$id = $_POST['id'];
$de  = "delete from sql_ajax where id={$id}";
$de_q = mysqli_query($connect, $de);

if($de_q){
  echo 1;
}
else{
  echo 0;
}

?>

<?php
include_once 'config.php';
$id = $_POST['id'];
$name = $_POST['name'];
$age = $_POST['age'];

$up = "update sql_ajax set name='{$name}', age='{$age}' where id={$id} ";
$up_q = mysqli_query($connect, $up);

if($up_q){
  echo 1;
}
else{
  echo 0;
}

?>

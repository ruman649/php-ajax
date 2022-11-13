<?php
include_once 'config.php';

$f_name = $_POST['f_name'];
$l_name = $_POST['l_name'];

$in = "insert into sql_ajax (name, age) values ('$f_name','$l_name')";
$in_q = mysqli_query($connect, $in) or die("query fail");

if($in_q){
  // echo "data inserted successfull";
  echo 1;
}
else{
  echo 0;
}





?>

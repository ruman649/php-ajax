<?php
include_once 'config.php';

$search = $_POST['search'];

$s = "SELECT * from sql_ajax where name like '%{$search}%' or age like '%{$search}%' ";
$q = mysqli_query($connect, $s);
$result = "";
if(mysqli_num_rows($q) > 0){
  while($row = mysqli_fetch_assoc($q)){
    $result .= "
    <tr>
      <td>{$row['id']}</td>
      <td>{$row['name']}</td>
      <td>{$row['age']}</td>
      <td><button class='delete_btn' data-id='{$row['id']}'>Delete</button></td>
      <td><button class='edit_btn' data-eid='{$row['id']}'>Edit</button></td>
    </tr>
    ";
  }
  echo $result;
}
else{
  echo "<h1 style='color:red; '>data not found </h1>";
}

?>

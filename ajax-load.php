<?php
include_once 'config.php';

$select = "select * from sql_ajax";
$s_q = mysqli_query($connect, $select);

$result = "";
if (mysqli_num_rows($s_q) > 0) {
  while ($row = mysqli_fetch_assoc($s_q)) {
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

} else {
  echo "data not found";
}

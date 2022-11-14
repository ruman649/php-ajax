<?php
include_once 'config.php';

$limit = 5;

if (isset($_POST['page'])) {
   $page = $_POST['page'];
} else {
   $page = 1;
}
$offset = ($page - 1) * $limit;


$select = "select * from sql_ajax limit {$offset}, {$limit} ";
$s_q = mysqli_query($connect, $select);

$result = "
<table border='1px' cellspadding='10px' cellspacing='0' width='100%'>
<thead>
   <tr>
      <th>id</th>
      <th>name</th>
      <th>age</th>
      <th>delete</th>
      <th>Edit</th>
   </tr>
</thead>
<tbody id='table_data'>

";
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
   $result .= '
   </tbody>
   </table>
 ';


   $s = "select * from sql_ajax ";
   $q = mysqli_query($connect, $s);
   $total = mysqli_num_rows($q);

   $total_page = ceil($total / $limit);

   $result .= '<div id="pagination">';
   for ($i = 1; $i <= $total_page; $i++) {

      if ($page == $i) {
         $active = "background-color: #1d10d3;";
      } else {
         $active = "";
      }
      $result .= "
          <li style='{$active}'><a  id='{$i}' href=''>{$i}</a></li>
     ";
   }
   $result .= '</div>';

   echo $result;
} else {
   echo "data not found";
}

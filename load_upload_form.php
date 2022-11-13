<?php
include_once "config.php";

$s_id = $_POST['id'];

$sel = "select * from sql_ajax where id={$s_id} ";
$sel_q = mysqli_query($connect, $sel);

$result = "";
if (mysqli_num_rows($sel_q) > 0) {
    while ($row = mysqli_fetch_assoc($sel_q)) {

        $result .= "
            <tr>
                // <td>Name</td>
                <td><input type='hidden' value='{$row["id"]}' name='id' id='id'></td>
            </tr> 
            <tr>
                <td>Name</td>
                <td><input type='text' value='{$row["name"]}' name='name' id='name'></td>
            </tr>
            <tr>
                <td>Age</td>
                <td><input type='text' name='' value='{$row["age"]}' id='age'></td>
            </tr>
            <tr>
                <td></td>
                <td><input type='submit' id='edit_data' value='Edit'></td>
            </tr>
        ";
    }
    echo $result;
} else {
    echo "data not found";
}

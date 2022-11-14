<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>PHP & Ajax CRUD</title>
   <link rel="stylesheet" href="css/style.css">
</head>

<body>

   <div class="meg_box ">
      <div id="err "></div>
      <div id="success"></div>
   </div>

   <table id="main" border="0" cellspacing="0">
      <tr>
         <td id="header">
            <h1>PHP & Ajax CRUD</h1>
            <h1 id="load">load</h1>
            <div id="search-bar">
               <label>Search :</label>
               <input type="text" id="search" autocomplete="off">
            </div>
         </td>
      </tr>
      <tr>
         <td id="table-form">
            <form id="addForm">
               First Name : <input type="text" id="fname">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               Last Name : <input type="text" id="lname">
               <input type="submit" id="save_button" value="Save">
            </form>
         </td>
      </tr>
      <tr>

         <!-- show data  -->
         <td id="table-data">
            <!-- <table border="1px" cellspadding='10px' cellspacing='0' width='100%'>
               <thead>
                  <tr>
                     <th>id</th>
                     <th>name</th>
                     <th>age</th>
                     <th>delete</th>
                     <th>Edit</th>
                  </tr>
               </thead>
               <tbody id="table_data">
                  
               </tbody>
            </table> -->

            <!-- <div id="pagination"> -->
               <!-- <a id="1" href="">1</a>
               <a id="2" href="">2</a> -->
               <!-- <a id="3" href="">3</a> -->
            <!-- </div> -->

         </td>

      </tr>
   </table>

   <div id="error-message"></div>
   <div id="success-message"></div>


   <div id="modal">
      <div id="modal-form">
         <h2>Edit Form</h2>
         <table id="table" cellpadding="10px" width="100%">

         </table>
         <div id="close-btn">X</div>
      </div>
   </div>



   <script src="./js/jquery.js"></script>
   <script>
      // //data doal by click 
      // $(document).ready(function() {
      //   $("#load").on("click", function(e) {
      //     $.ajax({
      //       url: "ajax-load.php",
      //       type: "post",
      //       // data:,
      //       success: function(data) {
      //         $("#table_data").html(data);
      //       }
      //     })
      //   })
      // });

      $(document).ready(function() {

         // data load by page load 
         function loadInsert(pagination_nu) {
            $.ajax({
               url: "ajax-load.php",
               type: "post",
               data: {
                  page: pagination_nu
               },
               success: function(data) {
                  $("#table-data").html(data);
               }
            })
         }
         loadInsert();


         // data insert into database and show
         $("#save_button").on('click', function(e) {
            e.preventDefault();
            let fname = $("#fname").val();
            let lname = $("#lname").val();
            if (fname == '' || lname == '') {
               $("#err").html("fill all fiels").slideDown();

               $('#success').slideUp();
            } else {
               $.ajax({
                  url: "ajax-insert.php",
                  type: 'post',
                  data: {
                     f_name: fname,
                     l_name: lname
                  },
                  success: function(data) {
                     if (data == 1) {
                        loadInsert();
                        $('#addForm').trigger('reset');
                        $('#success').html("data inserted successful").slideDown();
                        $('#err').slideUp();
                     } else {
                        $('#err').html("cant save data");
                        $("#success").slideUp();
                     }
                  }
               });
            }
         });


         // delete data from datadase ajx 
         $(document).on('click', ".delete_btn", function() {
            let id = $(this).data("id");
            let elem = this;
            // alert(id);
            $.ajax({
               url: "ajax-delete.php",
               type: 'post',
               data: {
                  id: id
               },
               success: function(data) {
                  if (data == 1) {
                     $(elem).closest("tr").fadeOut();
                     $('#success').html("delete successfully").slideDown();
                     $('#err').slideUp();
                  } else {
                     $('#err').html('cant delete record').slideDown();
                     $('#success').slideUp();
                  }
               }
            })
         })


         // update data from database 
         // show modal box 
         $(document).on('click', ".edit_btn", function() {
            $('#modal').show();
            let eid = $(this).data('eid');
            // alert(id);
            $.ajax({
               url: "load_upload_form.php",
               type: "post",
               data: {
                  id: eid
               },
               success: function(data) {
                  $('#table').html(data);
               }
            })
         });
         //hide modal box
         $('#close-btn').on('click', function() {
            $('#modal').hide();
         });

         // update data 
         $(document).on('click', '#edit_data', function() {
            let id = $('#id').val();
            let name = $('#name').val();
            let age = $('#age').val();
            if (name == '' || age == '') {
               // error message
            } else {
               $.ajax({
                  url: 'update_data.php',
                  type: 'post',
                  data: {
                     id: id,
                     name: name,
                     age: age
                  },
                  success: function(data) {
                     if (data == 1) {
                        $('#modal').hide();
                        loadInsert();
                     }
                  }
               })
            }
         })


         //search bar 
         $('#search').on('keyup', function() {
            // e.preventDefault();
            let search = $(this).val();

            $.ajax({
               url: "search.php",
               type: "post",
               data: {
                  search: search
               },
               success: function(data) {
                  $('#table-data').html(data);
               }
            })

         })


         // pagination 
         $(document).on('click', '#pagination a', function(e){
            e.preventDefault();
            let id = $(this).attr('id');
            loadInsert(id);
         })


      });
   </script>


</body>

</html>
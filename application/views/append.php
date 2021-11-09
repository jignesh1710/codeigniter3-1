<html>  
      <head>  
           <title>Dynamically Add or Remove input fields in PHP with JQuery</title>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
      </head>  
      <body>  
           <div class="container">  
                <br />  
                <br />  
                <h2 align="center">Dynamically Add or Remove input fields in PHP with JQuery</h2>  
                <div class="form-group">  
                     <form action="<?php echo base_url()?>welcome/appendcode"  method="post">  
                     <!-- <form name="add_name" id="add_name">   -->
                          <div class="table-responsive">  
                               <table class="table table-bordered" id="dynamic_field">  
                                    <tr>  
                                         <td><input type="text" name="name[]" placeholder="Enter your Name" class="form-control name_list" /></td> 
                                         <td><input type="text" name="lname[]" placeholder="Enter your Last Name" class="form-control name_list" /></td>  
                                         <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>  
                                    </tr>  
                               </table>  
                               <input type="submit" name="submit" id="submit" class="btn btn-info" value="Submit" />  
                          </div>  
                    
                     </form>  
                </div>  
           </div> 
           <table class="table table-bordered" id="dynamic_field"> 
           <?php $query=$this->db->query("select * from append")->result_array();
          //  print_r("<pre>");
          //  print_r($query);
          //  exit();?>
          <tr>
               <th>Id</th>
               <th>First Name</th> 
               <th>Last Name</th> 
               <th>Action</th> 
          </tr> 
          <?php  foreach($query as $row)
           {
               $name=$row['name'];
               $lname=$row['lname'];
               $test = unserialize($name);
               $lname1 = unserialize($lname);
               // print_r("<pre");
               // print_r($test);
               $count=count($lname1);
               ?>
               <tr>
                    <td><?php  echo $row['id'];?></td>
                    <td><?php for($i=0;$i<$count;$i++){ echo $test[$i].'<br>';}?></td> 
                    <td><?php  for($i=0;$i<$count;$i++){echo $lname1[$i].'<br>';}?></td>
                    <td><a href="<?php echo base_url();?>welcome/appendedit/<?php echo $row['id']?>" class="btn btn-success">Edit</a>&nbsp;&nbsp;<a href="<?php echo base_url();?>welcome/delete/<?php echo $row['id']?>" class="btn btn-danger"  onclick='confirm("Press a button!");'>Delete</a></td> 
               </tr>
               <?php }  ?>
          </table>   
          
           
           
      </body>  
 </html>  
 <script>  
 $(document).ready(function(){  
      var i=1;  
      $('#add').click(function(){  
           i++;  
           $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="name[]" placeholder="Enter your Name" class="form-control name_list" /></td><td><input type="text" name="lname[]" placeholder="Enter your Last Name" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
      });  
      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });  
    //   $('#submit').click(function(){            
    //        $.ajax({  
    //             url:"name.php",  
    //             method:"POST",  
    //             data:$('#add_name').serialize(),  
    //             success:function(data)  
    //             {  
    //                  alert(data);  
    //                  $('#add_name')[0].reset();  
    //             }  
    //        });  
    //   });  
 });  
 </script>
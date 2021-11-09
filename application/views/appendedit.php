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
                <h2 align="center">Dynamically Edit or Remove input fields in PHP with JQuery</h2>  
                <div class="form-group">  
                     <form action="<?php echo base_url()?>welcome/appendeditcode"  method="post">  
                     <!-- <form name="add_name" id="add_name">   -->
                     <input type="hidden" name="id" value="<?php echo $edit->id;?>" placeholder="Enter your Name" class="form-control name_list" />
                          <div class="table-responsive">  
                               <table class="table table-bordered" id="dynamic_field"> 
                               <?php
                                    $name=$edit->name;
                                    $lname=$edit->lname;
                                    $test = unserialize($name);
                                    $lname1 = unserialize($lname);
                                    // print_r("<pre");
                                    // print_r($test);
                                    // exit();
                                    $count=count($lname1);
                                    // print_r($count);
                                    $j=0;
                                    for($i=0;$i<$count;$i++){
                                         $j++;
                                ?>
                                    <tr id="row<?php echo $j;?>">  
                                         <td><input type="text" name="name[]" value="<?php echo $test[$i]?>" placeholder="Enter your Name" class="form-control name_list" /></td> 
                                         <td><input type="text" name="lname[]" value="<?php echo $lname1[$i]?>" placeholder="Enter your Last Name" class="form-control name_list" /></td>  
                                         <td><button type="button" name="remove" id="<?php echo $j;?>" class="btn btn-danger btn_remove">X</button></td>
                                    </tr> 
                                <?php  } ?>
                                <tr >
                                    <td></td><td></td><td colspan="2"><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>  
                                </tr>     
                               </table>  
                               <input type="submit" name="submit" id="submit" class="btn btn-info" value="Submit" />  
                          </div>  
                    
                     </form>  
                </div>  
           </div> 
        
          
           
           
      </body>  
 </html>  
 <script>  
 $(document).ready(function(){  
      var i=1;  
      $('#add').click(function(){  
           i++;  
           $('#dynamic_field').append('<tr id="rowhello'+i+'"><td><input type="text" name="name[]" placeholder="Enter your Name" class="form-control name_list" /></td><td><input type="text" name="lname[]" placeholder="Enter your Last Name" class="form-control name_list" /></td><td><button type="button" name="remove" id="hello'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
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
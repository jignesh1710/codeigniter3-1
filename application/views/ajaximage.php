
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
<br>
<div class="offset-md-4 col-md-4" style="
    background-color: aliceblue;
    padding: 40px;
">
<?php echo validation_errors("<div style='color:red;'>","</div>");?>
<form class="submit" method="post"> 
<div class="form-group">
      <label for="pwd">Fullname:</label>
      <input type="text" class="form-control" id="fullname" placeholder="Enter password" name="fullname">
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="file" class="form-control" id="file" placeholder="Enter password" name="file">
    </div>
    <button type="submit"  class="btn btn-default">Submit</button>
  </form>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">

$(document).ready(function(){
$('.submit').submit(function(e){
 e.preventDefault();
 $.ajax(
     {
         type:"post",
         url:"<?php echo base_url();?>hello/ajaxcode",
         data:new FormData(this),
         contentType:false,
         processData:false,
         success:function(data)
         {
           console.log(data);
         }

     });
});
});
</script>
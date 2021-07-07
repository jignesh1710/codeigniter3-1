
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
<br>
<div class="offset-md-4 col-md-4" style="
    background-color: aliceblue;
    padding: 40px;
">
<?php echo validation_errors("<div style='color:red;'>","</div>");?>
<?php echo form_open_multipart(base_url('hello/emailsend'), 'class="form-horizontal"');  ?> 

  <div class="form-group">
    <label for="exampleInputPassword1">Email</label>
    <input type="text" class="form-control" name="email">
  </div>
 
  <input type="submit" class="btn btn-primary" name="submit">
</form>
</div>

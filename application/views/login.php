<title>Login</title>
<link href="<?php echo base_url(); ?>themes/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>themes/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>themes/css/responsive.bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>themes/css/fronted.css" rel="stylesheet">


<script src="<?php echo base_url(); ?>themes/js/jquery-1.12.0.min.js"></script>

<div class="content">
    <div class="boxes">
       <div class="exitinguser">
           <h2>Sign In<span>For existing users</span></h2>
        <form id="loginform" >
           <fieldset class="form-group">               
               <input type="text" class="form-control" name="email" id="uid" placeholder="User Id" required>                           
               <input type="password" class="form-control" name="password" id="pass" placeholder="Password" required>  
           </fieldset>
           <button type="submit" id="addsubject" class="btn">Sign In</button>
           <div id="loading1"><img src="<?php echo base_url(); ?>/themes/images/opc-ajax-loader.gif"></div>
       </form>         
    </div>
    <div class="newuser">
        <h2>Sign Up<span>For new users</span></h2>
        <form id="registerform">
           <fieldset class="form-group">               
               <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Firstname" required>                           
               <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Lastname" required>  
               <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>  
               <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>  
               <input type="city" class="form-control" name="city" id="city" placeholder="City" required>  
               <input type="state" class="form-control" name="state" id="state" placeholder="State" required>  
               <input type="country" class="form-control" name="country" id="country" placeholder="Country" required>  
               <input type="phone" class="form-control" name="phone" id="phone" placeholder="Phone" required>  
           </fieldset>
           <button type="submit" id="addsubject" class="btn">Sign Up</button>
           <div id="loading2"><img src="<?php echo base_url(); ?>/themes/images/opc-ajax-loader.gif"></div>
       </form>         
    </div>    
    </div>    
</div>
<script type='text/javascript'>
    $('#loading1').hide();
    /* attach a submit handler to the form */
    $("#loginform").submit(function(event) {

      /* stop form from submitting normally */
      event.preventDefault();
        $.ajax({
            url : "<?php echo base_url(); ?>index/logincheck",
            type: "POST",              
            data: $("#loginform").serialize(),
            beforeSend: function(){
              $('#loading1').show();
            },
            success: function(data, textStatus, jqXHR){
                $('#loading1').hide();                
                data = JSON.parse(data);
                if(data != ""){
                    var email = data[0]['email'];
                    if(email != ""){
                      window.location = "<?php echo base_url(); ?>";
                    }else{
                        alert("User id and password are incorrect..!");
                    }
                }else{
                alert("User id and password are incorrect..!");
                }
            },
            error: function (jqXHR, textStatus, errorThrown){

            }
        });
    });
</script>
<script type='text/javascript'>
     $('#loading2').hide();
    /* attach a submit handler to the form */
    $("#registerform").submit(function(event) {

      /* stop form from submitting normally */
      event.preventDefault();
        $.ajax({
            url : "<?php echo base_url(); ?>users/addnew",
            type: "POST",              
             data: {firstname: $('#firstname').val(), 
          lastname: $('#lastname').val(),
          email: $('#email').val(),
          password: $('#password').val(),
          city: $('#city').val(),
          state: $('#state').val(),
          country: $('#country').val(),
          phone: $('#phone').val() },
            beforeSend: function(){
              $('#loading2').show();
            },
            success: function(data, textStatus, jqXHR){
                 $('#loading2').hide();
                 data = JSON.parse(data);
                 if(data['login']==true){
                    window.location = "<?php echo base_url(); ?>";
                }else{
                    alert(data['message']);
                }
            },
            error: function (jqXHR, textStatus, errorThrown){

            }
        });
     });   
     
</script>
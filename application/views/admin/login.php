<div class="login-box">
    <div class="inner">
        <div class="heading">Quiz System</div>
        <div class="form-group">
               <form id="loginform" >
                    <fieldset class="form-group">
                        <label for="User">User:</label>
                        <input type="text" class="form-control" name="email" id="uid" placeholder="User Id" required>            
                        <label for="Name">Password:</label>
                        <input type="password" class="form-control" name="password" id="pass" placeholder="Password" required>  
                    </fieldset>
                    <button type="submit" id="addsubject" class="btn"><span class="glyphicon glyphicon-ok"></span> Done</button>
                </form> 

        </div>    
    </div>   
</div>   
<script type='text/javascript'>
      $("#loginform").submit(function(event){
           event.preventDefault();
       $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>admin/index/logincheck",
            data: $("#loginform").serialize(),
            beforeSend: function(){
                
              $('#loginloading').show();
              
            },
            success: function(data) {
              $('#loginloading').hide();
              data = JSON.parse(data);
              if(data != ""){
              var email = data[0]['email'];
              if(email != ""){
                    $('#loginloading').hide();
                  $.session.set('islogin','true');
                   $.session.set('uid',data[0]['id']);
                  gotoHome();
              }
               }else{
                   alert("User name and password is incorrect!");
                   gotoLogin();
               }
            }
         });
     });
     
     function gotoHome(){
      $.ajax({
            url : "<?php echo base_url(); ?>admin/index/admin",
            type: "POST",   
            beforeSend: function(){
              $('#loginloading').show();
            },
            success: function(data, textStatus, jqXHR)
            {
                $('#loginloading').hide();                
                $('.content-wrapper').html(data);
            },
            error: function (jqXHR, textStatus, errorThrown)
            {

            }
        });
     }
      function gotoLogin(){
      $.ajax({
            url : "<?php echo base_url(); ?>admin/index/login",
            type: "POST",   
            beforeSend: function(){
              $('#loginloading').show();
            },
            success: function(data, textStatus, jqXHR)
            {
                $('#loginloading').hide();                
                $('.content-wrapper').html(data);
            },
            error: function (jqXHR, textStatus, errorThrown)
            {

            }
        });
     }
</script>
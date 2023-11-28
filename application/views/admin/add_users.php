<div class="head">
    <h2>Users</h2>    
    <div class="buttons">
        
         <button class="btn-add btn lal js__p_start" id='save'>Cancel</button>   
    </div>
</div>
<section class="tabs">
    <div class="clear-shadow"></div>
            <!-- Ebay Products -->
            <div class="content-1 userform">                             
                <form id="userform" action="<?php echo base_url(); ?>admin/users/insert">
                    <fieldset class="form-group">
                        <div class="col-lg-6">
                            <label for="firstname">Firstname:</label>
                            <input type="text" class="form-control" id="firstname" placeholder="Enter Firstname" required>            
                        </div>
                        <div class="col-lg-6">
                            <label for="lastname">Lastname:</label>
                            <input type="text" class="form-control" id="lastname" placeholder="Enter Lastname" required>            
                        </div>
                        <div class="col-lg-6">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter Emai" required>            
                        </div>
                        <div class="col-lg-6">
                            <label for="password">password:</label>
                            <input type="password" class="form-control" id="password" placeholder="Enter Password" required>            
                        </div>
                        <div class="col-lg-6">
                            <label for="city">city:</label>
                            <input type="text" class="form-control" id="city" placeholder="Enter city" required>            
                        </div>
                        <div class="col-lg-6">
                            <label for="state">state:</label>
                            <input type="text" class="form-control" id="state" placeholder="Enter state" required>            
                        </div>
                        <div class="col-lg-6">
                            <label for="country">Country:</label>
                            <input type="text" class="form-control" id="country" placeholder="Enter Country" required>            
                        </div>
                        <div class="col-lg-6">
                            <label for="phone">Phone:</label>
                            <input type="text" class="form-control" id="phone" placeholder="Enter phone" required>            
                        </div>
                        <div class="col-lg-12">
                       <button style="float:left;" type="submit" id="addsubject" class="btn"><span class="glyphicon glyphicon-ok"></span> Done</button>
                       <div class="col-lg-6">
                    </fieldset>        
               
            </div>
</section>
<script type='text/javascript'>
    /* attach a submit handler to the form */
    $("#userform").submit(function(event) {

      /* stop form from submitting normally */
      event.preventDefault();

      /* get the action attribute from the <form action=""> element */
      var $form = $( this ),
          url = $form.attr( 'action' );

      /* Send the data using post with element id name and name2*/
      var posting = $.post( url, { firstname: $('#firstname').val(), 
          lastname: $('#lastname').val(),
          email: $('#email').val(),
          password: $('#password').val(),
          city: $('#city').val(),
          state: $('#state').val(),
          country: $('#country').val(),
          phone: $('#phone').val() } );

      /* Alerts the results */
      posting.done(function( data ) {

        alert(data);
       $("#subjectform").trigger('reset');  
       $( ".p_close" ).trigger( "click" );
       refresh();

      });
    });
</script>
<script>    
  
      function refresh(){         
            $.ajax({
                url : "<?php echo base_url(); ?>admin/users",
                type: "POST",   
                beforeSend: function(){
                  $('#loading').show();
                },
                success: function(data, textStatus, jqXHR)
                {
                    $('#loading').hide();                
                    $('#users').html(data);
                },
                error: function (jqXHR, textStatus, errorThrown)
                {

                }
            });
        }
</script>
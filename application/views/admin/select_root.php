
<div class="head">
    <h2>Select Root</h2>        
</div>
<section class="tabs">
    <div class="clear-shadow"></div>
	                 
            <!-- Ebay Products -->
            <div class="content-1">                             
              <?php if(isset($roots)){ 
                 foreach ($roots as $key => $root) { ?>
                  <div class="root_box">
                    <span  class="glyphicon glyphicon-road"></span><br>
                    <a href="#" class="view_month_list" data-value="records"><?php echo $root['name']; ?></a>
                  </div>  
              <?php } } ?>
            </div>
                          
    
</section>

<script>
    $('.view_month_list').click(function() {

        var id = $(this).attr('data-value');  
        
         
        $.ajax({
            url : "http://localhost/jilanaqua/records/view_month_list/"+id,
            type: "POST",   
            beforeSend: function(){
              $('#loading').show();
            },
            success: function(data, textStatus, jqXHR)
            {
                $('#loading').hide();                
                $('#records').html(data);
            },
            error: function (jqXHR, textStatus, errorThrown)
            {

            }
        });
    });
</script>    

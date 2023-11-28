<title>Admin Panel :: Quiz System</title>
<link href="<?php echo base_url(); ?>themes/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>themes/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>themes/css/responsive.bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>themes/css/styles.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>themes/css/octicons/octicons.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>themes/css/style3.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>themes/css/jquery.popup.css" type="text/css">


<script type="text/javascript" src="<?php echo base_url(); ?>themes/js/modernizr.custom.04022.js"></script>
<script src="<?php echo base_url(); ?>themes/js/jquery-1.12.0.min.js"></script>
<script src="<?php echo base_url(); ?>themes/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>themes/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>themes/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url(); ?>themes/js/responsive.bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>themes/js/jquery.popup.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>themes/js/jquery.confirm.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>themes/js/jquerysession.js"></script>

<script>
$(document).ready(function(){
    
    var answer = $.session.get("islogin");
    if(answer != undefined){
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
        
    }else{
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
    
  
});
</script>   



<div id="loginloading"><img src="<?php echo base_url(); ?>themes/images/spinner.gif"></div>
<div class="content-wrapper">
</div>


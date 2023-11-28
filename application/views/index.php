<title>Dashboard</title>
<link href="<?php echo base_url(); ?>themes/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>themes/css/dataTables.bootstrap.min.css" rel="stylesheet">

<link href="<?php echo base_url(); ?>themes/css/responsive.bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>themes/css/fronted.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>themes/js/jquery-1.12.0.min.js"></script>


<div class="row">
    <div class="header container">
       <div class="col-md-12">
        <div class="col-sm-3">
            <h1><span>Quiz</span> System</h1>   
        </div>
        <div class="col-sm-12">
            <nav>
                <ul>
                    <li><a href="<?php echo base_url(); ?>">My Account</a></li>
                    <li><a href="<?php echo base_url(); ?>quiz">Quiz</a></li>
                    <li><a href="<?php echo base_url(); ?>index/logout">Logout</a></li>
                </ul>
            </nav>
        </div>
       </div>    
    </div>   
</div>
<div class="row">
    <div class="container">
        <div class="col-md-12">
            <div class="col-md-12">    
                <?php if(isset($current_user)){ ?>
                <div class="myaccount">
                    <ul>
                        <li class="name"><h2><?php echo $current_user[0]['firstname']." ".$current_user[0]['lastname']; ?></h2></li>
                        <li class="details">
                            <?php echo $current_user[0]['email']; ?><br>
                            <?php echo $current_user[0]['city']; ?>,<?php echo $current_user[0]['state']; ?>
                            <?php echo $current_user[0]['country']; ?>
                            <?php echo $current_user[0]['phone']; ?>
                        </li>
                    </ul>
                    <ul>
                        <form id="changepass">
                            <h5>Change Password</h5>
                            <input type="password" name="password" Placeholder='Enter New Password' id="changepassword"><br><br>
                            <button class="btn">Update</button>
                            <div id="loading"><img src="<?php echo base_url(); ?>/themes/images/opc-ajax-loader.gif"></div>
                        </form>    
                    </ul>
                </div>
                <?php } ?>
            </div>
        </div>    
    </div>
</div>    
<script>
    $('#loading').hide();
          $("#changepass").submit(function(event){
               event.preventDefault();
               $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>users/changepassword",
                    data: $("#changepass").serialize(),
                    beforeSend: function(){
                        $('#loading').show();
                    },
                    success: function(msg) {
                        $('#loading').hide();
                        alert(msg);
                    }
                });
            });
</script>    
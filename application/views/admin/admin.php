<div class="row">
	<div class="row">
        <div class="col-lg-12">
            <div class="col-sm-1 leftnavigation col-xs-3 bhoechie-tab-menu">
              <div class="list-group">
                <a href="#" class="list-group-item active text-center"data-value="dashboard"> 
                  <h4 class="glyphicon glyphicon-dashboard"></h4><br/>Dashboard
                </a>
                  <a href="#" class="list-group-item  text-center" data-value="subjects"> 
                  <h4 class="glyphicon glyphicon-road"></h4><br/>Subjects 
                </a>
                <a href="#" class="list-group-item text-center" data-value="users">
                  <h4 class="glyphicon glyphicon-user"></h4><br/>Users
                </a>
                <a href="#" class="list-group-item text-center" data-value="quiz">
                  <h4 class="glyphicon glyphicon-record"></h4><br/>Quiz 
                </a>
                       
              </div>
            </div>
            <div class="col-lg-9 middle-content col-md-9 col-sm-9 col-xs-9 bhoechie-tab">
                <div id="loading"><img src="<?php echo base_url(); ?>themes/images/spinner.gif"></div>
                <div class="bhoechie-tab-content active">
                   <div class="head">
                        <h2>Dashboard</h2> 
                         <div class="buttons">
                            <button id="logout" class="btn"> Logout</button>   
                        </div>
                   </div>
                </div>
                <div class="bhoechie-tab-content active" id="subjects">
                  
                </div>
                <div class="bhoechie-tab-content" id="users">
                  
                </div>
                <div class="bhoechie-tab-content" id="quiz">
                  
                </div>
            </div>
        </div>
  </div>
</div>   
<script>
    $('#loading').hide();          
    $(document).ready(function() {
    $("div.bhoechie-tab-menu>div.list-group>a").click(function(e) {
        e.preventDefault();
        $(this).siblings('a.active').removeClass("active");
        $(this).addClass("active");
        var index = $(this).index();
        $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
        $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
    });
});
</script>    
<script>
    
    $('#logout').click(function() {
         $.session.clear();
          $.ajax({
            url : "<?php echo base_url(); ?>admin/index/login",
            type: "POST",   
            beforeSend: function(){
              $('#loading').show();
            },
            success: function(data, textStatus, jqXHR)
            {
                $('#loading').hide();                
                $('.content-wrapper').html(data);
            },
            error: function (jqXHR, textStatus, errorThrown)
            {

            }
        });
         
         
         
    });
    
    $('.list-group-item').click(function() {
        var tab = $(this).attr('data-value');
       
        var urls = new Array();
        urls['users']="<?php echo base_url(); ?>admin/users";
        urls['quiz']="<?php echo base_url(); ?>admin/quiz";
        urls['subjects']="<?php echo base_url(); ?>admin/subjects";
         
        $.ajax({
            url : urls[tab],
            type: "POST",   
            beforeSend: function(){
              $('#loading').show();
            },
            success: function(data, textStatus, jqXHR)
            {
                $('#loading').hide();                
                $('#'+tab).html(data);
            },
            error: function (jqXHR, textStatus, errorThrown)
            {

            }
        });
    });
</script>    
<script>
            $("#simpleConfirm").confirm();
            $("#complexConfirm").confirm({
                title:"Delete confirmation",
                text: "This is very dangerous, you shouldn't do it! Are you really really sure?",
                confirm: function(button) {
                    button.fadeOut(2000).fadeIn(2000);
                    alert("You just confirmed.");
                },
                cancel: function(button) {
                    button.fadeOut(2000).fadeIn(2000);
                    alert("You aborted the operation.");
                },
                confirmButton: "Yes I am",
                cancelButton: "No"
            });
            $("#dataConfirm").confirm();
            $("#manualTrigger").click(function() {
                $.confirm({
                    text: "This is a confirmation dialog manually triggered! Please confirm:",
                    confirm: function() {
                        alert("You just confirmed.");
                    },
                    cancel: function() {
                        alert("You cancelled.");
                    }
                });
            });
        </script>

    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>
    <script src="https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js"></script>
<div class="head">
    <h2>Users</h2>    
    <div class="buttons">
    <button class="btn-add btn lal js__p_start" onclick="addnewuser()" id='addnewuser'> <span class="glyphicon glyphicon-plus"></span>Add New Users</button>   
</div>
</div>
<section class="tabs">
    <div class="clear-shadow"></div>
            <!-- Ebay Products -->
            <div class="content-1">                             
                <table id="tb_users" class="table table-striped table-bordered dt-responsive nowrap" width="100%" cellspacing="0">
                       <thead>
                            <tr>                                
                                <th>id</th>
                                <th>Name</th>
                                <th>email</th>
                                <th>country</th>
                                <th>phone</th> 
                                <th>Action</th>                                
                            </tr>
                        </thead>
                        <tbody>            
                            <?php foreach($users as $users): ?>
                            <tr>
                                <td><?php echo $users['uid']; ?></td>
                                <td><?php echo $users['firstname']; ?> <?php echo $users['lastname']; ?></td>                               
                                <td><?php echo $users['email']; ?></td>                                        
                                <td><?php echo $users['country']; ?></td>                                        
                                <td><?php echo $users['phone']; ?></td>                                        
                                <td><a onclick="editUser(<?php echo $users['uid']; ?>)" class="lal js__p_start"><span  class="glyphicon glyphicon-pencil"></span></a>
                                    <a onclick="deleteItem(<?php echo $users['uid']; ?>)" ><span class="glyphicon glyphicon-remove"></span></a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                </table><br><br><br><br><br><br><br><br><br><br><br><br>
            </div>
                            
    
</section>
<script>
    $(document).ready(function() {
        $('#tb_users').DataTable({
      
             "order": [[ 0, "desc" ]]
        });
    });
      function addnewuser(){
         
        $.ajax({
            url : "<?php echo base_url(); ?>admin/users/addUsers",
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
     function editUser(id){         
        $.ajax({
            url : "<?php echo base_url(); ?>admin/users/editUser/"+id,
            type: "POST",   
            beforeSend: function(){
              $('#loading').show();
            },
            success: function(data, textStatus, jqXHR){
                $('#loading').hide();                
                $('#users').html(data);
            },
            error: function (jqXHR, textStatus, errorThrown){

            }
        });
     }
     function deleteItem(id){
    
        if (confirm("Are you sure?")){

            $.ajax({
                url : "<?php echo base_url(); ?>admin/users/deleteuser/"+id,
                type: "POST",   
           
                success: function(data, textStatus, jqXHR){
                    alert(data);
                    refresh();
                },
                error: function (jqXHR, textStatus, errorThrown){

                }
            });
        }
        return false;
    }   
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

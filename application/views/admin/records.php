
<div class="head">
    <h2>Daily Records History</h2>    
    <div class="buttons">
      <button class="btn-add btn lal js__p_start" id='addnewrecores'> <span class="glyphicon glyphicon-plus"></span> Add New Records</button>   
    </div>
</div>
<section class="tabs">
    <div class="clear-shadow"></div>
	                 
            <!-- Ebay Products -->
            <div class="content-1">                             
                <table id="tb_records_customer" class="table table-striped table-bordered dt-responsive nowrap" width="100%" cellspacing="0">
                       <thead>
                            <tr>                                
                                <th>id</th>
                                <th>Name</th>
                                <th>Root</th>                                
                                <th>Action</th>                                
                            </tr>
                        </thead>
                        <tbody>            
                            <?php foreach($customers as $customer): ?>
                            <tr>                                
                                <td><?php echo $customer['cust_id']; ?></td>
                                <td><?php echo $customer['name']; ?></td>
                                <td><?php echo $customer['root_name']; ?></td>                                
                                <td><a href="#" class="view_month_list" data-value="<?php echo $customer['cust_id']; ?>"><span  class="glyphicon glyphicon-eye-open"></span></a>
                                    
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                </table><br><br><br><br><br><br><br><br><br><br><br><br>
            </div>
            <div class="content-2">
                   ....... 
            </div>
            <div class="content-3">
                .......
            </div>                    
    
</section>
<script>
    $(document).ready(function() {
        $('#tb_records_customer').DataTable({
      
             "order": [[ 0, "desc" ]]
        });
    });
</script>
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
<script>
    $('#addnewrecores').click(function() {
        $.ajax({
            url : "http://localhost/jilanaqua/customer/select_root",
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

<div class="head">
    <h2><?php if(isset($customer[0]['name'])) { echo $customer[0]['name']; } ?> </h2>    
</div>
<section class="tabs">
    <div class="clear-shadow"></div>	                 
            <!-- Ebay Products -->
            <div class="content-1">                             
                <table id="tb_view_month_list" class="table table-striped table-bordered dt-responsive nowrap" width="100%" cellspacing="0">
                       <thead>
                            <tr>                                
                                <th>Month/Year</th>
                                <th>Total Jag</th>
                                <th>Total Jar </th>
                                <th>Total Rs.</th>
                                <th>Pay</th> 
                                <th>Credit</th>                                
                                <th>Action</th>                                
                            </tr>
                            <tbody>            
                            <?php foreach($monthly_list as $month): ?>
                            <tr>                                
                                <td><?php echo date("F, Y",strtotime($month['month']));   ?></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>                                                                
                                <td><a href="#" class="view_month_list" data-value="records"><span  class="glyphicon glyphicon-eye-open"></span></a>
                                    
                                </td>
                            </tr>
                            <?php endforeach; ?>
                           </tbody>
                        </thead>
                        
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
        $('#tb_view_month_list').DataTable({
      
             "order": [[ 1, "ace" ]]
        });
    });
</script>

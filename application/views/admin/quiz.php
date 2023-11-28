<div class="head">
    <h2>Quiz</h2>    
    
</div>
<section class="tabs">
    <div class="clear-shadow"></div>        
        <div class="content-1">                             
                <table id="tb_subject" class="table table-striped table-bordered dt-responsive nowrap" width="100%" cellspacing="0">
                       <thead>
                            <tr>
                                <th>id</th>
                                <th>Subjects</th>
                                <th>Total Quiz</th>
                                <th>Action</th>                                
                            </tr>
                        </thead>
                        <tbody>            
                            <?php foreach($subjects as $subject): ?>
                            <tr>
                                <td><?php echo $subject['id']; ?></td>
                                <td><?php echo $subject['name']; ?></td>                                
                                <td><?php // echo $subject['description']; ?></td>                                
                                 <td><a onclick="editUser(<?php echo $subject['id']; ?>)" class="lal js__p_start"><span  class="glyphicon glyphicon-pencil"></span></a>
                                  
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                </table><br><br><br><br><br><br><br><br><br><br><br><br>
        </div>
     </div>       
</section>
<script>
  function editUser(id){         
        $.ajax({
            url : "<?php echo base_url(); ?>admin/quiz/addquiz/"+id,
            type: "POST",   
            beforeSend: function(){
              $('#loading').show();
            },
            success: function(data, textStatus, jqXHR){
                $('#loading').hide();                
                $('#quiz').html(data);
            },
            error: function (jqXHR, textStatus, errorThrown){

            }
        });
     }
</script>

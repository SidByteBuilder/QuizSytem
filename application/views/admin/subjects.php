<script type="text/javascript">
    $(function() {
      $(".js__p_start, .js__p_another_start").simplePopup();
    });
</script>
<script>
    function editform(id) {    

        $.ajax({
            url : "<?php echo base_url(); ?>admin/subjects/editsubject/"+id,
            type: "POST",   
           
            success: function(data, textStatus, jqXHR)
            {
                data = JSON.parse(data);                 
                $('#name').val(data[0]['name']);
                $('#des').val(data[0]['description']);                
                $('#sub_id').val(data[0]['id']); 
            },
            error: function (jqXHR, textStatus, errorThrown)
            {

            }
        });
    }
</script> 
<script>
$("#addnewsubject").click(function(){
   $('#sub_id').val('');
    $("#subjectform").trigger('reset');
});
</script>

<div class="head">
    <h2>Subjects</h2>    
    <div class="buttons">
    <button id="addnewsubject" class="btn-add btn lal js__p_start"> <span class="glyphicon glyphicon-plus"></span> Add New Subject</button>   
</div>
</div>
<!-- Add popup -->
<div class="p_body js__p_body js__fadeout"></div>
<div class="popup js__popup js__slide_top">
    <a href="#" class="p_close js__p_close" title="">
      <span></span><span></span>
    </a>
    <div class="p_content">
     <h2>Add New Subject</h2>   
    <form id="subjectform" action="<?php echo base_url(); ?>admin/subjects/addUpdateSubject">
        <fieldset class="form-group">
            <label for="Name">Name:</label>
            <input type="text" class="form-control" id="name" placeholder="Enter Subject Name" required>            
            <label for="Name">Description:</label>
            <textarea class="form-control" name="des" id="des"></textarea>
            <input type="hidden" class="form-control" id="sub_id" >            
        </fieldset>
        <button type="submit" id="addsubject" class="btn"><span class="glyphicon glyphicon-ok"></span> Done</button>
    </form> 
    </div>
</div>
<!-- End Add Popup-->

<section class="tabs">
    <div class="clear-shadow"></div>
	                 
            <!-- Ebay Products -->
            <div class="content-1">                             
                <table id="tb_subject" class="table table-striped table-bordered dt-responsive nowrap" width="100%" cellspacing="0">
                       <thead>
                            <tr>
                                <th>id</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Action</th>                                
                            </tr>
                        </thead>
                        <tbody>            
                            <?php foreach($subjects as $subject): ?>
                            <tr>
                                <td><?php echo $subject['id']; ?></td>
                                <td><?php echo $subject['name']; ?></td>                                
                                <td><?php echo $subject['description']; ?></td>                                
                                 <td><a href="" onclick="editform(<?php echo $subject['id']; ?>)" class="lal js__p_start"><span  class="glyphicon glyphicon-pencil"></span></a>
                                    <a onclick="deleteItem(<?php echo $subject['id']; ?>)" ><span class="glyphicon glyphicon-remove"></span></a>
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
        $('#tb_subject').DataTable({
             "order": [[ 0, "desc" ]]
        });
    });
</script>
<script type='text/javascript'>
    /* attach a submit handler to the form */
    $("#subjectform").submit(function(event) {

      /* stop form from submitting normally */
      event.preventDefault();

      /* get the action attribute from the <form action=""> element */
      var $form = $( this ),
          url = $form.attr( 'action' );

      /* Send the data using post with element id name and name2*/
      var posting = $.post( url, { name: $('#name').val(), description: $('#des').val(), id: $('#sub_id').val() } );

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
  
      function refresh() {
         
        $.ajax({
            url : "<?php echo base_url(); ?>admin/subjects",
            type: "POST",   
            beforeSend: function(){
              $('#loading').show();
            },
            success: function(data, textStatus, jqXHR)
            {
                $('#loading').hide();                
                $('#subjects').html(data);
            },
            error: function (jqXHR, textStatus, errorThrown)
            {

            }
        });
        }

    
    
    function deleteItem(id) {
    if (confirm("Are you sure?")) {

     $.ajax({
            url : "<?php echo base_url(); ?>admin/subjects/deletesubject/"+id,
            type: "POST",   
           
            success: function(data, textStatus, jqXHR)
            {
               alert(data);
               refresh();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {

            }
        });
        
    }
    return false;
}    
</script> 
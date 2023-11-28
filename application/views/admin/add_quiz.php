<div class="head">
    <h2>Quiz</h2>    
    
</div>
<section class="tabs">
    <div class="clear-shadow"></div>        
        <div class="content-1">                             
               <form name="quiz_form" id="quiz_form" action="" method="post">
                   <input type="hidden" name="sub_id" value="<?php echo $sub_id; ?>">
                    <div class="field_wrapper">
                            <div class='addquiz'>
                                <a href="javascript:void(0);" class="add_button" title="Add field">Add New<img src="<?php echo base_url(); ?>themes/images/add-icon.png"/></a>
                                <button class="" style="  border: medium none;float: right;border: medium none;float: right;font-family: dosis-b;font-size: 20px; padding: 8px 13px;">Done</button>
                            </div>
                            <?php if(isset($quiz) && !empty($quiz)):  ?>
                            <?php foreach($quiz as $quizz): ?>
                        
                            <div id="quiz">
                                <input type="text" value="<?php echo $quizz['quiz']; ?>" name="updated[<?php echo $quizz['quiz_id'] ?>][0]" >
                                <?php $choices = explode(",",$quizz['choices']) ?>
                                 <?php $i=1; foreach($choices as $choice): ?>
                                 <input type="text" value="<?php echo $choice; ?>" name="updated[<?php echo $quizz['quiz_id'] ?>][<?php echo $i ?>]" >
                                 <?php $i++; endforeach; ?>   
                                <input type="text" value="<?php echo $quizz['ans']; ?>" name="updated[<?php echo $quizz['quiz_id'] ?>][5]" >
                                <a title="Remove field" class="remove_button" href="javascript:void(0);"><img src="http://localhost/quizsystem/themes/images/remove-icon.png"></a>
                            </div>
                            
                            <?php endforeach; ?>
                            <?php endif; ?>
                    </div>
                   
                </form>
        </div>
     </div>       
</section>
<script type="text/javascript">
      $("#quiz_form").submit(function(event){
           event.preventDefault();
       $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>admin/quiz/update",
            data: $("#quiz_form").serialize(),
            beforeSend: function(){
              $('#loading').show();
            },
            success: function(msg) {
                $('#loading').hide();
                alert(msg);
             }
        });
        });
    
$(document).ready(function(){
	var maxField = 10; //Input fields increment limitation
	var addButton = $('.add_button'); //Add button selector
	var wrapper = $('.field_wrapper'); //Input field wrapper
	
	var x = 0; //Initial field counter is 1
        
	$(addButton).click(function(){ //Once add button is clicked
		if(x < maxField){ //Check maximum number of input fields
			x++; //Increment field counter
                        var fieldHTML = '<div id="quiz" class="new_quiz"><input placeholder="Quiz" type="text" name="field_name['+x+'][0]" value=""/><input placeholder="Choice 1" type="text" name="field_name['+x+'][1]" value=""/><input placeholder="Choice 2" type="text" name="field_name['+x+'][2]" value=""/><input placeholder="Choice 3" type="text" name="field_name['+x+'][3]" value=""/><input placeholder="Choice 4" type="text" name="field_name['+x+'][4]" value=""/><input placeholder="ans" type="text" name="field_name['+x+'][5]" value=""/><a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="<?php echo base_url(); ?>themes/images/remove-icon.png"/></a></div>'; //New input field html 
			$(wrapper).append(fieldHTML); // Add field html
		}
	});
	$(wrapper).on('click', '.remove_button', function(e){ //Once remove button is clicked
		e.preventDefault();
		$(this).parent('div').remove(); //Remove field html
		x--; //Decrement field counter
	});
});
</script>

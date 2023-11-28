<title>Quiz:: Select Subject</title>
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
            <h3>Choose Subject</h3>
        <?php if(isset($subjects)) { ?>
            <?php foreach($subjects as $sub) { ?>
                <div class="item item-type-spin">
                    <a class="item-hover" href="<?php echo base_url(); ?>quiz/subject/<?php echo $sub['id']; ?>">
                                <div class="item-info">
                                        <div class="headline">
                                                Are you take this exam ?
                                                <div class="line"></div>
                                                <button href="" class="btn">Go</button>
                                        </div>
                                </div>
                                <div class="mask"></div>
                        </a>
                        <h2><?php echo $sub['name'] ?></h2>
                        <img src="<?php echo base_url(); ?>themes/images/quiz-icon.png">
                </div>
        <?php } } ?> 
          </div>
         </div>   
     </div>   
 </div>   


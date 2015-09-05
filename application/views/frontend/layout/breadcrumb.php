
<!--Breadcrumb-->
<div class="container">    
    <ol class="breadcrumb">
        <?php if(isset($breadcrumb) && count($breadcrumb)){
            foreach($breadcrumb as $key => $val){
        ?>
            <li <?php if(end($breadcrumb)) echo ' class = "active" '?>><a href="<?php echo $val?>"><?php echo $key?></a></li>
        <?php
            }
        }
        ?>
    </ol>
</div>
<!--/Breadcrumb-->

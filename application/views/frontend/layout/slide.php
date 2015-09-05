<?php
    if(isset($slide_list) && count($slide_list) > 0){
?>





<!--Slide-->
<style>
    #owl-slider .item img{
        display: block;
        width: 100%;
        height: auto;
    }
</style>
<script>
    

    

    $(document).ready(function() {
        owl = $("#owl-slider");
        owl.owlCarousel({
            items : 1, //10 items above 1000px browser width
            itemsDesktop : [1140,1], //5 items between 1000px and 901px
            itemsDesktopSmall : [900,1], // betweem 900px and 601px
            itemsTablet: [600,1], //2 items between 600 and 0
            itemsMobile : false, // itemsMobile disabled - inherit from itemsTablet option
            loop: true,
            navigator : true,
            autoplay : true,
        });
    });


</script>
<div class="container">
    <div id="owl-slider">
    <?php
        foreach($slide_list as $key => $val){
    ?>
        <div class="item slide-item">
            <a href="<?php echo $val->link?>"><img src="<?php echo $val->image_link;?>" alt="<?php echo $val->caption?>"/></a>
            
            <div class="col-lg-12 slide-more">
                <h3 class="slide-title"><a href="<?php echo $val->link;?>"><?php echo $val->title;?></a></h3>
                <p class="slide-description"><?php echo $val->caption;?></p>
            </div>
        </div>
    <?php
        }
    ?>
    </div>
</div>

<!--/Slide-->

<?php
    }
?>
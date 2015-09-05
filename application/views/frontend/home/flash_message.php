<div id="flash_message">
    <script>
        $(document).ready(function(){
            stopscroll = 1;
            $(document).scroll(function(data){
                if(stopscroll)
                    $(this).scrollTop(0);
                return false;
            });
            
            $('.btn-close').click(function(){
                stopscroll = 0;
                $('#flash_message').remove();
            })
            
            $('.flash_message_bg').click(function(){
                stopscroll = 0;
                $('#flash_message').remove();
            })
        });
    </script>
    <div class="flash_message_bg">
    </div>
    
    <div class="flash-message-content">
    <div class="col-lg-12 text-right btn-close"><button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>
        <?php if(isset($flas_message)) echo html_entity_decode($flas_message);?>
    </div>
</div>
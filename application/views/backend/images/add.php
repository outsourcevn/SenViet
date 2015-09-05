<div class="col-md-12 text-justify" style="border-top: 1px #afafaf solid;">

    <ol class="breadcrumb" style="background: #d8d8d8; margin-top:20px;">
        <li><a href="<?php echo CMS_DEFAULT_BACKEND_URL?>">Trang chủ</a></li>
        <li><a href="<?php echo CMS_DEFAULT_BACKEND_URL?>/images">Images</a></li>
        <li class="active">Thêm Image</li>
    </ol>

    <?php echo form_open('')?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Thêm Image</h3>
        </div>

        <div class="panel-body">

            <?php
            if(validation_errors())
            {
                ?>
                <blockquote class="bg-warning">
                    <ul class="errors">
                        <?php
                        echo validation_errors('<li class="text-warning">', '</li>');
                        ?>
                    </ul>
                </blockquote>
            <?php
            }
            ?>

            <div class="col-md-12 item">
                <div class="col-md-3" style="line-height: 200%;"><label for="title">Tiêu đề</label></div>
                <div class="col-md-9"><input id="title" name="title" class="form-control" type="text" title="Tiêu đề" value="<?php echo (isset($post_data['title'])? $post_data['title'] : '')?>" /></div>
            </div>

            <div class="col-md-12 item">
                <div class="col-md-3" style="line-height: 200%;"><label for="image_link">Image</label></div>
                <div class="col-md-3"><input type="text" class="input-upload-image form-control" id="image_link" name="image_link" value="<?php echo (isset($post_data['image_link'])? $post_data['image_link'] : '')?>" /></div>
                <div class="col-md-6"><input type="button" class="btn btn-info" onclick="BrowseServer( 'Files:/images', 'image_link' );" value="Browse..." /></div>
            </div>
            
            <div class="col-md-12">
                <div class="col-md-3" style="line-height: 200%;"><label>Sản phẩm</label></div>
                <div class="col-md-9">
                    <input type="hidden" name="FK_id" value="<?php echo (isset($post_data['FK_id'])) ? $post_data['FK_id'] : ''?>" id="FK_id" />
                    <div class="panel panel-default">
                        <!-- Default panel contents -->
                        <div class="panel-heading" style="height: 40px;" id="ProductInput" contenteditable="" onclick="this.innerHTML = ''">Nhập tên sản phẩm...</div>
                        
                        <!-- List group -->
                        <ul class="list-group" style="display: none;" id="ListProduct">
                        </ul>
                    </div>
                </div>
            </div>
            <script>
                $(document).ready(function(){
                    $.ajax({
                            type: "GET",
                            url: '<?php echo CMS_DEFAULT_BACKEND_URL.'/images/ajax_selected_item'?>',
                            data: {'FK_id' : $('#FK_id').val()},
                            success : function(data){
                                //$('#alias').val(data);
                                $('#ProductInput').html(data);
                            }
                        });
                    
                    $('#ProductInput').keyup(function(){
                        $.ajax({
                            type: "GET",
                            url: '<?php echo CMS_DEFAULT_BACKEND_URL.'/images/ajax_search'?>',
                            data: {'query' : $('#ProductInput').html()},
                            success : function(data){
                                //$('#alias').val(data);
                                $('#ListProduct').empty();
                                $('#ListProduct').append(data);
                                $('#ListProduct').slideDown('slow');
                            }
                        });
                    });
                    
                    $(".SelectProduct").live("click", function(){
                        $('#FK_id').val($(this).attr('rel'));
                        
                        $('#ProductInput').html($(this).html());
                        
                        $('#ListProduct').slideUp('slow');
                    });
                });
            </script>
            <div class="col-md-12 item">
                <div class="col-md-3" style="line-height: 200%;"><label for="main_image">Thumbnail</label></div>
                <div class="col-md-9 text-left">
                    <label>Yes <input type="radio" name="main_image" class="" <?php echo ((isset($post_data['main_image']) && ($post_data['main_image'] == 1)) || !isset($post_data['main_image'])) ? 'checked' : ''?> value="1"/></label>&Tab;&Tab;&Tab;
                    <label>No <input type="radio" name="main_image" class="" <?php echo (isset($post_data['main_image']) && $post_data['main_image'] == 0) ? 'checked' : ''?> value="0"/></label>
                </div>
            </div>
            
            <div class="col-md-12 item">
                <div class="col-md-3" style="line-height: 200%;"><label for="main_image">Ảnh sản phẩm nổi bật</label></div>
                <div class="col-md-9 text-left">
                    <label>Yes <input type="radio" name="featured_images" class="" <?php echo ((isset($post_data['featured_images']) && ($post_data['featured_images'] == 1)) || !isset($post_data['featured_images'])) ? 'checked' : ''?> value="1"/></label>&Tab;&Tab;&Tab;
                    <label>No <input type="radio" name="featured_images" class="" <?php echo (isset($post_data['featured_images']) && $post_data['featured_images'] == 0) ? 'checked' : ''?> value="0"/></label>
                </div>
            </div>
            
            <div class="col-md-12 item text-center">
                <button name="cmd" value="submit" class="btn btn-success" type="submit">Submit</button>
                <input type="reset" class="btn" value="Reset"/>
            </div>
        </div>
    </div>
    </form>
</div>
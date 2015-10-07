<div class="col-md-12 text-justify" style="border-top: 1px #afafaf solid;">
    
    <ol class="breadcrumb" style="background: #d8d8d8; margin-top:20px;">
        <li><a href="<?php echo CMS_DEFAULT_BACKEND_URL?>">Trang chủ</a></li>
        <li><a href="<?php echo CMS_DEFAULT_BACKEND_URL?>/calendar/">Calendar</a></li>
        <li class="active">Sửa sự kiện</li>
    </ol>
    
    <?php echo form_open('')?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Sửa sự kiện</h3>
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
                <div id="common" class="tabs-item">
                    <div class="col-md-12 item">
                        <div class="col-md-3" style="line-height: 200%;"><label for="title">Tiêu đề</label><span class="text-warnign"><sup>(*)</sup></span></div>
                        <div class="col-md-9"><input id="title" name="title" class="form-control" type="text" title="Tiêu đề" value="<?php echo (isset($post_data['title'])? $post_data['title'] : '')?>" /></div>
                    </div>

                    <div class="col-md-12 item">
                        <div class="col-md-3" style="line-height: 200%;"><label for="start_time">Thời gian bắt đầu</label><span class="text-warnign"><sup>(*)</sup></span></div>
                        <div class="col-md-9"><input id="start_time" name="start_time" class="form-control datetimepicker" type="datetime" title="Thời gian bắt đầu" value="<?php echo (isset($post_data['start_time'])? $post_data['start_time'] : '')?>" /></div>
                    </div>

                    <div class="col-md-12 item">
                        <div class="col-md-3" style="line-height: 200%;"><label for="end_time">Thời gian kết thúc</label></div>
                        <div class="col-md-9"><input id="end_time" name="end_time" class="form-control datetimepicker" type="datetime" title="Thời gian kết thúc" value="<?php echo (isset($post_data['end_time'])? $post_data['end_time'] : '')?>" /></div>
                    </div>


                    <div class="col-md-12 item">
                        <div class="col-md-3" style="line-height: 200%;"><label for="category_id">Loại lịch</label><span class="text-warnign"><sup>(*)</sup></span></div>
                        <div class="col-md-9">
                            <select class="form-control" name="category_id" id="category_id">
                                <option value="1" <?php echo (isset($post_data['category_id']) && $post_data['category_id'] == 1)? 'selected' : ''?>>Lịch làm việc</option>
                                <option value="2" <?php echo (isset($post_data['category_id']) && $post_data['category_id'] == 2)? 'selected' : ''?>>Lịch sự kiện NPP</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12 item">
                        <div class="col-md-3" style="line-height: 200%;"><label for="content">Nội dung sự kiện</label><span class="text-warnign"><sup>(*)</sup></span></div>
                        <div class="col-md-9">
                            <textarea name="content" class="form-control" id="content"><?php echo (isset($post_data['content']) ? $post_data['content'] : '')?></textarea>
                        </div>
                    </div>

                    <div class="col-md-12 item">
                        <div class="col-md-3" style="line-height: 200%;"><label for="publish">Hiển thị</label></div>
                        <div class="col-md-9">
                            <label>Hiện <input type="radio" name="publish" class="" value="1" <?php echo ((isset($post_data['publish']) && $post_data['publish'] == 1) || !isset($post_data['publish'])) ? 'checked' : ''?>/></label>
                            <label>Ẩn <input type="radio" name="publish" class="" value="0" <?php echo (isset($post_data['publish']) && $post_data['publish'] == 0) ? 'checked' : ''?> /></label>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 item text-center">
                    <button name="cmd" value="submit" class="btn btn-success" type="submit">Submit</button>
                    <input type="reset" class="btn" value="Reset"/>
                </div>
            </div>
        </div>
    </form>
    <script async="" class="<?php echo time()?>">
        $(document).ready(function(){
            $('#check_all_category').click(function(){
                $('.list_category input').attr('checked', 'checked');
            });
            
            $('#uncheck_all_category').click(function(){
                $('.list_category input').removeAttr('checked');
            });
            
            $('#title').change(function(){

                token = $("input[name=csrf_token]").val();
                
                $.ajax({
                    type: "POST",
                    url: '<?php echo CMS_DEFAULT_BACKEND_URL.'/products/ajax_alias'?>',
                    data: {'str' : $('#title').val(), 'csrf_token' : token},
                    success : function(data){
                        $('#alias').val(data);
                    }
                });
            });
        });
    </script>
    <script type="text/javascript">
    
    // This is a check for the CKEditor class. If not defined, the paths must be checked.
    if ( typeof CKEDITOR == 'undefined' )
    {
    	document.write(
    		'<strong><span style="color: #ff0000">Error</span>: CKEditor not found</strong>.' +
    		'This sample assumes that CKEditor (not included with CKFinder) is installed in' +
    		'the "/ckeditor/" path. If you have it installed in a different place, just edit' +
    		'this file, changing the wrong paths in the &lt;head&gt; (line 5) and the "BasePath"' +
    		'value (line 32).' ) ;
    }
    else
    {
    	var editor = CKEDITOR.replace( 'content' );
    	CKFinder.setupCKEditor( editor, '<?php echo CMS_DOMAIN?>/library/ckfinder/' );    
    }
    $('.datetimepicker').datetimepicker();
    </script>
</div>
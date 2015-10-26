<div class="col-md-12 text-justify" style="border-top: 1px #afafaf solid;">
    
    <ol class="breadcrumb" style="background: #d8d8d8; margin-top:20px;">
        <li><a href="<?php echo CMS_DEFAULT_BACKEND_URL?>">Trang chủ</a></li>
        <li><a href="<?php echo CMS_DEFAULT_BACKEND_URL?>/faq">Hỏi đáp</a></li>
        <li class="active">Sửa biểu mẫu</li>
    </ol>
    
    <?php echo form_open('')?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Sửa biểu mẫu</h3>
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
                <div class="col-md-3" style="line-height: 200%;"><label for="file_name">Tên file</label></div>
                <div class="col-md-9">
                    <input type="text" id="file_name" name="file_name" class="form-control" value="<?php echo (isset($post_data['file_name'])? $post_data['file_name'] : '')?>"/>
                </div>
            </div>

            <div class="col-md-12 item">
                <div class="col-md-3" style="line-height: 200%;"><label for="link">Link</label></div>
                <div class="col-md-3"><input type="text" class="input-upload-image form-control" id="link" name="link" value="<?php echo (isset($post_data['link'])? $post_data['link'] : '')?>" /></div>
                <div class="col-md-6"><input type="button" class="btn btn-info" onclick="BrowseServer( 'Files:/files', 'link' );" value="Browse..." /></div>
            </div>
            
            <div class="col-md-12 item">
                <div class="col-md-3" style="line-height: 200%;"><label for="publish">Hiển thị</label></div>
                <div class="col-md-9 text-left">
                    <label>Có <input type="radio" name="publish" class="" checked="" value="1"/></label>&Tab;&Tab;&Tab;
                    <label>Không <input type="radio" name="publish" class="" value="0"/></label>
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
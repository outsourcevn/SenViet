<div class="col-md-12 text-justify" style="border-top: 1px #afafaf solid;">
    
    <ol class="breadcrumb" style="background: #d8d8d8; margin-top:20px;">
        <li><a href="<?php echo CMS_DEFAULT_BACKEND_URL?>">Trang chủ</a></li>
        <li><a href="<?php echo CMS_DEFAULT_BACKEND_URL?>/slide">Slides</a></li>
        <li class="active">Sửa Slide</li>
    </ol>
    
    <?php echo form_open(current_url().'/?redir='.$this->input->get('redir'))?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Sửa Slide</h3>
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
                <div class="col-md-3" style="line-height: 200%;"><label for="link">Link</label></div>
                <div class="col-md-9"><input id="link" name="link" class="form-control" type="text" title="Link" value="<?php echo (isset($post_data['link'])? $post_data['link'] : '')?>" /></div>
            </div>
            
            <div class="col-md-12 item">
                <div class="col-md-3" style="line-height: 200%;"><label for="caption">Caption</label></div>
                <div class="col-md-9">
                    <textarea name="caption" id="caption" class="form-control"><?php echo (isset($post_data['caption'])) ? $post_data['caption'] : ''?></textarea>
                </div>
            </div>
            
            <div class="col-md-12 item">
                <div class="col-md-3" style="line-height: 200%;"><label for="publish">Image</label></div>
                <div class="col-md-3"><input type="text" class="input-upload-image form-control" id="image" name="image_link" value="<?php echo (isset($post_data['image_link'])) ? $post_data['image_link'] : ''?>" /></div>
                <div class="col-md-6"><input type="button" class="btn btn-info" onclick="BrowseServer( 'Files:/images', 'image' );" value="Browse..." /></div>
            </div>
            
            <div class="col-md-12 item">
                <div class="col-md-3" style="line-height: 200%;"><label for="publish">Hiển thị</label></div>
                <div class="col-md-9 text-left">
                    <label>Có <input type="radio" name="publish" class="" <?php echo (isset($post_data['publish']) && $post_data['publish'] == 1) ? 'checked' : ''?> value="1"/></label>&Tab;&Tab;&Tab;
                    <label>Không <input type="radio" name="publish" class="" <?php echo (isset($post_data['publish']) && $post_data['publish'] == 0) ? 'checked' : ''?> value="0"/></label>
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
<div class="col-md-12 text-justify" style="border-top: 1px #afafaf solid;">
    
    <ol class="breadcrumb" style="background: #d8d8d8; margin-top:20px;">
        <li><a href="<?php echo CMS_DEFAULT_BACKEND_URL?>">Trang chủ</a></li>
        <li class="active"><a href="<?php echo CMS_DEFAULT_BACKEND_URL?>/configs">Configure</a></li>
    </ol>
    
    <?php echo form_open('')?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Configure</h3>
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
                <div class="col-md-3" style="line-height: 200%;"><label for="homepage">Home Page</label></div>
                <div class="col-md-9"><input id="homepage" name="homepage" class="form-control" type="text" title="Home Page" value="<?php echo (isset($post_data['homepage'])? $post_data['homepage'] : '')?>" /></div>
            </div>
            
            <div class="col-md-12 item">
                <div class="col-md-3" style="line-height: 200%;"><label for="meta_title">Title</label></div>
                <div class="col-md-9">
                    <textarea class="form-control" name="meta_title" id="meta_title"><?php echo (isset($post_data['meta_title'])? $post_data['meta_title'] : '')?></textarea>
                </div>
            </div>
            
            <div class="col-md-12 item">
                <div class="col-md-3" style="line-height: 200%;"><label for="meta_keyword">Meta Keyword</label></div>
                <div class="col-md-9"><textarea class="form-control" name="meta_keyword" id="meta_keyword"><?php echo (isset($post_data['meta_keyword'])? $post_data['meta_keyword'] : '')?></textarea></div>
            </div>
            
            <div class="col-md-12 item">
                <div class="col-md-3" style="line-height: 200%;"><label for="meta_description">Meta Description</label></div>
                <div class="col-md-9">
                    <textarea class="form-control" name="meta_description" id="meta_description"><?php echo (isset($post_data['meta_description'])? $post_data['meta_description'] : '')?></textarea>
                </div>
            </div>
            
            <div class="col-md-12 item">
                <div class="col-md-3" style="line-height: 200%;"><label for="perpage">Items Perpage</label></div>
                <div class="col-md-9"><input id="perpage" name="perpage" class="form-control" type="number" title="Items Perpage" value="<?php echo (isset($post_data['perpage'])? $post_data['perpage'] : '')?>" /></div>
            </div>
            
            <div class="col-md-12 item">
                <div class="col-md-3" style="line-height: 200%;"><label for="is_active">Tình trạng hoạt động</label></div>
                <div class="col-md-9 text-left">
                    <label>Mở <input type="radio" name="is_active" class="" <?php echo ((isset($post_data['is_active']) && ($post_data['is_active'] == 1)) || !isset($post_data['is_active'])) ? 'checked' : ''?> value="1"/></label>&Tab;&Tab;&Tab;
                    <label>Đóng <input type="radio" name="is_active" class="" <?php echo ((isset($post_data['is_active']) && ($post_data['is_active'] == 0))) ? 'checked' : ''?> value="0"/></label>
                </div>
            </div>
            
            <div class="col-md-12 item">
                <div class="col-md-3" style="line-height: 200%;"><label for="maintain_message">Maintain Message</label></div>
                <div class="col-md-9">
                    <textarea name="maintain_message" class="form-control" id="editor1"><?php echo (isset($post_data['maintain_message']) ? $post_data['maintain_message'] : '')?></textarea>
                </div>
            </div>
            
            <div class="col-md-12 item">
                <div class="col-md-3" style="line-height: 200%;"><label for="flash_message">Flash Message</label></div>
                <div class="col-md-9">
                    <textarea name="flash_message" class="form-control"  id="editor2"><?php echo (isset($post_data['flash_message']) ? $post_data['flash_message'] : '')?></textarea>
                </div>
            </div>
            
            <div class="col-md-12 item text-center">
                <button name="cmd" value="submit" class="btn btn-success" type="submit">Submit</button>
                <input type="reset" class="btn" value="Reset"/>
            </div>
        </div>
    </div>
    </form>
    <script>
        var editor = CKEDITOR.replace( 'editor1' );
    	CKFinder.setupCKEditor( editor, '../../library/ckfinder/' );
        
        var editor = CKEDITOR.replace( 'editor2' );
    	CKFinder.setupCKEditor( editor, '../../library/ckfinder/' );
    </script>
</div>
<div class="col-md-12 text-justify" style="border-top: 1px #afafaf solid;">
    
    <ol class="breadcrumb" style="background: #d8d8d8; margin-top:20px;">
        <li><a href="<?php echo CMS_DEFAULT_BACKEND_URL?>">Trang chủ</a></li>
        <li><a href="<?php echo CMS_DEFAULT_BACKEND_URL?>/category">Categories</a></li>
        <li class="active">Thêm Category</li>
    </ol>
    
    <?php echo form_open('')?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Thêm Category</h3>
        </div>
        
        <div class="panel-body">
            <script>
                $(document).ready(function(){  
                    //$('.ckeditor').ckeditor();
                    $('#title').change(function(){
                        
                        token = $("input[name=csrf_token]").val();
                        
                        $.ajax({
                            type: "POST",
                            url: '<?php echo CMS_DEFAULT_BACKEND_URL.'/category/ajax_alias'?>',
                            data: {'str' : $('#title').val(), 'csrf_token' : token},
                            success : function(data){
                                $('#alias').val(data);
                            }
                        });
                    });
                });
            </script>
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
                <div class="col-md-3" style="line-height: 200%;"><label for="title">Category Name</label></div>
                <div class="col-md-9"><input id="title" name="title" class="form-control" type="text" title="Tên Category" value="<?php echo (isset($post_data['title'])? $post_data['title'] : '')?>" /></div>
            </div>
            
            <div class="col-md-12 item">
                <div class="col-md-3" style="line-height: 200%;"><label for="alias">Alias</label></div>
                <div class="col-md-9"><input id="alias" name="alias" class="form-control" type="text" title="alias" value="<?php echo (isset($post_data['alias']) ? $post_data['alias'] : '')?>" /></div>
            </div>
            
            <div class="col-md-12 item">
                <div class="col-md-3" style="line-height: 200%;"><label for="image">Image</label></div>
                <div class="col-md-9">
                    <input id="image" name="image" class="form-control" type="text" title="image" value="<?php echo (isset($post_data['image']) ? $post_data['image'] : '')?>" />
                    <input type="button" value="Browse Server" onclick="BrowseServer( 'Files:/', 'image' );" />
                </div>
            </div>
            
            <div class="col-md-12 item">
                <div class="col-md-3" style="line-height: 200%;"><label for="parentid">Parent Category</label></div>
                <div class="col-md-9 item">
                    <select id="parentid" name="parentid" class="form-control">
                    <?php
                        foreach($list_category as $key => $val){
                    ?>
                        <option value="<?php echo $key;?>" <?php if(isset($post_data['parentid']) && $key == $post_data['parentid']) echo 'selected';?>><?php echo $val?></option>
                    <?php
                        }
                    ?>
                    </select>
                </div>
            </div>
            
            <div class="col-md-12 item">
                <div class="col-md-3" style="line-height: 200%;"><label for="description">Miêu Tả</label></div>
                <div class="col-md-9">
                    <textarea name="description" id="editor1" class="textarea form-control" id="description"><?php echo (isset($post_data['description']) ? $post_data['description'] : '')?></textarea>
                </div>
            </div>
            
            <div class="col-md-12 item">
                <div class="col-md-3" style="line-height: 200%;"><label for="meta_description">Meta Description</label></div>
                <div class="col-md-9">
                    <textarea name="meta_description" id="meta_description" class="textarea form-control"><?php echo (isset($post_data['meta_description']) ? $post_data['meta_description'] : '')?></textarea>
                </div>
            </div>
            
            <div class="col-md-12 item">
                <div class="col-md-3" style="line-height: 200%;"><label for="meta_keyword">Meta Keyword</label></div>
                <div class="col-md-9">
                    <textarea name="meta_keyword" id="meta_keyword" class="textarea form-control"><?php echo (isset($post_data['meta_keyword']) ? $post_data['meta_keyword'] : '')?></textarea>
                </div>
            </div>
            
            
            <div class="col-md-12 item text-center">
                <button name="cmd" value="submit" class="btn btn-success" type="submit">Submit</button>
                <input type="reset" class="btn" value="Reset"/>
            </div>
        </div>
    </div>
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
    	var editor = CKEDITOR.replace( 'editor1' );
    	CKFinder.setupCKEditor( editor, '../../library/ckfinder/' );
    }
    
    </script>
    </form>
</div>
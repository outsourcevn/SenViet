<div class="col-md-12 text-justify" style="border-top: 1px #afafaf solid;">
    
    <ol class="breadcrumb" style="background: #d8d8d8; margin-top:20px;">
        <li><a href="<?php echo CMS_DEFAULT_BACKEND_URL?>">Trang chủ</a></li>
        <li><a href="<?php echo CMS_DEFAULT_BACKEND_URL?>/news/">Tin tức</a></li>
        <li class="active">Thêm bài đăng</li>
    </ol>
    
    <?php echo form_open('')?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Thêm bài đăng</h3>
            </div>
            
            <div class="panel-body">
                <ul class="nav nav-tabs">
                  <li role="presentation" class="active tabs-menu-item"><a href="<?php echo current_url();?>#common" rel="#common">Common</a></li>
                  <li role="presentation" class="tabs-menu-item"><a href="<?php echo current_url();?>#cetegories" rel="#categories">Categories</a></li>
                  <li role="presentation" class="tabs-menu-item"><a href="<?php echo current_url();?>#SEO" rel="#seo">SEO &amp; Link</a></li>
                  <li role="presentation" class="tabs-menu-item"><a href="<?php echo current_url();?>#Others" rel="#others">Others</a></li>
                </ul><br />
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
                        <div class="col-md-3" style="line-height: 200%;"><label for="title">Tiêu đề bài viết</label><span class="text-warnign"><sup>(*)</sup></span></div>
                        <div class="col-md-9"><input id="title" name="title" class="form-control" type="text" title="Tiêu đề bài viết" value="<?php echo (isset($post_data['title'])? $post_data['title'] : '')?>" /></div>
                    </div>

                    <div class="col-md-12 item">
                        <div class="col-md-3" style="line-height: 200%;"><label for="image_link">Image</label></div>
                        <div class="col-md-3"><input type="text" class="input-upload-image form-control" id="thumbnail" name="thumbnail" value="<?php echo (isset($post_data['thumbnail'])? $post_data['thumbnail'] : '')?>" /></div>
                        <div class="col-md-6"><input type="button" class="btn btn-info" onclick="BrowseServer( 'Files:/images', 'thumbnail' );" value="Browse..." /></div>
                        <?php if(isset($post_data['thumbnail']) && $post_data['thumbnail'] != ''):?>
                        <div class="col-md-3" style="line-height: 200%;"></div>
                        <div class="col-md-9" style="margin: 10px 0px;">
                            <img style="width:150px;" class="img-responsive img-thumbnail" src="<?php echo $post_data['thumbnail']?>" alt=""/>
                        </div>
                        <?php endif;?>
                    </div>
                    
                    <div class="col-md-12 item">
                        <div class="col-md-3" style="line-height: 200%;"><label for="description">Mô tả</label><span class="text-warnign"><sup>(*)</sup></span></div>
                        <div class="col-md-9">
                            <textarea name="description" class="form-control" id="description"><?php echo (isset($post_data['description']) ? $post_data['description'] : '')?></textarea>
                        </div>
                    </div>

                    <div class="col-md-12 item">
                        <div class="col-md-3" style="line-height: 200%;"><label for="content">Nội dung</label><span class="text-warnign"><sup>(*)</sup></span></div>
                        <div class="col-md-9">
                            <textarea name="content" class="form-control" id="content"><?php echo (isset($post_data['content']) ? $post_data['content'] : '')?></textarea>
                        </div>
                    </div>
                </div>
                
                <div id="categories" class="hidden tabs-item">
                    <div class="col-md-12">
                        <ul class="list-unstyled col-sm-9 list_category">
                        <?php
                            GenerateCategoryRadioList($category_list, 0, (isset($post_data['category_id']) ? $post_data['category_id'] : null));
                        ?>
                        </ul>
                    </div>
                </div>
                
                <div id="seo" class="hidden tabs-item">
                    <div class="col-md-12 item">
                        <div class="col-md-3" style="line-height: 200%;"><label for="alias">Alias</label><span class="text-warnign"><sup>(*)</sup></span></div>
                        <div class="col-md-9"><input id="alias" name="alias" class="form-control" type="text" title="Alias" value="<?php echo (isset($post_data['alias'])? $post_data['alias'] : '')?>" /></div>
                    </div>
                    
                    <div class="col-md-12 item">
                        <div class="col-md-3" style="line-height: 200%;"><label for="meta_title">Meta Title</label></div>
                        <div class="col-md-9">
                            <textarea name="meta_title" class="form-control"><?php echo (isset($post_data['meta_title']) ? $post_data['meta_title'] : '')?></textarea>
                        </div>
                    </div>
                    
                    <div class="col-md-12 item">
                        <div class="col-md-3" style="line-height: 200%;"><label for="meta_description">Meta Description</label></div>
                        <div class="col-md-9">
                            <textarea name="meta_description" class="form-control"><?php echo (isset($post_data['meta_description']) ? $post_data['meta_description'] : '')?></textarea>
                        </div>
                    </div>
                    
                    <div class="col-md-12 item">
                        <div class="col-md-3" style="line-height: 200%;"><label for="meta_keyword">Meta Keyword</label></div>
                        <div class="col-md-9">
                            <textarea name="meta_keyword" class="form-control"><?php echo (isset($post_data['meta_keyword']) ? $post_data['meta_keyword'] : '')?></textarea>
                        </div>
                    </div>
                </div>
                
                <div id="others" class="hidden tabs-item">
                    <div class="col-md-12 item">
                        <div class="col-md-3" style="line-height: 200%;"><label for="publish">Publish</label></div>
                        <div class="col-md-9">
                            <label>Hiện <input type="radio" name="publish" class="" value="1" <?php echo ((isset($post_data['publish']) && $post_data['publish'] == 1) || !isset($post_data['publish'])) ? 'checked' : ''?>/></label>
                            <label>Ẩn <input type="radio" name="publish" class="" value="0" <?php echo (isset($post_data['publish']) && $post_data['publish'] == 0) ? 'checked' : ''?> /></label>
                        </div>
                    </div>
                    
                    <div class="col-md-12 item">
                        <div class="col-md-3" style="line-height: 200%;"><label for="publish">Bài đăng nổi bật</label></div>
                        <div class="col-md-9">
                            <label>Có <input type="radio" name="is_featured" class="" value="1" <?php echo ((isset($post_data['is_featured']) && $post_data['is_featured'] == 1)) ? 'checked' : ''?>/></label>
                            <label>Không <input type="radio" name="is_featured" class="" value="0" <?php echo (isset($post_data['is_featured']) && $post_data['is_featured'] == 0 || !isset($post_data['is_featured'])) ? 'checked' : ''?> /></label>
                        </div>
                    </div>

                    <div class="col-md-12 item">
                        <div class="col-md-3" style="line-height: 200%;"><label for="fb_share_like">Facebook Like & Share</label></div>
                        <div class="col-md-9">
                            <label>Có <input type="radio" name="fb_share_like" class="" value="1" <?php echo ((isset($post_data['fb_share_like']) && $post_data['fb_share_like'] == 1)) ? 'checked' : ''?>/></label>
                            <label>Không <input type="radio" name="fb_share_like" class="" value="0" <?php echo (isset($post_data['fb_share_like']) && $post_data['fb_share_like'] == 0 || !isset($post_data['fb_share_like'])) ? 'checked' : ''?> /></label>
                        </div>
                    </div>

                    <div class="col-md-12 item">
                        <div class="col-md-3" style="line-height: 200%;"><label for="fb_comment">Facebook Comments</label></div>
                        <div class="col-md-9">
                            <label>Có <input type="radio" name="fb_comment" class="" value="1" <?php echo ((isset($post_data['fb_comment']) && $post_data['fb_comment'] == 1)) ? 'checked' : ''?>/></label>
                            <label>Không <input type="radio" name="fb_comment" class="" value="0" <?php echo (isset($post_data['fb_comment']) && $post_data['fb_comment'] == 0 || !isset($post_data['fb_comment'])) ? 'checked' : ''?> /></label>
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
    	var editor = CKEDITOR.replace( 'description' );
    	CKFinder.setupCKEditor( editor, '<?php echo CMS_DOMAIN?>/library/ckfinder/' );

        var editor2 = CKEDITOR.replace( 'content' );
        CKFinder.setupCKEditor( editor2, '<?php echo CMS_DOMAIN?>/library/ckfinder/' );
    }
    
    </script>
</div>
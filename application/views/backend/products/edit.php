<div class="col-md-12 text-justify" style="border-top: 1px #afafaf solid;">
    
    <ol class="breadcrumb" style="background: #d8d8d8; margin-top:20px;">
        <li><a href="<?php echo CMS_DEFAULT_BACKEND_URL?>">Trang chủ</a></li>
        <li><a href="<?php echo CMS_DEFAULT_BACKEND_URL?>/products/">Products</a></li>
        <li class="active">Sửa Products</li>
    </ol>
    
    <?php echo form_open(current_url().'/?redir='.$this->input->get('redir'))?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Sửa Product</h3>
            </div>
            
            <div class="panel-body">
                <ul class="nav nav-tabs">
                  <li role="presentation" class="active tabs-menu-item"><a rel="#common" style="cursor: pointer;">Common</a></li>
                  <li role="presentation" class="tabs-menu-item"><a rel="#categories" style="cursor: pointer;">Categories</a></li>
                  <li role="presentation" class="tabs-menu-item"><a rel="#seo" style="cursor: pointer;">SEO &amp; Link</a></li>
                  <li role="presentation" class="tabs-menu-item"><a rel="#others" style="cursor: pointer;">Others</a></li>
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
                        <div class="col-md-3" style="line-height: 200%;"><label for="title">Tên sản phẩm</label><span class="text-warnign"><sup>(*)</sup></span></div>
                        <div class="col-md-9"><input id="title" name="title" class="form-control" type="text" title="Tên sản phẩm" value="<?php echo (isset($post_data['title'])? $post_data['title'] : '')?>" /></div>
                    </div>
                    
                    <div class="col-md-12 item">
                        <div class="col-md-3" style="line-height: 200%;"><label for="brand_id">Thương hiệu</label><span class="text-warnign"><sup>(*)</sup></span></div>
                        <div class="col-md-9">
                            <select id="brand_id" name="brand_id" class="form-control">
                                <?php
                                    if(isset($brand_list) && count($brand_list) > 0 && is_array($brand_list)){
                                        foreach($brand_list as $brand_temp){
                                ?>
                                    <option value="<?php echo $brand_temp['id']?>" <?php echo (isset($post_data['brand_id']) && $post_data['brand_id'] == $brand_temp['id']) ? 'selected' : ''?>><?php echo $brand_temp['brand_name'];?></option>
                                <?php
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-12 item">
                        <div class="col-md-3" style="line-height: 200%;"><label for="price">Giá sản phẩm</label><span class="text-warnign"><sup>(*)</sup></span></div>
                        <div class="col-md-9"><input id="price" name="price" class="form-control" type="number" title="Giá sản phẩm" value="<?php echo (isset($post_data['price'])? $post_data['price'] : '')?>" /></div>
                    </div>
                    
                    <div class="col-md-12 item">
                        <div class="col-md-3" style="line-height: 200%;"><label for="sale_price">Giá khuyến mại</label></div>
                        <div class="col-md-9"><input id="sale_price" name="sale_price" class="form-control" type="number" title="Giá khuyến mại" value="<?php echo ((isset($post_data['sale_price']) && $post_data['sale_price'] > 0)? $post_data['sale_price'] : '')?>" /></div>
                    </div>
                    
                    <div class="col-md-12 item">
                        <div class="col-md-3" style="line-height: 200%;"><label for="description">Mô tả</label><span class="text-warnign"><sup>(*)</sup></span></div>
                        <div class="col-md-9">
                            <textarea name="description" class="form-control" id="description"><?php echo (isset($post_data['description']) ? $post_data['description'] : '')?></textarea>
                        </div>
                    </div>
                </div>
                
                <div id="categories" class="hidden tabs-item">
                    <div class="col-md-12">
                        <ul class="list-unstyled col-sm-9 list_category">
                        <?php
                            //$post_data['category_id'] = ProcessCategory($post_data['category_id']);
                            GenerateCategoryCheckList($category_list, 0, (isset($post_data['category_id']) ? $post_data['category_id'] : null));
                        ?>
                        </ul>
                        <div class="col-sm-12 text-center">
                            <a id="check_all_category" style="cursor: pointer;" onclick="">SELECT ALL</a> | 
                            <a id="uncheck_all_category" style="cursor: pointer;" onclick="">UNSELECT ALL</a>
                        </div>
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
                    Images and Publish Show Here
                    <div class="col-md-12 item">
                        <div class="col-md-3" style="line-height: 200%;"><label for="publish">Publish</label></div>
                        <div class="col-md-9">
                            <label>Hiện <input type="radio" name="publish" class="" value="1" <?php echo ((isset($post_data['publish']) && $post_data['publish'] == 1) || !isset($post_data['publish'])) ? 'checked' : ''?>/></label>
                            <label>Ẩn <input type="radio" name="publish" class="" value="0" <?php echo (isset($post_data['publish']) && $post_data['publish'] == 0) ? 'checked' : ''?> /></label>
                        </div>
                    </div>
                    
                    <div class="col-md-12 item">
                        <div class="col-md-3" style="line-height: 200%;"><label for="publish">Sản phẩm nổi bật</label></div>
                        <div class="col-md-9">
                            <label>Có <input type="radio" name="is_featured" class="" value="1" <?php echo ((isset($post_data['publish']) && $post_data['publish'] == 1) || !isset($post_data['publish'])) ? 'checked' : ''?>/></label>
                            <label>Không <input type="radio" name="is_featured" class="" value="0" <?php echo (isset($post_data['publish']) && $post_data['publish'] == 0) ? 'checked' : ''?> /></label>
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
    }
    
    </script>
</div>
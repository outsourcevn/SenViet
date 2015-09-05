<div class="col-md-12 text-justify" style="border-top: 1px #afafaf solid;">
    
    <ol class="breadcrumb" style="background: #d8d8d8; margin-top:20px;">
        <li><a href="<?php echo CMS_DEFAULT_BACKEND_URL?>">Trang chủ</a></li>
        <li><a href="<?php echo CMS_DEFAULT_BACKEND_URL?>/user">Tài khoản</a></li>
        <li class="active">Thêm nhóm người dùng</li>
    </ol>
    
    <?php echo form_open('')?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Thêm nhóm người dùng</h3>
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
                <div class="col-md-3" style="line-height: 200%;"><label for="title">Tên nhóm người dùng</label></div>
                <div class="col-md-9"><input id="title" name="title" class="form-control" type="text" title="Tên nhóm người dùng" value="<?php echo (isset($post_data['title'])? $post_data['title'] : '')?>" /></div>
            </div>
            <div class="col-md-12">
                <fieldset class="usergroup_permission">
                    <legend><h4>Quyền truy cập</h4></legend>
                    <ul class="permission_list">
                    <?php
                        $flag = '';
                        if(isset($perm_list) && count($perm_list)){
                            foreach($perm_list as $key => $val){
                                if(strcmp($flag, $val['group']) != 0){
                                    $flag = $val['group'];
                                    echo '<li class="" style="clear:left;width:100%;list-style:none;"><strong>'.$flag.'</strong></li>';
                                }
                        ?>
                        <li class="checkbox"><label><input type="checkbox" name="permission_key[]" <?php echo (isset($post_data['permission_key']) && in_array($val['uri'], $post_data['permission_key']))? 'checked' : ''?> value="<?php echo $val['uri']?>" /><?php echo $val['title']?></label></li>
                    <?php
                            }
                        }
                    ?>
                    </ul>
                </fieldset>
            </div>
            <div class="col-md-12 item text-center">
                <button name="cmd" value="submit" class="btn btn-success" type="submit">Submit</button>
                <input type="reset" class="btn" value="Reset"/>
            </div>
        </div>
    </div>
    </form>
</div>
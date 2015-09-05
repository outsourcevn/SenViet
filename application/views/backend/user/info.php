<div class="col-md-12 text-justify" style="border-top: 1px #afafaf solid;">
    
    <ol class="breadcrumb" style="background: #d8d8d8; margin-top:20px;">
        <li><a href="<?php echo CMS_DEFAULT_BACKEND_URL?>">Trang chủ</a></li>
        <li class="active">Thông tin tài khoản</li>
    </ol>
    
    <?php echo form_open('')?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Thông Tin Tài Khoản</h3>
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
                <div class="col-md-3" style="line-height: 200%;"><label for="username">Tài Khoản</label></div>
                <div class="col-md-9"><input id="username" name="username" disabled="" class="form-control" type="text" value="<?php echo (isset($post_data['username'])? $post_data['username'] : $auth['username'])?>" /></div>
            </div>
            
            <div class="col-md-12 item">
                <div class="col-md-3" style="line-height: 200%;"><label for="oldpassword">Mật Khẩu Cũ</label></div>
                <div class="col-md-9"><input id="oldpassword" name="oldpassword" class="form-control" type="password" value="" /></div>
            </div>
            
            <div class="col-md-12 item">
                <div class="col-md-3" style="line-height: 200%;"><label for="password">Mật Khẩu Mới</label></div>
                <div class="col-md-9"><input id="password" name="password" class="form-control" type="password" value="" /></div>
            </div>
            
            <div class="col-md-12 item">
                <div class="col-md-3" style="line-height: 200%;"><label for="repassword">Gõ Lại Mật Khẩu</label></div>
                <div class="col-md-9"><input id="repassword" name="repassword" class="form-control" type="password" value="" /></div>
            </div>
            
            <div class="col-md-12 item">
                <div class="col-md-3" style="line-height: 200%;"><label for="fullname">Tên Đầy Đủ</label></div>
                <div class="col-md-9"><input id="fullname" name="fullname" class="form-control" type="text" value="<?php echo (isset($post_data['fullname'])? $post_data['fullname'] : $auth['fullname'])?>" /></div>
            </div>
            
            <div class="col-md-12 item">
                <div class="col-md-3" style="line-height: 200%;"><label for="email">Email</label></div>
                <div class="col-md-9"><input id="email" name="email" required="" class="form-control" type="email" value="<?php echo (isset($post_data['email'])? $post_data['email'] : $auth['email'])?>" /></div>
            </div>
            
            
            <div class="col-md-12 item">
                <div class="col-md-3" style="line-height: 200%;"><label>Ngày Tạo</label></div>
                <div class="col-md-9"><input disabled="" class="form-control" type="text" value="<?php echo (isset($auth['created_date'])? gmdate('H:i:s d-m-Y',strtotime($auth['created_date'])+8*3600) : '')?>" /></div>
            </div>
            
            <div class="col-md-12 item">
                <div class="col-md-3" style="line-height: 200%;"><label>Ngày sửa cuối</label></div>
                <div class="col-md-9"><input disabled="" class="form-control" type="text" value="<?php echo (isset($auth['updated_date'])? gmdate('H:i:s d-m-Y',strtotime($auth['updated_date'])+8*3600) : '')?>" /></div>
            </div>
            
            <div class="col-md-12 item">
                <div class="col-md-3" style="line-height: 200%;"><label>Nhóm người dùng</label></div>
                <div class="col-md-9"><input disabled="" class="form-control" type="text" value="<?php echo (isset($auth['usergroupid']))? get_usergroup($auth['usergroupid']) : '';?>" /></div>
            </div>
            
            <div class="col-md-12 item text-center">
                <button name="cmd" value="submit" class="btn btn-success" type="submit">Submit</button>
                <input type="reset" class="btn" value="Reset"/>
            </div>
        </div>
    </div>
    </form>
</div>
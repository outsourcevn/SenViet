<div class="col-md-12 text-justify" style="border-top: 1px #afafaf solid;">
    
    <ol class="breadcrumb" style="background: #d8d8d8; margin-top:20px;">
        <li><a href="<?php echo CMS_DEFAULT_BACKEND_URL?>">Trang chủ</a></li>
        <li><a href="<?php echo CMS_DEFAULT_BACKEND_URL?>/user">Tài khoản</a></li>
        <li class="active">Thêm người dùng</li>
    </ol>
    
    <?php echo form_open(current_url().'/?redir='.$this->input->get('redir'))?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Thêm người dùng</h3>
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
                <div class="col-md-3" style="line-height: 200%;"><label for="username">Username</label></div>
                <div class="col-md-9"><input id="username" name="username" class="form-control" type="text" title="Username" value="<?php echo (isset($post_data['username'])? $post_data['username'] : '')?>" /></div>
            </div>
            
            <div class="col-md-12 item">
                <div class="col-md-3" style="line-height: 200%;"><label for="password">Password</label></div>
                <div class="col-md-9"><input id="password" name="password" class="form-control" type="password" title="Password" value="" /></div>
            </div>
            
            <div class="col-md-12 item">
                <div class="col-md-3" style="line-height: 200%;"><label for="repassword">Gõ lại password</label></div>
                <div class="col-md-9"><input id="repassword" name="repassword" class="form-control" type="password" title="Gõ lại password" value="" /></div>
            </div>
            
            <div class="col-md-12 item">
                <div class="col-md-3" style="line-height: 200%;"><label for="email">Email</label></div>
                <div class="col-md-9"><input id="email" name="email" class="form-control" type="email" title="Email" value="<?php echo (isset($post_data['email'])? $post_data['email'] : '')?>" /></div>
            </div>
            
            <div class="col-md-12 item">
                <div class="col-md-3" style="line-height: 200%;"><label for="fullname">Tên Hiển Thị</label></div>
                <div class="col-md-9"><input id="fullname" name="fullname" class="form-control" type="text" title="Tên đầy đủ" value="<?php echo (isset($post_data['fullname'])? $post_data['fullname'] : '')?>" /></div>
            </div>
            
            <div class="col-md-12 item">
                <div class="col-md-3" style="line-height: 200%;"><label for="usergroupid">Nhóm người dùng</label></div>
                <div class="col-md-9">
                	<?php
						echo Generate_Select_Menu('usergroupid', 'Chọn nhóm người dùng', CMS_DEFAULT_USERGROUP_ID, $usergroup_list, (isset($post_data['usergroupid']) ? $post_data['usergroupid'] : 0), 'id', 'title', 'usergroupid');
					?>
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
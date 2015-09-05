<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="minhducck"/>
    <meta charset="utf-8" />
    <base href="<?php echo base_url();?>" />
	<title>Quên mật khẩu</title>
    
    <!--Jquery-->
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    
    <!--Bootstrap-->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    
    <!--Custom Style-->
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    
    <script>
        function checkLogin(param){
            flag = true;
            if(param.username.value == '')
            {
                $(param.username).parent().addClass('has-error');
                flag = false;
            }
            
            if(param.code.value == '')
            {
                $(param.code).parent().addClass('has-error');
                flag = false;
            }
            
            return flag;
        }
        
        $(document).ready(function(){
            $('#username').keypress(function(){
                $(this).parent().removeClass('has-error');
            });
            $('#code').keypress(function(){
                $(this).parent().removeClass('has-error');
            });
        });
    </script>
</head>

<body>

    <div class="container">
        <?php echo form_open('', array('onsubmit' => 'return checkLogin(this)', 'class' => 'login-form')); ?>
            <fieldset>
                <legend>Reset Password</legend>
                <?php                    
                    if(validation_errors() || $valid != 1)
                    {
                ?>
                <blockquote class="bg-warning">
                    <ul class="errors">
                        <?php
                            if($valid == 0){
                                echo '<li class="text-warning">Password không trùng</li>';
                            }
                            
                            if($valid == -1)
                            {
                                echo '<li class="text-warning">Sai mã reset</li>';
                            }
                            echo validation_errors('<li class="text-warning">', '</li>');
                        ?>
                    </ul>
                </blockquote>
                <?php
                    }
                ?>
                <div class="form-group">
                    <label for="username"><span class="glyphicon glyphicon-user"></span> Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?php echo (isset($post_data['username']))?$post_data['username'] : ''?>" />
                </div>
                <div class="form-group">
                    <label for="code"><span class="glyphicon glyphicon-qrcode"></span> Reset code</label>
                    <input type="text" class="form-control" id="code" name="code" placeholder="Reset code" value="<?php echo (isset($post_data['code']))?$post_data['code'] : ''?>" />
                </div>
                
                <div class="form-group">
                    <label for="newpass"><span class="glyphicon glyphicon-lock"></span> New password</label>
                    <input type="password" class="form-control" id="newpass" name="newpass" placeholder="New Password" value="" />
                </div>
                
                <div class="form-group">
                    <label for="repass"><span class="glyphicon glyphicon-lock"></span> Retype New Pass</label>
                    <input type="password" class="form-control" id="repass" name="repass" placeholder="Retype Password" value="" />
                </div>
                
                <button type="submit" name="cmd" value="send" class="btn btn-success">Gửi</button>
                <button type="reset" class="btn btn-default">Reset</button>
            </fieldset>
            <hr />
            <section class="text-right">
                Created by minhducck
            </section>
        </form>
    </div>
</body>
</html>
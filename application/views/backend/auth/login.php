<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="minhducck"/>
    <meta charset="utf-8" />
    <base href="<?php echo base_url();?>" />
	<title>Login</title>
    
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
            
            if(param.password.value == '')
            {
                $(param.password).parent().addClass('has-error');
                flag = false;
            }
            
            return flag;
        }
        
        $(document).ready(function(){
            $('#username').keypress(function(){
                $(this).parent().removeClass('has-error');
            });
            $('#password').keypress(function(){
                $(this).parent().removeClass('has-error');
            });
        });
    </script>
</head>

<body>

    <div class="container">
        <?php echo form_open('', array('onsubmit' => 'return checkLogin(this)', 'class' => 'login-form')); ?>
            <input type="hidden" name="redir" value="<?php echo (isset($_GET['redir']) ? $_GET['redir'] : '')?>" />
            <fieldset>
                <legend>ĐĂNG NHẬP</legend>
                <?php                    
                    if(validation_errors() || $login_error == true)
                    {
                ?>
                <blockquote class="bg-warning">
                    <ul class="errors">
                        <?php 
                        if(isset($login_error) && $login_error == true) echo('<li class="text-warning">Tên đăng nhập hoặc mật khẩu không đúng! Hoặc có thể tài khoản của bạn bị tạm khóa.</li>');
                        else
                        {
                            echo validation_errors('<li class="text-warning">', '</li>');
                        }
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
                    <label for="password"><span class="glyphicon glyphicon-lock"></span> Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password"/>
                </div>
                
                <div class="pull-left text-left">
                    <button type="submit" name="cmd" class="btn btn-success">Login</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                </div>
                <div class="pull-right text-right">
                    <a href="<?php echo CMS_DEFAULT_BACKEND_URL?>/auth/forgot.html">Quên mật khẩu?</a>
                </div>
            </fieldset>
            <hr />
            <section class="text-right">
                Created by minhducck
            </section>
        </form>
    </div>
</body>
</html>
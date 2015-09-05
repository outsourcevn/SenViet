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
            if(param.email.value == '')
            {
                $(param.email).parent().addClass('has-error');
                flag = false;
            }
            
            return flag;
        }
        
        $(document).ready(function(){
            $('#email').keypress(function(){
                $(this).parent().removeClass('has-error');
            });
        });
    </script>
</head>

<body>

    <div class="container">
        <?php echo form_open('', array('onsubmit' => 'return checkLogin(this)', 'class' => 'login-form')); ?>
            <fieldset>
                <legend>QUÊN MẬT KHẨU</legend>
                <?php                    
                    if(validation_errors() || $email_error == true)
                    {
                ?>
                <blockquote class="bg-warning">
                    <ul class="errors">
                        <?php 
                            if($email_error){
                                echo '<li class="text-warning">Không tìm thấy email trong CSDL</li>';
                            }
                            
                            echo form_error('email', '<li class="text-warning">', '</li>');
                        ?>
                    </ul>
                </blockquote>
                <?php
                    }
                ?>
                <div class="form-group">
                    <label for="email"><span class="glyphicon glyphicon-envelope"></span> Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo (isset($post_data['email']))?$post_data['email'] : ''?>" />
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
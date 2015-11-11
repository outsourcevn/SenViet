<div class="content">
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>"><i>Trang chủ</i></a></li>
            <li class="active"><i>Liên hệ</i></li>
        </ol>
        <div class="col-lg-12">
            <div class="col-lg-12" style="border-bottom: 1px dashed #aeaeae;">
                <p class="company-heading"><?php echo $configuration->slogan?></p>
                <address>
                    <p><i class="fa fa-map-marker" style="color: #f166ab"></i> &nbsp;<?php echo $configuration->address?></p>
                    <p><i class="fa fa-mobile" style="color: #f166ab"></i> &nbsp;&nbsp;<?php echo $configuration->telephone?></p>
                    <p><i class="fa fa-envelope" style="color: #f166ab"></i> <a href="mailto:<?php echo $configuration->email?>"><?php echo $configuration->email?></a> </p>
                </address>
            </div>
            <br/>
        </div>
        <div class="clearfix"></div>
        <br/>
        <div class="col-lg-12">
            <div class="col-lg-12">
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
            </div>
            <div class="col-lg-6 contact-form">
                <?php echo form_open('lien-he/post/')?>
                    <div class="col-lg-12">
                        <div class="col-lg-3"><label for="full_name" class="required">Họ Tên</label></div>
                        <div class="col-lg-9"><input type="text" name="full_name" value="<?php echo set_value('full_name'); ?>" id="full_name" required=""/></div>
                    </div>

                    <div class="col-lg-12">
                        <div class="col-lg-3"><label for="tel" class="required">Tel</label></div>
                        <div class="col-lg-9"><input type="tel" name="tel" value="<?php echo set_value('tel'); ?>" id="tel" required=""/></div>
                    </div>

                    <div class="col-lg-12">
                        <div class="col-lg-3"><label for="email" class="required">Email</label></div>
                        <div class="col-lg-9"><input type="email" name="email" value="<?php echo set_value('email'); ?>" id="email" required=""/></div>
                    </div>

                    <div class="col-lg-12">
                        <div class="col-lg-3"><label for="title" class="required">Tiêu đề</label></div>
                        <div class="col-lg-9"><input type="text" name="title" value="<?php echo set_value('title'); ?>" id="title" required=""/></div>
                    </div>

                    <div class="col-lg-12">
                        <div class="col-lg-3"><label for="content" class="required">Nội dung</label></div>
                        <div class="col-lg-9"><textarea name="content" id="content" rows="5" required="" style="resize: none"><?php echo set_value('content'); ?></textarea></div>
                    </div>

                    <div class="col-lg-12">
                        <div class="col-lg-3"><label for="content">Gửi đến</label></div>
                        <div class="col-lg-9">
                            <input type="hidden" class="massage-to-value" name="to" value="0"/>
                            <div class="btn-group massage-to">
                                <button class="btn btn-success" type="button">Chọn người nhận</button>
                                <button aria-expanded="false" aria-haspopup="true" data-toggle="dropdown" class="btn btn-success dropdown-toggle" type="button">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu">
                                    <?php if(isset($usergroup) && count($usergroup) > 0):
                                        foreach($usergroup as $_group):
                                        ?>
                                        <li><a href="#" data-group="<?php echo $_group->id;?>"><?php echo $_group->title;?></a></li>
                                    <?php endforeach; endif;?>
                                </ul>

                                <script>
                                    jQuery(document).ready(function(){
                                        jQuery('.massage-to ul li').click(function(e){
                                            e.preventDefault();

                                            $label = jQuery(this).children().html();

                                            var $mailTo = jQuery(this).children().attr('data-group');

                                            jQuery('.massage-to-value').val($mailTo);

                                            jQuery('.massage-to button.btn-success').first().html($label);
                                        });

                                    });
                                </script>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-9"><p><span class="text-danger">(*)</span> Thông tin bắt buộc </p> </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-9"><button name="cmd" class="contact-message-send" value="send" type="submit">Gửi</button></div>
                    </div>
                </form>
            </div>
            <div class="col-lg-6"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.0872662595825!2d105.76678931423663!3d21.0291939859981!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjHCsDAxJzQ1LjEiTiAxMDXCsDQ2JzA4LjMiRQ!5e0!3m2!1svi!2ssg!4v1447234785063" width="100%" height="260" frameborder="0" style="border:0" allowfullscreen></iframe></div>
        </div>
    </div>
</div>
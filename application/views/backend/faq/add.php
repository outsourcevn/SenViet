<div class="col-md-12 text-justify" style="border-top: 1px #afafaf solid;">
    
    <ol class="breadcrumb" style="background: #d8d8d8; margin-top:20px;">
        <li><a href="<?php echo CMS_DEFAULT_BACKEND_URL?>">Trang chủ</a></li>
        <li><a href="<?php echo CMS_DEFAULT_BACKEND_URL?>/faq">Hỏi đáp</a></li>
        <li class="active">Thêm Trợ giúp</li>
    </ol>
    
    <?php echo form_open('')?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Thêm Trợ giúp</h3>
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
                <div class="col-md-3" style="line-height: 200%;"><label for="question">Câu hỏi</label></div>
                <div class="col-md-9">
                    <textarea id="question" name="question" class="form-control ckeditor" title="Câu hỏi"><?php echo (isset($post_data['question'])? $post_data['question'] : '')?></textarea>
                </div>
            </div>

            <div class="col-md-12 item">
                <div class="col-md-3" style="line-height: 200%;"><label for="answer">Câu trả lời</label></div>
                <div class="col-md-9">
                    <textarea id="answer" name="answer" class="form-control ckeditor" title="Câu hỏi"><?php echo (isset($post_data['answer'])? $post_data['answer'] : '')?></textarea>
                </div>
            </div>
            
            <div class="col-md-12 item">
                <div class="col-md-3" style="line-height: 200%;"><label for="publish">Hiển thị</label></div>
                <div class="col-md-9 text-left">
                    <label>Có <input type="radio" name="publish" class="" checked="" value="1"/></label>&Tab;&Tab;&Tab;
                    <label>Không <input type="radio" name="publish" class="" value="0"/></label>
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
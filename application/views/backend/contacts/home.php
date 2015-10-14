


<style>
    table.table tr th, table.table tr td{
        text-align: center;
    }
</style>
<script src="js/common_backend_function.js" type="text/javascript"></script>



<div id="#tree_3"></div>

<div class="col-md-12 text-justify" style="border-top: 1px #afafaf solid;">

    <ol class="breadcrumb" style="background: #d8d8d8; margin-top:20px;">
        <li><a href="<?php echo CMS_DEFAULT_BACKEND_URL?>">Trang chủ</a></li>
        <li class="active">Liên hệ</li>
    </ol>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Contacts</h3>
        </div>

        <div class="panel-body">
            <div class="col-lg-12" style="padding-bottom: 10px;">
                <?php
                echo form_open('', array('method' => 'GET'));
                ?>
                <div class="col-lg-12">
                    <table class="table table-striped">
                        <tr class="active">
                            <td>Keyword</td>
                            <td>Nhóm người nhận</td>
                            <td>Action</td>
                        </tr>
                        <tr>
                            <td><input name="keyword" style="width: 100%;" type="text" placeholder="Từ khóa..." value="<?php echo isset($keyword) ? $keyword : ''?>" /></td>
                            <td>
                                <select name="to" style="width: 100%;">
                                    <option value="0" <?php echo ($to == 0) ? 'selected' : ''?>>All</option>
                                    <?php if(isset($usergroup) && count($usergroup)):
                                        foreach($usergroup as $_group):
                                    ?>
                                            <option value="<?php echo $_group->id;?>" <?php echo ($to == $_group->id) ? 'selected' : ''?>><?php echo $_group->title;?></option>
                                    <?php endforeach; endif;?>
                                </select>
                            </td>

                            <td>
                                <button type="submit" style="border: none; padding:5px 15px;"><span class="glyphicon glyphicon-search"></span> Tìm</button>
                                <button type="reset" style="border: none; padding:5px 15px;"><span class="glyphicon glyphicon-remove"></span> Reset</button>
                            </td>
                        </tr>
                    </table>
                </div>
                </form>

                <div class="col-lg-12" style="padding-bottom: 10px;">
                    <div class="col-md-12 text-right">
                        <button name="cmd" class="btn btn-info show_items">Đánh dấu đã xem</button>
                        <button name="cmd" value="delete" class="btn btn-danger delete_items">Xóa</button>
                    </div>
                </div>
            <div class="col-lg-12">
                <?php
                echo form_open(current_url().'?redir='.base64_encode(current_url().'?'.$_SERVER['QUERY_STRING']));
                ?>
                <table class="table table-striped">
                    <tr>
                        <th><input type="checkbox" id="check_all" /></th>
                        <th><?php echo get_sort_link(uri_string(), 'ID', 'id', '', array('keyword' => $keyword, 'to' => $to));?></th>
                        <th><?php echo get_sort_link(uri_string(), 'Tiêu đề', 'title', '', array('keyword' => $keyword, 'to' => $to));?></th>
                        <th>Người nhận</th>
                        <th><?php echo get_sort_link(uri_string(), 'Đã xem', 'seen', '', array('keyword' => $keyword, 'to' => $to));?></th>
                        <th><?php echo get_sort_link(uri_string(), 'Ngày tạo', 'created_date', '', array('keyword' => $keyword, 'to' => $to));?></th>
                        <th><?php echo get_sort_link(uri_string(), 'Ngày sửa cuối', 'updated_date', '', array('keyword' => $keyword, 'to' => $to));?></th>
                        <th colspan="2">Công cụ</th>
                    </tr>
                    <?php
                    if(isset($input_data) && count($input_data)){
                        foreach($input_data as $key => $val){
                            ?>
                            <tr>
                                <td><input type="checkbox" name="id[]" class="item-checkbox" value="<?php echo $val['id']?>" /></td>
                                <td><?php echo $val['id']?></td>
                                <td><?php echo (isset($val['title'])) ? ($val['title']) : ' - '?></td>
                                <td><?php echo getGroupNameById($val['to']);?></td>
                                <td><a href="<?php echo CMS_DEFAULT_BACKEND_URL?>/contacts/contact_toogle/seen/<?php echo $val['id'].'/?redir='.base64_encode(current_url().'?'.$_SERVER['QUERY_STRING']);?>"><span class="glyphicon glyphicon-<?php echo ($val['seen'] == 1) ? 'ok' : 'remove'?>"></span></a></td>
                                <td><?php echo gmdate('d-m-Y H:i:s', strtotime($val['created_date'])+8*3600);?></td>
                                <td><?php echo gmdate('d-m-Y H:i:s', strtotime($val['updated_date'])+8*3600);?></td>
                                <td><a href="<?php echo CMS_DEFAULT_BACKEND_URL.'/contacts/view/'.$val['id'].'/?redir='.base64_encode(current_url().'?'.$_SERVER['QUERY_STRING']);?>" title="Sửa"><span class="glyphicon glyphicon glyphicon-folder-open"></span></a></td>
                                <td><a href="<?php echo CMS_DEFAULT_BACKEND_URL.'/contacts/del/'.$val['id'].'/?redir='.base64_encode(current_url().'?'.$_SERVER['QUERY_STRING']);?>" onclick="return confirm('Bạn có chắc là muốn xóa bản ghi này không ?')" title="Xóa"><span class="glyphicon glyphicon-trash"></span></a></td>
                            </tr>
                        <?php
                        }
                    }else{
                        ?>
                        <tr>
                            <td colspan="10">Không tìm thấy bản ghi nào trong CSDL.</td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
                <input type="submit" name="cmd" hidden="" value="sort" />
                <input type="submit" name="cmd" hidden="" value="show" />
                <input type="submit" name="cmd" hidden="" value="delete" />
                </form>
            </div>
            <div class="col-md-12 text-center">
                <?php echo $pagination;?>
            </div>
        </div>
    </div>
</div>
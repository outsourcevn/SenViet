


<style>
	table.table tr th, table.table tr td{
		text-align: center;
	}
</style>


<div class="col-md-12 text-justify" style="border-top: 1px #afafaf solid;">
    
    <ol class="breadcrumb" style="background: #d8d8d8; margin-top:20px;">
        <li><a href="<?php echo CMS_DEFAULT_BACKEND_URL?>">Trang chủ</a></li>
        <li class="active">Calendar</li>
    </ol>
    
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Calendar</h3>
        </div>
        
        <div class="panel-body">
            <?php
            echo form_open('', array('method' => 'GET'));
            ?>
            <div class="col-lg-12">
                <table class="table table-striped">
                    <tr class="active">
                        <td>Từ khóa</td>
                        <td>Thời gian</td>
                        <td>Loại lịch</td>
                        <td>Action</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="keyword" placeholder="Tìm kiếm..." value="<?php echo $this->input->get('keyword');?>"/>
                        </td>
                        <td>
                            <input name="start_time" class="datepicker" type="text" placeholder="From" value="<?php echo $this->input->get('start_time');?>"/><br />
                            <input name="end_time" class="datepicker" type="text" placeholder="To"  value="<?php echo $this->input->get('end_time');?>" style="margin: 5px  0px;"/>
                        </td>
                        <td>
                            <select class="form-control" name="category_id" id="category_id">
                                <option value="0">All</option>
                                <option value="1" <?php echo ($this->input->get('category_id') == 1)? 'selected' : ''?>>Lịch làm việc</option>
                                <option value="2" <?php echo ($this->input->get('category_id') == 2)? 'selected' : ''?>>Lịch sự kiện NPP</option>
                            </select>
                        </td>
                        <td>
                            <button type="submit" style="border: none; padding:5px 15px;"><span class="glyphicon glyphicon-search"></span> Search</button>
                            <button type="reset" style="border: none; padding:5px 15px;"><span class="glyphicon glyphicon-remove"></span> Reset</button>
                        </td>
                    </tr>
                </table>
            </div>
            </form>
            <div class="col-lg-12" style="padding-bottom: 10px;">
                <div class="col-md-12 text-right">
                    <button name="cmd" value="show" class="btn btn-info show_items">Kích hoạt</button>
                    <button name="cmd" value="delete" class="btn btn-danger delete_items">Xóa</button>
                    <a href="<?php echo CMS_DEFAULT_BACKEND_URL?>/calendar/add" class="btn btn-success">Thêm mới</a>
                </div>
            </div>
            <div class="col-lg-12">
                <?php
                echo form_open(current_url().'?redir='.base64_encode(current_url().'?'.$_SERVER['QUERY_STRING']));
                ?>
                <table class="table table-striped">
                    <tr>
                        <th><input type="checkbox" id="check_all" /></th>
                        <th><?php echo get_sort_link(uri_string(), 'Tiêu đề', 'title', '', array('keyword' => $keyword, 'start_time' => $start_time, 'end_time' => $end_time, 'category_id' => $category_id));?></th>
                        <th><?php echo get_sort_link(uri_string(), 'Bắt đầu', 'start_time', '', array('keyword' => $keyword, 'start_time' => $start_time, 'end_time' => $end_time, 'category_id' => $category_id));?></th>
                        <th><?php echo get_sort_link(uri_string(), 'Kết Thúc', 'end_time', '', array('keyword' => $keyword, 'start_time' => $start_time, 'end_time' => $end_time, 'category_id' => $category_id));?></th>
                        <th><?php echo get_sort_link(uri_string(), 'Tình trạng', 'publish', '', array('keyword' => $keyword, 'start_time' => $start_time, 'end_time' => $end_time, 'category_id' => $category_id));?></th>
                        <th><?php echo get_sort_link(uri_string(), 'Ngày tạo', 'created_date', '', array('keyword' => $keyword, 'start_time' => $start_time, 'end_time' => $end_time, 'category_id' => $category_id));?></th>
                        <th><?php echo get_sort_link(uri_string(), 'Ngày sửa cuối', 'updated_date', '', array('keyword' => $keyword, 'start_time' => $start_time, 'end_time' => $end_time, 'category_id' => $category_id));?></th>
                        <th colspan="2">Công cụ</th>
                    </tr>
                    <?php
                    if(isset($input_data) && count($input_data)){
                        foreach($input_data as $key => $val){
                            ?>
                            <tr>
                                <td><input type="checkbox" name="id[]" class="item-checkbox" value="<?php echo $val['id']?>" /></td>
                                <td><?php echo (isset($val['title'])) ? ($val['title']) : ' - '?></td>
                                <td><?php echo gmdate('d-m-Y H:i:s', strtotime($val['start_time'])+7*3600);?></td>
                                <td><?php echo gmdate('d-m-Y H:i:s', strtotime($val['end_time'])+7*3600);?></td>
                                <td><a href="<?php echo CMS_DEFAULT_BACKEND_URL?>/calendar/calendar_toggle/publish/<?php echo $val['id'].'/?redir='.base64_encode(current_url().'?'.$_SERVER['QUERY_STRING']);?>"><span class="glyphicon glyphicon-eye-<?php echo ($val['publish'] == 1) ? 'open' : 'close'?>"></span></a></td>
                                <td><?php echo gmdate('d-m-Y H:i:s', strtotime($val['created_date'])+7*3600);?></td>
                                <td><?php echo gmdate('d-m-Y H:i:s', strtotime($val['updated_date'])+7*3600);?></td>
                                <td><a href="<?php echo CMS_DEFAULT_BACKEND_URL.'/calendar/edit/'.$val['id'].'/?redir='.base64_encode(current_url().'?'.$_SERVER['QUERY_STRING']);?>" title="Sửa"><span class="glyphicon glyphicon-pencil"></span></a></td>
                                <td><a href="<?php echo CMS_DEFAULT_BACKEND_URL.'/calendar/del/'.$val['id'].'/?redir='.base64_encode(current_url().'?'.$_SERVER['QUERY_STRING']);?>" onclick="return confirm('Bạn có chắc là muốn xóa bản ghi này không ?')" title="Xóa"><span class="glyphicon glyphicon-trash"></span></a></td>
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
            <div class="clearfix"></div>
            <div class="col-md-12 text-center">
                <?php echo $pagination;?>
            </div>
        </div>
    </div>
</div>
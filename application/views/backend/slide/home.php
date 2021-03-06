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
        <li class="active">Slides</li>
    </ol>
    
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Slides</h3>
        </div>
        
        <div class="panel-body">
	        <div class="col-lg-12" style="padding-bottom: 10px;">
				<?php
					echo form_open('', array('method' => 'POST'));
				?>
					<div class="col-md-3">
						<input type="text" name="keyword" placeholder="" value="<?php echo ($keyword != '') ? $keyword : ''?>" class="form-control" />
					</div>
					<div class="col-md-1">
						<button name="cmd" value="search" class="btn">Tìm kiếm</button>
					</div>
				</form>
				
				<div class="col-md-8 text-right">
                    <button name="cmd" value="sort" class="btn btn-default sort_items">Sắp xếp</button>
					<button name="cmd" value="show" class="btn btn-info show_items">Kích hoạt</button>
					<button name="cmd" value="delete" class="btn btn-danger delete_items">Xóa</button>
                    <a href="<?php echo CMS_DEFAULT_BACKEND_URL?>/slide/add" class="btn btn-success">Thêm mới</a>
				</div>
			</div>
            <div class="col-lg-12">
            <?php
				echo form_open(current_url().'?redir='.base64_encode(current_url().'?'.$_SERVER['QUERY_STRING']));
			?>
					<table class="table table-striped">
						<tr>
							<th><input type="checkbox" id="check_all" /></th>
							<th><?php echo get_sort_link(uri_string(), 'ID', 'id', '', array('keyword' => $keyword));?></th>
							<th><?php echo get_sort_link(uri_string(), 'Tiêu đề', 'title', '', array('title' => $keyword));?></th>
                            <th>Người tạo</th>
                            <th><?php echo get_sort_link(uri_string(), 'Vị trí', 'order', '', array('title' => $keyword));?></th>
							<th><?php echo get_sort_link(uri_string(), 'Tình trạng', 'publish', '', array('keyword' => $keyword));?></th>
							<th><?php echo get_sort_link(uri_string(), 'Ngày tạo', 'created_date', '', array('keyword' => $keyword));?></th>
							<th><?php echo get_sort_link(uri_string(), 'Ngày sửa cuối', 'updated_date', '', array('keyword' => $keyword));?></th>
							<th colspan="2">Công cụ</th>
						</tr>
					<?php
                        if(isset($input_data) && count($input_data)){
                            foreach($input_data as $key => $val){
                    ?>
                        <tr>
							<td><input type="checkbox" name="id[]" class="item-checkbox" value="<?php echo $val['id']?>" /></td>
							<td><?php echo $val['id']?></td>
							<td><?php echo (isset($val['title'])) ? $val['title'] : ' - '?></td>
                            <td><?php echo get_username_by_id($val['userid_created']);?></td>
                            <td><input type="text" class="form-control text-center" name="order[<?php echo $val['id']?>]" value="<?php echo (isset($val['order'])) ? $val['order'] : 0?>" size="1" /></td>
							<td><a href="<?php echo CMS_DEFAULT_BACKEND_URL?>/slide/slide_toggle/publish/<?php echo $val['id'].'/?redir='.base64_encode(current_url().'?'.$_SERVER['QUERY_STRING']);?>"><span class="glyphicon glyphicon-eye-<?php echo ($val['publish'] == 1) ? 'open' : 'close'?>"></span></a></td>
							<td><?php echo gmdate('d-m-Y H:i:s', strtotime($val['created_date'])+8*3600);?></td>
							<td><?php echo gmdate('d-m-Y H:i:s', strtotime($val['updated_date'])+8*3600);?></td>
							<td><a href="<?php echo CMS_DEFAULT_BACKEND_URL.'/slide/edit/'.$val['id'].'/?redir='.base64_encode(current_url().'?'.$_SERVER['QUERY_STRING']);?>" title="Sửa"><span class="glyphicon glyphicon-pencil"></span></a></td>
							<td><a href="<?php echo CMS_DEFAULT_BACKEND_URL.'/slide/del/'.$val['id'].'/?redir='.base64_encode(current_url().'?'.$_SERVER['QUERY_STRING']);?>" onclick="return confirm('Bạn có chắc là muốn xóa bản ghi này không ?')" title="Xóa"><span class="glyphicon glyphicon-trash"></span></a></td>
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
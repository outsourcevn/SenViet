


<style>
	table.table tr th, table.table tr td{
		text-align: center;
	}
</style>
<script src="js/common_backend_function.js" type="text/javascript"></script>
<script src="js/jstree/dist/jstree.js" type="text/javascript"></script>



<div id="#tree_3"></div>

<div class="col-md-12 text-justify" style="border-top: 1px #afafaf solid;">
    
    <ol class="breadcrumb" style="background: #d8d8d8; margin-top:20px;">
        <li><a href="<?php echo CMS_DEFAULT_BACKEND_URL?>">Trang chủ</a></li>
        <li class="active"><a href="<?php echo CMS_DEFAULT_BACKEND_URL?>/faq_sheet/">Hỏi đáp</a></li>
        <li class="active">Quy trình - Biểu Mẫu</li>
    </ol>
    
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Quy trình - Biểu mẫu</h3>
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
					<button name="cmd" value="show" class="btn btn-info show_items">Kích hoạt</button>
					<button name="cmd" value="delete" class="btn btn-danger delete_items">Xóa</button>
                    <a href="<?php echo CMS_DEFAULT_BACKEND_URL?>/faq_sheet/add" class="btn btn-success">Thêm mới</a>
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
							<th><?php echo get_sort_link(uri_string(), 'Tên file', 'file_name', '', array('keyword' => $keyword));?></th>
							<th><?php echo get_sort_link(uri_string(), 'Số lần sửa', 'update_times', '', array('keyword' => $keyword));?></th>
							<th><?php echo get_sort_link(uri_string(), 'Số lần download', 'downloaded_times', '', array('keyword' => $keyword));?></th>
                            <th><?php echo get_sort_link(uri_string(), 'Tình trạng', 'publish', '', array('keyword' => $keyword));?></th>
                            <th><?php echo get_sort_link(uri_string(), 'Ngày tạo', 'created_date', '', array('keyword' => $keyword));?></th>
							<th colspan="2">Công cụ</th>
						</tr>
					<?php
                        if(isset($input_data) && count($input_data)){
                            foreach($input_data as $key => $val){
                    ?>
                        <tr>
							<td><input type="checkbox" name="id[]" class="item-checkbox" value="<?php echo $val['id']?>" /></td>
							<td><?php echo $val['id']?></td>
							<td><?php echo (isset($val['file_name'])) ? ($val['file_name']) : ' - '?></td>
							<td><?php echo number_format($val['update_times']);?></td>
							<td><?php echo number_format($val['downloaded_times']);?></td>
                            <td><a href="<?php echo CMS_DEFAULT_BACKEND_URL?>/faq_sheet/faq_toggle/publish/<?php echo $val['id'].'/?redir='.base64_encode(current_url().'?'.$_SERVER['QUERY_STRING']);?>"><span class="glyphicon glyphicon-eye-<?php echo ($val['publish'] == 1) ? 'open' : 'close'?>"></span></a></td>
                            <td><?php echo gmdate('d-m-Y H:i:s', strtotime($val['created_date'])+8*3600);?></td>
							<td><a href="<?php echo CMS_DEFAULT_BACKEND_URL.'/faq_sheet/edit/'.$val['id'].'/?redir='.base64_encode(current_url().'?'.$_SERVER['QUERY_STRING']);?>" title="Sửa"><span class="glyphicon glyphicon-pencil"></span></a></td>
							<td><a href="<?php echo CMS_DEFAULT_BACKEND_URL.'/faq_sheet/del/'.$val['id'].'/?redir='.base64_encode(current_url().'?'.$_SERVER['QUERY_STRING']);?>" onclick="return confirm('Bạn có chắc là muốn xóa bản ghi này không ?')" title="Xóa"><span class="glyphicon glyphicon-trash"></span></a></td>
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
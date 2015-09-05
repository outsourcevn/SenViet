<style>
	table.table tr th, table.table tr td{
		text-align: center;
	}
</style>
<script src="js/common_backend_function.js" type="text/javascript"></script>
<div class="col-md-12 text-justify" style="border-top: 1px #afafaf solid;">
    
    <ol class="breadcrumb" style="background: #d8d8d8; margin-top:20px;">
        <li><a href="<?php echo CMS_DEFAULT_BACKEND_URL?>">Trang chủ</a></li>
        <li><a href="<?php echo CMS_DEFAULT_BACKEND_URL?>/configs">Configure</a></li>
        <li class="active">Permission List</li>
    </ol>
    
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Permission List</h3>
        </div>
        
        <div class="panel-body">
	        <div class="col-lg-12" style="padding-bottom: 10px;">
				<div class="col-md-12 text-right">
					<button name="cmd" value="delete" class="btn btn-danger delete_items">Xóa</button>
                    <a href="<?php echo CMS_DEFAULT_BACKEND_URL?>/configs/add_permlist" class="btn btn-success">Thêm mới</a>
				</div>
			</div>
            <div class="col-lg-12">
            <?php
				echo form_open(current_url().'?redir='.base64_encode(current_url().'?'.$_SERVER['QUERY_STRING']));
			?>
					<table class="table table-striped">
						<tr>
							<th><input type="checkbox" id="check_all" /></th>
							<th><?php echo get_sort_link(uri_string(), 'ID', 'id', '', array());?></th>
							<th><?php echo get_sort_link(uri_string(), 'Title', 'title', '', array());?></th>
							<th><?php echo get_sort_link(uri_string(), 'URI', 'uri', '', array());?></th>
							<th><?php echo get_sort_link(uri_string(), 'Nhóm Quyền', 'group', '', array());?></th>
							<th colspan="2">Công cụ</th>
						</tr>
					<?php
                        if(isset($input_data) && count($input_data)){
                            foreach($input_data as $key => $val){
                    ?>
                        <tr>
							<td><input type="checkbox" name="id[]" class="item-checkbox" value="<?php echo $val['id']?>" /></td>
							<td><?php echo $val['id']?></td>
							<td><?php echo $val['title']?></td>
							<td><?php echo $val['uri'];?></td>
							<td><?php echo $val['group'];?></td>
							<td><a href="<?php echo CMS_DEFAULT_BACKEND_URL.'/configs/edit_permlist/'.$val['id'].'/?redir='.base64_encode(current_url().'?'.$_SERVER['QUERY_STRING']);?>" title="Sửa"><span class="glyphicon glyphicon-pencil"></span></a></td>
							<td><a href="<?php echo CMS_DEFAULT_BACKEND_URL.'/configs/del_permlist/'.$val['id'].'/?redir='.base64_encode(current_url().'?'.$_SERVER['QUERY_STRING']);?>" onclick="return confirm('Bạn có chắc là muốn xóa bản ghi này không ?')" title="Xóa"><span class="glyphicon glyphicon-trash"></span></a></td>
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
					<input type="submit" name="cmd" hidden="" value="show" />
					<input type="submit" name="cmd" hidden="" value="delete" />
				</form>
			</div>
        </div>
    </div>
</div>
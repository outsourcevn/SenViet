


<style>
	table.table tr th, table.table tr td{
		text-align: center;
	}
</style>


<div class="col-md-12 text-justify" style="border-top: 1px #afafaf solid;">
    
    <ol class="breadcrumb" style="background: #d8d8d8; margin-top:20px;">
        <li><a href="<?php echo CMS_DEFAULT_BACKEND_URL?>">Trang chủ</a></li>
        <li class="active">Orders</li>
    </ol>
    
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Orders</h3>
        </div>
        
        <div class="panel-body">
                <?php
					echo form_open('', array('method' => 'GET'));
				?>
            <div class="col-lg-12">
                <table class="table table-striped">
                    <tr class="active">
                        <td>Keyword</td>
                        <td>Status</td>
                        <td>Date</td>
                        <td>Action</td>
                    </tr>
                    <tr>
                        <td><input name="keyword" style="width: 100%;" type="text" placeholder="Từ khóa..." value="<?php echo isset($keyword) ? $keyword : ''?>" /></td>
                        <td>
                            <select name="status">
                                <option value="0" <?php echo ($status == 0) ? 'selected' : ''?> >All</option>
                                <option value="1" <?php echo ($status == 1) ? 'selected' : ''?> >Pending</option>
                                <option value="2" <?php echo ($status == 2) ? 'selected' : '' ?> >Approved</option>
                                <option value="3" <?php echo ($status == 3) ? 'selected' : '' ?> >Rejected</option>
                            </select>
                        </td>
                        <td>
                            <input name="date_from" class="datepicker" type="text" placeholder="From" value="<?php echo (isset($date_from)) ? $date_from : ''?>"/><br />
                            <input name="date_to" class="datepicker" type="text" placeholder="To"  value="<?php echo (isset($date_to)) ? $date_to : ''?>" style="margin: 5px  0px;"/>
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
							<th><?php echo get_sort_link(uri_string(), 'ID', 'id', '', array('keyword' => $keyword, 'date_from' => $date_from, 'date_to' => $date_to, 'status' => $status));?></th>
							<th><?php echo get_sort_link(uri_string(), 'Email', 'email', '', array('keyword' => $keyword, 'date_from' => $date_from, 'date_to' => $date_to));?></th>
                            <th>Người tạo</th>
							<th><?php echo get_sort_link(uri_string(), 'Tình trạng', 'status', '', array('keyword' => $keyword, 'date_from' => $date_from, 'date_to' => $date_to, 'status' => $status));?></th>
                            <th><?php echo get_sort_link(uri_string(), 'Đã xem', 'is_viewed', '', array('keyword' => $keyword, 'date_from' => $date_from, 'date_to' => $date_to, 'status' => $status));?></th>
							<th><?php echo get_sort_link(uri_string(), 'Ngày tạo', 'created_date', '', array('keyword' => $keyword, 'date_from' => $date_from, 'date_to' => $date_to, 'status' => $status));?></th>
							<th><?php echo get_sort_link(uri_string(), 'Ngày sửa cuối', 'updated_date', '', array('keyword' => $keyword, 'date_from' => $date_from, 'date_to' => $date_to, 'status' => $status));?></th>
							<th colspan="2">Công cụ</th>
						</tr>
					<?php
                        if(isset($input_data) && count($input_data)){
                            foreach($input_data as $key => $val){
                    ?>
                        <tr>
							<td><input type="checkbox" name="id[]" class="item-checkbox" value="<?php echo $val['id']?>" /></td>
							<td><?php echo $val['id']?></td>
							<td><?php echo isset($val['email']) ? $val['email'] : '-'?></td>
                            <td><?php echo get_username_by_id($val['userid_created']);?></td>
							<td><?php 
                                    if(isset($val['status'])){
                                        if($val['status'] == 2){
                                            echo '<strong><p class="text-success">Approved</p></strong>';
                                        }else{
                                            if($val['status'] == 1)
                                            {
                                                echo '<strong><p class="text-muted">Pending</p></strong>';
                                            }
                                            else{
                                                if($val['status'] == 3)
                                                {
                                                    echo '<strong><p class="text-danger">Rejected</p></strong>';
                                                }
                                                else{
                                                    echo '<strong><p class="text-info">Processing</p></strong>';
                                                }
                                            }
                                            
                                        }
                                    }else{
                                        echo '<strong><p class="text-muted">Pending</p></strong>';
                                    }
                                ?>
                            </td>
                            <td><a href="<?php echo CMS_DEFAULT_BACKEND_URL?>/orders/orders_toogle/status/<?php echo $val['id'].'/?redir='.base64_encode(current_url().'?'.$_SERVER['QUERY_STRING']);?>"><span class="glyphicon glyphicon-eye-<?php echo ($val['is_viewed'] == 1) ? 'open' : 'close'?>"></span></a></td>
							<td><?php echo gmdate('d-m-Y H:i:s', strtotime($val['created_date'])+8*3600);?></td>
							<td><?php echo gmdate('d-m-Y H:i:s', strtotime($val['updated_date'])+8*3600);?></td>
							<td><a href="<?php echo CMS_DEFAULT_BACKEND_URL.'/orders/view/'.$val['id'].'/?redir='.base64_encode(current_url().'?'.$_SERVER['QUERY_STRING']);?>" title="View"><span class="glyphicon glyphicon-folder-open"></span></a></td>
							<td><a href="<?php echo CMS_DEFAULT_BACKEND_URL.'/orders/del/'.$val['id'].'/?redir='.base64_encode(current_url().'?'.$_SERVER['QUERY_STRING']);?>" onclick="return confirm('Bạn có chắc là muốn xóa bản ghi này không ?')" title="Xóa"><span class="glyphicon glyphicon-trash"></span></a></td>
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
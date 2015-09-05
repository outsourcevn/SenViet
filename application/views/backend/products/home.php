


<style>
	table.table tr th, table.table tr td{
		text-align: center;
	}
</style>


<div class="col-md-12 text-justify" style="border-top: 1px #afafaf solid;">
    
    <ol class="breadcrumb" style="background: #d8d8d8; margin-top:20px;">
        <li><a href="<?php echo CMS_DEFAULT_BACKEND_URL?>">Trang chủ</a></li>
        <li class="active">Products</li>
    </ol>
    
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Products</h3>
        </div>
        
        <div class="panel-body">
                <?php
					echo form_open('', array('method' => 'GET'));
				?>
            <div class="col-lg-12">
                <table class="table table-striped">
                    <tr class="active">
                        <td>Keyword</td>
                        <td>Category</td>
                        <td>Brand</td>
                        <td>Price</td>
                        <td>Action</td>
                    </tr>
                    <tr>
                        <td><input name="keyword" style="width: 100%;" type="text" placeholder="Từ khóa..." value="<?php echo isset($keyword) ? $keyword : ''?>" /></td>
                        <td>
                            <select name="category_id" style="width: 100%;">
                                <option value="0">All</option>
                                <?php
                                    if(count($list_category)){
                                        foreach($list_category as $temp){
                                ?>
                                <option value="<?php echo (isset($temp['id']) ? $temp['id'] : 0)?>" <?php echo ($category_id == $temp['id']) ? 'selected' : ''?> ><?php echo (isset($temp['title']) ? $temp['title'] : '-')?></option>
                                <?php
                                        }
                                    }
                                ?>
                            </select>
                        </td>
                        <td>
                            <select name="brand_id" style="width: 100%;">
                                <option value="0">All</option>
                                <?php
                                    if(count($list_brand)){
                                        foreach($list_brand as $temp){
                                ?>
                                <option value="<?php echo (isset($temp['id']) ? $temp['id'] : 0)?>" <?php echo ($brand_id == $temp['id']) ? 'selected' : ''?> ><?php echo (isset($temp['brand_name']) ? $temp['brand_name'] : '-')?></option>
                                <?php
                                        }
                                    }
                                ?>
                            </select>
                        </td>
                        <td>
                            <input name="price_from" type="text" placeholder="From" value="<?php echo (isset($price_from)) ? $price_from : ''?>"/><br />
                            <input name="price_to" type="text" placeholder="To"  value="<?php echo (isset($price_to)) ? $price_to : ''?>" style="margin: 5px  0px;"/>
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
                    <button name="cmd" value="sort" class="btn btn-default sort_items">Sắp xếp</button>
					<button name="cmd" value="show" class="btn btn-info show_items">Kích hoạt</button>
					<button name="cmd" value="delete" class="btn btn-danger delete_items">Xóa</button>
                    <a href="<?php echo CMS_DEFAULT_BACKEND_URL?>/products/add" class="btn btn-success">Thêm mới</a>
				</div>
			</div>
            <div class="col-lg-12">
            <?php
				echo form_open(current_url().'?redir='.base64_encode(current_url().'?'.$_SERVER['QUERY_STRING']));
			?>
					<table class="table table-striped">
						<tr>
							<th><input type="checkbox" id="check_all" /></th>
							<th><?php echo get_sort_link(uri_string(), 'ID', 'id', '', array('keyword' => $keyword, 'category_id' => $category_id, 'brand_id' => $brand_id, 'price_from' => $price_from, 'price_to' => $price_to));?></th>
							<th><?php echo get_sort_link(uri_string(), 'Tiêu đề', 'title', '', array('keyword' => $keyword, 'category_id' => $category_id, 'brand_id' => $brand_id, 'price_from' => $price_from, 'price_to' => $price_to));?></th>
                            <th>Người tạo</th>
                            <th><?php echo get_sort_link(uri_string(), 'Vị trí', 'order', '', array('keyword' => $keyword, 'category_id' => $category_id, 'brand_id' => $brand_id, 'price_from' => $price_from, 'price_to' => $price_to));?></th>
							<th><?php echo get_sort_link(uri_string(), 'Tình trạng', 'publish', '', array('keyword' => $keyword, 'category_id' => $category_id, 'brand_id' => $brand_id, 'price_from' => $price_from, 'price_to' => $price_to));?></th>
                            <th><?php echo get_sort_link(uri_string(), 'Nổi bật', 'is_featured', '', array('keyword' => $keyword, 'category_id' => $category_id, 'brand_id' => $brand_id, 'price_from' => $price_from, 'price_to' => $price_to));?></th>
							<th><?php echo get_sort_link(uri_string(), 'Ngày tạo', 'created_date', '', array('keyword' => $keyword, 'category_id' => $category_id, 'brand_id' => $brand_id, 'price_from' => $price_from, 'price_to' => $price_to));?></th>
							<th><?php echo get_sort_link(uri_string(), 'Ngày sửa cuối', 'updated_date', '', array('keyword' => $keyword, 'category_id' => $category_id, 'brand_id' => $brand_id, 'price_from' => $price_from, 'price_to' => $price_to));?></th>
							<th colspan="2">Công cụ</th>
						</tr>
					<?php
                        if(isset($input_data) && count($input_data)){
                            foreach($input_data as $key => $val){
                    ?>
                        <tr>
							<td><input type="checkbox" name="id[]" class="item-checkbox" value="<?php echo $val['id']?>" /></td>
							<td><?php echo $val['id']?></td>
							<td><?php echo isset($val['title']) ? $val['title'] : '-'?></td>
                            <td><?php echo get_username_by_id($val['userid_created']);?></td>
                            <td><input class="form-control text-center" size="1" name="order[<?php echo $val['id']?>]" value="<?php echo $val['order']?>" /></td>
							<td><a href="<?php echo CMS_DEFAULT_BACKEND_URL?>/products/products_toogle/publish/<?php echo $val['id'].'/?redir='.base64_encode(current_url().'?'.$_SERVER['QUERY_STRING']);?>"><span class="glyphicon glyphicon-eye-<?php echo ($val['publish'] == 1) ? 'open' : 'close'?>"></span></a></td>
                            <td><a href="<?php echo CMS_DEFAULT_BACKEND_URL?>/products/products_toogle/is_featured/<?php echo $val['id'].'/?redir='.base64_encode(current_url().'?'.$_SERVER['QUERY_STRING']);?>"><span class="glyphicon glyphicon-eye-<?php echo ($val['is_featured'] == 1) ? 'open' : 'close'?>"></span></a></td>
							<td><?php echo gmdate('d-m-Y H:i:s', strtotime($val['created_date'])+8*3600);?></td>
							<td><?php echo gmdate('d-m-Y H:i:s', strtotime($val['updated_date'])+8*3600);?></td>
							<td><a href="<?php echo CMS_DEFAULT_BACKEND_URL.'/products/edit/'.$val['id'].'/?redir='.base64_encode(current_url().'?'.$_SERVER['QUERY_STRING']);?>" title="Sửa"><span class="glyphicon glyphicon-pencil"></span></a></td>
							<td><a href="<?php echo CMS_DEFAULT_BACKEND_URL.'/products/del/'.$val['id'].'/?redir='.base64_encode(current_url().'?'.$_SERVER['QUERY_STRING']);?>" onclick="return confirm('Bạn có chắc là muốn xóa bản ghi này không ?')" title="Xóa"><span class="glyphicon glyphicon-trash"></span></a></td>
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
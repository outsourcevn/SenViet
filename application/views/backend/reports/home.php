


<style>
	table.table tr th, table.table tr td{
		text-align: center;
	}
</style>


<div class="col-md-12 text-justify" style="border-top: 1px #afafaf solid;">
    
    <ol class="breadcrumb" style="background: #d8d8d8; margin-top:20px;">
        <li><a href="<?php echo CMS_DEFAULT_BACKEND_URL?>">Trang chủ</a></li>
        <li class="active">Reports</li>
    </ol>
    
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Reports</h3>
        </div>
        
        <div class="panel-body">
                <?php
					echo form_open('', array('method' => 'GET'));
				?>
            <div class="col-lg-12">
                <table class="table table-striped">
                    <tr class="active">
                        <td>Date</td>
                        <td>Action</td>
                    </tr>
                    <tr>
                        <td>
                            <input name="date_from" class="datepicker" type="text" placeholder="From" value="<?php echo $this->input->get('date_from');?>"/><br />
                            <input name="date_to" class="datepicker" type="text" placeholder="To"  value="<?php echo $this->input->get('date_to');?>" style="margin: 5px  0px;"/>
                        </td>
                        <td>
                            <button type="submit" style="border: none; padding:5px 15px;"><span class="glyphicon glyphicon-search"></span> Show Reports</button>
                            <button type="reset" style="border: none; padding:5px 15px;"><span class="glyphicon glyphicon-remove"></span> Reset</button>
                        </td>
                    </tr>
                </table>
            </div>
            </form>
            
            <div class="clearfix"></div>
        </div>
        <ul class="list-group">
            <li class="list-group-item active" style="z-index: 0;">Best Selling</li>
            <li class="list-group-item text-center">
                <?php
                    if(isset($best_selling) && count($best_selling) && is_array($best_selling)){
                ?>
                <div id="canvas-holder">
                    <canvas id="chart-area" width="500" height="500"/>
                </div>
                    <script>
    
            		var pieData = [
            				{
            					value: <?php echo (isset($best_selling[0]['DEM']) ? $best_selling[0]['DEM'] : 0)?>,
            					color:"#F7464A",
            					highlight: "#FF5A5E",
            					label: "<?php echo (isset($best_selling[0]['title']) ? $best_selling[0]['title'] : '-')?>"
            				},
            				{
            					value: <?php echo (isset($best_selling[1]['DEM']) ? $best_selling[1]['DEM'] : 0)?>,
            					color: "#46BFBD",
            					highlight: "#5AD3D1",
            					label: "<?php echo (isset($best_selling[1]['title']) ? $best_selling[1]['title'] : '-')?>"
            				},
            				{
            					value: <?php echo (isset($best_selling[2]['DEM']) ? $best_selling[2]['DEM'] : 0)?>,
            					color: "#FDB45C",
            					highlight: "#FFC870",
            					label: "<?php echo (isset($best_selling[2]['title']) ? $best_selling[2]['title'] : '-')?>"
            				},
            				{
            					value: <?php echo (isset($best_selling[3]['DEM']) ? $best_selling[3]['DEM'] : 0)?>,
            					color: "#949FB1",
            					highlight: "#A8B3C5",
            					label: "<?php echo (isset($best_selling[3]['title']) ? $best_selling[3]['title'] : '-')?>"
            				},
            				{
            					value: <?php echo (isset($best_selling[4]['DEM']) ? $best_selling[4]['DEM'] : 0)?>,
            					color: "#4D5360",
            					highlight: "#616774",
            					label: "<?php echo (isset($best_selling[4]['title']) ? $best_selling[4]['title'] : '-')?>"
            				}
            
            			];
            	   </script>
                    <table class="table tableborder table-hover">
                    <?php
                        foreach($best_selling as $k => $v){
                    ?>
                        <tr>
                            <th><?php echo $v['title']?></th>
                            <th><?php echo $v['DEM'] ?></th>
                        </tr>
                    <?php
                        }
                    ?>
                    </table>
                <?php
                } else {
                    echo "Không có thống kê trong giai đoạn này.";
                }
                ?>
            </li>
            
            <li class="list-group-item active" style="z-index: 0;">Best Revenues</li>
            <li class="list-group-item text-center">
                <?php
                    if(isset($best_revenues) && count($best_revenues) && is_array($best_revenues)){
                ?>
                <div id="canvas-holder-revenues">
                    <canvas id="chart-area-revenues" width="300" height="300"/>
                </div>
                    <script>
    
            		var pieDataX = [
            				{
            					value: <?php echo (isset($best_revenues[0]['TIEN']) ? $best_revenues[0]['TIEN'] : 0)?>,
            					color:"#F7464A",
            					highlight: "#FF5A5E",
            					label: "<?php echo (isset($best_revenues[0]['title']) ? $best_revenues[0]['title'] : '-')?>"
            				},
            				{
            					value: <?php echo (isset($best_revenues[1]['TIEN']) ? $best_revenues[1]['TIEN'] : 0)?>,
            					color: "#46BFBD",
            					highlight: "#5AD3D1",
            					label: "<?php echo (isset($best_revenues[1]['title']) ? $best_revenues[1]['title'] : '-')?>"
            				},
            				{
            					value: <?php echo (isset($best_revenues[2]['TIEN']) ? $best_revenues[2]['TIEN'] : 0)?>,
            					color: "#FDB45C",
            					highlight: "#FFC870",
            					label: "<?php echo (isset($best_revenues[2]['title']) ? $best_revenues[2]['title'] : '-')?>"
            				},
            				{
            					value: <?php echo (isset($best_revenues[3]['TIEN']) ? $best_revenues[3]['TIEN'] : 0)?>,
            					color: "#949FB1",
            					highlight: "#A8B3C5",
            					label: "<?php echo (isset($best_revenues[3]['title']) ? $best_revenues[3]['title'] : '-')?>"
            				},
            				{
            					value: <?php echo (isset($best_revenues[4]['TIEN']) ? $best_revenues[4]['TIEN'] : 0)?>,
            					color: "#4D5360",
            					highlight: "#616774",
            					label: "<?php echo (isset($best_revenues[4]['title']) ? $best_revenues[4]['title'] : '-')?>"
            				}
            
            			];
            
            	   </script>
                   <table class="table tableborder table-hover">
                    <?php
                        foreach($best_revenues as $k => $v){
                    ?>
                        <tr>
                            <th><?php echo $v['title']?></th>
                            <th><?php echo number_format($v['TIEN']) ?> VNĐ</th>
                        </tr>
                    <?php
                        }
                    ?>
                    </table>
                <?php
                } else {
                    echo "Không có thống kê trong giai đoạn này.";
                }
                ?>
                <script>
                    window.onload = function(){
                        var ctx = document.getElementById("chart-area").getContext("2d");
            				window.myPie = new Chart(ctx).Pie(pieData);
                            
            			var ctx2 = document.getElementById("chart-area-revenues").getContext("2d");
        				window.myPie = new Chart(ctx2).Pie(pieDataX);
        			};
                </script>
            </li>
        </ul>
    </div>
</div>
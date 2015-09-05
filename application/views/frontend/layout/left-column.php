<?php 
echo form_open('', array('method' => 'GET', 'id' => 'shop-filter'));
?>

<script>
    var brands = [];
    var price_from = 0;
    var price_to = 0;
    
    function add_brands(brand_id){
        flag = 1;
        for(i = 0; i < brands.length; i++){
            if(brands[i] == brand_id){
                flag = 0;
            }
        }
        if(flag == 1){
            brands.push(brand_id);
        }
    }
    
    function remove_brands(brand_id){
        i = 0;
        j = 0;
        
        for(i = 0; i < brands.length; i++){
            
            if(brands[i] == brand_id){
                j = i+1;
            }
            brands[i] = brands[j];
            j++;
        }
    }
</script>
<div class="container">
<div class="col-lg-12" style="background: #fff;">
    <div class="col-lg-3 left-column">
        <div class="categories">
            <h3 class="featured-product-heading">Categories</h3>
            
            <ul class="categories-list">
                <li class=""><strong><a href="shop">Shop</a></strong></li>
            <?php
                $data  = CurentCategory(1);
                GenerateCategoryList($data, 1);
            ?>
            </ul>
        </div>
        
        <div class="brands">
            <h3 class="featured-product-heading">Brands</h3>
            <div id="list_brands" class="radio">
            <?php
                if(isset($list_brand) && count($list_brand) > 0 && is_array($list_brand)){
                    foreach($list_brand as $keyBrand => $valBrand){
            ?>
                <label class="col-md-12"><span class="col-md-10"><?php echo $valBrand->brand_name?></span> <input name="brands_id[]" value="<?php echo $valBrand->id?>" type="checkbox" <?php echo (isset($_GET['brands_id']) && in_array($valBrand->id, $_GET['brands_id'])) ? 'checked' : ''?> /></label>
            <?php
                    }
                }
            ?>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="price-range">
            <h3 class="featured-product-heading">Price</h3>
            <div id="html5">
                
            </div>
            <br />
            <br />
            <div class="col-md-12">
                <div class="col-sm-8">
                    <input name="price_from" type="number" class="form-control" id="price_from" value="<?php echo $this->input->get('price_from');?>" />
                </div>
                <div class="col-sm-3">VNĐ</div>
            </div>
            <br /><br /><br />
            <div class="col-md-12">
                <div class="col-sm-8">
                    <input name="price_to" type="number" class="form-control" id="price_to" value="<?php echo ($this->input->get('price_to')) ? $this->input->get('price_to') : 40000000?>" />
                </div>
                <div class="col-sm-3">VNĐ</div>
            </div>
            <script>
                $('#html5').noUiSlider({
                	start: [ <?php echo (isset($_GET['price_from'])) ? $_GET['price_from'] : 0?>, <?php echo (isset($_GET['price_to'])) ? $_GET['price_to'] : 40000000?> ],
                	connect: true,
                    step : 500000,
                	range: {
                		'min': 0,
                		'max': 40000000
                	}
                });
                
                $('#html5').Link('lower').to($('#price_from'));
    
                $('#html5').Link('upper').to($('#price_to'));
            </script>
            <input type="hidden" name="keyword" value="<?php echo $this->input->get('keyword', TRUE);?>" />
            <div class="col-lg-12 text-right"><button name="btn" class="btn btn-info">Filter</button></div>
        </div>
    </div>

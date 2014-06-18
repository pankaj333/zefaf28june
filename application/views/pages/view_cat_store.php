<div class="large-6 columns main-content">
            <ul class="small-block-grid-3 images-box">
            <?php //echo "<pre>";print_r($cat_detail);die;
			foreach($cat_detail as $d){?>
              <li><img src="<?php echo base_url();?>img/<?=$d['s_store_logo']?>"><span class="caption">
              <a href="<?php echo base_url();?>store/viewstore/<?=$d['id']?>"><?=$d['s_store_name']?></a></span></li>
              <?php } ?>
            </ul>
            <ul class="small-block-grid-3 images-box">
              <li><img src="<?php echo base_url();?>img/img.jpg"><span class="caption"><a href="#">Sheraton Hotel</a></span></li>
              <li><img src="<?php echo base_url();?>img/jimg3.jpg"><span class="caption"><a href="#">Sofitel Hotel</a></span></li>
              <li><img src="<?php echo base_url();?>img/img.jpg"><span class="caption"><a href="#">Hotel Name</a></span></li>
            </ul>
 

</div>
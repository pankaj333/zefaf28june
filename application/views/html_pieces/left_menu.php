
      <div class="large-3 columns left-sidebar">
        <ul class="side-nav">
        <?php foreach($all_cat as $cat){ ?>
          <li><a class="<?=strtolower($cat['css_class'])?>" href="<?php echo base_url();?>store/category/<?=$cat['id']?>"><?=$cat['s_category_name']?></a></li>
          <?php } if($this->session->userdata('user_id')) {?>
          <!--<li><a href="#" class="A-Information">Account Information</a></li> -->
          <li><a href="<?php echo base_url();?>store/mystore" class="A-Information">My Store</a></li>
           <?php } ?>
          <!--<li><a class="halla" href="#">Halla</a></li>
          <li><a class="wedding" href="#">Wedding Dresses</a></li>
          <li><a class="restaurants" href="#">Restaurants</a></li>
          <li><a class="flowers" href="#">Flowers</a></li>
          <li><a class="catering" href="#">Catering</a></li>
          <li><a class="photography" href="#">Photography</a></li>
          <li><a class="beauty" href="#">Beauty Salons</a></li>-->
        </ul>
      </div>
<div class="large-3 columns right-sidebar">
<?php $data=$this->category->getalladds(); if($data){ foreach($data as $d){?>
       <div class="large-12 medium-12 columns">
       			<a href="<?=$d['add_link']?>"><img src="<?php echo base_url().'img/adds/'.$d['add_image'];?>"></a>
       </div>
<?php } } ?>
  </div>
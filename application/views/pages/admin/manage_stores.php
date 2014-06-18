<?php $this->load->view('pages/admin/header'); ?>

<!---======================== Sidebar ============================--->

<?php $this->load->view('pages/admin/left_menu'); ?> 

<!----========================Content=============================---->

<div id="content" class="container-fluid"> 
 
<div class="row-fluid">
        <div class="span12">
            <h2 class="pull-left">Manage Stores</h2>
        </div>
        <p>
     </div>
  
      <div class="main_box">
          <table class="table_style">
            <thead>
              <tr>
                 <th width="10%">ID</th>
                 <th width="10%">Store Name</th>
                 <th width="16%">City</th>
                 <th width="10%">Store Logo</th>
                 <th width="10%">Email</th>
                 <th width="20%">Site Url</th>
                 <th >Status</th>
                 <th >View</th>
              </tr>
           </thead>
          <tbody>
                <?php foreach($allstore as $store){?>
          <tr>
              <td><?=@$store['id']?></td>
              <td><?=@$store['s_store_name']?></td>
              <td><?=@$store['i_city']?></td>
              <td><img style="max-height:77px;max-width:115px;" src="<?php echo base_url();?>img/upload/<?=@$store['s_store_logo']?>"></td>
              <td><?=@$store['s_store_email']?> </td>
              <td><?=@$store['s_store_website']?> </td>
              <td><a href="javascript:" onclick="active_store(<?=@$store['id']?>,'<?=@$store['i_status']?>')">
			  <?php if($store['i_status']=='1'){ ?>
              <img style="height:20px;" title="Click here to mark" src="<?php echo base_url();?>img/correct.png">
              <?php }else{ ?>
              <img style="height:20px;" title="Click here to confirm" src="<?php echo base_url();?>img/cros.png">
              <?php }?></a></td>
              <td>
                 <span class="social_btns"> <a target="_blank" href="<?php echo base_url();?>store/viewstore/<?=@$store['id']?>"><img src="<?php echo base_url();?>css/admin/img/view.jpg"></a></span>
                  <span class="social_btns"> <a href="<?php echo base_url();?>store/editstore/<?=@$store['id']?>"><img src="<?php echo base_url();?>css/admin/img/edit.jpg"></a></span>
<!--                  <span class="social_btns"> <a href="#"><img src="img/edit.jpg"></a></span>
                  <span class="social_btns">  <a onclick="return del(<?=@$store['id']?>);" href="#"><img src="<?php echo base_url();?>css/admin/img/delete.jpg"></a></span>-->
              </td>
          </tr>
          <?php } ?>
            </tbody>
          
          </table>
      
      
      </div>

  </div>
</div>


<!-------------------------------row-------------------------------->

<div class="clearfix"></div></div>

 

<!----======================== Javascripts =============================----->

<!-- jQuery (latest version) -->
<script src="<?php echo base_url();?>css/admin/js/jquery-latest.js"></script>
<!-- menu -->
<script src="<?php echo base_url();?>css/admin/js/menu.js"></script>
<!-- bootstrap 2.3.0 -->
<script src="<?php echo base_url();?>css/admin/js/bootstrap.js"></script>
<script type="text/javascript">
 

function active_store(id,status){
				 
					$.post("<?php echo base_url();?>admin/verifystore" , { id : id, status : status} ,
					function(data){
							alert("Successfully Updated!");
							window.location.href='';
						});
				 
}
</script>

</body></html>
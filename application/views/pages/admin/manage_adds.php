<?php $this->load->view('pages/admin/header'); ?>

<!---======================== Sidebar ============================--->

<?php $this->load->view('pages/admin/left_menu'); ?> 

<!----========================Content=============================---->

<div id="content" class="container-fluid"> 
 
<div class="row-fluid">
        <div class="span12">
            <h2 class="pull-left">Manage Adds</h2>
        </div>
        <p>
	<a href="<?php echo base_url();?>admin/insertadd">Create New Add</a></p>
    </div>
  
      <div class="main_box">
          <table class="table_style">
            <thead>
              <tr>
                 <th width="10%">ID</th>
                 <th width="10%">Name</th>
                 <th>Link</th>
                 <th width="10%">Image</th>
                 <th width="10%">Description</th>
                 <th>Order</th>
                 <th width="16%">Status</th>
                 <th width="16%">Action</th>
              </tr>
           </thead>
          <tbody>
                <?php foreach($alladds as $user){?>
          <tr>
              <td><?=@$user['id']?></td>
              <td><?=@$user['add_name']?></td>
              <td><?=@$user['add_link']?></td>
              <td><img style="max-height:77px;max-width:115px;" src="<?php echo base_url();?>img/adds/<?=@$user['add_image']?>"></td>
              <td><?=@$user['add_des']?> </td>
              <td><?=@$user['add_order']?> </td>
              <td><?php if($user['active']=='Y'){echo "Active";}else{echo "InActive";}?></td>
              <td>
                 <span class="social_btns"> <a href="<?php echo base_url();?>admin/viewadd/<?=@$user['id']?>"><img src="<?php echo base_url();?>css/admin/img/view.jpg"></a></span>
                  <span class="social_btns"> <a href="<?php echo base_url();?>admin/editadd/<?=@$user['id']?>"><img src="<?php echo base_url();?>css/admin/img/edit.jpg"></a></span>
                  <!--<span class="social_btns"> <a href="#"><img src="img/edit.jpg"></a></span>-->
                  <span class="social_btns">  <a onclick="return del(<?=@$user['id']?>);" href="#"><img src="<?php echo base_url();?>css/admin/img/delete.jpg"></a></span>
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
function del(id){
				if(confirm("Are you sure want to delete this Add?")){
					$.post("<?php echo base_url();?>admin/deladd" , { id : id} ,
					function(data){
							alert("Add Deleted!");
							window.location.href='';
						});
				}
}
</script>

</body></html>
<?php $this->load->view('pages/admin/header'); ?>

<!---======================== Sidebar ============================--->

<?php $this->load->view('pages/admin/left_menu'); ?> 

<!----========================Content=============================---->

<div id="content" class="container-fluid"> 
 
<div class="row-fluid">
        <div class="span12">
            <h2 class="pull-left">Registred Users</h2>
        </div>
    </div>
  
      <div class="main_box">
          <table class="table_style">
            <thead>
              <tr>
                 <th width="10%">ID</th>
                 <th width="22%">Name</th>
                 <th>Email</th>
                 <th width="10%">City</th>
                 <th width="15%">User Type</th>
                 <th width="10%">Status</th>
                 <th width="16%">Action</th>
              </tr>
           </thead>
          <tbody>
                <?php foreach($reg_users as $user){?>
          <tr>
              <td><?=@$user['id']?></td>
              <td><?=@ucfirst($user['s_name'])?></td>
              <td><?=@$user['s_email']?></td>
              <td><?php $city=$this->category->getcountrybycityid($user['s_city']);
			  echo @$city->cityName;
			  
			  ?></td>
              <td><?php if($user['s_password']==NULL){echo "Social User";}else{echo "Registered User";}?></td>
              <td><?php if($user['i_status']==1){echo "Active";}else{echo "InActive";}?></td>
              <td>
                  <span class="social_btns"> <a href="<?php echo base_url();?>admin/viewuser/<?=@$user['id']?>"><img src="<?php echo base_url();?>css/admin/img/view.jpg"></a></span>
                  <span class="social_btns"> <a href="<?php echo base_url();?>admin/edituser/<?=@$user['id']?>"><img src="<?php echo base_url();?>css/admin/img/edit.jpg"></a></span>
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
				if(confirm("Are you sure want to delete this User?")){
					$.post("<?php echo base_url();?>admin/deluser" , { id : id} ,
					function(data){
							alert("User Deleted!");
							window.location.href='';
						});
				}
}
</script>

</body></html>
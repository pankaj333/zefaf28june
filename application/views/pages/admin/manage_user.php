<?php $this->load->view('pages/admin/header'); ?>

<!---======================== Sidebar ============================--->

<?php $this->load->view('pages/admin/left_menu');  //echo "<pre>";print_r($user);die;?> 

<!----========================Content=============================---->
<style>
.table_style thead th{ border:none;}

</style>
<div id="content" class="container-fluid"> 
 
<div class="row-fluid">
        <div class="span12">
            <h2 class="pull-left">All Categories</h2>
        </div>
    </div>
  <form action="" method="post" name="update_user">
      <div class="main_box">
          <table class="table_style">
            <thead>
            <tr>
		<th>ID</th>
		<td> <?=$user->id;?> </td>
	</tr>
	<tr>
		<th>Full Name</th>
		<td><input type="text"  value="<?=$user->s_name;?>" <?=@$chk;?> name="s_name"> 
</td>
	</tr>
	<tr>
		<th>User Name</th>
		<td><input type="text" value="<?=@$user->s_username;?>" <?=@$chk;?> name="s_username"> 
</td>
	</tr>
	<tr>
		<th>User Email</th>
		<td><input type="text" value="<?=@$user->s_email;?>" <?=@$chk;?> name="s_email"> 
</td>
	</tr>
	<tr>
		<th>Is active  </th>
		<td> <input type="checkbox" name="i_status" <?=@$chk;?> value="1"  <?php if($user->i_status==1){echo 'checked="checked"';}?> />  
</td>
	</tr>
    <tr>
		<th>&nbsp;  </th>
		<td>   <?php if($chk==''){ ?>
			<input type="submit" value="Update" name="update">
			<?php }  ?>   
</td>
	</tr>
           </thead>
           </table>
      
      
      </div>
</form>
  </div>
</div>


<!-------------------------------row-------------------------------->

<div class="clearfix"></div></div>

 

<!----======================== Javascripts =============================----->

<!-- jQuery (latest version) -->
<script src="js/jquery-latest.js"></script>
<!-- menu -->
<script src="js/menu.js"></script>
<!-- bootstrap 2.3.0 -->
<script src="js/bootstrap.js"></script>
<script type="text/javascript">
function del(id){
				if(confirm("Are you sure want to delete this category?")){
					$.post("<?php echo base_url();?>admin/delcat" , { id : id} ,
					function(data){
							alert("Category Deleted!");
							window.location.href='';
						});
				}
}
</script>

</body></html>
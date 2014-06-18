<p>
	<?php	//echo anchor($controller.'/list_all', 'Back to list'); ?>
</p>

<form action="<?php echo base_url().$controller; ?>/save" method="post">

<div id="content" class="container-fluid"> 
 
<div class="row-fluid">
        <div class="span12">
            <h2 class="pull-left">All Categories</h2>
        </div>
    </div>
  
      <div class="main_box">
          <table class="table_style">
            <thead>
                </thead>
          <tbody>
<?php foreach($titles as $key => $title) { ?>
	<tr>
		<td><?php echo $title; ?></td>
		<td><?php echo $fields[$key]; ?></td>
	</tr>
<?php } ?>
</tbody>
          
          </table>
      
      
    

<p>
	<input type="submit" value="Save">
</p>

</form>  </div>

  </div>
</div>


<!-------------------------------row-------------------------------->

<div class="clearfix"></div></div>
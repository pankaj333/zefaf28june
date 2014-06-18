
<?php 
 
if ($message) { ?>
<p><?php echo $message; ?></p>
<?php }?>

<div id="content" class="container-fluid"> 
 
<div class="row-fluid">
        <div class="span12">
            <h2 class="pull-left">All Categories</h2>
        </div>
    </div>
  <p>
	<?php	echo anchor($controller.'/create', 'Create Category'); ?>
</p>
      <div class="main_box">
          <table class="table_style">
            <thead>
              <tr>
<?php foreach($titles as $title) { ?>
		<th><?php echo $title; ?></th>
<?php } ?>
	</tr>
	 </thead>
          <tbody>
<?php foreach($fields as $row) { ?>
	<tr>
<?php 	foreach($row as $field) { ?>
		<td><?php echo $field; ?></td>
<?php 	} ?>
	</tr>
<?php } ?>

</tbody>
          
          </table>

<?php if ($pages_count > 1) { ?>
	<p>
	<?php for($i=1;$i<=$pages_count;$i++) { ?>
		<?php	echo anchor($controller.'/list_all/'.$i, $i); ?>
	<?php } ?>
	</p>
<?php } ?>



</div>

  </div>
</div>


<!-------------------------------row-------------------------------->

<div class="clearfix"></div></div>
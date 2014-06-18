<?php $this->load->view('pages/admin/header'); ?>

<!---======================== Sidebar ============================--->

<?php $this->load->view('pages/admin/left_menu'); ?> 

<!----========================Content=============================---->
<!----======================== Javascripts =============================----->
<script type="text/javascript" src="<?php echo base_url();?>js/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
  window.onload = function()
    {
	    CKEDITOR.replace( 'page_content',
			{
				toolbar : 'Full',
				uiColor : '#9AB8F3'
			});
 	};
 
var editor_data = CKEDITOR.instances.text.getData();
</script>

<!-- jQuery (latest version) -->
<script src="<?php echo base_url();?>css/admin/js/jquery-latest.js"></script>
<!-- menu -->
<script src="<?php echo base_url();?>css/admin/js/menu.js"></script>
<!-- bootstrap 2.3.0 -->
<script src="<?php echo base_url();?>css/admin/js/bootstrap.js"></script>
 <script type="text/javascript">
// <![CDATA[
    $(document).ready(function(){
       
	    
	    $('#pagename').change(function(){ //any select change on the dropdown with id country trigger this code
           //$("#term").empty(); //first of all clear select items
            var pageid = $('#pagename').val();  // here we are taking country id of the selected one.
    $.post("<?php echo base_url();?>admin/getpagecontent", { pageid : pageid } ,

               function (data)
				{
					//alert(data.page_content);
					//$("#pagedata").val(data.page_content);
					
					  $.each(data, function(key, element) {
				
					//alert('key: ' + key + '\n' + 'value: ' + element);
					//$("input[name="+key+"]").val(element);
					if(key=='page_content'){
						//alert('key: ' + key + '\n' + 'value: ' + element);
					$("textarea[name="+key+"]").val(element);
						CKEDITOR.instances.page_content.setData(element);
					}
					
					});
				});
				return false;
			});
		});
    // ]]>
</script>

<div id="content" class="container-fluid"> 
 
<div class="row-fluid">
        <div class="span12">
            <h2 class="pull-left">Manage Pages</h2>
        </div>
    </div>
  
      <div class="main_box">

<div style="width:1058px;">
        <form action="" method="post" >
<table border="2" width="100%"><tr><th width="10%">Select Page</th>
<td width="60%"><select name="pagename" id="pagename">
<option value="0"> --select page-- </option>
<?php foreach($allpages as $page){?>
<option value="<?=$page['pageid']?>"><?=$page['pagename']?></option>
<?php } ?>

</select>
<?php //echo form_dropdown('pagename', $allpages, '#', 'id="pagename"'); ?>
</td></tr>
<tr><th width="10%">Description</th>
<td>
            <textarea id="page_content" name="page_content"></textarea>
          
</td></tr>
<tr><td colspan="2" align="center"><input type="submit" name="sub" id="sub" value="Submit" /></td></tr></table>
</form>
</div>
</div>

  </div>
</div>


<!-------------------------------row-------------------------------->

<div class="clearfix"></div></div>

 

</body></html>
<div class="large-6 columns main-content">
<script src="http://localhost/crm2/static/js/validation.js" type="text/javascript"></script>
 <script type="text/javascript">
$().ready(function() { $("#edit_store").validate({ }); });
</script>
 <script type="text/javascript">
 $(function(){
 		$(".remove_img_db").click(function(){
					
								var img_id = $(this).attr("value");
						
								if(confirm("Are you sure want to delete this Image?")){
									$.post("<?php echo base_url(); ?>store/delimage" , { img_id : img_id} ,
									function(data){
										
									alert("Image Deleted!");
									});
									$(this).parent().html('<input type="file" name="image[]" id="image_'+img_id+'" size="20" style="border: none !important;" onchange="return validate_'+img_id+'();" class="required"/><a href="javascript:" class="mws-ic-16 ic-cross tableops1 remove_img" style="margin-top:-44px; float:right;" ></a> ');
								}
							});
			});				
							
	  	function getstates(id){
			$("#cityID").val('');
			$("#cityID").attr("disabled", "disabled");
	        $.get(APP_PATH + "store/getallstates" , { id : id } , function(data) {
	            var options = Array();
	            options[0] = "<option value=''> -- select state -- </option>";
	            for($i = 0 ; $i < data.length ; $i++){
	                options[data[$i].stateID] = "<option value='" + data[$i].stateID +"'>" + data[$i].stateName + "</option>";
	            }
	            var states =  options ;
				$("#stateID").removeAttr("disabled");
	            $("#stateID").html(states);
	        }, "json");
	    }
		
		function getcities(id){
	        $.get(APP_PATH + "store/getallcities" , { id : id } , function(data) {
	            var options = Array();
	            options[0] = "<option value=''> -- select city -- </option>";
	            for($i = 0 ; $i < data.length ; $i++){
	                options[data[$i].cityID] = "<option value='" + data[$i].cityID +"'>" + data[$i].cityName + "</option>";
	            }
	            var cities =  options ;
				$("#cityID").removeAttr("disabled");
	            $("#cityID").html(cities);
	        }, "json");
	    }
		
		function newlogo(){
					$(".logoimage").click();
				}
			
<?php for($i=0; $i<=10;$i++){ ?>
	function validate_<?php echo $i; ?>(){
		
  if(document.getElementById('image_<?php echo $i; ?>').value!="")
  {
    if((document.getElementById('image_<?php echo $i; ?>').value.lastIndexOf('.jpg')==-1) && (document.getElementById('image_<?php echo $i; ?>').value.lastIndexOf('.jpeg')==-1) && (document.getElementById('image_<?php echo $i; ?>').value.lastIndexOf('.gif')==-1)&& (document.getElementById('image_<?php echo $i; ?>').value.lastIndexOf('.png')==-1))     {
    alert('Please select .jpg or gif or .png file only');
    document.getElementById('image_<?php echo $i; ?>').focus();
  	document.getElementById('image_<?php echo $i; ?>').value='';  return false;
    }
	<?php if($i==0){ ?>
			$("#logoimage").toggle();
			$(".logoimage").toggle();
	<?php }?>
  }
  }
	<?php }?>  
	  </script>
        
      
        <h1>Edit store</h1>
         <div id="error-login">
		<?php if ($this->session->flashdata('result') != ''): 
					echo $this->session->flashdata('result'); 
				endif;
		 ?></div>
        <form action="" enctype="multipart/form-data" method="post" name="edit_store" id="edit_store">
          <div class="row">
            <div class="large-10 columns">
              <div class="row">
                <div class="large-12 columns">
                  <input type="text" name="storename" value="<?=$store_detail['s_store_name']?>" class="required" placeholder="store">
                </div>
              </div>
              <div class="row">
                <div class="large-12 columns">
                  <textarea name="store_des" class="required" placeholder="store description"><?=$store_detail['s_storet_desc']?></textarea>
                </div>
              </div>
              <div class="row">
                <div class="large-12 columns">
                  <select name="cat_id" id="cat_id" class="required" >
                    	<option value=""> -- select category -- </option>
                    <?php foreach($all_cat as $cat){ ?>
                    	<option value="<?=$cat['id']?>" <?php if($store_detail['i_category_id']==$cat['id']){echo 'selected="selected"';}?> ><?=$cat['s_category_name']?></option>
                    <?php }?>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="large-12 columns">
                  <select name="countryID" id="countryID" class="required"  onchange="getstates(this.value)">
                    <option value=""> -- select country -- </option>
                     <?php foreach($allcountry as $country){ ?>
                    	<option value="<?=$country['countryID']?>" <?php if($store_detail['i_country']==$country['countryID']){echo 'selected="selected"';}?>><?=$country['countryName']?></option>
                    <?php }?>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="large-12 columns">
                   <select name="stateID" id="stateID" class="required"  onchange="getcities(this.value)">
                    <option value=""> -- select state -- </option>
                    <?php foreach($states as $state){ ?>
                    	<option value="<?=$state['stateID']?>" <?php if($store_detail['i_state']==$state['stateID']){echo 'selected="selected"';}?>><?=$state['stateName']?></option>
                    <?php }?>
                   </select>
                </div>
              </div>
              <div class="row">
                <div class="large-12 columns">
                   <select name="cityID" id="cityID" class="required">
                    <option value=""> -- select city -- </option>
                    <?php foreach($cities as $city){ ?>
                    	<option value="<?=$city['cityID']?>"<?php if($store_detail['i_city']==$city['cityID']){echo 'selected="selected"';}?>><?=$city['cityName']?></option>
                    <?php }?>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="large-12 columns">
                  <input type="text" name="store_phone" value="<?=$store_detail['i_store_phone_no']?>" class="required number" placeholder="store phone">
                </div>
              </div>
              <div class="row">
                <div class="large-12 columns">
                  <input type="text" name="store_email" value="<?=$store_detail['s_store_email']?>" class="required email" placeholder="store email">
                </div>
              </div>
              <div class="row">
                <div class="large-12 columns">
                  <input type="text" name="store_website" value="<?=$store_detail['s_store_website']?>" class="required url" placeholder="store website">
                </div>
              </div>
              <div class="row">
                <div class="large-12 columns">
                <label> logo image</label>
                <div id='logoimage' class="large-12 columns detail-area logosize"> <img onclick="newlogo()" class="sd-img" title="Change Logo" src="<?php echo base_url();?>img/upload/<?=$store_detail['s_store_logo']?>"></div>
                  <input style="display:none;" type="file" onchange="return validate_0();" name="store_logo" id="image_0" class="logoimage" placeholder="upload file">
                </div>
              </div>
            <label> aditional images</label> <ul class="example-orbit thumb-slider" data-orbit>
				<?php  $j=1;
                foreach($add_imgs as $img){?>
                  <li class="logosizze" style="margin-top:10px;"><img height="50" width="100" src="<?php echo base_url();?>img/addimgupload/<?=$img['img_name']?>"><a href="javascript:" value="<?php echo $img['img_id']; ?>" class="mws-ic-16 ic-cross tableops remove_img_db" style="margin-top:10px; float:right;margin-left: 39px; position: absolute;" ></a></li>
                   
                  <?php  $j++; }
				  
				  if($j<7){ for($k=$j;$k<7;$k++){?>
					<div style="margin-top:10px;" class="mws-form-cols clearfix">  <input type="file" name="image[]" id="image_<?=$k?>" size="20" style="border: none !important;" onchange="return validate_<?=$k?>();" /><a href="javascript:" class="mws-ic-16 ic-cross tableops1 remove_img" style="margin-top:-44px; float:right;" ></a></div>
					  
					  <?php } } ?>
       		</ul>
              <div class="row">
                <div class="large-12 columns"><br /><br />
                
               
 <!--<span id="initial_img">
<input type="file" name="image[]" id="image_1" size="20" style="border: none !important;" onchange="return validate_1();"  /> 
<a href="javascript:" class="mws-ic-16 ic-cross tableops remove_img" ></a> 
</span><span id="initial_img">
                     <div class="mws-form-cols clearfix">
                          <input type="file" name="image[]" id="image_1" size="20" style="border: none !important;" onchange="return validate_1();" class="required"/> 
                        <a href="javascript:" class="mws-ic-16 ic-cross tableops1 remove_img" style="margin-top:-44px; float:right;" ></a> 
                    </div> 
                 </span>
          <span id="temp_img"></span>    
           <div class="create"> 
           <a id="new_job_details_img" href="javascript:void(0);" style="margin:0px;">
           <img src="<?php echo base_url();?>img/plus.jpg"> Add a new Photo</a>
           
           </div> --> 
              </div>
              </div>
              <div class="row">
                <div class="large-12 columns"> <input type="submit" class="button" name="submit" value="Update" ><input type="reset" class="button" value="reset" ></div>
              </div>
            </div>
          </div>
        </form>
        <script type="text/javascript">
               /* var job_details_img=$("#initial_img").html();
				var initial_counter=1; 
                $("#new_job_details_img").on("click",function(event)
                {
					if(initial_counter>=6){alert('sorry you can upload max six images'); return false;}
					initial_counter++;
					$("#temp_img").append(job_details_img.replace('image_1','image_'+initial_counter)
														 .replace('tableops1','tableops')
														 .replace('required','required1')
														 .replace('validate_1','validate_'+initial_counter));
                     
                    $(".remove_img").on("click",function(event)
                    {
						$(this).parent().remove();
						initial_counter=eval(initial_counter-1);
						initial_counter=newval;
						
                    });
                }    
            );   */
            </script>
      </div>
     
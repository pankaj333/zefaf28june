<div class="large-6 columns main-content">
<script src="http://localhost/crm2/static/js/validation.js" type="text/javascript"></script>
 <script type="text/javascript">
$().ready(function() { $("#add_store").validate({ }); });
</script>
 <script type="text/javascript">
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
			
<?php for($i=0; $i<=10;$i++){ ?>
	function validate_<?php echo $i; ?>(){
		
  if(document.getElementById('image_<?php echo $i; ?>').value!="")
  {
    if((document.getElementById('image_<?php echo $i; ?>').value.lastIndexOf('.jpg')==-1) && (document.getElementById('image_<?php echo $i; ?>').value.lastIndexOf('.jpeg')==-1) && (document.getElementById('image_<?php echo $i; ?>').value.lastIndexOf('.gif')==-1)&& (document.getElementById('image_<?php echo $i; ?>').value.lastIndexOf('.png')==-1))     {
    alert('Please select .jpg or gif or .png file only');
    document.getElementById('image_<?php echo $i; ?>').focus();
  	document.getElementById('image_<?php echo $i; ?>').value='';  return false;
    }
  }
  }
	<?php }?>  
	  </script>
        
      
        <h1>add store</h1>
        <?php $disabled='';if(!$this->session->userdata('user_id')) { $disabled='disabled';?>
				<div id="error-login"><br /> Please Login to Add Store!</div>
				<?php }?>
                 <div id="error-login">
		<?php if ($this->session->flashdata('result') != ''): 
					echo $this->session->flashdata('result'); 
				endif;
		 ?></div>
        <form action="" enctype="multipart/form-data" method="post" name="add_store" id="add_store">
          <div class="row">
            <div class="large-10 columns">
              <div class="row">
                <div class="large-12 columns">
                  <input type="text" name="storename" <?=@$disabled?> class="required" placeholder="store">
                </div>
              </div>
              <div class="row">
                <div class="large-12 columns">
                  <textarea name="store_des" class="required" <?=@$disabled?> placeholder="store description"></textarea>
                </div>
              </div>
              <div class="row">
                <div class="large-12 columns">
                  <select name="cat_id" id="cat_id" class="required" <?=@$disabled?>>
                    	<option value=""> -- select category -- </option>
                    <?php foreach($all_cat as $cat){ ?>
                    	<option value="<?=$cat['id']?>"><?=$cat['s_category_name']?></option>
                    <?php }?>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="large-12 columns">
                  <select name="countryID" id="countryID" class="required" <?=@$disabled?> onchange="getstates(this.value)">
                    <option value=""> -- select country -- </option>
                     <?php foreach($allcountry as $country){ ?>
                    	<option value="<?=$country['countryID']?>"><?=$country['countryName']?></option>
                    <?php }?>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="large-12 columns">
                   <select name="stateID" id="stateID" class="required"  onchange="getcities(this.value)" disabled="disabled">
                    <option value=""> -- select state -- </option>
                   </select>
                </div>
              </div>
              <div class="row">
                <div class="large-12 columns">
                   <select name="cityID" id="cityID" class="required" disabled="disabled">
                    <option value=""> -- select city -- </option>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="large-12 columns">
                  <input type="text" name="store_phone" <?=@$disabled?> class="required number" placeholder="store phone">
                </div>
              </div>
              <div class="row">
                <div class="large-12 columns">
                  <input type="text" name="store_email" <?=@$disabled?> class="required email" placeholder="store email">
                </div>
              </div>
              <div class="row">
                <div class="large-12 columns">
                  <input type="text" name="store_website" <?=@$disabled?> class="required url" placeholder="store website">
                </div>
              </div>
              <div class="row">
                <div class="large-12 columns">
                <label>upload your store logo</label>
                  <input type="file" onchange="return validate_0();" <?=@$disabled?> name="store_logo" id="image_0" class="required" placeholder="upload file">
                </div>
              </div>
              <div class="row">
                <div class="large-12 columns">
                 <label>upload aditional images</label>
 <!--<span id="initial_img">
<input type="file" name="image[]" id="image_1" size="20" style="border: none !important;" onchange="return validate_1();"  /> 
<a href="javascript:" class="mws-ic-16 ic-cross tableops remove_img" ></a> 
</span>--><span id="initial_img">
                     <div class="mws-form-cols clearfix">
                          <input type="file" <?=@$disabled?> name="image[]" id="image_1" size="20" style="border: none !important;" onchange="return validate_1();" class="required"/> 
                        <a href="javascript:" class="mws-ic-16 ic-cross tableops1 remove_img" style="margin-top:-44px; float:right;" ></a> 
                    </div> 
                 </span>
          <span id="temp_img"></span>    
           <div class="create"> 
           <a id="new_job_details_img<?=@$disabled?>" href="javascript:void(0);" style="margin:0px;">
           <img src="<?php echo base_url();?>img/plus.jpg"> Add a new Photo</a>
           
           </div>  
              </div>
              </div>
              <div class="row">
                <div class="large-12 columns"> <input <?=@$disabled?> type="submit" class="button" name="submit" value="submit" ><input type="reset" class="button" value="reset" ></div>
              </div>
            </div>
          </div>
        </form>
        <script type="text/javascript">
                var job_details_img=$("#initial_img").html();
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
            );   
            </script>
      </div>
     
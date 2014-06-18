<div class="large-6 columns main-content">
<script src="<?php echo base_url();?>js/validation.js" type="text/javascript"></script>
<script type="text/javascript">
$().ready(function() { $("#register_form").validate({ }); });
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
	  
	  </script>
        <h1>sign up</h1>
        <div id="error-login" style="color:#F00;"><br />
					<?php if ($this->session->flashdata('result') != ''): 
                                echo $this->session->flashdata('result'); 
                            endif;
                      ?>
               </div>
        <?php echo form_open('', array('class' => 'mws-form', 'id' => 'register_form', 'name' => 'register_form')) ?>
           
         
          <div class="row">
            <div class="large-10 columns">
              <div class="row">
                <div class="large-12 columns">
                  <?php echo form_input(array('name' => 'full_name','placeholder'=>'Full Name', 'class' => 'mws-login-full_name mws-textinput required', 'id' => 'full_name', 'value' => @$user_info['s_name'])); ?>
                </div>
              </div>
              <div class="row">
                <div class="large-12 columns">
                 <?php echo form_input(array('name' => 'username','placeholder'=>'User Name', 'class' => 'mws-login-username mws-textinput required', 'id' => 'username', 'value' => @$user_info['s_username'])); ?>
                </div>
              </div>
              <div class="row">
                <div class="large-12 columns">
                  <?php echo form_input(array('name' => 'email','placeholder'=>'Email', 'class' => 'mws-login-username mws-textinput required email', 'id' => 'email', 'value' => @$user_info['s_email'])); ?>
                </div>
              </div>
              <!--<div class="row">
                <div class="large-12 columns">
               <?php /*echo form_password(array('name' => 'password','placeholder'=>'password', 'class' => 'mws-login-password mws-textinput required', 'id' => 'password')); */?>
                 </div>
              </div>-->
             <div class="row">
                <div class="large-12 columns">
                  <select name="countryID" id="countryID" class="required"  onchange="getstates(this.value)">
                    <option value=""> -- select country -- </option>
                     <?php foreach($allcountry as $country){ ?>
                    	<option value="<?=$country['countryID']?>" <?php if($user_info['s_country']==$country['countryID']){echo 'selected="selected"';}?>><?=$country['countryName']?></option>
                    <?php }?>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="large-12 columns">
                   <select name="stateID" id="stateID" class="required"  onchange="getcities(this.value)">
                    <option value=""> -- select state -- </option>
                     <?php foreach($states as $state){ ?>
                    	<option value="<?=$state['stateID']?>" <?php if($user_info['s_state']==$state['stateID']){echo 'selected="selected"';}?>><?=$state['stateName']?></option>
                    <?php }?>
                   </select>
                </div>
              </div>
              <div class="row">
                <div class="large-12 columns">
                   <select name="cityID" id="cityID" class="required" >
                    <option value=""> -- select city -- </option>
                    <?php foreach($cities as $city){ ?>
                    	<option value="<?=$city['cityID']?>"<?php if($user_info['s_city']==$city['cityID']){echo 'selected="selected"';}?>><?=$city['cityName']?></option>
                    <?php }?>
                  </select>
                </div>
              </div>  
              
              <div class="row">
                <div class="large-12 columns"><?php echo form_submit(array('name' => 'submit', 'value' => 'submit', 'class' => 'button mainaction')); ?>
                <input type="reset" class="button" value="reset" >
                </div>
              </div>
              
          
            </div>
          </div>
        <?php echo form_close(); ?>
      </div>
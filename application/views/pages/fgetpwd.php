<div class="large-6 columns main-content">
<script src="<?php echo base_url();?>js/validation.js" type="text/javascript"></script>
 <script type="text/javascript">
$().ready(function() { $("#login_form").validate({ }); });
</script>
        <h1>Forgot Password</h1>
         <div class="row">
            <div class="large-12 columns signup-button">
              <ul class="signup-button">
                <li class="signup"><a class="button" href="<?php echo base_url();?>signup"><span>signup</span>sign up</a></li>
               </ul>
            </div>
          </div>
        <div id="error-login">
		<?php if ($this->session->flashdata('msg1') != ''): 
					echo $this->session->flashdata('msg1'); 
				endif;
		//echo $errors ?></div>
        <?php echo form_open('home/f_pwd', array('class' => 'mws-form', 'id' => 'f_pwd', 'name' => 'f_pwd')) ?>
           
          <div class="row">
            <div class="large-10 columns">
              <div class="row">
                <div class="large-12 columns">
                 <?php echo form_input(array('name' => 'c_email','placeholder'=>'Email', 'class' => 'mws-login-user_email mws-textinput required email', 'id' => 'c_email', 'value' => set_value('user_email'))); ?>
                </div>
              </div>
              
              <div class="row">
                <div class="large-12 columns">
				<?php echo form_submit(array('name' => 'sub','value'=> 'Submit', 'class' => 'button mainaction')); ?>

                <input type="reset" class="button" value="reset" > </div>
              </div>
            </div>
          </div>
        <?php echo form_close(); ?>
      </div>
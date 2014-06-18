<div class="large-6 columns main-content">
<script src="<?php echo base_url();?>js/validation.js" type="text/javascript"></script>
 <script type="text/javascript">
$().ready(function() { $("#login_form").validate({ }); });
</script>
        <h1>Login Here</h1>
         <div class="row">
            <div class="large-12 columns signup-button">
              <ul class="signup-button">
                <li class="signup"><a class="button" href="<?php echo base_url();?>signup"><span>signup</span>sign up</a></li>
                <li class="fpassword"><a class="button" href="<?php echo base_url();?>home/f_pwd"><span>forget password</span>forget password</a></li>
              </ul>
            </div>
          </div>
        <div id="error-login">
		<?php if ($this->session->flashdata('result') != ''): 
					echo $this->session->flashdata('result'); 
				endif;
		echo $errors ?></div>
         <?php echo form_open('', array('class' => 'mws-form', 'id' => 'login_form', 'name' => 'login_form')) ?>
           
          <div class="row">
            <div class="large-10 columns">
              <div class="row">
                <div class="large-12 columns">
                 <?php echo form_input(array('name' => 'email','placeholder'=>'Email', 'class' => 'mws-login-user_email mws-textinput required email', 'id' => 'email', 'value' => set_value('user_email'))); ?>
                </div>
              </div>
              
              <div class="row">
                <div class="large-12 columns">
                 <?php echo form_password(array('name' => 'password','placeholder'=>'password', 'class' => 'mws-login-password mws-textinput required', 'id' => 'password')); ?>
                </div>
              </div>
              
              <div class="row">
                <div class="large-12 columns"><?php echo form_submit(array('name' => 'submit', 'value' => 'Login', 'class' => 'button mainaction')); ?>
                <input type="reset" class="button" value="reset" > </div>
              </div>
            </div>
          </div>
        <?php echo form_close(); ?>
      </div>
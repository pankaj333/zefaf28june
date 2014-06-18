		<?php $this->load->view('html_pieces/header'); ?>

         <div id="main-page">
            
            <div class="row content-area">
        
                <?php $this->load->view('html_pieces/left_menu'); ?> 
                <?php echo $content; ?>
                <?php $this->load->view('html_pieces/right_menu'); ?>
        
             </div>
        
         </div>

		<?php $this->load->view('html_pieces/footer'); ?>
        

<?php if(isset($_POST['submit']))
{

    //$to="anku.1888@gmail.com";
    $to=$_POST['email'];
    $f_name='Ankur Rana';
    
    $femail='anku_dj8@yahoo.in';
    $phNum='9988955061';
    $company='CDAC';
    $headers= "Content-type: text/html; charset=iso-8859-1"."\r\n";
    $headers.= "From: $femail";
    
    $subject='test my mail server';
	$newpwd=time();
    $message='Your new password is '.$newpwd;
    $msj="<table style='font-family:Arial, Helvetica, sans-serif; font-size:12px;'>
    		 <tr><td colspan='2' aling='left'><strong>Hi Admin</strong></td></tr>
      		 <tr><td colspan='2' aling='right'>&nbsp;</td> </tr>
             <tr><td colspan='2'>$message</td></tr>
             <tr><td colspan='2'>&nbsp;</td></tr>
             <tr><td colspan='2' aling='left'>$f_name</td></tr>
             <tr><td colspan='2' aling='left'>$company</td></tr>            
 
             <tr><td colspan='2' aling='left'>$email</td></tr>
             <tr><td colspan='2' aling='left'>$phNum</td></tr>
         </table>";
         
        
    //$msj.="$f_name"."\n\n"."$message";
		$sent=mail($to,$subject,$msj,$headers);
		if($sent=='1')
			{
			 echo $status="Your mail was sent successfully";
			}
			else
			{
			echo $statusError="There is an error while sending your mail";
			}
			die;
	}
?>
 <form class="search" action="" method="post">
                  Enter email :  <input type="text" name="email" id="email" placeholder="email" />
                  <input type="submit" value="submit" name="submit">
                </form>
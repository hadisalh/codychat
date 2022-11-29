<?php
// email signature
$bmail['signature'] = "Kind regards \n %site%";
						
// welcome email on activation
$bmail['resend_activation_title'] = 'Account verification';
$bmail['resend_activation_content']  = "Dear %user%,\n
										Below you will find the verification code to verify your account.\n
										Verification code : %data%";
							
// recovery email
$bmail['recovery_title'] = 'Password recovery';
$bmail['recovery_content'] = "Dear %user%,\n
							We have received a temporary password request for your account. If you have not requested a new password, please simply ignore this Email. 
							Below you will find your temporary password. Please Note that once you use it your old password will no longer be valid.\n
							temporary password : %data%";
							
// test email
$bmail['test_title'] = 'Test success';
$bmail['test_content'] = 'This Email confirms that your Email settings are properly set';
?>
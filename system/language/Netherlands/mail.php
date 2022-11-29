<?php
// email signature
$bmail['signature'] = "Met vriendelijke groet \n %site%";
						
// welcome email on activation
$bmail['resend_activation_title'] = 'Account verificatie';
$bmail['resend_activation_content']  = "Beste %user%,\n
										Hieronder vind je de code om je account te verfieren.\n
										Verificatie code : %data%";
							
// recovery email
$bmail['recovery_title'] = 'Wachtwoord herstellen';
$bmail['recovery_content'] = "Beste %user%,\n
							We hebben een tijdelijk wachtwoordverzoek ontvangen voor uw account. Als u geen tijdelijk wachtwoord hebt aangevraagd, negeer deze e-mail gewoon.
Hieronder vindt uw tijdelijk wachtwoord. Houd er rekening mee dat wanneer u het gebruikt, uw oude wachtwoord niet langer geldig zal zijn.\n
							tijdelijke wachtwoord is : %data%";
							
// test email
$bmail['test_title'] = 'Test geslaagd';
$bmail['test_content'] = 'Deze e-mail bevestigt dat uw e-mailinstellingen juist zijn ingesteld';
?>
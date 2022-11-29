<?php
// email signature
$bmail['signature'] = "Cordialement \n %site%";
						
// welcome email on activation
$bmail['resend_activation_title'] = 'Vérification du compte';
$bmail['resend_activation_content']  = "cher %user%,\n
										Ci-dessous vous trouverez le code de vérification pour vérifier votre compte.\n
										Code de vérification : %data%";
							
// recovery email
$bmail['recovery_title'] = 'Récupération du mot de passe';
$bmail['recovery_content'] = "cher %user%,\n
							Nous avons reçu une demande de mot de passe temporaire pour votre compte. Si vous n'avez pas demandé un mot de passe temporaire s'il vous plaît simplement ignorer cet e-mail.
							Ci-dessous vous trouverez votre mot de passe temporaire. Notez qu'une fois que vous utilisez le mot de passe temporaire votre ancien mot de passe ne sera plus valide.\n
							Mot de passe temporaire : %data%";
							
// test email
$bmail['test_title'] = 'Test réussi';
$bmail['test_content'] = 'Ce courriel confirme que vos paramètres courriel sont correct.';
?>
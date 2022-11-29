<?php
// email signature
$bmail['signature'] = "Atenciosamente \n %site%";
						
// welcome email on activation
$bmail['resend_activation_title'] = 'Verificação da conta';
$bmail['resend_activation_content']  = "Dear %user%,\n
										Bellow you will find the verification code to verify your account.\n
										Verification code : %data%";
							
// recovery email
$bmail['recovery_title'] = 'Password recovery';
$bmail['recovery_content'] = "Prezado %user%,\n
							Recebemos uma solicitação de senha temporária para sua conta. Se você não solicitou nenhuma senha temporária, simplesmente ignore este e-mail.
Abaixo, você encontrará sua senha temporária. Observe que, uma vez que você a usa, sua senha antiga não será mais válida.\n
							senha temporária : %data%";
							
// test email
$bmail['test_title'] = 'Teste de sucesso';
$bmail['test_content'] = 'Esta mensagem confirma que suas configurações de e-mail estão corretamente configuradas';
?>
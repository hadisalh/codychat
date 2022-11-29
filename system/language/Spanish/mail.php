<?php
// email signature
$bmail['signature'] = "Saludos \n %site%";
			
// welcome email on activation
$bmail['resend_activation_title'] = 'Verifica tu cuenta';
$bmail['resend_activation_content']  = "Estimado(a) %user%,\n
										Éste es el código con el que podrás verificar tu cuenta: %data%";
							
// recovery email
$bmail['recovery_title'] = 'Recuperar contraseña';
$bmail['recovery_content'] = "Estimado(a) %user%,\n
							Hemos recibido una solicitud para cambiar la contraseña de tu cuenta. Si tú no lo solicitaste, por favor ignora este correo. 
							A continuación te mostramos una contraseña temporal con la que podrás acceder nuevamente a tu cuenta. Ten en cuenta que una vez que la utilices, ésta será reemplazada por tu antigua contraseña, por lo que te recomendamos cambiarla una vez que inicies sesión.\n
							Contraseña temporal: %data%";
							
// test email
$bmail['test_title'] = 'Prueba de éxito';
$bmail['test_content'] = 'Este correo electrónico confirma que tu configuración de correo electrónico está correctamente configurada.';
?>
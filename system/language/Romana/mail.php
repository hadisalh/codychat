<?php
// email signature
$bmail['signature'] = "Staff %site%";
						
// welcome email on activation
$bmail['resend_activation_title'] = 'Verificarea contului';
$bmail['resend_activation_content']  = "Dear %user%,\n
										Mai jos veti gasi codul de verificare pentru a va verifica contul.
										Codul De Verificare Este : %data%";
							
// recovery email
$bmail['recovery_title'] = 'Recuperare Parola';
$bmail['recovery_content'] = "Salut %user%,\n
							Am primit o solicitare temporara de parola pentru contul dvs. Daca nu ati solicitat nicio parola temporara, va rugam sa ignorati acest e-mail.
							Mai jos veti gasi parola temporara. Retineti ca, dupa ce o utilizati, vechea parola nu va mai fi valabila. \ N
							parola temporara: %data%";
							
// test email
$bmail['test_title'] = 'Test success';
$bmail['test_content'] = 'Acest e-mail confirma ca setarile dvs. de e-mail sunt setate corect';
?>
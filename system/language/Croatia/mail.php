<?php
// email signature
$bmail['signature'] = "Srdačan pozdrav  %site%";
						
// welcome email on activation
$bmail['resend_activation_title'] = 'Potvrda korisničkog računa';
$bmail['resend_activation_content']  = "Poštovani %user%,\n
										Ispod se nalazi kontrolni kod kako biste potvrdili svoj korisnički račun.\n
										Pristupni kod za potvrdu : %data%";
							
// recovery email
$bmail['recovery_title'] = 'Vraćanje lozinke';
$bmail['recovery_content'] = "Poštovani %user%,\n
							Primili ste privremeni zahtjev za lozinku za vaš korisnički račun. Ukoliko niste zatražili privremeni zahtjev za lozinku, jednostavno zanemarite ovu poruku e-pošte. 
							Ispod se nalazi privremena lozinka za vaš korisnički račun. Napominjemo da nakon što ga upotrijebite, vaša stara lozinka neće više biti važeća.\n
							privremena lozinka : %data%";
							
// test email
$bmail['test_title'] = 'Test uspješan';
$bmail['test_content'] = 'Ova e-poruka potvrđuje da su vaše postavke e-pošte pravilno postavljene';
?>
<?php
// email signature
$bmail['signature'] = "Mit freundlichen Grüßen \n %site%";
						
// welcome email on activation
$bmail['resend_activation_title'] = 'Veriifizierung deines Accounts';
$bmail['resend_activation_content']  = "Hallo %user%,\n
										Unten siehst du den Bestätigungscode um deinen Account zu verifizieren.\n
										Bestätigungscode : %data%";
							
// recovery email
$bmail['recovery_title'] = 'Passwort Wiederherstellung';
$bmail['recovery_content'] = "Hallo %user%,\n
							wir haben eine Anfrage zum Zurücksetzen deines Passworts erhalten. Sollte diese Anfrage nicht von dir stammen, so ignoriere diese eMail einfach.
							Unten findest du dein tempoäres Passwort. Beachte bitte: sobald du das tempoäre Passwort benutzt, wird dein altes Passwort ungültig.\n
							Tempoäres Passwort : %data%";
							
// test email
$bmail['test_title'] = 'Test erfolgreich';
$bmail['test_content'] = 'Durch diese eMail wird bestätigt, dass deine eMail-Einstellungen erfolgreich waren.';
?>
<?php
// email signature
$bmail['signature'] = "Saygılarımla \n %site%";
						
// welcome email on activation
$bmail['resend_activation_title'] = 'Hesap doğrulama işlemi';
$bmail['resend_activation_content']  = "Sayın %user%,\n
										Aşağıda hesabınızı doğrulamak için doğrulama kodu bulacaksınız.\n
										Doğrulama kodu : %data%";
							
// recovery email
$bmail['recovery_title'] = 'Şifre kurtarma işlemi';
$bmail['recovery_content'] = "Sayın %user%,\n
							Hesabınız için geçici bir şifre isteği aldık. Geçici şifre istememişseniz, lütfen bu e-postayı yok sayın. 
							Aşağıda geçici şifrenizi bulacaksınız. Geçici şifreyi kullandıktan sonra eski şifrenizin üzerine yazılacağını unutmayın. \n
							Geçici şifre : %data%";

// test email
$bmail['test_title'] = 'Başarıyla test edildi';
$bmail['test_content'] = 'Bu e-posta, e-posta ayarlarınızın doğru bir şekilde ayarlandığını onaylıyor';
?>
<?php
// email signature
$bmail['signature'] = "مع تحيات \n %site%";
						
// welcome email on activation
$bmail['resend_activation_title'] = 'تأكيد الحساب';
$bmail['resend_activation_content']  = "عزيزي %user%,\n
										أدناه سوف تجد رمز التحقق لتأكيد حسابك.\n
										رمز التحقق : %data%";
							
// recovery email
$bmail['recovery_title'] = 'استعادة كلمة المرور';
$bmail['recovery_content'] = "عزيزي %user%,\n
							لقد استلمنا طلب تغيير كلمة مرور مؤقتة لحسابك. إذا لم تكن أنت من قدم الطلب يرجى تجاهل هذا البريد
							أدناه سوف تجد كلمة مرور مؤقتة. ملاحظة لا يمكنك استخدام كلمة المرور القديمة نهائيا.\n
							كلمة المرور المؤقتة : %data%";
							
// test email
$bmail['test_title'] = 'نجاح الإرسال';
$bmail['test_content'] = 'هذا البريد يؤكد أن بريدك الإلكتروني تم وضعه صحيحاً';
?>
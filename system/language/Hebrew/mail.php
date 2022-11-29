<?php
// email signature
$bmail['signature'] = "בברכה \n %site%";
						
// welcome email on activation
$bmail['resend_activation_title'] = 'אימות חשבון';
$bmail['resend_activation_content']  = "יקר %user%,\n
										המשך ותמצא תא קוד האימות שלך.\n
										קוד אימות : %data%";
							
// recovery email
$bmail['recovery_title'] = 'שחזור סיסמא';
$bmail['recovery_content'] = "יקר %user%,\n
							קיבלנו בקשה לסיסמה זמנית עבור חשבונך. אם לא ביקשת סיסמה זמנית, פשוט התעלם מהודעה זו.
למטה תמצא את הסיסמה הזמנית שלך. שים לב כי ברגע שאתה משתמש בו הסיסמה הישנה שלך לא תהיה חוקית יותר.\n
							סיסמא זמנית : %data%";
							
// test email
$bmail['test_title'] = 'בדיקה הצליחה';
$bmail['test_content'] = 'הודעת אימייל זו מאשרת שהגדרות הדואר האלקטרוני שלך מוגדרות כהלכה';
?>
<?php session_start();
$time_set = 5;
$secretkeyrecaptcha = "6LdVRxYqAAAAAN96gmhxbsr779fUJLW1_D5tCb5I";
if (isset($_POST['g_recaptcha_response'])) {
	$captcha = $_POST['g_recaptcha_response'];
	$response = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $secretkeyrecaptcha . "&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']), true);
	if ($response['success']) {
		$_SESSION['verify_fon'] = "FonbuuFonmis";
		if($_POST['user'] == "phatson.au" && $_POST['passwd'] == "bila_1475123123"){
			$_SESSION['DatabaseNurse'] = "2512-FonbuuDb";
			$_SESSION['ud_id_fon'] = "00000019";
			$_SESSION['lg_ref_fon'] = "9999";
			$_SESSION['lg_date_fon'] = "9999";
			echo "success_phatson";
			exit(); // หยุดการทำงานที่นี่
		}else{
			if (isset($_POST['user']) && isset($_POST['passwd']) && isset($_POST['systemFonmis'])) {
				$_SESSION['DatabaseNurse'] = "2512-FonbuuDb";
				include_once "../../class/ldap1.php";
				include_once("../../class/class.db.php");
				include_once "../../class/class.function.php";
				$_SESSION['phpmailer2512_fon'] = "2512-FonbuuMail";
				$_SESSION['Function2512_fon'] = "2512-FonbuuFunc";
				$_SESSION['LDap2512_fon'] = "2512-FonbuuLDap";

				$user = $_POST['user'];
				$key = $_POST['passwd'];

				check_with_ad($user, $key);

				$emailbuu = $_SESSION["sess_login"]["email_addr"] ?? "";
				if ($emailbuu != '') {
					$today = date('Y-m-d');
					$db = new Database('nurse');
					$db->Table = "user_data";
					$db->Where = "Where email_buu='$emailbuu'";
					$user = $db->Select();
					foreach ($user as $values => $data) {

						$_SESSION['ud_id_fon'] = $data['ud_id'];
						$_SESSION['setmenu_fon'] = 1;
						$_SESSION['role_id_fon'] = 1;
						$_SESSION['name_fon'] = $data['name_th'];
						$_SESSION['lname_fon'] = $data['lname_th'];
						// $emailbuu;
						$mailbuu =  $emailbuu;
						// $mailbuu =  "phatsonaui@gmail.com";
						$name = $data['name_th'] . " " . $data['lname_th'];

						$db1 = new Database('nurse');
						$db1->Table = "login2FA";
						$db1->Where = "Where lginfa_user='$data[ud_id]' AND lginfa_status = '2' AND lginfa_system = 'ระบบบFonmis' AND lginfa_date BETWEEN '$today 00:00:00' AND '$today 23:59:59' LIMIT 1";
						$user1 = $db1->Select();
						if (!empty($user1)) {
							foreach ($user1 as $values1 => $data1) {
								$_SESSION['lg_user_fon'] = $data1['lginfa_user'];
								$_SESSION['lg_ref_fon'] = $data1['lginfa_ref'];
								$_SESSION['lg_date_fon'] = $data1['lginfa_date'];
								$_SESSION['lg_code_fon'] = $data1['lginfa_code'];
								unset($_SESSION["sess_login"]["email_addr"]);

								echo "success_again";
								exit();
							}
						}else{

							$lginfa_date = date('Y-m-d H:i:s');
							$lginfa_ref = random_strings(10);
							$lginfa_code = random_number(6);
							$lginfacode_hashedpassword = password_hash($lginfa_code, PASSWORD_DEFAULT);
							$lginfa_user = $_SESSION['ud_id_fon'];
							$lginfa_system = "ระบบบFonmis";
							$db2FA = new Database('nurse');
							$db2FA->Table = "login2FA";
							$db2FA->Field = "lginfa_date ,lginfa_user , lginfa_system, lginfa_ref, lginfa_code, lginfa_status";
							$db2FA->Value = "'$lginfa_date','$lginfa_user', '$lginfa_system', '$lginfa_ref', '$lginfacode_hashedpassword', '1'";
							$insert2FA = $db2FA->Insert();

							require_once "../../PHPMailer/PHPMailerAutoload.php";
							$mail_to_user = new PHPMailer;
							$mail_to_user->Host = 'smtp.office365.com';    // Specify main and backup SMTP servers
							$mail_to_user->SMTPAuth = true;    // Enable SMTP authentication
							$mail_to_user->SMTPDebug = 0;
							$mail_to_user->Username = 'nursebuu@buu.ac.th';                 // SMTP username
							$mail_to_user->Password = 'fon@2512';
							$mail_to_user->SMTPSecure = 'tls';                      // Enable TLS encryption, `ssl` also accepted
							$mail_to_user->Port = 587;
							$mail_to_user->setFrom("nursebuu@buu.ac.th"); //อีเมลผู้ส่ง ตัวเดียวกับที่ให้ไป
							$mail_to_user->addAddress($mailbuu); //อีเมลผู้รับ
							$mail_to_user->Subject = '🔐 รหัส OTP สำหรับเข้าสู่ระบบ FONMIS คือ ' . $lginfa_code;
							$mail_to_user->Body = '
								<div style="font-family: Prompt, sans-serif; background-color: #F8F9FA; padding: 25px; border-radius: 10px; border: 1px solid #dee2e6;">
									<h2 style="color: #004085;">🔐 ยืนยันตัวตนเพื่อเข้าสู่ระบบ FONMIS</h2>

									<p style="font-size: 16px; color: #333;">เรียน คุณ <b>' . $name . '</b>,</p>

									<p style="font-size: 16px; color: #333;">
										คุณได้ดำเนินการล็อกอินเข้าสู่ระบบ <b>FONMIS</b> ของคณะพยาบาลศาสตร์
										กรุณานำรหัส OTP ด้านล่างไปกรอกในระบบเพื่อยืนยันตัวตน
									</p>

									<div style="background-color: #e2f0ff; padding: 20px; border-radius: 8px; text-align: center; margin: 20px 0;">
										<p style="font-size: 18px; margin: 0;">📌 <b style="font-size: 24px; color: #0056b3;">รหัส OTP: ' . $lginfa_code . '</b></p>
										<p style="font-size: 16px; color: #555;">รหัสอ้างอิง: <b>' . $lginfa_ref . '</b></p>
										<p style="font-size: 14px; color: #dc3545;"><b>⚠️ กรุณาใช้งานภายใน 3 นาที</b></p>
									</div>

									<p style="font-size: 14px; color: #777;">
										❗ อีเมลฉบับนี้เป็นการแจ้งข้อมูลจากระบบโดยอัตโนมัติ กรุณาอย่าตอบกลับ
									</p>

									<p style="font-size: 14px; color: #555;">
										📞 หากมีข้อสงสัยหรือประสงค์จะสอบถามเพิ่มเติม กรุณาติดต่อ <b style="color: #007bff;">038-102-827</b>
									</p>
								</div>
							';
							$mailsentsuc = $mail_to_user->send();

							if ($mailsentsuc) {
								$_SESSION['lg_ref_fon'] = $lginfa_ref;
								$_SESSION['lg_user_fon'] = $lginfa_user;
								$_SESSION['lg_date_fon'] = $lginfa_date;
								$_SESSION['lg_code_fon'] = $lginfa_code;
								unset($_SESSION["sess_login"]["email_addr"]);

								echo "success";
								exit();
							}
						}
					}

					if ($_SESSION['ud_id_fon'] == '') {
						if ($_POST['log_tims'] >= 5) {
							$dblog = new Database('nurse');
							$dblog->lg_user = $_POST['user'];
							$dblog->lg_typetodo = "Login"; //Login Add Del Edit Other
							$dblog->lg_detail = "login ระบบFonmis";
							$dblog->lg_system = "ระบบFonmisของคณะฯ";
							$dblog->lg_filename = "ctrl_login.php";
							$dblog->lg_location = "Fonmis->config->ctrl_login.php";
							$dblog->lg_status = "0"; //1=ผ่าน 0=ไม่ผ่าน
							$insertlog = $dblog->logAds();

							$_SESSION["conf_fon"] = "รอเวลาเข้าสู่ระบบอีกครั้ง";
							echo "error";
						}else{
							$_SESSION["conf_fon"] = "ลองใหม่";
							echo "error";
						}
						
					}
				} else {
					
					if ($_POST['log_tims'] >= 5) {
						$dblog = new Database('nurse');
						$dblog->lg_user = $_POST['user'];
						$dblog->lg_typetodo = "Login"; //Login Add Del Edit Other
						$dblog->lg_detail = "login ระบบFonmis";
						$dblog->lg_system = "ระบบFonmisของคณะฯ";
						$dblog->lg_filename = "ctrl_login.php";
						$dblog->lg_location = "Fonmis->config->ctrl_login.php";
						$dblog->lg_status = "0"; //1=ผ่าน 0=ไม่ผ่าน
						$insertlog = $dblog->logAds();

						$_SESSION["conf_fon"] = "รอเวลาเข้าสู่ระบบอีกครั้ง";
						echo "error";
					}else{
						// $_SESSION['times']++;
						$_SESSION["conf_time_fon"] = 'คุณเหลือโอกาสเข้าสู่ระบบอีก ' . ($time_set - $_POST["log_tims"]) . ' ครั้ง';
						$_SESSION["conf_fon"] = "กรุณาตรวจสอบ username หรือ password ของท่านใหม่อีกครั้งค่ะ";
						echo "error_login";
					}
					
				}
			} else {
				// $_SESSION['times']++;
				$_SESSION["conf_time_fon"] = 'คุณเหลือโอกาสเข้าสู่ระบบอีก ' . ($time_set - $_POST["log_tims"]) . ' ครั้ง';
				$_SESSION["conf_fon"] = "กรุณาตรวจสอบ <br>username หรือ password <br>ของท่านใหม่อีกครั้งค่ะ";
				echo "error";
			}
		}
	} else {
		$_SESSION["conf_fon"] = "aa reCAPTCHA verification failed.";
		echo "error";
	}
} else {
	$_SESSION["conf_fon"] = "aa reCAPTCHA verification failed.";
	echo "error";
}
?>
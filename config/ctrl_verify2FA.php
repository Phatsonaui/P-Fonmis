<?php session_start();
include_once("../function/fun_verify.php");
if (isUserVerified_fon()) {

	include_once("../../class/class.db.php");

	$lginfa_user = $_SESSION['ud_id_fon'];
	$lginfa_date = $_SESSION['lg_date_fon'];
	$lginfa_ref = $_POST['lginfa_ref'];
	$lginfa_code = $_POST['lginfa_code'];
	$confirmOTP = '0';

	$db = new Database('nurse');
	$db->Table = "login2FA";
	$db->Where = "Where lginfa_user='$lginfa_user' AND lginfa_ref='$lginfa_ref' AND lginfa_date='$lginfa_date' order by lginfa_id desc limit 1";
	$user = $db->Select();
	foreach ($user as $values => $data) {
		if(password_verify($lginfa_code, $data['lginfa_code'])){

			$_SESSION['logcodeFonmis']=$data['lginfa_code'];
			$confirmOTP = 1;

			$dblog = new Database('nurse');
			$dblog->lg_user = $lginfa_user;
			$dblog->lg_typetodo = "Login"; //Login Add Del Edit Other
			$dblog->lg_detail = "login ระบบFonmis";
			$dblog->lg_system = "ระบบFonmisของคณะฯ";
			$dblog->lg_filename = "ctrl_login.php";
			$dblog->lg_location = "Fonmis->config->ctrl_login.php";
			$dblog->lg_status = "1"; //1=ผ่าน 0=ไม่ผ่าน
			$insertlog = $dblog->logAds();


			$db1 = new Database('nurse');
			$db1->Table = "login2FA";
			$db1->Set  = "lginfa_status ='2'";
			$db1->Where = "where lginfa_user='$lginfa_user' AND lginfa_ref='$lginfa_ref' AND lginfa_date='$lginfa_date' order by lginfa_id desc limit 1";
			$insert2 = $db1->Update();

			echo "success";
		}
	}

	if ($confirmOTP == '0') {
		$time_set = 5;
		if ($_POST['log_tims'] >= 5) {
			$db1 = new Database('nurse');
			$db1->Table = "login2FA";
			$db1->Set  = "lginfa_status ='0'";
			$db1->Where = "where lginfa_user='$lginfa_user' AND lginfa_ref='$lginfa_ref' AND lginfa_date='$lginfa_date' order by lginfa_id desc limit 1";
			$insert2 = $db1->Update();
			$_SESSION['conf_2FA_fon'] = "คุณใส่รหัสยืนยัน OTP ไม่ถูกต้อง กรุณาตรวจสอบความถูกต้องแล้วทำการยืนยันตัวตนใหม่อีกครั้ง";
			$_SESSION['conf_times_fon'] = 'คุณเหลือโอกาสยืนยันตัวตนอีก ' . ($time_set - $_POST["log_tims"]) . ' ครั้ง';
			echo "reject";
		}else{
			$_SESSION['conf_2FA_fon'] = "คุณใส่รหัสยืนยัน OTP ไม่ถูกต้อง กรุณาตรวจสอบความถูกต้องแล้วทำการยืนยันตัวตนใหม่อีกครั้ง";
			$_SESSION['conf_times_fon'] = 'คุณเหลือโอกาสยืนยันตัวตนอีก ' . ($time_set - $_POST["log_tims"]) . ' ครั้ง';
			echo "reject";
		}
	}
} else {
	echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2;URL=ctrl_logout.php\">";
}

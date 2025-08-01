<?php
session_start();
include_once("../function/fun_verify.php");
if (isUserVerified_fon()) {
    unset($_SESSION["verify_fon"]);
    unset($_SESSION["ud_id_fon"]);
    unset($_SESSION["phpmailer2512_fon"]);
    unset($_SESSION["Function2512_fon"]);
    unset($_SESSION["LDap2512_fon"]);
    unset($_SESSION["setmenu_fon"]);
    unset($_SESSION["name_fon"]);
    unset($_SESSION["lname_fon"]);
    unset($_SESSION["role_id_fon"]);
    unset($_SESSION["lg_user_fon"]);
    unset($_SESSION["lg_code_fon"]);
    unset($_SESSION["lg_date_fon"]);
    unset($_SESSION["conf_2FA_fon"]);
    unset($_SESSION["conf_times_fon"]);

	include( "../../class/class.db.php" );
    $lg_ref = $_POST['lginfa_ref'];
    $lg_user = $_POST['lginfa_user'];
    $lg_date = $_POST['lginfa_date'];
    $lg_code = $_POST['lginfa_code'];
    $db1 = new Database('nurse');
    $db1->Table = "login2FA";
    $db1->Set  = "lginfa_status ='0'";
    $db1->Where = "where lginfa_date ='$lg_date' AND lginfa_user='$lg_user' AND lginfa_ref='$lg_ref'  order by lginfa_id desc limit 1";
    $insert2 = $db1->Update();
    $_SESSION["conf_fon"] = "ท่านไม่ได้ใส่รหัส OTP ตามเวลาที่กำหนด กรุณาทำการเข้าสู่ระบบใหม่อีกครั้งค่ะ";
    echo "success";
}else{
    echo "error";
}
session_write_close();
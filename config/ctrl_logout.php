<?php
session_start();	
    unset($_SESSION["verify_fon"]);
    unset($_SESSION["ud_id_fon"]);
    unset($_SESSION["phpmailer2512_fon"]);
    unset($_SESSION["DatabaseNurse"]);
    unset($_SESSION["Function2512_fon"]);
    unset($_SESSION["LDap2512_fon"]);
    unset($_SESSION["setmenu_fon"]);
    unset($_SESSION["name_fon"]);
    unset($_SESSION["lname_fon"]);
    unset($_SESSION["role_id_fon"]);
    unset($_SESSION["lg_user_fon"]);
    unset($_SESSION["lg_code_fon"]);
    unset($_SESSION["lg_date_fon"]);
    unset($_SESSION["lg_ref_fon"]);
?>
<script type="text/javascript">
    // รีเซ็ตค่า localStorage ในฝั่ง client-side
    localStorage.removeItem('endTime_fon');
    localStorage.removeItem('endTime_ver_fon');
    localStorage.removeItem('times_ver_fon');
    localStorage.removeItem('times_fon');

    window.location.href = '../index.php'; // หรือหน้าที่ต้องการนำไปหลังจาก logout
</script>
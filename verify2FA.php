<?php session_start();
include_once("function/fun_verify.php");
if (isUserVerified_fon()) {
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> OTP </title>
        <link rel="icon" href="img/Fon.png" type="image/x-icon">
    </head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@100;300&display=swap" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php
    include_once("../class/class.db.php");

    function showFlashMessage()
    {
        if (isset($_SESSION['conf_2FA_fon']) && $_SESSION['conf_2FA_fon'] != "") {
            $message = $_SESSION['conf_2FA_fon'];
            $_SESSION['conf_2FA_fon'] = ""; // ล้างข้อความหลังจากแสดงแล้ว
            return "<p style='font-size: 14px; color: red;font-weight: 600;' >{$message}</p>";
        }
        return "";
    }
    function showOTP()
    {
        if (isset($_SESSION['conf_times_fon']) && $_SESSION['conf_times_fon'] != "") {
            $message = $_SESSION['conf_times_fon'];
            $_SESSION['conf_times_fon'] = ""; // ล้างข้อความหลังจากแสดงแล้ว
            return "<p style='font-size: 14px; color: red;font-weight: 600;' >{$message}</p>";
        }
        return "";
    }
    ?>

    <body style="font-family: 'Prompt', sans-serif; background-color:#333;color:#fff;">
        <div class="container">
            <div class="row" style="justify-content: center;">
                <div class="col-sm-6 col-md-5 col-lg-4">
                    <div class="container_login">

                        <p style="font-size: 20px;padding-top: 30px;" align="center">กรุณาใส่รหัสยืนยัน OTP</p><br>

                        <div style="margin-top: 10px;">
                            <div class="form-group">
                                <label>รหัสอ้างอิง</label>
                                <input name="lginfa_ref" type="text" class="form-control" id="lginfa_ref" disabled value="<?php echo $_SESSION['lg_ref_fon']; ?>">
                            </div>
                            <div class="form-group">
                                <label>รหัสยืนยัน</label>
                                <input name="lginfa_code" type="text" class="form-control" id="lginfa_code" placeholder="code">
                            </div>

                            <p align="center"><input type="submit" class="btn btn-primary" id="login2FA" value="ยืนยัน"></p>
                            <div class="row mt-3 justify-content-center">
                                <?php
                                echo showFlashMessage() . "<br>";
                                echo showOTP();
                                ?>
                            </div>
                            <p align="center">กรุณายืนยันภายในเวลา
                            <div id="countdown" align="center"></div>
                            </p>
                            <input type="hidden" id="ud" value="<?php echo $_SESSION['lg_user_fon']?>">
                            <input type="hidden" id="dat" value="<?php echo $_SESSION['lg_date_fon']?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>


    </html>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var login2FA = document.getElementById('login2FA');

            login2FA.addEventListener('click', function() {
                var lginfa_ref = document.getElementById('lginfa_ref').value;
                var lginfa_code = document.getElementById('lginfa_code').value;
                var times_ver_fon = localStorage.getItem('times_ver_fon') ? parseInt(localStorage.getItem('times_ver_fon')) : 0;
                var time_set = 5;

                console.log("times : " + times_ver_fon);
                if (lginfa_code === "") {
                    Swal.fire({
                        icon: 'error',
                        title: 'โปรดกรอกข้อมูลให้ครบถ้วน',
                        timer: 3000,
                        timerProgressBar: true
                    });
                } else {
                    var formData = new FormData();
                    formData.append("lginfa_ref", lginfa_ref);
                    formData.append("lginfa_code", lginfa_code);
                    formData.append("log_tims", times_ver_fon);


                    $.ajax({
                        type: 'POST',
                        url: 'config/ctrl_verify2FA.php',
                        data: formData,
                        processData: false,
                        contentType: false,

                        success: function(data) {
                            if (data === 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'ใส่รหัส OTP เสร็จสิ้น',
                                    timer: 3000,
                                    timerProgressBar: true
                                });
                                setTimeout(function() {
                                    window.location.href = 'Page.php';
                                }, 3000);
                                localStorage.removeItem('times_ver_fon');
                                return;
                            } else if (data === 'reject') {
                                Swal.fire({
                                    icon: 'error',
                                    title: times_ver_fon >= time_set ? 'กรุณาทำการเข้าสู่ระบบใหม่อีกครั้ง' : 'คุณเหลือโอกาสยืนยันตัวตนอีก ' + (time_set - times_ver_fon) + ' ครั้ง',
                                    timer: 3000,
                                    timerProgressBar: true
                                });
                                setTimeout(function() {
                                    handleError();
                                }, 3000);
                                return;
                            }
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'เกิดข้อผิดพลาด',
                                timer: 3000,
                                timerProgressBar: true
                            });
                            setTimeout(function() {
								handleError();
							}, 3000);
							return;
                        }
                    });
                }

                function handleError() {
                    times_ver_fon++;
                    localStorage.setItem('times_ver_fon', times_ver_fon); // เก็บค่าลงใน Local Storage
                    if (times_ver_fon > 5) {
                        $.ajax({
                            url: 'config/destroy_session.php', // PHP file that destroys the session
                            type: 'POST',
                            success: function(destro) {
                                if (destro === 'success') {
                                    localStorage.removeItem('times_ver_fon');
                                    localStorage.removeItem('endTime_ver_fon');
                                    window.location = "index.php";
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error('Error destroying session:', error);
                            }
                        });
                    } else {
                        window.location.reload();
                    }
                }
            });
        });

        // กำหนดเวลาสิ้นสุดเป็น 50 นาทีจากเวลาปัจจุบัน ถ้ายังไม่มีใน localStorage
        if (!localStorage.getItem('endTime_ver_fon') || localStorage.getItem('endTime_ver_fon') < new Date().getTime()) {
            const endTime_ver_fon = new Date().getTime() + 3 * 60 * 1000;
            localStorage.setItem('endTime_ver_fon', endTime_ver_fon);
        }
        let countdownInterval2;
        function updateCountdown() {
            const endTime_ver_fon = localStorage.getItem('endTime_ver_fon'); // ดึงค่าเวลาสิ้นสุดจาก localStorage
            const now = new Date().getTime();
            const distance = endTime_ver_fon - now;
            if (distance <= 0) {
                clearInterval(countdownInterval2);

                var lginfa_ref = document.getElementById('lginfa_ref').value;
                var lginfa_code = document.getElementById('lginfa_code').value;
                var lginfa_user = document.getElementById('ud').value;
                var lginfa_date = document.getElementById('dat').value;

                var datareject = new FormData();
                datareject.append("lginfa_ref", lginfa_ref);
                datareject.append("lginfa_code", lginfa_code);
                datareject.append("lginfa_user", lginfa_user);
                datareject.append("lginfa_date", lginfa_date);
                for (var pair of datareject.entries()) {
                    console.log(pair[0] + ': ' + pair[1]);
                }
                $.ajax({
                    type: 'POST',
                    url: 'config/ctrl_reject_verify.php',
                    data: datareject,
                    processData: false,
                    contentType: false,
                    success: function(dataa) {
                        console.log(dataa);
                        if (dataa === 'success') {
                            document.getElementById("countdown").innerHTML = "เวลาหมดแล้ว";
                            handleEndTimeExpired('error', 'เวลาหมดแล้ว', 'index.php');
                        }else if(dataa === 'error'){
                            handleEndTimeExpired('error', 'ทำการเข้าสู่ระบบใหม่', 'index.php');
                        }
                    },
                    error: function(xhr, status, error) {
                        handleEndTimeExpired('error', 'เกิดข้อผิดพลาด', 'index.php');
                    }
                });
                
                
            }
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);
            document.getElementById("countdown").innerHTML = minutes + " นาที " + seconds + " วินาที ";
        }
        // อัปเดตการนับถอยหลังทุกวินาที
        countdownInterval2 = setInterval(updateCountdown, 1000);
        // เรียกใช้ฟังก์ชันครั้งแรกเมื่อโหลดหน้าเว็บ
        updateCountdown();

        function handleEndTimeExpired(icon, title, redirectUrl) {
            Swal.fire({
                icon: icon,
                title: title,
                timer: 3000,
                timerProgressBar: true
            });
            setTimeout(function() {
                localStorage.removeItem('endTime_ver_fon');
                localStorage.removeItem('times_ver_fon');
                localStorage.removeItem('times_fon');
                window.location.href = redirectUrl;
            }, 3000);
        }
    </script>
<?php } else {
    echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2;URL=config/ctrl_logout.php\">";
} ?>
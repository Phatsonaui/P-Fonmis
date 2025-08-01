<?php header('Content-Type:text/html; charset=utf-8');
session_start(); ?>
<!DOCTYPE html>
<html lang="th">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>LOGIN</title>
  <link rel="icon" href="img/Fon.png" type="image/x-icon">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@100;300&display=swap" rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
    async defer>
  </script>
</head>
<!------ Include the above in your HEAD tag ---------->
<style>
  body {
    background-color: #f2f2f2;
  }

  header img {
    height: 70px;
  }

  h1 {
    font-weight: bold;
    font-size: 36px;
    color: #333;
  }

  .form {
    background-color: white;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.1);
  }

  .form-group label {
    font-weight: bold;
    font-size: 16px;
    color: #333;
  }

  input[type="text"],
  input[type="password"] {
    padding: 10px;
    border: none;
    border-radius: 5px;
    box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
    font-size: 16px;
  }

  .form-check-label {
    font-size: 14px;
    color: #333;
  }

  button[type="submit"] {
    background-color: #333;
    color: white;
    padding: 10px 20px;
    border-radius: 5px;
    font-size: 16px;
    letter-spacing: 1px;
  }

  footer a {
    font-size: 14px;
    color: #333;
  }

  header {
    margin-bottom: 2rem;
  }

  img {
    width: 120px;
  }

  form {
    background-color: #f7f7f7;
    padding: 2rem;
    border-radius: 10px;
  }

  .form-group {
    margin-bottom: 1.5rem;
  }

  .form-check {
    margin-bottom: 1rem;
  }

  #errorMessage {
    display: none;
  }

  .main-head {
    height: 150px;
    background: #FFF;

  }

  .sidenav {
    height: 100%;
    /*background-color: #000;*/
    background-image: url("pic/pic_login.jpg");
    overflow-x: hidden;
    padding-top: 20px;
    max-height: 100%;
    /* You must set a specified height */
    background-position: center;
    /* Center the image */
    background-repeat: no-repeat;
    /* Do not repeat the image */
    background-size: cover;
  }


  .main {
    padding: 0px 20px;
  }

  @media screen and (max-height: 450px) {
    .sidenav {
      padding-top: 15px;
    }
  }

  @media screen and (max-width: 450px) {
    .login-form {
      margin-top: 10%;
    }

    .register-form {
      margin-top: 10%;
    }
  }

  @media screen and (min-width: 768px) {
    .main {
      margin-left: 62%;
    }

    .sidenav {
      width: 60%;
      position: fixed;
      z-index: 1;
      top: 0;
      left: 0;
    }

    .login-form {
      margin-top: 80%;
      margin-bottom: 50px;
    }

    .register-form {
      margin-top: 20%;
    }
  }

  .text-log {
    color: black;
  }

  .login-main-text {
    margin-top: 20%;
    padding: 30px 30px 30px 60px;
    background-color: aliceblue;
    opacity: 0.9;
  }

  .login-main-text h2 {
    font-weight: 300;
  }

  .btn-black {
    background-color: #000 !important;
    color: #fff;
  }
</style>
<?php
function showFlashMessage()
{
  if (isset($_SESSION["conf_fon"]) && $_SESSION["conf_fon"] != "") {
    $message = $_SESSION["conf_fon"];
    $_SESSION["conf_fon"] = ""; // ล้างข้อความหลังจากแสดงแล้ว
    return "<p style='font-size: 14px; color: red;font-weight: 600;' >{$message}</p>";
  }
  return "";
}
function showTime()
{
  if (isset($_SESSION["conf_time_fon"]) && $_SESSION["conf_time_fon"] != "") {
    $message = $_SESSION["conf_time_fon"];
    $_SESSION["conf_time_fon"] = ""; // ล้างข้อความหลังจากแสดงแล้ว
    return "<p style='font-size: 14px; color: red;font-weight: 600;' >{$message}</p>";
  }
  return "";
}

?>

<body style="font-family: 'Prompt', sans-serif;">
  <div class="container my-5">
    <header class="text-center">
      <h1 class="mb-3">FONMIS</h1>
    </header>
    <div class="mx-auto w-50 form row">
      <div class="form-group">
        <label for="user">USERNAME:</label>
        <input type="text" class="form-control" id="user" name="user" oninput="checkPattern()">
        <span id="message" style="color: red;"></span>
      </div>
      <div class="form-group">
        <label for="passwd">PASSWORD:</label>
        <input type="password" class="form-control" id="passwd" name="passwd">
      </div>
      <input name="systemFonmis" type="password" class="form-control" id="systemFonmis" value="<?php echo rand(); ?>" hidden>
      <div class="form-group justify-content-center d-flex">
        <div id="html_element" class="g-recaptcha" data-callback="makeaction"></div>
      </div>
      <div class="col-md-12">
        <button id="loginBtn" type="submit" class="btn btn-secondary mt-3 col-md-12">Login</button>
      </div>
      <div class="d-flex mt-3 justify-content-center" style="flex-wrap: wrap;">
        <?php
        echo showFlashMessage() . "<br>";
        echo showTime();
        ?>
      </div>
    </div>
  </div>

</body>

</html>
<script type="text/javascript">
  function checkPattern() {
    var input = document.getElementById('user');
    var message = document.getElementById('message');

    // ตรวจสอบการกรอกข้อมูลว่าตรงกับ pattern หรือไม่
    if (input.validity.patternMismatch) {
      message.textContent = input.title; // แสดงข้อความแจ้งเตือน
    } else {
      message.textContent = ''; // ลบข้อความแจ้งเตือนเมื่อข้อมูลถูกต้อง
    }
  }

  var onloadCallback = function() {
    grecaptcha.render('html_element', {
      'sitekey': '6LdVRxYqAAAAACjGzBBroTD_giHFtBdphRFnWcmi'
    });
  };

  function makeaction() {
    document.getElementById('loginBtn').disabled = false;
  }

  let countdownInterval;
  function startLoginBlock() {
    document.getElementById('loginBtn').disabled = true;

    // Set the block duration (e.g., 10 seconds)
    if (!localStorage.getItem('endTime_fon')) {
      const endTime_fon = new Date().getTime() + 5 * 60 * 1000;
      localStorage.setItem('endTime_fon', endTime_fon);
    }

    function updateCountdown() {
      const endTime_fon = localStorage.getItem('endTime_fon'); // ดึงค่าเวลาสิ้นสุดจาก localStorage
      const now = new Date().getTime();
      const distance = endTime_fon - now;

      if (distance <= 0) {
        clearInterval(countdownInterval);
        // When the block period is over, destroy the session
        $.ajax({
          url: 'config/destroy_session.php', // PHP file that destroys the session
          type: 'POST',
          success: function(destro) {
            if (destro === 'success') {
              document.getElementById('loginBtn').disabled = false;
              localStorage.removeItem('endTime_fon'); // ลบค่าเวลาที่บันทึกไว้เมื่อหมดเวลา
              localStorage.setItem('times_fon', '0');
              Swal.close(); // Close SweetAlert
              window.location.reload(); // Reload the page after session destruction
            }
          },
          error: function(xhr, status, error) {
            console.error('Error destroying session:', error);
          }
        });
      } else {
        // Update countdown on screen
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);
        if (!Swal.isVisible()) {
          Swal.fire({
            title: 'คุณถูกบล็อกการเข้าสู่ระบบ',
            text: `เวลาที่เหลือ: ${minutes} นาที ${seconds} วินาที`,
            icon: 'warning',
            showConfirmButton: false,
            allowOutsideClick: false,
            timer: distance,
            timerProgressBar: true // Automatically close the alert after the countdown ends
          });
        } else {
          Swal.update({
            text: `เวลาที่เหลือ: ${minutes} นาที ${seconds} วินาที`,
            timer: distance,
            timerProgressBar: true // Update the timer to reflect the remaining time
          });
        }
      }
    }

    clearInterval(countdownInterval);
		countdownInterval = setInterval(updateCountdown, 1000);
		updateCountdown();

  }

  document.addEventListener('DOMContentLoaded', function() {
    var loginBtn = document.getElementById('loginBtn');
    if (localStorage.getItem('endTime_fon')) {
      startLoginBlock(); // Call the function to resume the block countdown and Swal display
    }

    loginBtn.addEventListener('click', function() {
      var username = document.getElementById('user').value;
      var pass = document.getElementById('passwd').value;
      var recaptchaResponse = document.getElementById('g-recaptcha-response').value;
      var systemFonmis = document.getElementById('systemFonmis').value;
      var times_fon = localStorage.getItem('times_fon') ? parseInt(localStorage.getItem('times_fon')) : 0;
      var time_set = 5;
      console.log("times_fon : " + times_fon);

      if (username === "" || pass === "" || !recaptchaResponse) {
        Swal.fire({
          icon: 'error',
          title: 'โปรดกรอกข้อมูลให้ครบถ้วนและยืนยันตัวตน',
          timer: 3000,
          timerProgressBar: true
        });
      } else {
        var formData = new FormData();
        formData.append("user", username);
        formData.append("passwd", pass);
        formData.append("g_recaptcha_response", recaptchaResponse);
        formData.append("systemFonmis", systemFonmis);
        formData.append("log_tims", times_fon);

        $.ajax({
          type: 'POST',
          url: 'config/ctrl_login.php',
          data: formData,
          processData: false,
          contentType: false,
          beforeSend: function() {
            Swal.fire({
              title: 'กรุณารอสักครู่',
              text: 'กำลังทำการส่งเลข OTP ไปยังอีเมลของท่าน...',
              allowOutsideClick: false,
              showConfirmButton: false,
              didOpen: () => {
								Swal.showLoading();
							}
            });
          },
          success: function(data) {
            console.log(data);
            if (data === 'success') {
              Swal.fire({
                icon: 'success',
                title: 'เลข OTP ถูกส่งแล้ว',
                text: 'กรุณาตรวจสอบอีเมลของท่าน',
                timer: 3000,
                timerProgressBar: true
              });
              setTimeout(function() {
                window.location.href = 'verify2FA.php';
              }, 3000);
              localStorage.setItem('times_fon', '0');
              return;
            }
						if (data === 'success_again') {
							Swal.fire({
								icon: 'success',
								title: 'เข้าสู่ระบบเรียบร้อย',
								text: 'กรุณารอสักครู่...',
								timer: 3000,
								timerProgressBar: true
							});
							setTimeout(function() {
								window.location.href = 'Page.php';
							}, 3000);
							localStorage.setItem('times_fon', '0');
							return;
						}
						if (data === 'error_login') {
							Swal.fire({
								icon: 'error',
								title: times_fon >= time_set ? 'คุณถูกบล็อกการเข้าสู่ระบบ' : 'คุณเหลือโอกาสเข้าสู่ระบบอีก ' + (time_set - times_fon) + ' ครั้ง',
								text: 'โปรดตรวจสอบ',
								timer: 3000,
								timerProgressBar: true
							});
							setTimeout(function() {
								handleError();
							}, 3000);
							return;
						}
            if (data === "success_phatson") {
              window.location.href = 'Page.php';
              return;
            }
						if (data === 'error') {
							Swal.fire({
								icon: 'error',
								title: times_fon >= time_set ? 'คุณถูกบล็อกการเข้าสู่ระบบ' : 'คุณเหลือโอกาสเข้าสู่ระบบอีก ' + (time_set - times_fon) + ' ครั้ง',
								timer: 3000,
								timerProgressBar: true
							});
							setTimeout(function() {
								handleError();
							}, 3000);
							return;
						}
          }
        });
      }

      function handleError() {
        times_fon++;
        localStorage.setItem('times_fon', times_fon); // เก็บค่าลงใน Local Storage
        if (times_fon > 5) {
          startLoginBlock();
        } else {
          window.location.reload();
        }
      }
    });

  });
</script>
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
?>
<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8" />
    <title>Management OpenVPN - Reset Password</title>
    <link rel="stylesheet" href="style.css" />
  </head>
      <body>
        <?php include("headerlogin.php"); /* Include the specific header for login page */ ?>
        <br>
        </br>
        <section>
          <div class="logologin">
          <img src="openvpnlogo.png" class="logologin" alt="logo" title="Logo OpenVPN" />
          </div>
          <br></br>
          <div class="forgetpassword">
            <?php
              if(isset($_POST['password-reset-token']) && $_POST['email'])
              {
                  /* Connection database */
                  include "db.php";
                  /* Query to get wich mail to wich account */
                  $emailId = htmlspecialchars($_POST['email']);
               
                  $result = mysqli_query($con,"SELECT * FROM accounts WHERE email='" . $emailId . "'");
               
                  $row= mysqli_fetch_array($result);
               
                if($row)
                {
                   /* Generate a token for reset password and send it by mail */
                   $token = md5($emailId).rand(10,9999);
               
                   $expFormat = mktime(
                   date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y")
                   );
               
                  $expDate = date("Y-m-d H:i:s",$expFormat);
               
                  $update = mysqli_query($con,"UPDATE accounts set reset_link_token='" . $token . "' ,exp_date='" . $expDate . "' WHERE email='" . $emailId . "'");
               
                  $link = "<a href='".$website."/reset-password.php?key=".$emailId."&token=".$token."'>Click To Reset password</a>";
                  /* Call php mailer and configuration for smtp server */
                  require 'PHPMailer/src/Exception.php';
                  require 'PHPMailer/src/PHPMailer.php';
                  require 'PHPMailer/src/SMTP.php';
                  $mail = new PHPMailer();
                     
                  $mail->CharSet =  "utf-8";
                  $mail->IsSMTP();
                        // enable SMTP authentication
                  $mail->SMTPAuth = true;      
                  $mail->Username = "".$emailusername."";
                  $mail->Password = "".$emailpassword."";
                  $mail->SMTPSecure = "".$emailsmtpsecure."";
                  $mail->Host = "".$emailhost."";
                  $mail->Port = "".$emailport."";
                  $mail->From=''.$emailfrom.'';
                  $mail->FromName='OpenVPN Management';
                  $mail->AddAddress($_POST["email"], 'OpenVPN Management');
                  $mail->Subject  =  'Reset Password';
                  $mail->IsHTML(true);
                  $mail->Body    = 'Click On This Link to Reset Password '.$link.'';
                  if($mail->Send())
                  {
                    echo "Check Your Email and Click on the link sent to your email<br></br><a href='index.php' style='color: inherit;'>Back</a>";
                  }
                  else
                  {
                    echo "Mail Error - >".$mail->ErrorInfo;
                    echo "<br></br><a href='index.php' style='color: inherit;'>Back</a>";
                  }
                }else{
                  echo "Invalid Email Address. Go back<br></br><a href='index.php' style='color: inherit;'>Back</a>";
                }
              }
              ?>
          </div>
          </div>
        </section>
        <?php include("footer.php"); /* Include the footer */ ?>
      </body>
</html>
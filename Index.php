<?php
ini_set('display_errors', 0);
error_reporting(E_ERROR | E_WARNING | E_PARSE);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Unli Data Register</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.0/css/bootstrapValidator.min.css">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="icon" type="image/png" href="https://play-lh.googleusercontent.com/3x9p2u-MtRKDvLD1Q5eZ4JOgo-N-lP4ueTGNopBWZItgbZltuqpyJPL1qiWbrd177g">
    <style>
      @media (min-width:800px) {
        .container {
          width: 800px
        }
      }
    </style>
  </head>
  <body>
    <div class="container col-12">
      <h2>Unli Data Register</h2>
      <form class="well form-horizontal" action="" method="post" id="unlidataform">
        <fieldset>
          <div class="form-group">
            <label class="col-md-4 control-label">Mobile Number</label>
            <div class="col-md-4 inputGroupContainer">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="glyphicon glyphicon-earphone"></i>
                </span>
                <input name="number" placeholder="09123456789" class="form-control" type="text" value="<?php echo $_POST['number']; ?>" onkeyup='this.value=this.value.replace(/[^\d]/,"")' maxlength="11">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-4 control-label">GigaLife Password</label>
            <div class="col-md-4 inputGroupContainer">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="glyphicon glyphicon-lock"></i>
                </span>
                <input name="password" placeholder="•••••••••" class="form-control" type="password" value="<?php echo $_POST['password']; ?>" required>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-4 control-label">Promo List</label>
            <div class="col-md-4 selectContainer">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="glyphicon glyphicon-list"></i>
                </span>
                <select name="promo" class="form-control selectpicker">
                  <option value="1601062079">Unli Data 299 (30 days)</option>
                  <option value="1601061644">Unli Data 99 (7 days)</option>
                </select>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-4 control-label"></label>
            <div class="col-md-4">
              <button type="submit" class="btn btn-warning">Register <span class="glyphicon glyphicon-send"></span>
              </button>
            </div>
          </div>
        </fieldset>
<?php
if ($_POST["number"]) {
    $number   = $_POST["number"];
    $number   = ltrim($number, '0');
    $password = $_POST["password"];
    $url      = "https://app1.smart.com.ph/api/v2/login";
    $curl     = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_PROXY, '206.201.2.21');
    curl_setopt($curl, CURLOPT_PROXYPORT, '65535');
    $headers = array(
        "cookie: incap_ses_957_2208381=piMELHPrlBQmGFf+AvNHDdzf+WEAAAAAtUZNsfWSu/HFCK0dRHNPqw==; visid_incap_2208381=Y+GiIPXTRfyMk1srS1aPDmah+GEAAAAAQUIPAAAAAABL+j/k6TLpHtPmVq/NDFYg",
        "x-application-token: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJhcHBfaWQiOiJpb3MiLCJpYXQiOjE1OTg1ODY1MjYsIm5iZiI6MTU5ODU4NjUyNiwiZXhwIjoxOTEzOTQ2NTI2fQ.xVM2s_Owt4zNWLOlllhPXcRQ4b23x6KQpqs_2NGu9zPlQ9hjOsSS6pr9Qams7jfsyMPXtik2MFvv8V_nT8oG5Q",
        "content-type: application/json",
        "User-Agent: okhttp/5.0.0-alpha.2"
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    $data = "{\"password\":\"$password\",\"number\":\"0$number\"}";
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    $resp  = curl_exec($curl);
    $token = json_decode($resp);
    $token = $token->token;
    curl_close($curl);
    $jsonresp = json_decode($resp);
    $detail  = $jsonresp->errors{0}->detail;
}
?>
<?php
if ($_POST["number"]) {
    $number = $_POST["number"];
    $promo  = $_POST["promo"];
    $number = ltrim($number, '0');
    $url    = "https://app1.smart.com.ph/api/v2/ureg/register";
    $curl   = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_PROXY, '206.201.2.21');
    curl_setopt($curl, CURLOPT_PROXYPORT, '65535');
    $headers = array(
        "Content-Type: application/json",
        "X-Application-Token: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJhcHBfaWQiOiJpb3MiLCJpYXQiOjE1OTg1ODY1MjYsIm5iZiI6MTU5ODU4NjUyNiwiZXhwIjoxOTEzOTQ2NTI2fQ.xVM2s_Owt4zNWLOlllhPXcRQ4b23x6KQpqs_2NGu9zPlQ9hjOsSS6pr9Qams7jfsyMPXtik2MFvv8V_nT8oG5Q",
        "Authorization: Bearer $token",
        "User-Agent: okhttp/5.0.0-alpha.2"
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    $data = <<<DATA
{
"promoId": "$promo",
"brand": "BUDDY",
"number": "63$number",
"type": "regular"
}
DATA;
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    $resp = curl_exec($curl);
    curl_close($curl);
    $jsonresp = json_decode($resp);
    $title    = $jsonresp->errors{0}->title;
    $msg      = $jsonresp->errors{0}->message;
    $details  = $jsonresp->errors{0}->details;
    $unlimsg  = $jsonresp->message;
    echo "<div class=\"form-group\"><label class=\"col-md-4 control-label\"></label><div class=\"col-md-4\">$title $msg $detail $details $unlimsg</div></div>";
}
?>
<center>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v13.0" nonce="20eaSBjD"></script>
<div class="fb-post" data-href="https://www.facebook.com/jeromelaliag1337/posts/343357027893728" data-width="500" data-show-text="true"><blockquote cite="https://www.facebook.com/jeromelaliag1337/posts/343357027893728" class="fb-xfbml-parse-ignore"><p>Unli Data 99 and 299 Registration Link with Source Code and Full Infos

UNLI DATA 99/299 Registration...</p>Posted by <a href="https://www.facebook.com/jeromelaliag1337">Jerome Laliag</a> on&nbsp;<a href="https://www.facebook.com/jeromelaliag1337/posts/343357027893728">Monday, May 2, 2022</a></blockquote></div>
</center>
      </form>
      <center>Jerome Laliag ©</center>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.4.5/js/bootstrapvalidator.min.js"></script>
    <script>
      $(document).ready(function() {
        $("#unlidataform").bootstrapValidator({
          feedbackIcons: {
            valid: "glyphicon glyphicon-ok",
            invalid: "glyphicon glyphicon-remove",
            validating: "glyphicon glyphicon-refresh"
          },
          fields: {
            number: {
              validators: {
                stringLength: {
                  min: 11
                },
                notEmpty: {
                  message: "Please enter your mobile number"
                }
              }
            },
            promo: {
              validators: {
                notEmpty: {
                  message: "Please select your promo"
                }
              }
            }
          }
        }).on("success.form.bv", function(o) {
          $("#success_message").slideDown({
            opacity: "show"
          }, "slow"), $("#unlidataform").data("bootstrapValidator").resetForm(), o.preventDefault();
          o = $(o.target), o.data("bootstrapValidator");
          $.post(o.attr("action"), o.serialize(), function(o) {
            console.log(o)
          }, "json")
        })
      });
    </script>
  </body>
</html>

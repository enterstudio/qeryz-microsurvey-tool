<?php
// Settings page in the admin panel 
function qeryz_survey_admin_page() {
    global $current_user; 
 
?>
  <style type="text/css">
  #ofc-metabox{  float: left; position:relative;z-index:0;max-width:400px;background:white;border:1px solid #dfdfdf; border-radius:5px;padding:7px 25px; margin-top:30px;}
  p.error_message {color:rgb(163, 50, 6);}
  </style>

  <div class="wrap">

<?php 
    $error = '';
        //Deactivate function goes here......
    if (isset($_GET["action"]) && $_GET["action"]=="deactivate") {
        update_option('qeryz_username', "");
        update_option('qeryz_code', "0");
    }    
    if (isset($_POST["action"]) && $_POST["action"]=="login") {
                //Login function goes here......
        if ($_POST["qeryz_username"] != "" && $_POST["qeryz_username"] != "")  {
            $logindata = array("username" => $_POST["qeryz_username"], "password" => $_POST["qeryz_password"]);            
            $loginresult = qeryz_post_request(QERYZ_LOGIN_URL, $logindata);
            update_option('qeryz_username', $_POST["qeryz_username"]);
        $fh = fopen('user_details.txt', 'w');
        fwrite($fh, $loginresult);
        fclose($fh);
                $array = explode("##", file_get_contents('user_details.txt'));
        $substr = $array[0];
        $qryz_substr = $array[1];
        $user_id = trim(substr($substr, 8));
        update_option('qeryz_code',$user_id);
            $len = strlen(trim($loginresult));
            if ($len == 0){
                    $error["login"] = "<p class='error_message'>Could not log in to Qeryz. Please check your login details.</p>";            
            }
            else {
                
            } 
            
        }
        else {
                $error["login"] = "<p class='error_message'>Could not log in to Qeryz. Please check your login details.</p>"; 
        } 
        
    }
    if(get_option('qeryz_code') > '0'){
        
?>
<div id="" style="background:#ECE2CB;padding:25px;border:1px solid #eee;">
<span style="float:right;"><a href="admin.php?page=qeryz_survey_admin_page&action=deactivate">Deactivate</a></span>
Current Account &rarr; <b><?php echo get_option('qeryz_username'); ?></b> 
<!--<div style="display:inline-block;background:#444;color:#fff;font-size:10px;text-transform:uppercase;padding:3px 8px;-moz-border-radius:5px;-webkit-border-radius:5px;"></div>-->
<br><br>To start using Qeryz Survey, launch our dashboard for access to all features, including survey customization!
    <br><br><a href="<?php echo QERYZ_DASHBOARD_LINK ?>" style="text-decoration:none;" target="_blank" data-popup="true"><div class="qeryz_btn">Launch Qeryz</div></a>&nbsp;&nbsp;(This will open up a new browser tab.)
</div>
<?php  }else { ?>
<!--QERYZ LOGIN FORM HERE-->      
    <h2>Qeryz - Configuration</h2>
    <div id="ofc-metabox">
<?php if (isset($error) && isset($error["login"])) { echo $error["login"]; } ?>
    <form method="post" action="admin.php?page=qeryz_survey_admin_page">
        <input type="hidden" name="action" value="login">
        <h3>Survey Configuration</h3>
        <p>Log in with your qeryz account:</p>
    <table class="form-table">
            <tr valign="top">
            <th scope="row">Qeryz Email</th>
            <td><input type="text" name="qeryz_username" value="<?php echo get_option('qeryz_username'); ?>" /></td>
            </tr>
            <tr valign="top">
            <th scope="row">Qeryz Password</th>
            <td><input type="password" name="qeryz_password" value="<?php if (get_option('qeryz_password') != "") { echo ""; }; ?>" /></td>
            </tr>
     </table>
        <p class="submit"><input type="submit" class="button-primary" value="Submit" name="submit" /></p>
        <div class="form-wrap">
                  &nbsp;Don't have a qeryz account? <a href="<?php echo QERYZ_SIGNUP_REDIRECT_URL; ?>" target="_blank" data-popup="true">Sign up now</a>.
        </div>
      </form>
    </div>
    <div id="ofc-screenshot"> <!--to be ommited soon-->
    </div>
  </div>
  <?php
} }
  ?>
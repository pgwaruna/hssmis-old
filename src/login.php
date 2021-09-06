<?php
session_start();
error_reporting(-1);


$username = $_POST['uname'];
$userpwd = $_POST['upwd'];
$_SESSION['rumis_access'] = "notready";
if ($username != null) {


////////////////////////////////////////////////////////////////////
/////////////// Checking User Name Validity for secure /////////////
////////////////////////////////////////////////////////////////////

    $string = $username;
    $length = strlen($string);
    $myChar1 = '\'';
    $myChar2 = '=';
    $myChar3 = '\"';

    for ($i = 0; $i < $length; $i++) {
        $showString_i = substr($string, $i, 1);
    }// charactor check for close
    if (($myChar1 == "$showString_i") || ($myChar2 == "$showString_i") || ($myChar3 == "$showString_i")) {
        $_SESSION['ermsg'] = "Invalid Characters in User Name  !";
        $_SESSION['login'] = "false";
        //break;
        header('Location: index.php');
    } else {

////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////


        include './connection/connection.php';
        include_once 'restclient/HttpClientRequest.php';

//echo$username.$userpwd;
        // New Login---------------------------------------
        $login = false;
        $http = new HttpClientRequest();
        $loginResponse = $http->login($username,$userpwd);
        $data = json_decode($loginResponse);
//        var_dump($data);
//        echo $data->status;
        if($data->status = 'success'){
            $login = true;
            echo $data->status;
            echo "<br>".$data->message;
            echo "<br>".$data['user_data']['user'];
            echo "<br>".$data['user_data']['email'];
            echo "<br>".$data['taff_data']['full_name'];
        } else {
            $login = false;
            echo $data->status;
            echo "<br>".$data->messager;
        }
        // New Login----------------------------------
        ////////////////////////////////user in local system///////////////////////////////

        if ($faculty != null) {
            $quecheckpwd = "select AES_DECRYPT(password,1000) as upwd, user, l_name, initials, occupation, section, email, role from $rmsdb.$faculty where user='$username'";
        } else {
            $faculty = "fohssmis";
            $quecheckpwd = "select AES_DECRYPT(password,1000) as upwd, user, l_name, initials, occupation, section, email, role from $rmsdb.fohssmis where user='$username'";
            $quegtroleid = "select r.role_id,r.name from $rmsdb.role r , $rmsdb.fohssmis u where u.user='$username' and u.role=r.role";
            $qugtroleid = mysql_query($quegtroleid) or die(mysql_error());
            if (mysql_num_rows($qugtroleid) != 0) {
                $qgtroleid = mysql_fetch_array($qugtroleid);
                $_SESSION['role_id'] = $qgtroleid['role_id'];
                $_SESSION['role_name'] = $qgtroleid['name'];
            }
        }
        //echo$quecheckpwd;
        $qucheckpwd = mysql_query($quecheckpwd);
        if ($login) {
            $_SESSION['ermsg'] = "Access Denied !";
            $_SESSION['login'] = "false";

            if ($_SESSION['host'] == "remot") {
                header('Location: ../rumis/index.php');
            } else {
                header('Location: index.php');
            }


        } else {
            while ($qcheckpwd = mysql_fetch_array($qucheckpwd)) {
                $getpwd = $qcheckpwd['upwd'];
                //echo$getpwd;
                if ($getpwd == "$userpwd") {
                    $_SESSION['role'] = $qcheckpwd['role'];


                    if ($_SESSION['role'] == "student") {
                        $stview = $faculty . "Students";
                        //echo$stview;
                        $quegetssid = "select SSID from $rmsdb.$stview where user_name='$username'";

                        $qugetssid = mysql_query($quegetssid);
                        if (mysql_num_rows($qugetssid) != 0) {
                            while ($qgetssid = mysql_fetch_array($qugetssid)) {
                                $_SESSION['ssid'] = $qgetssid['SSID'];
                                $activate = "ok";
                            }
                        } else {
                            $activate = "notok";
                        }
                    } else {
                        $activate = "ok";
                    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                    if ($activate != "ok") {

                        $_SESSION['ermsg'] = "Your Account Deactivated !";
                        $_SESSION['login'] = "false";

                        if ($_SESSION['host'] == "remot") {
                            header('Location: ../rumis/index.php');
                        } else {
                            header('Location: index.php');
                        }

                    } else {
                        ///////////////////////////////////////////////////////////////////////
                        //////////////////////set remort access to Rumis///////////////////////
                        ///////////////////////////////////////////////////////////////////////
                        $role = $_SESSION['role'];
                        if ($role == "administrator" || $role == "topadmin" || $role == "sar" || $role == "general" || $role == "lecturer") {
                            $_SESSION['rumis_access'] = "ready";
                        }
                        ///////////////////////////////////////////////////////////////////////
                        ////////////////////end set remort access to Rumis/////////////////////
                        ///////////////////////////////////////////////////////////////////////
                        $_SESSION['faculty'] = $faculty;
                        $_SESSION['userhost'] = $faculty;
                        $_SESSION['login'] = "true" . $faculty;


                        $_SESSION['last_name'] = $qcheckpwd['l_name'];
                        $_SESSION['initials'] = $qcheckpwd['initials'];
                        $_SESSION['occupation'] = $qcheckpwd['occupation'];
                        $_SESSION['section'] = $qcheckpwd['section'];
                        $_SESSION['email'] = $qcheckpwd['email'];


                        if ($_SESSION['role'] == "student") {

                            $stnu = $qcheckpwd['user'];

                            $_SESSION['ru_st_user_id'] = $stnu;
                            //$_SESSION['user_id']=substr($stnu,2);/////old stno
                            $_SESSION['user_id'] = $stnu;
                        } else {
                            $_SESSION['user_id'] = $qcheckpwd['user'];
                        }

                        //////////////////////////////////////
                        //////////// Add Login Entry /////////
                        //////////////////////////////////////
                        include_once("classes/loginClass.php");
                        $j = new login();
                        $j->logUser();


                        ///// Generate Login ID /////
                        $login_id = $j->getmaxid();
                        $_SESSION['login_id'] = $login_id;
                        ////  End Generation LID ////


                        ///////////////////////////////////////
                        /////////// End Add Login Entry ///////
                        ///////////////////////////////////////


                        if ($_SESSION['host'] == "remot") {
                            header('Location: ../' . $faculty . '/index.php');
                        } else {
                            header('Location: index.php');
                        }

                    }//activale else close
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                }//password match if close
                else {
                    $_SESSION['ermsg'] = "Password Incorrect !";
                    $_SESSION['login'] = "false";

                    if ($_SESSION['host'] == "remot") {
                        header('Location: ../rumis/index.php');
                    } else {
                        header('Location: index.php');
                    }


                }


            }//get local user's data while close

        }


        ///////////////////////////////////////////////////////////////////////////////////


    }//charactor check if close

}// check user name not null	
else {
    $_SESSION['ermsg'] = "Please Enter Your Username !";
    $_SESSION['login'] = "false";
    header('Location: index.php');

}


?>

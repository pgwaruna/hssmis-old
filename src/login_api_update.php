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
        include_once 'restclient/HttpClientRequest.php';
        include './connection/connection.php';


        // New Login---------------------------------------
//        $login = false;
        $http = new HttpClientRequest();
        $loginResponse = $http->login($username, $userpwd);

        $res = json_decode($loginResponse);
//		var_dump($res);

        if ($res->status = 'success') {
            $loginStatus = true;

//            echo "<br><br>";
//            echo "<br>STATUS " . $res->status;
//            echo "<br>MESSAGE " . $res->message . "<br>";
//            echo "<br><br>";


//            print_r($res->data->role_data);
//            echo "<br>TOKEN " . $res->data->token;
//            echo "<br>role_name " . $res->data->role_data->role->role_name;
//            echo "<br><br>";

//            print_r($res->data->user_data);
//            echo "<br>Email " . $res->data->user_data->email;
            $faculty = $res->data->user_data->faculty;
            $l_name = $res->data->user_data->l_name;
            $initials = $res->data->user_data->initials;
            $occupation = $res->data->user_data->occupation;
            $section = $res->data->user_data->section;
            $email = $res->data->user_data->email;
            $user = $res->data->user_data->user;
//            echo "<br><br>";

//            print_r($res->data->staff_data);
//            echo "<br><br>";

//            print_r($res->data->rumis_role_data);
            $roleId = $res->data->rumis_role_data->role_id;
            $roleName = $res->data->rumis_role_data->role;
            $_SESSION['host'] = $res->data->rumis_role_data->host;
//            echo "<br><br>";
        } else {
            $loginStatus = false;
            $_SESSION['ermsg'] = $res->message;
//            echo "<br><br>";
//            echo "<br>STATUS " . $res->status;
//            echo "<br>MESSAGE " . $res->message . "<br>";
//            echo "<br><br>";
        }

        // New Login----------------------------------

        ////////////////////////////////user in local system///////////////////////////////
//        if ($faculty != null) {
//            $quecheckpwd = "select AES_DECRYPT(password,1000) as upwd, user, l_name, initials, occupation, section, email, role from $rmsdb.$faculty where user='$username'";
//        } else {
//            $faculty = "fohssmis";
//            $quecheckpwd = "select AES_DECRYPT(password,1000) as upwd, user, l_name, initials, occupation, section, email, role from $rmsdb.fohssmis where user='$username'";
//            $quegtroleid = "select r.role_id,r.name from $rmsdb.role r , $rmsdb.fohssmis u where u.user='$username' and u.role=r.role";
//            $qugtroleid = mysql_query($quegtroleid) or die(mysql_error());
//            if (mysql_num_rows($qugtroleid) != 0) {
//                $qgtroleid = mysql_fetch_array($qugtroleid);
//                $_SESSION['role_id'] = $roleId; //$qgtroleid['role_id']; // Change role id variable to api
//                $_SESSION['role_name'] = $roleName; //$qgtroleid['name']; // Chnage role name variable to api
//            }
//        }

        $_SESSION['role_id'] = $roleId; //$qgtroleid['role_id']; // Change role id variable to api
        $_SESSION['role_name'] = $roleName; //$qgtroleid['name']; // Chnage role name variable to api

        //echo$quecheckpwd;
//        $qucheckpwd = mysql_query($quecheckpwd);
//        if (mysql_num_rows($qucheckpwd) == 0) {
        if ($loginStatus == false) { // if login status from the api is fail
            $_SESSION['ermsg'] = "Access Denied !";
            $_SESSION['login'] = "false";

            if ($_SESSION['host'] == "remot") {
                echo "<script>window.location.href='../rumis/index.php'</script>";
//                header('Location: ../rumis/index.php');
            } else {
                echo "<script>window.location.href='index.php'</script>";
//                header('Location: index.php');
            }

        } else {
//            while ($qcheckpwd = mysql_fetch_array($qucheckpwd)) {
//                $getpwd = $qcheckpwd['upwd'];
                //echo$getpwd;
//                if ($getpwd == "$userpwd") {

                    $_SESSION['role'] = $roleName;

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
					////////////////////////////////////////////////////////////////////////////
                    if ($activate != "ok") {

                        $_SESSION['ermsg'] = "Your Account Deactivated !";
                        $_SESSION['login'] = "false";

                        if ($_SESSION['host'] == "remot") {
                            echo "<script>window.location.href='../rumis/index.php'</script>";
//                            header('Location: ../rumis/index.php');
                        } else {
                            echo "<script>window.location.href='index.php'</script>";
//                            header('Location: index.php');
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

                        $_SESSION['last_name'] = $l_name;
                        $_SESSION['initials'] = $initials;
                        $_SESSION['occupation'] = $occupation;
                        $_SESSION['section'] = $section;
                        $_SESSION['email'] = $email;


                        if ($_SESSION['role'] == "student") {

                            $stnu = $user;

                            $_SESSION['ru_st_user_id'] = $stnu;
                            //$_SESSION['user_id']=substr($stnu,2);/////old stno
                            $_SESSION['user_id'] = $stnu;
                        } else {
                            $_SESSION['user_id'] = $user;
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
//                            header('Location: ../' . $faculty . '/index.php');
                            echo "<script>window.location.href='../' . $faculty . '/index.php'</script>";
                        } else {
                            echo "<script>window.location.href='index.php'</script>";
//                            header('Location: index.php');
                        }

                    }//activale else close

//                }//password match if close
//                else {
//                    $_SESSION['ermsg'] = "Password Incorrect !";
//                    $_SESSION['login'] = "false";
//
//                    if ($_SESSION['host'] == "remot") {
//                        header('Location: ../rumis/index.php');
//                    } else {
//                        header('Location: index.php');
//                    }
//                }
//            }//get local user's data while close
        }
    }//charactor check if close

}// check user name not null	
else {
    $_SESSION['ermsg'] = "Please Enter Your Username !";
    $_SESSION['login'] = "false";
//    header('Location: index.php');
    echo "<script>window.location.href='index.php'</script>";
}


?>

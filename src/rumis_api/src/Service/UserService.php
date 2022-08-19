<?php
namespace Src\Service;

use Src\Response\Response;

use Exception;

class UserService
{
    /**
     * @var Response
     */
    private $success;

    public function __construct($db)
    {
        $this->db = $db;
        $this->reponse = new Response();
    }

    /**
     * Get all the users of the system
     */
    public function getUserById($id)
    {
        try {
//            $sql="select * from fohssmis where id={$id}";
            $sql="select user,l_name,initials,email from fohssmis where user='$id'";
            $qryRes=mysql_query($sql) or die(mysql_error());

            if(mysql_num_rows($qryRes) > 0){
                $predata=mysql_fetch_assoc($qryRes);
                return $this->reponse->successResponse('rumis_user_view_success',$predata);

            }else{
                throw new Exception("rumis_user_view_fail");
            }
        } catch (Exception $e) {
            // logging need to do
            return $this->reponse->invalidRequest($e->getMessage());
        }
    }

    public function resetPassword($request){
        $email = $request['email'];
        $newPass = $request['new_password'];

        try {

            $query="select user from fohssmis where email='$email'";
            $qryRes=mysql_query($query) or die(mysql_error());

            if(mysql_num_rows($qryRes) == 0){
                throw new Exception("rumis_email_not_exists");
            }

            /*  echo 'password matched'; */
            $queryNewPwd = "update fohssmis set password=AES_ENCRYPT('$newPass',1000) where email='$email'";
            $resNewPwd = mysql_query($queryNewPwd);

            if ($resNewPwd) {
                // logging need to do
                return $this->reponse->successResponse('rumis_password_reset_success',$email);
            }

        } catch (Exception $e) {
            // logging need to do
            return $this->reponse->invalidRequest('rumis_password_reset_fail_'.$e->getMessage());
        }
    }

    public function changePassword($request) {

        $email = $request['email'];
        $oldPass = $request['old_password'];
        $newPass = $request['new_password'];

        try {

            $queryCurrentPwd="select AES_DECRYPT(password,1000) as pwd from fohssmis where email='$email'";
            $resCurrentPwd=mysql_query($queryCurrentPwd);

            if(mysql_num_rows($resCurrentPwd) == 0){
                throw new Exception("rumis_user_not_found");
            }

            while($rowCurrentPass=mysql_fetch_array($resCurrentPwd)) {

                if ($rowCurrentPass['pwd'] == $oldPass) {
                    /*  echo 'password matched'; */
                    $queryNewPwd = "update fohssmis set password=AES_ENCRYPT('$newPass',1000) where user='$email'";
                    $resNewPwd = mysql_query($queryNewPwd);

                    if ($resNewPwd) {
                        // logging need to do
                        return $this->reponse->successResponse('rumis_password_change_success',$email);
                    }
                } else {
                    throw new Exception("rumis_old_password_wrong");
                }
            }
        } catch (Exception $e) {
            // logging need to do
            return $this->reponse->invalidRequest('rumis_password_change_fail_'.$e->getMessage());
        }
    }
}

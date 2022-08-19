<?php
namespace Src\Controller;

use Src\Service\UserService;
use Src\Response\Response;

class UserController
{
    private $mailService;
    private $home = null;

    public function __construct($db)
    {
        $this->userService = new UserService($db);
        $this->response = new Response();
    }

    public function getUserById($id)
    {
         return $this->userService->getUserById($id);
    }


    public function changePass($request)
    {
        $errorRes = $this->validateChangePassword($request);
        if($errorRes){
            return $this->response->invalidRequest($errorRes);
        }

        return $this->userService->changePassword($request);
    }


    public function resetPassword($request)
    {
        $errorRes = $this->validateResetPassword($request);
        if($errorRes){
            return $this->response->invalidRequest($errorRes);
        }

        return $this->userService->resetPassword($request);
    }

    /**
     * Validate the Request data before sending email
     * @param $input - Request to validate
     * @return array - return true if request is ok
     */
    private function validateChangePassword($input)
    {
        $errors = array();

        if ($input['email'] === "") {
            array_push($errors, "email_required");
        }
        if ($input['old_password'] === "") {
            array_push($errors, "old_password_required");
        }
        if ($input['new_password'] === "") {
            array_push($errors, "new_password_required");
        }
        return $errors;
    }

    /**
     * Validate the Request data before sending email
     * @param $input - Request to validate
     * @return array - return true if request is ok
     */
    private function validateResetPassword($input)
    {
        $errors = array();

        if ($input['email'] === "") {
            array_push($errors, "email_required");
        }
        if ($input['new_password'] === "") {
            array_push($errors, "new_password_required");
        }
        return $errors;
    }
}

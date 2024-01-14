<?php
// File: ValidationHelper.php

namespace Trait\Helpers;

trait ValidationHelper
{
    public function validUserName($userName)
    {
        return strlen($userName) >= 7;
    }
    public function validateEmail($email)
    {
        // Example: Use PHP filter_var to validate email format
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }
    public function validatePassword($password)
    {
        if (strlen($password) < 8) {
            return false;
        }
        if (!preg_match('/[A-Z]/', $password)) {
            return false;
        }
        if (!preg_match('/[^a-zA-Z0-9]/', $password)) {
            return false;
        }
        if (!preg_match('/[0-9]/', $password)) {
            return false;
        }
        return true;
    }
    public function validatePhoneNumber($phoneNumber)
    {
        return ctype_digit($phoneNumber);
    }
    public function isPasswordsEqual($password1, $password2)
    {
        return $password1 === $password2;
    }
    public function registerValidation($userName, $password, $email)
    {
        if (!$this->validUserName($userName)) {
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, "Not valid User Name"));
        }
        if (!$this->validateEmail($email)) {
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, "Not valid Email"));
        }
        if (!$this->validatePassword($password)) {
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, "Not valid Password"));
        }
    }
    public function loginValidation($userName, $password, $passwordFromDB)
    {
        if (!$this->validatePassword($password)) {
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, "Not valid Password"));
        }
        if (!$this->validUserName($userName)) {
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, "User Name must be >6 character"));
        }
        if (!$this->isPasswordsEqual($passwordFromDB, md5($password))) {
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, "Error in Password"));
        }
    }
}

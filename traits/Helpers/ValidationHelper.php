<?php
// File: ValidationHelper.php

namespace Trait\Helpers;

trait ValidationHelper
{
    public function validateUsername($username)
    {
        return preg_match('/^[a-zA-Z0-9]+$/', $username);
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

        // Check if there is at least one uppercase letter
        if (!preg_match('/[A-Z]/', $password)) {
            return false;
        }

        // Check if there is at least one symbol (non-alphanumeric character)
        if (!preg_match('/[^a-zA-Z0-9]/', $password)) {
            return false;
        }

        // Check if there is at least one number
        if (!preg_match('/[0-9]/', $password)) {
            return false;
        }

        // All criteria passed, the password is strong
        return true;
    }

    public function validatePhoneNumber($phoneNumber)
    {
        // Example: Check if the phone number contains only digits
        return ctype_digit($phoneNumber);
    }
    public function isPasswordsEqual($password1, $password2)
    {
        // Example: Check if two passwords are equal
        return $password1 === $password2;
    }
    public function registerValidation($userName, $password, $email)
    {
        if (empty($userName)) {
            return RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, "Please Fill User Name");
        }
        if (empty($password)) {
            return RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, "Please Fill Password");
        }
        if (empty($email)) {
            return RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, "Please Fill Password");
        }
        if ($this->validateUsername($userName)) {
            return RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, "Not valid User Name");
        }
        if (!$this->validateEmail($email)) {
            return RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, "Not valid Email");
        }
        if (!$this->validatePassword($password)) {
            return RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, "Not valid Password");
        }
        return RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, "Welcom " . $userName);
    }
    public function loginValidation($userName, $password, $passwordFromDB)
    {
        if (empty($userName)) {
            return RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, "Please Fill User Name");
        }
        if (empty($password)) {
            return RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, "Please Fill Password");
        }
        if ($this->validateUsername($userName)) {
            return RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, "Not valid User Name");
        }
        if (!$this->validatePassword($password)) {
            return RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, "Not valid Password");
        }
        if (!$this->isPasswordsEqual($passwordFromDB, md5($password))) {
            return RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, "Error in Password");
        }
        return RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, "Welcom " . $userName);
    }
}

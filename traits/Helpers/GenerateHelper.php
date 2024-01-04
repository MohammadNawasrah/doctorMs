<?php

namespace Trait\Helpers;

trait GenerateHelper
{
    public static function generateTokenByUsername($username)
    {
        // Generate a token using a combination of username and some randomness
        $randomPart = bin2hex(random_bytes(16)); // You can adjust the length as needed
        $patientToken = base64_encode($username . $randomPart);
        return substr($patientToken, 0, 64); // Ensure the token is 64 characters long
    }
}

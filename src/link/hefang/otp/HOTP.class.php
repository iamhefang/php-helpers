<?php

namespace link\hefang\otp;


/**
 * HOTP - One time password generator
 *
 * The HOTP class allow for the generation
 * and verification of one-time password using
 * the HOTP specified algorithm.
 *
 * This class is meant to be compatible with
 * Google Authenticator
 *
 * This class was originally ported from the rotp
 * ruby library available at https://github.com/mdp/rotp
 */
class HOTP extends OTP
{
    /**
     *  Get the password for a specific counter value
     * @param integer $count the counter which is used to
     *  seed the hmac hash function.
     * @return integer the One Time Password
     */
    public function at(int $count): int
    {
        return $this->generateOTP($count);
    }


    /**
     * Verify if a password is valid for a specific counter value
     *
     * @param integer $otp the one-time password
     * @param integer $counter the counter value
     * @return  bool true if the counter is valid, false otherwise
     */
    public function verify(int $otp, int $counter): bool
    {
        return ($otp == $this->at($counter));
    }

    /**
     * Returns the uri for a specific secret for hotp method.
     * Can be encoded as a image for simple configuration in
     * Google Authenticator.
     *
     * @param string $name the name of the account / profile
     * @param integer $initial_count the initial counter
     * @return string the uri for the hmac secret
     */
    public function provisioning_uri(string $name, int $initial_count): string
    {
        return "otpauth://hotp/" . urlencode($name) . "?secret={$this->secret}&counter=$initial_count";
    }
}
<?php

namespace link\hefang\otp;


class TOTP extends OTP
{
    /**
     * The interval in seconds for a one-time password timeframe
     * Defaults to 30
     * @var integer
     */
    public $interval;

    public function __construct(string $s, array $opt = [])
    {
        $this->interval = isset($opt['interval']) ? $opt['interval'] : 30;
        parent::__construct($s, $opt);
    }

    /**
     *  Get the password for a specific timestamp value
     *
     * @param integer $timestamp the timestamp which is timecoded and
     *  used to seed the hmac hash function.
     * @return integer the One Time Password
     */
    public function at(int $timestamp): int
    {
        return $this->generateOTP($this->timecode($timestamp));
    }

    /**
     *  Get the password for the current timestamp value
     *
     * @return integer the current One Time Password
     */
    public function now(): int
    {
        return $this->generateOTP($this->timecode(time()));
    }

    /**
     * Verify if a password is valid for a specific counter value
     *
     * @param integer $otp the one-time password
     * @param integer $timestamp the timestamp for the a given time, defaults to current time.
     * @return  bool true if the counter is valid, false otherwise
     */
    public function verify(int $otp, int $timestamp = null): bool
    {
        if ($timestamp === null) $timestamp = time();
        return ($otp == $this->at($timestamp));
    }

    /**
     * Returns the uri for a specific secret for totp method.
     * Can be encoded as a image for simple configuration in
     * Google Authenticator.
     *
     * @param string $name the name of the account / profile
     * @return string the uri for the hmac secret
     */
    public function provisioning_uri(string $name): string
    {
        return "otpauth://totp/" . urlencode($name) . "?secret={$this->secret}";
    }

    /**
     * Transform a timestamp in a counter based on specified internal
     *
     * @param integer $timestamp
     * @return integer the timecode
     */
    protected function timecode(int $timestamp): int
    {
        return (int)(($timestamp * 1000) / ($this->interval * 1000));
    }
}
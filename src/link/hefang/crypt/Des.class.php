<?php

namespace link\hefang\crypt;


use link\hefang\exceptions\ExtensionNotLoadException;

class Des
{
    const DES_ECB = 'DES-ECB';
    const BASE64 = 'base64';
    const HEX = 'hex';
    private $method;
    private $output;
    private $iv;
    private $options;

    public function __construct(string $method = self::DES_ECB, string $output = self::BASE64, string $iv = null, $options = null)
    {
        if (!extension_loaded('openssl')) {
            throw new ExtensionNotLoadException('openssl');
        }
        $this->method = $method;
        $this->output = $output;
        $this->iv = $iv;
        $this->options = $options ?: (OPENSSL_RAW_DATA | OPENSSL_NO_PADDING);
    }

    public function encrypt(string $data, string $key)
    {
        $str = $this->pkcsPadding($data, 8);
        $sign = openssl_encrypt($str, $this->method, $key, $this->options, $this->iv);

        if ($this->output == self::BASE64) {
            $sign = base64_encode($sign);
        } else if ($this->output == self::HEX) {
            $sign = bin2hex($sign);
        }

        return $sign;
    }

    /**
     * 解密
     *
     * @param $encrypted
     * @param $key
     * @return string
     */
    public function decrypt(string $encrypted, string $key)
    {
        if ($this->output == self::BASE64) {
            $encrypted = base64_decode($encrypted);
        } else if ($this->output == self::HEX) {
            $encrypted = hex2bin($encrypted);
        }

        $sign = @openssl_decrypt($encrypted, $this->method, $key, $this->options, $this->iv);
        $sign = $this->unPkcsPadding($sign);
        $sign = rtrim($sign);
        return $sign;
    }

    /**
     * 去填充
     *
     * @param $str
     * @return string
     */
    private function unPkcsPadding($str)
    {
        $pad = ord($str{strlen($str) - 1});
        if ($pad > strlen($str)) {
            return false;
        }
        return substr($str, 0, -1 * $pad);
    }

    /**
     * 填充
     *
     * @param $str
     * @param $blocksize
     * @return string
     */
    private function pkcsPadding($str, $blocksize)
    {
        $pad = $blocksize - (strlen($str) % $blocksize);
        return $str . str_repeat(chr($pad), $pad);
    }
}

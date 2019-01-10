<?php
/**
 * Created by IntelliJ IDEA.
 * User: hefang
 * Date: 2019/1/3
 * Time: 10:26
 */

namespace link\hefang\network;


class RequestOption
{
    private $url = '';
    private $method = 'GET';
    private $headers = [];
    private $postData;
    private $option = [];

    /**
     * RequestOption constructor.
     * @param string $url
     */
    public function __construct(string $url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return RequestOption
     */
    public function setUrl(string $url): RequestOption
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @param string $method
     * @return RequestOption
     */
    public function setMethod(string $method): RequestOption
    {
        $this->method = $method;
        return $this;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @param array $headers
     * @return RequestOption
     */
    public function setHeaders(array $headers): RequestOption
    {
        $this->headers = $headers;
        return $this;
    }

    public function addHeader(string $name, $value): RequestOption
    {
        $this->headers[$name] = $value;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPostData()
    {
        return $this->postData;
    }

    /**
     * @param mixed $postData
     * @return RequestOption
     */
    public function setPostData($postData): RequestOption
    {
        $this->postData = $postData;
        return $this;
    }

    /**
     * @return array
     */
    public function getOption(): array
    {
        return $this->option;
    }

    /**
     * @param array $option
     * @return RequestOption
     */
    public function setOption(array $option): RequestOption
    {
        $this->option = $option;
        return $this;
    }

    public function addOption(int $name, $value): RequestOption
    {
        $this->option[$name] = $value;
        return $this;
    }

}
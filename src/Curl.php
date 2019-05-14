<?php

namespace Adebayo;

/**
 * Php request builder
 * @author HOUNTONDJI Adebayo
 */
class Curl{

    /**
     * @var object $request, CURL session \\ Instance of php native function curl_init()
     * @var string|null $method, The request method
     * @var array|null $header, The request header
     * @var array $data, The request data
     * @var mixed $response, The request answer
     */
    private $request,
            $method,
            $headers = array(),
            $data = array(),
            $response;

    /**
     * @param string $uri, The request uri
     * @param bool $returnTransert
     */
    public function __construct(string $uri, bool $returnTransert = true)
    {
        $this->request = curl_init($uri);
        curl_setopt($this->request, CURLOPT_RETURNTRANSFER, $returnTransert); 
    }

    /**
     * Defined the requets method
     * @param string $method, the method to use
     */
    public function setMethod(string $method) :self
    {
        if ($method === 'GET') {
            curl_setopt($this->request, CURLOPT_HTTPGET, true);
        } elseif ($method === 'POST') {
            curl_setopt($this->request, CURLOPT_POST, true);
        } else {
            curl_setopt($this->request, CURLOPT_CUSTOMREQUEST, $method);
        }

        $this->method = $method;

        return $this;
    }
    
    /**
     * Get request headers
     * @return array, List of header datas
     */
    public function getHeaders() : array
    {
        return $this->headers;
    }

    /**
     * Update request headers
     * @param array $data, Header data
     * @return Curl
     */
    public function setHeader(array $data) : self
    {
        $this->headers = $data;
        return $this;
    }

    /**
     * Add new value on header list
     * @param string $data, The new value to add in header 
     * @return Curl
     */
    public function addHeader(string $data) : self
    {
        array_push($this->headers, $data);
        return $this;
    }

    /**
     * @param array $data
     * @return Curl
     */
    public function setData(array $data, bool $encode = true) : self
    {
        curl_setopt($this->request, CURLOPT_POSTFIELDS, $encode === true ? http_build_query($data) : $data );
        $this->data = $data;
        return $this;
    }

    /**
     * Setup username and password in request
     * @param string $username, The login
     * @param string $password, The password
     * @return Curl
     */
    public function setUserPassword(string $username, string $password) : self
    {
        curl_setopt($this->request, CURLOPT_USERPWD, "$username:$password");

        return $this;
    }

    /**
     * Execute request and return response
     */
    public function getResponse()
    {
        // Add header on request
        if (!empty($this->headers)) {
            curl_setopt($this->request, CURLOPT_HTTPHEADER, $this->headers);
        } 

        $response = curl_exec($this->request);
        curl_close($this->request);
        return $response;
    }
    
}
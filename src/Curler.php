<?php

namespace Curler;

/**
 *  @author Michael Yousrie <maikdevelops@gmail.com> 
 *
 * Curler is a package that makes sending Curling requests intuitive.
 */
class Curler
{
    /**
     *  @property string $url 
    */
    protected $url;

    /**
     * @property resource $curl
    */
    protected $curl;


    protected $headers;


    public function __construct( array $headers = [] )
    {
        $this->setHeaders( $headers );
    }


    public function setHeaders( array $headers )
    {
        $this->headers = $headers;

        return $this;
    }


    /**
     * Execute a post request
     * 
     * @param array $params
     * @return array $response
    */
    public function post( string $url, array $params = [] )
    {
        $this->init($url);

        curl_setopt($this->curl, CURLOPT_POST, 1);
        curl_setopt($this->curl, CURLOPT_POST, count($params));
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $params);

        return $this->execute();
    }

    /**
     * Execute a post request
     * 
     * @param array $params
     * @return array $response
    */
    public function get( string $url, array $params = [] )
    {
        if ( count( $params ) )
        {
            $url .= "?" . http_build_query($params);
        }

        $this->init( $url );

        return $this->execute();
    }

    /**
     * Inits Curl
     * 
     * @param string $url
     * @return null 
    */
    public function init( string $url )
    {
        $this->curl = curl_init($url);

        curl_setopt($this->curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.52 Safari/537.17');
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($this->curl, CURLOPT_SSL_VERIFYHOST, FALSE);

        if ( ! empty( $this->headers ) )
            curl_setopt($this->curl, CURLOPT_HTTPHEADER, $this->headers);
    }

    /**
     * Executes the curl request
     * 
     * @param void
     * @return array
    */
    protected function execute()
    {
        $resp = curl_exec($this->curl);

        $this->closeCurl();

        return $resp;
    }

    /**
     * closes up curl to free resources.
     * 
     * @param void
     * @return void
    */
    protected function closeCurl()
    {
        curl_close($this->curl);
    }
}

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
        curl_setopt($this->curl, CURLOPT_POSTFIELDS,
                    http_build_query($params));

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
        $this->init($url . '?' . http_build_query($params));

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
        curl_setopt($$this->curl, CURLOPT_RETURNTRANSFER, true);
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

        return json_decode($resp);
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

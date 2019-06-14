# Curler
Curl requests made easier.

#How to use.
Simple. I'll get right into code since it's too dump to explain things.

First of course you have to pull the library:
`composer require maikdevelops/curler`

```
// require composer's autoload
require 'vendor/autoload.php';

// create a new curler instance.
$curler = new Curler\Curler;

// the url to send the request to
$url = "https://www.example.com";

//post data which is just a key/value array.
$data = [
    'test' => 'test',
    'foo' => 'bar'
];

//execute a POST request and store response in the variable $response
$response = $curler->post( $url, $data );

//execute a GET request and store response in the variable $response
$response = $curler->get( $url, $data );
```

that's it. really.

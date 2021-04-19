<?php
use PHPUnit\Framework\TestCase;

include("/Users/orbitive/www/back-end-challenge/autoload.php");

class APITest extends TestCase {

    private $apiGetFile;
    private $apiCurl;

    public function testGet() {

        // File Get
        $this->apiGetFile = new API("file-get");
        // CURL
        $this->apiCurl = new API("curl");
        
        $this->assertJsonStringEqualsJsonString(
                json_encode($this->apiGetFile->getJson("https://economia.awesomeapi.com.br/USD-BRL/1")),
                json_encode($this->apiCurl->getJson("https://economia.awesomeapi.com.br/USD-BRL/1"))
        );
    }

}
?>

<?php
require_once __DIR__ . "/../vendor/autoload.php";
use Dotenv\Dotenv;

class Footbal
{
    protected $access_token;
    public $url;

    public function __construct()
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . "/../");
        $dotenv->load();
        $this->access_token = $_ENV['Football_Api_Secret'];
    }

    public function get_request()
    {
        $args = func_get_args();
        $numArgs = count($args);

        // Check if the number of arguments is less than 1 or more than 2
        if ($numArgs < 1 || $numArgs > 2) {
            echo "Error: Invalid number of arguments provided.";
            return;
        }

        list($endpoint, $specific) = $args;

        if ($numArgs == 1) {
            $uri = 'http://api.football-data.org/v4/' . $endpoint;
        }

        if ($numArgs == 2) {
            $uri = 'http://api.football-data.org/v4/' . $endpoint . '/' . $specific;
        }

        try {
            $reqPrefs['http']['method'] = 'GET';
            $reqPrefs['http']['header'] = 'X-Auth-Token: ' . $this->access_token;
            $stream_context = stream_context_create($reqPrefs);
            $response = file_get_contents($uri, false, $stream_context);

            // Check if the response is valid JSON
            if ($response === false) {
                throw new Exception("Failed to retrieve data from the API.");
            }

            $matches = json_decode($response);

            // Check if decoding was successful
            if ($matches === null && json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception("Failed to decode JSON response.");
            }

            // Output the data
            var_dump($matches);
            echo "<br/>";

            return $matches;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}

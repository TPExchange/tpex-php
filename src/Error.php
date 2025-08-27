<?php namespace TPEx\TPEx;
    class Error extends \Exception {
        public string $http_verb;
        public string $tpex_error;
        public ?int $http_status;
        public ?string $curl_error;

        public function __toString() : string {
            return "Failed to " . $this->http_verb . ": got status code " . ($this->http_status ?? "null") . " with curl error " . ($this->curl_error ?? "null") . " and TPEx error " . $this->tpex_error;
        }

        public function __construct(string $http_verb, string $tpex_error, ?int $http_status, ?string $curl_error) {
            $this->http_verb = $http_verb;
            $this->tpex_error = $tpex_error;
            $this->http_status = $http_status;
            $this->curl_error = $curl_error;
        }
    }
?>

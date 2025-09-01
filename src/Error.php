<?php namespace TPEx\TPEx;
    class Error extends \Exception {
        public string $http_verb;
        public string $tpex_error;
        public string $tpex_endpoint;
        public ?int $http_status;
        public ?string $curl_error;

        public function __toString() : string {
            return "Failed to " . $this->http_verb . " " . $this->tpex_endpoint . ": got status code " . ($this->http_status ?? "null") . " with curl error " . ($this->curl_error ?? "null") . " and TPEx error " . $this->tpex_error;
        }

        public function __construct(string $http_verb, string $tpex_error, string $tpex_endpoint, ?int $http_status, ?string $curl_error) {
            $this->http_verb = $http_verb;
            $this->tpex_error = $tpex_error;
            $this->tpex_endpoint = $tpex_endpoint;
            $this->http_status = $http_status;
            $this->curl_error = $curl_error;
            parent::__construct($this->__toString(), 0, null);
        }
    }
?>

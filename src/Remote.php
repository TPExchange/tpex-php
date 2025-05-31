<?php namespace TPEx\TPEx;
    class Remote {
        private string $_remote;
        private array $_headers;
        private CurlSharePersistentHandle $_curl_shared;

        private function raw_call(string $endpoint, string $verb, ?object $body = null) {
            $ch = curl_init("$this->_remote/$endpoint");
            curl_setopt($ch, CURLOPT_SHARE, $this->_curl_shared);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $verb);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $this->_headers);
            if (!is_null($body)) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
            }
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $data = curl_exec($ch);
            $curl_errno = curl_errno($ch);
            $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if ($curl_errno || $httpcode != 200) {
                $msg = curl_strerror($curl_errno);
                throw new RuntimeException("Failed to patch $msg:$httpcode:$data");
            }
            return json_decode($data, true);
        }
        
        public function apply(string $action, array $params, ?int $id) : int {
            return $this->raw_call(is_null(id) ? "state" : "state?id=$id", "PATCH", json_encode([$action => $params]));
        }
        public function create_token(string $user, TokenLevel $level) : int {
            return $this->raw_call("token", "POST", json_encode(["user" => $user, "level" => $level->value]));
        }
        public function fastsync() : object {
            return $this->raw_call("fastsync", "GET");
        }
        
        public function __construct(string $remote, string $token) {
            $this->_remote = $remote;
            $this->_headers = ["Authorization: Bearer $token", "Content-Type: application/json"];
            $this->_curl_shared = curl_share_init_persistent([
                CURL_LOCK_DATA_CONNECT,
                CURL_LOCK_DATA_DNS,
                CURL_LOCK_DATA_SSL_SESSION
            ]);
        }
    }
?>

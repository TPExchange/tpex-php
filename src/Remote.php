<?php namespace TPEx\TPEx;
    class Remote {
        private string $_remote;
        private array $_headers;
        private \CurlSharePersistentHandle|\CurlShareHandle $_curl_shared;

        private function raw_call(string $endpoint, string $verb, object|array|null $body = null, bool $decode_json = true) : array|int|string {
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
                throw new \TPEx\TPEx\Error($verb, $data, $endpoint, $httpcode, $msg);
            }
            return $decode_json ? json_decode($data, true) : $data;
        }

        public function apply(string $action, array $params, ?int $id = null) : int {
            return $this->raw_call(is_null($id) ? "state" : "state?id=$id", "PATCH", [$action => $params]);
        }
        public function create_token(string $user, TokenLevel $level) : string {
            return $this->raw_call("token", "POST", ["user" => $user, "level" => $level->value]);
        }
        public function raw_state(?int $id = null) : string {
            return $this->raw_call(is_null($id) ? "state" : "state?id=$id", "GET", null, false);
        }
        public function state(?int $id = null) : array {
            $res =  $this->raw_call(is_null($id) ? "state" : "state?id=$id", "GET", null, false);
            $split = explode("\n", $res);
            // Remove trailing newline
            array_pop($split);
            $ret = array();
            foreach ($split as $i) {
                $i = json_decode($i, true);
                $ret[$i["id"]] = $i;
            }
            return $ret;
        }
        public function fastsync() : \TPEx\TPEx\FastSync {
            return new FastSync($this->raw_call("fastsync", "GET"));
        }
        public function itemised_audit() : array {
            return $this->raw_call("inspect/audit", "GET");
        }
        private static function create_shared(): \CurlSharePersistentHandle|\CurlShareHandle {
            if (function_exists("curl_share_init_persistent")) {
                return curl_share_init_persistent([
                    CURL_LOCK_DATA_CONNECT,
                    CURL_LOCK_DATA_DNS,
                    CURL_LOCK_DATA_SSL_SESSION
                ]);
            }
            else {
                $ret = curl_share_init();
                curl_share_setopt($ret, CURLSHOPT_SHARE, CURL_LOCK_DATA_CONNECT);
                curl_share_setopt($ret, CURLSHOPT_SHARE, CURL_LOCK_DATA_DNS);
                curl_share_setopt($ret, CURLSHOPT_SHARE, CURL_LOCK_DATA_SSL_SESSION);
                return $ret;
            }
        }

        public function __construct(string $remote, string $token) {
            $this->_remote = $remote;
            $this->_headers = ["Authorization: Bearer $token", "Content-Type: application/json"];
            static $curl_shared = Remote::create_shared();
            $this->_curl_shared = $curl_shared;

        }
    }
?>

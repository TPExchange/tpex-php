<?php namespace TPEx\TPEx;
    class FastSync {
        public array $raw;

        public function player_balance(string $player) : string {
            return $this->raw["balance"]["balances"][$player] ?? "0c";
        }

        public function player_assets(string $player) : array {
            return $this->raw["balance"]["assets"][$player] ?? [];
        }

        public function bankers() : array {
            return $this->raw["shared_account"]["bank"]["owners"];
        }

        public function buy_orders(?string $player = null) : array {
            $data = $this->raw["order"]["buy_orders"];
            if (is_null($player)) {
                return $data;
            }

            $ret = array();
            foreach ($data as $asset => $levels) {
                foreach ($levels as $coins => $entries) {
                    foreach ($entries as $data) {
                        if ($data["player"] != $player) {
                            continue;
                        }
                        $ret[$data["id"]] = array_merge($data, ["coins" => $coins, "asset" => $asset]);
                    }
                }
            }
            return $ret;
        }

        public function sell_orders(?string $player = null) : array {
            $data = $this->raw["order"]["sell_orders"];
            if (is_null($player)) {
                return $data;
            }

            $ret = array();
            foreach ($data as $asset => $levels) {
                foreach ($levels as $coins => $entries) {
                    foreach ($entries as $data) {
                        if ($data["player"] != $player) {
                            continue;
                        }
                        $ret[$data["id"]] = array_merge($data, ["coins" => $coins, "asset" => $asset]);
                    }
                }
            }
            return $ret;
        }

        public function pending_withdrawals(?string $player = null) : array {
            if (is_null($player)) {
                return $this->raw["withdrawal"]["pending_withdrawals"];
            }
            else {
                return array_filter(
                    $this->raw["withdrawal"]["pending_withdrawals"],
                    function($k, $v) {
                        return $v["player"] == $player;
                    },
                    ARRAY_FILTER_USE_BOTH
                );
            }
        }

        public function rates() : array {
            return $this->raw["rates"];
        }

        public function restricted_items() : array {
            return $this->raw["auth"]["restricted"];
        }

        public function shared_accounts() : array {
            $bank = $this->raw["shared_account"]["bank"] ;
            $ret = ["/"=>$bank];
            foreach ($bank["children"] as $name => $child) {
                $ret["$name"] = $child;
            }
            return $ret;
        }

        public function proposals(?string $target = null) : array {
            $proposals = $this->raw["shared_account"]["proposals"];
            if (is_null($shared_account)) {
                return $proposals;
            }
            else {
                return array_filter(function ($id, $proposal) { return $proposal["target"] == $target; });
            }
        }

        public function __construct(array $raw) {
            $this->raw = $raw;
        }
    }
?>

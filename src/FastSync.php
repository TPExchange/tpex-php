<?php namespace TPEx\TPEx;
    class FastSync {
        public array $raw;

        public function player_balance(string $player) : string {
            return $this->raw["balance"]["balances"][$player] ?? "0c";
        }

        public function player_assets(string $player) : array {
            return $this->raw["balance"]["assets"][$player] ?? [];
        }

        public function buy_orders() : array {
            return $this->raw["order"]["buy_orders"];
        }

        public function sell_orders() : array {
            return $this->raw["order"]["sell_orders"];
        }

        public function __construct(array $raw) {
            $this->raw = $raw;
        }
    }
?>

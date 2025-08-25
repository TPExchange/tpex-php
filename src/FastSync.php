<?php namespace TPEx\TPEx;
    class FastSync {
        public array $raw;

        function player_balance(string $player) : string {
            return $this->raw["balances"]["balances"][$player] ?? "0c";
        }

        function player_assets(string $player) : array {
            return $this->raw["balances"]["assets"][$player] ?? [];
        }

        function buy_orders() : array {
            return $this->raw["order"]["buy_orders"];
        }

        function sell_orders() : array {
            return $this->raw["order"]["buy_orders"];
        }

        function __construct(array $raw) {
            $this->raw = $raw;
        }
    }
?>

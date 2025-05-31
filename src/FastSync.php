<?php namespace TPEx\TPEx;
    class FastSync {
        public array $raw;

        function player_balance(string $player) : string {
            return $this->raw["balances"]["balances"][$player] ?? "0c";
        }

        function player_assets(string $player) : array {
            return $this->raw["balances"]["assets"][$player] ?? [];
        }

        function __construct(array $raw) {
            $this->raw = $raw;
        }
    }
?>

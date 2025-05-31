<?php namespace TPEx\TPEx;
    class FastSync {
        public array $raw;

        function player_balance(string $player) : string {
            return $this->raw["balances"]["balances"][$player] ?? "0c";
        }

        function __construct(array $raw) {
            $this->raw = $raw;
        }
    }
?>

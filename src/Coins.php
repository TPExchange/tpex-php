<?php namespace TPEx\TPEx;
    class Coins {
        private int $millicoins;

        public function canonical(): string {
            $ret = intdiv($this->millicoins, 1000);
            $fractional = $this->millicoins % 1000;
            if ($fractional != 0) {
                $ret .= ".";
                if ($fractional % 100 == 0) {
                    $ret .= $fractional / 100;
                }
                elseif ($fractional % 10 == 0) {
                    $ret .= sprintf("%02d", $fractional / 10);
                }
                else {
                    $ret .= sprintf("%03d", $fractional);
                }
            }
            return "${ret}c";
        }

        public function pretty(): string {
            if (class_exists("\Locale")) {
                $locale = \Locale::acceptFromHttp($_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? "en_GB");
                $formatter = new \NumberFormatter($locale, \NumberFormatter::DECIMAL);
                $ret = $formatter->format(intdiv($this->millicoins, 1000));
                $decimal_sep = $formatter->getSymbol(\NumberFormatter::DECIMAL_SEPARATOR_SYMBOL);
            }
            else {
                $ret = number_format(intdiv($this->millicoins, 1000));
                $decimal_sep = ".";
            }

            $fractional = $this->millicoins % 1000;

            if ($fractional != 0) {
                $ret .= $decimal_sep;
                if ($fractional % 100 == 0) {
                    $ret .= $fractional / 100;
                }
                elseif ($fractional % 10 == 0) {
                    $ret .= sprintf("%02d", $fractional / 10);
                }
                else {
                    $ret .= sprintf("%03d", $fractional);
                }
            }
            return "${ret}c";
        }

        public function __construct(string $repr) {
            // Remove commas
            $repr = str_replace(",", "", $repr);
            // Remove trailing c
            $repr = rtrim($repr, "c");
            // Split decimal parts
            $parts = explode(".", $repr);
            $coins = 0;
            $frac = 0;
            if (count($parts) == 1) {
                if (!is_numeric($parts[0])) {
                    throw "Invalid coin string $repr";
                }
                $coins = intval($parts[0]);
                $frac = 0;
            }
            elseif (count($parts) == 2) {
                if (!(is_numeric($parts[0]) && ctype_digit($parts[1]))) {
                    throw "Invalid coin string $repr";
                }
                $coins = intval($parts[0]);
                switch (strlen($parts[1])) {
                    case 3: $frac = intval($parts[1]); break;
                    case 2: $frac = intval($parts[1]) * 10; break;
                    case 1: $frac = intval($parts[1]) * 100; break;
                    case 0: $frac = 0; break;
                    default: throw "Invalid coin string $repr";
                }
            }
            else {
                throw "Invalid coin string $repr";
            }
            if ($coins > (PHP_INT_MAX / 1000) - $frac) {
                throw "Coin string overflow $repr";
            }
            $this->millicoins = $coins * 1000 + $frac;
        }
    }
?>

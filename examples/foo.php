<?php
    require_once("../vendor/autoload.php");
    $remote = new TPEx\TPEx\Remote("https://tpex-staging.cyclic3.dev", trim(file_get_contents("token.txt")));
    $remote->apply("Deposit", [
        "player"=>"cyclic3",
        "asset"=>"diamond",
        "count"=>1,
        "banker"=>"#tpex"
    ]);
    $remote->apply("BuyCoins", [
        "player"=>"cyclic3",
        "n_diamonds"=>1,
    ]);
    $remote->apply("BuyOrder", [
        "player"=>"cyclic3",
        "asset"=>"cobblestone",
        "count"=>10,
        "coins_per"=>"10c"
    ]);
    $state = $remote->fastsync();
    print($state->player_balance("cyclic3") . "\n");
    print(json_encode($state->raw));
?>

<?php
    require_once("../vendor/autoload.php");
    // Connect to the staging server
    $remote = new TPEx\TPEx\Remote("https://tpex-staging.cyclic3.dev", trim(file_get_contents("token.txt")));
    // Deposit items
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
    $order_id = $remote->apply("BuyOrder", [
        "player"=>"cyclic3",
        "asset"=>"cobblestone",
        "count"=>10,
        "coins_per"=>"5c"
    ]);
    $state = $remote->fastsync();
    print($state->player_balance("cyclic3") . "\n");
    print(json_encode($state->raw));
    $remote->apply("CancelOrder", [
        "target"=>$order_id
    ])
?>

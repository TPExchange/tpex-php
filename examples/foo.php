<?php
    require_once("../vendor/autoload.php");
    // Connect to the staging server
    $remote = new TPEx\TPEx\Remote("https://tpex-dev.cyclic3.dev/api", trim(file_get_contents("token.txt")));
    $x = $remote->fastsync();
    // var_dump($remote->create_token("/", \TPEx\TPEx\TokenLevel::ProxyAll));
    // $remote->apply("CreateOrUpdateShared", [
    //     "name"=>"/",
    //     "owners"=>["Cyclic3", "TwoSixes", "Charnanigans", "AnomalousAri"],
    //     "min_difference"=>1,
    //     "min_votes"=>1,
    // ]);
    // var_dump($x);
    var_dump($x->shared_accounts());
    // var_dump($x->buy_orders("Cyclic3"));
    // var_dump($remote->fastsync()->sell_orders());
    // var_dump($remote->fastsync()->buy_orders());
    // $remote->apply("TransferaAsset", [
    //     "payer" => "/",
    //     "payee" => "TwoSixes",
    //     "asset" => "/%/../../../",
    //     "count" => 2
    // ]);
    // Deposit items
    // $remote->apply("Deposit", [
    //     "player"=>"Cyclic3",
    //     "asset"=>"cobblestone",
    //     "count"=>16,
    //     "banker"=>"/"
    // ]);
    // $remote->apply("RequestWithdrawal", [
    //     "player"=>"TwoSixes",
    //     "assets"=> [
    //         "nether_star" => 1000000000000,
    //     ],

    // ]);
    // $remote->apply("BuyCoins", [
    //     "player"=>"cyclic3",
    //     "n_diamonds"=>1,
    // ]);
    // $order_id = $remote->apply("BuyOrder", [
    //     "player"=>"Cyclic3",
    //     "asset"=>"cobblestone",
    //     "count"=>12,
    //     "coins_per"=>"16c"
    // ]);
    // $state = $remote->fastsync();
    // var_dump($state->bankers());
    // print($state->player_balance("cyclic3") . "\n");
    // print(json_encode($state->raw) . "\n");
    // print(json_encode($remote->itemised_audit()) . "\n");
    // $remote->apply("CancelOrder", [
    //     "target"=>$order_id
    // ])
?>

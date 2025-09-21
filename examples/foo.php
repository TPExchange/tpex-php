<?php
    require_once("../vendor/autoload.php");
    $x = new \TPEx\TPEx\Coins("100.2c");
    die($x->pretty());
    // Connect to the staging server
    // $remote = new TPEx\TPEx\Remote("https://tpex.cyclic3.dev/api", trim(file_get_contents("token2.txt")));
    // die($remote->create_token("Cyclic3", TPEx\TPEx\TokenLevel::ReadOnly));
    // die();
    // // var_dump($remote->fastsync()->player_assets("/gsp/redeem"));
    // $x = $remote->fastsync();
    // var_dump($x->player_balance("/gsp"));
    // var_dump($x->player_assets("/gsp/redeem"));
    // var_dump($x->player_balance("Cyclic3"));
    // var_dump($x->player_assets("Cyclic3"));

    // // $remote->apply("Issue", [
    // //     "product"=>"/gsp/redeem%0bond+1001c+1757003434",
    // //     "count"=>1
    // // ]);
    // // $remote->apply("TransferCoins", [
    // //     "payer" => "Cyclic3",
    // //     "payee" => "/gsp",
    // //     "count" => "1001"
    // // ]);

    // $remote->apply("TransferAsset", [
    //     "asset" => "/gsp/redeem%0bond+1001c+1757003434",
    //     "payer" => "/gsp/redeem",
    //     "payee" => "Cyclic3",
    //     "count" => 1
    // ]);
    // $remote->apply("TransferAsset", [
    //     "asset" => "/gsp/redeem%0bond+1001c+1757003434",
    //     "payer" => "Cyclic3",
    //     "payee" => "/gsp/redeem",
    //     "count" => 1
    // ]);
    // sleep(1);
    // $x = $remote->fastsync();
    // var_dump($x->player_balance("/gsp"));
    // var_dump($x->player_assets("/gsp/redeem"));
    // var_dump($x->player_balance("Cyclic3"));
    // var_dump($x->player_assets("Cyclic3"));
    // var_dump($remote->create_token("/", \TPEx\TPEx\TokenLevel::ProxyAll));
    // $remote->apply("CreateOrUpdateShared", [
    //     "name"=>"/gsp",
    //     "owners"=>["Cyclic3", "TwoSixes"],
    //     "min_difference"=>1,
    //     "min_votes"=>1,
    // ]);
    // var_dump($x);
    // var_dump($x->player_assets("/gsp/redeem"));
    // var_dump($x->buy_orders("Cyclic3"));
    // var_dump($remote->fastsync());
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

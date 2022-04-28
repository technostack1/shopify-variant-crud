<?php

$curl = curl_init();
$apiBase = "https://your-store-online.myshopify.com/admin/api/2022-04/";

$accessToken = "PUT your access token here";

curl_setopt_array($curl, array(
  CURLOPT_URL => $apiBase.'products.json',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
	'X-Shopify-Access-Token:'.$accessToken,
),
));

$response = curl_exec($curl);

curl_close($curl);



/*
require("./vendor/autoload.php");

$config = array(
    'ShopUrl' => 'http://-online.myshopify.com',
    'ApiKey' => 'caf7a9ab9172e83315ad0ce6f9b7f9fd',
    'Password' => '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',   
    'Curl' => array(
        CURLOPT_TIMEOUT => 10,
        CURLOPT_FOLLOWLOCATION => true
    )
);
//	"X-Shopify-Access-Token" => $accessToken,

PHPShopify\ShopifySDK::config($config);

$shopify = new PHPShopify\ShopifySDK;


$products2 = $shopify->Product->get();
*/

$products3 =  json_decode($response);

 $products =  $products3->products;

 $productArray = [];
$mainProduct = [];
   $r = 0;
  if(count($products) > 0){
	  foreach($products as $i => $p){
		  
		$mainProduct[$i]["product_id"] = 	$p->id;
		$mainProduct[$i]["title"]      = 	$p->title;

	//	echo "<pre>";
		//print_r($p["variants"]);
		if(count($p->variants) > 0){
		  foreach($p->variants as $j => $vari){
		//	  print_r($vari);
		  $productArray[$r]["product_id"] = $p->id;
		  $productArray[$r]["v_title"]    = $p->title;
		  $productArray[$r]["title"]      = $vari->title;
		  		  
		  $productArray[$r]["vendor"] = 	$p->vendor;
		  $productArray[$r]["variant_id"] = 	$vari->id;
		  $productArray[$r]["price"] = 	$vari->price;
		  $productArray[$r]["sku"] = 	$vari->sku;
		  $productArray[$r]["fulfillment_service"] = 	$vari->fulfillment_service;
		  $productArray[$r]["taxable"] = 	$vari->taxable;
		  $productArray[$r]["created_at"] = 	$vari->created_at;
		  $productArray[$r]["updated_at"] = 	$vari->updated_at;
		  $r++;
			  
		  }	
		}
		
		
	  }
  }

?>
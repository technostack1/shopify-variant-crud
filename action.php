<?php

$curl = curl_init();
$apiBase = "https://your-store.myshopify.com/admin/api/2022-04/";
$method = $_POST["method"];
$accessToken = "PUT your access token here";


if($method === "POST"){

    $p_id = $_POST["product_id"];
    $sku = $_POST["sku"];
    $price = $_POST["price"];
    $option1 = $_POST["option1"];
    $option2 = $_POST["option2"];
    $option3 = $_POST["option3"];

    $post = '{"variant":{"price":"'.$price.'","sku":"'.$sku.'","option1":"'.$option1.'","option2":"'.$option2.'","option3":"'.$option3.'"}}';

    curl_setopt_array($curl, array(
      CURLOPT_URL => $apiBase.'products/'.$p_id.'/variants.json',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>$post,
      CURLOPT_HTTPHEADER => array(
        'X-Shopify-Access-Token:'.$accessToken,
        'Content-Type: application/json'
      ),
    ));
    
    $response = curl_exec($curl);
    
    curl_close($curl);
    echo $response;
    
}
else if($method === "PUT"){

    $v_id = $_POST["variant_id"];
    $sku = $_POST["sku"];
    $price = $_POST["price"];
    $option1 = $_POST["option1"];
    $option2 = $_POST["option2"];
    $option3 = $_POST["option3"];

   $post = '{"variant":{"id":'.$v_id.',"price":"'.$price.'","sku":"'.$sku.'","option1":"'.$option1.'","option2":"'.$option2.'","option3":"'.$option3.'"}}';
    curl_setopt_array($curl, array(
        CURLOPT_URL => $apiBase.'variants/'.$v_id.'.json',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'PUT',
        CURLOPT_POSTFIELDS =>$post,
        CURLOPT_HTTPHEADER => array(
          'X-Shopify-Access-Token:'.$accessToken,
          'Content-Type: application/json'
        ),
      ));
      
      
      
      $response = curl_exec($curl);
      
      curl_close($curl);
      echo $response;
      
}
else if($method === "DELETE"){

    $product_id = $_POST["product_id"];
    $v_id = $_POST["v_id"];

    curl_setopt_array($curl, array(
      CURLOPT_URL => $apiBase.'/products/'.$product_id.'/variants/'.$v_id.'.json',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'DELETE',
      CURLOPT_HTTPHEADER => array(
        'X-Shopify-Access-Token:'.$accessToken,
    ),
    ));
    
    $response = curl_exec($curl);
    
    curl_close($curl);
    echo $response;
    
}

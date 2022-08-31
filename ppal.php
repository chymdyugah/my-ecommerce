<?php
	namespace Sample;
	
	require __DIR__.'/vendor/autoload.php';
	use Sample\PayPalClient;
	use PayPalClientPalCheckoutSdk\Orders\OrdersGetRequest;
	
	class GetOrder{
		public static function getOrder($orderId){
			$client = PayPalClient::client();
			$response = $client->execute(new OrdersGetRequest($orderId));
			
		}
	}
	
	
?>
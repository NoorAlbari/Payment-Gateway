<?php
include_once  'gatee/config.php';


// Calculated Hash
$data['calculated_hash']=$_GET['calculated_hash'];

$data['hash']=calculateHash($gatee['hash'], $_GET);

// Validating Hash
if($data['hash']['calculated_hash'] != $data['calculated_hash'])
{
	$data['error']="The calculated hash it is invalid.";
}
else
{
	
	// Set Payment ID
	$payment_id=$_GET['payment_id'];
	
	// Get payment from Gate-e
	$payment=getPayment($gatee['unique_id'], $gatee['hash'], $payment_id);
	
	// Check payment is processed before
	if($payment['processed'] == 0 && $payment['validated'] == "YES")
	{
		// Update payment in Gate-e
		$update_payment=updatePayment($gatee['unique_id'], $gatee['hash'], $payment_id, 1);
		
		if($update_payment['status'] == "success" && $payment['status'] == "completed")
		{
			// The payment was received successfully, and your can perform an action here.
			
		}
		else
		{
			// The payment not completed successfully, and no need to take an action on that.
			
		}
	}
	else
	{
		// The payment already processed before, and no need to take an action on that.
		
	}
}

// For message show
if($payment['status'] == "completed")
{
	$data['msg']="The payment was received successfully.";
	
}
else
{
	$data['msg']="The payment not completed successfully.";
}

print($data['msg']);

?>
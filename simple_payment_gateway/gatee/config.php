<?php

$gatee['test']=true;
$gatee['unique_id']="124505"; // Unique ID
/* -------------- Unique ID ------------------
The Merchant ID (Unique ID) of the company, you can get it from API Setting.
*/
$gatee['hash']="X8XBYADYZVPJV4R9ST5R8BIA525IQ9QO";
/* -------------- Hash -----------------
The Security Key (Hash) of the company, you can get it from API Setting.
*/
$gatee['api_type']=2;//1, 2, 3, 4
/* -------------- API Type -------------------
If there is no value the system will select default API type:
- Use API through customer registration, & login (value: 1 - default)
- Use API without customer registration, & login (value: 2)
- Use API through customer registration, login, & information (value: 3)
- Use API though customer login only (value: 4)
*/
$gatee['action']="background";//normal, background
/* -------------- Action ---------------------
How to process payment data: 
- Process payment data normally (value: normal - default) 
- Process payment data in background (value: background). Then, the system will return (payment_id, payment_url, & status) in JSON format; in this case the other party should redirect the user to payment URL. Otherwise, the system will
return error code and error message (code & error) in JSON format
*/
$gatee['callback_url']="http://www.domain.com/callback.php";
/* -------------- Callback URL ----------------
The system will post the result and the return to this URL.
*/
$gatee['show_callback']=1;
/* -------------- Show Callback Page ----------
- The API will show Gate-e Callback page (value: 1) 
- The API will not show Gate-e Callback page (value: 0)
*/
$gatee['locale']="";//en, ar
/* -------------- Locale ----------------------
Set your custom language of the payment. Accepted values: 
- en (English) 
- ar (Arabic)
*/

include "functions.php";

?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


//************* user info  */
function user_info($name){

$ci=& get_instance();

$ci->load->database();

$userID = $ci->session->userdata('user_id');

$sql = "select * from users where id = '".$userID."' "; 

$query = $ci->db->query($sql);

$row = $query->row_array();

$result = $row[$name];

return $result;

}


//************** currency info */
function currency_info(){

   $ci=& get_instance();

   $query = $ci->db->query("SELECT * FROM `currency_config` where id = '1' ")->row()->coin_name;

   return $query;

}


//********** SOCIAL LINK  */
function social_link($id){

   $ci=& get_instance();

   $query = $ci->db->query("SELECT * FROM `sociallinks` where id = '".$id."' ")->row()->link;

   return $query;
}


//************ SITE INFO  */
function site_info($name){
$CI=& get_instance();

$query = $CI->db->get('site_config');
$siteconfiguration = $query->result_array(); 

if($name =="logo"){
return $siteconfiguration[0]['logo_img'];
} else { 
return "";
}

}

//*************** user_wallet */
function user_wallet($userid){
$CI=& get_instance();

if($userid !=""){

$EarningType = "('compounding','capital_withdraw','intrest','level_commission','royal_commission')";
$MinisType = "('site_withdraw')";

$earningsInfo = $CI->db->query("SELECT sum(amount) as mybalance 
FROM history where user_id = '".$userid."' and
type in $EarningType")->row()->mybalance;


$minusInfo = $CI->db->query("SELECT sum(amount) as mybalance 
FROM history where user_id = '".$userid."' and
type in $MinisType")->row()->mybalance;

$Earning = $earningsInfo - $minusInfo;

if($Earning <= '0'){
$balance = '0.00';
} else {
$balance = $Earning;
}

return number_format($balance,4);

} else {

return '0.00';

}

}





//*************** user_wallet */
function capital_wallet($userid){
   $CI=& get_instance();
   
   if($userid !=""){
   
   $EarningType = "('release_deposit')";
   $MinisType = "('capital_withdraw_request','capital_withdraw')";
   
   $earningsInfo = $CI->db->query("SELECT sum(amount) as mybalance 
   FROM history where user_id = '".$userid."' and
   type in $EarningType")->row()->mybalance;
   
   
   $minusInfo = $CI->db->query("SELECT sum(amount) as mybalance 
   FROM history where user_id = '".$userid."' and
   type in $MinisType")->row()->mybalance;
   
   $Earning = $earningsInfo - $minusInfo;
   
   if($Earning <= '0'){
   $balance = '0.00';
   } else {
   $balance = $Earning;
   }
   
   return number_format($balance,4);
   
   } else {
   
   return '0.00';
   
   }
   
   }

   

//*************** user_wallet */
function capital_wallet_org($userid){
   $CI=& get_instance();
   
   if($userid !=""){
   
   $EarningType = "('release_deposit')";
   $MinisType = "('capital_withdraw_request','capital_withdraw')";
   
   $earningsInfo = $CI->db->query("SELECT sum(amount) as mybalance 
   FROM history where user_id = '".$userid."' and
   type in $EarningType")->row()->mybalance;
   
   
   $minusInfo = $CI->db->query("SELECT sum(amount) as mybalance 
   FROM history where user_id = '".$userid."' and
   type in $MinisType")->row()->mybalance;
   
   $Earning = $earningsInfo - $minusInfo;
   
   if($Earning <= '0'){
   $balance = '0.00';
   } else {
   $balance = $Earning;
   }
   
   return $balance;
   
   } else {
   
   return '0.00';
   
   }
   
   }




//************* user info  */
function user_info_get($userID){

   $ci=& get_instance();
   
   $ci->load->database();
   
   $sql = "select * from users where id = '".$userID."' "; 

   $query = $ci->db->query($sql);
   
   $row = $query->row_array();
   
   $result = $row;
   
   return $result;
   
   }

//*************** user_wallet */
function capital_wallet_withdraw($userid){
   $CI=& get_instance();
   
   if($userid !=""){
   
   $EarningType = "('capital_withdraw_request','capital_withdraw')";
   
   $earningsInfo = $CI->db->query("SELECT sum(amount) as mybalance 
   FROM history where user_id = '".$userid."' and
   type in $EarningType")->row()->mybalance;
   
   $Earning = $earningsInfo;
   
   if($Earning <= '0'){
   $balance = 0;
   } else {
   $balance = $Earning;
   }
   
   return $balance;
   
   } else {
   
   return 0;
   
   }
   
   }


//*************** user_wallet */
function user_wallet1($userid){
   $CI=& get_instance();
   
   if($userid !=""){
   
   $EarningType = "('compounding','capital_withdraw','intrest','level_commission','royal_commission')";
   $MinisType = "('site_withdraw')";
   
   $earningsInfo = $CI->db->query("SELECT sum(amount) as mybalance 
   FROM history where user_id = '".$userid."' and
   type in $EarningType")->row()->mybalance;
   
   
   $minusInfo = $CI->db->query("SELECT sum(amount) as mybalance 
   FROM history where user_id = '".$userid."' and
   type in $MinisType")->row()->mybalance;
   
   $Earning = $earningsInfo - $minusInfo;
   
   if($Earning <= '0'){
   $balance = '0.00';
   } else {
   $balance = $Earning;
   }
   
   return $balance;
   
   } else {
   
   return '0.00';
   
   }
   
   }



function site_currency(){
$CI=& get_instance();
$query = $CI->db->query("SELECT * FROM currency_config where id='1' ")->row();
return $query;
}

//************* STAKING BALANEC */
function staking_bal(){
$CI=& get_instance();
$userID = $CI->session->userdata('user_id');

$staking_bal = $CI->db->query("SELECT SUM(amount) as staking FROM history 
where user_id = '".$userID."' and type IN ('staking_intrest','staking_compounding') ")->row()->staking;

return number_format($staking_bal,3);
}


//************* STAKING BALANEC */
function main_balance(){

   $CI=& get_instance();
   $userID = $CI->session->userdata('user_id');

   $main_balance = $CI->db->query("SELECT SUM(amount) as main_wallet FROM history 
   where user_id = '".$userID."' and type = 'site_withdraw' ")->row()->main_wallet;

   return $main_balance;

}


function wallet_info($wallet_id){
   
   $CI=& get_instance();

   $main_balance = $CI->db->query("SELECT * FROM users where referral_id = '".$wallet_id."' ")->row();
   
   if(empty($main_balance)){
 
      return false;
 
   } else {
 
      return $main_balance;
 
   }

}

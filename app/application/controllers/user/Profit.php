<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

set_time_limit(300);
class Profit extends CI_Controller
{

//************ VERIFICATION */
function __construct() {
parent::__construct();
   

}       


//******************** DEPOSIT WALLET  */
public function Earnings(){


        //---------------------------------- WALLET BALANCE GET --------------------------\\ 
        $wallet_adderss = $this->db->query("SELECT * FROM user_investment where  status = '1'
        and run_date <= '".date('Y-m-d')."' and type='mining' order by id desc ")->result();

        if(count($wallet_adderss) > 0){

        foreach($wallet_adderss as $row){

        if( strtotime($row->run_date)  < strtotime($row->mature_date)){

        $btc_wallet = $this->Earning_start($row->invest_amount,$row->user_id,'2',$row->id,$row->days_count,$row->run_date);

        } else { 

        $btc_wallet = $this->Earning_End($row->invest_amount,
        $row->user_id,'2',$row->id,
        $row->bot,$row->days_count,$row->invest_network,$row->profit,$row->run_date);

        }

        }

        }

        //---------------------------------- WALLET BALANCE GET --------------------------\\ 
        $wallet_adderss = $this->db->query("SELECT * FROM user_investment where  status = '1'
        and run_date <= '".date('Y-m-d')."' and type='staking' order by id desc ")->result();

        if(count($wallet_adderss) > 0){

        foreach($wallet_adderss as $row){
         

        if( strtotime($row->run_date)  < strtotime($row->mature_date)){

        $btc_wallet = $this->Earning_start($row->invest_amount,$row->user_id,'1',$row->id,$row->days_count,$row->run_date);

        } else { 

        $btc_wallet = $this->Earning_End($row->invest_amount,
        $row->user_id,'1',$row->id,
        $row->bot,$row->days_count,$row->invest_network,$row->profit,$row->run_date);

        }

        }

        }


        //******************** ROYALITY BONUS START ********************/

        $call_ = $this->royality($row->run_date);

}



//****************** ROYALITY FUNCTION  */
public function royality($run_date = ""){


$run_date = date('Y-m-d');
        $all_user = $this->db->query("SELECT * FROM users where rank_id > '0' ")->result();

        if($all_user){  foreach($all_user as $user){ 
          
         $check_row = $this->db->query("SELECT * FROM history where type = 'royal_commission' 
         and user_id = '".$user->id."' and date = '".$run_date."' ")->num_rows();

         if($check_row == '0'){

        $rank_details = $this->db->query("SELECT * FROM `royal` 
        where rank_status = '1' and id = '".$user->rank_id."' ")->row();

        if($rank_details->rank_status == '1'){

        //****************** SAME RANK CHECKING ********************/
        $same_rank_chek = $this->db->query("SELECT *  FROM `users`  where sponser = '".$user->id."'  
        and rank_id >= '".$user->rank_id."' ")->num_rows(); 

        $userTeam = $this->upgrade_total_invest($user->id);

        if($same_rank_chek <= '0' || $same_rank_chek == '' ){

             $interest = $userTeam * $rank_details->rank_profit / 100;
            
        } else {

             $interest_sup_admin = $userTeam * $rank_details->rank_profit / 100;
             $interest = $interest_sup_admin * $rank_details->rank_same_levl / 100;

        }
        
     
       
        ////*********************************** ROYALITY INTEREST  */
        if($interest > 0){

        $deposit_data = array(
        "user_id" => $user->id,
        "amount" => $interest,
        "type" => "royal_commission",
        "date" => date('Y-m-d H:i:s',strtotime($run_date)),
        "history_date" => date('Y-m-d H:i:s',strtotime($run_date)),
        "status"  => '1',
        "invest_id" => $rank_details->id,
        "description" => " Royality - ".$rank_details->rank_name." Commision Made",
        );

        $insert = $this->db->insert("history",$deposit_data);

        $notify_data = array(
        "user_id" => $user->id,
        "amount" => $interest,
        "type" => "credited",
        "date" => date('Y-m-d H:i:s',strtotime($run_date)),
        "discription" => "Royality - ".$rank_details->rank_name." Commision Made",
        );
        $insert = $this->db->insert("notifications",$notify_data);


        }


        }

         }


         }}


}


//**************** Earning_End */
public function Earning_End($amount,$userid,$type,$id,$bot,$days_count,$network,$profit,$run_date){

     
        if($bot <= 0){

        $commission_info = $this->db->query("SELECT * FROM lending_settings where id = '".$type."' ")->row();

        $interest_get = $commission_info->le_interest;
        $staking_interest_get = $commission_info->staking_interest;

        if($type == '2'){

        $description = "Mining Package Matured";

        } else {

        $description = "Trading Package Matured";
        }

        /** HISTORY INSERT */
        $deposit_data = array(
        "user_id" => $userid,
        "amount" => $amount,
        "type" => "release_deposit",
        "date" => date('Y-m-d H:i:s',strtotime($run_date)),
        "history_date" =>date('Y-m-d H:i:s',strtotime($run_date)),
        "status"  => '1',
        "invest_id" => $id,
        "description" => $description
        );


        $insert = $this->db->insert("history",$deposit_data);



        $notify_data = array(
        "user_id" => $userid,
        "amount" => $amount,
        "type" => "credited",
        "date" => date('Y-m-d H:i:s'),
        "discription" => "Release Deposit",
        );
        $insert = $this->db->insert("notifications",$notify_data);
       //******************** UPDATE INTEREST */
       
       $update_data = array(
        "status" => '2' 
        );
        $this->db->where('id',$id);
        $update = $this->db->update('user_investment',$update_data);


        } else { 

        if($type == '2'){

        $description = "Mining Package Matured";

        } else {

        $description = "Trading  Package Matured";
        
        }

        /** HISTORY INSERT */
        $deposit_data = array(
        "user_id" => $userid,
        "amount" => 0,
        "type" => "release_deposit",
        "date" => date('Y-m-d H:i:s',strtotime($run_date)),
        "status"  => '1',
        "invest_id" => $id,
        "description" => $description
        );


        $insert = $this->db->insert("history",$deposit_data);


        $notify_data = array(
        "user_id" => $userid,
        "amount" => 0,
        "type" => "credited",
        "date" => date('Y-m-d H:i:s',strtotime($run_date)),
        "discription" => $description,
        );
        $insert = $this->db->insert("notifications",$notify_data);
        //******************** UPDATE INTEREST */

        $update_data = array(
        "status" => '2' 
        );
        $this->db->where('id',$id);
        $update = $this->db->update('user_investment',$update_data);

        $this->reinvest($amount,$userid,$type,$days_count,$network,$profit,$run_date);
        
       }
        
}


//************************ reinvest  */
public function reinvest($amount,$userid,$type,$days_count,$network,$profit,$run_date){

        if($type == '2'){
        $type_get = "mining";
        } else {
        $type_get = "staking";
        }
       
        //** add date next date */
        $rundate = date('Y-m-d H:i:s', strtotime($run_date . " +1 days"));

        $maturedate = date('Y-m-d', strtotime(' +'.$days_count.' day'));

        $insert_data = array(
        "user_id" => $userid,
        "invest_amount" => $amount,
        "invest_network" => $network,
        "status"  => '1',
        "created_date" => date('Y-m-d'),
        "days_count"  => $days_count,
        "profit"  => $profit,
        "run_date" => $rundate,
        "mature_date" => $maturedate,
        "starting_date" => date('Y-m-d H:i:s'),
        "ending_date" => date('Y-m-d H:i:s',strtotime($maturedate)),
        "type" => $type_get
        );

        $insert = $this->db->insert("user_investment",$insert_data);

        /** HISTORY INSERT */
        $deposit_data = array(
        "user_id" => $userid,
        "amount" => $amount,
        "type" => $type_get,
        "date" => date('Y-m-d'),
        "history_date" => date('Y-m-d H:i:s',strtotime($run_date)),
        "status"  => '1',
        "invest_id" => "",
        "description" => "Mining Made"
        );

        $insert = $this->db->insert("history",$deposit_data);


        $notify_data = array(
        "user_id" => $userid,
        "amount" => $amount,
        "type" => "credited",
        "date" => date('Y-m-d H:i:s',strtotime($run_date)),
        "discription" => "Reinvest Success",
        );
        $insert = $this->db->insert("notifications",$notify_data);

}


//*********************************** PROFIT DISTRIBUTE *************************************/
public function Earning_start($amount,$userid,$type,$id,$targetDuration,$run_date){
       

        $commission_info = $this->db->query("SELECT * FROM lending_settings where id = '".$type."' ")->row();

        $interest_get = $commission_info->le_interest;
        $staking_interest_get = $commission_info->staking_interest;
        $mc_count = $commission_info->mc_count;

        
        $durationValues = $commission_info->duration;
       
        $compoundingValues = $commission_info->compounding_add;
       
        $durationArray = explode(',', $durationValues);
        $compoundingArray = explode(',', $compoundingValues);

        $key = array_search($targetDuration, $durationArray);

        if ($key !== false) {
        $compounding_interest = $compoundingArray[$key];
        } else {
        $compounding_interest = '0';
        }


        if($type == '2'){

        $description = "Mining Interest Made";

        } else {

        $description = "Trading Interest Made";

        }

        $interest = $amount * $interest_get / 100; 

        $staking_interest =  $amount * $staking_interest_get / 100;

        /** HISTORY INSERT */
        $deposit_data = array(
        "user_id" => $userid,
        "amount" => $interest,
        "type" => "intrest",
        "date" => date('Y-m-d H:i:s',strtotime($run_date)),
        "history_date" => date('Y-m-d H:i:s',strtotime($run_date)),
        "status"  => '1',
        "invest_id" => $id,
        "description" => $description
        );

       $insert = $this->db->insert("history",$deposit_data);

        $notify_data = array(
        "user_id" => $userid,
        "amount" => $interest,
        "type" => "credited",
        "date" => date('Y-m-d H:i:s',strtotime($run_date)),
        "discription" => $description." Intrest Made Success",
        );
      
       $insert = $this->db->insert("notifications",$notify_data);

        if($staking_interest > 0){

         $currency_info = site_currency();
        $token_ini_value  = $currency_info->currency_value;
        $bonus_toke = $staking_interest * 10 ;

        /** HISTORY INSERT */
        $deposit_data = array(
        "user_id" => $userid,
        "amount" => $bonus_toke,
        "type" => "staking_intrest",
        "history_date" => date('Y-m-d H:i:s',strtotime($run_date)),
        "date" => date('Y-m-d H:i:s',strtotime($run_date)),
        "status"  => '1',
        "invest_id" => $id,
        "description" => "Staking Interest Made"
        );

       $insert = $this->db->insert("history",$deposit_data);
    
    //***************** CHECKING DAILY PROFIT COMPOUNDING ***************/
    $this->staking_compounding_interest($userid,$id,$compounding_interest,"staking",$run_date);      
    //***************** CHECKING DAILY PROFIT COMPOUNDING ***************/
    

        }

        if($type == '2'){

        $description_compound = "Mining";

        } else {

        $description_compound = "Trading";

        }

        //***************** CHECKING DAILY PROFIT COMPOUNDING ***************/
         $this->compounding_interest($userid,$id,$compounding_interest,$description_compound,$run_date);      
        //***************** CHECKING DAILY PROFIT COMPOUNDING ***************/

        //********************* INTEREST SUCCESS */
        if($insert){

        $next_due_date = date('Y-m-d H:i:s', strtotime($run_date . " +1 days"));
        $update_withdraw_date['run_date'] =  $next_due_date;
        $update_query = $this->db->where('id',$id)->update('user_investment',$update_withdraw_date);

        }

        if($commission_info->level_status == '1'){

        if($type == '2'){

        $description_level = "Mining";

        } else {

        $description_level = "Trading";

        }

        $level_check =  $commission_info->level; 

        $levels = explode(",",$level_check);

        if(count($levels) > 0){

        $referral_name =  $this->db->query("SELECT * from users where id = '".$userid."' ")->row()->referral_id;
       $referral_commission = $this->referral_commission($userid,
        $interest,$levels,'0',$referral_name,$description_level,$mc_count,$userid,$id,$run_date); 
        
        }

        }


}





//************************** COMPOUNDING INTEREST  ********************************/
public function compounding_interest($userid,$id,$interest,$description_compound,$run_date){

if($interest > 0){
     
        $check_interest_count = $this->db->query("SELECT * FROM history where 
        type='intrest' and  invest_id = '".$id."'")->num_rows();

        //********** CHECKING 24 EARNINGS */
        if($check_interest_count >= 2){

        
        $check_interest_get = $this->db->query("SELECT SUM(amount) as amount FROM history where 
        type='intrest' and  invest_id = '".$id."' ")->row()->amount;


        $check_first_day = $this->db->query("SELECT * FROM history where 
        type='intrest' and  invest_id = '".$id."' order by id asc  limit 0,1 ")->row()->amount;

        $compounding_count = $this->db->query("SELECT *
        FROM history where type='compounding' and  invest_id = '".$id."' ")->num_rows();

        $check_compounding_get = $this->db->query("SELECT SUM(amount) as amt
        FROM history where  type='compounding' and  invest_id = '".$id."' ")->row()->amt;

        $user_balance = user_wallet1($userid);

        if($user_balance >= $check_interest_get){

        $check_interest = $check_interest_get;

        if($compounding_count >= 1){

        $check_compounding = $check_interest + $check_compounding_get - $check_first_day;

        } else{

        $check_compounding = $check_interest - $check_first_day;

        }

        } else { 

        $check_compounding = $user_balance;

        }

        if($check_compounding > 0){

        $get_interest = $check_compounding * $interest / 100;
        
        /** HISTORY INSERT */
        $deposit_data = array(
        "user_id" => $userid,
        "amount" => $get_interest,
        "type" => "compounding",
        "date" => $run_date,
        "history_date" => date('Y-m-d H:i:s',strtotime($run_date)),
        "status"  => '1',
        "invest_id" => $id,
        "description" => $description_compound." Compounding Interest Made"
        );

        $insert = $this->db->insert("history",$deposit_data);

        $notify_data = array(
        "user_id" => $userid,
        "amount" => $get_interest,
        "type" => "credited",
        "date" => date('Y-m-d H:i:s',strtotime($run_date)),
        "discription" => "Compounding Intrest Made Success",
        );

        $insert = $this->db->insert("notifications",$notify_data);

        }
     
        }
        
}

}


public function staking_compounding_interest($userid,$id,$interest,$description_compound,$run_date){
    
if($interest > 0){
     
        $check_interest_count = $this->db->query("SELECT * FROM history where 
        type='staking_intrest' and  invest_id = '".$id."'")->num_rows();

        //********** CHECKING 24 EARNINGS */
        if($check_interest_count >= 2){

        $check_interest = $this->db->query("SELECT SUM(amount) as amount FROM history where 
        type='staking_intrest' and  invest_id = '".$id."' ")->row()->amount;

        $check_first_day = $this->db->query("SELECT * FROM history where 
        type='staking_intrest' and  invest_id = '".$id."' order by id asc  limit 0,1 ")->row()->amount;

     
        $compounding_count = $this->db->query("SELECT *
        FROM history where type='staking_compounding' and  invest_id = '".$id."' ")->num_rows();


        if($compounding_count >= 1){

        $check_compounding_get = $this->db->query("SELECT SUM(amount) as amt
        FROM history where  type='staking_compounding' and  invest_id = '".$id."' ")->row()->amt;

        $check_compounding = $check_interest + $check_compounding_get - $check_first_day;
        
        } else{
         
        $check_compounding = $check_interest - $check_first_day;

        }


        if($check_compounding > 0){

        $get_interest = $check_compounding * $interest / 100;
        
        /** HISTORY INSERT */
        $deposit_data = array(
        "user_id" => $userid,
        "amount" => $get_interest,
        "type" => "staking_compounding",
        "date" => $run_date,
        "history_date" => date('Y-m-d H:i:s',strtotime($run_date)),
        "status"  => '1',
        "invest_id" => $id,
        "description" => "Staking Compounding Interest Made"
        );

        $insert = $this->db->insert("history",$deposit_data);

        $notify_data = array(
        "user_id" => $userid,
        "amount" => $get_interest,
        "type" => "credited",
        "date" => date('Y-m-d H:i:s',strtotime($run_date)),
        "discription" => "Staking Compounding Intrest Made Success",
        );

        $insert = $this->db->insert("notifications",$notify_data);

        }
     
        }
        
}    

}


//*************************** LEVEL COMMISSION FLOW  */

   public function referral_commission($userid,$interest,$levels_get,$level,$referral_name,$description_level,$mc_count,$from_id,$invest_id,$run_date){

        $get_referral = $this->db->query("SELECT * from users where id = '".$userid."' ")->row()->sponser;

        if($get_referral!="" && $get_referral > 0 ){

        $check_referral_count = $this->db->query("SELECT * FROM users where sponser = '".$get_referral."' ")->num_rows();

        if($check_referral_count >= $mc_count){

        $level_commission = $levels_get[$level];

        $interest_profit = $interest * $level_commission / 100;

       if($interest_profit > 0) { 
           
        $check_user_dep = $this->db->query("SELECT * FROM user_investment where user_id = '".$get_referral."' ")->num_rows();
        
        if($check_user_dep > 0){
        
         $levels = $level+1;
        $deposit_data = array(
        "user_id" => $get_referral,
        "amount" => $interest_profit,
        "type" => "level_commission", 
        "date" => date('Y-m-d H:i:s',strtotime($run_date)),
        "level_type" => $description_level,
        "level_count" => $levels,
        "from_id" => $from_id,
        "history_date" => date('Y-m-d H:i:s',strtotime($run_date)),
        "status"  => '1',
        "invest_id" => $invest_id,
        "description" => $description_level." level ".$levels." Commission Earned From - ".$referral_name
        );

        $insert = $this->db->insert("history",$deposit_data);

        $notify_data = array(
        "user_id" => $get_referral,
        "amount" => $interest_profit,
        "type" => "credited",
        "date" => date('Y-m-d H:i:s',strtotime($run_date)),
        "discription" => $description_level." level ".$levels." Commission Earned From - ".$referral_name,
        );
        $insert = $this->db->insert("notifications",$notify_data);

        
        
            
        }
        
        }

        }

        $level++;

        //**************** ONLY THREE LEVELS ARE ALLOW  */
        if($level <= 2){

        $this->referral_commission($get_referral,
        $interest,$levels_get,$level,$referral_name,$description_level,$mc_count,$from_id,$invest_id,$run_date);

        }

        }

      

}



//******************************* IPN VERIFICATION  *************************************/
    
public function call(){
    
    $user = $this->db->query("SELECT * FROM users ")->result();
    $rank_want = $rank_details->rank_elg;
    
    if($user){ foreach( $user as $row ) { 
    
        $referral_count = $this->db->query("SELECT * FROM users 
        where sponser = '".$row->id."' ")->num_rows();

        if($referral_count >= 5)
        {

        $this->rank_update($row->id);

        }
    
    }}
    

    $this->update_swap();
    
    
}
    


//***************** UPDATE SWAP LIMIT */
public function update_swap_all(){
        
        $apiKey = '058e8159-48ab-48ad-8e36-2c13a1d0aa99'; 
        $url = 'https://api.simpleswap.io/get_all_currencies';
        $url .= '?api_key=' . $apiKey;
        $ch = curl_init($url);
        $options = array(
            CURLOPT_RETURNTRANSFER => true,
           CURLOPT_HTTPHEADER => array(
                'Accept: application/json'
            )
        );
        curl_setopt_array($ch, $options);
        $response = curl_exec($ch);
        if ($response === false) {
            echo 'Error: ' . curl_error($ch);
       } else {
            $data = json_decode($response, true);
        }
       
        curl_close($ch);
       
        
        $swap_limit = array();
        
        if($data){
            $i = 0;
           foreach($data as $exch_currency_row){
               
           if($i <= 100){
               
           $get_price = $this->price_get_all($exch_currency_row['symbol']);
          
          
           if($get_price > 0 ) {
          
          echo "<pre>";
          echo $exch_currency_row['symbol'];
          echo "<pre>";
          
             $i++;
             
               $swap_limit[] = array(
               "name" => $exch_currency_row['name'],
               "symbol" => $exch_currency_row['symbol'],
               "image" => $exch_currency_row['image'],
               "price" => $get_price,
               );
               
            
           }
   
               } else {
                break;
               }
                
             
           }
        }
        

        $insert_data = json_encode($swap_limit);

        $insert_data_get = array(
           "swap" => $insert_data
        );
        $insert = $this->db->where('id','1')->update('user_wallet',$insert_data_get);
     

        if($insert){
                echo "updated Successfully";
        } else {
               echo "updated Faild";
        }
   
   
   }


   

public function price_get_all($symbol){
    

         
          $apiKey = '058e8159-48ab-48ad-8e36-2c13a1d0aa99'; 
        $url = 'https://simpleswap.io/api/v3/estimates/estimated?currencyFrom='.$symbol.'&currencyTo=usdtbep20&amount=100&fixed=false&site=true';
        $url .= '?api_key=' . $apiKey;
        


             $ch = curl_init($url);
             $options = array(
            CURLOPT_RETURNTRANSFER => true,
           CURLOPT_HTTPHEADER => array(
                 'Accept: application/json'
             )
             );
             curl_setopt_array($ch, $options);
             $response = curl_exec($ch);
             
            
             if (!is_numeric($response)) {
             return 0;
             } else {
                 $datass = json_decode($response, true);
            
                 $price = $datass;
                 if($price > 0){
                 $get_price = $price / 100;
                 } else { 
                 $get_price = '0';
                 }
             }
         curl_close($ch);
         
          return  (($price / 100) /  100) * 102;
    
        
    }
    
    
//***************** UPDATE SWAP LIMIT */
public function update_swap(){
        
        $apiKey = '058e8159-48ab-48ad-8e36-2c13a1d0aa99'; 
        $url = 'https://api.simpleswap.io/get_all_currencies';
        $url .= '?api_key=' . $apiKey;
        
       
        
        $ch = curl_init($url);
        $options = array(
            CURLOPT_RETURNTRANSFER => true,
           CURLOPT_HTTPHEADER => array(
                'Accept: application/json'
            )
        );
        curl_setopt_array($ch, $options);
        $response = curl_exec($ch);
        if ($response === false) {
            echo 'Error: ' . curl_error($ch);
       } else {
            $data = json_decode($response, true);
        }
       
        curl_close($ch);
       
        
        $swap_limit = array();
        
        if($data){
            $i = 0;
           foreach($data as $exch_currency_row){
               
           if($i <= 10){
               
           $get_price = $this->price_get($exch_currency_row['symbol']);
           
          
           if($get_price > 0 ) {
           
             $i++;
             
               $swap_limit[] = array(
               "name" => $exch_currency_row['name'],
               "symbol" => $exch_currency_row['symbol'],
               "image" => $exch_currency_row['image'],
               "price" => $get_price,
               );
               
            
           }
   
               } else {
                break;
               }
                
             
           }
        }
        

        $insert_data = json_encode($swap_limit);

        $insert_data_get = array(
           "swap_limit" => $insert_data
        );
        $insert = $this->db->where('id','1')->update('user_wallet',$insert_data_get);

        if($insert){
                echo "updated Successfully";
                
               $this->update_swap_all();
        }
   
   
   }
    

   
public function price_get($symbol){
    
    
        $allowed_symbols = array("eth", "btc", "ltc", "xrp","dai","bnb-bsc","atombsc","doge","ada","solbsc"); 
        
        if (!in_array($symbol, $allowed_symbols)) {
        return 0; 
        } else {

        $apiKey = '058e8159-48ab-48ad-8e36-2c13a1d0aa99'; 
        $url = 'https://simpleswap.io/api/v3/estimates/estimated?currencyFrom='.$symbol.'&currencyTo=usdtbep20&amount=100&fixed=false&site=true';
        $url .= '?api_key=' . $apiKey;
            
    
    // $apiKey = '058e8159-48ab-48ad-8e36-2c13a1d0aa99'; 
    // $url = 'https://simpleswap.io/api/v3/estimates/estimated?currencyFrom=usdtbep20&currencyTo='.$symbol.'&amount=40&fixed=false&site=true';
    // $url .= '?api_key=' . $apiKey;
        

             $ch = curl_init($url);
             $options = array(
            CURLOPT_RETURNTRANSFER => true,
           CURLOPT_HTTPHEADER => array(
                 'Accept: application/json'
             )
             );
             curl_setopt_array($ch, $options);
             $response = curl_exec($ch);
             
             if (!is_numeric($response)) {
             return 0;
             } else {
                 $datass = json_decode($response, true);
            
                 $price = $datass;
                 if($price > 0){
                 $get_price = $price / 100;
                 } else { 
                 $get_price = '0';
                 }
             }
         curl_close($ch);
         
         return  (($price / 100) /  100) * 102;
         
        }
        
    }
    
     
public function rank_update($user_id){

    $check_rank_get = user_info_get($user_id);


    $check_rank = $check_rank_get->rank_id;


    $referral_count = $this->db->query("SELECT * FROM users 
    where sponser = '".$user_id."' ")->num_rows();
    
    $userTeam = $this->upgrade_total_invest($user_id);


    $rank_details = $this->db->query("SELECT * FROM `royal` 
    where rank_status = '1' and rank_amt <= '".$userTeam."' order by id desc limit 1 ")->row();
    
    $i = 0;

   if($rank_details){

        echo "<pre>";
        print_r($rank_details);
        echo "<pre>";

        $rank_want = $rank_details->rank_amt;

        if($userTeam  >= $rank_details->rank_amt){

        $i++;

        if($referral_count >= $rank_want && $check_rank != $rank_details->id)
        {

                $deposit_data = array(
                "user_id" => $user_id,
                "amount" => '0',
                "type" => "rank",
                "date" => date('Y-m-d'),
                "status"  => '1',
                "invest_id" => "0",
                "description" => "Achived Royality - ".$rank_details->rank_name
                );
                $insert = $this->db->insert("history",$deposit_data);
        
                if($insert){
        
                $rank_updates = array(
                'rank_id' => $rank_details->id,
                );
        
                $this->db->where('id',$user_id);
                $update = $this->db->update('users',$rank_updates);
                
                }
        }
        
        }
                
   }
     

 if($i == 0){
$rank_updates = array(
'rank_id' => 0,
);

$this->db->where('id',$user_id);
$update = $this->db->update('users',$rank_updates);
 }
    
}




//*********************** TOTAL INVEST COMMISSION */
public function upgrade_total_invest($userid){

        $get_sponser = $this->User_Model->get_downlines($userid);
       
        $amount = 0;

        if(!empty($get_sponser)){

        foreach($get_sponser as $user_id){

        $amount_get = $this->db->query("SELECT SUM(invest_amount) as mining_tot FROM user_investment 
        where user_id = '".$user_id['id']."' and type IN ('mining','staking') ")->row()->mining_tot;

        $amount_get_minius =  capital_wallet_withdraw($user_id);

        $get_amount = $amount_get ? $amount_get : 0;
        $amount +=$get_amount - $amount_get_minius;

        }

        return $amount;
        
        } else {
        
        return '0';
        
        }
     
 }




//******************** DEPOSIT WALLET  */
public function manual_Earnings(){


    //---------------------------------- WALLET BALANCE GET --------------------------\\ 
    $wallet_adderss = $this->db->query("SELECT * FROM user_investment where  status = '2'
     and type='mining' order by id desc ")->result();

    if(count($wallet_adderss) > 0){

    foreach($wallet_adderss as $row){

    $user_balance = user_wallet1($row->user_id);

     if($user_balance >= $row->invest_amount){

   /* $btc_wallet = $this->Manual_Earning_End($row->invest_amount,
    $row->user_id,'2',$row->id,
    $row->bot,$row->days_count,$row->invest_network,$row->profit,$row->run_date); */

     }

    }

    }

    //---------------------------------- WALLET BALANCE GET --------------------------\\ 
    $wallet_adderss = $this->db->query("SELECT * FROM user_investment where  status = '2'
    and type='staking' order by id desc ")->result();

    if(count($wallet_adderss) > 0){

    foreach($wallet_adderss as $row){

        $user_balance = user_wallet1($row->user_id);

        if($user_balance >= $row->invest_amount){

        /*    $btc_wallet = $this->Manual_Earning_End($row->invest_amount,
            $row->user_id,'1',$row->id,
            $row->bot,$row->days_count,$row->invest_network,$row->profit,$row->run_date); */

        }
    
    }

    }


}

//**************** Earning_End */
public function Manual_Earning_End($amount,$userid,$type,$id,$bot,$days_count,$network,$profit,$run_date){

    if($type == '2'){

    $description = "Mining Package Matured";

    } else {

    $description = "Trading  Package Matured";
    
    }

    $this->reinvest_manual($amount,$userid,$type,'55',$network,$profit,$run_date);
    
}


//************************ reinvest  */
public function reinvest_manual($amount,$userid,$type,$days_count,$network,$profit,$run_date){

    if($type == '2'){
    $type_get = "mining";
    } else {
    $type_get = "staking";
    }
   
    //** add date next date */
    $rundate = date('Y-m-d H:i:s', strtotime($run_date . " +1 days"));

    $maturedate = date('Y-m-d H:i:s', strtotime(' +'.$days_count.' day'));

    $insert_data = array(
    "user_id" => $userid,
    "invest_amount" => $amount,
    "invest_network" => "BSC",
    "status"  => '1',
    "created_date" => date('Y-m-d H:i:s'),
    "days_count"  => $days_count,
    "profit"  => $profit,
    "run_date" => $rundate,
    "mature_date" => $maturedate,
    "type" => $type_get
    );

    $insert = $this->db->insert("user_investment",$insert_data);

    /** HISTORY INSERT */
    $deposit_data = array(
    "user_id" => $userid,
    "amount" => $amount,
    "type" => $type_get,
    "date" => date('Y-m-d'),
    "history_date" => date('Y-m-d H:i:s',strtotime($run_date)),
    "status"  => '1',
    "invest_id" => "",
    "description" => "Mining Made"
    );

    $insert = $this->db->insert("history",$deposit_data);


    $notify_data = array(
    "user_id" => $userid,
    "amount" => $amount,
    "type" => "credited",
    "date" => date('Y-m-d H:i:s',strtotime($run_date)),
    "discription" => "Reinvest Success",
    );
    $insert = $this->db->insert("notifications",$notify_data);

}


}
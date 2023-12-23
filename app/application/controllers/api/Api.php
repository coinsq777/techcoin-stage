<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    public function __construct() {

        parent::__construct();
        
        
        $this->load->model('API_Model');
        $this->load->library('api_response');

        $json_data = file_get_contents('php://input');
        $this->request_data = json_decode($json_data, true);

        $authorization_header = $this->input->get_request_header('Authorization-Wallet', TRUE);
      

        if ($authorization_header !== FALSE) {

            $this->token = $authorization_header;
        
        } else {

            $this->token = "";
        
        }
    }

    public function users_get($id = null) {

        $this->API_Model->users_get();

    }


//******************* SWAP AMOUNT ****************************//
public function get_toke_price(){
    
$currencyFrom = "usdtbep20";
$currencyTo = $this->request_data['to_currency'];
$amount = $this->request_data['amount'];
$fixed = true;
$site = true;

$url = "https://simpleswap.io/api/v3/estimates/estimated?currencyFrom={$currencyFrom}&currencyTo={$currencyTo}&amount={$amount}&fixed={$fixed}&site={$site}";

$ch = curl_init($url);
$options = array(
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => array(
        'Accept: application/json'
    )
);
curl_setopt_array($ch, $options);
$response = curl_exec($ch);

if ($response !== false) {
    $data = json_decode($response, true);
    if ($data !== null) {
        $estimatedValue = $data;
          $this->api_response->success($estimatedValue,"Price");
    } else {
        $this->api_response->error(' Error decoding JSON response', 402);
    }
} else {
       $this->api_response->error(' making cURL request', 402);
}

curl_close($ch);

}



public function update_password(){

        $wallet_id = $this->token;
        
         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
         
        $password = $this->request_data['password'];
        $c_password = $this->request_data['c_password'];
        
        if($c_password == $password) {
        
        $email = $wallet_id;
        $encrypt_password = md5($password);
        
        $data = array(
        'password' => $encrypt_password,
        'password_update' => '1'
        );
        $this->db->where('referral_id', $email);
       $result =  $this->db->update('users', $data);
          
        if ($result) {
        
        	$this->api_response->success('Password update successfully', 'success');
        
        } else {
        
        	$this->api_response->error('Password update Faild', 500);
        
        }
  
            
        } else {
            
            $this->api_response->error("Password doesn't matach ", 500);
        }
        
     
        
             
         }

}


public function check_verify(){

        $wallet_id = $this->token;
        
         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
         
         $password = $this->request_data['password'];
        
        $email = $wallet_id;
        $encrypt_password = md5($password);

        $result = $this->db->query("SELECT * FROM `users` where 
        referral_id = '".$email."' AND password = '".$encrypt_password."'
        ");

    
    if ($result->num_rows() == 1) {
    
    	$this->api_response->success('Password verify successfully', 'success');
    
    } else {
    
    	$this->api_response->error('Password verify Faild', 500);
    
    }

        
        
             
         }

}
    
    
    public function get_toke_exc(){
        
    $wallet_id = $this->token;
    $user_info = wallet_info($wallet_id); 
    
    if($user_info){
    
    $user_id = $user_info->id;
    
    
    $apiKey = '058e8159-48ab-48ad-8e36-2c13a1d0aa99';
    $currencyFrom = "usdtbep20";
    
    $currencyTo = $this->request_data['to_currency'];
    $amount = $this->request_data['amount'];
    $address_to = $this->request_data['deposit_adderss'];
   
    
    $requestData = array(
    'fixed' => true,
    'currency_from' => $currencyFrom,
    'currency_to' => $currencyTo,
    'amount' => $amount,
    'address_to' => $address_to,
    'extra_id_to' => '',
    'user_refund_address' => '',
    'user_refund_extra_id' => 'string'
    );
    
    
    $url = 'https://api.simpleswap.io/create_exchange?api_key=' . $apiKey;
    
    $ch = curl_init($url);
    $options = array(
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
    ),
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => json_encode($requestData)
    );
    
    curl_setopt_array($ch, $options);
    $response = curl_exec($ch);
    
    if ($response !== false) {
    $responseData = json_decode($response, true);
    
     $code = $responseData['code'];
      
     $sender_user = $responseData['address_from'];
    $sender_amount = $responseData['amount_from'];
    
    if( $sender_user != ""){
        
      
    
        
     if ($sender_user != "" && $sender_amount != "") {
        
    if ($responseData['currency_from'] == "usdtbep20") {
     
      
      //***************** API START **********************//
      
    $adderss_info = $this->db->query("SELECT * FROM `wallet_control` where wallet_id = '".$wallet_id."' ")->row();
    $payment_controls = $this->db->query("SELECT * FROM `payment_controls` where id = '1' ")->row();
    
    
    $address = $adderss_info->address;
    $to_addr = $sender_user;
    
    $from_addr_private_key = $adderss_info->privateKey;
    $fromAddress = $address;
    $toAddress = $to_addr;
    $privateKey = $from_addr_private_key;
    
    $Post_data = array(
    'fromAddress' => $fromAddress,
    'toAddress' => $toAddress,
    'privateKey' => $privateKey,
    'amountToSend' => $sender_amount
    );
    
    $ch = curl_init('https://front.actingdriverservice.com/send');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($Post_data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    
    if ($response === false) {
    echo 'Error: ' . curl_error($ch);
    } else {
    
     $response_get = json_decode($response);
    
    
    if($response_get['result'] > '0'){
    	
    	if($response_get['hash']){
    	
    		$this->api_response->success('Swap Transfer success', 'success');
    	
    	} else {
    	
    		$this->api_response->error('Swap Transfer Faild', 500);
    	
    	}
    
     } else {
    
     	$this->api_response->error($response_get->msg, 500);
    
     }
    
    } 
      
      
    } else { 
        
          $this->api_response->error('From Currency Error', 402);
          
    } 
    
    } else {
        
         $this->api_response->error('Invalid Adderss', 402);
        
    }
        
    } else {
        
        
        $this->api_response->error('Invalide Adderss', 402);
    
    }
   
   
    
    
    } else {
    // Handle cURL request error
      $this->api_response->error('cURL request error', 402);
    }
    
    curl_close($ch);
    
    } else { 
    
    $this->api_response->error('Invalide Wallet ID', 402);
    }
        
        
    }


    /************** CREATE WALLET */
    public function Create_Wallet(){

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
          $wallet_id = $this->request_data['wallet_id'];
          $check_wallet = $this->db->query("SELECT * FROM wallet_control where wallet_id = '".$wallet_id."' ")->num_rows();
         
          if($check_wallet <= '0'){
            $wallet_info = $this->API_Model->wallet_info($this->request_data);
          } else { 
            $this->api_response->error('Wallet ID Already Imported', 402);
          }

        } else { 
            $this->api_response->error('Invalide Method', 402);
        }


    }

     /************** CONFIRMATION WALLET */
     public function Confirmation_Wallet(){

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $wallet_info = $this->API_Model->new_wallet_verification($this->request_data);
        } else { 
            $this->api_response->error('Invalide Method', 402);
        }


    }


     /************** IMPORT WALLET */
     public function login(){

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $wallet_info = $this->API_Model->import_wallet($this->request_data);
        } else { 
            $this->api_response->error('Invalide Method', 402);
        }


    }




public function swap_limit(){
    
    $swap_limit_get = $this->db->query("SELECT * FROM `user_wallet` where id= '1' ")->row();
    $swap_limit = json_decode($swap_limit_get->swap_limit);
    
    $data = 'success';
    $message = ' Swap Token List';
    $this->api_response->success($swap_limit,$message);
         
}



public function price_get($symbol){
    
    
    $allowed_symbols = array("eth", "btc", "ltc", "xrp","dai","bnb-bsc","trx","doge","ada","shib"); 
    
    if (!in_array($symbol, $allowed_symbols)) {
    return 0; 
    } else {

    $apiKey = '058e8159-48ab-48ad-8e36-2c13a1d0aa99'; 
     $url = 'https://simpleswap.io/api/v3/estimates/estimated?currencyFrom=usdtbep20&currencyTo='.$symbol.'&amount=40&fixed=false&site=true';
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
             $get_price = $price / 40;
             } else { 
             $get_price = '0';
             }
         }
     curl_close($ch);
     
     return $get_price;
     
    }
    
}



public function price_get_all($symbol){
    
    
   

    $apiKey = '058e8159-48ab-48ad-8e36-2c13a1d0aa99'; 
     $url = 'https://simpleswap.io/api/v3/estimates/estimated?currencyFrom=usdtbep20&currencyTo='.$symbol.'&amount=40&fixed=false&site=true';
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
             $get_price = $price / 40;
             } else { 
             $get_price = '0';
             }
         }
     curl_close($ch);
     
     return $get_price;

    
}


public function testingswap(){


$maindata = [];
$nooftoken = 10;

$url1 = "https://api.simpleswap.io/get_all_currencies?api_key=058e8159-48ab-48ad-8e36-2c13a1d0aa99";

$ch = curl_init($url1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$res = json_decode(curl_exec($ch), true);
curl_close($ch);

foreach ($res as $currency) {
    $tnam = $currency['name'];
    $tsymbol = $currency['symbol'];
    $timage = $currency['image'];

    $tokurl = "https://simpleswap.io/api/v3/estimates/estimated?currencyFrom=busdbnb&currencyTo=$tsymbol&amount=$nooftoken&fixed=true&site=true";

    $ch = curl_init($tokurl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $elem = json_decode(curl_exec($ch), true);
    curl_close($ch);

    if ($elem !== null && $elem !== 0 && $elem !== "NaN") {
        $element = 1 / ($elem / 10);
        $newary = [
            "name" => $tnam,
            "logo" => $timage,
            "symbol" => $tsymbol,
            "price" => $element
        ];
        $maindata[] = $newary;
    }
}

var_dump($maindata);


}


public function swap(){
    
    $swap_limit_get = $this->db->query("SELECT * FROM `user_wallet` where id= '1' ")->row();
    $swap_limit = json_decode($swap_limit_get->swap);
    
    $data = 'success';
    $message = ' Swap Token List';
    $this->api_response->success($swap_limit,$message);

}



public function notification_get(){
    
     $currency_info = site_currency();
    $wallet_id = $this->token;
    $user_info = wallet_info($wallet_id); 
    
    if($user_info){
        
        $user_id = $user_info->id;
        $messages = $this->db->query("SELECT * from notifications where user_id = '".$user_id."' order by id desc")->result();
        
        $messages_get = array();
        if($messages){ foreach($messages as $history){
            
            $messages_get[] = array(
                "amount" => number_format($history->amount,$currency_info->decimal),
                "discription" => str_replace("Intrest","Bonus",$history->discription),
                "time" => $history->date,
                );
        }}
        
        $data['messages'] = $messages_get;
    
   
    $message = ' Notification ';
    $this->api_response->success($data,$message);
        
    } else { 
        
         $this->api_response->error('Invalide Wallet ID', 402);
    }

    
}


//************* CAPITAL WITHDRAW */
public function Capital_withdraw(){

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
        $wallet_id = $this->token;
        $user_info = wallet_info($wallet_id); 

       $withdraw = $this->db->query("SELECT * FROM `withdraw_settings` where id = '1' ")->row();
       
       $user_id = $user_info->id;

       if($user_info->status != '1'){

        $this->api_response->error('Insufficient Funds', 500);

       } else { 


        $request_amount  = $this->request_data['withdraw_amount'];
       $user_balance = capital_wallet_org($user_id);

        if($request_amount <= $user_balance){

       //********************** VERIFICATION OK  */
   
       /** HISTORY INSERT */
        $deposit_data = array(
        "user_id" => $user_id,
        "amount" => $request_amount,
        "type" => "capital_withdraw_request",
        "date" => date('Y-m-d H:i:s'),
        "history_date" => date('Y-m-d H:i:s'),
        "status"  => '0',
        "invest_id" => "",
         'hash_id'  => $hash_id,
        "description" => "Capital Withdraw Request  Successfully"
        );
        
        $insert = $this->db->insert("history",$deposit_data);
        
        if($insert){

                    
                    $data = 'success';
                    $message = ' Request Made Successfully';
                    $this->api_response->success($data,$message);


        } else {
 
      
         $this->api_response->error('Withdraw Request Made Faild', 402);

        }


        } else {

             $this->api_response->error('Invalide Balance', 402);

        }

       }


        } else { 
                
              $this->api_response->error('Wallet ID is Empty', 402);
        }

}


//************* CAPITAL WITHDRAW */
public function PostWithdraw(){
   

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
        $wallet_id = $this->token;
        $user_info = wallet_info($wallet_id); 
    
    
     if ($user_info) {
                $wallet_info = $this->API_Model->PostWithdraw($wallet_id,$this->request_data);
            } else { 
                $this->api_response->error('Wallet ID is Empty', 402);
            }
            
        } else { 
                
              $this->api_response->error('Wallet ID is Empty', 402);
        }

}



   
    //************************* TRADING PAGE */
    public function Trading(){
       
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $wallet_id = $this->token;
            
            if($wallet_id){

                $wallet_info = $this->API_Model->PostTrading($wallet_id,$this->request_data);
            
            } else {
            
                $this->api_response->error('Wallet ID is Empty', 402);
            
            }
            

        } else { 
            $this->api_response->error('Wallet ID is Empty', 402);
        }
        
    }

     //************************* TRADING PAGE */
     public function TradingForm(){
       
        $wallet_id = $this->token;
        $user_info = wallet_info($wallet_id); 
        if ($user_info) {
            $wallet_info = $this->API_Model->GetTrading($user_info);
        } else { 
            $this->api_response->error('Wallet ID is Empty', 402);
        }
        
    }
        
        
        
    //**************************** Get Mining */
   public function MiningForm(){
       
    $wallet_id = $this->token;
    $user_info = wallet_info($wallet_id);

    if ($user_info) {
        $wallet_info = $this->API_Model->GetMining($user_info);
    } else { 
        $this->api_response->error('Wallet ID is Empty', 402);
    }
    
}


        //*************************** PROFIT  */
        public function ProfitForm(){
            
            $wallet_id = $this->token;
            $user_info = wallet_info($wallet_id);

            if ($user_info) {
                $wallet_info = $this->API_Model->GetProfit($user_info);
            } else { 
                $this->api_response->error('Wallet ID is Empty', 402);
            }
            
        }
        
        
         public function ChangeStatus(){

   if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $wallet_id = $this->token;
            
            if($wallet_id){

             
            $listid = $this->request_data['investId'];
            $update_value = $this->request_data['value'];
            
            if($listid != "" && $update_value !=""){
            
            $update_data = array(
            "bot" => $update_value 
            );
            
                $message = "Update Successfully";
                $this->api_response->success($message,$message);
                
            
            }else{
                
             $this->api_response->error('Update Faild', 500);
    
            }

            
            } else {
            
                $this->api_response->error('Wallet ID is Empty', 402);
            
            }
            

        } else { 
            $this->api_response->error('Wallet ID is Empty', 402);
        }
        
     
         
        }


     //************************* TRADING PAGE */
     public function GetWallet(){
       
        $wallet_id = $this->token;
        //"IDDT5Vv3In0tRPUwMoldeO";
        //
        $user_info = wallet_info($wallet_id); 
        if ($user_info) {
            $wallet_info = $this->API_Model->GetWallet($wallet_id);
        } else { 
            $this->api_response->error('Wallet ID is Empty', 402);
        }
        
    }

       //************************* TRADING PAGE */
       public function GetDexWallet(){
       
        $wallet_id = $this->token;
        //"IDDT5Vv3In0tRPUwMoldeO";
        //
        $user_info = wallet_info($wallet_id); 
        if ($user_info) {
            $wallet_info = $this->API_Model->GetDexWallet($wallet_id);
        } else { 
            $this->api_response->error('Wallet ID is Empty', 402);
        }
        
    }


   //************************* TRADING PAGE */
       public function GetTransfer(){
       
        $wallet_id = $this->token;
      
        $user_info = wallet_info($wallet_id); 
        if ($user_info) {
            $wallet_info = $this->API_Model->PostTransfer($wallet_id,$this->request_data);
        } else { 
            $this->api_response->error('Wallet ID is Empty', 402);
        }
        
    }
    
    
    
 
    //************************* TRADING PAGE */
    public function Mining(){
       
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $wallet_id = $this->token;
            
            if($wallet_id){

                $wallet_info = $this->API_Model->PostMining($wallet_id,$this->request_data);
            
            } else {
            
                $this->api_response->error('Wallet ID is Empty', 402);
            
            }
            

        } else { 
            $this->api_response->error('Wallet ID is Empty', 402);
        }
        
    }



   //************************* Dashobard PAGE */
    public function Dashboard(){
       
            $wallet_id = $this->token;
            $currency_info = site_currency();
            
            if($wallet_id){


                
$currency_pairs = array(
    'ACH-USD',
    'ADA-USD',
    'Doge-USD',
    'FIL-USD',
    'HFT-USD',
    'IOTX-USD',
    'MASK-USD',
    'BTC-USD',  
    'ETH-USD', 
    'XRP-USD', 
);

$response_data = array();

foreach ($currency_pairs as $pair) {
    $url = "https://api.pro.coinbase.com/products/$pair/stats";

    $ch = curl_init($url);

    $headers = array(
        'Content-Type: application/json',
        'User-Agent: YourAppName/1.0'
    );

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    if ($response === false) {
        die(curl_error($ch));
    }

    curl_close($ch);

    $datas = json_decode($response, true);

    if ($datas["open"] !== "") {
        $open = floatval($datas["open"]);
        $last = floatval($datas["last"]);

        $priceChange = ($last - $open) / $open * 100;

        $link = ""; // Initialize the link variable

        switch ($pair) {
            case "ACH-USD":
                $link = "https://pancakeswap.finance/info/token/0xbc7d6b50616989655afd682fb42743507003056d?langId=en";
                break;
            case "ADA-USD":
                 $link = "https://pancakeswap.finance/info/token/0x3EE2200Efb3400fAbB9AacF31297cBdD1d435D47?langId=en";
                break;
            case "Doge-USD":
                $link = "https://pancakeswap.finance/info/token/0xba2ae424d960c26247dd6c32edc70b295c744c43?langId=en";
                break;
            case "FIL-USD":
                $link = "https://pancakeswap.finance/info/token/0x0d8ce2a99bb6e3b7db580ed848240e4a0f9ae153?langId=en";
                break;
            case "HFT-USD":
                $link = "https://pancakeswap.finance/info/token/0x186866858aef38c05829166a7711b37563e15994?langId=en";
                break;
            case "IOTX-USD":
                $link = "https://pancakeswap.finance/info/token/0x9678E42ceBEb63F23197D726B29b1CB20d0064E5?langId=en";
                break;
            case "MASK-USD":
                $link = "https://pancakeswap.finance/info/token/0x2ed9a5c8c13b93955103b9a7c167b67ef4d568a3?langId=en";
                break;
            case "BTC-USD":
            $link = "https://pancakeswap.finance/info/token/0xeAC3BBA986b2d6A242a3cFb88e97666487e6FD39?langId=en";
            break;
            case "ETH-USD":
            $link = "https://pancakeswap.finance/info/token/0x2170ed0880ac9a755fd29b2688956bd959f933f8?langId=en";
            break;
            case "XRP-USD":
            $link = "https://pancakeswap.finance/info/token/0x1D2F0da169ceB9fC7B3144628dB156f3F6c60dBE?langId=en";
            break;
            default:
                $link = "";
        }
        
        if($priceChange > 0){
         
         $symbole = "+";
         $priceChange = $symbole."".number_format($priceChange, $currency_info->decimal);
         
        } else { 
            
             $symbole = "-";
            $priceChange = number_format($priceChange, $currency_info->decimal);
        }

       
        $response_data[] = array(
            'pair' => str_replace("-USD", "", $pair),
            'last' => $last,
            'priceChange' =>$priceChange,
            'symbole'  => $symbole,
            'link' => $link
        );
    }
}

            $data['token_swap_history'] = $response_data;
          

                
                $data['sliders'] = $this->db->query("SELECT image FROM `sliders_img` where status = '1' ")->result();
                
                    
                $base_url = base_url()."assets/images/sliders/"; 
                
                foreach ($data['sliders'] as &$slide) {
                    $slide->image = $base_url . $slide->image;
                }
                
                $notification_get = $this->annoncement();

              //  $announcements = strip_tags($notification_get);
                
              
                
                 
                 
                 
                 
                 
                 
                     
       
        //1
      /*  $array = 
        ["CoinsQ Dapp Trading platformlaunch -25/10/2023",
        "CoinsQ Cloud mining farm Launch - 27/10/2023"]
        ;*/
          $get_annonce_ment =  $this->db->query("SELECT title FROM notification")->result();
        
            $titleArray = [];
            
            if(count($get_annonce_ment)>0){
        
            foreach ($get_annonce_ment as $notification_set) {
            $titleArray[] = $notification_set->title;
            }
                
            }
            
               
     
        
     $data['notifications'] = $titleArray;
            
                 
                 
                 
                 
                 
                 
                 
                 
                 $data['announcement'] = $notification_get;
                
                //str_replace("\r\n\r\n", " ", $announcements);
                
            $password_update = $this->db->query("SELECT * FROM `users` where referral_id = '".$wallet_id."' ")->row()->password_update;
                
                $data['password_update'] = $password_update == '0' ? 'pending' : 'active';
                
                //$data['page_link'] = $this->page_link();
                
              /*     $data['announcement']="Announcements - CoinsQ Dapp Trading platformlaunch-25/10/2023,  CoinsQ Cloud mining farm Launch - 27/10/2023, Official Launch of CoinsQ Blockchain (CoinsQ public chain) - 1/1/2024 CoinsQ Coin Launch -  2/01/2024,  CoinsQ Air drop Launch - 03/01/2024 to 04/01/2024,  CoinsQ coin Private Sale launch - 05/01/2024 to 06/01/2024,  CoinsQ coin Staking Announcement - 07/01/  2024,  CoinsQ blockchain community building announcement - 10/01/2024,  CoinsQ utility based Smart contract launching - 15/01/2024,  CoinsQ NON-FUNGIABLE TOKEN (NFT) Launch - 26/01/2024,  CoinsQ Public utility games launching (Phase  1) - 01/02/2024, (Phase 2) - 15/02/2024, (Phase 3) - 01/03/2024, (Phase 4) - 15/03/2024, (Phase 5) - 01/04  /2024,  CoinsQ Decentralized exchange (Trading platform) - 15/05/2024 CoinsQ Centralized and Decentralized automated robot trading platform - 02/06/2024,  CoinsQ centralized exchange (trading platform) - 01/09/2024."; */
                   
                   
                   
                 $data['Official_site']="https://techcoinsqinternational.io/api/University/";
                 $data['Trading']="https://techcoinsqinternational.io/api/Trading/";
                 $data['Staking']="https://techcoinsqinternational.io/api/Staking/";
                 $data['Games']="https://techcoinsqinternational.io/api/Game/";
                 $data['Blockchain']="https://techcoinsqinternational.io/app/style/assets/img/CoinsQ%20Blockchain.pdf";
                 $data['Affiliate_Plan']="https://techcoinsqinternational.io/app/style/assets/img/CoinsQ%20Affiliate%20Plan_A4.pdf";
                 $data['Mining']="https://techcoinsqinternational.io/app/style/assets/img/CoinsQ%20Cloud%20Mining.pdf";
                $data['Road_Map']="https://techcoinsqinternational.io/app/assets/menu/CoinsQ%20%20Road%20Map.pdf";
                $data['White_paper']="https://techcoinsqinternational.io/app/style/assets/img/CoinsQ_White_Paper.pdf";
                $data['app_version']=5.1;
                $data['app_update_msg']="This upgrade regarding Technology";
                $data['app_update_link']="https://techcoinsqinternational.io/app/";
                    $message = "Dashboard Page";
                    $this->api_response->success($data,$message);
            
            } else {
            
                $this->api_response->error('Wallet ID is Empty', 402);
            
            }

    
        
    }
    
    
    public function annoncement(){
     
    
    $get_annonce_ment =  $this->db->query("SELECT title FROM notification")->result();
    
   
    
    $titles = array_column($get_annonce_ment, 'title');
    
    
    $resultString = implode(' ', $titles);
    
    
    return $resultString;

      
    }
    
    public function page_link(){
        
        $array = [];
        
        //1
        $array[] = array(
        "Official_site" => "https://techcoinsqinternational.io/api/University/"
        );
        
        //2
        $array[] = array(
        "Trading"  => "https://techcoinsqinternational.io/api/Trading/"
        );
        
        //3
         $array[] = array(
        "Staking"  => "https://techcoinsqinternational.io/api/Staking/"
        );
        
        //4
         $array[] = array(
        "Games"  => "https://techcoinsqinternational.io/api/Game/"
        );
        
        //5
        $array[] = array(
        "Blockchain"  => "https://techcoinsqinternational.io/app/style/assets/img/CoinsQ%20Blockchain.pdf"
        );
        
        //6
        $array[] = array(
        "Affiliate_Plan"  => "https://techcoinsqinternational.io/app/style/assets/img/CoinsQ%20Affiliate%20Plan_A4.pdf"
        );
        
         //7
        $array[] = array(
        "Mining"  => "https://techcoinsqinternational.io/app/style/assets/img/CoinsQ%20Cloud%20Mining.pdf"
        );
        
          //8
        $array[] = array(
        "Road_Map"  => "https://techcoinsqinternational.io/app/assets/menu/CoinsQ%20%20Road%20Map.pdf"
        );
        
            //9
        $array[] = array(
        "White_paper"  => "https://techcoinsqinternational.io/app/style/assets/img/CoinsQ_White_Paper.pdf"
        );
        
        return $array;

    }
    
    
    
    

public function myreferals($id){
    
    //$downline = $this->User_Model->get_downlines($id);
    
       $this->db->where('sponser', $id);
        $query = $this->db->get('users');
        $downline = $query->result_array();
    
    $transaction = $this->db->query("SELECT * FROM history where user_id = '".$user_id."'
    and type = 'level_commission' order by id desc ")->result();

         $downline_info = array();
        if($downline){
        foreach($downline as $post) { 
        
        $mining_invest = $this->db->query("SELECT SUM(invest_amount) as mining_tot FROM user_investment 
        where user_id = '".$post['id']."' and type = 'mining' and status = '1' ")->row()->mining_tot;
        
        // TOTAL TRADING
        $staking_invest = $this->db->query("SELECT SUM(invest_amount) as staking_tot FROM user_investment 
        where user_id = '".$post['id']."' and type = 'staking' and status = '1' ")->row()->staking_tot;
    
    
        
       //$total_invest = $mining_invest + $staking_invest;
       
       $total_invest = $this->User_Model->Team_invest($post['id'])+$mining_invest+$staking_invest;
       
        
    $donwline_count = $this->User_Model->Down_Count($post['id']);
    
       
         $this->db->where('sponser', $post['id']);
        $query = $this->db->get('users');
        $direct_count = $query->num_rows();
       
       $downline_info[]  = array(
         "wallet_id" => $post['referral_id'],
         "register_date" => date("M d,Y", strtotime($post['register_date'])),
         "Level" => $post['level'] === 0 ? "Direct" : $post['level']." Direct",
        "trading_amount" => number_format($staking_invest,$currency_info->decimal) .' '.$currency_name,
        "mining_amount" =>number_format($mining_invest,$currency_info->decimal) .' '.$currency_name,
        "team_invest" => number_format($total_invest,$currency_info->decimal) .' '.$currency_name,
      "downline_count" => $donwline_count,
         "direct_count" => $donwline_count,
         "url" =>  base_url().'/api/Api/myreferals/'.$post['id'],
         ); 
      }
       
            
           
            
        }
        
         
            $data['downline_information'] = $downline_info;
            
              
           $this->db->where('sponser', $id);
        $query = $this->db->get('users');
        $my_direct_count = $query->num_rows();
            
        $data['my_total_m_c'] = $this->User_Model->Down_Count($id);
        $data['my_direct_m_c'] = $my_direct_count;
            
            $message = "Myreferal Page";
            $this->api_response->success($data,$message);

}

    
    
    
    
    
    
    public function myreferal()
    {
        
        
            $wallet_id = $this->token;
            
            if($wallet_id){
            
            

            $currency_info = site_currency();
            $currency_name = $currency_info->coin_name;
             
            $user_info = wallet_info($wallet_id); 
            $user_id = $user_info->id;
            
            $data['my_walletid'] = $this->db->query("SELECT * FROM users where id='".$user_id."' ")->row()->referral_id;
            
            $data['referral_url'] = base_url().'invite_id/'.$data['my_walletid'];
            
            $data['qr'] = "https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl=".base_url().'invite_id/'.$data['my_walletid'];
            

            $message = "Myreferal Page";
            $this->api_response->success($data,$message);
            
            }
    }
    
    
    public function myTeam(){
        
        $wallet_id = $this->token;
        
        $user_info = wallet_info($wallet_id); 
        $user_id = $user_info->id;
        
        $this->db->where('sponser', $user_id);
        $query = $this->db->get('users');
        $downlines = $query->result_array();
        
  
       //$this->User_Model->get_downlines($user_id);
             
        $downline_info = array();
        if($downlines){
        foreach($downlines as $post) { 
          
        
        $mining_invest = $this->db->query("SELECT SUM(invest_amount) as mining_tot FROM user_investment 
        where user_id = '".$post['id']."' and type = 'mining' and status = '1' ")->row()->mining_tot;
        
         //
        
        // TOTAL TRADING
        $staking_invest = $this->db->query("SELECT SUM(invest_amount) as staking_tot FROM user_investment 
        where user_id = '".$post['id']."' and type = 'staking' and status = '1' ")->row()->staking_tot;
    
    //
        
       //$total_invest = $mining_invest + $staking_invest;
       
       $total_invest = $this->User_Model->Team_invest($post['id'])+$mining_invest+$staking_invest;
       
       $donwline_count = $this->User_Model->Down_Count($post['id']);
       
        $this->db->where('sponser', $post['id']);
        $query = $this->db->get('users');
        $direct_count = $query->num_rows();
   
       $downline_info[]  = array(
         "wallet_id" => $post['referral_id'],
         "register_date" => date("M d,Y", strtotime($post['register_date'])),
         "Level" => $post['level'] === 0 ? "Direct" : $post['level']." Direct",
        "trading_amount" => number_format($staking_invest,$currency_info->decimal) .' '.$currency_name,
        "mining_amount" =>number_format($mining_invest,$currency_info->decimal) .' '.$currency_name,
        "team_invest" => number_format($total_invest,$currency_info->decimal) .' '.$currency_name,
         "downline_count" =>0,
          "direct_count" =>$donwline_count,
         "url" =>  base_url().'/api/Api/myreferals/'.$post['id'],
         ); 
      
       
        } } 
        
        
           $this->db->where('sponser', $user_id);
        $query = $this->db->get('users');
        $my_direct_count = $query->num_rows();

       $data['downline_information'] = $downline_info;
       $data['my_total_m_c'] = $this->User_Model->Down_Count($user_id);
       $data['my_direct_m_c'] = $my_direct_count;
       
         $message = "MyTeam Page";
        $this->api_response->success($data,$message);
    }
    
    
    
public function growth_history(){
        
        $response_data = array();
        
        $apiKey = "V41UW6DEY8B2WNG24WYXM3Z843JK5JUXEU";
        
        $contracts = array(
            "0x101d82428437127bF1608F699CD651e6Abf9766E" => "BAT",
            "0x67ee3Cb086F8a16f34beE3ca72FAD36F7Db929e2" => "DODO",
            "0xa260E12d2B924cb899AE80BB58123ac3fEE1E2F0" => "HOOK",
            "0xe2604C9561D490624AA35e156e65e590eB749519" => "GM",
            "0x5F88AB06e8dfe89DF127B2430Bba4Af600866035" => "KAVA",
            "0x724A32dFFF9769A0a0e1F0515c0012d1fB14c3bd" => "SQUAD",
            "0x08ba0619b1e7A582E0BCe5BBE9843322C954C340" => "BMON",
            "0x1bdd3Cf7F79cfB8EdbB955f20ad99211551BA275" => "BNBX",
            "0x7bd6FaBD64813c48545C9c0e312A0099d9be2540" => "ELON",
            "0xa865197A84E780957422237B5D152772654341F3" => "OLE",
            "0x7af173F350D916358AF3e218Bdf2178494Beb748" => "TRADE",
            "0x1D229B958D5DDFca92146585a8711aECbE56F095" => "ZOO",
            "0x6FDcdfef7c496407cCb0cEC90f9C5Aaa1Cc8D888" => "VET"
        );
        
        
        foreach ($contracts as $address => $token) {
            $url = "https://api.bscscan.com/api?module=account&action=txlist&address=$address&startblock=0&endblock=99999999&page=1&offset=100&sort=asc&apikey=$apiKey";
        
                        $tx_hash = $transaction['hash'];
                        $tx_url = "https://bscscan.com/address/" . $address;
        
                        $response_data[] = array(
                            'token' => $token,
                            'from' => $address,
                            'to' => "0",
                            'value' =>"0",
                            'tx_url' => $tx_url
                        );
                  
               
        }
        
          $datas['toke_growth_history'] = $response_data;
          $message = "Growth History";
            $this->api_response->success($datas,$message);
            
}
    
     //*********************** INVIDE CODE GENERTE  ***************/
     public function invite_id($Id=""){

           if($Id != ""){

            $check_user = $this->db->query("SELECT * FROM users where 
            referral_id = '".$Id."'")->row();

            if(empty($check_user)){ 
            $this->api_response->error('Invalide Page Request', 404);
            }

            $this->data["title"] = "Create Wallet ID";
            $this->data["invider"] = $Id;
            $this->load->view('users/pages/apiwallet_id',$this->data);

            } else {

                $this->api_response->error('Invalide Page Request', 404);
            } 

    }

       
       public function StartInvaiter(){
           
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                $invider_id = $this->request_data['invider_id'];
               

                if(!$invider_id){

                    $this->api_response->error('invider is Invalide', 500);
                
                } else {
                    
                $this->load->helper('string');
                $referral_id = "ID".random_string('alnum',20);

                $invider_get = $this->db->query("SELECT * FROM users where 
                referral_id = '".$invider_id."'")->row();
                
             
                if($invider_get){

                $update_referral = array(
                "referal_id" => $invider_get->id,
                "wallet_id" => $referral_id,
                "date" => date('Y-m-d H:i:s')
                );
                
              

        $new_insert =  $this->db->insert('referral_control',$update_referral);
    

                if($new_insert){

                    $data = array(
                    "myid" => $referral_id
                    );
                    
                    $messages = "Wallet Id Created Successfully";

                    $this->api_response->success($data,$messages);

                } else {
                $e = $this->db->error(); // Gets the last error that has occured
                $num = $e['code'];
                $mess = $e['message'];
                    $this->api_response->error($mess, 402);
                }

                } else {
                    
                $this->api_response->error('Invalide Inviter ID', 404);
     
                }
                }


            } else{

        $this->api_response->error('Invalide Page Request', 404);
        
        }
       }

  
  


   //************************* TRADING PAGE */
   public function GetHistory(){
       
    $wallet_id = $this->token;
    
    $user_info = wallet_info($wallet_id); 
 
    if ($user_info) {
        
    $hitory_type  = $this->input->get_request_header('history-type',TRUE);
   
   if($hitory_type == "teamearning"){
       
       $this->teamearning();
    
       
   }  else { 


  
   $user_id = $user_info->id;
  
   
   if($hitory_type == 'mining'){
  
   $title = 'Mining Earnings History';
    
   $mining_income = $this->db->query("SELECT * FROM history WHERE user_id = '".$user_id."'  
   AND (description LIKE '%Mining Interest Made%' OR description LIKE '%Mining Compounding Interest Made%')")->result();
  

   $type= "";
       
   }
   
         
   
   if($hitory_type == 'trading'){
   
    
    $title = 'Trading Earnings History';
    
    $mining_income = $this->db->query("
    SELECT * FROM history WHERE user_id = '".$user_id."'   AND (description LIKE '%Trading Interest Made%' OR description LIKE '%Trading Compounding Interest Made%')")->result();
    
    $type = "";
  
   }
    
    
   if($hitory_type == 'staking'){
       
       $title = 'Staking Earnings History';
       
       $mining_income = $this->db->query("SELECT * FROM history 
       where user_id = '".$user_id."' and type IN ('staking_intrest','staking_compounding') ")->result();

        $type = "staking";
        
    }
    
    
        
    
 

  if($hitory_type == 'mymingpool'){
    
   $title = 'My Mining Pool History';

   $mining_income = $this->db->query("SELECT * FROM user_investment 
   where user_id = '".$user_id."' and type = 'mining' and status = '1'")->result();
   
   $type = "invest_only";
   
  }



  if($hitory_type == 'mylendingpool'){


   $title = 'My Lending Pool History';
 
   $mining_income = $this->db->query("SELECT *  FROM user_investment 
   where user_id = '".$user_id."' and type = 'staking' and status = '1'  ")->result();

   $type = "invest_only";

   
}



$currency_info = site_currency();

$hisotry_message = array();

if($mining_income){ foreach($mining_income as $list) {


    if($type !="only_history" ){

        if($type == "invest_only"){

            $entry_amount = $list->invest_amount;
            
            $check_dates  = $list->starting_date;
            
            if($check_dates != ""){
            
            $entry_date = $check_dates;
            
            } else { 
            
            $entry_date = date('Y-m-d H:i:s', strtotime($list->created_date));
            $hours_to_add = 4;
            $entry_date = date('Y-m-d H:i:s', strtotime($start_date . ' +'.$hours_to_add.' hours'));
            }
            
          
            $sub_title = "Network";
        
        } else {

                $sub_title = "Investment Details";

                if($list->invest_id > 0){
                $total_invest = $this->db->query("SELECT * from user_investment where 
                id = '".$list->invest_id."' ")->row();

                $entry_amount = $list->amount;
                
                
                
            $check_dates  = $list->history_date;
            
            if($check_dates != ""){
            
            $entry_date = $check_dates;
            
            } else { 
            
            $entry_date = date('Y-m-d H:i:s', strtotime($list->date));
            $hours_to_add = 4;
            $entry_date = date('Y-m-d H:i:s', strtotime($start_date . ' +'.$hours_to_add.' hours'));

            }
                

                } else {
                $total_invest = '0';
                $entry_amount = '0';
                $entry_date = $list->history_date ? $list->history_date : $list->date;
                }

        }

      
    

    } else {

        $sub_title = "Description";
        $total_invest = $list->description;
        $entry_amount = $list->amount;
        $entry_date = $list->history_date ? $list->history_date : $list->date;
    
    }

 
    $message =  str_replace("Interest","Bonus",$list->description); 
    $message = str_replace("Made","",$message);

    
     if($type == "staking"){
    $currency_name =  $currency_info->staking_toke_name;
    } else { 
    $currency_name = $currency_info->coin_name;
    }

    
   if($type !="only_history" ){

    if($type == "invest_only"){ 

    $network =  $list->invest_network; 
    
     } else { 

    if($type == "staking"){
    $currency_name =  $currency_info->staking_toke_name;
    } else { 
    $currency_name = $currency_info->coin_name;
    }
   
   $network =  $total_invest->invest_network; 


  /* $hisotry_message[] = array(
       "discription" => $message,
       "amount" => number_format($entry_amount,$currency_info->decimal) .' '.$currency_name,
       "investment_amount" => number_format($total_invest->invest_amount,$currency_info->decimal) .' '.$currency_name,
       "network" => $network,
       "time" => $entry_date,
       ); */


 } } else {

  


}
   
    if($type == "staking"){
        
 $hisotry_message[] = array(
       "discription" => $message,
       "amount" => number_format($entry_amount,$currency_info->decimal) .' '.$currency_name,
       "investment_amount" => "",
         "network" => "",
       "time" => $entry_date,
       );
       
    } else { 
        
         $hisotry_message[] = array(
       "discription" => $message,
       "amount" => number_format($entry_amount,$currency_info->decimal) .' '.$currency_name,
       "investment_amount" => number_format($total_invest->invest_amount,$currency_info->decimal) .' '.$currency_name,
         "network" => $network,
       "time" => $entry_date,
       );
    }
       
  } } else { 
    
  
    } 

$this->api_response->success($hisotry_message,$title);
   }
   
   

        
    } else { 
        $this->api_response->error('Wallet ID is Empty', 402);
    }
    
}
    
    
    //****************************** LEVEL COMMISSION 
    public function Levels($id){
      
            
         $wallet_id = $this->token;
    
    $user_info = wallet_info($wallet_id); 
 
    if ($user_info) {
        
    $hitory_type  = $this->input->get_request_header('history-type',TRUE);
   

   if($hitory_type == "teamearning"){
       
       $this->teamearning();
       
   }   else { 


  
   $user_id = $user_info->id;
  
    
    
       $title = 'Team Earnings History';
    
       $mining_income = $this->db->query("SELECT * FROM history 
       where from_id = '".$id."'  and user_id = '".$user_id."'  and type = 'level_commission' and level_count  in ('3','1','2')  order by id desc ")->result();
       
       $type = "only_history";
    
    /*
    if($hitory_type == 'Level_2'){
    
       $title = 'Team Earnings History';
       
       $mining_income = $this->db->query("SELECT * FROM history 
       where from_id = '".$id."' and user_id = '".$user_id."' and type = 'level_commission' and level_count = '2' order by id desc ")->result();
       
       $type = "only_history";

    }
    */
    
    /*
      if($hitory_type == 'Level_1'){
    
       $title = 'Team Earnings History';

       $mining_income = $this->db->query("SELECT * FROM history  where from_id = '".$id."' and user_id = '".$user_id."'  and type = 'level_commission' and level_count = '1'  order by id desc ")->result();
       
       $type = "only_history";
    
    }
 */


$currency_info = site_currency();

$hisotry_message = array();

if($mining_income){ foreach($mining_income as $list) {


    if($type !="only_history" ){

        if($type == "invest_only"){

            $entry_amount = $list->invest_amount;
            
            $check_dates  = $list->starting_date;
            
            if($check_dates != ""){
            
            $entry_date = $check_dates;
            
            } else { 
            
            $entry_date = date('Y-m-d H:i:s', strtotime($list->created_date));
            $hours_to_add = 4;
            $entry_date = date('Y-m-d H:i:s', strtotime($start_date . ' +'.$hours_to_add.' hours'));
            }
            
          
            $sub_title = "Network";
        
        } else {

                $sub_title = "Investment Details";

                if($list->invest_id > 0){
                $total_invest = $this->db->query("SELECT * from user_investment where 
                id = '".$list->invest_id."' ")->row();

                $entry_amount = $list->amount;
                
                
                
            $check_dates  = $list->history_date;
            
            if($check_dates != ""){
            
            $entry_date = $check_dates;
            
            } else { 
            
            $entry_date = date('Y-m-d H:i:s', strtotime($list->date));
            $hours_to_add = 4;
            $entry_date = date('Y-m-d H:i:s', strtotime($start_date . ' +'.$hours_to_add.' hours'));

            }
                

                } else {
                $total_invest = '0';
                $entry_amount = '0';
                $entry_date = $list->history_date ? $list->history_date : $list->date;
                }

        }

      
    

    } else {

        $sub_title = "Description";
        $total_invest = $list->description;
        $entry_amount = $list->amount;
        $entry_date = $list->history_date ? $list->history_date : $list->date;
    
    }

 
    $message =  str_replace("Interest","Bonus",$list->description); 
    $message = str_replace("Made","",$message);

    
     if($type == "staking"){
    $currency_name =  $currency_info->staking_toke_name;
    } else { 
    $currency_name = $currency_info->coin_name;
    }

    
   if($type !="only_history" ){

    if($type == "invest_only"){ 

    $network =  $list->invest_network; 
    
     } else { 

    if($type == "staking"){
    $currency_name =  $currency_info->staking_toke_name;
    } else { 
    $currency_name = $currency_info->coin_name;
    }
   
   $network =  $total_invest->invest_network; 


  /* $hisotry_message[] = array(
       "discription" => $message,
       "amount" => number_format($entry_amount,$currency_info->decimal) .' '.$currency_name,
       "investment_amount" => number_format($total_invest->invest_amount,$currency_info->decimal) .' '.$currency_name,
       "network" => $network,
       "time" => $entry_date,
       ); */


 } } else {

  


}
   
   
 $hisotry_message[] = array(
       "discription" => $message,
       "amount" => number_format($entry_amount,$currency_info->decimal) .' '.$currency_name,
       "investment_amount" => number_format($total_invest->invest_amount,$currency_info->decimal) .' '.$currency_name,
         "network" => "BSC",
       "time" => $entry_date,
       );
       
  } } else { 
    
  
    } 

$this->api_response->success($hisotry_message,$title);
   }
      } else { 
        $this->api_response->error('Wallet ID is Empty', 402);
    }
    
           
        
    }
   
    
    

    
    public function teamearning(){
         
        $wallet_id = $this->token;
        
        $user_info = wallet_info($wallet_id); 
     
        if ($user_info) {
    
    $user_id = $user_info->id;
              
    
        
        $currency_info = site_currency();
     $currency_name = $currency_info->coin_name;
    $title = 'Team Earnings History';
  
    $mining_income = $this->db->query("SELECT * FROM history 
    where user_id = '".$user_id."' and type = 'level_commission' ")->result();
    
    $type = "only_history";
    
    //************************** SUM AMOUNT  */
    $first_level = $this->db->query("SELECT SUM(amount) as amt  
    FROM `history` where type = 'level_commission' 
    and user_id = '".$user_id."' and level_count = '1' ")->row()->amt;
    
    $second_level = $this->db->query("SELECT SUM(amount) as amt  
    FROM `history` where type = 'level_commission' 
    and user_id = '".$user_id."' and level_count = '2' ")->row()->amt;
    
    $third_level = $this->db->query("SELECT SUM(amount) as amt  
    FROM `history` where type = 'level_commission' 
    and user_id = '".$user_id."' and level_count = '3'")->row()->amt;
    
    $level_commission = $this->db->query("SELECT SUM(amount) as amt  
    FROM `history` where type = 'level_commission' 
    and user_id = '".$user_id."' ")->row()->amt;
    
    
    //************************ SHOW HISTORY */
    $first_level_tx = $this->db->query("SELECT invest_id, user_id, from_id, level_type, date,
    SUM(amount) as amt  
    FROM `history` WHERE type = 'level_commission' 
    AND user_id = '".$user_id."' 
    AND level_count = '1' 
    GROUP BY from_id")->result();
    
    
    $second_level_tx = $this->db->query("SELECT invest_id, user_id, from_id, level_type, date, 
    SUM(amount) as amt 
    FROM `history` WHERE type = 'level_commission' 
    AND user_id = '".$user_id."' 
    AND level_count = '2' 
    GROUP BY from_id")->result();
    
    
    $third_level_tx = $this->db->query("SELECT invest_id, user_id, from_id, level_type, date, 
    SUM(amount) as amt 
    FROM `history` WHERE type = 'level_commission' 
    AND user_id = '".$user_id."' 
    AND level_count = '3' 
    GROUP BY from_id")->result();
    

    $total_royal = $this->db->query("SELECT SUM(amount) as amt FROM history where type ='royal_commission' and user_id = '".$user_id."'  ")->row()->amt;

   $response_data = array();
 
 

  $currency_info = site_currency();

  $response_data['total_level_commission'] = number_format($level_commission,$currency_info->decimal) .' '.$currency_name;;
  
  $response_data['total_first_lev_commission'] = number_format($first_level,$currency_info->decimal) .' '.$currency_name;
  
  $response_data['total_second_lev_commission'] = number_format($second_level,$currency_info->decimal) .' '.$currency_name;
  
  $response_data['total_third_lev_commission'] = number_format($third_level,$currency_info->decimal) .' '.$currency_name;
  
  
  
   $response_data['total_royal'] = number_format($total_royal,$currency_info->decimal) .' '.$currency_name;
   
     $first_level_array = array();
     
   if($first_level > 0){
       
    
     if($first_level_tx){ foreach($first_level_tx as $sec_row){ 
        
    $wallet_id = $this->db->query("SELECT * FROM users where id = '".$sec_row->from_id."' ")->row()->referral_id;    
    $investment_amt = $this->db->query("SELECT * FROM user_investment where id = '".$sec_row->invest_id."' ")->row()->invest_amount;
    
    
    
    $first_level_array[] = array(
        "wallet_id" => $wallet_id,
        "amount" => number_format($sec_row->amt,$currency_info->decimal)." USDT Credited",
        "investment_amt" => number_format($investment_amt,$currency_info->decimal) .' '.$currency_name,
        "all_history_url" => base_url().'/api/Api/Levels/'.$sec_row->from_id
        );
    
   
   }
 
 $response_data['first_level_row'] =  $first_level_array;
 
$this->api_response->success($response_data,$title);
       
     } else {
         
          $this->api_response->error('Wallet ID is Empty', 402);
     }
    
 }
 
   $second_level_array = array();
   
  if($second_level > 0){
       
    
   if($second_level_tx){ foreach($second_level_tx as $sec_row){ 
    $wallet_id = $this->db->query("SELECT * FROM users where id = '".$sec_row->from_id."' ")->row()->referral_id;    
    $investment_amt = $this->db->query("SELECT * FROM user_investment where id = '".$sec_row->invest_id."' ")->row()->invest_amount;
    
    
    $second_level_array[] = array(
        "wallet_id" => $wallet_id,
        "amount" => number_format($sec_row->amt,$currency_info->decimal)." USDT Credited",
        "investment_amt" => number_format($investment_amt,$currency_info->decimal) .' '.$currency_name,
        "all_history_url" => base_url().'/api/Api/Levels/'.$sec_row->from_id
        );
    
   
   }
   
   }
   
   }
   
   $third_level_array = array();
   
  if($third_level > 0){
       
    
   if($third_level_tx){ foreach($third_level_tx as $thrd_row){ 
$wallet_id = $this->db->query("SELECT * FROM users where id = '".$thrd_row->from_id."' ")->row()->referral_id;    

$investment_amt = $this->db->query("SELECT * FROM user_investment where id = '".$thrd_row->invest_id."' ")->row()->invest_amount;
    
    
    $third_level_array[] = array(
        "wallet_id" => $wallet_id,
        "amount" => number_format($thrd_row->amt,$currency_info->decimal)." USDT Credited",
        "investment_amt" => number_format($investment_amt,$currency_info->decimal) .' '.$currency_name,
        "all_history_url" => base_url().'/api/Api/Levels/'.$thrd_row->from_id
        );
    
   
   }
   
   }
  }
  
 
 $response_data['first_level_row'] =  $first_level_array;
 $response_data['second_level_row'] =  $second_level_array;
 $response_data['third_level_row'] =  $third_level_array;
 
$this->api_response->success($response_data,$title);
       
     } else {
         
          $this->api_response->error('Wallet ID is Empty', 402);
        }
        
    }






        //*********************** INVIDE CODE GENERTE  ***************/
        public function Create_invite_id(){
       
              if($this->input->post()){

                $invider_id = $this->input->post('invider_id');

                if(!$invider_id){

                    $this->api_response->error('invider is Invalide', 500);
                
                } else {
                    
                $this->load->helper('string');
                $referral_id = "ID".random_string('alnum',20);

                $invider_get = $this->db->query("SELECT * FROM users where 
                referral_id = '".$invider_id."'")->row();

                if($referral_id){

                $update_referral = array(
                "referal_id" => $invider_get->id,
                "wallet_id" => $referral_id,
                "date" => date('Y-m-d')
                );

                $new_insert =  $this->db->insert('referral_control',$update_referral);

                if($new_insert){

                    $data = array(
                    "myid" => $referral_id
                    );

                    $this->api_response->success($data);

                } else {
             
                    $this->api_response->error('Invalide Access', 402);
                }

                }
                }


            } else{

        $this->api_response->error('Invalide Page Request', 404);
        
        }
       
       }
       
       
      //******************* Email Checking  *******************/
      public function testingmail(){
           
        $siteconfiguration = $this->Administrator_Model->get_siteconfiguration();
        $admin_mail =  $siteconfiguration[0]['contact_email'];
        $site_name =  $siteconfiguration[0]['site_name'];
        $email = 'siva1012.muthu@gmail.com';
        $wallet_id = "123456";
        
        //************************************************* WELCOME MAIL */
        $mnemonic = "test test1 test2 test3";
        $pass_data = str_replace(" ",',',$mnemonic);
        $mailid = '1';
        $mail_subject_data = $this->User_Model->getMailTemplate($mailid);
        $message  = str_replace('[FIRSTNAME]', $wallet_id, $mail_subject_data->message);
        $message  = str_replace('[PHARSE]', $pass_data, $message);
        $message  = str_replace('#adminemail',$admin_mail, $message);
        $message  = str_replace('#sitename',$site_name, $message);
        $subject = $mail_subject_data->subject;
       $email =  $this->sendmail($email, $wallet_id, $subject,$message,$admin_mail);

       }
       
       
       
       
public function chat(){
            
        $check_message = $this->db->query("SELECT * FROM chat ")->result();
        
        $wallet_id = $this->token;
        
        $user_info = wallet_info($wallet_id); 
        
        $message = array();
        
        if ($user_info) {
        
        $user_id = $user_info->id;
        
        if($check_message){ 
            
          foreach($check_message as $check_message_row){ 
              
              if($check_message_row->user_id != $user_id){ 
                  
                  
              if($check_message_row->files !=''){
              
            $message['anothers_message'] = $check_message_row->message;
     
            $message['anothers_message_file'] = base_url()."assets/images/support/".$check_message_row->files;
             
              
                } else { 

    $message['anothers_message'] = $check_message_row->message;
                         
                          
                }
            
              }
              
              
        if($check_message_row->user_id == $user_id){ 
                  
        if($check_message_row->files != ''){

        $message['my_message'] = $check_message_row->message;

        $message['my_message_file'] = base_url()."assets/images/support/".$check_message_row->files;

        }else{ 
                
         $message['my_message'] = $check_message_row->message;
                
        }
                
                    
              }
              
        
          }
                      
        $title = "Messages"; 
        $this->api_response->success($message,$title);

        }
        
        
        } else { 
              
              $this->api_response->error('Invalide Page Request', 404);
              
        }

   }
       	
	//************************************************* EMAIL FUNCTION START  */
	public function sendmail($useremail, $username, $subject, $message,$admin_mail){

	$headers = "From: $admin_mail\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=utf-8\r\n";
 $cehck_mail = 	mail($useremail, $subject, $message, $headers);
	
	if($cehck_mail){
    	    
    echo "true";

	} else { 
	
	echo "false";
	
	}
	
	
	
	$this->load->library('email', array('mailtype'=>'html'));
	$this->email->from($admin_mail,"Site");
	$this->email->to($useremail);
	$this->email->subject($subject);
	$this->email->message($message);
	
	if($this->email->send()){
	return true;
	}
	else{
	
	$headers = "From: $admin_mail\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=utf-8\r\n";
	mail($useremail, $subject, $message, $headers);
	
	return true;
	
	}
}



    //******************************************************* CREATE MULTI WALLET ID */
    public function manage_wallet_status($id){

        // $wallet_id = $this->token;

        // $user_info = wallet_info($wallet_id); 

        // if ($user_info) {

        // $user_id = $user_info->id;

        // $data['wallet_info'] = $this->mullty_wallet_added($user_id);

        // $title = "Manage  Wallet Page"; 
        // $this->api_response->success($data,$title);

        // } else { 

        //     $this->api_response->error('Invalide Wallet Id', 404);

        // }

        
        $finder_id = $this->db->query("SELECT * FROM `users` WHERE  id = '".$id."' ")->row();

        if($finder_id->sub_wallet_id > 0){

        $main_id =  $finder_id->sub_wallet_id;

       } 

        $update_status = $this->db->query("UPDATE `users` SET `prime_id` = '1' WHERE `users`.`id` = '".$id."'");

        if($update_status){

            //************ OTHER ID DEACTIVE  **********************/
            $update_status = $this->db->query("UPDATE `users` SET `prime_id` = '0' 
            WHERE `users`.`id` != '".$id."' 
            and sub_wallet_id = '".$id."'");

          
            if($main_id !=  $id){

                  //************ MAIN ID DEACTIVE  **********************/
              $update_status = $this->db->query("UPDATE `users` SET `prime_id` = '0'  WHERE `users`.`id` = '".$main_id."' ");

            }

        $title = "Manage  Wallet Status Successfully"; 
        $this->api_response->success($title,$title);
        }

    }

        //*****************************  ADD WALLET */
        public function multi_add_wallet(){

            
        $wallet_id = $this->token;
        
        //  $wallet_id = $this->input->post('Authorization-Wallet');

        $user_info = wallet_info($wallet_id); 

        if ($user_info) {

        $user_id = $user_info->id;

        $invider_id = $wallet_id;

        //********** INVIDER ID CREATE  */
        $this->load->helper('string');
        $referral_id = "ID".random_string('alnum',20);

        $invider_get = $this->db->query("SELECT * FROM users where 
        referral_id = '".$invider_id."'")->row();
     
        $update_referral = array(
        "referal_id" => $invider_get->id,
        "wallet_id" => $referral_id,
        "date" => date('Y-m-d H:i:s')
        );
        $new_insert =  $this->db->insert('referral_control',$update_referral);
        if($new_insert){

        $request_data['email'] = $user_info->email;
        $request_data['wallet_id'] = $referral_id;
        $request_data['multi_wallet'] = true;

        
        
        if($user_info->sub_wallet_id > 0){

            $request_data['sub_wallet_id'] = $user_info->sub_wallet_id;

        } else {

            $request_data['sub_wallet_id'] = $user_info->id;

        }



        $wallet_info = $this->API_Model->wallet_info($request_data);

        } else {
        $e = $this->db->error(); 
        $num = $e['code'];
        $mess = $e['message'];
        $this->api_response->error($mess, 402);
        }

        } else { 

            $this->api_response->error('Invalide Wallet Id', 404);

        }
            
        }


    //******************************************************* CREATE MULTI WALLET ID */
    public function multiwallet_info(){

        $wallet_id = $this->token;

        $user_info = wallet_info($wallet_id); 

        if ($user_info) {

        $user_id = $user_info->id;

        $data['wallet_info'] = $this->mullty_wallet_added($user_id);

        $title = "Manage  Wallet Page"; 
        $this->api_response->success($data,$title);

        } else { 

            $this->api_response->error('Invalide Wallet Id', 404);

        }


    }





    //**************************************************************** WALLET INFO  */
    public function mullty_wallet_added($id){

        $wallet_infos = $this->db->query("SELECT * FROM `users` WHERE ( sub_wallet_id = '".$id."'  OR id= '".$id."' )  ")->result();


        $wallet_adderss = array();

        if(count($wallet_infos)>0){
           
            foreach($wallet_infos as $adderss_row){

                $wallet = $this->db->query("SELECT * FROM wallet_control where wallet_id = '".$adderss_row->referral_id."' ")->row();

                if($adderss_row->prime_id == '1'){
                    $default = '1';
                } else { 
                    $default = '0';
                }

                $wallet_adderss[] = [
                    "wallet_id" => $adderss_row->referral_id,
                    "create_date" => $adderss_row->register_date,
                    "adderss" => $wallet->address,
                    "default" => $default,
                    "url" => base_url().'api/Api/manage_wallet_status/'.$adderss_row->id
                ];

            }
            
        }


        return $wallet_adderss;

    }


    //************** FINAL API TEST */
    public function final_test_user($id){


        if($id == '10'){

            $admin_payment = $this->db->query("SELECT * FROM `payment_controls` where id = '1' ")->row();
            $key = "0123456789abcdef0123456789abcdef"; 
            $iv = "0123456789abcdef"; 
    
            $api_key = $this->decryptData($admin_payment->privat_key, hex2bin($key), hex2bin($iv)); 
            $apiSecret = $this->decryptData($admin_payment->secret_key, hex2bin($key), hex2bin($iv)); 
    
            $Post_data = array(
            'apiKey' => $api_key,
            'apiSecret' => $apiSecret,
            );
    
            print_r($Post_data);

        }

    
    }
    
    
    
    
     //******************************************************* CREATE MULTI WALLET ID */
     public function adderss_transaction(){

        $wallet_id = $this->token;

        $user_info = wallet_info($wallet_id); 

        if ($user_info) {

        $user_id = $user_info->id;

        $wallet = $this->db->query("SELECT * FROM wallet_control where wallet_id = '".$wallet_id."' ")->row();
      
        $data["transaction"] = $this->transaction_get($wallet->address);

        $title = "Transaction API"; 
        $this->api_response->success($data,$title);

        } else { 

            $this->api_response->error('Invalide Wallet Id', 404);

        }


    }

    public function transaction_get($address){


         $fetch_apis = array();

      
        $apiKey = 'H9NCG5K6NNCEM7UJT4WIM6WIS785RHJGYB';

              
    $apiUrl = 'https://api.bscscan.com';
    $endpoint = '/api?module=account&action=tokentx&address=' .$address. '&apikey=' . $apiKey;
    
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiUrl . $endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        
      
    
        if ($response === false) {
        echo 'Error: ' . curl_error($ch);
        } else {
        $data = json_decode($response, true);
        
    
     if ($data['status'] == '1') {
         
        $transactions = $data['result'];
        
       

        foreach ($transactions as $transaction) {
            $from = $transaction['from'];
            $to = $transaction['to'];
            $amount = $transaction['value'] / 1000000000000000000;
            $hash = $transaction['hash'];
            $timestamp = date('Y-m-d H:i:s', $transaction['timeStamp']);

         $fetch_apis[] = array(
             "from" => $transaction['from'], 
             "to" => $transaction['to'], 
             "amount" => $amount, 
             "hash" => $hash, 
             "timestamp" => $timestamp, 
             ); 
        }
    }

        }


       return $fetch_apis;
        curl_close($ch);


    }


     //************** FINAL API TEST */
    public function decryptData($data, $key, $iv) {
        		
        $cipherText = base64_decode(substr($data, 0, -4)); 
        return openssl_decrypt($cipherText, 'aes-256-cbc', $key, 0, $iv);
    
    }
    

}

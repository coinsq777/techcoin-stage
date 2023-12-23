<?php

require_once __DIR__.'/ETH_MASTER/vendor/autoload.php';


use Web3p\EthereumWallet\Wallet;


class API_Model extends CI_Model
	{
		public function __construct()
		{
			$this->load->database();
			$this->load->library('api_response');
		
		}
		
		public function users_get($id = null) {
			if ($id) {
				$this->api_response->success($id);
			} else {
				$this->api_response->error('User not found', 404);
			}
		}

		// ********************* CREATE WALLET API *************************//
		public function wallet_info($request_data) {

				$wallet = new Wallet();
				$mnemonicLength = 12;
				$get = $wallet->generate($mnemonicLength);

				$email = $request_data['email'];
				$wallet_id = $request_data['wallet_id'];
				$password = "Admin@123";

				$insert_wallet_info = array(
				"mnemonic" => $wallet->mnemonic,
				"address" => $wallet->address,
				"privateKey" => $wallet->privateKey,
				"email" => $email,
				"encryptedJSON" => "",
				"wallet_id" => $wallet_id,
				"password" => $password,
				);

			$new_insert =  $this->db->insert('wallet_control',$insert_wallet_info);

			if($new_insert){

                $this->data['wallet_id'] = $wallet_id;
                $this->data['mnemonic'] = explode(" ", $wallet->mnemonic);
                $this->data['mnemonic_without'] =  $wallet->mnemonic;

                $wallet_infos = array(
                'wallet_id' => $wallet_id,
                'mnemonic' => explode(" ", $wallet->mnemonic),
                'mnemonic_without' => $wallet->mnemonic,
                're_email' => $email,
                're_password' => $password,
                );

                $siteconfiguration = $this->Administrator_Model->get_siteconfiguration();
                $admin_mail =  $siteconfiguration[0]['contact_email'];
                $site_name =  $siteconfiguration[0]['site_name'];

                //************************************************* WELCOME MAIL */

                $pass_data = str_replace(" ",',',$wallet->mnemonic);
                $mailid = '1';
                $mail_subject_data = $this->User_Model->getMailTemplate($mailid);
                $message  = str_replace('[FIRSTNAME]', $wallet_id, $mail_subject_data->message);
                $message  = str_replace('[PHARSE]', $pass_data, $message);
                $message  = str_replace('#adminemail',$admin_mail, $message);
                $message  = str_replace('#sitename',$site_name, $message);
                $subject = $mail_subject_data->subject;
                $this->sendmail($email, $wallet_id, $subject,$message,$admin_mail);

				 if($request_data["multi_wallet"]){
					$multiwallet_info= $request_data['sub_wallet_id'];
				 } else { 
					$multiwallet_info = '0';
				 }

				$data = array("mnemonic" => $wallet->mnemonic , "wallet_id" => $wallet_id,"prime_id"=>$multiwallet_info);
				$not_message = "Account Create Successfully";
				$this->api_response->success($data,$not_message);

            }

		}


	
		//*************************************** LOGIN IMPORT WALLET */
		public function import_wallet($request_data){
			
			$username = $request_data['username'];
			$password_get = $request_data['password'];
			
			if($username == "" || $password_get == ""){

				$this->api_response->error('Wallet Id  Or Password Is Empty', 500);

			}else{
			
		
			$encrypt_password = str_replace(','," ",$password_get);
			
			$get_user = $this->db->query("SELECT * FROM  wallet_control where wallet_id = '".$username."' and mnemonic= '".$encrypt_password."' ")->row();
			
			if($get_user){
			    
			$user_id = $this->db->query("SELECT * FROM `users` 
			where referral_id = '".$get_user->wallet_id."' ")->row();
			
			} else {
			    
			$user_id = "";
			
			}
			
			if ($user_id) {
			
			if($user_id->get_status == '0'){
			
			$user_data = array(
			'user_id' => $user_id->id,
			'username' => $username,
			'email' => $user_id->email,
			'login' => true
			);
		
			//****************** SECRITY ENTRY BRO  */
			$security_library = $this->load->library('Securityentry');
			$security_start = new Securityentry();
			$security_entry = $security_start->login_log($user_id->email,$username);
				
			$data = array("wallet_id" => $user_id->referral_id);
			$not_message = "Account Login Successfully";
			$this->api_response->success($data,$not_message);
			
			} else { 
			
			$this->api_response->error('User not found', 500);
				
			}
			
			}else{
			
			$this->api_response->error('User not found', 500);
			
			}
			
			}
			}
					
				
		//************************************** NEW WALLET CREATE */
		public function new_wallet_verification($request_data){

			$wallet_id = $request_data['wallet_id'];
			$mnemonic = $request_data['mnemonic'];
		
		
			$wallet_info = $this->db->query("SELECT * FROM wallet_control where wallet_id = '".$wallet_id."' ")->row();
		
    		
    		if($mnemonic == $wallet_info->mnemonic){
    		    
    		    $check_wallet_id = $this->db->query("SELECT * FROM users where referral_id ='".$wallet_id."'")->num_rows();
    		   
    		   if($check_wallet_id <= 0){
    		       
    		    $sponser = $this->db->query("SELECT * FROM referral_control where wallet_id = '".$wallet_id."' ")->row()->referal_id;
    			
    			$email = $wallet_info->email;
    			$user_adderss = $wallet_info->address;
    		
    			$encrypt_password = md5($wallet_info->password);
    
    			$data = array(
    			'name' => 'test', 
    			'email' => $email,
    			'contact' =>'111111111',
    			'password' => $encrypt_password,
    			'username' => 'test',
    			'zipcode' => 'test',
    			'sponser' => $sponser,
    			'referral_id' => $wallet_id,
    			'status'   => '1',
    			'wallet_id'   => $wallet_info->id,
				"sub_wallet_id" => $request_data["prime_id"]
    			);
    			$this->db->insert('users', $data);
    			$lastInsertId = $this->db->insert_id();
    
    			//***************************************************** REGISTER EMAIL  */
    			$username = $wallet_id;
    			$link = base_url().'user/login';
    			$useremail = $email;
    			
    			$siteconfiguration = $this->Administrator_Model->get_siteconfiguration();
    			$admin_mail =  $siteconfiguration[0]['contact_email'];
    			$site_name =  $siteconfiguration[0]['site_name'];
    
    			//************************************************* WELCOME MAIL */
    	
            $pass_data = str_replace(" ",',',$wallet_info->mnemonic);
            $mailid = '1';
            $mail_subject_data = $this->User_Model->getMailTemplate($mailid);
            $message  = str_replace('[FIRSTNAME]', $wallet_id, $mail_subject_data->message);
            $message  = str_replace('[PHARSE]', $pass_data, $message);
            $message  = str_replace('#adminemail',$admin_mail, $message);
            $message  = str_replace('#sitename',$site_name, $message);
            $subject = $mail_subject_data->subject;
            $this->sendmail($email, $wallet_id, $subject,$message,$admin_mail);
            
            

    			$data = array("wallet_adderss" => $user_adderss , "wallet_id" => $wallet_id);
    			$not_message = "Backup Successfully";
    			$this->api_response->success($data,$not_message);
    		       
    		   } else { 
    		    
    		     $this->api_response->error('Wallet ID Already Exits', 402);
    		     
    		   }
    
    			
    		} else { 
    		 
    		     $this->api_response->error('Invalide Order Pls Check..', 402);
    		     
    		}
		
			
		}
		
		
	
	
	//************************** START TRADING BRO  */
	public function GetTrading($user_info){
	
		$user_id = $user_info->id;
	
		$tradin_info = $this->db->query("SELECT * FROM lending_settings where id = '1' ")->row();
		$data['title'] = "Trading";
		
		$user_balance = $this->user_balance($user_info);
		
		 $duration_get = explode(",",$tradin_info->duration); 
        
        
        $data['trading_info'] = array(
        "user_balance" => $user_balance,
        "daily_yeild" => $tradin_info->le_interest,
        "staking_bonus" => $tradin_info->staking_interest,
        "duration" => $duration_get
        );

			
        $currency_info = site_currency();
        $trading_list_get = array();
        $trading_list = $this->db->query("SELECT * FROM user_investment 
        where user_id = '".$user_id."' and type='staking' ORDER BY id DESC ")->result();
        
        
        
		
		$mining_config = $this->db->query("SELECT * FROM lending_settings where id = '2' ")->row();   
		
		if($trading_list){
			
			foreach($trading_list as $trading){
			    
        
        $stared_dates  = $trading->starting_date;
        $ended_dates  = $trading->ending_date;
        
        $daily_interest_call = $tradin_info->le_interest + $tradin_info->staking_interest;
        
        if($stared_dates != ""){
        
        $start_date = $stared_dates;
        
        } else { 
        
        $start_date = date('Y-m-d H:i:s', strtotime($trading->created_date));
        $hours_to_add = 4;
        $start_date = date('Y-m-d H:i:s', strtotime($start_date . ' +'.$hours_to_add.' hours'));
        }
        
        if($ended_dates != ""){
        
        $end_date = $ended_dates;
        
        } else { 
        
        $end_date = date('Y-m-d H:i:s', strtotime($trading->mature_date));
        $hours_to_add = 4;
        $end_date = date('Y-m-d H:i:s', strtotime($end_date . ' +'.$hours_to_add.' hours'));
        }

			
			$trading_list_get[] = array(
				
				 "investId" => $trading->id,
				"amount" => $currency_info->currency_symbol.' '.number_format($trading->invest_amount,$currency_info->decimal).' '.$currency_info->coin_name,
				"network" => $trading->invest_network,
				"link" => "https://bscscan.com/tx/".$trading->hash_id,
				"hash" => $trading->hash_id ? substr($trading->hash_id, 0, 10) : "" ,
				"days" => $trading->days_count,
				"interest" =>number_format($daily_interest_call,1),
				"trading_on" => $start_date,
				"trading_end" => $end_date,
				"package_status" => $trading->status=='1' ? 'active' : 'mature',
				"reinvest_status" => $trading->bot =='1' ? 'active' : 'cancel'
				);
				
			}
			
		}
		
		 $data['trading_list'] = $trading_list_get;
		$not_message = "Trading Page";
		$this->api_response->success($data,$not_message);
	
		}	
	
	public function user_balance($user_info){

	
		$token = $user_info->referral_id;
		$adderss_info = $this->db->query("SELECT * FROM `wallet_control` where wallet_id = '".$token."' ")->row();
		$address = $adderss_info->address;

		$Post_data = array(
		'address' => $address,
		);

	   $ch = curl_init('https://api.techcoinsqinternational.io/get_balances');
	 	curl_setopt($ch, CURLOPT_POST, 1);
	 	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($Post_data));
	 	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
	 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	 	$response = curl_exec($ch);
	 	curl_close($ch);

	 	if ($response === false) {
	 	return 0;
	 	} else {
		
	 		$response_get = json_decode($response);

	 		if($response_get){
				
	 			return $response_get;
		
	 		} else {

             
            $array = array("usdt_balance"=>'0',"bnb_balance"=>'0');
            return $array;

	 		}
	 }


}


	//************************** START TRADING BRO  */
public function PostTrading($wallet_id,$request_data){

		$amount = $request_data['amount'];
		$network = 'BEP20';
		$days_count = $request_data['days_count'];
		$user_info = wallet_info($wallet_id);


		$user_id = $user_info->id;

	
		
		if($days_count == "" || $days_count <= 0){

			$this->api_response->error('Days Count Invalide', 500);
        
		} else {
		    
		if($amount % 50 != 0){

			$this->api_response->error('Please enter a valid amount (50, 100, 150, or a multiple of 50).', 500);
			
		} else {
		    
		    
		if($user_info) {
		  
			$adderss_info = $this->db->query("SELECT * FROM `wallet_control` where wallet_id = '".$wallet_id."' ")->row();
			$payment_controls = $this->db->query("SELECT * FROM `payment_controls` where id = '1' ")->row();
			
			
			$address = $adderss_info->address;
			$to_addr = $payment_controls->wallet_adderss;
			
			$from_addr_private_key = $adderss_info->privateKey;
			$fromAddress = $address;
			$toAddress = $to_addr;
			$privateKey = $from_addr_private_key;

			$Post_data = array(
			'fromAddress' => $fromAddress,
			'toAddress' => $toAddress,
			'privateKey' => $privateKey,
			'amountToSend' => $amount
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


				if($response_get->result > '0'){
					
					if($response_get->hash){
					
					$tradind = $this->tradingverify($amount,$user_id,$network,$days_count,$response_get->hash);
					
					} else {
					
						$this->api_response->error('Trading Failed Please contact administrator', 500);
					
					}
			
			 	} else {

			 		$this->api_response->error($response_get->msg, 500);

			 	}

			 }

	
		} else { 

			$this->api_response->error('User not found', 500);

		}
		
		    
		}
		
		    
		}

	  

	}


	
        //******************************** TRADING VERIFICATION  */
        public function tradingverify($deposit_amount,$user_id,$network,$days_count,$web_mode){
			
            $profit = '1';

			$rundate = date('Y-m-d', strtotime(' +1 day'));
			$maturedate = date('Y-m-d', strtotime(' +'.$days_count.' day'));
			$ending_date =  date('Y-m-d H:i:s', strtotime(' +'.$days_count.' day'));
	
			$insert_data = array(
			"user_id" => $user_id,
			"invest_amount" => $deposit_amount,
			"invest_network" => $network,
			"status"  => '1',
			"created_date" => date('Y-m-d'),
			"days_count"  => $days_count,
			"profit"  => $profit,
			"hash_id" => $web_mode,
			"run_date" => $rundate,
			"mature_date" => $maturedate,
			 "starting_date" => date('Y-m-d H:i:s'),
			"ending_date" => $ending_date,
			"type" => "staking"
			);
		 
			$insert = $this->db->insert("user_investment",$insert_data);
	
			/** HISTORY INSERT */
			$deposit_data = array(
			"user_id" => $user_id,
			"amount" => $deposit_amount,
			"type" => "staking",
			"date" => date('Y-m-d'),
			"status"  => '1',
			"hash_id" => $web_mode,
			"history_date" => date('Y-m-d H:i:s'),
			"invest_id" => "",
			"description" => "Trading Made"
			);
	
			$insert = $this->db->insert("history",$deposit_data);
	
			if($insert){
	
			$data = array("wallet_id" => $wallet_id);
			$not_message = "Trading Successfully";
			$this->api_response->success($data,$not_message);
		  
			} else {
	
			$json = array("message" => 'Invalide Request Pls contact administator..');
			echo json_encode($json);
	
			}
			
	
	}
	
	
     public function GetMining($user_info){
	
		$user_id = $user_info->id;
	
		$tradin_info = $this->db->query("SELECT * FROM lending_settings where id = '2' ")->row();
		$data['title'] = "Mining";
		
		$user_balance = $this->user_balance($user_info);
		$duration_get = explode(",",$tradin_info->duration); 
		
		$data['mining_info'] = array(
			"user_balance" => $user_balance,
			"daily_yeild" => $tradin_info->le_interest,
			"staking_bonus" => $tradin_info->staking_interest,
			"duration" => $duration_get
			);

		$currency_info = site_currency();
		$trading_list_get = array();

		$trading_list = $this->db->query("SELECT * FROM user_investment 
		where user_id = '".$user_id."' and type='mining' ORDER BY id DESC ")->result();

		$mining_config = $this->db->query("SELECT * FROM lending_settings where id = '1' ")->row();   

		if($trading_list){

		foreach($trading_list as $trading){

  
        $daily_interest_call = $tradin_info->le_interest + $tradin_info->staking_interest;
        
		$stared_dates  = $trading->starting_date;
		$ended_dates  = $trading->ending_date;

		if($stared_dates != ""){

		$start_date = $stared_dates;

		} else { 

		$start_date = date('Y-m-d H:i:s', strtotime($trading->created_date));
		$hours_to_add = 4;
		$start_date = date('Y-m-d H:i:s', strtotime($start_date . ' +'.$hours_to_add.' hours'));
		}

		if($ended_dates != ""){

		$end_date = $ended_dates;

		} else { 

		$end_date = date('Y-m-d H:i:s', strtotime($trading->mature_date));
		$hours_to_add = 4;
		$end_date = date('Y-m-d H:i:s', strtotime($end_date . ' +'.$hours_to_add.' hours'));
		}


		$trading_list_get[] = array(

        "investId" => $trading->id,
		"amount" => $currency_info->currency_symbol.' '.number_format($trading->invest_amount,$currency_info->decimal).' '.$currency_info->coin_name,
		"network" => $trading->invest_network,
		"link" => "https://bscscan.com/tx/".$trading->hash_id,
		"hash" => $trading->hash_id ? substr($trading->hash_id, 0, 10) : "" ,
		"days" => $trading->days_count,
    	"interest" =>number_format($daily_interest_call,1),
		"trading_on" => $start_date,
		"trading_end" => $end_date,
		"package_status" => $trading->status=='1' ? 'active' : 'mature',
		"reinvest_status" => $trading->bot =='1' ? 'active' : 'cancel'
		);

		}

		}

	  $data['mining_list'] = $trading_list_get;


		
		$not_message = "Mining Page";
		$this->api_response->success($data,$not_message);
	
		}
		
		
		
		
		//************************** START TRADING BRO  */
	public function PostMining($wallet_id,$request_data){

		$amount = $request_data['amount'];
		$network = 'BEP20';
		$days_count = $request_data['days_count'];
		$user_info = wallet_info($wallet_id);


		$user_id = $user_info->id;

	
		
		if($days_count == "" || $days_count <= 0){

			$this->api_response->error('Days Count Invalide', 500);
        
		} else {
		    
		      if($amount % 2000 != 0){

				$this->api_response->error('Please enter a valid amount (2000, 4000, 6000, or a multiple of 2000).', 500);
			
		} else {
		    
		    
		if($user_info) {
		  
			$adderss_info = $this->db->query("SELECT * FROM `wallet_control` where wallet_id = '".$wallet_id."' ")->row();
			
			$payment_controls = $this->db->query("SELECT * FROM `payment_controls` where id = '1' ")->row();
			
			$address = $adderss_info->address;
			$to_addr = $payment_controls->wallet_adderss;
			
			$from_addr_private_key = $adderss_info->privateKey;
			$fromAddress = $address;
			$toAddress = $to_addr;
			$privateKey = $from_addr_private_key;

			$Post_data = array(
			'fromAddress' => $fromAddress,
			'toAddress' => $toAddress,
			'privateKey' => $privateKey,
			'amountToSend' => $amount
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
		   
			 //	$response_get = json_encode($response);
			 	
			 	
			 	
                $response_get = json_decode($response);
                
                
                if($response_get->result > '0'){
                
                if($response_get->hash){
                   
					    
			$tradind = $this->Miningverify($amount,$user_id,$network,$days_count,$response_get->hash);
					    	
					}else{
					    
					$this->api_response->error('Mining Failed Please contact administrator', 500);
					}
			
			 	} else {

			 		$this->api_response->error($response_get->msg, 500);

				}

			 }

		//	$tradind = $this->Miningverify($amount,$user_id,$network,$days_count,"TestHash");

	
		} else { 

			$this->api_response->error('User not found', 500);

		}
		
		    
		}
		
		    
		}

	  

	}

	
		
        //******************************** TRADING VERIFICATION  */
        public function Miningverify($deposit_amount,$user_id,$network,$days_count,$web_mode){
			
            $profit = '1';

			$rundate = date('Y-m-d', strtotime(' +1 day'));
			$maturedate = date('Y-m-d', strtotime(' +'.$days_count.' day'));
			$ending_date =  date('Y-m-d H:i:s', strtotime(' +'.$days_count.' day'));
	

			$insert_data = array(
			"user_id" => $user_id,
			"invest_amount" => $deposit_amount,
			"invest_network" => $network,
			"status"  => '1',
			"created_date" => date('Y-m-d'),
			"days_count"  => $days_count,
			"profit"  => $profit,
			"hash_id" => $web_mode,
			"run_date" => $rundate,
			"starting_date" => date('Y-m-d H:i:s'),
			"ending_date" => $ending_date,
			"mature_date" => $maturedate,
			"type" => "mining"
			);
			$insert = $this->db->insert("user_investment",$insert_data);


			/** HISTORY INSERT */
			$deposit_data = array(
			"user_id" => $user_id,
			"amount" => $deposit_amount,
			"type" => "mining",
			"history_date" => date('Y-m-d H:i:s'),
			"date" => date('Y-m-d'),
			"status"  => '1',
			"hash_id" => $web_mode,
			"invest_id" => "",
			"description" => "Mining Made"
			);
			$insert = $this->db->insert("history",$deposit_data);
	
			if($insert){
	
			$data = array("wallet_id" => $wallet_id);
			$not_message = "Mining Successfully";
			$this->api_response->success($data,$not_message);
		  
			} else {
	
			$json = array("message" => 'Invalide Request Pls contact administator..');
			echo json_encode($json);
	
			}
			
	
	}



	//****************8 GetProfit */
	public function GetProfit($user_info){
$currency_info = site_currency();

	if($user_info){
		
        $user_id = $user_info->id;
        $this->data['title'] = "Profit Page";
         
        $mining_sub_income = $this->db->query("SELECT SUM(amount) as sub FROM history where 
        type = 'compounding' and   description like '%Mining Compounding Interest Made%' and  user_id = '".$user_id."'  
        ")->row()->sub;
        
        $mining_income_get = $this->db->query("SELECT SUM(amount) as mining FROM history 
        where user_id = '".$user_id."' and type = 'intrest' and 
        description like '%Mining Interest Made%' ")->row()->mining + $mining_sub_income;
        $data['mining_income'] = $mining_income_get ? number_format($mining_income_get,$currency_info->decimal) : 0;

        // STAKING EARNING
        $staking_income_get =  $this->db->query("SELECT SUM(amount) as staking FROM history 
        where user_id = '".$user_id."' and type in ('staking_intrest','staking_compounding') ")->row()->staking; 
        $data['staking_income'] = $staking_income_get ?  number_format($staking_income_get,$currency_info->decimal) : 0;

        // TRADING EARNING
        $tading_sub_income = $this->db->query("SELECT SUM(amount) as sub FROM history where type = 'compounding' and  description like '%Trading Compounding Interest Made%' and  user_id = '".$user_id."' 
        ")->row()->sub;

        $trading_income_get = $this->db->query("SELECT SUM(amount) as trading FROM history 
        where user_id = '".$user_id."' and type = 'intrest' and 
        description like '%Trading Interest Made%' ")->row()->trading + $tading_sub_income;
        
        $data['trading_income'] = $trading_income_get  ? number_format($trading_income_get,$currency_info->decimal) : 0;

      
        // TOTAL EARNING
        $total_earnings_get =  $this->db->query("SELECT SUM(amount) as total_income FROM history 
        where user_id = '".$user_id."' and type IN ('intrest','level_commission','compounding','royal_commission')  ")->row()->total_income; 
        
        $data['total_earnings'] = $total_earnings_get ? number_format($total_earnings_get,$currency_info->decimal) : 0;
        

        // TOTAL MINING
        $mining_pool = $this->db->query("SELECT SUM(invest_amount) as mining_tot FROM user_investment 
        where user_id = '".$user_id."' and type = 'mining'  and status = '1' ")->row()->mining_tot;
        
      /*  echo $this->db->last_query();
        exit(); */
        
        $data['mining_pool'] = $mining_pool ? number_format($mining_pool,$currency_info->decimal) : 0;

      //  TOTAL TRADING
      $trading_pool_get = $this->db->query("SELECT SUM(invest_amount) as staking_tot 
        FROM user_investment 
        where user_id = '".$user_id."' 
        and type = 'staking' and status = '1' ")->row()->staking_tot;
        $data['trading_pool'] = $trading_pool_get ? number_format($trading_pool_get,$currency_info->decimal) :"0";

$total_minin_volume =  $this->update_team($user_id,'mining_invest');

        $data['total_mining_volume'] = number_format($total_minin_volume,$currency_info->decimal);
        // STAKING INCOME 
        $total_staking_volume = "0";
        //$this->update_team($user_id,'staking_invest');

   $data['total_staking_volume'] = number_format($total_staking_volume,$currency_info->decimal);

        // TRADING EARNING
        $total_trading_volume = $this->update_team($user_id,'trading');
        $data['total_trading_volume'] = number_format($total_trading_volume,$currency_info->decimal);

        // TEAM EARNINGS
        $total_team_income_get = $this->db->query("SELECT SUM(amount) as total_income FROM history 
        where user_id = '".$user_id."' and type = 'level_commission' ")->row()->total_income; 
        $data['total_team_income'] = $total_team_income_get ? number_format($total_team_income_get,$currency_info->decimal) : 0;
        //$this->total_invest($user_id,'team_income');
        
        
        $total_mining_vols = $this->update_team($user_id,'mining_invest');
        $total_trads_val = $this->update_team($user_id,'trading');
        
        $total_invs = $total_mining_vols + $total_trads_val;
        // TEAM EARNINGS
        $data['total_team_invest'] = number_format($total_invs,$currency_info->decimal);
        
     //   $this->data['total_mining_volume'] + $this->data['total_trading_volume'];

		$not_message = "Profit Page";
		$this->api_response->success($data,$not_message);

	} else {

		$this->api_response->error('Invalide User', 500);

	}

	}
	
	
	

	  //************** UPDATE TEAM VALUE **************/
	  public function update_team($userid,$type){

		$downlines = $this->User_Model->get_downlines($userid);
		
	
	
			$amount = 0;
	
			if(!empty($downlines)) { 
	
			foreach($downlines as $user_id){
	
			//********************* MINING INVEST */
			if($type=="mining_invest"){
	
			$amount_get = $this->db->query("SELECT SUM(invest_amount) as mining_tot FROM user_investment 
			where user_id = '".$user_id['id']."' and type = 'mining' and status = '1' ")->row()->mining_tot;
	
			$get_amount = $amount_get ? $amount_get : "0";
			
			
					$get_amount = $amount_get ? $amount_get : "0";
			
		
		
			$amount +=$get_amount;
	
			}
	
			//********************* MINING INVEST */
			if($type=="staking_invest"){
	
			$amount_get = $this->db->query("SELECT SUM(amount) as total_income FROM history 
			where user_id = '".$user_id['id']."' and  type = 'staking_intrest'  ")->row()->total_income;
	
			$get_amount = $amount_get ? $amount_get : "0";

			$amount +=$get_amount;
	
			}
	
			//******************** TOTAL TRADING */
			if($type == "trading"){
	
			$amount_get = $this->db->query("SELECT SUM(invest_amount) as mining_tot FROM user_investment 
			where user_id = '".$user_id['id']."' and type = 'staking' and status = '1'  ")->row()->mining_tot;
			
		$get_amount = $amount_get ? $amount_get : "0";
	
	     	$amount +=$get_amount;
	
			}
	
			//*****************  TOTAL TEAM INCOME */
			if($type == "team_income"){
	
			$amount_get = $this->db->query("SELECT SUM(amount) as trading FROM history 
			where user_id = '".$user_id['id']."' and type = 'intrest' ")->row()->trading;
	
			$get_amount = $amount_get ? $amount_get : "0";
			$amount +=$get_amount;
	
			}
	
	
			}
	
			return $amount;
	
			} else { 
	
			return $amount;
			}
	
	
			
		}
		
		
		
	//**************** GetWallet */
	public function GetWallet($wallet_id){

		$user_info = wallet_info($wallet_id);
	
$currency_info = site_currency();

		if($user_info){
			
			$user_id = $user_info->id;
			$not_message = "Wallet Page";
			$staking_bal = $this->db->query("SELECT SUM(amount) as staking FROM history 
			where user_id = '".$user_id."' and type IN ('staking_intrest','staking_compounding') ")->row()->staking;
			
			$data['wallet_balance'] = user_wallet($user_id) ? number_format(user_wallet1($user_id),$currency_info->decimal) : "0";
			$data['staking_balance'] = $staking_bal ? number_format($staking_bal,$currency_info->decimal) : "0" ;
			$data['capital_balance'] = capital_wallet($user_id) ? number_format(capital_wallet_org($user_id),$currency_info->decimal) : "0" ;
			
        $data['site_withdraw'] =  $this->db->query("SELECT * FROM history where type = 'site_withdraw'
and user_id = '".$user_id."' order by id DESC ")->result();

// Loop through the result and replace null values with empty strings
foreach ($data['site_withdraw'] as &$withdraw) {
    foreach ($withdraw as $key => $value) {
        if ($value === null) {
            $withdraw->$key = ""; // Set null values to empty string
        }
    }
}


        $data['capital_withdraw'] =  $this->db->query("SELECT *,
       CASE
           WHEN type = 'capital_withdraw_request' THEN 'pending'
           ELSE 'active'
       END AS action_status
FROM `history`
WHERE type IN ('capital_withdraw_request', 'capital_withdraw')
and user_id = '".$user_id."' order by id DESC ")->result();



// Loop through the result and replace null values with empty strings
foreach ($data['capital_withdraw'] as &$cwithdraw) {
    foreach ($cwithdraw as $key => $value) {
        if ($value === null) {
            $cwithdraw->$key = ""; // Set null values to empty string
        }
    }
}

        
			$this->api_response->success($data,$not_message);
	
		} else {
	
			$this->api_response->error('Invalide User', 500);
	
		}
	
		}
	
		
	//**************** GetDexWallet */
	public function GetDexWallet($wallet_id){

		$user_info = wallet_info($wallet_id);
	
		if($user_info){
			
			$user_id = $user_info->id;
			$not_message = "Dex Wallet Page";

			$adderss_info = $this->db->query("SELECT * FROM `wallet_control` where wallet_id = '".$wallet_id."' ")->row();

			$user_address = array(
				"usdt_adderss" => $adderss_info->address,
				"qr"           => "https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl=".$adderss_info->address,
				"bnb_adderss" => $adderss_info->address
			);

			$data['user_balance'] = $this->user_balance($user_info);
			$data['user_adderss'] = $user_address;

			$this->api_response->success($data,$not_message);
	
		} else {
	
			$this->api_response->error('Invalide User', 500);
	
		}
	
		}


		//************************** START TRADING BRO  */
		public function PostTransfer($wallet_id,$request_data){

			$amount = $request_data['amount'];
			$to_adderss = $request_data['to_adderss'];
			
			$user_info = wallet_info($wallet_id);
	
			$user_id = $user_info->id;
	
	
	     if($to_adderss !=""){
			
				if($amount > 0 ){
			
			
				if($user_info) {
	
					$adderss_info = $this->db->query("SELECT * FROM `wallet_control` where wallet_id = '".$wallet_id."' ")->row();
					$address = $adderss_info->address;
					$to_addr = $to_adderss;
					$from_addr_private_key = $adderss_info->privateKey;
					$fromAddress = $address;
					$toAddress = $to_addr;
					$privateKey = $from_addr_private_key;
			
					$Post_data = array(
					'fromAddress' => $fromAddress,
					'toAddress' => $toAddress,
					'privateKey' => $privateKey,
					'amountToSend' => $amount
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
			
					 	if($response_get->result > '0'){
							
							$data  = "Transfer Success";
				        $not_message  = "Transfer Success";
			     		    $this->api_response->success($data,$not_message);
			
			
				 	} else {
			
				$this->api_response->error('Trading Failed Please contact administrator', 500);
			
					}
			
					}

					//$this->api_response->success($data,$not_message);
			
					} else { 
			
					$this->api_response->error('User not found', 500);
			
					}
	
	
	     } else { 
	      
	         		$this->api_response->error('Please Enter Amount', 500);
	
	
	     }
	     
			} else {
				
	         	$this->api_response->error('Please Enter Address', 500);
			
			}
			
	
			}




	//************************** START TRADING BRO  */
		public function PostWithdraw($wallet_id,$request_data){

		 	 $amount = $request_data['withdraw_amount'];
			 $user_info = wallet_info($wallet_id);
	
			 $user_id = $user_info->id;

			 if($user_info->status != '1'){

				$this->api_response->error('Insufficient Funds', 500);

			 } else {

					if($amount > 0 ){
						
						if($user_info) {

						$withdraw = $this->db->query("SELECT * FROM `withdraw_settings` where id = '1' ")->row();

						$admin_payment = $this->db->query("SELECT * FROM `payment_controls` where id = '1' ")->row();

						$request_amount  = $request_data['withdraw_amount'];
						$user_balance = user_wallet1($user_id);
					
						$min_amount  = $withdraw->min_withdraw;
						$max_amount  = $withdraw->max_withdraw;
						
						$withdraw_fee  = $withdraw->withdraw_fee;

						if($withdraw_fee > 0){

						$withdraw_fee_get = $request_amount * $withdraw_fee / 100;

						} else { 
							
							$withdraw_fee_get = 0;
						}
					
						if($request_amount >= $min_amount && $request_amount <= $max_amount){
					
							if($request_amount <= $user_balance){

						$adderss_info = $this->db->query("SELECT * FROM `wallet_control` 
						where wallet_id = '".$wallet_id."' ")->row();

						$key = "0123456789abcdef0123456789abcdef"; // Same key as used for encryption
						$iv = "0123456789abcdef"; // Same IV as used for encryption


						$address = $adderss_info->address;
						$api_key = $this->decryptData($admin_payment->privat_key, hex2bin($key), hex2bin($iv)); 
						$apiSecret = $this->decryptData($admin_payment->secret_key, hex2bin($key), hex2bin($iv)); 

						$Post_data = array(
						'apiKey' => $api_key,
						'apiSecret' => $apiSecret,
						'address' => $address,
						'amount' => $amount - $withdraw_fee_get
						);
					

						$ch = curl_init('https://front.actingdriverservice.com/send_withdraw');
						curl_setopt($ch, CURLOPT_POST, 1);
						curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($Post_data));
						curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
						$response = curl_exec($ch);
						curl_close($ch);
				

						if ($response === false) {
					$this->api_response->error("Invalide Request", 500);
						} else {
				
				
							$response_get = json_decode($response);
						

							if($response_get->result > '0'){

							$hash_id = $response_get->message;
						

							if($hash_id != ""){
				
							/** HISTORY INSERT */
								$deposit_data = array(
								"user_id" => $user_id,
								"amount" => $request_amount,
								"type" => "site_withdraw",
								"date" => date('Y-m-d H:i:s'),
								"history_date" => date('Y-m-d H:i:s'),
								"status"  => '1',
								"invest_id" => "",
								'hash_id'  => $hash_id,
								"description" => "Site Withdraw Made Successfully"
								);
								$insert = $this->db->insert("history",$deposit_data);


								$notify_data = array(
								"user_id" => $user_id,
								"amount" => $request_amount,
								"type" => "debited",
								"date" => date('Y-m-d H:i:s'),
								"discription" => "Withdraw Made Success",
								);
								$insert = $this->db->insert("notifications",$notify_data);


								/** HISTORY INSERT */
								$deposit_data = array(
								"user_id" => $user_id,
								"amount" => $withdraw_fee_get,
								"type" => "withdraw_fee",
								"date" => date('Y-m-d H:i:s'),
								"history_date" => date('Y-m-d H:i:s'),
								"status"  => '1',
								"invest_id" => "",
								"description" => "Withdraw Fee"
								);
								$insert = $this->db->insert("history",$deposit_data);

								if($insert){

								$data  = "Withdraw Success";
								$not_message  = "Withdraw Success";
								$this->api_response->success($data,$not_message);

								} else {

								$this->api_response->error('WIthdraw Process Failed', 500);

								}
				
						} else {
								$this->api_response->error('WIthdraw Process Failed', 500);
						}
						
				
						} else {
				
						$this->api_response->error($response_get->message, 500);
				
						}
				
						}
					
					
							} else {
					
								$this->api_response->error('Invalide Balance', 500);
							}
					
					
						} else { 
					
							$this->api_response->error('Please Check Min And Max Amount', 500);
						}
					
						} else { 
				
						$this->api_response->error('User not found', 500);
				
						}


					} else {
						
						$this->api_response->error('Please enter a valid amount Or Check Transfer Adderss', 500);

					}

				}
				
				
			}
		
		
		public function decryptData($data, $key, $iv) {
        		
            $cipherText = base64_decode(substr($data, 0, -4)); 
            return openssl_decrypt($cipherText, 'aes-256-cbc', $key, 0, $iv);

		
		}
		
		
	//************************************************* EMAIL FUNCTION START  */
	public function sendmail($useremail, $username, $subject, $message,$admin_mail){

	$headers = "From: $admin_mail\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=utf-8\r\n";
	mail($useremail, $subject, $message, $headers);
	
	return true;
	
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


	}
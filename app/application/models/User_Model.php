<?php
	class User_Model extends CI_Model{
		public function register($encrypt_password,$sponser,$referral_id){

			$data = array('name' => $this->input->post('name'), 
						  'email' => $this->input->post('email'),
						  'contact' => $this->input->post('phone'),
						  'password' => $encrypt_password,
						  'username' => $this->input->post('name'),
						  'zipcode' => $this->input->post('zipcode'),
						  'sponser' => $sponser,
						  'referral_id' => $referral_id,
						  'status' => '1'
						  );

			return $this->db->insert('users', $data);
		}

		public function login($username, $encrypt_password){
			//Validate

			$result = $this->db->query("SELECT * FROM `users` where 
			name = '".$username."' AND password = '".$encrypt_password."'
			");

			if ($result->num_rows() == 1) {
				return $result->row();
			}else{

		$result_1 = $this->db->query("SELECT * FROM `users` where 
		email = '".$username."' AND password = '".$encrypt_password."'
		");

		if ($result_1->num_rows() == 1) {
			return $result_1->row();
		}else{


		$result_2 = $this->db->query("SELECT * FROM `users` where 
		contact = '".$username."' AND password = '".$encrypt_password."'
		");

		if ($result_2->num_rows() == 1) {
			return $result_2->row();
		}else{
		
		return false;

		}

				}

				
				
			}


		

		}




public function Down_Count($userid){

	$downlines = $this->get_downlines($userid);
	
		$amount = 0;
	
		if(!empty($downlines)) { 
	
		foreach($downlines as $user_id){
	
		$get_amount = 1;
		$amount +=$get_amount;
	
		}
	
		return $amount;
	
		} else { 
	
		return $amount;
		}
	
				
	
	}
	
public function Team_invest($userid){

$downlines = $this->get_downlines($userid);

	$amount = 0;

	if(!empty($downlines)) { 

	foreach($downlines as $user_id){


	$amount_get = $this->db->query("SELECT SUM(invest_amount) as mining_tot FROM user_investment 
	where user_id = '".$user_id['id']."' and type IN ('mining','staking') and status = '1' ")->row()->mining_tot;

	$get_amount = $amount_get ? $amount_get : "0";

	$amount +=$get_amount;

	}

	return $amount;

	} else { 

	return $amount;
	}

			

}

		// Check Username exists
		public function check_username_exists($username){
			$query = $this->db->get_where('users', array('username' => $username));

			if(empty($query->row_array())){
				return true;
			}else{
				return false;
			}
		}

		
		// Check Userphone exists
		public function check_userphone_exists($username){
			$query = $this->db->get_where('users', array('contact' => $username));

			if(empty($query->row_array())){
				return true;
			}else{
				return false;
			}
		}

		// Check email exists
		public function check_email_exists($email){
			$query = $this->db->get_where('users', array('email' => $email));

			if(empty($query->row_array())){
				return true;
			}else{
				return false;
			}
		}

		/** GET EMAIL TEMPLATE */
		public function getMailTemplate($id){

         	$query = $this->db->query("SELECT * FROM email_template where id = '".$id."' ")->row();
			
			return $query;
		
		
		}


    
    //********************** GET MY DOWNLINES  */
    public function get_downlines($user_id, $level = 0) {
    	$downlines = array();
    	
    	// Get all direct downlines for the user
    	$this->db->where('sponser', $user_id);
    	$query = $this->db->get('users');
    	$direct_downlines = $query->result_array();
    	
    	if ($direct_downlines) {
    		foreach ($direct_downlines as $downline) {
    			$downline['level'] = $level;
    			$downline['downline_count'] = $this->get_downline_count($downline['id']);
    			$downlines[] = $downline;
    			
    			$downlines = array_merge($downlines, $this->get_downlines($downline['id'], $level + 1));
    		}
    	}
    	
    	return $downlines;
    }
    
    
    public function get_downline_count($user_id) {
    
    	$this->db->where('sponser', $user_id);
    	$query = $this->db->get('users');
    	return $query->num_rows();
    
    }


	//**************** live_currency  */
	public function live_currency($coin_id,$amount){

	$currency_info = $this->db->query("SELECT * FROM assets_controller where asset_id = '".$coin_id."' ")->row();

	if($currency_info){

	$currency = $currency_info->coin_symbol;
	$currency1 = "USD";

	if($currency=="USDTTRC"){
	$currency = "USDT";  
	}

	$url = "https://min-api.cryptocompare.com/data/price?fsym=".$currency1."&tsyms=".$currency."&api_key=1b6ed52ef6a6416c1acc3095b52ac90f83e26dd35edd72f95c225795dcc38a67";

	$price = $this->live_price_get($url,$currency);

	if($price > 0){

	$invest_amount = $price * $amount;

	} else {


	$invest_amount = $amount;
	}

	return $invest_amount;

	}

	}


	public function live_price_get($url,$currency){


	$curl = curl_init();

	curl_setopt_array($curl, [
	CURLOPT_URL => $url,
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	]);

	$response = curl_exec($curl);


	// Check for errors
	if ($response === false) {
	die('Error: ' . curl_error($curl));
	}

	// Close the cURL session
	curl_close($curl);

	// Parse the response JSON
	$data = json_decode($response, true);
	
	// Extract the token price from the response
	$tokenPrice = $data[$currency];
	
	return $tokenPrice;
	}

	}
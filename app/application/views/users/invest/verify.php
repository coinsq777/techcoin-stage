<!doctype html>
<html lang="en">

<!-- /*****************************  INCLUDE STYLE *************************************/ -->
<?php $this->load->view('users/common_style');?>
<!-- /*****************************  INCLUDE STYLE *************************************/ -->


<body class="d-flex flex-column h-100 sidebar-pushcontent theme-pink" data-theme="theme-pink">

<!-- /*****************************  INCLUDE STYLE *************************************/ -->
<?php $this->load->view('users/user_header');?>
<!-- /*****************************  INCLUDE STYLE *************************************/ -->


<main class="main vh-100 cq_white_bg">

<!-- Begin page content -->
<div class="container-fluid h-100">
<div class="row h-100 ">

<style>
  .modal{
      z-index:2 !important;
  }
  .modal-backdrop{
      z-index:-1 !important;
  }
</style>

<!-- //*************** HEADER */ -->
<?php 
$currency_info = site_currency();
$this->load->view('users/login_header');
?>
<!-- //********************** HEADER OUT */ -->


<div class="col position-relative page-content">
<!-- content page -->

<div class="row justify-content-center">
<div class="col-12 col-md-11 col-lg-11 col-xxl-9 page-content-inr">



<div class="col position-relative page-content">
<div class="row justify-content-center h-100">


<!-- //************* VERFIY ALERT NOTES */ -->

<div class="cq_report_card cq_comn_card">
<div class="srk srk_fs_1dot4 srk_fw_500 srk_clr_black_1 mb_1dot5">
<?php echo $title; ?>
</div>

<div class="row mt-4 ">
<div class="col-6">
<div class="srk srk_clr_black_07 srk_fs_0dot8 srk_fw_400 srk_mb_0dot7">
Investment Amount
</div>
<div class="srk srk_clr_black_1 srk_fs_1dot1 srk_fw_600 ">
<?php echo $currency_info->currency_symbol; ?>     
<?php echo number_format($deposit_amount,$currency_info->decimal); ?> 
<?php echo $currency_info->coin_name; ?> 
</div> 

</div>
<div class="col-6 text-end">
<div class="srk srk_clr_black_07 srk_fs_0dot8 srk_fw_400 srk_mb_0dot7">
Daily Profit
</div>
<div class="srk srk_clr_black_1 srk_fs_1dot1 srk_fw_600 ">

<?php echo $mining_config->le_interest + $mining_config->staking_interest; ?> %

</div>

</div>

<div class="col-6 mt-4">
<div class="srk srk_clr_black_07 srk_fs_0dot8 srk_fw_400 srk_mb_0dot7">
Duration
</div>

<div class="srk srk_clr_black_1 srk_fs_1dot1 srk_fw_600 ">
<?php echo $duration; ?> Days
</div>

</div>
<div class="col-6 text-end mt-4">
<div class="srk srk_clr_black_07 srk_fs_0dot8 srk_fw_400 srk_mb_0dot7">
Network
</div>

<div class="srk srk_clr_black_1 srk_fs_1dot1 srk_fw_600 "><?php echo $network; ?>  </div>

</div>
</div>

<input type="hidden" name="deposit_amount" id="deposit_amount" value="<?php echo $deposit_amount ?>" />
<input type="hidden" name="network" id="network"  value="<?php echo $network ?>" />
<input type="hidden" name="days_count" id="days_count"  value="<?php echo $duration; ?>" />
<input type="hidden" name="profit"  id="profit"  value="<?php echo $mining_config->le_interest + $mining_config->staking_interest; ?>">

<input type="hidden"  name="balance_info_trx" id="balance_info_trx"  value="" />
<input type="hidden"  name="balance_info_bsc" id="balance_info_bsc"  value="" />
<input type="hidden"  name="balance_info_busd" id="balance_info_busd"  value="" />


<button type="button" class="cq_comn_btn w-100 mt-4 mb-5" >Submit</button>

<form action="<?php echo $action; ?>" method = "POST" >
</form>

</div>

<!-- //************* VERFIY ALERT NOTES */ -->

</div>
</div>
</div>
<!-- content page ends -->
</div>


<!-- Modal -->
<div class="modal fade"  id="exampleModal" 
tabindex="-1" 
aria-labelledby="exampleModalLabel" 
aria-hidden="true">

  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Enter Password </h5>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" 
        aria-label="Close"> X </button>
      </div>

        <!-- <form action="<?php echo $action; ?>" method = "POST" > -->

        <div class="modal-body">
        <div class="scqc_wt_inp_set lin_box">


        <input type="password"     
        class="scqc_wt_inp_input" 
        id="password"  
        name="verify_password"   
        data-fv-field="current"  
        requried
        placeholder="**************"
        minlength="8"
        placeholder="Enter Password" required/>
<!-- 
        <input type="hidden" name="deposit_amount" id="deposit_amount" value="<?php echo $deposit_amount ?>" />
        <input type="hidden" name="network" id="network"  value="<?php echo $network ?>" />
        <input type="hidden" name="days_count" id="days_count"  value="<?php echo $duration; ?>" />
        <input type="hidden" name="profit"  id="profit"  value="<?php echo $mining_config->le_interest + $mining_config->staking_interest; ?>">
        <input type="hidden"  name="balance_info_trx" id="balance_info_trx"  value="" />
        <input type="hidden"  name="balance_info_bsc" id="balance_info_bsc"  value="" /> -->

        </div>
        </div>
        <div class="modal-footer">
        <button type="submit"  class="cq_comn_btn w-100 mt-4 mb-5">Verify</button>
        </div>

        </form>


    </div>
  </div>
</div>

<div class="col-12 mt-0 footer-sht">

<!-- footer sticky bottom -->
<?php $this->load->view('users/login_footer');?>
<!-- footer sticky bottom ends -->


</div>

</div>
</div>

</main>


<!-- /*****************************  INCLUDE FOOTER *************************************/ -->
<?php $this->load->view('users/common_script');?>
<!-- /*****************************  INCLUDE FOOTER *************************************/ -->

<!-- /*****************************  INCLUDE WEB 3 SCRIPT FOLDER ************************/ -->
<?php $this->load->view('users/web3');?>
<!-- /*****************************  INCLUDE WEB 3 SCRIPT FOLDER *************************/ -->


</body>




<script>

$(document).ready(function() {

   //******************** DEPOSIT BALANCE HISTORY **********************/
    <?php if($network == "BSC"){ ?>
      checkbalanceBNB();
      <?php } ?>

    <?php if($network == "TRX"){ ?>
      checkbalanceTRX();
    <?php } ?>

    <?php if($network == "BUSD"){ ?>
      checkbalanceBUSD();
    <?php } ?>


  $('form').on('submit', function(e){
      e.preventDefault();
    
      
    <?php if($network == "BSC"){ ?>
      DepositBNB();
    <?php } ?>

    <?php if($network == "TRX"){ ?>
      sendTRX();
    <?php } ?>
    
    <?php if($network == "BUSD"){ ?>
      sendBUSD();
    <?php } ?>

  });

});


async function checkbalanceTRX() {

var walletAddress = '<?php echo $trx_address; ?>';

const contractAddress = 'TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t';
const url = `https://apilist.tronscan.org/api/account?address=${walletAddress}&includeToken=true`;

try {
    const response = await fetch(url, { headers: { "accept": "application/json" } });
    const data = await response.json();

    if ('error' in data) {
        throw new Error(`Error: ${data['error']}`);
    } else {
        let usdtBalance = null;
        for (const token of data['trc20token_balances']) {
            if (token['tokenName'] === 'Tether USD') {
                usdtBalance = (parseFloat(token['balance']) * Math.pow(10, -token['tokenDecimal'])).toFixed(6);
                break;
            }
        }

        if (usdtBalance !== null) {
            console.log(`USDT TRC20 balance in ${walletAddress}: ${usdtBalance}`);
            $('#balance_info_trx').val(usdtBalance); 
        } else {
            console.log(`USDT TRC20 token not found in ${walletAddress}`);
            $('#balance_info_trx').val('0'); 
        }
    }
} catch (error) {
    console.error(error);
}
}



//***************** CHECK BNB USDT BALANCE INFORMATION  *******
async function checkbalanceBUSD(){

var holderAddress = '<?php echo $address; ?>';

var web3 = new Web3();
var http_url = 'https://bsc-dataseed.binance.org/';
web3.setProvider(new web3.providers.HttpProvider(http_url));

var abiJson = [{"inputs":[],"payable":false,"stateMutability":"nonpayable","type":"constructor"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"owner","type":"address"},{"indexed":true,"internalType":"address","name":"spender","type":"address"},{"indexed":false,"internalType":"uint256","name":"value","type":"uint256"}],"name":"Approval","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"previousOwner","type":"address"},{"indexed":true,"internalType":"address","name":"newOwner","type":"address"}],"name":"OwnershipTransferred","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"from","type":"address"},{"indexed":true,"internalType":"address","name":"to","type":"address"},{"indexed":false,"internalType":"uint256","name":"value","type":"uint256"}],"name":"Transfer","type":"event"},{"constant":true,"inputs":[],"name":"_decimals","outputs":[{"internalType":"uint8","name":"","type":"uint8"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"_name","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"_symbol","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"internalType":"address","name":"owner","type":"address"},{"internalType":"address","name":"spender","type":"address"}],"name":"allowance","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"approve","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"internalType":"address","name":"account","type":"address"}],"name":"balanceOf","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"burn","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"decimals","outputs":[{"internalType":"uint8","name":"","type":"uint8"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"subtractedValue","type":"uint256"}],"name":"decreaseAllowance","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"getOwner","outputs":[{"internalType":"address","name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"addedValue","type":"uint256"}],"name":"increaseAllowance","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"mint","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"name","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"owner","outputs":[{"internalType":"address","name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[],"name":"renounceOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"symbol","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"totalSupply","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"recipient","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"transfer","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"sender","type":"address"},{"internalType":"address","name":"recipient","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"transferFrom","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"newOwner","type":"address"}],"name":"transferOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"}];

const busdAddress = "0xe9e7CEA3DedcA5984780Bafc599bD69ADd087D56";

const contract = new web3.eth.Contract(abiJson, busdAddress);
const balance = await contract.methods.balanceOf(holderAddress).call();
var before_bal = balance / 1000000000000000000;

if(before_bal > 0){

    $('#balance_info_busd').html(before_bal);

} else { 

    $('#balance_info_busd').html('0');

}

}


//***************** CHECK BNB USDT BALANCE INFORMATION  *******
async function checkbalanceBNB(){

var holderAddress = '<?php echo $address; ?>';

var web3 = new Web3();
var http_url = 'https://bsc-dataseed.binance.org/';
web3.setProvider(new web3.providers.HttpProvider(http_url));

var abiJson = [{"inputs":[],"payable":false,"stateMutability":"nonpayable","type":"constructor"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"owner","type":"address"},{"indexed":true,"internalType":"address","name":"spender","type":"address"},{"indexed":false,"internalType":"uint256","name":"value","type":"uint256"}],"name":"Approval","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"previousOwner","type":"address"},{"indexed":true,"internalType":"address","name":"newOwner","type":"address"}],"name":"OwnershipTransferred","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"from","type":"address"},{"indexed":true,"internalType":"address","name":"to","type":"address"},{"indexed":false,"internalType":"uint256","name":"value","type":"uint256"}],"name":"Transfer","type":"event"},{"constant":true,"inputs":[],"name":"_decimals","outputs":[{"internalType":"uint8","name":"","type":"uint8"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"_name","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"_symbol","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"internalType":"address","name":"owner","type":"address"},{"internalType":"address","name":"spender","type":"address"}],"name":"allowance","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"approve","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"internalType":"address","name":"account","type":"address"}],"name":"balanceOf","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"burn","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"decimals","outputs":[{"internalType":"uint8","name":"","type":"uint8"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"subtractedValue","type":"uint256"}],"name":"decreaseAllowance","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"getOwner","outputs":[{"internalType":"address","name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"addedValue","type":"uint256"}],"name":"increaseAllowance","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"mint","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"name","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"owner","outputs":[{"internalType":"address","name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[],"name":"renounceOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"symbol","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"totalSupply","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"recipient","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"transfer","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"sender","type":"address"},{"internalType":"address","name":"recipient","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"transferFrom","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"newOwner","type":"address"}],"name":"transferOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"}];

const busdAddress = "0x55d398326f99059fF775485246999027B3197955";
//const holderAddress = "0x8894e0a0c962cb723c1976a4421c95949be2d4e3";

const contract = new web3.eth.Contract(abiJson, busdAddress);
const balance = await contract.methods.balanceOf(holderAddress).call();
var before_bal = balance / 1000000000000000000;

$('#balance_info_bsc').val(before_bal); 


}



 //*********************** DEPOSIT AMOUNT BNB */
 function DepositBNB(){

$('.loader-wrap').css('display','block');
var from = '<?php echo $address; ?>';
var private_add =  '<?php echo $sec_key; ?>';
var destAddress = '<?php echo $admin_adderss; ?>';

var web3 = new Web3();
var http_url = 'https://bsc-dataseed.binance.org/';
var toekns = "0x55d398326f99059fF775485246999027B3197955";  

/**TEST NET */
<!--var toekns = "0x8d008B313C1d6C7fE2982F62d32Da7507cF43551";-->
<!--var http_url = 'https://data-seed-prebsc-1-s1.binance.org:8545/';-->

var abi_key = '[{"inputs":[],"payable":false,"stateMutability":"nonpayable","type":"constructor"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"owner","type":"address"},{"indexed":true,"internalType":"address","name":"spender","type":"address"},{"indexed":false,"internalType":"uint256","name":"value","type":"uint256"}],"name":"Approval","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"previousOwner","type":"address"},{"indexed":true,"internalType":"address","name":"newOwner","type":"address"}],"name":"OwnershipTransferred","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"from","type":"address"},{"indexed":true,"internalType":"address","name":"to","type":"address"},{"indexed":false,"internalType":"uint256","name":"value","type":"uint256"}],"name":"Transfer","type":"event"},{"constant":true,"inputs":[],"name":"_decimals","outputs":[{"internalType":"uint8","name":"","type":"uint8"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"_name","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"_symbol","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"internalType":"address","name":"owner","type":"address"},{"internalType":"address","name":"spender","type":"address"}],"name":"allowance","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"approve","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"internalType":"address","name":"account","type":"address"}],"name":"balanceOf","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"burn","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"decimals","outputs":[{"internalType":"uint8","name":"","type":"uint8"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"subtractedValue","type":"uint256"}],"name":"decreaseAllowance","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"getOwner","outputs":[{"internalType":"address","name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"addedValue","type":"uint256"}],"name":"increaseAllowance","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"mint","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"name","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"owner","outputs":[{"internalType":"address","name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[],"name":"renounceOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"symbol","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"totalSupply","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"recipient","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"transfer","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"sender","type":"address"},{"internalType":"address","name":"recipient","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"transferFrom","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"newOwner","type":"address"}],"name":"transferOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"}]';
//var abi_key = '[{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"owner","type":"address"},{"indexed":true,"internalType":"address","name":"spender","type":"address"},{"indexed":false,"internalType":"uint256","name":"value","type":"uint256"}],"name":"Approval","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"delegator","type":"address"},{"indexed":true,"internalType":"address","name":"fromDelegate","type":"address"},{"indexed":true,"internalType":"address","name":"toDelegate","type":"address"}],"name":"DelegateChanged","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"delegate","type":"address"},{"indexed":false,"internalType":"uint256","name":"previousBalance","type":"uint256"},{"indexed":false,"internalType":"uint256","name":"newBalance","type":"uint256"}],"name":"DelegateVotesChanged","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"previousOwner","type":"address"},{"indexed":true,"internalType":"address","name":"newOwner","type":"address"}],"name":"OwnershipTransferred","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"from","type":"address"},{"indexed":true,"internalType":"address","name":"to","type":"address"},{"indexed":false,"internalType":"uint256","name":"value","type":"uint256"}],"name":"Transfer","type":"event"},{"inputs":[],"name":"DELEGATION_TYPEHASH","outputs":[{"internalType":"bytes32","name":"","type":"bytes32"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"DOMAIN_TYPEHASH","outputs":[{"internalType":"bytes32","name":"","type":"bytes32"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"owner","type":"address"},{"internalType":"address","name":"spender","type":"address"}],"name":"allowance","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"approve","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"account","type":"address"}],"name":"balanceOf","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"","type":"address"},{"internalType":"uint32","name":"","type":"uint32"}],"name":"checkpoints","outputs":[{"internalType":"uint32","name":"fromBlock","type":"uint32"},{"internalType":"uint256","name":"votes","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"decimals","outputs":[{"internalType":"uint8","name":"","type":"uint8"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"subtractedValue","type":"uint256"}],"name":"decreaseAllowance","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"delegatee","type":"address"}],"name":"delegate","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"delegatee","type":"address"},{"internalType":"uint256","name":"nonce","type":"uint256"},{"internalType":"uint256","name":"expiry","type":"uint256"},{"internalType":"uint8","name":"v","type":"uint8"},{"internalType":"bytes32","name":"r","type":"bytes32"},{"internalType":"bytes32","name":"s","type":"bytes32"}],"name":"delegateBySig","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"delegator","type":"address"}],"name":"delegates","outputs":[{"internalType":"address","name":"","type":"address"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"account","type":"address"}],"name":"getCurrentVotes","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"getOwner","outputs":[{"internalType":"address","name":"","type":"address"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"account","type":"address"},{"internalType":"uint256","name":"blockNumber","type":"uint256"}],"name":"getPriorVotes","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"addedValue","type":"uint256"}],"name":"increaseAllowance","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"_to","type":"address"},{"internalType":"uint256","name":"_amount","type":"uint256"}],"name":"mint","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"mint","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[],"name":"name","outputs":[{"internalType":"string","name":"","type":"string"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"","type":"address"}],"name":"nonces","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"","type":"address"}],"name":"numCheckpoints","outputs":[{"internalType":"uint32","name":"","type":"uint32"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"owner","outputs":[{"internalType":"address","name":"","type":"address"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"renounceOwnership","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[],"name":"symbol","outputs":[{"internalType":"string","name":"","type":"string"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"totalSupply","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"recipient","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"transfer","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"sender","type":"address"},{"internalType":"address","name":"recipient","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"transferFrom","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"newOwner","type":"address"}],"name":"transferOwnership","outputs":[],"stateMutability":"nonpayable","type":"function"}]';

web3.setProvider(new web3.providers.HttpProvider(http_url));

var contractAddress = toekns.toLowerCase();
var chainId = '56';
var buy_amount = $("#deposit_amount").val();
var transferAmount1 = buy_amount;

var myAddress = from.toLowerCase();
var totak_transferAmount = buy_amount;
var abiArray = JSON.parse(abi_key);
var myBalance  = '20000';


if (parseFloat(totak_transferAmount) <= parseFloat(myBalance)) {

    contract_deduct(http_url, contractAddress, myAddress, private_add, destAddress, transferAmount1, abiArray, chainId);

} else {

$('.loader-wrap').css('display','none');
    $('#with_submit').prop('disabled', false);
    $.notify('<i class="fa fa-spinner" aria-hidden="true"></i> <strong>ERROR:</strong>  Insufficient Balance ... ', 'error');

}

}


  //**************************************************************************** WITHDRAW WITHDRAW  */
  async function contract_deduct(http_url, contractAddress, myAddress, private_add, destAddress, transferAmount1, abiArray, chainId) {

  var abi_key = '[{"inputs":[],"payable":false,"stateMutability":"nonpayable","type":"constructor"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"owner","type":"address"},{"indexed":true,"internalType":"address","name":"spender","type":"address"},{"indexed":false,"internalType":"uint256","name":"value","type":"uint256"}],"name":"Approval","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"previousOwner","type":"address"},{"indexed":true,"internalType":"address","name":"newOwner","type":"address"}],"name":"OwnershipTransferred","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"from","type":"address"},{"indexed":true,"internalType":"address","name":"to","type":"address"},{"indexed":false,"internalType":"uint256","name":"value","type":"uint256"}],"name":"Transfer","type":"event"},{"constant":true,"inputs":[],"name":"_decimals","outputs":[{"internalType":"uint8","name":"","type":"uint8"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"_name","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"_symbol","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"internalType":"address","name":"owner","type":"address"},{"internalType":"address","name":"spender","type":"address"}],"name":"allowance","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"approve","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"internalType":"address","name":"account","type":"address"}],"name":"balanceOf","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"burn","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"decimals","outputs":[{"internalType":"uint8","name":"","type":"uint8"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"subtractedValue","type":"uint256"}],"name":"decreaseAllowance","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"getOwner","outputs":[{"internalType":"address","name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"addedValue","type":"uint256"}],"name":"increaseAllowance","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"mint","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"name","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"owner","outputs":[{"internalType":"address","name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[],"name":"renounceOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"symbol","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"totalSupply","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"recipient","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"transfer","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"sender","type":"address"},{"internalType":"address","name":"recipient","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"transferFrom","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"newOwner","type":"address"}],"name":"transferOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"}]';
    var abiArray = JSON.parse(abi_key);

  var http_url = 'https://bsc-dataseed.binance.org/';
  var toekns = "0x55d398326f99059fF775485246999027B3197955";  
  var contractAddress = toekns.toLowerCase();
  var from = '<?php echo $address; ?>';
  var myAddress = from.toLowerCase();
  var private_add =  '<?php echo $sec_key; ?>';
  var buy_amount = $("#deposit_amount").val();
  var transferAmount1 = buy_amount;
  var chainId = '56';
  

  var web3 = new Web3();

  var  destAddress = '<?php echo $admin_adderss; ?>';

  if(destAddress == ""){
    alert("destAddress is Null");
  }

  var check_adderss = web3.utils.isAddress(destAddress);

  if (check_adderss) {
  

  $.notify('<i class="fa fa-spinner" aria-hidden="true"></i> <strong>success:</strong> Pls Wait Account Verification... ', 'success');
 
  var contractAddress = contractAddress;
  var myAddress = myAddress;

 
  var transferAmount = transferAmount1;

  web3.setProvider(new web3.providers.HttpProvider(http_url));

  var contract = new web3.eth.Contract(abiArray, contractAddress, {
  from: myAddress
  });

    var balance = await contract.methods.balanceOf(myAddress).call();
    var before_bal = balance / 1000000000000000000;

    console.log("before_bal "+before_bal);
    console.log("transferAmount1 "+transferAmount1);

    if (transferAmount1 <= before_bal) {

        var count = await web3.eth.getTransactionCount(myAddress);
        var price = '0x098bca5a00';
        var limit = web3.utils.toHex(54154); 

      
         var transferAmount = web3.utils.toWei(transferAmount1, 'ether');
        //Math.floor(transferAmount1 * 1e18).toString();
        var paymentsaddress = destAddress;
        var withdrawamount = transferAmount1; 


        if (paymentsaddress == "" || withdrawamount == "" ) {

        if (paymentsaddress == "") {
        
  $('.loader-wrap').css('display','none');
            $.notify('<i class="fa fa-spinner" aria-hidden="true"></i> <strong>ERROR:</strong>  Please Check Payment Adderss... ', 'error');
        }

        if (withdrawamount == "") {
        
        
  $('.loader-wrap').css('display','none');
            $.notify('<i class="fa fa-spinner" aria-hidden="true"></i> <strong>ERROR:</strong>  Please Check Dedutedamount Is Not Empty... ', 'error');
        }

        } else {

    try{
          var rawTransaction = {

              "from": myAddress,
              "nonce": "0x" + count.toString(16),
               "gasPrice": '0x12A05F200',
              "gasLimit": limit,
              "to": contractAddress,
              "value": "0x0",
              "data": contract.methods.transfer(destAddress, transferAmount).encodeABI(),
              "chainId": chainId

          };

            $.notify('<i class="fa fa-spinner" aria-hidden="true"></i> <strong>success:</strong> Last stage Verification . Pls Wait Payment Requesting... ', 'success');

            console.log('Raw of Transaction: \n' + JSON.stringify(rawTransaction, null, '\t') + '------------------------');

          //   <!--let privateKey = new EthJS.Buffer.Buffer(private_add, 'hex');-->
          //  <!--let privateKey = new EthJS.Buffer.Buffer(private_add.slice(2), 'hex');-->
          //  <!-- let tx = new EthJS.Tx(rawTransaction, { chain: 'bsc' });-->
          //   <!--let tx = new EthJS.Tx(rawTransaction, { chain: 'ropsten' });-->

          
          let privateKey = new EthJS.Buffer.Buffer(private_add.slice(2), 'hex');
          let tx = new EthJS.Tx(rawTransaction, { chain: 'bsc' });


           tx.sign(privateKey);

            var serializedTx = tx.serialize();

            console.log('Attempting to send signed tx:' + serializedTx.toString('hex'));

            var receipt = await web3.eth.sendSignedTransaction('0x' + serializedTx.toString('hex'));

            console.log('Receipt info:' + JSON.stringify(receipt));

            balance = await contract.methods.balanceOf(myAddress).call();

            console.log('Balance after send:' + balance / 1000000000000000000);

            if (receipt['transactionHash']) {

                $.notify('<i class="fa fa-spinner" aria-hidden="true"></i> <strong>success:</strong> Payment has been added successfully to your crypto wallet. <strong>Thank You </strong>', 'success');
                

                    var deposit_amount =  $('#deposit_amount').val();
                    var network =  $('#network').val();
                    var days_count =  $('#days_count').val();

                $.ajax({
                    type: "post",
                    dataType:"json",
                    url: "<?php echo $action; ?>",
                    data: {
                            deposit_amount: deposit_amount,
                            paymentsaddress: paymentsaddress,
                            network: network,
                            web_mode: receipt['transactionHash'],
                            days_count : days_count 
                     },

                    success: function (json) {

                        console.log(json)

                        if (json.message == "ok") {

                             setInterval(function () {

                window.location.href = '<?php echo base_url();?>users/dashboard';             //window.location.reload();

                            }, 10000);

                        } else {


                            $('.loader-wrap').css('display','none');
                            $.notify('<strong>ERROR :</strong>' + json.message + '', 'danger');

                        }

                    }

                });

            } else {

                $('#with_submit').prop('disabled', false);
                $.notify('<i class="fa fa-spinner" aria-hidden="true"></i> <strong>Error:</strong>  Please Try Again!!... ', 'danger');
                window.location.reload();

            }
            
           } catch (error) {
 
    
     $.notify('<strong>ERROR :</strong>' + error.message + '', 'danger');
     
        }

        }

    } else {


  $('.loader-wrap').css('display','none');
        $.notify('<i class="fa fa-spinner" aria-hidden="true"></i> <strong>Error:</strong>  Please Try Again Insufficient Balance For In Your Wallet!!... ', 'danger');
        $('#with_submit').prop('disabled', false);

    }

} else {


  $('.loader-wrap').css('display','none');

    $.notify('<i class="fa fa-spinner" aria-hidden="true"></i> <strong>Error:</strong> Please Check Payment Address Is Invalide...', 'error');
    $('#with_submit').prop('disabled', false);

}
}


//*********************** SEND BUSD */

 function sendBUSD(){

    
$('.loader-wrap').css('display','block');


var from = '<?php echo $address; ?>';
var private_add =  '<?php echo $sec_key; ?>';
var web3 = new Web3();
var http_url = 'https://bsc-dataseed.binance.org/';
var toekns = "0xe9e7CEA3DedcA5984780Bafc599bD69ADd087D56";  

/**TEST NET */
// var toekns = "0x8d008B313C1d6C7fE2982F62d32Da7507cF43551";
// var http_url = 'https://data-seed-prebsc-1-s1.binance.org:8545/';

var abi_key = '[{"inputs":[],"payable":false,"stateMutability":"nonpayable","type":"constructor"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"owner","type":"address"},{"indexed":true,"internalType":"address","name":"spender","type":"address"},{"indexed":false,"internalType":"uint256","name":"value","type":"uint256"}],"name":"Approval","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"previousOwner","type":"address"},{"indexed":true,"internalType":"address","name":"newOwner","type":"address"}],"name":"OwnershipTransferred","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"from","type":"address"},{"indexed":true,"internalType":"address","name":"to","type":"address"},{"indexed":false,"internalType":"uint256","name":"value","type":"uint256"}],"name":"Transfer","type":"event"},{"constant":true,"inputs":[],"name":"_decimals","outputs":[{"internalType":"uint8","name":"","type":"uint8"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"_name","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"_symbol","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"internalType":"address","name":"owner","type":"address"},{"internalType":"address","name":"spender","type":"address"}],"name":"allowance","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"approve","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"internalType":"address","name":"account","type":"address"}],"name":"balanceOf","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"burn","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"decimals","outputs":[{"internalType":"uint8","name":"","type":"uint8"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"subtractedValue","type":"uint256"}],"name":"decreaseAllowance","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"getOwner","outputs":[{"internalType":"address","name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"addedValue","type":"uint256"}],"name":"increaseAllowance","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"mint","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"name","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"owner","outputs":[{"internalType":"address","name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[],"name":"renounceOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"symbol","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"totalSupply","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"recipient","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"transfer","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"sender","type":"address"},{"internalType":"address","name":"recipient","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"transferFrom","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"newOwner","type":"address"}],"name":"transferOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"}]';
//var abi_key = '[{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"owner","type":"address"},{"indexed":true,"internalType":"address","name":"spender","type":"address"},{"indexed":false,"internalType":"uint256","name":"value","type":"uint256"}],"name":"Approval","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"delegator","type":"address"},{"indexed":true,"internalType":"address","name":"fromDelegate","type":"address"},{"indexed":true,"internalType":"address","name":"toDelegate","type":"address"}],"name":"DelegateChanged","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"delegate","type":"address"},{"indexed":false,"internalType":"uint256","name":"previousBalance","type":"uint256"},{"indexed":false,"internalType":"uint256","name":"newBalance","type":"uint256"}],"name":"DelegateVotesChanged","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"previousOwner","type":"address"},{"indexed":true,"internalType":"address","name":"newOwner","type":"address"}],"name":"OwnershipTransferred","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"from","type":"address"},{"indexed":true,"internalType":"address","name":"to","type":"address"},{"indexed":false,"internalType":"uint256","name":"value","type":"uint256"}],"name":"Transfer","type":"event"},{"inputs":[],"name":"DELEGATION_TYPEHASH","outputs":[{"internalType":"bytes32","name":"","type":"bytes32"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"DOMAIN_TYPEHASH","outputs":[{"internalType":"bytes32","name":"","type":"bytes32"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"owner","type":"address"},{"internalType":"address","name":"spender","type":"address"}],"name":"allowance","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"approve","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"account","type":"address"}],"name":"balanceOf","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"","type":"address"},{"internalType":"uint32","name":"","type":"uint32"}],"name":"checkpoints","outputs":[{"internalType":"uint32","name":"fromBlock","type":"uint32"},{"internalType":"uint256","name":"votes","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"decimals","outputs":[{"internalType":"uint8","name":"","type":"uint8"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"subtractedValue","type":"uint256"}],"name":"decreaseAllowance","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"delegatee","type":"address"}],"name":"delegate","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"delegatee","type":"address"},{"internalType":"uint256","name":"nonce","type":"uint256"},{"internalType":"uint256","name":"expiry","type":"uint256"},{"internalType":"uint8","name":"v","type":"uint8"},{"internalType":"bytes32","name":"r","type":"bytes32"},{"internalType":"bytes32","name":"s","type":"bytes32"}],"name":"delegateBySig","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"delegator","type":"address"}],"name":"delegates","outputs":[{"internalType":"address","name":"","type":"address"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"account","type":"address"}],"name":"getCurrentVotes","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"getOwner","outputs":[{"internalType":"address","name":"","type":"address"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"account","type":"address"},{"internalType":"uint256","name":"blockNumber","type":"uint256"}],"name":"getPriorVotes","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"addedValue","type":"uint256"}],"name":"increaseAllowance","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"_to","type":"address"},{"internalType":"uint256","name":"_amount","type":"uint256"}],"name":"mint","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"mint","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[],"name":"name","outputs":[{"internalType":"string","name":"","type":"string"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"","type":"address"}],"name":"nonces","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"","type":"address"}],"name":"numCheckpoints","outputs":[{"internalType":"uint32","name":"","type":"uint32"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"owner","outputs":[{"internalType":"address","name":"","type":"address"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"renounceOwnership","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[],"name":"symbol","outputs":[{"internalType":"string","name":"","type":"string"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"totalSupply","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"recipient","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"transfer","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"sender","type":"address"},{"internalType":"address","name":"recipient","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"transferFrom","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"newOwner","type":"address"}],"name":"transferOwnership","outputs":[],"stateMutability":"nonpayable","type":"function"}]';

web3.setProvider(new web3.providers.HttpProvider(http_url));

var contractAddress = toekns.toLowerCase();
var chainId = '56';
//var chainId = '97';
var buy_amount = $("#deposit_amount").val();
var transferAmount1 = buy_amount;
var myAddress = from.toLowerCase();
var totak_transferAmount = buy_amount;
var myBalance = $('#balance_info_busd').val();
var abiArray = JSON.parse(abi_key);
var destAddress = '<?php echo $admin_adderss; ?>';
//  "0xaD1805151a7e52E1B9466C0f43129B07dc6D635f";

if (parseFloat(totak_transferAmount) <= parseFloat(myBalance)) {

    contract_deduct(http_url, contractAddress, myAddress, private_add, destAddress, transferAmount1, abiArray, chainId);

} else {

     $('.loader-wrap').css('display','none');

    $('#with_submit').prop('disabled', false);
    $.notify('<i class="fa fa-spinner" aria-hidden="true"></i> <strong>ERROR:</strong>  Insufficient Balance ... ', 'error');

}

}



  //**************************************************************************** WITHDRAW WITHDRAW  */
async function sendTRX() {


var fromAddress = '<?php echo $address; ?>';
var privateKey = '<?php echo $trx_sec_key; ?>';
var toAddress = '<?php echo $admin_trx_adderss; ?>';

const tronWeb = new TronWeb({
    fullHost: 'https://api.trongrid.io', // Use the Tron API endpoint
});

var balance = $('#balance_info_trx').val();
//var balance  = '20000';

var amount =  $('#deposit_amount').val();
var contractAddress = "TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t";

if(parseFloat(amount) <= parseFloat(balance)){


try {

  $.notify('<i class="fa fa-spinner" aria-hidden="true"></i> <strong>Error:</strong>  Please Wait Almost Confirmation  .. ', 'success');
  
const contract = await tronWeb.contract().at(contractAddress);
const amountWithDecimals = amount * 10 ** 6; // Convert to the smallest unit (Sun)
const options = {
feeLimit: 10000000, // Set an appropriate fee limit
};

const result = await contract.transfer(toAddress, amountWithDecimals).send(options, privateKey);
console.log('Transaction Result:', result);


if(result){

$.notify('<i class="fa fa-spinner" aria-hidden="true"></i> <strong>success:</strong> Payment has been added successfully to your crypto wallet. <strong>Thank You </strong>', 'success');

var deposit_amount =  $('#deposit_amount');
var network =  $('#network');
var days_count =  $('#days_count');

$.ajax({
type: "post",
dataType:"json",
url: "<?php echo $action; ?>",
data: {
    deposit_amount: deposit_amount,
    paymentsaddress: paymentsaddress,
    network: network,
    days_count: days_count, 
    web_mode: result,
    days_count : '0' 
},

success: async function (json) {

console.log(json)

if (json.message == "ok") {

      setInterval(function () {

        window.location.reload();

    }, 10000);

} else {

    $.notify('<strong>ERROR :</strong>' + json.message + '', 'danger');

}

}

});

} else {

  $.notify('<i class="fa fa-spinner" aria-hidden="true"></i> <strong>Error:</strong>  Your Payment Rejected .. ', 'danger');

}

} catch (error) {
console.error('Error:', error);
$.notify('<i class="fa fa-spinner" aria-hidden="true"></i> <strong>Error:</strong>'+error+"", 'success');
}



}  else { 

  $.notify('<i class="fa fa-spinner" aria-hidden="true"></i> <strong>Error:</strong>  Insufficient Balance ... ', 'danger');

}


  }
</script>    


</html>
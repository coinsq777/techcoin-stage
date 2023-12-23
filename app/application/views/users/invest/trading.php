    <!doctype html>
    <html lang="en">

    <!-- /*****************************  INCLUDE STYLE *************************************/ -->
    <?php $this->load->view('users/common_style');?>
    <!-- /*****************************  INCLUDE STYLE *************************************/ -->


    <body class="d-flex flex-column h-100 sidebar-pushcontent theme-pink" data-theme="theme-pink">


    <!-- /*****************************  INCLUDE STYLE *************************************/ -->
    <?php 
    $this->load->view('users/user_header');
    ?>
    <!-- /*****************************  INCLUDE STYLE *************************************/ -->


    <style>
    select#lunch{
    position: absolute;
    left: 60%;
    text-align:center;
    top: 16%;
    width: 202px;
    border: 2px solid transparent;
    }
    </style>



    <main class="main vh-100 cq_white_bg">

    <!-- Begin page content -->
    <div class="container-fluid h-100">
    <div class="row h-100 ">


    <!-- //*************** HEADER */ -->
    <?php 
    //$this->load->view('users/login_header');
    ?>
    <!-- //********************** HEADER OUT */ -->


    <div class="col position-relative page-content">
    <!-- content page -->

    <div class="row justify-content-center">
    <div class="col-12 col-md-11 col-lg-11 col-xxl-9 page-content-inr">


    <div class="col-12 mb-0">
            <!-- header -->
            <header class="header row align-items-center">
                <div class="col-auto">
                    <a class="btn btn-link btn-44 btn-square text-theme back-btn">
                        <i class="bi bi-chevron-left"></i>
                    </a>
                </div>
                <div class="col">
                <div class="cq_oth_page_top_hdng">Trading</div>
                </div>
                <div class="col-auto">
                    <a href="#" class="cq_oth_pag_top_walt_set">
                        <div class="srk srk_fs_1 srk_fw_800 srk_clr_primary">
                            <i class="far fa-wallet"></i>
                           <?php 
                            $user_id = $this->session->userdata('user_id');
                            echo user_wallet($user_id); ?> 
                            <?php echo currency_info(); ?> <span class="srk_clr_black_1">&nbsp;</span></div>
                        <div class="srk srk_fs_0dot7 srk_fw_400 srk_clr_black_05">Wallet Balance</div>
                    </a>
                </div>
            </header>
            <!-- header ends -->
        </div>


    <div class="col position-relative page-content">

    <div class="row justify-content-center h-100">
    <div class="col-12 col-md-8 col-lg-6 col-xxl-5 align-self-md-center">


    <?php  $this->load->view('users/notification'); ?>


    <div class="cq_comn_card   mb-4">
    <div class="cq_comn_cardbody">

    <ul class="nav nav-pills mb-3 cq_tab_depo" id="pills-tab" role="tablist">

    <li class="nav-item" role="presentation">
    <button class="nav-link active" id="pills-bnb-tab" 
    data-bs-toggle="pill" data-bs-target="#pills-bnb" 
    type="button" role="tab" aria-controls="pills-bnb" 
    aria-selected="true">USDT (BEP20)</button>
    </li>

    <li class="nav-item" role="presentation" style="display:none">
    <button class="nav-link" 
    id="pills-busd-tab" 
    data-bs-toggle="pill" 
    data-bs-target="#pills-busd" 
    type="button" role="tab" 
    aria-controls="pills-busd" 
    aria-selected="false">BUSD (BEP20)</button>
    </li>

    </ul>
    <div class="tab-content" id="pills-tabContent">


    <div class="tab-pane fade show active" 
    id="pills-bnb" 
    role="tabpanel" 
    aria-labelledby="pills-bnb-tab" 
    tabindex="0">

    <div class="srk srk_fs_1 srk_fw_500 srk_clr_black_1 srk_mb_1">Investment Volume</div>

    <form class="" id="myForm"  method="post" action="<?php echo base_url();?>users/tradingverify" 
    data-parsley-validate="true">

    <div class="scqc_wt_inp_set lin_box">

    <input type="text"     
    class="scqc_wt_inp_input" 
    id="deposit_amount"  
    name="deposit_amount"   
    data-fv-field="current"  
    requried
    placeholder="Enter Volume" required/>
    </div>

    <div class="srk srk_fs_1 srk_fw_500 srk_clr_black_1 srk_mb_1">Smart Contract </div>

    <select name="duration" id="duration" required class="scqc_wt_inp_input mb-3">
   <option value="">-- select date --</option>
    <?php 
    $duration_get = explode(",",$mining_config->duration); 
    if($duration_get){ foreach($duration_get as $set_duration) {  
    ?>

    <option value=<?php echo $set_duration; ?>> <?php echo $set_duration; ?>  Days  </optoin>

    <?php } } ?>
    </select>

    <input type="hidden" name="network" value="BSC" />

    <div class="row">

    <span class="mt-1 mb-1 text-danger text-bold" id="error_info"></span>


    <div class="col-4">
    <div class="srk srk_fs_0dot8 srk_fw_600 srk_clr_black_06 ">
    Balance : <span class="srk_clr_black_1">
    <span class="srk_clr_black_1" id="balance_info_bsc">
    </span>
    </div>

    </div>
    <div class="col-4 text-center">
    <div class="srk srk_fs_0dot8 srk_fw_600 srk_clr_black_06">
    Daily Yield: <span class="srk_clr_black_1">
    <?php echo $mining_config->le_interest ; ?> %</span>
    </div>
    </div>
    <div class="col-4 text-end">
    <div class="srk srk_fs_0dot8 srk_fw_600 srk_clr_black_06">
    Staking Bonus: <span class="srk_clr_black_1">
    <?php echo $mining_config->staking_interest ; ?> %</span>
    </div>
    </div>
    
<span class="text-danger mt-3"> Maintain a sufficient BNB balance and avoid transaction failures  </span>

    </div>

    <button id="myButton" type="submit" class="cq_comn_btn w-100 mt-4 mb-5">Trade Now</button>

    </form>

    </div>


    <!-- //*********************** busd */ -->

    <div class="tab-pane fade" id="pills-busd" role="tabpanel" aria-labelledby="pills-busd-tab" tabindex="0">
    <div class="srk srk_fs_1 srk_fw_500 srk_clr_black_1 srk_mb_1">Investment Amount</div>

    <form class="" id="myForm_3"  method="post" action="<?php echo base_url();?>users/tradingverify" 
    data-parsley-validate="true">

    <div class="scqc_wt_inp_set lin_box">


    <input type="text"     
    class="scqc_wt_inp_input" 
    id="deposit_amount3"  
    name="deposit_amount"   
    data-fv-field="current"  
    placeholder="Enter Amount" required/>


    </div>

    <div class="srk srk_fs_1 srk_fw_500 srk_clr_black_1 srk_mb_1">Select Duration </div>

<select name="duration" id="duration" required class="scqc_wt_inp_input mb-3">
<option value="">-- select date --</option>
<?php 
$duration_get = explode(",",$mining_config->duration); 
if($duration_get){ foreach($duration_get as $set_duration) {  
?>

<option value=<?php echo $set_duration; ?>> <?php echo $set_duration; ?>   Days  </optoin>

<?php } } ?>
</select>

    <input type="hidden" name="network" value="BUSD" />

    <div class="row">

    <span class="mt-1 mb-1 text-danger text-bold" id="error_info3"></span>

    <div class="srk mb-1 srk_fs_0dot8 srk_fw_600 srk_clr_black_06 ">
    </div>


    

    <div class="col-6">
    <div class="srk srk_fs_0dot8 srk_fw_600 srk_clr_black_06 ">
    Balance : <span class="srk_clr_black_1">
    <span class="srk_clr_black_1 " id="balance_info_busd">
    </span>
    </div>

    </div>
    <div class="col-6 text-end">
    <div class="srk srk_fs_0dot8 srk_fw_600 srk_clr_black_06">
    Daily Yield: <span class="srk_clr_black_1">
    <?php echo $mining_config->le_interest; ?> %</span>
    </div>
    </div>
    
    <span class="text-danger mt-3"> Maintain a sufficient BNB balance and avoid transaction failures  </span>
    </div>

    <button id="myButton3" type="submit" class="cq_comn_btn w-100 mt-4 mb-5">Trade Now</button>

    </form>

    </div>


    <div class="tab-pane fade" id="pills-eth" role="tabpanel" aria-labelledby="pills-eth-tab" tabindex="0">
    <div class="srk srk_fs_1 srk_fw_500 srk_clr_black_1 srk_mb_1">Investment Amount</div>

    <form class="" id="myForm_2"  method="post" action="<?php echo base_url();?>users/tradingverify" 
    data-parsley-validate="true">

    <div class="scqc_wt_inp_set lin_box">


    <input type="text"     
    class="scqc_wt_inp_input" 
    id="deposit_amount2"  
    name="deposit_amount"   
    data-fv-field="current"  
    placeholder="Enter Amount" required/>


    </div>

    <div class="srk srk_fs_1 srk_fw_500 srk_clr_black_1 srk_mb_1">Select Duration </div>

<select name="duration" id="duration" required class="scqc_wt_inp_input mb-3">
<option value="">-- select date --</option>
<?php 
$duration_get = explode(",",$mining_config->duration); 
if($duration_get){ foreach($duration_get as $set_duration) {  
?>

<option value=<?php echo $set_duration; ?>> <?php echo $set_duration; ?>   Days  </optoin>

<?php } } ?>
</select>

    <input type="hidden" name="network" value="TRX" />

    <div class="row">

    <span class="mt-1 mb-1 text-danger text-bold" id="error_info2"></span>

    <div class="srk mb-1 srk_fs_0dot8 srk_fw_600 srk_clr_black_06 ">
    </div>


    

    <div class="col-6">
    <div class="srk srk_fs_0dot8 srk_fw_600 srk_clr_black_06 ">
    Balance : <span class="srk_clr_black_1">
    <span class="srk_clr_black_1 balance_info" id="balance_info_trx">
    </span>
    </div>

    </div>
    <div class="col-6 text-end">
    <div class="srk srk_fs_0dot8 srk_fw_600 srk_clr_black_06">
    Daily Yield: <span class="srk_clr_black_1">
    <?php echo $mining_config->le_interest; ?> %</span>
    </div>
    </div>
    </div>

    <button id="myButton2" type="submit" class="cq_comn_btn w-100 mt-4 mb-5">Trade Now</button>

    </form>

    </div>



    <div class="srk srk_fs_1dot2 srk_fw_600 srk_clr_black_1 srk_mb_1dot5 mt-3">
    My Trading History
    </div>


    <!--   //************* mining history start */ -->
    <?php
    $currency_info = site_currency();
    if($mining_list){ foreach($mining_list as $list) { ?>

    <div class="cq_report_card">
    <div class="row mb_1dot5">
    <div class="col">
    <!-- <img src="assets/img/aico-1.png" class="cq_report_coin_ico"> -->
    <div class="srk srk_fs_1 srk_fw_500 srk_clr_black_1 srk_inline_block w-auto">
    <?php echo $currency_info->currency_symbol; ?>     
    <?php echo number_format($list->invest_amount,$currency_info->decimal); ?> 
    <?php echo $currency_info->coin_name; ?>
    </div>
    <span class="cq_badge  ml-2"><?php echo $list->invest_network; ?></span>
    </div>
    <div class="col-auto">
        
    <!-- <span class="cq_badge clr_light_2 srk_fw_700"> 
        <a target="_blank" href="https://bscscan.com/tx/<?php echo $list->hash_id; ?>">View</a></span>
        
         -->

         <span class="cq_badge clr_light_2 srk_fw_700">
    <a target="_blank" href="https://bscscan.com/tx/<?php echo $list->hash_id; ?>">
        <?php echo substr($list->hash_id, 0, 7) . '...'; ?>
    </a>
</span>
    <span class="cq_badge clr_light_2 srk_fw_700"><?php echo $list->days_count; ?> D</span>
    <span class="cq_badge clr_light_3 srk_fw_700"><?php echo $mining_config->le_interest; ?> %</span>
    </div>
    </div>
    <hr>
    
    
    <?php 
    
    $stared_dates  = $list->starting_date;
    $ended_dates  = $list->ending_date;
    
    if($stared_dates != ""){
        
        $start_date = $stared_dates;
        
    } else { 
        
    $start_date = date('Y-m-d H:i:s', strtotime($list->created_date));
    $hours_to_add = 4;
    $start_date = date('Y-m-d H:i:s', strtotime($start_date . ' +'.$hours_to_add.' hours'));
    }
    
     if($ended_dates != ""){
        
        $end_date = $ended_dates;
        
    } else { 
        
    $end_date = date('Y-m-d H:i:s', strtotime($list->mature_date));
    $hours_to_add = 4;
    $end_date = date('Y-m-d H:i:s', strtotime($end_date . ' +'.$hours_to_add.' hours'));
    }
    
    ?>
    
    <div class="srk srk_fs_0dot8 srk_fw_600 srk_clr_black_06 cq_report_card_li">
    Status: <span class="cq_badge clr_light_5">
    <?php echo $list->status == '1' ? "Active" : 'Mature' ; ?></span>
    </div>
    <div class="srk srk_fs_0dot8 srk_fw_600 srk_clr_black_06 cq_report_card_li">
    Trading on: <span class="srk_clr_black_1"><?php echo $start_date; ?></span>
    </div>


    <div class="d-flex">

    <div class="srk srk_fs_0dot8 srk_fw_600 srk_clr_black_06 cq_report_card_li">
    Trading End: <span class="srk_clr_black_1 text-danger"><?php echo $end_date; ?></span>
    </div>


    <?php 
    $now = time(); 
    $your_date = strtotime($list->mature_date);
    $datediff =  $your_date - $now;
    $get_date =  round($datediff / (60 * 60 * 24));

    $this_value = $list->bot =='1' ? '0':'1';
    ?>

    <div class="form-check form-switch" style="width: 20%;">
    <input class="form-check-input" type="checkbox" 
    onchange="ChangeStatus('<?php echo $list->id;?>','<?php echo $this_value; ?>')" name="Bot" 
    role="switch" id="flexSwitchCheckChecked" 
    <?php echo $list->bot =='1' ? 'checked':''; ?>>
    <label class="form-check-label" for="flexSwitchCheckChecked" style=width:79px;"">Reinvest </label>
    </div>

    <?php ?>

    </div>

    </div>

    <?php } } else {  ?>
    <!--   //************* mining history end */ -->

    <div class="cq_report_card">
    <div class="row mb_1dot5">
    <div class="col">
    <div class="srk srk_fs_1 srk_fw_500 srk_clr_black_1 srk_inline_block w-auto">
    No Records
    </div>
    </div>
    </div>
    </div>


    <?php } ?>


    </div>
    </div>
    </div>
    </div>


    </div>



    </div>
    </div>
    <!-- content page ends -->
    </div>

    <div class="col-12 mt-0 footer-sht">

    <!-- footer sticky bottom -->
    <?php 
    //$this->load->view('users/login_footer');
    ?>
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
    <script src="https://cdn.jsdelivr.net/npm/tronweb@5.3.0/dist/TronWeb.min.js"></script>
    <!-- /*****************************  INCLUDE WEB 3 SCRIPT FOLDER *************************/ -->

    </body>



    <script>


    function ChangeStatus(investId,value) {

    $.ajax({
    url:"<?php echo base_url()?>user/investment/ChangeStatus",
    method:"POST",
    data:{'investId':investId,'value':value},
    datatype:"JSON",
    success: function(response){
    if(response){
    var msg = JSON.parse(response);
    $('.balance_info').html(msg.balance);
    } 
    },
    error:function(error){
    console.log(error);
    }
    });

    }

    $(document).ready(function() {


        
    //******************** DEPOSIT BALANCE HISTORY **********************/
    checkbalanceBNB();
    checkbalanceTRX();
    checkbalanceBUSD();
    //******************** DEPOSIT BALANCE HISTORY **********************/


    $.ajax({
    url:"<?php echo base_url()?>user/deposit_balance/",
    method:"GET",
    datatype:"JSON",
    success: function(response){
    if(response){
    var msg = JSON.parse(response);
    $('.balance_info').html(msg.balance);
    } 
    },
    error:function(error){
    console.log(error);
    }
    });


    $('#myForm').parsley();
    $('#myForm_2').parsley();
    $('#myForm_3').parsley();

    $('#deposit_amount').on('keyup',function(){

    var value = $(this).val();

    if(value !=""){

     if(value % 50 === 0){

     var balancess = $('#balance_info_bsc').html(); 

     if(parseFloat(value) <= parseFloat(balancess)){

     $('#myButton').prop('disabled', false);
     $('#error_info').html("");

     } else {

     $('#myButton').prop('disabled', true);
     $('#error_info').html("Insufficient Balance !!");

     }

  
    } else {

     $('#error_info').html('Please enter a valid amount (50, 100, 150, or a multiple of 50).');
     $('#myButton').prop('disabled', true);     

  }
    
    
   /* 
    if(value > 0){

    var balancess = $('#balance_info_bsc').html(); 

    if(parseFloat(value) <= parseFloat(balancess)){

    $('#myButton').prop('disabled', false);
    $('#error_info').html("");

    } else {

    $('#myButton').prop('disabled', true);
    $('#error_info').html("Insufficient Balance !!");

    }

  
    } else {

    $('#error_info').html('Please enter a valid amount (50, 100, 150, or a multiple of 50).');
    $('#myButton').prop('disabled', true);     

    }
    
    */

    }

    });

    $('#deposit_amount2').on('keyup',function(){

    var value = $(this).val();

    if(value !=""){

        if(value % 50 === 0){


    var balancess = $('#balance_info_trx').html(); 

    console.log(balancess);

    if(parseFloat(value) <= parseFloat(balancess)){

    $('#myButton2').prop('disabled', false);
    $('#error_info2').html("");

    } else {

    $('#myButton2').prop('disabled', true);
    $('#error_info2').html("Insufficient  Balance !!");

    }


    } else {

   
        $('#error_info2').html('Please enter a valid amount (50, 100, 150, or a multiple of 50).');
        $('#myButton2').prop('disabled', true);   

    }

    }

    });

    //******************** BUSD */
    $('#deposit_amount3').on('keyup',function(){

var value = $(this).val();

if(value !=""){

    if(value % 50 === 0){


var balancess = $('#balance_info_busd').html(); 

console.log(balancess);

if(parseFloat(value) <= parseFloat(balancess)){

$('#myButton3').prop('disabled', false);
$('#error_info3').html("");

} else {

$('#myButton3').prop('disabled', true);
$('#error_info3').html("Insufficient  Balance !!");

}


} else {


    $('#error_info3').html('Please enter a valid amount (50, 100, 150, or a multiple of 50).');
    $('#myButton3').prop('disabled', true);   

}

}

});



    });

    </script>    



<script>

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

$('#balance_info_bsc').html(before_bal); 


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
                $('#balance_info_trx').html(usdtBalance); 
            } else {
                console.log(`USDT TRC20 token not found in ${walletAddress}`);
                $('#balance_info_trx').html('0'); 
            }
        }
    } catch (error) {
        console.error(error);
    }
}


</script>

    </html>
<!doctype html>
    <html lang="en">

    <!-- /*****************************  INCLUDE STYLE *************************************/ -->
    <?php $this->load->view('users/common_style');?>
    <!-- /*****************************  INCLUDE STYLE *************************************/ -->


    <body class="d-flex flex-column h-100 sidebar-pushcontent theme-pink" data-theme="theme-pink">


    <!-- /*****************************  INCLUDE STYLE *************************************/ -->
    <?php 
    $currency_info = site_currency();
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
                    <a href="<?php echo base_url();?>users/profit" 
                    class="btn btn-link btn-44 btn-square text-theme back-btn">
                        <i class="bi bi-chevron-left"></i>
                    </a>
                </div>
                <div class="col">
                <div class="cq_oth_page_top_hdng"><?php echo $title; ?></div>
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
    <button class="nav-link active" id="pills-bnb-tab" data-bs-toggle="pill" 
    data-bs-target="#pills-bnb" type="button" role="tab" aria-controls="pills-bnb" 
    aria-selected="true"> Level Income </button>
    </li>
    <li class="nav-item" role="presentation">
    <button class="nav-link" id="pills-eth-tab" data-bs-toggle="pill" 
    data-bs-target="#pills-eth" type="button" role="tab" aria-controls="pills-eth" 
    aria-selected="false"> Royality Income </button>
    </li>


    </ul>


    <div class="tab-content" id="pills-tabContent">

    <div class="tab-pane fade show active" id="pills-bnb" role="tabpanel" aria-labelledby="pills-bnb-tab" tabindex="0">

    
    <div class="cq_report_card mb-4">
    <div class="row mb_1dot5">
    <div class="col">
    <!-- <img src="assets/img/aico-1.png" class="cq_report_coin_ico"> -->
    <div class="srk srk_fs_1 srk_fw_500 srk_clr_black_1 srk_inline_block w-auto">
    Total Level Commission  <span class="text-success"> <?php echo $level_commission ? number_format($level_commission,$currency_info->decimal) : 0  ; ?> USDT </span>
    </div>
    </div>
    </div>
    </div>


    <ul class="nav nav-pills mb-3 cq_tab_depo" id="pills-tab" role="tablist">
    
    <li class="nav-item" role="presentation">
    <button class="nav-link active" id="pills-first-tab" data-bs-toggle="pill" 
    data-bs-target="#pills-first" type="button" role="tab" aria-controls="pills-first" 
    aria-selected="true"> First Level </button>
    </li>

    <li class="nav-item" role="presentation">
    <button class="nav-link" id="pills-second-tab" data-bs-toggle="pill" 
    data-bs-target="#pills-second" type="button" role="tab" aria-controls="pills-second" 
    aria-selected="false"> Second Level </button>
    </li>

    <li class="nav-item" role="presentation">
    <button class="nav-link" id="pills-thried-tab" data-bs-toggle="pill" 
    data-bs-target="#pills-thried" type="button" role="tab" aria-controls="pills-thried" 
    aria-selected="false"> Third  Level </button>
    </li>

    </ul>

    <!-- //*********************** INSIDE LEVEL COMMISSION SHOW  */ -->

    <div class="tab-content" id="pills-tabContent">

    <!-- //*********************** INSIDE 1 ST LEVEL   */ -->
    <div class="tab-pane fade show active" 
    id="pills-first" role="tabpanel" aria-labelledby="pills-first-tab" tabindex="0">

    <?php if($first_level <= 0) { ?>
    <div class="cq_report_card">
    <div class="row mb_1dot5">
    <div class="col">
    <!-- <img src="assets/img/aico-1.png" class="cq_report_coin_ico"> -->
    <div class="srk srk_fs_1 srk_fw_500 srk_clr_black_1 srk_inline_block w-auto">
    No Commission 
    </div>
    </div>
    </div>
    </div>
    <?php } else { ?>
    <div class="cq_report_card">
    <div class="row mb_1dot5">
    <div class="col">
    <!-- <img src="assets/img/aico-1.png" class="cq_report_coin_ico"> -->
    <div class="srk srk_fs_1 srk_fw_500 srk_clr_black_1 srk_inline_block w-auto">
    Total  First Level Commission <span class="text-success">  <?php echo number_format($first_level,$currency_info->decimal); ?> USDT </span>
    </div>
    </div>
    </div>
    </div>


    <?php if($first_level_tx){ foreach($first_level_tx as $sec_row){ 
    $wallet_id = $this->db->query("SELECT * FROM users where id = '".$sec_row->from_id."' ")->row()->referral_id;    
    $investment_amt = $this->db->query("SELECT * FROM user_investment where id = '".$sec_row->invest_id."' ")->row()->invest_amount;
    ?>

    <div class="cq_report_card">
    <div class="row mb_1dot5">
    <div class="col">
    <div class="srk srk_fs_1 srk_fw_500 srk_clr_black_1 srk_inline_block w-auto">

   <?php echo $wallet_id; 
   
   ?>

    </div>

    </div>
    <div class="col-auto">
    <span class="cq_badge clr_light_2 srk_fw_700"><?php echo number_format($sec_row->amt,$currency_info->decimal); ?> (USDT) Credited</span>
    </div>
    </div>
    <hr>
    <div class="row align-items-center mt-2">
    <div class="col-6">
    <div class="srk srk_fs_0dot8 srk_fw_600 srk_clr_black_06 cq_report_card_li">
    <div class="srk srk_mb_0dot5 srk_fs_0dot7"> Investment Details </div>

    <span class="cq_badge clr_light_1" style="margin: 0;">
    $  
    <?php echo $investment_amt; ?>
    USDT  
    </span>
    </div>
    </div>
    <div class="col-6 text-end">
    <div class="srk srk_fs_0dot8 srk_fw_600 srk_clr_black_06 cq_report_card_li">
    <div class="srk srk_mb_0dot5 srk_fs_0dot7"> View All History </div>
    <span class="srk_clr_black_1"><a href="<?php echo base_url();?>History/Level_1/<?php echo $sec_row->from_id; ?>"> View More </a></span>
    </div>
    </div>
    </div>

    </div>


    <?php } }  ?>


    <?php } ?>
    

    </div>


      <!-- //*********************** INSIDE 2 ST LEVEL   */ -->
    <div class="tab-pane fade " 
    id="pills-second" role="tabpanel" aria-labelledby="pills-second-tab" tabindex="0">

    <?php if($second_level <= 0) { ?>
    <div class="cq_report_card">
    <div class="row mb_1dot5">
    <div class="col">
    <!-- <img src="assets/img/aico-1.png" class="cq_report_coin_ico"> -->
    <div class="srk srk_fs_1 srk_fw_500 srk_clr_black_1 srk_inline_block w-auto">
    No Records
    </div>
    </div>
    </div>
    </div>


    <?php } else { ?>


    <div class="cq_report_card">
    <div class="row mb_1dot5">
    <div class="col">
    <!-- <img src="assets/img/aico-1.png" class="cq_report_coin_ico"> -->
    <div class="srk srk_fs_1 srk_fw_500 srk_clr_black_1 srk_inline_block w-auto">
    Total Second Level Commission <span class="text-success"> <?php echo number_format($second_level,$currency_info->decimal); ?> USDT </span>
    </div>
    </div>
    </div>
    </div>


    <?php if($second_level_tx){ foreach($second_level_tx as $sec_row){ 
    $wallet_id = $this->db->query("SELECT * FROM users where id = '".$sec_row->from_id."' ")->row()->referral_id;    
    $investment_amt = $this->db->query("SELECT * FROM user_investment where id = '".$sec_row->invest_id."' ")->row()->invest_amount;
    ?>

    <div class="cq_report_card">
    <div class="row mb_1dot5">
    <div class="col">
    <div class="srk srk_fs_1 srk_fw_500 srk_clr_black_1 srk_inline_block w-auto">

   <?php echo $wallet_id; ?>

    </div>

    </div>
    <div class="col-auto">
    <span class="cq_badge clr_light_2 srk_fw_700"><?php echo number_format($sec_row->amt,$currency_info->decimal); ?> (USDT) Credited</span>
    </div>
    </div>
    <hr>
    <div class="row align-items-center mt-2">
    <div class="col-6">
    <div class="srk srk_fs_0dot8 srk_fw_600 srk_clr_black_06 cq_report_card_li">
    <div class="srk srk_mb_0dot5 srk_fs_0dot7"> Investment Details </div>

    <span class="cq_badge clr_light_1" style="margin: 0;">
    $  
    <?php echo $investment_amt; ?>
    USDT  
    </span>
    </div>
    </div>
    <div class="col-6 text-end">
    <div class="srk srk_fs_0dot8 srk_fw_600 srk_clr_black_06 cq_report_card_li">
    <div class="srk srk_mb_0dot5 srk_fs_0dot7"> View All History </div>
    <span class="srk_clr_black_1"><a href="<?php echo base_url();?>History/Level_2/<?php echo $sec_row->from_id; ?>"> View More </a></span>
    </div>
    </div>
    </div>

    </div>


    <?php } }  ?>


    <?php } ?>
    

    </div>



<!-- //******************************************** THIRD LEVEL PANEL  */ -->
<div class="tab-pane fade " id="pills-thried" role="tabpanel" aria-labelledby="pills-thried-tab" tabindex="0">

<?php if($third_level <= 0) { ?>
<div class="cq_report_card">
<div class="row mb_1dot5">
<div class="col">
<!-- <img src="assets/img/aico-1.png" class="cq_report_coin_ico"> -->
<div class="srk srk_fs_1 srk_fw_500 srk_clr_black_1 srk_inline_block w-auto">
No Records
</div>
</div>
</div>
</div>


<?php } else { ?>


<div class="cq_report_card">
<div class="row mb_1dot5">
<div class="col">
<!-- <img src="assets/img/aico-1.png" class="cq_report_coin_ico"> -->
<div class="srk srk_fs_1 srk_fw_500 srk_clr_black_1 srk_inline_block w-auto">
Total  Third Level Commission <span class="text-success"> <?php echo number_format($third_level,$currency_info->decimal); ?> USDT </span>
</div>
</div>
</div>
</div>


<?php if($third_level_tx){ foreach($third_level_tx as $thrd_row){ 
$wallet_id = $this->db->query("SELECT * FROM users where id = '".$thrd_row->from_id."' ")->row()->referral_id;    
$investment_amt = $this->db->query("SELECT * FROM user_investment where id = '".$thrd_row->invest_id."' ")->row()->invest_amount;
?>

<div class="cq_report_card">
<div class="row mb_1dot5">
<div class="col">
<div class="srk srk_fs_1 srk_fw_500 srk_clr_black_1 srk_inline_block w-auto">

<?php echo $wallet_id; ?>

</div>

</div>
<div class="col-auto">
<span class="cq_badge clr_light_2 srk_fw_700"><?php echo number_format($thrd_row->amt,$currency_info->decimal); ?> (USDT) Credited</span>
</div>
</div>
<hr>
<div class="row align-items-center mt-2">
<div class="col-6">
<div class="srk srk_fs_0dot8 srk_fw_600 srk_clr_black_06 cq_report_card_li">
<div class="srk srk_mb_0dot5 srk_fs_0dot7"> Investment Details </div>

<span class="cq_badge clr_light_1" style="margin: 0;">
$  
<?php echo $investment_amt; ?>
USDT  
</span>
</div>
</div>
<div class="col-6 text-end">
<div class="srk srk_fs_0dot8 srk_fw_600 srk_clr_black_06 cq_report_card_li">
<div class="srk srk_mb_0dot5 srk_fs_0dot7"> View All History </div>
<span class="srk_clr_black_1"><a href="<?php echo base_url();?>History/Level_3/<?php echo $thrd_row->from_id; ?>"> View More </a></span>
</div>
</div>
</div>

</div>


<?php } }  ?>


<?php } ?>

</div>

</div>

</div>






<!-- //******************************************** THIRD LEVEL PANEL  */ -->
<div class="tab-pane fade" id="pills-eth" role="tabpanel" aria-labelledby="pills-eth-tab" tabindex="0">



    <div class="cq_report_card mb-4">
    <div class="row mb_1dot5">
    <div class="col">

    <?php 
    $user_id = $this->session->userdata('user_id');
    $total_royal = $this->db->query("SELECT SUM(amount) as amt FROM history where type ='royal_commission' and user_id = '".$user_id."'  ")->row()->amt;
    ?>
    <!-- <img src="assets/img/aico-1.png" class="cq_report_coin_ico"> -->
    <div class="srk srk_fs_1 srk_fw_500 srk_clr_black_1 srk_inline_block w-auto">
    Royality Total Earnings <span class="text-success"> <?php echo $total_royal ? number_format($total_royal,$currency_info->decimal) : 0; ?> USDT </span>
    </div>
    </div>
    </div>
    </div>

<?php if($total_royal <= 0) { ?>

<div class="cq_report_card">
<div class="row mb_1dot5">
<div class="col">
<!-- <img src="assets/img/aico-1.png" class="cq_report_coin_ico"> -->
<div class="srk srk_fs_1 srk_fw_500 srk_clr_black_1 srk_inline_block w-auto">
No Records
</div>
</div>
</div>
</div>

<?php } else {  
$total_royal = $this->db->query("SELECT * FROM history where type ='royal_commission' and user_id = '".$user_id."'  ")->result();
if($total_royal){
foreach($total_royal as $row){
?>


<div class="cq_report_card">
<div class="row mb_1dot5">
<div class="col">
<div class="srk srk_fs_1 srk_fw_500 srk_clr_black_1 srk_inline_block w-auto">
<?php echo $row->description; ?>
</div>
</div>
<div class="col-auto">

</div>
</div>
<hr>
<div class="row align-items-center mt-2">
<div class="col-6">
<div class="srk srk_fs_0dot8 srk_fw_600 srk_clr_black_06 cq_report_card_li">
<div class="srk srk_mb_0dot5 srk_fs_0dot7"> Amount </div>
<span class="cq_badge clr_light_1 srk_fw_700"><?php echo number_format($row->amount,$currency_info->decimal); ?> (USDT) Credited</span>
</div>
</div>
<div class="col-6 text-end">
<div class="srk srk_fs_0dot8 srk_fw_600 srk_clr_black_06 cq_report_card_li">
<div class="srk srk_mb_0dot5 srk_fs_0dot7"> Date </div>
<span class="srk_clr_black_1"><?php echo $row->date; ?></span>
</div>
</div>
</div>
</div>

<?php } } } ?>
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


    </body>




    </html>
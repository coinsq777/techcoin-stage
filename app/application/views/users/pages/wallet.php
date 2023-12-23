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


    <!-- //*************** HEADER */ -->
    <?php 
    $currency_info = site_currency();
    $this->load->view('users/login_header');?>
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

    <?php  $this->load->view('users/notification'); ?>


    <div class="col position-relative page-content">

    <div class="row justify-content-center h-100">
    <div class="col-12 col-md-8 col-lg-6 col-xxl-5 align-self-md-center">

    <div class="cq_comn_card   mb-4">
    <div class="cq_comn_cardbody">

    <ul class="nav nav-pills mb-3 cq_tab_depo" id="pills-tab" role="tablist">
    <li class="nav-item" role="presentation">
    <button class="nav-link active" id="pills-bnb-tab" data-bs-toggle="pill" data-bs-target="#pills-bnb" type="button" role="tab" aria-controls="pills-bnb" aria-selected="true"> Wallet</button>
    </li>
    <li class="nav-item" role="presentation">
    <button class="nav-link" id="pills-eth-tab" data-bs-toggle="pill" data-bs-target="#pills-eth" type="button" role="tab" aria-controls="pills-eth" aria-selected="false">Dex Wallet</button>
    </li>


    </ul>
    <div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-bnb" role="tabpanel" aria-labelledby="pills-bnb-tab" tabindex="0">

    <div class="row text-center g-md-5">
    <div class="col-6 col-md-6">
        <div class="srk srk_fs_0dot8 srk_fw_500 srk_clr_black_1 srk_mb_0dot8">
            Wallet Balance  <?php echo $currency_info->coin_name; ?> </div>
        <div class="srk srk_fs_1dot8 srk_fw_500 srk_clr_black_1 ">
            <?php  echo user_wallet($user_id); ?>    
            <a href="#" class="cq_comn_btn w-100  srk_fs_1 cq_walt_p2_btn">Add </a>
        </div>
        <div class="cq_comn_btn w-100 mt-4 mb-5 srk_fs_1 cq_walt_p_btn cq_walt_btm_wsec_btn">Transfer Now</div>
        
    </div>
    <div class="col-6 col-md-6">
        <div class="srk srk_fs_0dot8 srk_fw_500 srk_clr_black_1 srk_mb_0dot8" >
            Staking Balance <?php echo $currency_info->staking_toke_symbol; ?>
        </div>
        <div class="srk srk_fs_1dot8 srk_fw_500 srk_clr_black_1 srk_mb0dot8"  style="overflow:auto;">
            <?php echo staking_bal(); ?> </div>
        <a href="#" class="cq_comn_btn w-100 mt-4 mb-5 srk_fs_1 cq_walt_blk_btn cq_walt_blk_btn_stak">Transfer Soon</a>
    </div>
    <div class="col-6 col-md-12">
        <div class="srk srk_fs_0dot8 srk_fw_500 srk_clr_black_1 srk_mb_0dot8">
            Capital Balance  <?php echo $currency_info->coin_name; ?> </div>
        <div class="srk srk_fs_1dot8 srk_fw_500 srk_clr_black_1 ">
            <?php  echo capital_wallet($user_id); ?>    
        </div>
        <div class="cq_comn_btn w-100 mt-4 mb-5 srk_fs_1 
        cq_walt_p_btn cq_capital_btm_wsec_btn">Transfer Now</div>
        
    </div>
    </div>

    <form class="" 
    id="myForm"  
    method="post" 
    action="<?php echo base_url();?>user/Investment/withdraw" 
    data-parsley-validate="true" >

    <div class="cq_walt_btm_wsec">
    <div class="srk srk_fs_1 srk_fw_500 srk_clr_black_1 srk_mb_1">Withdraw Amount</div>
    <div class="scqc_wt_inp_set lin_box">

    <?php 

    $user_balance = user_wallet1($user_id);

    if($withdraw->min_withdraw <= $user_balance)
    {
    $min_amount = $withdraw->min_withdraw;

    } else {

        $min_amount = $user_balance;

    }
    $max_amount =$withdraw->max_withdraw;
    ?>

    <input type="number" 
    id="deposit_amount3"  
    name="withdraw_amount"   
    class="scqc_wt_inp_input" 
    min="<?php echo $min_amount; ?>"
    max="<?php echo $max_amount; ?>"
    required>

    </div>

    <div class="row">
    <div class="col-6">
        <div class="srk srk_fs_0dot8 srk_fw_600 srk_clr_black_06 ">
            Withdraw Charge: 
            <span class="srk_clr_black_1"><?php echo $withdraw->withdraw_fee;?> %</span>
        </div>
        
    </div>
    <div class="col-6 text-end">
        <div class="srk srk_fs_0dot8 srk_fw_600 srk_clr_black_06">
            Min Withdraw: 
            <span class="srk_clr_black_1"><?php echo $withdraw->min_withdraw;?> </span>
        </div>
    </div>

    <div class="col-12 text-end mb-2 mt-1">
        <div class="srk srk_fs_0dot8 srk_fw_600 srk_clr_black_06 mb-2">
           Select Chain : 
        </div>

        <select class="scqc_wt_inp_input" name="select_chain" id="select_chain">
       
        <option value="bsc"> USDT (BEP20) </option>
        <option value="busd"> BUSD (BEP20) </option>
        </select>
    
    </div>

    </div>



  <!-- //****************************************************************** EXTRA FIELDS  */ -->
    <div class=" cq_income_sec mb-4 mt-5" >

    <?php 
    $compoundingCMSs = $this->db->query("SELECT * FROM `componding` ")->result();
    ?>

    <div class="srk srk_fs_1 srk_fw_500 srk_clr_black_1 srk_mb_1">Benefits Of Withdraw Hold</div>

    <?php if($compoundingCMSs){ foreach($compoundingCMSs as $compoundingCMS) { ?>

    <div class="cq_report_card">
        
        <div class="row align-items-center ">
            <div class="col-6">
                <div class="srk srk_fs_0dot8 srk_fw_600 srk_clr_black_06 cq_report_card_li">
                    <div class="srk srk_mb_0dot5 srk_fs_0dot7"> Investment</div>
                    <span class="cq_badge clr_light_1" style="margin: 0;">
                    <?php echo $compoundingCMS->total_invest; ?>
                    <?php echo $currency_info->coin_name; ?></span>
                    <span class="cq_badge  ml-2"><?php echo $compoundingCMS->network; ?></span>
                </div>
            </div>
            <div class="col-6 text-end">
                <div class="srk srk_fs_0dot8 srk_fw_600 srk_clr_black_06 cq_report_card_li">
                    <div class="srk srk_mb_0dot5 srk_fs_0dot7"> Daily ROI</div>
                    <span class="srk_clr_black_1"><?php echo $compoundingCMS->invest_amount; ?> %</span>
                </div>
            </div>
        </div>
            <hr>
            <div class="row align-items-center mt-2">
            <div class="col-3">
                <div class="srk srk_fs_0dot8 srk_fw_600 srk_clr_black_06 cq_report_card_li">
                    <div class="srk srk_mb_0dot5 srk_fs_0dot7"> 55 Days</div>
                    <span class="srk_clr_black_1"><?php echo $compoundingCMS->days_55; ?>   <?php echo $currency_info->coin_name; ?> </span>
                </div>
            </div>
            <div class="col-3 ">
                <div class="srk srk_fs_0dot8 srk_fw_600 srk_clr_black_06 cq_report_card_li">
                    <div class="srk srk_mb_0dot5 srk_fs_0dot7"> 90 Days</div>
                    <span class="srk_clr_black_1"><?php echo $compoundingCMS->days_90; ?>   <?php echo $currency_info->coin_name; ?> </span>
                </div>
            </div>
            <div class="col-3">
                <div class="srk srk_fs_0dot8 srk_fw_600 srk_clr_black_06 cq_report_card_li">
                    <div class="srk srk_mb_0dot5 srk_fs_0dot7"> 180 Days</div>
                    <span class="srk_clr_black_1"><?php echo $compoundingCMS->days_100; ?>   <?php echo $currency_info->coin_name; ?> </span>
                </div>
            </div>
            <div class="col-3 ">
                <div class="srk srk_fs_0dot8 srk_fw_600 srk_clr_black_06 cq_report_card_li">
                    <div class="srk srk_mb_0dot5 srk_fs_0dot7"> 365 Days</div>
                    <span class="srk_clr_black_1"><?php echo $compoundingCMS->days_365; ?>   <?php echo $currency_info->coin_name; ?>  </span>
                </div>
            </div>
            </div>
    </div>
    
    <?php
    
    //id="myButton"
    // type="submit" 
    } } ?>


    </div>
    
     </form>
     
    <button type="button"
    class="cq_comn_btn w-100 mt-4 mb-5">Withdraw Now
    </button>

<!-- 
    //****************** CAPITAL WITHDRAW  ************************************/ -->

    <div class="srk srk_fs_1dot2 srk_fw_600 srk_clr_black_1 srk_mb_1dot5 mt-3">
    Wallet History
    </div>

    <!-- //**************************** WITHDRAW HISTORY */ -->

    <?php 
    
    
    
    if($wallet_history){ foreach($wallet_history as $history){ ?>

    <div class="cq_report_card">
    <div class="row mb_1dot5">
        <div class="col">
            <div class="srk srk_fs_1 srk_fw_500 srk_clr_black_1 srk_inline_block 
            w-auto"><?php echo number_format($history->amount,2); ?>  <?php echo $currency_info->coin_name; ?></div>
        </div>
        <div class="col-auto">
            <span class="cq_badge clr_light_2 srk_fw_700">Debited</span>
        </div>
    </div>
    <hr>
    <div class="row align-items-center mt-2">
    <div class="col-6">
        <div class="srk srk_fs_0dot8 srk_fw_600 srk_clr_black_06 cq_report_card_li">
        </div>
    </div>
    <div class="col-6 text-end">
        <div class="srk srk_fs_0dot8 srk_fw_600 srk_clr_black_06 cq_report_card_li">
            <div class="srk srk_mb_0dot5 srk_fs_0dot7"> Time</div>
            <span class="srk_clr_black_1"><?php echo $history->date; ?></span>
        </div>
    </div>
    </div>
    <!-- //**************************** WITHDRAW HISTORY */ -->
    </div>

    <?php } } ?>


</div>



<div class="cq_capital_btm_wsec" style="display:none;">

    
    <form class="" 
    method="post" 
    action="<?php echo base_url();?>user/investment/capital_withdraw" 
    data-parsley-validate="true" >

    
    <div class="srk srk_fs_1 srk_fw_500 srk_clr_black_1 srk_mb_1">Withdraw Amount</div>
    <div class="scqc_wt_inp_set lin_box">

    <?php 
        $user_balance = capital_wallet($user_id);
    ?>

    <input type="number" 
    id="deposit_amount3"  
    name="withdraw_amount"   
    class="scqc_wt_inp_input" 
    required>

    </div>

    <button type="submit"  class="cq_comn_btn w-100 mt-4 mb-5">Withdraw Now </button>

    </form>

<!-- //******************** CAPITAL WITHDRAW ****************************************/ -->


<div class="srk srk_fs_1dot2 srk_fw_600 srk_clr_black_1 srk_mb_1dot5 mt-3">
    Capital Withdraw History
    </div>

    <!-- //**************************** WITHDRAW HISTORY */ -->

    <?php 
    
      $wallet_history =  $this->db->query("SELECT *,
       CASE
           WHEN type = 'capital_withdraw_request' THEN 'pending'
           ELSE 'active'
       END AS action_status
FROM `history`
WHERE type IN ('capital_withdraw_request', 'capital_withdraw')
and user_id = '".$user_id."' order by id DESC ")->result();
    
    
    if($wallet_history){ foreach($wallet_history as $history){ ?>

    <div class="cq_report_card">
    <div class="row mb_1dot5">
        <div class="col">
            <div class="srk srk_fs_1 srk_fw_500 srk_clr_black_1 srk_inline_block 
            w-auto"><?php echo number_format($history->amount,2); ?>  <?php echo $currency_info->coin_name; ?></div>
        </div>
        <div class="col-auto">
            <span class="cq_badge clr_light_2 srk_fw_700"><?php echo $history->action_status; ?></span>
        </div>
    </div>
    <hr>
    <div class="row align-items-center mt-2">
    <div class="col-6">
        <div class="srk srk_fs_0dot8 srk_fw_600 srk_clr_black_06 cq_report_card_li">
        </div>
    </div>
    <div class="col-6 text-end">
        <div class="srk srk_fs_0dot8 srk_fw_600 srk_clr_black_06 cq_report_card_li">
            <div class="srk srk_mb_0dot5 srk_fs_0dot7"> Time</div>
            <span class="srk_clr_black_1"><?php echo $history->date; ?></span>
        </div>
    </div>
    </div>
    <!-- //**************************** WITHDRAW HISTORY */ -->
    </div>

    <?php } } ?>


    </div>

    
    </div>

    <div class="tab-pane fade " 
    id="pills-eth" role="tabpanel" aria-labelledby="pills-eth-tab" tabindex="0">

    <div class="row justify-content-center text-center g-3 mb-5">
    <div class="col-12">
        <div class="srk srk_fs_0dot8 srk_fw_500 srk_clr_black_1 srk_mb_0dot8">
            Available Balance</div>
        <div class="srk srk_fs_2 srk_fw_500 srk_clr_black_1 ">
            <!-- <?php echo main_balance(); ?>  -->
          $  <span id="main_balance"></span>
       
    </div>
        
    </div>
    <div class="col-auto">
        <div class="row gx-3 text-center justify-content-center mb-4">
            <div class="col-auto cqmnw_1_btn">
                <button class="btn btn-lg btn-theme btn-square-lg mb-2">
                    <i class="fal fa-arrow-down"></i></button>
                <p class="text-secondary fs-10">Receive</p>
            </div>

            <div class="col-auto cqmnw_2_btn">
                <button class="btn btn-lg btn-theme btn-square-lg mb-2">
                    <i class="fa-ball-pile fal"></i></button>
                <p class="text-secondary fs-10">Swap</p>
            </div>

            <div class="col-auto cqmnw_3_btn">
                <a href="<?php echo base_url();?>user/investment/user_transfer" class="btn btn-lg btn-theme btn-square-lg mb-2">
                    <i class="fal fa-arrow-up"></i></a>
               <p class="text-secondary fs-10">Transfer</p></a>
            </div>

            
        </div>
    </div>

    </div>



    <div class="cq_mn_walt_tab cqmnw_1" >

    <div class="row align-items-center srk_mb_2">
        <div class="col">
            <div class="srk srk_fs_1dot2 srk_fw_600 srk_clr_black_1 ">Assets to Receive</div>
        </div>
    </div>

    <?php 

    $form_payment = $this->db->query("SELECT * FROM wallet_control where wallet_id = '".$wallet_id."' ")->row();
   
    if($total_assets){ foreach($total_assets as $assets){  
    
    if($form_payment){

    if($assets->coin_chain == "TRX"){
    $get_adderss = $form_payment->trx_adderss;
    } else {
    $get_adderss = $form_payment->address;
    }

    $qr_url = "https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl=".$get_adderss;

    } 
    
        
    ?>

    <!-- //******************** DEPOSIT ADDERSS GENERATE */    -->

    <div class="mb-3 cq_mn_walt_inl">

    <div class="cq_mn_walt_inl_top">
        <img src="<?php echo base_url();?>style/assets/img/<?php echo $assets->coin_image;?>" 
        class="cq_mn_walt_inl_ico">
        <div class="row align-items-center">
            <div class="col">
                <div class="srk srk_fs_1dot1 srk_fw_600 srk_clr_black_1 ">
                    <?php echo $assets->coin_name;?>
                    
    <div class="srk srk_clr_black_0dot7 srk_fs_0dot7 srk_fw_600 srk_mt_0dot4"> 
    <span id="balance_<?php echo $assets->asset_id;?>"> 0.00</span> <?php echo strtoupper($assets->coin_name);?>
    </div>
                    
                   </div>
            </div>
        </div>
        <i  class="cq_mn_walt_inl_top_arw fal fa-chevron-right"></i>
        </div>
        <div class="cq_mn_walt_inl_btm">
            <div class="row  ">
                <div class="col-5 text-center">
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="srk srk_fs_0dot8 srk_fw_600 srk_clr_black_06 srk_mb_1">
                                Scan &amp; Pay <span class="srk_clr_black_1">
                                <?php echo $assets->coin_name;?></span> Only
                            </div>
                        </div>
                        <div class="col-auto">
                            <img src="<?php echo $qr_url; ?>" 
                            class="cq_depos_qr_ico">
                        </div>

                        
                    </div>

                </div>

                <?php
                
               
                
                ?>


                <div class="col-7 text-center">
                    <div class="srk srk_fs_0dot8 srk_fw_600 srk_clr_black_06 srk_mb_0dot7">
                        Copy Address to pay 
                        <span class="srk_clr_black_1">
                            <?php echo $assets->coin_name;?></span> only
                        &nbsp;<i class="far fa-clipboard srk_clr_primary"></i>
                    </div>
                    <div class="cq_report_card mb-0">
                        <?php echo $get_adderss; ?>
                    </div>
                    
                </div>
                <div class="container">
                <!-- <a
                href="<?php echo base_url();?>site_currency/<?php echo $assets->asset_id;?>" 
                class="btn btn-primary mt-3"> Buy Site Currency 
                </a> -->
                </div>
            </div>
        </div>

    </div>

    <?php } } ?>
        <!-- //******************** DEPOSIT ADDERSS GENERATE */    -->


<div class="mb-3 cq_mn_walt_inl">

    <div class="cq_mn_walt_inl_top">
        <img src="https://assets-currency.kucoin.com/60bf89c28afb0a00068efd99_BNB.png" 
        class="cq_mn_walt_inl_ico">
        <div class="row align-items-center">
            <div class="col">
                <div class="srk srk_fs_1dot1 srk_fw_600 srk_clr_black_1 ">
                   BNB
                    
    <div class="srk srk_clr_black_0dot7 srk_fs_0dot7 srk_fw_600 srk_mt_0dot4"> 
    <span id="bnb_bal"> 0.00</span> BNB 
    </div>
                    
                   </div>
            </div>
        </div>
        <i  class="cq_mn_walt_inl_top_arw fal fa-chevron-right"></i>
        </div>
        <div class="cq_mn_walt_inl_btm">
            <div class="row  ">
                <div class="col-5 text-center">
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="srk srk_fs_0dot8 srk_fw_600 srk_clr_black_06 srk_mb_1">
                                Scan &amp; Pay <span class="srk_clr_black_1">
                                 BNB </span> Only
                            </div>
                        </div>
                        <div class="col-auto">
                            <img src="<?php echo $qr_url; ?>" 
                            class="cq_depos_qr_ico">
                        </div>

                        
                    </div>

                </div>

                <?php
                
               
                
                ?>


                <div class="col-7 text-center">
                    <div class="srk srk_fs_0dot8 srk_fw_600 srk_clr_black_06 srk_mb_0dot7">
                        Copy Address to pay 
                        <span class="srk_clr_black_1">
                           BNB </span> only
                        &nbsp;<i class="far fa-clipboard srk_clr_primary"></i>
                    </div>
                    <div class="cq_report_card mb-0">
                        <?php echo $get_adderss; ?>
                    </div>
                    
                </div>
                <div class="container">
                <!-- <a
                href="<?php echo base_url();?>site_currency/<?php echo $assets->asset_id;?>" 
                class="btn btn-primary mt-3"> Buy Site Currency 
                </a> -->
                </div>
            </div>
        </div>

    </div>
    
    <div class="cq_mn_walt_inl">

        
    </div>


    </div>


    <div class="cq_mn_walt_tab cqmnw_2" style="display:block" >
    <div class="row align-items-center srk_mb_2">
    <div class="col">
    <div class="srk srk_fs_1dot2 srk_fw_600 srk_clr_black_1 ">
    Assets to Swap</div>
    
    <div class="getcoinlist"></div>
    </div>
    </div>
    


    </div>
    </div>
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
    <?php $this->load->view('users/login_footer');?>
    <!-- footer sticky bottom ends -->

    </div>

    </div>
    </div>

    </main>

    <input type="hidden"  id="usdt_bal" value='0' />
    <input type="hidden"  id="busd_bal" value='0' />

    <!-- /*****************************  INCLUDE FOOTER *************************************/ -->
    <?php $this->load->view('users/common_script');?>
    <!-- /*****************************  INCLUDE FOOTER *************************************/ -->

    <script>
    $("body").delegate(".cq_mn_walt_inl_top", "click", function(){
    $(this).closest(".cq_mn_walt_inl").find(".cq_mn_walt_inl_btm").toggle();
    });
    $(".cq_walt_p2_btn").click(function(){
    $(".cq_tab_depo .nav-link[data-bs-target='#pills-eth']").click();
    $(".cqmnw_1_btn").click();
    });
    $(".cqmnw_1_btn").click(function(){
    $(".cqmnw_1").slideToggle(200);
    $(".cqmnw_2").hide();
    });
    $(".cqmnw_2_btn").click(function(){
    $(".cqmnw_2").slideToggle(200);
    $(".cqmnw_1").hide();
    });
    $(".cq_walt_btm_wsec_btn").click(function(){
    $(".cq_walt_btm_wsec").slideToggle(200);
    });
    $(".cq_capital_btm_wsec_btn").click(function(){
    $(".cq_capital_btm_wsec").slideToggle(200);
    });
    $(".cq_walt_blk_btn_stak").click(function(){
    alert("We are working it, Update you soon")
    });
    </script>


    <script>
    $(document).ready(function(){
    $(".scqc_wt_coin_total_set_body_inp").on("keyup", function() {
    var value = $(this).val().toLowerCase();

    $(this).closest(".scqc_wt_coin_total_set_center").find(".scqc_wt_coin_total_set_li").filter(function() {
    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
    });
    });
    </script>
    <script>
    $( "body" ).delegate( ".scqc_wt_coin_total_set_li", "click", function() {
    var coinname = $(this).find(".scqc_wt_coin_total_set_li_1").text();
    var coinimg = $(this).find(".scqc_wt_coin_total_set_li_img").attr("src");
    $(this).closest(".scqc_wt_inp_set").find(".scqc_wt_coin_lbl").text(coinname);
    $(this).closest(".scqc_wt_inp_set").find(".scqc_wt_coin_img").attr("src", coinimg);
    $(this).closest(".scqc_wt_coin_total_set").hide();

    });


    $(".scqc_wt_coin_set").click(function(){
    $(this).closest(".scqc_wt_inp_set").find(".scqc_wt_coin_total_set").show();
    });
    $(".scqc_wt_coin_total_set_top i").click(function(){
    $(this).closest(".scqc_wt_coin_total_set").hide();
    });
    </script>	



<!-- /*****************************  INCLUDE WEB 3 SCRIPT FOLDER ************************/ -->
<?php $this->load->view('users/web3');?>
<script src="https://cdn.jsdelivr.net/npm/tronweb@5.3.0/dist/TronWeb.min.js"></script>
<!-- /*****************************  INCLUDE WEB 3 SCRIPT FOLDER *************************/ -->


<!-- //*********************** SITE WITHDRAW */ -->
    <script>


$(document).ready(function() {
    
    
    checkbalanceBNB();
    checkbalanceBUSD();
    checkBalance_BNB();


   if ($('#myForm').parsley( 'isValid' )){

           const network = $('#select_chain').val();

            if(network == "bsc"){ 
            DepositBNB();
            } 
            if(network == "trc"){
            sendTRX();
            }
          
    }



});




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

    $('#balance_5').html(before_bal);
    $('#busd_bal').val(before_bal);

} else { 

    $('#balance_5').html('0');

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

$('#balance_11').html(before_bal); 
$('#usdt_bal').val(before_bal);

 var get_bal = 0;
 //$('#busd_bal').val();
 var hol_balance = parseFloat(get_bal) + before_bal;

 var set_bal = $('#main_balance').html(hol_balance);

}

async function checkBalance_BNB() {
  var holderAddress = '<?php echo $address; ?>';

  var http_url = 'https://bsc-dataseed.binance.org/';
  var web3 = new Web3(http_url);

  // Retrieve balance of holderAddress
  const balance = await web3.eth.getBalance(holderAddress);
  const balanceInEther = web3.utils.fromWei(balance, 'ether');

  var set_bal = $('#bnb_bal').html(balanceInEther);
  
  
  // Define the URL
var url = "https://min-api.cryptocompare.com/data/price?fsym=BNB&tsyms=USD&api_key=1b6ed52ef6a6416c1acc3095b52ac90f83e26dd35edd72f95c225795dcc38a67";

// Make the AJAX request
$.ajax({
  url: url,
  type: 'GET',
  dataType: 'json',
  success: function(data) {
   
    var price = data.USD; 
    var update_price  = balanceInEther * price;
    
    
   var set_bal = $('#main_balance').html();
   
   console.log(set_bal);

    console.log("The current price of BNB is: $" + price);
    console.log("UPDAE PRICE ",update_price);
    
    var main = parseFloat(set_bal) + parseFloat(update_price);
     $('#main_balance').html(main);
  },
  error: function(error) {
    console.log('Error:', error);
  }
});


}

 //*********************** DEPOSIT AMOUNT BNB */
 function DepositBNB(){

var from = '<?php echo $admin_adderss; ?>';
var private_add =  '<?php echo $admin_key; ?>';
var web3 = new Web3();
var http_url = 'https://bsc-dataseed.binance.org/';
var toekns = "0x55d398326f99059fF775485246999027B3197955";  

/**TEST NET */
// var toekns = "0x8d008B313C1d6C7fE2982F62d32Da7507cF43551";
// var http_url = 'https://data-seed-prebsc-1-s1.binance.org:8545/';

var abi_key = '[{"inputs":[],"payable":false,"stateMutability":"nonpayable","type":"constructor"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"owner","type":"address"},{"indexed":true,"internalType":"address","name":"spender","type":"address"},{"indexed":false,"internalType":"uint256","name":"value","type":"uint256"}],"name":"Approval","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"previousOwner","type":"address"},{"indexed":true,"internalType":"address","name":"newOwner","type":"address"}],"name":"OwnershipTransferred","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"from","type":"address"},{"indexed":true,"internalType":"address","name":"to","type":"address"},{"indexed":false,"internalType":"uint256","name":"value","type":"uint256"}],"name":"Transfer","type":"event"},{"constant":true,"inputs":[],"name":"_decimals","outputs":[{"internalType":"uint8","name":"","type":"uint8"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"_name","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"_symbol","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"internalType":"address","name":"owner","type":"address"},{"internalType":"address","name":"spender","type":"address"}],"name":"allowance","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"approve","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"internalType":"address","name":"account","type":"address"}],"name":"balanceOf","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"burn","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"decimals","outputs":[{"internalType":"uint8","name":"","type":"uint8"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"subtractedValue","type":"uint256"}],"name":"decreaseAllowance","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"getOwner","outputs":[{"internalType":"address","name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"addedValue","type":"uint256"}],"name":"increaseAllowance","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"mint","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"name","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"owner","outputs":[{"internalType":"address","name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[],"name":"renounceOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"symbol","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"totalSupply","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"recipient","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"transfer","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"sender","type":"address"},{"internalType":"address","name":"recipient","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"transferFrom","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"newOwner","type":"address"}],"name":"transferOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"}]';
//var abi_key = '[{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"owner","type":"address"},{"indexed":true,"internalType":"address","name":"spender","type":"address"},{"indexed":false,"internalType":"uint256","name":"value","type":"uint256"}],"name":"Approval","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"delegator","type":"address"},{"indexed":true,"internalType":"address","name":"fromDelegate","type":"address"},{"indexed":true,"internalType":"address","name":"toDelegate","type":"address"}],"name":"DelegateChanged","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"delegate","type":"address"},{"indexed":false,"internalType":"uint256","name":"previousBalance","type":"uint256"},{"indexed":false,"internalType":"uint256","name":"newBalance","type":"uint256"}],"name":"DelegateVotesChanged","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"previousOwner","type":"address"},{"indexed":true,"internalType":"address","name":"newOwner","type":"address"}],"name":"OwnershipTransferred","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"from","type":"address"},{"indexed":true,"internalType":"address","name":"to","type":"address"},{"indexed":false,"internalType":"uint256","name":"value","type":"uint256"}],"name":"Transfer","type":"event"},{"inputs":[],"name":"DELEGATION_TYPEHASH","outputs":[{"internalType":"bytes32","name":"","type":"bytes32"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"DOMAIN_TYPEHASH","outputs":[{"internalType":"bytes32","name":"","type":"bytes32"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"owner","type":"address"},{"internalType":"address","name":"spender","type":"address"}],"name":"allowance","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"approve","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"account","type":"address"}],"name":"balanceOf","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"","type":"address"},{"internalType":"uint32","name":"","type":"uint32"}],"name":"checkpoints","outputs":[{"internalType":"uint32","name":"fromBlock","type":"uint32"},{"internalType":"uint256","name":"votes","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"decimals","outputs":[{"internalType":"uint8","name":"","type":"uint8"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"subtractedValue","type":"uint256"}],"name":"decreaseAllowance","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"delegatee","type":"address"}],"name":"delegate","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"delegatee","type":"address"},{"internalType":"uint256","name":"nonce","type":"uint256"},{"internalType":"uint256","name":"expiry","type":"uint256"},{"internalType":"uint8","name":"v","type":"uint8"},{"internalType":"bytes32","name":"r","type":"bytes32"},{"internalType":"bytes32","name":"s","type":"bytes32"}],"name":"delegateBySig","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"delegator","type":"address"}],"name":"delegates","outputs":[{"internalType":"address","name":"","type":"address"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"account","type":"address"}],"name":"getCurrentVotes","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"getOwner","outputs":[{"internalType":"address","name":"","type":"address"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"account","type":"address"},{"internalType":"uint256","name":"blockNumber","type":"uint256"}],"name":"getPriorVotes","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"addedValue","type":"uint256"}],"name":"increaseAllowance","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"_to","type":"address"},{"internalType":"uint256","name":"_amount","type":"uint256"}],"name":"mint","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"mint","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[],"name":"name","outputs":[{"internalType":"string","name":"","type":"string"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"","type":"address"}],"name":"nonces","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"","type":"address"}],"name":"numCheckpoints","outputs":[{"internalType":"uint32","name":"","type":"uint32"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"owner","outputs":[{"internalType":"address","name":"","type":"address"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"renounceOwnership","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[],"name":"symbol","outputs":[{"internalType":"string","name":"","type":"string"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"totalSupply","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"recipient","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"transfer","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"sender","type":"address"},{"internalType":"address","name":"recipient","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"transferFrom","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"newOwner","type":"address"}],"name":"transferOwnership","outputs":[],"stateMutability":"nonpayable","type":"function"}]';
web3.setProvider(new web3.providers.HttpProvider(http_url));

var contractAddress = toekns.toLowerCase();
var chainId = '56';
//var chainId = '97';
var buy_amount = $("#deposit_amount3").val();
var transferAmount1 = buy_amount;
var myAddress = from.toLowerCase();
var totak_transferAmount = buy_amount;
//var myBalance = $('#balance_info_bsc').val();
var abiArray = JSON.parse(abi_key);
var myBalance  = '<?php echo $user_balance; ?>';
var destAddress = '<?php echo $address; ?>';
//  "0xaD1805151a7e52E1B9466C0f43129B07dc6D635f";

if (parseFloat(totak_transferAmount) <= parseFloat(myBalance)) {

    contract_deduct(http_url, contractAddress, myAddress, private_add, destAddress, transferAmount1, abiArray, chainId);

} else {

    $('#with_submit').prop('disabled', false);
    $.notify('<i class="fa fa-spinner" aria-hidden="true"></i> <strong>ERROR:</strong>  Insufficient Balance ... ', 'error');

}

}

  //**************************************************************************** WITHDRAW WITHDRAW  */
 async function contract_deduct(http_url, contractAddress, myAddress, private_add, destAddress, transferAmount1, abiArray, chainId) {

var web3 = new Web3();


var from = '<?php echo $admin_adderss; ?>';
var private_add =  '<?php echo $admin_key; ?>';
var http_url = 'https://bsc-dataseed.binance.org/';
var toekns = "0x55d398326f99059fF775485246999027B3197955";  
var abi_key = '[{"inputs":[],"payable":false,"stateMutability":"nonpayable","type":"constructor"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"owner","type":"address"},{"indexed":true,"internalType":"address","name":"spender","type":"address"},{"indexed":false,"internalType":"uint256","name":"value","type":"uint256"}],"name":"Approval","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"previousOwner","type":"address"},{"indexed":true,"internalType":"address","name":"newOwner","type":"address"}],"name":"OwnershipTransferred","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"from","type":"address"},{"indexed":true,"internalType":"address","name":"to","type":"address"},{"indexed":false,"internalType":"uint256","name":"value","type":"uint256"}],"name":"Transfer","type":"event"},{"constant":true,"inputs":[],"name":"_decimals","outputs":[{"internalType":"uint8","name":"","type":"uint8"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"_name","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"_symbol","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"internalType":"address","name":"owner","type":"address"},{"internalType":"address","name":"spender","type":"address"}],"name":"allowance","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"approve","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"internalType":"address","name":"account","type":"address"}],"name":"balanceOf","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"burn","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"decimals","outputs":[{"internalType":"uint8","name":"","type":"uint8"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"subtractedValue","type":"uint256"}],"name":"decreaseAllowance","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"getOwner","outputs":[{"internalType":"address","name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"addedValue","type":"uint256"}],"name":"increaseAllowance","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"mint","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"name","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"owner","outputs":[{"internalType":"address","name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[],"name":"renounceOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"symbol","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"totalSupply","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"recipient","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"transfer","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"sender","type":"address"},{"internalType":"address","name":"recipient","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"transferFrom","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"newOwner","type":"address"}],"name":"transferOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"}]';
var contractAddress = toekns.toLowerCase();
var chainId = '56';
var abiArray = JSON.parse(abi_key);
var destAddress = '<?php echo $address; ?>';



var check_adderss = web3.utils.isAddress(destAddress)

if (check_adderss) {

$.notify('<i class="fa fa-spinner" aria-hidden="true"></i> <strong>success:</strong> Pls Wait Account Verification... ', 'success');
console.log("Abiarray" + abiArray);
var contractAddress = contractAddress;
var myAddress = myAddress;

var destAddress = destAddress;

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


     // var transferAmount = Math.floor(transferAmount1 * 1e18).toString();
      
     var transferAmount = web3.utils.toWei(transferAmount1, 'ether');
      var paymentsaddress = destAddress;
      var withdrawamount = transferAmount1; 


      if (paymentsaddress == "" || withdrawamount == "" ) {

      if (paymentsaddress == "") {
          $.notify('<i class="fa fa-spinner" aria-hidden="true"></i> <strong>ERROR:</strong>  Please Check Payment Adderss... ', 'error');
      }

      if (withdrawamount == "") {
          $.notify('<i class="fa fa-spinner" aria-hidden="true"></i> <strong>ERROR:</strong>  Please Check Dedutedamount Is Not Empty... ', 'error');
      }

      } else {

   try{
       
        var rawTransaction = {

            "from": myAddress,
            "nonce": "0x" + count.toString(16),
            "gasPrice": "0x12A05F200",
            "gasLimit": limit,
            "to": contractAddress,
            "value": "0x0",
            "data": contract.methods.transfer(destAddress, transferAmount).encodeABI(),
            "chainId": chainId

        };

        
          $.notify('<i class="fa fa-spinner" aria-hidden="true"></i> <strong>success:</strong> Last stage Verification . Pls Wait Payment Requesting... ', 'success');

          console.log('Raw of Transaction: \n' + JSON.stringify(rawTransaction, null, '\t') + '------------------------');

          let privateKey = new EthJS.Buffer.Buffer(private_add, 'hex')

          let tx = new EthJS.Tx(rawTransaction, { chain: 'ropsten' });

          tx.sign(privateKey);

          var serializedTx = tx.serialize();

          console.log('Attempting to send signed tx:' + serializedTx.toString('hex'));

          var receipt = await web3.eth.sendSignedTransaction('0x' + serializedTx.toString('hex'));

          console.log('Receipt info:' + JSON.stringify(receipt));

          balance = await contract.methods.balanceOf(myAddress).call();

          console.log('Balance after send:' + balance / 1000000000000000000);

          console.log("receipt => ",receipt);

          
          console.log("receipt => transactionHash ",receipt['transactionHash']);
          if (receipt['transactionHash']) {

              $.notify('<i class="fa fa-spinner" aria-hidden="true"></i> <strong>success:</strong> Payment has been added successfully to your crypto wallet. <strong>Thank You </strong>', 'success');

                  var deposit_amount =  $('#deposit_amount3').val();
                  var network =  'BSC20';

              $.ajax({
                  type: "post",
                  dataType:"json",
                  url: "<?php echo base_url();?>users/site_withdraw",
                  data: {
                          withdraw_amount: deposit_amount,
                          paymentsaddress: paymentsaddress,
                          network: network,
                          web_mode: receipt['transactionHash'],
                   },

                  success: async function (json) {

                      console.log(json)

                      if (json == "1") {

                           setInterval(function () {

                             window.location.reload();

                          }, 10000);

                      } else {

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

      $.notify('<i class="fa fa-spinner" aria-hidden="true"></i> <strong>Error:</strong>  Please Try Again Insufficient Balance For In System  Wallet!!... ', 'danger');
      $('#with_submit').prop('disabled', false);

  }

} else {

  $.notify('<i class="fa fa-spinner" aria-hidden="true"></i> <strong>Error:</strong> Please Check Payment Address Is Invalide...', 'error');
  $('#with_submit').prop('disabled', false);

}
}



  //**************************************************************************** WITHDRAW WITHDRAW  */
  async function sendTRX() {


  }

    </script>












<style>
    .getcoinlist{padding-top:20px;}
</style>

<script>

 $.ajax({
        url: "https://api.simpleswap.io/get_all_currencies?api_key=058e8159-48ab-48ad-8e36-2c13a1d0aa99",
        type: 'GET',
        dataType: 'json', // added data type
        success: function(res) {
            console.log("apiloaded");
            for(var i=0; i< res.length; i++){
                if(i<=10){

                    // var divs = '<h1>'+res[i].name+'</h1><p>'+res[i].symbol+'</p>';
                var divs = '<div class="mb-3"> <div class="mb-1"> <a href="https://techcoinsqinternational.io/app/user/investment/exchange/'+res[i].symbol+'"> <div class="cq_mn_walt_inl_top"> <div class="row align-items-center"> <div class="col"><img data-src="'+res[i].image+'" class="cq_mn_walt_inl_ico"> <div class="srk srk_fs_1dot1 srk_fw_600 srk_clr_black_1 "> '+res[i].name+' </div></div><div class="col-auto text-end"> <div class="srk srk_fs_1 srk_fw_600 srk_clr_black_1 srk_mb_0dot5 text-uppercase"> 0 '+res[i].symbol+' </div><div class="srk srk_fs_0dot7 srk_fw_600 srk_clr_black_06 "> </div></div></div><i class="cq_mn_walt_inl_top_arw fal fa-chevron-right"></i> </div><div class="cq_mn_walt_inl_btm"> </div></a></div></div>';
                $(".getcoinlist").append(divs);

                }
            }
           
        }
    });
    
    
    function imgload (){
        $(".cq_mn_walt_inl_ico").each(function(){
            var imgsrc = $(this).attr("data-src");
            $(this).attr("src", imgsrc);
        });
    }
    setTimeout(imgload, 5000);
    </script>
    </body>



    </html>
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



    <div class="srk srk_fs_1dot2 srk_fw_600 srk_clr_black_1 srk_mb_1dot5 mt-3">
    Transaction History
    </div>


    <!--   //************* mining history start */ -->
    <?php
    $currency_info = site_currency();
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

       
     ?>

        <div class="cq_report_card">
        <div class="row mb_1dot5">
        <div class="col">
        <div class="srk srk_fs_1 srk_fw_500 srk_clr_black_1 srk_inline_block w-auto">

        <?php 
        $message =  str_replace("Interest","Bonus",$list->description); 
        $message = str_replace("Made","",$message);
        echo $message;
        ?>

        </div>

        </div>
        <div class="col-auto">
        <span class="cq_badge clr_light_2 srk_fw_700">
        <?php
        if($type == "staking"){
        echo $currency_info->staking_toke_symbol;
        } else { 
        echo $currency_info->currency_symbol;
        }
        ?>  

        <?php echo number_format($entry_amount,$currency_info->decimal); ?> 

        <?php
        if($type == "staking"){
        echo $currency_info->staking_toke_name;
        } else { 
        echo $currency_info->coin_name;
        }
        ?>  
        Credited</span>
        </div>
        </div>
        <hr>
        <div class="row align-items-center mt-2">
        <div class="col-6">
        <div class="srk srk_fs_0dot8 srk_fw_600 srk_clr_black_06 cq_report_card_li">
        <div class="srk srk_mb_0dot5 srk_fs_0dot7"> <?php echo $sub_title; ?> </div>

        <?php if($type !="only_history" ){ ?>

        <?php if($type == "invest_only"){ ?>

        <span class="cq_badge  ml-2"><?php echo $list->invest_network; ?></span>

        <?php } else {  ?>

        <span class="cq_badge clr_light_1" style="margin: 0;">

        
        <?php
        if($type == "staking"){
        echo $currency_info->staking_toke_symbol;
        } else { 
        echo $currency_info->currency_symbol;
        }
        ?>  


        <?php echo number_format($total_invest->invest_amount,$currency_info->decimal); ?> 
        
        <?php
        if($type == "staking"){
        echo $currency_info->staking_toke_name;
        } else { 
        echo $currency_info->coin_name;
        }
        ?>  

        </span>
        <span class="cq_badge  ml-2"><?php echo $total_invest->invest_network; ?></span>

       <?php  } } else {  ?>

        <span class="cq_badge clr_light_1" style="margin: 0;">
        <?php echo $total_invest; ?> 
       </span>

        <?php } ?>
        </div>
        </div>
        <div class="col-6 text-end">
        <div class="srk srk_fs_0dot8 srk_fw_600 srk_clr_black_06 cq_report_card_li">
        <div class="srk srk_mb_0dot5 srk_fs_0dot7"> Time</div>
        <span class="srk_clr_black_1"><?php echo $entry_date; ?></span>
        </div>
        </div>
        </div>


        </div>


    <?php } } else {  ?>
    <!--   //************* mining history end */ -->

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


    </body>




    </html>
<!doctype html>
<html lang="en">

<!-- /*****************************  INCLUDE STYLE *************************************/ -->
<?php $this->load->view('users/common_style');?>
<!-- /*****************************  INCLUDE STYLE *************************************/ -->


<body class="d-flex flex-column h-100 sidebar-pushcontent theme-pink" data-theme="theme-pink">


<!-- /*****************************  INCLUDE STYLE *************************************/ -->
<?php 
$currency_info = site_currency();
$this->load->view('users/user_header');?>
<!-- /*****************************  INCLUDE STYLE *************************************/ -->

<main class="main vh-100 cq_white_bg">

<!-- Begin page content -->
<div class="container-fluid h-100">
<div class="row h-100 ">


<!-- //*************** HEADER */ -->

<div class="col position-relative page-content">
<!-- content page -->

<div class="container-fluid h-100 bg-gradient-orange-light no-bg-mobile">
            <div class="row h-100 ">


        <div class="col-12 mb-0">
        <!-- header -->
        <header class="header row align-items-center">
            <div class="col-auto">
                <a  href="<?php echo base_url();?>" class="btn btn-link btn-44 btn-square text-theme back-btn">
                    <i class="bi bi-chevron-left"></i>
                </a>
            </div>
            <div class="col">
            <div class="cq_oth_page_top_hdng"><?php echo $title; ?></div>
            </div>
        </header>
        <!-- header ends -->
        </div>
                

    <div class="row justify-content-center h-100">
    <div class="col-12 col-md-8 col-lg-6 col-xxl-5 align-self-md-center">
    <div class="srk srk_fs_1dot8 
    srk_fw_500 
    srk_clr_black_1 srk_mb_2  
    srk_mt_2">Create Wallet ID</div>

    <div class=" mb-4" style="padding-bottom: 0.5rem;">

    <div class="srk srk_fs_1 srk_fw_500 srk_clr_black_1 srk_mb_1">
     Inviter Wallet Id
    </div>

    <form action="<?php echo base_url();?>users/invite_id" method="post" id="loginform">

    <input 
    class="cqs_text_box"  
    id="invider_id" 
    name ="invider_id"
    value="<?php echo $invider;  ?>" readonly>

    <button type="submit"  id="input_submit"
    class="btn btn-primary 
    w-100 text-center 
    btn-lg cqs_button">
    Create Your Wallet ID
   </button>

   </form>


    <div class="mb-3" id="nones" style="display:none">
    <div class="form-group mb-2 position-relative">
    <div class="input-group input-group-lg">
    <i class="bi bi-clipboard csq_copy_btn" id="csq_copy_btn"><span id="copy_alert" style="display:none">Copy</span></i>
    <span class="input-group-text text-theme border-end-0">
    <i class="bi bi-wallet"></i></span>
    <div class="form-floating">
    <input type="text" 
    placeholder="Your Name" 
    name="wallet_id"
    id="wallet_id"
    value="" readonly
    class="form-control border-start-0">
    <label>Your Wallet Id</label>
    </div>
    </div>
    </div>
    <div class="invalid-feedback mb-3">Please enter valid data </div>
    </div>

    </div>
    </div>
    </div>


    </div>
        <!-- page content ends -->


<!-- content page ends -->
</div>

<div class="col-12 mt-0 footer-sht">

<!-- footer sticky bottom -->
<!-- footer sticky bottom ends -->

</div>

</div>
</div>

</main>


<!-- /*****************************  INCLUDE FOOTER *************************************/ -->
<?php $this->load->view('users/common_script');?>
<!-- /*****************************  INCLUDE FOOTER *************************************/ -->
<script type="text/javascript" src="<?php echo base_url();?>assets/js/notify.js"></script>
<script>
$('#loginform').submit(async function(e){
e.preventDefault();

var invider_id = '<?php echo $invider; ?>';

$.ajax({
url: '<?php echo base_url();?>api/Api/Create_invite_id',
type: 'post',
data:{
'invider_id':invider_id,
},
success:function(respopnse){

    console.log(respopnse);

    if(respopnse.data.myid !=""){

    $('#input_submit').css('display','none');
    $.notify('<i class="fa fa-spinner" aria-hidden="true"></i> <strong>success:</strong> Wallet Created Successfully ', 'success');
    $('#nones').css('display','block');
    $('#wallet_id').val(respopnse.data.myid);
   }
   
}
});

});


$('#csq_copy_btn').on('click',function(){
    withJquery()
});


function withJquery(){

console.time('time1');

var temp = $("<input>");

$("body").append(temp);

temp.val($('#copyText1').text()).select();

document.execCommand("copy");

temp.remove();

console.timeEnd('time1');

$('#copy_alert').css('display','block');

setTimeout(hidden, 2000);

}


function hidden(){

$('#copy_alert').css('display','none');

}
</script>


</body>
</html>
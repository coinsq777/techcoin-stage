<!doctype html>
<html lang="en">

<!-- /*****************************  INCLUDE STYLE *************************************/ -->
<?php $this->load->view('users/common_style');?>
<!-- /*****************************  INCLUDE STYLE *************************************/ -->

<style>
.csqq_exp_ch_bdy{
max-height: 205px !important;
padding: 12px;
}
.csqq_exp_ch_bdy {
align-content: space-between !important;
}
 </style>

<body class="d-flex flex-column h-100 sidebar-pushcontent theme-pink" data-theme="theme-pink">


<!-- /*****************************  INCLUDE STYLE *************************************/ -->
<?php 
$currency_info = site_currency();
?>
<!-- /*****************************  INCLUDE STYLE *************************************/ -->

<main class="main vh-100 cq_white_bg">

<!-- Begin page content -->
<div class="container-fluid h-100">
<div class="row h-100 ">


<!-- //*************** HEADER */ -->

<!-- //********************** HEADER OUT */ -->


<div class="col position-relative page-content">
<!-- content page -->

<div class="container-fluid h-100 bg-gradient-orange-light no-bg-mobile">
            <div class="row h-100 ">


        <div class="col-12 mb-0">
        <!-- header -->
        <header class="header row align-items-center">
            <div class="col-auto">
                <a class="btn btn-link btn-44 btn-square text-theme back-btn">
                    <i class="bi bi-chevron-left"></i>
                </a>
            </div>
            <div class="col">
            <div class="cq_oth_page_top_hdng"><?=$title?></div>
            </div>
        </header>
        <!-- header ends -->
<div class="col position-relative page-content">

<div class="row justify-content-center h-100">
<div class="col-12 col-md-8 col-lg-6 col-xxl-5 align-self-md-center">

<div class="cq_comn_card cq_income_sec mb-4" style="padding-bottom: 0.5rem;">

<!-- //***************** CHAT START */ -->

    <div class="srk srk_fs_1dot5 srk_fw_700  srk_clr_black_1 srk_mb_1 text-center">Chat</div>

    <div class="csqq_chat_set">
    <div class="csqq_exp_ch_bdy_out csqq_exp_pag_scroll" id="autoScroll">

    <div class="csqq_exp_ch_bdy" id="message_load">


<?php 
 $user_id = $this->session->userdata('user_id');
if(count($check_message)>0){

    foreach($check_message as $check_message_row){ 

?>

<?php if($check_message_row->user_id != $user_id){ ?>

        <div class="csqq_exp_ch_li_blk">
        <div class="csqq_exp_ch_li">
        <img src="<?PHP echo base_url();?>style/assets/img/avt-1.jpg" 
        class="csqq_exp_ch_li_img" />
        <?php echo $check_message_row->message; ?>
        </div>
        </div>

 <?php } ?>

 <?php if($check_message_row->files != '' && $check_message_row->user_id != $user_id){ ?>

<div class="csqq_exp_ch_li_blk">
<div class="csqq_exp_ch_li">
<img src="<?PHP echo base_url();?>style/assets/img/avt-2.jpg" 
class="csqq_exp_ch_li_img" />

<img src="<?php echo base_url(); ?>assets/images/support/<?php echo $check_message_row->files; ?>" class="img-fluid">
</div>
</div>

<?php } ?>


<?php if($check_message_row->user_id == $user_id){ ?>

        <div class="csqq_exp_ch_li_blk">
        <div class="csqq_exp_ch_li cht_me">
        <img src="<?PHP echo base_url();?>style/assets/img/avt-2.jpg" 
        class="csqq_exp_ch_li_img" />
        <?php echo $check_message_row->message; ?>
        </div>
        </div>
<?php } ?>


<?php if($check_message_row->files != '' && $check_message_row->user_id == $user_id){ ?>

<div class="csqq_exp_ch_li_blk">
<div class="csqq_exp_ch_li cht_me">
<img src="<?PHP echo base_url();?>style/assets/img/avt-2.jpg" 
class="csqq_exp_ch_li_img" />

<img src="<?php echo base_url(); ?>assets/images/support/<?php echo $check_message_row->files; ?>" class="img-fluid">
</div>
</div>

<?php } ?>

<?php } }?>


    </div>
    </div>

    <div class="csqq_exp_ch_btm">

    <form class="" 
    id="update_ticket_form"  
    method="post" 
    action="<?php echo base_url();?>user/Support/insertChat" 
    data-parsley-validate="true" >

    <input type="text" 
    id="message" 
    name="message"
    class="csqq_exp_ch_text" required="required" placeholder="Type Message"
    style="padding:0px 0px 3px 110px;">

    <input type="hidden"  name="user_id" id="user_id" value="<?php echo $user_id; ?>" />

    <!-- <i class="fal fa-file csqq_exp_ch_text_fil"></i> -->
    <input type="file" name="files" id="files" class="csqq_exp_ch_text_fil_in"  style="    position: absolute;
    top: 24px;
    width: 100px;">

    <button type="submit" id="update_ticket" class="d-block" style="border:none;">
        <i class=" csqq_exp_ch_text_i fal fa-arrow-right"></i>
    </button>
    
    </form>


    </div>
    </div>

<!-- CHART END -->

</div>

</div>
</div>


<!-- page content ends -->


<!-- content page ends -->
</div>




</div>

</div>
</div>



<div class="row">
<div class="col-md-8">

</div>

</div>
    
 </div>
</div>

<style>
.csqq_dark_mode .csqq_chat_set .csqq_exp_pag_scroll::-webkit-scrollbar-track {background-color: var(--frmcolor);}
.csqq_dark_mode .csqq_chat_set .csqq_exp_pag_scroll::-webkit-scrollbar-thumb {
background-color: #1e90ff;
border-right: none;

}
.csqq_chat_set .csqq_exp_pag_scroll{max-height: calc(100vh - 200px) !important;}
.csqq_chat_set .csqq_exp_ch_btm{
bottom: 0px;
background-color: var(--frmcolor);
}
.csqq_chat_set{
display: block;
min-height: calc(100vh - 280px);
width: 100%;
overflow: hidden;
border-radius: 10px;
background-color: var(--frmcolor);
padding: 20px;
padding-bottom: 80px;
position: relative;
margin-bottom: 40px;
/* overflow-y: auto; */
}
.csqq_suppo_list{
display: block;
width: 100%;
padding: 15px;
border-radius: 10px;
margin-bottom: 15px;
background-color: var(--frmcolor);
}
.csqq_suppo_list_h1{
display: block;
width: 100%;
font-size: 16px;
font-weight: 500;
color:#fff;
line-height: 1.6;

}
.csqq_exp_ch_set{
display: block;
min-height: 400px;
width:100%;
}
.csqq_exp_ch_bdy{
display: flex;
width: 100%;
align-content: end;
flex-wrap: wrap;
min-height: calc(100vh - 367px) !important;
/* max-height: 420px; */
}
.csqq_exp_ch_li_blk{
display: block;
width: 100%;
margin-bottom: 15px;
}
.csqq_exp_ch_li{
display: inline-block;
margin-left: 40px;
background-color: #ecdede;
color:#000;
position: relative;
padding: 7px 12px;
line-height: 18px;
font-size: 12px;
font-weight: 500;
border-radius: 7px;
text-align: justify;
/* width: 100%; */
max-width: 70%;
}
.csqq_exp_ch_li_img{
display: block;
width: 30px;
height: 30px;
object-fit: cover;
position: absolute;
left: -40px;
top:0px;
border-radius: 100%;
}
.csqq_exp_ch_btm{
display: block;
position: absolute;
bottom:0px;
left: 0px;
width: 100%;
padding:15px;

}
.csqq_exp_ch_text:focus{border-color: #162758;}
.csqq_exp_ch_text{
display: block;
width:100%;
line-height: 44px;
padding: 0px 50px 0px 15px;
border: none;
font-size: 13px;
color:#000;
border-radius: 7px;
}
.csqq_exp_ch_text_i{
display: block;
width:35px;
height:35px;
line-height: 35px;
text-align: center;
background-color: var(--primarycolor);
color:#fff;
border-radius: 6px;
position: absolute;
top: 19px;
right: 20px;
font-size: 14px;
}
.csqq_exp_ch_set{
position: relative;
padding-bottom: 80px;
}
.csqq_exp_ch_li.cht_me{background-color: #dfdfdf;}

.csqq_exp_ch_bdy_out{
display: block;
width: calc(100% + 15px);
max-height: 420px;
padding-right: 10px;
overflow-y: auto;
}

.csqq_exp_ch_li.cht_me  .csqq_exp_ch_li_img{
right: -40px;
left: auto;
}
.csqq_exp_ch_li.cht_me{
float: right;
margin-left: 0px;
margin-right: 40px;
}

.csqq_exp_menu_set{
display: none;
}
.csqq_mexp_bu_hd_li .csqq_mexp_bu_hd_act{
background-color: #334e9b;
color: #fff;
background-image: url(../images/3d-btn-s-lb5.png) !important;
background-size: 100% 100% !important;
}
.csqq_dark_mode  .csqq_chart_light{display: none;}
.csqq_dark_mode  .csqq_chart_dark{display: block !important;}
.csqq_dark_mode  .csqq_more_act  .csqq_exp_n_li{border-bottom: 1px solid #fbfbfb08;}
body:not( .csqq_dark_mode)  .csqq_chart_light{display: block !important;}
body:not( .csqq_dark_mode)  .csqq_chart_dark{display: none}
body:not(.csqq_dark_mode) .csqq_suppo_list{background-color: #fff;color:#000;border: 1px solid rgba(0,0,0,0.1);eccapurple;}
body:not(.csqq_dark_mode) .csqq_suppo_list_h1{ color:#000}
body:not(.csqq_dark_mode) .csqq_chat_set, body:not(.csqq_dark_mode) .csqq_chat_set .csqq_exp_ch_btm{background-color: #efefef;}

</style>


</div>


</main>


<!-- /*****************************  INCLUDE FOOTER *************************************/ -->
<?php $this->load->view('users/common_script');?>
<!-- /*****************************  INCLUDE FOOTER *************************************/ -->
<script type="text/javascript" src="<?php echo base_url();?>assets/js/notify.js"></script>

</body>
 

<script>

const messages = document.getElementById('autoScroll');


$(document).ready(function(){
  
    scrollToBottom();

    $('INPUT[type="file"]').change(function () {
    var ext = this.value.match(/\.(.+)$/)[1];
    switch (ext) {
        case 'jpg':
        case 'jpeg':
        case 'png':
        case 'gif':
            $('#uploadButton').attr('disabled', false);
            break;
        default:
            alert('This is not an allowed file type.');
            this.value = '';
    }
});

    $('#update_ticket_form').submit(function(e){
        e.preventDefault();

        if ($('#update_ticket_form').parsley( 'isValid' )){

        var formData = new FormData(this);
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
            console.log(response);
            $('#update_ticket_form')[0].reset();
            $.notify('<i class="fa fa-spinner" aria-hidden="true"></i> <strong>success:</strong> Your Message Submited Successfully', 'success');
            $('#message_load').html(response);   
            
            scrollToBottom();
         }
        });

     }

    });

  

});

function scrollToBottom() {
  messages.scrollTop = messages.scrollHeight;
}
</script>
        

</html>
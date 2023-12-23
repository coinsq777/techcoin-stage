<!doctype html>
<html lang="en">

<!-- /*****************************  INCLUDE STYLE *************************************/ -->
<?php $this->load->view('users/common_style');?>
<!-- /*****************************  INCLUDE STYLE *************************************/ -->


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
            <div class="cq_oth_page_top_hdng"><?php echo $title; ?></div>
            </div>
        </header>
    

      <!-- header ends -->
    <div class="col position-relative page-content">


    </div>



<div class="col-12 mt-0 footer-sht">

</div>

</div>
</div>

</main>


<!-- /*****************************  INCLUDE FOOTER *************************************/ -->
<?php $this->load->view('users/common_script');?>
<!-- /*****************************  INCLUDE FOOTER *************************************/ -->



<!-- //***************** HIDDEN SECTION */ -->

<div class="col-lg-12 mb-3 mt-2" style="display:none">



<div class="row">



<div class="col-lg-6">



<a class="btn btn-danger"

href="<?php echo base_url(); ?>user/add">login add</a>


</div>


<div class="col-lg-6">


<a class="btn btn-success"

href="<?php echo base_url(); ?>user/remove">login Remove</a>



</div>





</div>



</div>


</body>


<script>

$(document).ready(function() {

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

$('#myButton').prop('disabled', false);
$('#error_info').html("");

} else {

$('#error_info').html('Please enter a valid amount (50, 100, 150, or a multiple of 50).');
$('#myButton').prop('disabled', true);     

}

}

});

$('#deposit_amount2').on('keyup',function(){

var value = $(this).val();

if(value !=""){

if(value % 2000 === 0){

$('#myButton').prop('disabled', false);
$('#error_info').html("");

} else {

$('#error_info').html('Please enter a valid amount (2000, 4000, 6000, or a multiple of 2000).');
$('#myButton').prop('disabled', true);     

}

}

});


$('#deposit_amount3').on('keyup',function(){

var value = $(this).val();

if(value !=""){

if(value % 2000 === 0){

$('#myButton').prop('disabled', false);
$('#error_info').html("");

} else {

$('#error_info').html('Please enter a valid amount (2000, 4000, 6000, or a multiple of 2000).');
$('#myButton').prop('disabled', true);     

}

}

});






});


</script>    


</html>
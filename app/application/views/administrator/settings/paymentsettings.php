<!DOCTYPE html>

<?php $this->load->view('administrator/common_style');?>

<body class="nk-body ui-rounder has-sidebar ui-light ">

<div class="nk-app-root">
<div class="nk-main ">

<?php 
//************************** SIDE BAR ADMIN PANEL */
$this->load->view('administrator/sidebar');
//************************** SIDE BAR ADMIN PANEL */
?>

<div class="nk-wrap ">
<div class="nk-header is-light nk-header-fixed is-light">
<div class="container-xl wide-xl">


<?php 
//************************** SIDE BAR ADMIN PANEL */
$this->load->view('administrator/topbar');
//************************** SIDE BAR ADMIN PANEL */
?>



<div class="nk-content nk-content-fluid">
<div class="container-xl wide-xl">
<div class="nk-content-body">
<div class="nk-block-head nk-block-head-sm">
<div class="nk-block-between">

<div class="nk-block-head-content">
<h3 class="nk-block-title page-title"><?php echo $title; ?></h3>
</div>

<div class="nk-block-head-content">
<div class="toggle-wrap nk-block-tools-toggle">
<a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu">
<em class="icon ni ni-more-v"></em>
</a>
</div>
</div>
</div>
</div>
<!-- //************************************ INSIDE ROW */ -->

<div class="card">
<div class="card-inner">

<?php if($verify_type == '1') { 
$this->session->set_userdata('verify_page',"");
$this->session->set_userdata('sender_otp',"");
?>

<form 
method ="POST"
action="" 
class="form-validate"
enctype="multipart/form-data">


<input type="hidden" name="paymentid" value='1'/>

<div class="row g-gs">


<div class="col-md-12">
<div class="form-group">
<label class="form-label" for="fv-full-name"> 
API Name  
<span class="text-danger">*</span> 
</label>
<div class="form-control-wrap">
<input type="text" class="form-control" 
name="wallet_name" 
placeholder="Link" 
value="<?php echo $payment->wallet_name; ?>" 
id="fv-full-name" required="" readonly>
</div>
</div>
</div>


<?php

$wallet_adderss = $payment->wallet_adderss;
$display_value = str_repeat('*', strlen($wallet_adderss) - 14) . substr($wallet_adderss, -4);

?>

<div class="col-md-12">
<div class="form-group">
<label class="form-label" for="fv-full-name"> 
Deposit Public Adderss
<span class="text-danger">*</span> 
</label>
<div class="form-control-wrap">
<input type="text" class="form-control" 
name="wallet_adderss" 
placeholder="Link" 
value="<?php echo $display_value; ?>" 
id="fv-full-name" required="">
</div>
</div>
</div>

<div class="col-md-12">
<div class="form-group">
<label class="form-label" for="fv-full-name"> 
Withdraw Public Adderss
<span class="text-danger">*</span> 
</label>
<div class="form-control-wrap">
<input type="text" class="form-control" 
placeholder="Link" 
value="********************************" >
</div>
</div>
</div>

<?php

$privat_key = $payment->privat_key;
$display_value = (strlen($privat_key) > 14 ? str_repeat('*', strlen($privat_key) - 5) : '') . substr($privat_key, -4);

?>

<div class="col-md-12">
<div class="form-group">
<label class="form-label" for="fv-full-name"> 
API  Key 
<span class="text-danger">*</span> 
</label>
<div class="form-control-wrap">
<input type="text" class="form-control" 
name="privat_key"
placeholder="Social Link Name" 
value="<?php echo $display_value; ?>" 
id="fv-full-name" required="">
</div>
</div>
</div>



<?php

$secret_key = $payment->secret_key;
$display_value = str_repeat('*', strlen($secret_key) - 5) . substr($secret_key, -4);

?>

<div class="col-md-12">
<div class="form-group">
<label class="form-label" for="fv-full-name"> 
API Secret Key 
<span class="text-danger">*</span> 
</label>
<div class="form-control-wrap">
<input type="text" class="form-control" 
name="secret_key"
placeholder="Social Link Name" 
value="<?php echo $display_value; ?>" 
id="fv-full-name" required="">
</div>
</div>
</div>


<div class="col-md-12">
<div class="form-group"><button type="submit" 
class="btn btn-lg btn-primary">Save Informations</button>
</div>
</div>
</div>
</form>


</div>


<?php } else { 
    $session_key =  $this->session->userdata('sender_otp');
?>

    
<form 
method ="POST"
action="<?php echo base_url();?>administrator/payment_update" 
class="form-validate"
enctype="multipart/form-data">


<div class="col-md-12">
<div class="form-group">
<label class="form-label" for="fv-full-name"> 
Enter OTP 
<span class="text-danger">*</span> 
</label>
<div class="form-control-wrap">
<input type="text" class="form-control" 
name="secret_key"
placeholder="Enter Otp" 
value="" 
id="fv-full-name" required="">
</div>
</div>
</div>


<br>
<br>

<div class="col-md-12">
<div class="form-group"><button type="submit" 
class="btn btn-lg btn-primary">Save Informations</button>
</div>
</div>
</div>
</form>

<?php } ?>

</div>

<!-- //************************************ INSIDE ROW  END */ -->
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<div class="nk-footer">
<div class="container-xl d-flex justify-content-center wide-xl">

<?php $this->load->view('administrator/admin_footer'); ?>

</div>
</div>


</div>
</div>
</div>

<?php $this->load->view('administrator/common_script'); ?>

<script src="https://cdn.ckeditor.com/4.7.1/full/ckeditor.js"></script>
<script>
CKEDITOR.replace( 'editor1' );
</script>   

</div>
</div>
</body>
</html>
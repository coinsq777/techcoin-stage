<!DOCTYPE html>

<html lang="en">

<?php 
/************************* COMMON STYLE  *******************************/
$this->load->view('users/login_style');
/************************* COMMON STYLE  *******************************/
?>

<link rel="stylesheet" type="text/css"
href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css" />


<style>
#mytable_length{
margin-bottom:20px;
}
.dataTables_filter{
margin-bottom:20px;
}
</style>


<body class="">

<div id="root">
<div class="ftu-design-pro ftu-pro-basicLayout screen-xl ftu-pro-basicLayout-fix-siderbar ftu-pro-basicLayout-side">
<section class="ftu-layout" style="min-height: 100%;">

<div class="ftu-layout" style="position: relative;">

<main class="ftu-layout-content ftu-pro-basicLayout-content ftu-pro-basicLayout-content-disable-margin">
<div>
<div class="container-box" >

<?php
/***************************** LOGIN HEADER  ***************************/
$this->load->view('users/login_header');
/***************************** LOGIN HEADER  ***************************/
?>




<div class="fst_mdl_content">
<div class="fts_h1"><?php echo $title; ?></div>


<div class="">
                    <div class="row justify-center g-md-4 ">
                     
                      <div class="col-md-8">
                        <div class="card fts_cardd  p-4">
                     
<?php  $this->load->view('users/notification'); ?>


         <form action="<?php echo base_url();?>users/change_password" method="post" data-parsley-validate>
         
            <input type="hidden" disabled=""
            value="<?php echo $this->session->userdata('email'); ?>" class="form-control" >

            <div class="row">
            <div class="col-md-12">
            <div class="fsc fsc_sz_1 fsc_fw_600 w-100  mb-3">
            Old Password

            </div>
            <div class="fts_depos_box fts_depos_box_dep fts_depos_pwd_act">
            <input type="password" name="old_password" id="old_password" class="fts_depos_textbox" 
            data-parsley-required
            >
            <div  class="fts_depos_pwd_ico">
            <span class="dfh1">Hide</span>
            <span class="dfh2">Show</span>
            </div>

            </div>
            </div>

            <div class="col-md-6">
            <div class="fsc fsc_sz_1 fsc_fw_600 w-100  mb-3">
            New Password

            </div>
            <div class="fts_depos_box fts_depos_box_dep fts_depos_pwd_act">

            <input type="password"  autocomplete="off" name="new_password" id="new_password" 
            data-parsley-minlength="5"
            data-parsley-required
            class="fts_depos_textbox" >
            <div  class="fts_depos_pwd_ico">
            <span class="dfh1">Hide</span>
            <span class="dfh2">Show</span>
            </div>

            </div>
            </div>

            <div class="col-md-6">
            <div class="fsc fsc_sz_1 fsc_fw_600 w-100  mb-3">
            Confirm Password

            </div>
            <div class="fts_depos_box fts_depos_box_dep fts_depos_pwd_act">

            <input type="password" id="confirm_new_password" onkeyup="checkPass(); return false;" name="confirm_new_password" 
            data-parsley-errors-container=".errorspanconfirmnewpassinput"
            data-parsley-required-message="Please re-enter your new password."
            data-parsley-equalto="#new_password"
            data-parsley-required
            class="fts_depos_textbox" >
            <div  class="fts_depos_pwd_ico">
            <span class="dfh1">Hide</span>
            <span class="dfh2">Show</span>
            </div>

            </div>
            </div>


            </div>

            <button type="submit"  class="btn btn-danger btn-lg d-inline-block">Submit</button>


            <textarea id="description" style="visibility: hidden;"></textarea>
            </form>
                              

                       
                      </div>
                      </div>
                    </div>
                   
                    
                </div>
      


</div>

<?php 
/******************************** LOGIN SIDE BAR ************************************/
$this->load->view('users/login_sidebar');
/********************************** LOGIN SIDE BAR ********************************/
?>

<!-- /*****************************  INCLUDE FOOTER *************************************/ -->
<?php $this->load->view('users/common_script');?>
<!-- /*****************************  INCLUDE FOOTER *************************************/ -->
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>


<script>

$(document).ready(function(){ 

new DataTable('#mytable');


})


$(".fts_menu_pop_btn, .fts_menu_pop_btn_cls, .ftu_menu_pop_avtr_btn").click(function(){
$(".fts_menu_pop_set").toggle();
});
</script>
</body>
</html>
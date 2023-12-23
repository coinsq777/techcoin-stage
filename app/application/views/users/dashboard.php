<!doctype html>
<html lang="en">

<!-- /*****************************  INCLUDE STYLE *************************************/ -->
<?php $this->load->view('users/common_style');?>
<!-- /*****************************  INCLUDE STYLE *************************************/ -->


<body class="d-flex flex-column h-100 sidebar-pushcontent theme-pink" data-theme="theme-pink">


<!-- /*****************************  INCLUDE STYLE *************************************/ -->
<?php $this->load->view('users/user_header');?>
<!-- /*****************************  INCLUDE STYLE *************************************/ -->


<main class="main vh-100">

<!-- Begin page content -->
<div class="container-fluid h-100">
<div class="row h-100 ">


<!-- //*************** HEADER */ -->
<?php $this->load->view('users/login_header');?>
<!-- //********************** HEADER OUT */ -->


<div class="col position-relative page-content">
<!-- content page -->

<div class="row justify-content-center">
<div class="col-12 col-md-11 col-lg-11 col-xxl-9 page-content-inr">

<div class="cq_banr_set cq_home_sldr owl-carousel">
<?php 

//************* BANNER IMAGE */
$file_get = $this->db->query("SELECT * FROM `sliders_img` where status = '1' ")->result(); 
$count = count($file_get);

if($count > 0){ foreach($file_get as $row) { 
$ext = pathinfo($row->image, PATHINFO_EXTENSION); 

?>

<?php if($ext == "mp4") { ?>
<video class="cq_banr_img" src="<?php echo base_url();?>assets/images/sliders/<?php echo $row->image; ?>"  
preload="none" onclick="this.play()" autoplay muted  loop></video>
<?php } else { ?>

<img src="<?php echo base_url();?>assets/images/sliders/<?php echo $row->image; ?>" class="cq_banr_img">

<?php } ?>

<?php } } ?>

</div>


<?php 
/** seventh content */
$cms_content = $this->Administrator_Model->get_cms('dashboard_notification');
if(!empty($cms_content)){
$notification =  $cms_content->content;
} else { 
$notification =  "";
}
?>

<div class="cq_noti_sec">
<img src="<?php echo base_url();?>style/assets/img/ico-announce.webp" class="cq_noti_sec_ico">
<marquee class="cq_noti_sec_marq">
<?php echo $notification; ?>
</marquee>
<div class="cq_noti_sec_exp"></div>
<div class="cq_noti_sec_exp_btn"></div>
</div>



<small> Welcome <?php echo user_info('referral_id'); ?>   </small>
<br>
<div class="srk srk_fs_1dot5 srk_clr_black_1 srk_fw_500 srk_mb_1dot3 cq_hom_hd">Our Services
</div>
<div class="row g-md-5 mb-md-4 mb-3 cq_hom_serv_sec_row">


<div class="col-4 col-md-3 col-lg-2 col-xl-2">
<a href="<?php echo base_url();?>style/assets/img/CoinsQ Blockchain.pdf"  target="_blank" class="cq_hm_serv_set">
<img src="<?php echo base_url();?>style/assets/img/ico-h18.webp" class="cq_hm_serv_img">
<div class="cq_hm_serv_h1">Blockchain</div>
</a>
</div>



<div class="col-4 col-md-3 col-lg-2 col-xl-2">
<a href="<?php echo base_url();?>style/assets/img/CoinsQ Affiliate Plan_A4.pdf"  target="_blank" class="cq_hm_serv_set">
<img src="<?php echo base_url();?>style/assets/img/ico-h19.webp" class="cq_hm_serv_img">
<div class="cq_hm_serv_h1">Affiliate Plan</div>
</a>
</div>


<?php if($menu_list[0]->status == "1") { ?>
<div class="col-4 col-md-3 col-lg-2 col-xl-2">
<!--href="<?php echo $menu_list[0]->manu_value; ?>"  target="_blank"-->
<a  href="<?php echo base_url();?>website" class="cq_hm_serv_set">
<img src="<?php echo base_url();?>style/assets/img/ico-h1.webp" class="cq_hm_serv_img">
<div class="cq_hm_serv_h1"><?php echo $menu_list[0]->manu_name; ?></div>
</a>
</div>
<?php } ?>



<div class="col-4 col-md-3 col-lg-2 col-xl-2">
<a   href="<?php echo base_url();?>trading_cms" class="cq_hm_serv_set">
<img src="<?php echo base_url();?>style/assets/img/ico-h2.webp" class="cq_hm_serv_img">
<div class="cq_hm_serv_h1">Trading</div>
</a>
</div>

<?php if($menu_list[2]->status == "1") { ?>
<div class="col-4 col-md-3 col-lg-2 col-xl-2">
 <!--href="<?php echo base_url();?>assets/menu/<?php echo $menu_list[2]->manu_value; ?>"  target="_blank"-->
<a href="<?php echo base_url();?>style/assets/img/CoinsQ Cloud Mining.pdf"  target="_blank" class="cq_hm_serv_set">
<img src="<?php echo base_url();?>style/assets/img/ico-h3.webp" class="cq_hm_serv_img">
<div class="cq_hm_serv_h1"><?php echo $menu_list[2]->manu_name; ?></div>
</a>
</div>
<?php } ?>


<?php if($menu_list[3]->status == "1") { ?>
<div class="col-4 col-md-3 col-lg-2 col-xl-2">
 <!--href="<?php echo base_url();?>assets/menu/<?php echo $menu_list[3]->manu_value; ?>"  target="_blank"-->
<a  href="<?php echo base_url();?>staking_cms" class="cq_hm_serv_set">
<img src="<?php echo base_url();?>style/assets/img/ico-h4.webp" class="cq_hm_serv_img">
<div class="cq_hm_serv_h1"><?php echo $menu_list[3]->manu_name; ?></div>
</a>
</div>
<?php } ?>


<!--------------------------------->


</div>



<div class="row g-md-5 mb-md-5 mb-5">
<div class="col-6">
<a href="<?php echo base_url(); ?>users/token_growth"  class="cq_hm_smlpnl">
<div class="row justify-content-start ">
<div class="col-auto">
<img src="<?php echo base_url();?>style/assets/img/ico-h14.webp" class="cq_hm_smlpnl_ico">
</div>
<div class="col">
<div class="srk srk_fs_1 srk_fw_600 mt-md-0 mt-3" style="color:#5052a6;">
   Token Swap History
<i class="bi bi-chevron-right cq_hm_smlpnl_arw"></i>
</div>
</div>
</div>


</a>
</div>
<div class="col-6">
<a href="<?php echo base_url(); ?>users/swap_growth" class="cq_hm_smlpnl" 
style="    background-color: #4f85c412;">
<div class="row justify-content-start ">
<div class="col-auto">
<img src="<?php echo base_url();?>style/assets/img/ico-h15.webp" 
class="cq_hm_smlpnl_ico">
</div>
<div class="col">
<div class="srk srk_fs_1 srk_fw_600 mt-md-0 mt-3 " style="color:#4f85c4;">
      Token Growth History
<i class="bi bi-chevron-right cq_hm_smlpnl_arw"></i>
</div>
</div>

</div>


</a>
</div>
</div>

<!--<div class="srk srk_fs_1dot5 srk_clr_black_1 srk_fw_500 mt-md-1 srk_mb_1dot3 cq_hom_hd">More</div>-->



<div class="row g-md-5 cq_hom_serv_sec_row">


<?php if($menu_list[4]->status == "1") { ?>
<div class="col-4 col-md-3 col-lg-2 col-xl-2">
<a href="#" class="cq_hm_serv_set">
<img src="<?php echo base_url();?>style/assets/img/ico-h5.webp" class="cq_hm_serv_img">
<div class="cq_hm_serv_h1"><?php echo $menu_list[4]->manu_name; ?></div>
</a>
</div>
<?php } ?>

<?php if($menu_list[5]->status == "1") { ?>
<div class="col-4 col-md-3 col-lg-2 col-xl-2">
<a href="<?php echo base_url();?>assets/menu/<?php echo $menu_list[5]->manu_value; ?>"  target="_blank" class="cq_hm_serv_set">
<img src="<?php echo base_url();?>style/assets/img/ico-h17.webp" class="cq_hm_serv_img">
<div class="cq_hm_serv_h1"><?php echo $menu_list[5]->manu_name; ?></div>
</a>
</div>
<?php } ?>



<div class="col-4 col-md-3 col-lg-2 col-xl-2">
<a href="<?php echo base_url();?>style/assets/img/CoinsQ_White_Paper.pdf"  target="_blank" class="cq_hm_serv_set">
<img src="<?php echo base_url();?>style/assets/img/ico-h7.webp" class="cq_hm_serv_img">
<div class="cq_hm_serv_h1">White Paper</div>
</a>
</div>


<div class="col-4 col-md-3 col-lg-2 col-xl-2">
<a href="<?php echo base_url();?>user/Support/chat" 
  class="cq_hm_serv_set">
<img src="<?php echo base_url();?>style/assets/img/ico-h8.webp" class="cq_hm_serv_img">
<div class="cq_hm_serv_h1">Community</div>
</a>
</div>
<div class="col-4 col-md-3 col-lg-2 col-xl-2">
<a href="<?php echo base_url();?>user/Support" class="cq_hm_serv_set">
<img src="<?php echo base_url();?>style/assets/img/ico-h9.webp" class="cq_hm_serv_img">
<div class="cq_hm_serv_h1">Customer Support</div>
</a>
</div>


<?php if($menu_list[6]->status == "1") { ?>
<div class="col-4 col-md-3 col-lg-2 col-xl-2">
    <!--href="<?php echo $menu_list[6]->manu_value; ?>"  target="_blank" -->
<a href="<?php echo base_url();?>game" class="cq_hm_serv_set">
<img src="<?php echo base_url();?>style/assets/img/ico-h10.webp" class="cq_hm_serv_img">
<div class="cq_hm_serv_h1"><?php echo $menu_list[6]->manu_name; ?></div>
</a>
</div>
<?php } ?>

<?php if($menu_list[7]->status == "1") { ?>
<div class="col-4 col-md-3 col-lg-2 col-xl-2">
    <!--href="<?php echo $menu_list[7]->manu_value; ?>"  target="_blank"-->
<a href="<?php echo base_url();?>nft" class="cq_hm_serv_set">
<img src="<?php echo base_url();?>style/assets/img/ico-h11.webp" class="cq_hm_serv_img">
<div class="cq_hm_serv_h1"><?php echo $menu_list[7]->manu_name; ?></div>
</a>
</div>
<?php } ?>

<?php if($menu_list[8]->status == "1") { ?>
<div class="col-4 col-md-3 col-lg-2 col-xl-2">
<!--href="<?php echo base_url();?>style/assets/img/Crypto_Lottery.pdf"-->
<!--target="_blank"-->
<a   href="<?php echo base_url();?>lottery"  class="cq_hm_serv_set">
<img src="<?php echo base_url();?>style/assets/img/ico-h12.webp" class="cq_hm_serv_img">
<div class="cq_hm_serv_h1"><?php echo $menu_list[8]->manu_name; ?></div>
</a>
</div>
<?php } ?>




</div>




<!--<div class="srk srk_fs_1dot5 srk_clr_black_1 srk_fw_500 mt-md-1 srk_mb_1dot3 cq_hom_hd mt-3 mb-2">Social Media</div>-->


<div class="row g-md-5 cq_hom_serv_sec_row">
    
    
<div class="col-4 col-md-3 col-lg-2 col-xl-2">


<a href="<?php echo social_link('3')?>"   target="_blank" class="cq_hm_serv_set">
<img src="<?php echo base_url();?>style/assets/img/ico-h20.webp"
class="cq_hm_serv_img">
<div class="cq_hm_serv_h1">Instagram</div>
</a>
</div>

  
<div class="col-4 col-md-3 col-lg-2 col-xl-2">
<a href="<?php echo social_link('2')?>"  target="_blank" class="cq_hm_serv_set">
<img src="<?php echo base_url();?>style/assets/img/ico-h21.webp"
class="cq_hm_serv_img">
<div class="cq_hm_serv_h1">Twitter</div>
</a>
</div>

 


<div class="col-4 col-md-3 col-lg-2 col-xl-2">
<a href="<?php echo social_link('4')?>"  target="_blank" class="cq_hm_serv_set">
<img src="<?php echo base_url();?>style/assets/img/ico-h23.webp"
class="cq_hm_serv_img">
<div class="cq_hm_serv_h1">Youtube</div>
</a>
</div>


<div class="col-4 col-md-3 col-lg-2 col-xl-2">
<a href="<?php echo base_url();?>style/assets/img/CoinsQ Media Articles.pdf" class="cq_hm_serv_set">
<img src="<?php echo base_url();?>style/assets/img/ico-h24.webp" class="cq_hm_serv_img">
<div class="cq_hm_serv_h1">Google Article</div>
</a>
</div>

<div class="col-4 col-md-3 col-lg-2 col-xl-2">
<a href="<?php echo base_url();?>managment" class="cq_hm_serv_set">
<img src="<?php echo base_url();?>style/assets/img/ico-company-management.png" class="cq_hm_serv_img">
<div class="cq_hm_serv_h1">Company Management</div>
</a>
</div>


<div class="col-4 col-md-3 col-lg-2 col-xl-2">
<a href="<?php echo base_url();?>style/assets/img/legal.pdf"  target="_blank" class="cq_hm_serv_set">
<img src="<?php echo base_url();?>style/assets/img/ico-h16.webp" class="cq_hm_serv_img">
<div class="cq_hm_serv_h1">legal Document UK</div>
</a>
</div>
<div class="col-4 col-md-3 col-lg-2 col-xl-2">
<a href="#"  target="_blank" class="cq_hm_serv_set">
<img src="<?php echo base_url();?>style/assets/img/ico-legaloman.png" class="cq_hm_serv_img">
<div class="cq_hm_serv_h1">legal Document Oman</div>
</a>
</div>


<div class="col-4 col-md-3 col-lg-2 col-xl-2">
<a href="<?php echo base_url();?>myreferal" class="cq_hm_serv_set">
<img src="<?php echo base_url();?>style/assets/img/ico-h13.webp"
class="cq_hm_serv_img">
<div class="cq_hm_serv_h1">My Team</div>
</a>
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


<!-- /*****************************  INCLUDE FOOTER *************************************/ -->
<?php $this->load->view('users/common_script');?>
<!-- /*****************************  INCLUDE FOOTER *************************************/ -->


</body>

</html>
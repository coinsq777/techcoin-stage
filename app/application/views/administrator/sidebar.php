<?php
if ($this->session -> userdata('email') == "" && 
$this->session -> userdata('login') != true && $this->session -> userdata('role_id') != 1) {
redirect('administrator/index');
}
?>



<div class="nk-sidebar is-light nk-sidebar-fixed " data-content="sidebarMenu">

<!-- //****************** SIDE BAR LOGO */ -->
<div class="nk-sidebar-element nk-sidebar-head">

<?php $sitelogo = site_info('logo'); ?>


<div class="nk-sidebar-brand">
<a href="index.html" class="logo-link nk-sidebar-logo">
<img class="logo-light logo-img" src="<?php echo base_url(); ?>assets/images/<?php echo $sitelogo; ?>" srcset="images/logo2x.png 2x" alt="logo"  style="object-fit:contain; object-position:left">
<img class="logo-dark logo-img" src="<?php echo base_url(); ?>assets/images/<?php echo $sitelogo; ?>" srcset="images/logo-dark2x.png 2x" alt="logo-dark"  style="object-fit:contain;  object-position:left">
<img class="logo-small logo-img logo-img-small" src="<?php echo base_url(); ?>assets/images/<?php echo $sitelogo; ?>" srcset="images/logo-small2x.png 2x" alt="logo-small" style="object-fit:contain; object-position:left">
</a>
</div>

<div class="nk-menu-trigger me-n2">
<a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu">
<em class="icon ni ni-arrow-left"></em>
</a>
</div>
</div>
<!-- //****************** SIDE BAR LOGO */ -->

<div class="nk-sidebar-element">
<div class="nk-sidebar-content">
<div class="nk-sidebar-menu" data-simplebar="">
<ul class="nk-menu">

<li class="nk-menu-heading">
<h6 class="overline-title text-primary-alt">Side Menu</h6>
</li>

<!-- //************** DASHBOARD */ -->
<li class="nk-menu-item">
<a href="<?php echo base_url()?>administrator/dashboard" class="nk-menu-link">
<span class="nk-menu-icon">
<em class="icon ni ni-presentation"></em>
</span>
<span class="nk-menu-text">Dashboard</span>
</a>
</li>

<!-- //************** USER */ -->
<li class="nk-menu-item has-sub">
<a href="#" class="nk-menu-link nk-menu-toggle">
<span class="nk-menu-icon">
<em class="icon ni ni-users"></em>
</span>
<span class="nk-menu-text">User</span>
</a>
<ul class="nk-menu-sub">

<!-- <li class="nk-menu-item">
<a href="<?php echo base_url();?>administrator/users/add-user" class="nk-menu-link">
<span class="nk-menu-text">Create User</span>
</a>
</li> -->

<li class="nk-menu-item">
<a href="<?php echo base_url();?>administrator/users/users" class="nk-menu-link">
<span class="nk-menu-text">Users List</span>
</a>
</li>
</ul>
</li>


<!-- //************** CMS */ -->
<li class="nk-menu-item has-sub">
<a href="#" class="nk-menu-link nk-menu-toggle">
<span class="nk-menu-icon">
<em class="icon ni ni-img"></em>
</span>
<span class="nk-menu-text">Content Management</span>
</a>
<ul class="nk-menu-sub">


<li class="nk-menu-item">
<a href="<?php echo base_url(); ?>administrator/page-contents" class="nk-menu-link">
<span class="nk-menu-text">CMS Page Control</span>
</a>
</li>

                            
<li class="nk-menu-item">
<a href="<?php echo base_url(); ?>administrator/get_notification" class="nk-menu-link">
<span class="nk-menu-text">Announcement</span>
</a>
</li>


<li class="nk-menu-item">
<a href="<?php echo base_url(); ?>administrator/menu_cms" class="nk-menu-link">
<span class="nk-menu-text">Menu CMS</span>
</a>
</li>
                            
<li class="nk-menu-item">
<a href="<?php echo base_url(); ?>administrator/sliders" class="nk-menu-link">
<span class="nk-menu-text">Slider</span>
</a>
</li>


<li class="nk-menu-item">
<a href="<?php echo base_url(); ?>administrator/sociallinks" class="nk-menu-link">
<span class="nk-menu-text">Sociallinks</span>
</a>
</li>



</ul>
</li>

<!-- //************** DASHBOARD */ -->
<li class="nk-menu-item">
<a href="<?php echo base_url()?>administrator/support" class="nk-menu-link">
<span class="nk-menu-icon">
<em class="icon ni ni-presentation"></em>
</span>
<span class="nk-menu-text">Support</span>
</a>
</li>


<!-- //**************  Site Configuration */ -->
<li class="nk-menu-item has-sub">
<a href="#" class="nk-menu-link nk-menu-toggle">
<span class="nk-menu-icon">
<em class="icon ni ni-menu-circled"></em>
</span>
<span class="nk-menu-text">Extra</span>
</a>
<ul class="nk-menu-sub">



<li class="nk-menu-item">
<a href="<?php echo base_url(); ?>administrator/email_template" class="nk-menu-link">
<span class="nk-menu-text">Email Templates</span>
</a>
</li>

<li class="nk-menu-item">
<a href="<?php echo base_url(); ?>administrator/get_faqs" class="nk-menu-link">
<span class="nk-menu-text">FAQ</span>
</a>
</li>


<li class="nk-menu-item">
<a href="<?php echo base_url(); ?>administrator/compounding_list" 
class="nk-menu-link">
<span class="nk-menu-text">Compounding CMS</span>
</a>
</li>

</ul>
<li>

<!-- //**************  Site Configuration */ -->
<li class="nk-menu-item has-sub">
<a href="#" class="nk-menu-link nk-menu-toggle">
<span class="nk-menu-icon">
<em class="icon ni ni-puzzle"></em>
</span>
<span class="nk-menu-text">Settings</span>
</a>
<ul class="nk-menu-sub">

<li class="nk-menu-item">
<a href="<?php echo base_url(); ?>administrator/site-configuration/update/1" 
class="nk-menu-link">
<span class="nk-menu-text">Site Settings</span>
</a>
</li>

<li class="nk-menu-item">
<a href="<?php echo base_url(); ?>administrator/paymentsettings" 
class="nk-menu-link">
<span class="nk-menu-text">Payment Settings</span>
</a>
</li>


<li class="nk-menu-item">
<a href="<?php echo base_url(); ?>AssetsController/coin_list" 
class="nk-menu-link">
<span class="nk-menu-text">Assets Settings</span>
</a>
</li>

<li class="nk-menu-item">
<a href="<?php echo base_url(); ?>administrator/currencysettings" 
class="nk-menu-link">
<span class="nk-menu-text">Currency Settings</span>
</a>
</li>


<li class="nk-menu-item">
<a href="<?php echo base_url(); ?>administrator/withdrawsettings" 
class="nk-menu-link">
<span class="nk-menu-text">Withdraw Settings</span>
</a>
</li>

<li class="nk-menu-item">
<a href="<?php echo base_url(); ?>administrator/intrestsettings" 
class="nk-menu-link">
<span class="nk-menu-text">Trading Settings</span>
</a>
</li>


<li class="nk-menu-item">
<a href="<?php echo base_url(); ?>administrator/minningsettings" 
class="nk-menu-link">
<span class="nk-menu-text">Mining Settings</span>
</a>
</li>

<li class="nk-menu-item">
<a href="<?php echo base_url(); ?>administrator/royalitysettings_list" 
class="nk-menu-link">
<span class="nk-menu-text">Royality Settings</span>
</a>
</li>


</ul>
</li>


<!-- //************** FINANCE */ -->
<li class="nk-menu-item has-sub">
<a href="#" class="nk-menu-link nk-menu-toggle">
<span class="nk-menu-icon">
<em class="icon ni ni-text-rich"></em>
</span>
<span class="nk-menu-text">Finance</span>
</a>
<ul class="nk-menu-sub">


<li class="nk-menu-item">
<a href="<?php echo base_url(); ?>administrator/makedeposit" class="nk-menu-link">
<span class="nk-menu-text">User Deposit</span>
</a>
</li>


<li class="nk-menu-item">
<a href="<?php echo base_url(); ?>administrator/capital_withdraw" class="nk-menu-link">
<span class="nk-menu-text">Capital Withdraw Request</span>
</a>
</li>

</ul>
</li>



<!-- //************** FINANCE  REPORT*/ -->
<li class="nk-menu-item has-sub">
<a href="#" class="nk-menu-link nk-menu-toggle">
<span class="nk-menu-icon">
<em class="icon ni ni-tile-thumb"></em>
</span>
<span class="nk-menu-text">Finance Report</span>
</a>
<ul class="nk-menu-sub">


<li class="nk-menu-item">
<a href="<?php echo base_url(); ?>Report/Mining" class="nk-menu-link">
<span class="nk-menu-text">Mining History</span>
</a>
</li>


<li class="nk-menu-item">
<a href="<?php echo base_url(); ?>Report/Staking" class="nk-menu-link">
<span class="nk-menu-text">Trading History</span>
</a>
</li>


<li class="nk-menu-item">
<a href="<?php echo base_url(); ?>Report/Withdraw" class="nk-menu-link">
<span class="nk-menu-text">Withdraw History</span>
</a>
</li>


<li class="nk-menu-item">
<a href="<?php echo base_url(); ?>Report/Royality" 
class="nk-menu-link">
<span class="nk-menu-text">Royality Achived User</span>
</a>
</li>

</ul>
</li>



<!-- //************** FINANCE  REPORT*/ -->
<li class="nk-menu-item has-sub">
<a href="#" class="nk-menu-link nk-menu-toggle">
<span class="nk-menu-icon">
<em class="icon ni ni-files"></em>
</span>
<span class="nk-menu-text">Report</span>
</a>
<ul class="nk-menu-sub">


<li class="nk-menu-item">
<a href="<?php echo base_url(); ?>Report/Mining_Earning" class="nk-menu-link">
<span class="nk-menu-text">Mining Earnings</span>
</a>
</li>


<li class="nk-menu-item">
<a href="<?php echo base_url(); ?>Report/Lending_Earning" class="nk-menu-link">
<span class="nk-menu-text">Trading Earnings</span>
</a>
</li>


<li class="nk-menu-item">
<a href="<?php echo base_url(); ?>Report/Staking_Earning" class="nk-menu-link">
<span class="nk-menu-text">Staking Earnings</span>
</a>
</li>


<li class="nk-menu-item">
<a href="<?php echo base_url(); ?>Report/Level_Earning" class="nk-menu-link">
<span class="nk-menu-text">Level Commission Earnings</span>
</a>
</li>



<li class="nk-menu-item">
<a href="<?php echo base_url(); ?>Report/Royality_Earnings" 
class="nk-menu-link">
<span class="nk-menu-text">Royality Earnings</span>
</a>
</li>

</ul>
</li>



</ul>
</div>
</div>
</div>
</div>

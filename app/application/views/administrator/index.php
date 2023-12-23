    <!DOCTYPE html>

    <?php $this->load->view('administrator/common_style');?>

        
    <?php 
    $siteconfiguration = $this->Administrator_Model->get_siteconfiguration();
    $sitelogo =  $siteconfiguration[0]['logo_img'];
    ?>

    <body class="nk-body ui-rounder npc-general ui-light pg-auth">
    <div class="nk-app-root">
    <div class="nk-main ">
    <div class="nk-wrap nk-wrap-nosidebar">
    <div class="nk-content ">
    <div class="nk-split nk-split-page nk-split-lg">
    <div class="nk-split-content nk-block-area nk-block-area-column nk-auth-container bg-white">
    <div class="absolute-top-right d-lg-none p-3 p-sm-5">
    <a href="#" class="toggle btn-white btn btn-icon btn-light" data-target="athPromo">
    <em class="icon ni ni-info"></em>
    </a>
    </div>

    <div class="nk-block nk-block-middle nk-auth-body">
    <div class="brand-logo pb-5">
    <a href="<?php echo base_url();?>" class="logo-link">

    <img class="logo-light logo-img logo-img-lg" 
    src="<?php echo base_url(); ?>assets/images/<?php echo $sitelogo; ?>"
    srcset="<?php echo base_url(); ?>assets/images/<?php echo $sitelogo; ?> 2x" 
    alt="logo" style="object-fit:contain; object-position:left">

    <img 
    class="logo-dark logo-img logo-img-lg" 
    src="<?php echo base_url(); ?>assets/images/<?php echo $sitelogo; ?>"
    srcset="<?php echo base_url(); ?>assets/images/<?php echo $sitelogo; ?>" 
    alt="logo-dark" style="object-fit:contain; object-position:left">

    </a>
    </div>

    <div class="nk-block-head">
    <div class="nk-block-head-content">
    <h5 class="nk-block-title">Admin Login</h5>
    <div class="nk-block-des">
    <p>Access the <b> <?php echo $siteconfiguration[0]['site_title']; ?> </b> using your email and passcode.</p>
    </div>
    </div>
    </div>

    <?php $this->load->view('notification'); ?>

    <form 
    action="<?php echo $action; ?>" 
    class="form-validate is-alter" 
    method="post"
    autocomplete="off"
    >

    <div class="form-group">
    <div class="form-label-group">
    <label class="form-label" for="email-address">Email or Username</label>
    </div>
    <div class="form-control-wrap">
    <input autocomplete="off"
    type="email" 
    class="form-control form-control-lg" 
    required="" 
    name="email"
    id="email-address" 
    placeholder="Enter your email address or username">
    </div>
    </div>

    <div class="form-group">

    <div class="form-label-group">
    <label class="form-label" for="password">Passcode</label>
    <a class="link link-primary link-sm" tabindex="-1" 
    href="<?php echo base_url(); ?>administrator/forget-password">
    Forgot Code?
    </a>
    </div>


    <div class="form-control-wrap">
    <a tabindex="-1" href="#" 
    class="form-icon form-icon-right passcode-switch lg" 
    data-target="password">
    <em class="passcode-icon icon-show icon ni ni-eye"></em>
    <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
    </a>

    <input 
    autocomplete="new-password" 
    type="password" 
    class="form-control form-control-lg" 
    required="" 
    name="password" 
    id="password" 
    placeholder="Enter your passcode">
    </div>
    </div>

    <div class="form-group">
    <button type="submit" class="btn btn-lg btn-primary btn-block">Sign in</button>
    </div>

    </form>

    <div class="mt-4 text-center">
    <p>&copy; 2023  <?php echo $siteconfiguration[0]['site_title']; ?> . All Rights Reserved.</p>
    <p class="text-inverse text-left m-b-0">Thank you and enjoy our website.</p>

    </div>

    </div>
    </div>

    <div class="nk-split-content nk-split-stretch bg-lighter d-flex toggle-break-lg toggle-slide toggle-slide-right" data-toggle-body="true" data-content="athPromo" data-toggle-screen="lg" data-toggle-overlay="true">
    <div class="slider-wrap w-100 w-max-550px p-3 p-sm-5 m-auto">
    <div class="slider-init" data-slick='{"dots":true, "arrows":false}'>

    <!-- /********************** THIRE BANNER */ -->
    <div class="slider-item">
    <div class="nk-feature nk-feature-center">
    <div class="nk-feature-img">
    <img class="round" 
    src="<?php echo base_url();?>style/assets/img/admin-slider.png" 
    srcset="<?php echo base_url();?>admin_stylestyle/assets/img/admin-slider.png 2x" alt="">
    </div>
    <div class="nk-feature-content py-4 p-sm-5">
    <!-- <h4>Fenizotechnologies</h4> -->
    <p>You can start to create your products easily with its 
        user-friendly design & most completed responsive layout.</p>
    </div>
    </div>
    </div>
    <!-- /********************** THIRE BANNER */ -->
    <div class="slider-item">
    <div class="nk-feature nk-feature-center">
    <div class="nk-feature-img">
    <img class="round" src="<?php echo base_url();?>style/assets/img/admin-slider.png" srcset="style/assets/img/admin-slider.png 2x" alt="">
    </div>
    <div class="nk-feature-content py-4 p-sm-5">
    <!-- <h4>Fenizotechnologies</h4> -->
    <p>You can start to create your products easily with its 
        user-friendly design & most completed responsive layout.</p>
    </div>
    </div>
    </div>
    <!-- /********************** THIRE BANNER */ -->
    <div class="slider-item">
    <div class="nk-feature nk-feature-center">
    <div class="nk-feature-img">
    <img class="round" src="<?php echo base_url();?>style/assets/img/admin-slider.png" 
    srcset="<?php echo base_url();?>style/assets/img/admin-slider.png 2x" alt="">
    </div>
    <div class="nk-feature-content py-4 p-sm-5">
    <!-- <h4>Fenizotechnologies</h4> -->
    <p>You can start to create your products easily 
        with its user-friendly design & most completed responsive layout.</p>
    </div>
    </div>
    </div>
    </div>

    <div class="slider-dots"></div>
    <div class="slider-arrows"></div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>

    <?php $this->load->view('administrator/common_script'); ?>

    </div>
    </div>
    </body>
    </html>
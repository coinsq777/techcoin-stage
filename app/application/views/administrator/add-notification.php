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

<form 
method ="POST"
action="<?php echo base_url(); ?>administrator/create_notification" 
class="form-validate"
enctype="multipart/form-data">


<div class="row g-gs">


<div class="col-sm-12 mt-3 ">

<div class="form-group">

<label class="form-label" for="fv-full-name"> 
Announcement
<span class="text-danger">*</span> 
</label>

<textarea  
name="title" class="form-control" placeholder="Description"
id="editor1"><?php echo $sliders->title; ?></textarea>
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

<?php $this->load->view('administrator/admin_footer');?>

</div>
</div>


</div>
</div>
</div>

<?php $this->load->view('administrator/common_script'); ?>

<script src="https://cdn.ckeditor.com/4.7.1/full/ckeditor.js"></script>
<script>
// CKEDITOR.replace( 'editor1' );
</script>   

</div>
</div>
</body>
</html>
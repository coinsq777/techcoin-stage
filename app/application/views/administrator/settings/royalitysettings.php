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

<style>
#education_fields .form-group {
    display: flex;
    gap: 12px;
    margin-bottom: 14px;
}
</style>

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
action="<?php echo base_url(); ?>administrator/royalitysettings" 
class="form-validate"
enctype="multipart/form-data">

<input class="form-control" value="<?php echo $siteconfiguration->id; ?>" name="id" type="hidden">

<div class="row g-gs">

<div class="col-md-6">
<div class="form-group">
<label class="form-label" for="fv-full-name">Rank Name<span class="text-danger">*</span> </label>
<div class="form-control-wrap">
<input type="text" class="form-control" 
value="<?php echo $siteconfiguration->rank_name; ?>" name="rank_name" 
id="fv-full-name" required="" placeholder="Rank Name">
</div>
</div>
</div>


<div class="col-md-6">
<div class="form-group">
<label class="form-label" for="fv-full-name"> Rank Eligibility Amount
<span class="text-danger">*</span></label>
<div class="form-control-wrap">
<input type="number" class="form-control" 
value="<?php echo $siteconfiguration->rank_amt; ?>" 
name="rank_amt" 
id="fv-full-name"  
required="" 
placeholder="Rank Eligibility Amount">
</div>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label class="form-label" for="fv-full-name"> Rank Eligibility ( Direct Referral Count )
<span class="text-danger">*</span></label>
<div class="form-control-wrap">
<input type="number" class="form-control" 
value="<?php echo $siteconfiguration->rank_elg; ?>" 
name="rank_elg" 
id="fv-full-name"  
required="" 
placeholder="Staking Interest">
</div>
</div>
</div>



<div class="col-md-6">
<div class="form-group">
<label class="form-label" for="fv-full-name"> Daily Profit ( % ) 
<span class="text-danger">*</span></label>
<div class="form-control-wrap">
<input type="text" class="form-control" 
value="<?php echo $siteconfiguration->rank_profit; ?>" 
name="rank_profit" 
id="fv-full-name"  
required="" 
placeholder="Daily Profit">
</div>
</div>
</div>


<div class="col-md-6">
<div class="form-group">
<label class="form-label" for="fv-full-name"> Same Level Rank ( % ) 
<span class="text-danger">*</span></label>
<div class="form-control-wrap">
<input type="text" class="form-control" 
value="<?php echo $siteconfiguration->rank_same_levl; ?>" 
name="rank_same_levl" 
id="fv-full-name"  
required="" 
placeholder="Enter Compounding Interest">
</div>
</div>
</div>



<div class="col-md-6">
<div class="form-group">
<label class="form-label" for="fv-phone">Royal Status</label>
<div class="form-control-wrap">
<ul class="custom-control-group">
<li>
<div class="custom-control custom-radio custom-control-pro no-control 
<?php echo $siteconfiguration->rank_status == '1' ? "checked" : ""; ?>">
<input type="radio" class="custom-control-input" 
name="rank_status" 
value = '1'
id="site_on" required="" 
<?php echo $siteconfiguration->rank_status == '1' ? "checked" : ""; ?>
>
<label class="custom-control-label" for="site_on">ON</label></div>
</li>
<li>
<div class="custom-control custom-radio custom-control-pro no-control 
<?php echo $siteconfiguration->rank_status == '0' ? "checked" : ""; ?>">
<input type="radio" class="custom-control-input" 
value = '0'
name="rank_status" id="site_off" required=""  
<?php echo $siteconfiguration->rank_status == '0' ? "checked" : ""; ?>>
<label class="custom-control-label" for="site_off">OFF</label></div>
</li>
</ul>
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


<script>

var room = '<?php echo $ids; ?>';
function education_fields() {

room++;
var objTo = document.getElementById('education_fields')
var divtest = document.createElement("div");
divtest.setAttribute("class", "form-group removeclass"+room);
var rdiv = 'removeclass'+room;
divtest.innerHTML = '<div class="col-sm-9 nopadding"><div class="form-group"><input type="number" class="form-control" id="Schoolname" name="duration[]" value="" placeholder="Enter Date"></div></div><div class="input-group-btn"><button class="btn btn-danger" type="button" onclick="remove_education_fields('+ room +');"><em class="icon ni ni-cross"></em></span></button></div></div></div></div><div class="clear"></div>';
objTo.appendChild(divtest)
}


function remove_education_fields(rid) {
$('.removeclass'+rid).remove();
}

</script>


</div>
</div>
</body>
</html>
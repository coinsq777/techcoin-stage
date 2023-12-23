<!DOCTYPE html>

<?php $this->load->view('administrator/common_style');?>


<body class="nk-body ui-rounder has-sidebar ui-light ">

<div class="nk-app-root">
<div class="nk-main ">

<style>
table.dataTable.nowrap th, table.dataTable.nowrap td {
    word-wrap: break-word !important;
}
</style>

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

<div class="nk-block-head-content ">
<h3 class="nk-block-title page-title"><?php echo $title; ?></h3>
</div>

<a class="btn btn-primary" href="<?php echo base_url();?>administrator/create_notification">Add Announcement</a>


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
<div class="card card-preview">
<div class="card-inner">
<!-- //*************** INSIDE CARD */ -->

<table class="datatable-init-export nowrap table" data-export-title="Export">
<thead>
<tr>
<th>Id</th>
<th>Announcement</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php 
$i=0;
if($sliders){
foreach($sliders as $post) {
$i++;    
?>
<tr>
<td><?php echo $i; ?></td>
<td><?php echo $post->title; ?></td>
<td>
<a class="btn btn-info" 
href='<?php echo base_url(); ?>administrator/update_notification/<?php echo $post->id; ?>'>Edit</a>
<a class="btn btn-danger delete" 
href='<?php echo base_url(); ?>administrator/delete_notify/<?php echo $post->id; ?>
?table=<?php echo base64_encode('notification'); ?>'>Delete</a>
</td>
</tr>
<?php 
} 
}?>

</tbody>
</table>


<!-- //*************** INSIDE CARD */ -->
</div>
</div>
<!-- //************************************ INSIDE ROW  END */ -->
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

<script type="text/javascript">
$(document).ready(function(){
$(".delete").click(function(e){ alert('as');
$this  = $(this);
e.preventDefault();
var url = $(this).attr("href");
$.get(url, function(r){
if(r.success){
$this.closest("tr").remove();
}
})
});
});
$(document).ready(function(){
$(".enable").click(function(e){ alert('as');
$this  = $(this);
e.preventDefault();
var url = $(this).attr("href");
$.get(url, function(r){
if(r.success){
$this.closest("tr").remove();
}
})
});
});
$(document).ready(function(){
$(".desable").click(function(e){ alert('as');
$this  = $(this);
e.preventDefault();
var url = $(this).attr("href");
$.get(url, function(r){
if(r.success){
$this.closest("tr").remove();
}
})
});
});
</script>



</div>
</div>
</body>
</html>
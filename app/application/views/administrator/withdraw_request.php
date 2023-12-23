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


<?php if($this->session->flashdata('success')): ?>

<div class="col-lg-12" style="padding:10px;">
<div class="example-alert">
<div class="alert alert-fill alert-success alert-icon">
<em class="icon ni ni-check-circle"></em> 
<strong></strong>.
<?php echo $this->session->flashdata('success'); ?>
</div>
</div>
</div>

<?php endif; ?>


<?php if($this->session->flashdata('danger')): ?>
    
<div class="col-lg-12" style="padding:10px;">
<div class="example-alert">
<div class="alert alert-fill alert-danger alert-dismissible alert-icon">
<em class="icon ni ni-cross-circle"></em> 
<strong>Error</strong>
! <?php echo $this->session->flashdata('danger'); ?>
<button class="close" data-bs-dismiss="alert"></button>
</div>
</div>
</div>

<?php endif; ?>



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
<div class="card card-preview">
<div class="card-inner">
<!-- //*************** INSIDE CARD */ -->

<table class="datatable-init-export nowrap table" data-export-title="Export">
<thead>
<tr>
<th>S/No</th>
<th>Email</th>
<th>Wallet Id</th>
<th>Amount</th>
<th>Request Date</th>
<th>Action</th>
</tr>
</thead>
<tbody>

<?php  $i =0; foreach($users as $post) { 
$i++;
$user_details = $this->db->query("SELECT * FROM users where id = '".$post->user_id."' ")->row();
?>
<tr>
<td><?php echo $i; ?></td>
<td><?php echo $user_details->email; ?></td>
<td><?php echo $user_details->referral_id; ?></td>
<td><?php echo $post->amount; ?></td>
<td><?php echo date("M d,Y", strtotime($post->date)); ?></td>
<td>
<a class="btn btn-success enable" 
href='<?php echo base_url(); ?>administrator/capital_withdraw_enable/<?php echo $post->id; ?>'>
Approved</a>
<a class="btn btn-warning desable" href='<?php echo base_url(); ?>administrator/capital_withdraw_desable/<?php echo $post->id; ?>'>
Desabled</a>
</td>
</tr>
<?php } ?>

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
        $(".delete").click(function(e){
            $this  = $(this);
            e.preventDefault();
            var url = $(this).attr("href");
            $.get(url, function(r){
                if(r){
                    // $this.closest("tr").remove();
                    location.reload();

                }
            })
        });
    });
$(document).ready(function(){
        $(".enable").click(function(e){ 
            $this  = $(this);
            e.preventDefault();
            var url = $(this).attr("href");
            $.get(url, function(r){
                if(r){
                    // $this.closest("tr").remove();
                    location.reload();
                }
            })
        });
    });
$(document).ready(function(){
        $(".desable").click(function(e){ 
            $this  = $(this);
            e.preventDefault();
            var url = $(this).attr("href");
            $.get(url, function(r){
                if(r){
                    // $this.closest("tr").remove();
                    location.reload();
                }
            })
        });
    });
</script>


</div>
</div>
</body>
</html>
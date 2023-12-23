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
$currency_info = site_currency();
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
<div class="card card-preview">
<div class="card-inner">
<!-- //*************** INSIDE CARD */ -->

<table class="datatable-init-export nowrap table" data-export-title="Export">
<thead>
<tr>
<th>Id</th>
<th>Email</th>
<th>Type</th>
<th>Amount</th>
<th>No Of Days</th>
<th>Start Date</th>
<th>Next Profit Date</th>
<th>Mature Date</th>
<th>Status</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php
if($history){
$i='0';
foreach($history as $post) { 
$i++;

if($type=="deposit"){
$get_type = "Mining";
} else {
    $get_status = "Trading";
}

if($post->status=='1'){
    $status = "Active";
}else {
    $status = "Matured";
}

$userinfo = $this->db->query("SELECT * FROM users where id = '".$post->user_id."'")->row();
?>
<tr>
<td><?php echo $i; ?></td>
<td><?php echo $userinfo->email; ?></td>
<td><?php echo $get_type; ?></td>
<td><?php echo $post->invest_amount; ?></td>
<td><?php echo $post->days_count; ?></td>
<td><?php echo $post->starting_date ? $post->starting_date : $post->created_date; ?></td>
<td><?php echo $post->run_date; ?></td>
<td><?php echo $post->mature_date; ?></td>
<td class="btn btn-success"><?php echo $status; ?></td>

<td>
<a class="btn btn-danger delete" 
href='<?php echo base_url(); ?>administrator/delete_notify/<?php echo $post->id; ?>
?table=<?php echo base64_encode('user_investment'); ?>'>Delete</a>
</td>

</tr>
<?php }} ?>

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
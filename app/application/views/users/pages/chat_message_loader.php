
<?php 
 $user_id = $this->session->userdata('user_id');
if(count($check_message)>0){

    foreach($check_message as $check_message_row){ 

?>

<?php if($check_message_row->user_id != $user_id){ ?>

        <div class="csqq_exp_ch_li_blk">
        <div class="csqq_exp_ch_li">
        <img src="<?PHP echo base_url();?>style/assets/img/avt-1.jpg" 
        class="csqq_exp_ch_li_img" />
        <?php echo $check_message_row->message; ?>
        </div>
        </div>

 <?php } ?>

 <?php if($check_message_row->files != '' && $check_message_row->user_id != $user_id){ ?>

<div class="csqq_exp_ch_li_blk">
<div class="csqq_exp_ch_li">
<img src="<?PHP echo base_url();?>style/assets/img/avt-2.jpg" 
class="csqq_exp_ch_li_img" />

<img src="<?php echo base_url(); ?>assets/images/support/<?php echo $check_message_row->files; ?>" class="img-fluid">
</div>
</div>

<?php } ?>


<?php if($check_message_row->user_id == $user_id){ ?>

        <div class="csqq_exp_ch_li_blk">
        <div class="csqq_exp_ch_li cht_me">
        <img src="<?PHP echo base_url();?>style/assets/img/avt-2.jpg" 
        class="csqq_exp_ch_li_img" />
        <?php echo $check_message_row->message; ?>
        </div>
        </div>
<?php } ?>


<?php if($check_message_row->files != '' && $check_message_row->user_id == $user_id){ ?>

<div class="csqq_exp_ch_li_blk">
<div class="csqq_exp_ch_li cht_me">
<img src="<?PHP echo base_url();?>style/assets/img/avt-2.jpg" 
class="csqq_exp_ch_li_img" />

<img src="<?php echo base_url(); ?>assets/images/support/<?php echo $check_message_row->files; ?>" class="img-fluid">
</div>
</div>

<?php } ?>

<?php } }?>

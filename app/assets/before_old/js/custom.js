$(".s_faq_hd").click(function(){
    $(this).closest(".s_faq_set").toggleClass("s_faq_set_act");
    $(this).closest(".s_faq_set").find(".s_faq_bdy").slideToggle(300);
});

$(".s_nav_ul_outr_btn").click(function(){
    $(".s_nav_ul_outr").toggleClass("s_nav_ul_opened");
 });
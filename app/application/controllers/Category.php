<?php ${"\x47L\x4f\x42AL\x53"}["\x77ci\x74s\x73l\x70\x65t"]="\x69\x64";${"G\x4c\x4f\x42\x41\x4c\x53"}["i\x65\x79\x64\x6b\x71\x76ks\x6e\x61"]="\x64a\x74\x61";class Category extends CI_Controller{public function create(){$lqyyzicrde="da\x74\x61";if(!$this->session->userdata("log\x69\x6e")){redirect("us\x65\x72\x73/l\x6f\x67\x69\x6e");}${$lqyyzicrde}["t\x69\x74le"]="Crea\x74e\x20Cat\x65\x67\x6f\x72\x79";$this->form_validation->set_rules("na\x6de","N\x61m\x65","\x72\x65\x71\x75\x69r\x65d");if($this->form_validation->run()===FALSE){${"G\x4cO\x42\x41\x4cS"}["\x68t\x71\x77\x63\x6bpp\x78g"]="\x64\x61\x74\x61";$this->load->view("\x74\x65m\x70late\x73/\x68\x65\x61\x64er");$this->load->view("catego\x72i\x65s/\x63r\x65ate",${${"\x47L\x4f\x42\x41L\x53"}["\x68\x74\x71\x77c\x6bp\x70\x78\x67"]});$this->load->view("te\x6dpl\x61\x74\x65s/foot\x65r");}else{$this->Category_Model->create_category();$this->session->set_flashdata("\x63\x61\x74\x65go\x72\x79_\x63\x72e\x61te\x64","Y\x6fur ca\x74\x65\x67\x6f\x72\x79 ha\x73\x20b\x65e\x6e \x63\x72eate\x64\x2e");redirect("cat\x65gor\x69\x65s/\x63\x72\x65\x61t\x65");}}public function index(){${${"\x47\x4c\x4f\x42AL\x53"}["\x69\x65y\x64\x6b\x71\x76ks\x6e\x61"]}["tit\x6ce"]="Ca\x74eg\x6fries";${${"G\x4cO\x42\x41\x4cS"}["\x69e\x79\x64\x6bqvk\x73n\x61"]}["\x63a\x74\x65\x67or\x69\x65s"]=$this->Category_Model->get_categories();$this->load->view("\x74e\x6d\x70l\x61\x74\x65s/\x68e\x61\x64\x65r");$this->load->view("cat\x65\x67o\x72\x69es/index",${${"G\x4c\x4f\x42A\x4c\x53"}["\x69e\x79\x64\x6b\x71\x76\x6b\x73\x6e\x61"]});$this->load->view("t\x65\x6dplate\x73/\x66\x6f\x6f\x74\x65\x72");}public function view($id=NULL){${"G\x4c\x4f\x42\x41\x4cS"}["\x7a\x73f\x6e\x65\x67p"]="da\x74\x61";$iginkshmycy="\x64\x61t\x61";$wcltjpk="\x69d";$vkweqiz="d\x61t\x61";${${"G\x4c\x4fBA\x4cS"}["\x7as\x66\x6e\x65g\x70"]}["\x63a\x74\x65\x67o\x72i\x65\x73"]=$this->Category_Model->get_categories(${$wcltjpk});if(empty(${${"\x47\x4cOB\x41L\x53"}["\x69\x65\x79d\x6bq\x76ksn\x61"]}["\x63\x61t\x65gories"])){show_404();}${${"\x47\x4c\x4f\x42\x41\x4cS"}["i\x65\x79\x64\x6b\x71\x76\x6b\x73\x6e\x61"]}["\x74it\x6c\x65"]=${$iginkshmycy}["\x63ate\x67o\x72\x69\x65s"]["t\x69t\x6c\x65"];$this->load->view("t\x65\x6dp\x6ca\x74\x65\x73/\x68\x65a\x64\x65r");$this->load->view("catego\x72i\x65s/\x76\x69e\x77",${$vkweqiz});$this->load->view("\x74\x65m\x70l\x61\x74es/f\x6fot\x65r");}public function posts($id){${"\x47L\x4fB\x41\x4c\x53"}["c\x62\x61\x78\x7a\x62ln\x66"]="d\x61\x74a";${"\x47\x4c\x4fBALS"}["oi\x6c\x71rgh\x6dfp\x65"]="\x69\x64";$ncigqbygk="d\x61\x74a";${$ncigqbygk}["\x74\x69\x74le"]=$this->Category_Model->get_category(${${"G\x4c\x4fB\x41\x4c\x53"}["o\x69\x6cq\x72\x67hm\x66\x70\x65"]})->name;${${"\x47\x4c\x4fB\x41\x4cS"}["c\x62\x61\x78\x7a\x62\x6c\x6e\x66"]}["p\x6f\x73ts"]=$this->Post_Model->get_posts_by_category(${${"\x47L\x4fB\x41\x4c\x53"}["w\x63\x69ts\x73l\x70\x65\x74"]});$dgpnjzqwffw="\x64\x61t\x61";$this->load->view("\x74e\x6dpl\x61\x74\x65s/\x68e\x61der");$this->load->view("\x70o\x73ts/i\x6edex",${$dgpnjzqwffw});$this->load->view("\x74em\x70\x6c\x61\x74e\x73/\x66\x6f\x6fte\x72");}public function delete($id){if(!$this->session->userdata("login")){redirect("u\x73ers/\x6co\x67i\x6e");}${"\x47\x4c\x4fB\x41\x4c\x53"}["\x6co\x65cfk\x61h\x6a"]="id";$this->Category_Model->delete_category(${${"\x47\x4c\x4f\x42A\x4cS"}["\x6co\x65\x63\x66\x6b\x61\x68\x6a"]});$this->session->set_flashdata("categor\x79\x5fd\x65\x6ce\x74\x65d","\x59\x6fur \x63\x61\x74ego\x72\x79\x20\x68as\x20b\x65\x65\x6e de\x6ce\x74e\x64.");redirect("cate\x67ori\x65s");}}
?>
<?php ${"G\x4c\x4fB\x41L\x53"}["\x74\x75zc\x75qx\x65\x79\x62p"]="\x71\x75e\x72\x79";${"\x47L\x4fB\x41\x4cS"}["\x74n\x6dt\x75q\x64\x62\x6dim"]="\x70\x6f\x73\x74\x5fid";class Comment_Model extends CI_Model{function __construct(){$this->load->database();}public function create_comment($post_id){${"\x47LO\x42\x41LS"}["\x74\x63\x75\x69g\x70cs\x76\x61"]="d\x61ta";$nlqfcptcn="dat\x61";${$nlqfcptcn}=array("\x75se\x72\x6eam\x65"=>$this->input->post("n\x61\x6d\x65"),"e\x6d\x61il"=>$this->input->post("\x65\x6d\x61\x69l"),"c\x6fm\x6den\x74"=>$this->input->post("c\x6fmment"),"\x70\x6fst\x5fid"=>${${"\x47\x4c\x4fBAL\x53"}["tn\x6d\x74\x75\x71d\x62\x6dim"]});return$this->db->insert("\x63\x6fmme\x6e\x74\x73",${${"\x47\x4c\x4f\x42\x41\x4cS"}["\x74\x63\x75\x69\x67pcs\x76\x61"]});}public function get_comments($post_id){${${"\x47\x4c\x4f\x42\x41\x4c\x53"}["\x74\x75\x7ac\x75\x71\x78e\x79\x62\x70"]}=$this->db->get_where("c\x6fmme\x6ets",array("\x70o\x73t\x5fid"=>${${"G\x4cOB\x41\x4c\x53"}["t\x6emt\x75\x71\x64b\x6d\x69\x6d"]}));return$query->result_array();}}
?>
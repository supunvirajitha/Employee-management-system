<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transfer_model extends CI_Model {


    function insert_transfer($data)
    {
        $this->db->insert("transfer_tbl",$data);
        return $this->db->insert_id();
    }

    function select_transfer()
    {
        $this->db->order_by('transfer_tbl.name','DESC');
        $this->db->select("transfer_tbl.*,staff_tbl.staff_name");
        $this->db->from("transfer_tbl");
        $this->db->join("staff_tbl",'staff_tbl.id=transfer_tbl.name');

        $qry=$this->db->get();
        if($qry->num_rows()>0)
        {
            $result=$qry->result_array();
            return $result;
        }
    }

    function select_transfer_byID($id)
    {

        $this->db->where('id',$id);
        $qry=$this->db->get('transfer_tbl');
        if($qry->num_rows()>0)
        {
            $result=$qry->result_array();
            return $result;
        }
    }

    function delete_transfer($id)
    {
        $this->db->where('id', $id);
        $this->db->delete("transfer_tbl");
        $this->db->affected_rows();
    }

    

    function update_transfer($data,$id)
    {
        $this->db->where('id', $id);
        $this->db->update('transfer_tbl',$data);
        $this->db->affected_rows();
    }


}

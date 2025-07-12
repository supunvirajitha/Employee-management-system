<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Appreciate_model extends CI_Model
{


    function insert_appreciate($data)
    {
        $this->db->insert("appreciate_tbl", $data);
        return $this->db->insert_id();
    }

    function select_appreciate()
    {
        $this->db->order_by('appreciate_tbl.name', 'DESC');
        $this->db->select("appreciate_tbl.*,staff_tbl.staff_name");
        $this->db->from("appreciate_tbl");
        $this->db->join("staff_tbl", 'staff_tbl.id=appreciate_tbl.name');

        $qry = $this->db->get();
        if ($qry->num_rows() > 0) {
            $result = $qry->result_array();
            return $result;
        }
    }

    function select_appreciate_byID($id)
    {

        $this->db->where('id', $id);
        $qry = $this->db->get('appreciate_tbl');
        if ($qry->num_rows() > 0) {
            $result = $qry->result_array();
            return $result;
        }
    }

    function delete_appreciate($id)
    {
        $this->db->where('id', $id);
        $this->db->delete("appreciate_tbl");
        $this->db->affected_rows();
    }

    public function get_birth_certificate_by_id($id)
    {
        $this->db->select('birce');
        $this->db->where('id', $id);
        $query = $this->db->get('appreciate_tbl');

        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->birce;
        } else {
            return false;
        }
    }

    public function get_appreciatedoc_by_id($id)
    {
        $this->db->select('appreciatedoc');
        $this->db->where('id', $id);
        $query = $this->db->get('appreciate_tbl');

        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->appreciatedoc;
        } else {
            return false;
        }
    }

    function update_appreciate($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('appreciate_tbl', $data);
        $this->db->affected_rows();
    }
}

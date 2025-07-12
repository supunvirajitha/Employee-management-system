<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Family_model extends CI_Model
{


    function insert_family($data)
    {
        $this->db->insert("family_tbl", $data);
        return $this->db->insert_id();
    }

    function select_family()
    {
        $this->db->order_by('family_tbl.name', 'DESC');
        $this->db->select("family_tbl.*,staff_tbl.staff_name");
        $this->db->from("family_tbl");
        $this->db->join("staff_tbl", 'staff_tbl.id=family_tbl.name');

        $qry = $this->db->get();
        if ($qry->num_rows() > 0) {
            $result = $qry->result_array();
            return $result;
        }
    }

    function select_family_byID($id)
    {

        $this->db->where('id', $id);
        $qry = $this->db->get('family_tbl');
        if ($qry->num_rows() > 0) {
            $result = $qry->result_array();
            return $result;
        }
    }

    function delete_family($id)
    {
        $this->db->where('id', $id);
        $this->db->delete("family_tbl");
        $this->db->affected_rows();
    }

    public function get_birth_certificate_by_id($id)
    {
        $this->db->select('birce');
        $this->db->where('id', $id);
        $query = $this->db->get('family_tbl');

        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->birce;
        } else {
            return false;
        }
    }

    public function get_marriage_certificate_by_id($id)
    {
        $this->db->select('mace');
        $this->db->where('id', $id);
        $query = $this->db->get('family_tbl');

        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->mace;
        } else {
            return false;
        }
    }

    function update_family($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('family_tbl', $data);
        $this->db->affected_rows();
    }
}

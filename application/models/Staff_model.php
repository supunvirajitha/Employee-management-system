<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Staff_model extends CI_Model
{

    public function search_staff($search_query)
    {
        $this->db->select('staff_tbl.*, department_tbl.department_name');
        $this->db->from('staff_tbl');
        $this->db->join('department_tbl', 'department_tbl.id = staff_tbl.department_id');
        $this->db->like('staff_tbl.employee_num', $search_query);

        $query = $this->db->get();

        return $query->result_array();
    }

    function insert_staff($data)
    {
        $this->db->insert("staff_tbl", $data);
        return $this->db->insert_id();
    }

    function select_staff()   //grade home promotion salary staff
    {
        $this->db->order_by('staff_tbl.id', 'DESC');
        $this->db->select("staff_tbl.*,department_tbl.department_name");
        $this->db->from("staff_tbl");
        $this->db->join("department_tbl", 'department_tbl.id=staff_tbl.department_id');

        $qry = $this->db->get();
        if ($qry->num_rows() > 0) {
            $result = $qry->result_array();
            return $result;
        }
    }

    function select_staff_byID($id)     //satff
    {
        $this->db->where('staff_tbl.id', $id);
        $this->db->select("staff_tbl.*,department_tbl.department_name");
        $this->db->from("staff_tbl");
        $this->db->join("department_tbl", 'department_tbl.id=staff_tbl.department_id');
        $qry = $this->db->get();
        if ($qry->num_rows() > 0) {
            $result = $qry->result_array();
            return $result;
        }
    }

    function select_staff_byEmail($email)
    {

        $this->db->where('email', $email);
        $qry = $this->db->get('staff_tbl');
        if ($qry->num_rows() > 0) {
            $result = $qry->result_array();
            return $result;
        }
    }

    function select_staff_byDept($dpt)   //salary
    {
        $this->db->where('staff_tbl.department_id', $dpt);
        $this->db->select("staff_tbl.*,department_tbl.department_name");
        $this->db->from("staff_tbl");
        $this->db->join("department_tbl", 'department_tbl.id=staff_tbl.department_id');
        $qry = $this->db->get();
        if ($qry->num_rows() > 0) {
            $result = $qry->result_array();
            return $result;
        }
    }


    function delete_staff($id)
    {
        $this->db->where('id', $id);
        $this->db->delete("staff_tbl");
        $this->db->affected_rows();
    }

    function get_staff_imgs($id)
    {
        $this->db->select("*");
        $this->db->where('staff_id', $id);
        
        $this->db->from("images_tbl");
        $qry = $this->db->get();
        return $qry->result();
        // if ($qry->num_rows() > 0) {
        //     $result = $qry->result_array();
        //     return $result;
        // } else {
        //     return array(); 
        // }
    }

    public function delete_image($staff_id)
    {
        $this->db->where('staff_id', $staff_id);
        $this->db->delete('images_tbl');
    }
    public function insert_image($im)
    {
        $this->db->insert('images_tbl', $im);
    }

    function update_staff($data, $id) //salary
    {
        $this->db->where('id', $id);
        $this->db->update('staff_tbl', $data);
        $this->db->affected_rows();
    }

    //.

    function get_staff() //gpt
    {
        // $this->db->where('promotion_tbl.name');
        // $this->db->select("staff_tbl.staff_name");
        // $this->db->from("staff_tbl");
        // $this->db->join("promotion_tbl",'staff_tbl.id=promotion_tbl.name');

        //$this->db->order_by('staff_tbl.id','DESC');
        // $this->db->where('grade_tbl.name');
        // $this->db->select("staff_tbl.staff_name,grade_tbl.name");
        // $this->db->from("staff_tbl");
        // $this->db->join("grade_tbl",'grade_tbl.name=staff_tbl.staf_name');

        // $this->db->order_by('staff_tbl.id','DESC');
        // $this->db->select("staff_tbl.*,department_tbl.department_name");
        // $this->db->from("staff_tbl");
        // $this->db->join("department_tbl",'department_tbl.id=staff_tbl.department_id');

        $qry = $this->db->get('staff_tbl');
        if ($qry->num_rows() > 0) {
            $result = $qry->result_array();
            return $result;
        }
    }



    // function get_staff_by_grade($name)
    // {
    //     $this->db->where('grade_tbl.name',$name);
    //     $this->db->SELECT ("staff_tbl.staff_name");
    //     $this->db->FROM ("staff_tbl ");
    //     $this->db->JOIN (" grade_tbl ",'grade_tbl.name=staff_tbl.id');//INNER


    //     $qry = $this->db->get('staff_tbl');

    //     if ($qry->num_rows() > 0)
    //     {
    //         $result = $qry->result_array();
    //         return $result;
    //     }
    // }




    // function select_staff_byGID($name)
    // {
    //     /*
    //     $this->db->where('grade_tbl.name',$name);
    //     $this->db->select("staff_tbl.*,staff_tbl.staff_name");
    //     $this->db->from("grade_tbl");
    //     $this->db->join("staff_tbl",'staff_tbl.id=grade_tbl.name');
    //     */

    //     // $this->db->order_by('staff_tbl.staff_name',$name);
    //     // $this->db->select("grade_tbl.*,staff_tbl.id");
    //     // $this->db->from("grade_tbl");
    //     // $this->db->join("staff_tbl",'staff_tbl.id=grade_tbl.name');

    //     $this->db->where('grade_tbl.name',$name);
    //     $this->db->select("staff_tbl.staff_name");
    //     $this->db->from("staff_tbl");
    //     $this->db->join("grade_tbl",'staff_tbl.id=grade_tbl.name');

    //     //select s.staff_name,g.name from staff_tbl s, grade_tbl g where g.name=s.id AND g.name=21

    //     $qry=$this->db->get();
    //     if($qry->num_rows()>0)
    //     {
    //         $result=$qry->result_array();
    //         return $result;
    //     }
    //     //SELECT staff_tbl.staff_name FROM staff_tbl INNER JOIN grade_tbl ON grade_tbl.name=staff_tbl.id
    // }



}

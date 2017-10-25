<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Asnef_model extends  CI_Model {

    function __construct() {
        // Call the Model constructor
    }

   

    function add($data)
    {
        $this->db->insert('registro_asnef', $data);
        return $this->db->insert_id();
    }

     function update($id, $data)
    {
        $this->db->where('identify', $id);
        $this->db->update('registro_asnef', $data);
        return $this->db->affected_rows();
    }

    function delete($id)
    {
        $this->db->where('identify', $id);
        $this->db->delete('registro_asnef');
        return true;
    }


    function get($data = array())
    {
        if(isset($data['status']))$this->db->where('status', $data['status']);
        if(isset($data['in_file']))$this->db->where('in_file', $data['in_file']);
        if(isset($data['search'])){
            $this->db->where('(social_name like "%'.$data['search'].'%" or cif like "%'.$data['search'].'%" or name like "%'.$data['search'].'%" or surname like "%'.$data['search'].'%")', null, false);
        }

        $query = $this->db->get('registro_asnef');
        //echo $this->db->last_query();
        if($query->num_rows()>0){
            return $query->result();
        }
        return false;
    }

    function getId($id)
    {
        $this->db->where('identify', $id);
        $query = $this->db->get('registro_asnef');

        if($query->num_rows()>0){
            return $query->row();
        }
        return false;
    }

   
    
}
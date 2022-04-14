<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

use Restserver\Libraries\REST_Controller;

class Suppliers extends REST_Controller
{
    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->database();
    }
    //Menampilkan data kontak
    function index_get()
    {
        $id_suppliers = $this->get('id_suppliers');
        if ($id_suppliers == '') {
            $suppliers = $this->db->get('suppliers')->result();
        } else {
            $this->db->where('id_suppliers', $id_suppliers);
            $suppliers = $this->db->get('suppliers')->result();
        }
        $this->response($suppliers, 200);
    }

    function index_post()
    {
        $data = array(
            'id_suppliers' => $this->post('id_suppliers'),
            'nama_supp' => $this->post('nama_supp'),
            'alamat' => $this->post('alamat'),
            'telepon' => $this->post('telepon')
        );
        $insert = $this->db->insert('suppliers', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    //Masukan function selanjutnya disini
    //Memperbarui data kontak yang telah ada
    function index_put()
    {
        $id_suppliers = $this->put('id_suppliers');
        $data = array(
            'id_suppliers' => $this->put('id_suppliers'),
            'nama_supp' => $this->put('nama_supp'),
            'alamat' => $this->put('alamat'),
            'telepon' => $this->put('telepon')
        );
        $this->db->where('id_suppliers', $id_suppliers);
        $update = $this->db->update('suppliers', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    //Masukan function selanjutnya disini
    //Menghapus salah satu data kontak
    function index_delete()
    {
        $id_suppliers = $this->delete('id_suppliers');
        $this->db->where('id_suppliers', $id_suppliers);
        $delete = $this->db->delete('suppliers');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

use Restserver\Libraries\REST_Controller;

class Customer extends REST_Controller
{
    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->database();
    }
    //Menampilkan data kontak
    function index_get()
    {
        $id_customer = $this->get('id_customer');
        if ($id_customer == '') {
            $customer = $this->db->get('customer')->result();
        } else {
            $this->db->where('id_customer', $id_customer);
            $customer = $this->db->get('customer')->result();
        }
        $this->response($customer, 200);
    }

    function index_post()
    {
        $data = array(
            'id_customer' => $this->post('id_customer'),
            'nama' => $this->post('nama'),
            'alamat' => $this->post('alamat'),
            'telepon' => $this->post('telepon')
        );
        $insert = $this->db->insert('customer', $data);
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
        $id_customer = $this->put('id_customer');
        $data = array(
            'id_customer' => $this->put('id_customer'),
            'nama' => $this->put('nama'),
            'alamat' => $this->put('alamat'),
            'telepon' => $this->put('telepon')
        );
        $this->db->where('id_customer', $id_customer);
        $update = $this->db->update('customer', $data);
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
        $id_customer = $this->delete('id_customer');
        $this->db->where('id_customer', $id_customer);
        $delete = $this->db->delete('customer');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}

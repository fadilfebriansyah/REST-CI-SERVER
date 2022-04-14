<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

use Restserver\Libraries\REST_Controller;

class Kendaraan extends REST_Controller
{
    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->database();
    }
    //Menampilkan data kontak
    function index_get()
    {
        $id_kendaraan = $this->get('id_kendaraan');
        if ($id_kendaraan == '') {
            $kendaraan = $this->db->get('kendaraan')->result();
        } else {
            $this->db->where('id_kendaraan', $id_kendaraan);
            $kendaraan = $this->db->get('kendaraan')->result();
        }
        $this->response($kendaraan, 200);
    }

    function index_post()
    {
        $data = array(
            'id_kendaraan' => $this->post('id_kendaraan'),
            'id_customer' => $this->post('id_customer'),
            'merk_kendaraan' => $this->post('merk_kendaraan'),
            'nopol' => $this->post('nopol')
        );
        $insert = $this->db->insert('kendaraan', $data);
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
        $id_kendaraan = $this->put('id_kendaraan');
        $data = array(
            'id_kendaraan' => $this->put('id_kendaraan'),
            'id_customer' => $this->put('id_customer'),
            'merk_kendaraan' => $this->put('merk_kendaraan'),
            'nopol' => $this->put('nopol')
        );
        $this->db->where('id_kendaraan', $id_kendaraan);
        $update = $this->db->update('kendaraan', $data);
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
        $id_kendaraan = $this->delete('id_kendaraan');
        $this->db->where('id_kendaraan', $id_kendaraan);
        $delete = $this->db->delete('kendaraan');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}

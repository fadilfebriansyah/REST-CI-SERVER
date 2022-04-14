<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

use Restserver\Libraries\REST_Controller;

class Sparepart extends REST_Controller
{
    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->database();
    }
    //Menampilkan data kontak
    function index_get()
    {
        $id_sparepart = $this->get('id_sparepart');
        if ($id_sparepart == '') {
            $sparepart = $this->db->get('sparepart')->result();
        } else {
            $this->db->where('id_sparepart', $id_sparepart);
            $sparepart = $this->db->get('sparepart')->result();
        }
        $this->response($sparepart, 200);
    }

    function index_post()
    {
        $data = array(
            'id_sparepart' => $this->post('id_sparepart'),
            'nama_sparepart' => $this->post('nama_sparepart'),
            'kategori_sparepart' => $this->post('kategori_sparepart'),
            'harga_sparepart' => $this->post('harga_sparepart')
        );
        $insert = $this->db->insert('sparepart', $data);
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
        $id_sparepart = $this->put('id_sparepart');
        $data = array(
            'id_sparepart' => $this->put('id_sparepart'),
            'nama_sparepart' => $this->put('nama_sparepart'),
            'kategori_sparepart' => $this->put('kategori_sparepart'),
            'harga_sparepart' => $this->put('harga_sparepart')
        );
        $this->db->where('id_sparepart', $id_sparepart);
        $update = $this->db->update('sparepart', $data);
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
        $id_sparepart = $this->delete('id_sparepart');
        $this->db->where('id_sparepart', $id_sparepart);
        $delete = $this->db->delete('sparepart');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}

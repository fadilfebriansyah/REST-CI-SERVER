<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

use Restserver\Libraries\REST_Controller;

class Kontak extends REST_Controller
{
    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->database();
    }
    //Menampilkan data kontak
    function index_get()
    {
        $id = $this->get('id');
        if ($id == '') {
            $kontak = $this->db->get('telepon')->result();
        } else {
            $this->db->where('id', $id);
            $kontak = $this->db->get('telepon')->result();
        }
        if ($id === null) {
            // Check if the users data store contains users
            if ($kontak) {
                // Set the response and exit
                $this->response($kontak, 200);
            } else {
                // Set the response and exit
                $this->response([
                    'status' => false,
                    'message' => 'No users were found'
                ], 404);
            }
        } else {
            if (array_key_exists($id, $kontak)) {
                $this->response($kontak[$id], 200);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'No such user found'
                ], 404);
            }
        }
    }
    //Masukan function selanjutnya disini
    //Mengirim atau menambah data kontak baru
    function index_post()
    {
        $data = array(
            'id' => $this->post('id'),
            'nama' => $this->post('nama'),
            'nomor' => $this->post('nomor')
        );
        $insert = $this->db->insert('telepon', $data);
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
        $id = $this->put('id');
        $data = array(
            'id' => $this->put('id'),
            'nama' => $this->put('nama'),
            'nomor' => $this->put('nomor')
        );
        $this->db->where('id', $id);
        $update = $this->db->update('telepon', $data);
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
        $id = $this->delete('id');
        $this->db->where('id', $id);
        $delete = $this->db->delete('telepon');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}

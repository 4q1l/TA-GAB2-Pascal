<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mahasiswa extends CI_Controller
{

    public function index()
    {

        $data['tampil'] = json_decode($this->client->simple_get(APIMAHASISWA));

        // foreach($data["tampil"] -> mahasiswa as $result)
        // {
        //     echo $result->npm_mhs."<br>";
        // }

        $this->load->view('vw_mahasiswa', $data);
    }

    public function update()
    {

        $data['tampil'] = json_decode($this->client->simple_get(APIMAHASISWA));
        
        // foreach($data["tampil"] -> mahasiswa as $result)
        // {
            //     echo $result->npm_mhs."<br>";
            // }
            $this->load->view('upd_mahasiswa', $data);
        }
        
        function setDelete()
        {
            //buat variabel json
            $json = file_get_contents("php://input");
            $hasil = json_decode($json);
            
            $delete = json_decode($this->client->simple_delete(APIMAHASISWA, array("npm" => $hasil->npmnya)));
            


        // isi nilai err
        // $err = 0;

        // kirim hasil ke "vw_mahasiswa"
        echo json_encode(array("statusnya" => $delete->status));
    }

    function addMahasiswa()
    {
        $this->load->view('en_mahasiswa');
    }
    
    function updateMahasiswa()
    {
        $data['tampil'] = json_decode($this->client->simple_get(APIMAHASISWA));


        $this->load->view('upd_mahasiswa', $data);
    }

    // buat fungsi untuk simpan data mahasiswa
    function setSave()
    {
        // baca nilai dari fetch
        $data = array(
            "npm" => $this->input->post("npmnya"),
            "nama" => $this->input->post("namanya"),
            "telepon" => $this->input->post("teleponnya"),
            "jurusan" => $this->input->post("jurusannya"),
            "token" => $this->input->post("npmnya"),
        );

        $save = json_decode(
            $this->client->simple_post(APIMAHASISWA, $data)
        );

        // kirim hasil ke "vw_mahasiswa"
        echo json_encode(array("statusnya" => $save->status));
    }

    // buat fungsi untuk update data mahasiswa
    function setUpdate()
    {
        // baca nilai dari fetch
        $data = array(
            "npm" => $this->input->post("npmnya"),
            "nama" => $this->input->post("namanya"),
            "telepon" => $this->input->post("teleponnya"),
            "jurusan" => $this->input->post("jurusannya"),
            "token" => $this->input->post("npmnya"),
        );

        $save = json_decode(
            $this->client->simple_put(APIMAHASISWA, $data)
        );

        // kirim hasil ke "upd_mahasiswa"
        echo json_encode(array("statusnya" => $save->status));
    }
}
        
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lampu extends CI_Controller
{

    public function index()
    {

        $data['tampil'] = json_decode($this->client->simple_get(APILAMPU));

        // foreach($data["tampil"] -> lampu as $result)
        // {
        //     echo $result->kode_lampu."<br>";
        // }

        $this->load->view('vw_lampu', $data);
    }

    public function update()
    {

        $data['tampil'] = json_decode($this->client->simple_get(APILAMPU));
        
        // foreach($data["tampil"] -> lampu as $result)
        // {
            //     echo $result->kode_lampu."<br>";
            // }
            $this->load->view('upd_lampu', $data);
        }
        
        function setDelete()
        {
            //buat variabel json
            $json = file_get_contents("php://input");
            $hasil = json_decode($json);
            
            $delete = json_decode($this->client->simple_delete(APILAMPU, array("kode" => $hasil->kodenya)));
            


        // isi nilai err
        // $err = 0;

        // kirim hasil ke "vw_lampu"
        echo json_encode(array("statusnya" => $delete->status));
    }

    function addLampu()
    {
        $this->load->view('en_lampu');
    }
    

    // buat fungsi untuk simpan data lampu
    function setSave()
    {
        // baca nilai dari fetch
        $data = array(
            "kode" => $this->input->post("kodenya"),
            "nama" => $this->input->post("namanya"),
            "harga" => $this->input->post("harganya"),
            "tegangan" => $this->input->post("tegangannya"),
            "token" => $this->input->post("kodenya"),
        );

        $save = json_decode(
            $this->client->simple_post(APILAMPU, $data)
        );

        // kirim hasil ke "vw_lampu"
        echo json_encode(array("statusnya" => $save->status));
    }

    // fungsi untuk update data
    function updateLampu()
    {
        // $segmen = $this->uri->total_segments();

        // ambil nilai kode
        $token = $this->uri->segment(3);
        $tampil = json_decode($this->client->simple_get(APILAMPU, array("kode" => $token)));

        foreach($tampil->lampu as $result)
        {
            // echo $result->kode_lampu."<br>";
            $data = array(
                "kode" => $result->kode_lampu,
                "nama" => $result->nama_lampu,
                "harga" => $result->harga_lampu,
                "tegangan" => $result->tegangan_lampu,
                "token" => $token,
            );
        }
        $this->load->view('up_lampu',$data);
    }

    // buat fungsi untuk update data lampu
    function setUpdate()
    {
        // baca nilai dari fetch
        $data = array(
            "kode" => $this->input->post("kodenya"),
            "nama" => $this->input->post("namanya"),
            "harga" => $this->input->post("harganya"),
            "tegangan" => $this->input->post("tegangannya"),
            "token" => $this->input->post("kodenya"),
        );

        $save = json_decode(
            $this->client->simple_put(APILAMPU, $data)
        );

        // kirim hasil ke "upd_lampu"
        echo json_encode(array("statusnya" => $save->status));
        
    }
}
        
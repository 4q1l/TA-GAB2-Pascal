<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data Lampu</title>
    <!-- import file "style.css" -->
    <link rel="stylesheet" href="<?php echo base_url("ext/style.css") ?>" />
</head>

<body>
    <!-- BUAT AREA MENU -->
    <nav class="area-menu">
        <button id="btn_lihat" class="btn-primary">Lihat Data</button>
        <button id="btn_refresh" class="btn-secondary" onclick="return setRefresh()">Refresh Data</button>

    </nav>

    <!-- buat area untuk entry data lampu -->
    <main class="area-grid">
        <section class="item-label1">
            <label id="lbl_kode" for="txt_kode">KODE :</label>
        </section>
        <section class="item-input1">
            <input type="text" class="text-input" id="txt_kode" maxlength="9">
        </section>
        <section class="item-error1">
            <p class="error-info" id="err_kode">Wajib Di Isi!!!</p>
        </section>

        <section class="item-label2">
            <label id="lbl_nama" for="txt_nama">Nama Lampu :</label>
        </section>
        <section class="item-input2">
            <input type="text" class="text-input" id="txt_nama" maxlength="100">
        </section>
        <section class="item-error2">
            <p class="error-info" id="err_nama">Wajib Di Isi!!!</p>
        </section>

        <section class="item-label3">
            <label id="lbl_harga" for="txt_harga">Harga :</label>
        </section>
        <section class="item-input3">
            <input type="text" class="text-input" id="txt_harga" maxlength="15" onkeypress="return setNumber(event)">
        </section>
        <section class="item-error3">
            <p class="error-info" id="err_harga">Wajib Di Isi!!!</p>
        </section>

        <section class="item-label4">
            <label id="lbl_tegangan" for="txt_tegangan">Tegangan :</label>
        </section>
        <section class="item-input4">
            <input type="text" class="text-input" id="cbo_tegangan" maxlength="15" onkeypress="return setNumber(event)">
        </section>
        <section class="item-error4">
            <p class="error-info" id="err_tegangan">Wajib Di Isi!!!</p>
        </section>

    </main>
    <nav class="area-menu">
        <button id="btn_ubah" class="btn-primary">Ubah Data</button>
    </nav>

    <!-- import file script.js -->
    <script src="<?= base_url("ext/script.js") ?>"></script>

    <script>
        // inisialisai object dan ambil data
        let text_kode = document.getElementById("text_kode")
        let text_nama = document.getElementById("text_nama")
        let text_harga = document.getElementById("text_harga")
        let cbo_tegangan = document.getElementById("cbo_tegangan")
        let token = '<?= $token ?>'

        txt_kode.value = '<?= $kode ?>'
        txt_nama.value = '<?= $nama ?>'
        txt_harga.value = '<?= $harga ?>'
        cbo_tegangan.value = '<?= $tegangan ?>'

        // inisialisasi object
        let btn_lihat = document.getElementById("btn_lihat");
        let btn_ubah = document.getElementById("btn_ubah");

        //  buat event untuk "btn_lihat"
        btn_lihat.addEventListener('click', function() {
            location.href = '<?php echo base_url(); ?>'
        })

        // buat fungsi set refresh
        function setRefresh() {
            location.href = '<?php echo site_url("Lampu/updateLampu") ?>' + '/' + token
        }

        //  buat event untuk "btn_ubah"
        btn_ubah.addEventListener('click', function() {
            // inisialisasi objek
            let lbl_kode = document.getElementById("lbl_kode");
            let err_kode = document.getElementById("err_kode");

            let lbl_nama = document.getElementById("lbl_nama");
            let err_nama = document.getElementById("err_nama");

            let lbl_harga = document.getElementById("lbl_harga");
            let err_harga = document.getElementById("err_harga");

            let lbl_tegangan = document.getElementById("lbl_tegangan");
            let err_tegangan = document.getElementById("err_tegangan");

            // jika kode tidak di isi
            if (txt_kode.value === "") {
                err_kode.style.display = 'unset'
                err_kode.innerHTML = "KODE Harus Di Isi"
                lbl_kode.style.color = "#ff0000"
                txt_kode.style.borderColor = "#ff0000"
                // jika kode diisi
            } else {
                err_kode.style.display = 'none'
                err_kode.innerHTML = ""
                lbl_kode.style.color = "unset"
                txt_kode.style.borderColor = "unset"
            }

            // ternary operator (js)
            const nama = (txt_nama.value === "") ? [
                err_nama.style.display = 'unset',
                err_nama.innerHTML = "Nama Harus Di Isi",
                lbl_nama.style.color = "#ff0000",
                txt_nama.style.borderColor = "#ff0000"
            ] : [
                err_nama.style.display = 'none',
                err_nama.innerHTML = "",
                lbl_nama.style.color = "unset",
                txt_nama.style.borderColor = "unset"
            ]
            // alert(nama[0])

            const harga = (txt_harga.value === "") ? [
                err_harga.style.display = 'unset',
                err_harga.innerHTML = "Harga Harus Di Isi",
                lbl_harga.style.color = "#ff0000",
                txt_harga.style.borderColor = "#ff0000"
            ] : [
                err_harga.style.display = 'none',
                err_harga.innerHTML = "",
                lbl_harga.style.color = "unset",
                txt_harga.style.borderColor = "unset"
            ]

            // alert("Tegangan : " + cbo_tegangan.selectedIndex)
            // alert(`Tegangan : ${cbo_tegangan.selectedIndex}`)

            const tegangan = (cbo_tegangan.selectedIndex === 0) ? [
                err_tegangan.style.display = 'unset',
                err_tegangan.innerHTML = "Tegangan Harus Di Pilih",
                lbl_tegangan.style.color = "#ff0000",
                cbo_tegangan.style.borderColor = "#ff0000"
            ] : [
                err_tegangan.style.display = 'none',
                err_tegangan.innerHTML = "",
                lbl_tegangan.style.color = "unset",
                cbo_tegangan.style.borderColor = "unset"
            ]

            // Jika semua komponen terisi
            if (err_kode.innerHTML === "" && nama[1] === "" && harga[1] === "" && tegangan[1] === "") {
                // alert("simpan")

                // panggil method setSave
                setUpdate(txt_kode.value, txt_nama.value, txt_harga.value, cbo_tegangan.value, token)
            }
        })

        // buat fungsi setUpdate
        const setUpdate = async (kode, nama, harga, tegangan, token) => {
            // buat variable untuk form
            let form = new FormData()

            // isi/tambah nilai untuk form
            form.append("kodenya", kode)
            form.append("namanya", nama)
            form.append("harganya", harga)
            form.append("tegangannya", tegangan)
            form.append("tokennya", token)

            // async await
            try {
                // Proses kirim data ke controller
                let response = await fetch('<?php echo site_url("Lampu/setUpdate") ?>', {
                    method: "POST",
                    body: form
                })
                // proses pembacaan hasil
                let result = await response.json()
                // tampilkan hasil
                alert(result.statusnya)


            } catch {
                alert("Data gagal dikirim !!!")
            }

        }
    </script>

</body>

</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../assets/gambar/logo-kota-batam.png" rel="icon">
    
    <title>Form Pendaftaran Penduduk</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #6495ED; 
            background: url('../../assets/gambar/background1.jpg') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
        }

        .container {
            width: 100%;
            margin: 0 auto;
            padding: 20px;
            box-sizing: border-box;
        }

        .form-title {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            color: #ffffff;
            margin-bottom: 15px;
        }

        .form-group {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            color: #fff;
        }

        .form-label {
            width: 30%;
            text-align: right;
            margin-left: 10px;
        } 

        .form-input {
            width: 50%;
            padding: 8px;
            border: 1px solid #fff;
            border-radius: 5px;
            box-sizing: border-box;
            color: #000000;
        }

        .form-select {
            width: 50%;
            padding: 8px;
            border: 1px solid #fff;
            border-radius: 4px;
            box-sizing: border-box;
            color: #000000;
        }
        .form-password-label {
            width: 40%;
            text-align: right;
            margin-right: 250px;
        }

        .form-password-input {
            width: 65%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            color: #000000;
        }

        .submit-button {
            width: 105%;
            text-align: center;
            margin-top: 30px;
        }

        button {
            width: 10%;
            padding: 10px;
            font-size: 18px;
            background-color: #ED9E04;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #FFAA04;
        }
        p {
            color: #fff;
            text-align: center;
            margin-top: 30px;
            width: 100%;
        }

        p a {
            color: #fff;
            text-decoration: underline;
        }

        p a:hover {
            color: #ffd700;
        }

        @media only screen and (max-width: 768px) {
            .form-label, .form-input, .form-select, .form-password-label, .form-password-input {
                width: 100%;
                margin: 0;
            }
            
            .form-password-label {
                margin-right: 0;
            }
            .submit-button {
                width: 100%;
                text-align: center;
                margin-top: 20px; 
            }

            button {
                width: 100%; 
            }

            p {
                width: 100%; 
                margin-top: 10px; 
            }
        }
        
    </style>
</head>
<body>
    <form action="simpan_data.php" method="post">
        <div class="container">
            <div class="form-container">
            <div class="form-title">FORM PENDAFTARAN PENDUDUK</div>
                <form action="submit.php" method="post">
                    <div class="form-group">
                        <div class="form-label">NIK:</div>
                        <input type="text" class="form-input" name="nik" pattern="\d{16}" title="NIK harus terdiri dari 16 angka" required>
                    </div>
                    <div class="form-group">
                        <div class="form-label">Nama Lengkap:</div>
                        <input type="text" class="form-input" name="nama" required>
                    </div>
                    <div class="form-group">
                        <div class="form-label">Jenis Kelamin:</div>
                        <select class="form-select" name="jenis_kelamin" required>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="form-label">No Whatsapp:</div>
                        <input type="tel" class="form-input" name="whatsapp" pattern="\d+" title="No Whatsapp harus berupa angka" required>
                    </div>
                    <div class="form-group">
                        <div class="form-label">Tempat Lahir:</div>
                        <input type="text" class="form-input" name="tempat_lahir" required>
                    </div>
                    <div class="form-group">
                        <div class="form-label">Tanggal Lahir:</div>
                        <input type="date" class="form-input" name="tanggal_lahir" required>
                    </div>
                    <div class="form-group">
                        <div class="form-label">Kewarganegaraan:</div>
                        <input type="text" class="form-input" name="kewarganegaraan" required>
                    </div>
                    <div class="form-group">
                        <div class="form-label">Agama:</div>
                        <select class="form-select" name="agama" required>
                            <option value="Islam">Islam</option>
                            <option value="Kristen">Kristen</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Buddha">Buddha</option>
                            <option value="Konghucu">Konghucu</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="form-label">Status Perkawinan:</div>
                        <select class="form-select" name="status_perkawinan" required>
                            <option value="Belum Menikah">Belum Menikah</option>
                            <option value="Menikah">Sudah Menikah</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="form-label">Pekerjaan:</div>
                        <input type="text" class="form-input" name="pekerjaan" required>
                    </div>
                    <div class="form-group">
                        <div class="form-label">Alamat:</div>
                        <input type="text" class="form-input" name="alamat" required>
                    </div>
                    <div class="form-group">
                        <div class="form-label">RT:</div>
                        <input type="text" class="form-input" name="rt" required>
                    </div>
                    <div class="form-group">
                        <div class="form-label">RW:</div>
                        <input type="text" class="form-input" name="rw" required>
                    </div>
                     <div class="form-group">
                        <div class="form-label">Kecamatan:</div>
                        <select class="form-select" name="kecamatan" required>
                            <option value="Lajang">Sei Beduk</option>
                        </select>
                    </div>
                     <div class="form-group">
                        <div class="form-label">Kelurahan:</div>
                        <select class="form-select" name="kelurahan" required>
                            <option value="Duriangkang">Duriangkang</option>
                            <option value="Mangsang">Mangsang</option>
                            <option value="Piayu">Piayu</option>
                            <option value="Muka Kuning">Muka Kuning</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="form-label">Username:</div>
                        <input type="text" class="form-input" name="username" required>
                    </div>
                    <div class="form-group">
                        <div class="form-password-label">Kata Sandi:</div>
                        <input type="password" class="form-password-input" name="password" required>
                    </div>
                    <div class="submit-button">
                        <button type="submit">Daftar</button>
                    </div>
                    <p>Sudah punya akun? <a href=index.php>login sekarang</a></p>
                </form>
            </div>
        </div>
    </form>
</body>
</html>

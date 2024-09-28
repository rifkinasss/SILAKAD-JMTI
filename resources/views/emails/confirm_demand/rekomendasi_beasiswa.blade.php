<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekomendasi Beasiswa</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            margin: 20px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
        }

        .header {
            text-align: center;
            padding: 20px 0;
            border-bottom: 1px solid #ddd;
        }

        .header-content {
            text-align: center;
            padding-top: 10px;
        }

        .header img {
            max-width: 100px;
        }

        .header h3,
        .header h5 {
            margin: 5px 0;
            font-weight: 700;
        }

        .content h1 {
            color: #333;
            font-size: 24px;
            margin-top: 0;
        }

        .content p {
            color: #555;
            font-size: 12px;
            text-align: center;
        }

        .content .title-wrapper {
            text-align: center;
            margin: 20px 0;
        }

        .content .title-wrapper strong {
            display: inline-block;
            padding: 10px;
            font-size: 18px;
            background-color: #f4f4f4;
            border-radius: 5px;
            text-align: center;
            color: #333;
        }

        .content table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .content table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .content table td:nth-child(odd) {
            background-color: #f4f4f4;
            font-weight: 700;
        }

        .footer {
            border-top: 1px solid #ddd;
            text-align: center;
            font-size: 10px;
            color: #9a9ea6;
            padding: 10px 0;
        }

        .button {
            display: inline-block;
            padding: 12px 24px;
            font-size: 16px;
            font-weight: bold;
            color: #fff;
            background-color: #0867ec;
            border: none;
            border-radius: 4px;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
            margin-top: 20px;
        }

        .button:hover {
            background-color: #065bb5;
            transform: translateY(-2px);
        }

        .button:active {
            background-color: #054a9b;
            transform: translateY(1px);
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h3>Sistem Informasi Layanan Akademik</h3>
            <h5>Jurusan Matematika dan Teknologi Informasi</h5>
            <h5>Institut Teknologi Kalimantan</h5>
        </div>
        <div class="content">
            <div class="header-content">
                <h2>Rekomendasi Beasiswa</h2>
            </div>
            <p>
                Mahasiswa <b>{{ $rekomendasibeasiswa->user->nama_lengkap }}</b> telah mengajukan rekomendasi beasiswa
                dengan detail sebagai berikut :
            </p>
            <table style="width: 100%; border-collapse: collapse; margin: 20px 0;">
                <tbody>
                    <tr>
                        <td style="padding: 10px; text-align: left; font-weight: bold;">Nama Lengkap</td>
                        <td style="padding: 10px; text-align: left;">{{ $rekomendasibeasiswa->user->nama_lengkap }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 10px; text-align: left; font-weight: bold;">NIM</td>
                        <td style="padding: 10px; text-align: left;">{{ $rekomendasibeasiswa->user->nim }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 10px; text-align: left; font-weight: bold;">Semester</td>
                        <td style="padding: 10px; text-align: left;">{{ $rekomendasibeasiswa->user->semester }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 10px; text-align: left; font-weight: bold;">Program Studi</td>
                        <td style="padding: 10px; text-align: left;">{{ $rekomendasibeasiswa->user->program_studi }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 10px; text-align: left; font-weight: bold;">IPK</td>
                        <td style="padding: 10px; text-align: left;">{{ $rekomendasibeasiswa->user->ipk }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 10px; text-align: left; font-weight: bold;">SKS Tempuh</td>
                        <td style="padding: 10px; text-align: left;">{{ $rekomendasibeasiswa->user->sks_tempuh }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 10px; text-align: left; font-weight: bold;">Nama Program</td>
                        <td style="padding: 10px; text-align: left;">{{ $rekomendasibeasiswa->nama_program }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 10px; text-align: left; font-weight: bold;">Nama Instansi</td>
                        <td style="padding: 10px; text-align: left;">{{ $rekomendasibeasiswa->nama_perusahaan }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 10px; text-align: left; font-weight: bold;">Alamat Instansi</td>
                        <td style="padding: 10px; text-align: left;">{{ $rekomendasibeasiswa->alamat_perusahaan }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="footer">
            <p>Ini adalah email otomatis. Mohon untuk tidak membalas email ini.</p>
            <p>Jl. Soekarno Hatta No.KM 15, Karang Joang, Kec. Balikpapan Utara, Kota
                Balikpapan, Kalimantan Timur 76127</p>
            <p>Institut Teknologi Kalimantan.
                <br>
                Jurusan Matematika dan Teknologi Informasi
                <br>
                Sistem Informasi Layanan Akademik
            </p>
            <p>SILAKAD JMTI &copy; 2024. All Right Reserved.</p>
        </div>
    </div>
</body>

</html>

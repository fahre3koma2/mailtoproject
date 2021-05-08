<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Isi Pesan</title>
</head>
<body>
   <h3> Pernyataan Kepatuhan </h3>

    Yang bertanda tangan di bawah ini :<br/>

        <table class="table table-nbordered">
            <tbody>
            <tr>
                <td style="width:45%"><h4>Nama</h4></td>
                <td style="width:5%"><h4>:</h4></td>
                <td style="width:50%"><h4>{{ $biodata->user->name }}</h4></td>
            </tr>
            <tr>
                <td><h4>Nomor Ponsel</h4></td>
                <td><h4>:</h4></td>
                <td><h4>{{ $biodata->nohp }}</h4></td>
            </tr>
            <tr>
                <td><h4>Jabatan</h4></td>
                <td><h4>:</h4></td>
                <td><h4>{{ $biodata->jabatan }}</h4></td>
            </tr>
            <tr>
                <td><h4>Unit/ Penugasan</h4></td>
                <td><h4>:</h4></td>
                <td><h4>{{ $biodata->unit }}</h4></td>
            </tr>
            <tr>
                <td><h4>Alamat</h4></td>
                <td><h4>:</h4></td>
                <td><h4>{{ $biodata->alamat }}</h4></td>
            </tr>
            </tbody>
        </table><br/><br/>
    Menyatakan Bahwa :
    1. Saya Telah memahami
    Yang membuat pernyataan,<br/>
    <a href="{{ route('verifikasi', ['id' => encrypt($biodata->id)]) }}" style="background-color:#1da546;border:1px solid #1da546;color:#fff;padding:4px 8px;text-decoration:none" target="_blank">Verifikasi
    Email</a>

    <br/>
        <h4>Perhatian : </h4>
        Untuk mengunduh pedoman  <a href="{{ url('upload/Pedoman Email Coba Unduh.pdf') }}"  target="_blank"> Klik Disini </a>
    <br/>
</body>
</html>

@extends('dashboard.layouts.main')
@section('container')


<form method="POST" action="{{url('pegawai')}}">
    @csrf

    nama : <input type="text" name="nama"> <br />
    tanggal Lahir : <input type="date" name="tgl_lahir"><br />
    nip : <input type="text" name="nip"><br />
    <button class="btn btn-success" type="submit">Simpan</button>
</form>
@endsection

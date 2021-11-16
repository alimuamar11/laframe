@extends('dashboard.layouts.main')
@section('container')


<form method="POST" action="{{url('pegawai/'.$model->id)}}">
    @csrf

    <input type="hidden" name="_method" value="PUT">
    nama : <input type="text" name="nama" value="{{$model->nama}}"> <br />
    tanggal Lahir : <input type="date" name="tgl_lahir" value="{{$model->tgl_lahir}}"><br />
    nip : <input type="text" name="nip" value="{{$model->nip}}"><br />
    <button class="btn btn-success" type="submit">Simpan</button>
</form>
@endsection

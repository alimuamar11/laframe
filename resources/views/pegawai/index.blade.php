@extends('home.index')
@section('content')

<br />
<a class="btn btn-primary" href="{{ url('pegawai/create')}}">Tambah</a>
<table class="table-bordered table">
    <tr>
        <th>Nama</th>
        <th>Tanggal Lahir</th>
        <th>NIP</th>
        <th colspan="2">Aksi</th>
    </tr>
    @foreach($datas as $key=>$value)
    <tr>
        <td>{{ $value-> nama}}</td>
        <td>{{ $value-> tgl_lahir}}</td>
        <td>{{ $value-> nip}}</td>
        <td><a class="btn btn-info" href="{{ url('pegawai/'.$value->id.'/edit') }}"> Update</a></td>
        <td>
            <form action="{{ url('pegawai/'.$value->id)}}" method="POST">
                @csrf
                <input type="hidden" name="_method" value="DELETE">
                <button class="btn btn-danger" type="submit">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

@endsection

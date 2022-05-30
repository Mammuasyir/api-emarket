@extends('template')

@section('content')


<div class="container pt-4">
    <div class="col-lg-12 d-flex justify-content-between">
        <h3>Produk<h3>
                <div class="">
                    <a href="{{route('produk.create')}}" class="btn btn-primary">Create</a>
                </div>
    </div>
</div>

@if($message = Session::get('success'))
<div class="alert alert-success" role="alert">
    {{$message}}
</div>
@endif

<!-- Table -->
<table class="container table table-bordered mt-4">
    <tr>
        <th width="30px" class="text-center">No</th>
        <th>Nama Produk</th>
        <th width="270px" class="text-center">Harga</th>
        <th width="270px" class="text-center">Deskripsi</th>
        <th width="270px" class="text-center">Gambar</th>

    </tr>
    @foreach($produk as $pro)
    <tr>
        <td width="30px" class="text-center">{{$i++}}</td>
        <td>{{$pro->nama}}</td>
        <td>{{$pro->harga}}</td>
        <td>{{$pro->deskripsi}}</td>
        <td><img src="{{url('/storage', $pro->image)}}" style="max-width: 100px;" class="img-thumbnail" alt=""></td>
        <td width="270px" class="text-center">

            <form action="{{route('produk.destroy', $pro->id) }}" method="POST">

                <a href="{{route('produk.edit', $pro->id) }}" class="btn btn-warning">edit</a>

                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Serius ya?')">Delete</button>
            </form>

        </td>
    </tr>
    @endforeach
</table>

@endsection
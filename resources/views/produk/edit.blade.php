@extends('template')
@section('content')

<div class="container pt-4">
    <div class="col-lg-12 d-flex justify-content-between">
        <h3>Produk<h3>
                <div class="">
                    <a href="{{route('produk.index')}}" class="btn btn-dark">Back</a>
                </div>
    </div>
</div>

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{route('produk.update', $produk->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="nama" class="form-label">Nama Produk</label>
        <input name="nama" value="{{$produk->nama}}" class="form-control" id="nama">
    </div>

    <div class="mb-3">
        <label for="harga" class="form-label">Harga</label>
        <input name="harga" value="{{$produk->harga}}" class="form-control" id="harga">
    </div>

    <div class="mb-3">
        <label for="deskripsi" class="form-label">Deskripsi</label>
        <!-- <input type="password" class="form-control" id="exampleInputPassword1"> -->
        <textarea name="deskripsi" id="deskripsi" class="form-control" style="height: 80px;">{{$produk->deskripsi}}</textarea>
    </div>

    <div class="mb-3">
        <div class="col-lg-3 col-md-3 col-sm-4 text-right">
            <label>image</label>
        </div>
        <div class="col-lg-4 col-md-9 col-sm-8">
            <input type="file" name="image">
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection
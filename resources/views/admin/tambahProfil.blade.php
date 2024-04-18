@extends('asset.tampilan')

@section('konten')
    <form action='{{ url('admin/' . $data->id . '/tambahProfil') }}' method='post'>
        @csrf
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <a href="{{ url('admin') }}" class="btn btn-primary">Kembali</a>
            <div class="mb-3 row">
                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name='nama' id="nama" value="{{ old('nama') }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="umur" class="col-sm-2 col-form-label">Umur</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name='umur' id="umur" value="{{ old('umur') }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name='alamat' id="alamat" value="{{ old('alamat') }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="pekerjaan" class="col-sm-2 col-form-label">Pekerjaan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name='pekerjaan' id="pekerjaan"
                        value="{{ old('pekerjaan') }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="bio" class="col-sm-2 col-form-label">Biodata</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name='bio' id="bio" value="{{ old('bio') }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="skill" class="col-sm-2 col-form-label">Skill</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name='skill' id="skill" value="{{ old('skill') }}">
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">SIMPAN</button></div>
            </div>
    </form>
    </div>
@endsection

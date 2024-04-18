@extends('asset.tampilan')

@section('konten')
    <form action='{{ url('user/' . $data->id) }}' method='post'>
        @csrf
        @method('PUT')
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <a href="{{ url('user') }}" class="btn btn-primary">Kembali</a>
            <div class="mb-3 row">
                <label for="name" class="col-sm-2 col-form-label">ID</label>
                <div class="col-sm-10">
                    {{ $data->id }}
                </div>
            </div>
            <div class="mb-3 row">
                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name='nama' id="nama" value="{{ $data->nama }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="umur" class="col-sm-2 col-form-label">Umur</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name='umur' id="umur" value="{{ $data->umur }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name='alamat' id="alamat" value="{{ $data->alamat }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="pekerjaan" class="col-sm-2 col-form-label">Pekerjaan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name='pekerjaan' id="pekerjaan"
                        value="{{ $data->pekerjaan }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="bio" class="col-sm-2 col-form-label">Bio</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name='bio' id="bio" value="{{ $data->bio }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="skill" class="col-sm-2 col-form-label">Skill</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name='skill' id="skill" value="{{ $data->skill }}">
                </div>
            </div>

            <div class="mb-3 row">
                <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">SIMPAN</button></div>
            </div>
    </form>
    </div>
@endsection

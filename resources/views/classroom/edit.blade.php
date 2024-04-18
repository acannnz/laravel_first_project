@extends('asset.tampilan')

@section('konten')
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <div class="pb-3">
            <h2>Edit Tugas</h2>
        </div>
        <form action='{{ url('classroom/' . $data->id) }}' method='post'>
            @csrf
            @method('PUT')
            <div class="my-3 p-3 bg-body rounded shadow-sm">
                <div class="mb-3 row">
                    <label for="pelajaran" class="col-sm-2 col-form-label">Mata kuliah</label>
                    <div class="col-sm-10">
                        {{ $data->pelajaran }}
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="judul" class="col-sm-2 col-form-label">Judul Tugas</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='judul' id="judul"
                            value="{{ $data->judul }}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi Tugas</label>
                    <div class="col-sm-10">
                        <textarea type="text" class="form-control" name='deskripsi' id="deskripsi">{{ $data->deskripsi }}</textarea>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary" name="submit">SIMPAN</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@extends('asset.tampilanUser')

@section('konten')
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <div class="pb-3">
            <h2>Form Jawab Tugas</h2>
        </div>
        <form action='{{ url('userClassroom/' . $data->id . '/formJawaban') }}'enctype="multipart/form-data" method='post'>
            @csrf
            <div class="my-3 p-3 bg-body rounded shadow-sm">
                <div class="mb-3 row">
                    <label for="pelajaran" class="col-sm-2 col-form-label">Mata kuliah</label>
                    <div class="col-sm-10 py-2">
                        {{ $data->mataKuliah->pelajaran }}
                        <input type="text" name="matkul" value="{{ $data->mataKuliah->id }}" hidden>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="judul" class="col-sm-2 col-form-label">Judul Tugas</label>
                    <div class="col-sm-10 py-2">
                        {{ $data->judul }}
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="judul" class="col-sm-2 col-form-label">Deskripsi Tugas</label>
                    <div class="col-sm-10 py-2">
                        {{ $data->deskripsi }}
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="deskripsi" class="col-sm-2 col-form-label">Jawaban</label>
                    <div class="col-sm-10">
                        <textarea type="text" class="form-control" name='jawaban' id="jawaban">{{ old('jawaban') }}</textarea>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="file" class="col-sm-2 col-form-label">File</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" name="upload_file" id="upload_file"
                            accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
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

@extends('asset.tampilan')

@section('konten')
    <form action='{{ url('classroom') }}' method='post'>
        @csrf
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <div class="mb-3 row">
                <label for="pelajaran" class="col-sm-2 col-form-label">Mata Kuliah</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name='pelajaran' id="pelajaran">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="role" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">SIMPAN</button></div>
            </div>
    </form>
    </div>
@endsection

@extends('asset.tampilanUser')
@section('konten')
    <form enctype="multipart/form-data" method='post'>
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <div class="row col-12">
                <div class="col-10">
                    <h2>Daftar Tugas</h2>
                </div>
            </div>
            <table class="table table-striped">
                @csrf
                <thead>
                    <tr>
                        <th class="col-md-2">Mata Kuliah</th>
                        <th class="col-md-2">Judul Tugas</th>
                        <th class="col-md-6">Jawaban</th>
                        <th class="col-md-2">Upload</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($data as $item)
                        @if ($item->user_id == auth()->id())
                            <tr>
                                <td>{{ $item->mataKuliah->pelajaran }}</td>
                                <td>{{ $item->tugas->judul }}</td>
                                <td>{{ $item->jawaban }}</td>
                                <td>
                                    <a class="btn btn-primary btn-sm"
                                        href="{{ url('userClassroom/' . $item->id . '/tampilanJawabanFile') }}">Periksa
                                        File</a>
                                </td>
                                <td>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </form>
@endsection

@extends('asset.tampilanUser')

@section('konten')
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <div class="row col-12">

            <div class="col-10">
                <h2>Daftar Tugas</h2>
            </div>
            <div class="col-sm-6 py-2">
                <a href="{{ url('userClassroom/tampilanJawaban') }}" class="btn btn-success    items-center">
                    <h5 class="mb-0" style="text-align: center">
                        Lihat Daftar Jawaban
                    </h5>
                </a>
            </div>
        </div>
        <table class="table table-striped">
            @csrf
            <thead>
                <tr>
                    <th class="col-md-2">Mata Kuliah</th>
                    <th class="col-md-2">Judul Tugas</th>
                    <th class="col-md-6">Deskripsi Tugas</th>
                    <th class="col-md-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $item->mataKuliah->pelajaran }}</td>
                        <td>{{ $item->judul }}</td>
                        <td>{{ $item->deskripsi }}</td>
                        <td>
                            <a class="btn btn-primary btn-sm"
                                href="{{ url('userClassroom/' . $item->id . '/formJawaban') }}">Input Jawaban</a>

                        </td>
                        <td>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

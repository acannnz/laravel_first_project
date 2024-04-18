@extends('asset.tampilan')

@section('konten')
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <div class="pb-3">
            <h2>Daftar Jawaban dari Siswa</h2>
        </div>
        <table class="table table-striped">
            @csrf
            <thead>
                <tr>
                    <th class="col-md-4">Nama Siswa</th>
                    <th class="col-md-4">Jawaban</th>
                    <th class="col-md-4">File</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $item->user->name }}</td>
                        <td>{{ $item->jawaban }}</td>
                        <td>
                            <a class="btn btn-primary btn-sm"
                                href="{{ url('classroom/' . $item->id . '/tampilanJawabanFile') }}">Cek File</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

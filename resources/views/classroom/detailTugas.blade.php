@extends('asset.tampilan')

@section('konten')
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <div class="pb-3">
            <a href='{{ url('classroom/' . $id . '/tambahTugas') }}' class="btn btn-primary">Tambah Tugas</a>
        </div>
        <div class="row col-12">
            <h2 class="col-10">Daftar Tugas</h2>

            <div class="col-2 justify-content-end align-items-end">
                <div>
                    <form class="row-form" action="{{ url()->current() }}" method="GET">
                        <select name="row" class="custom-select" onchange="this.form.submit()">
                            <option disabled selected>Tampilkan Data</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="4">4</option>
                        </select>
                    </form>
                </div>
            </div>

        </div>
        <table class="table table-striped">
            @csrf
            <thead>
                <tr>
                    <th class="col-md-4">Mata Kuliah</th>
                    <th class="col-md-4">Judul Tugas</th>
                    <th class="col-md-2">Deskripsi Tugas</th>
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
                            <a class="btn btn-success btn-sm"
                                href="{{ url('classroom/' . $item->id . '/tampilanJawaban') }}">Cek</a>
                            <a class="btn btn-success btn-sm" href="{{ url('classroom/' . $item->id . '/edit') }}">Edit</a>
                        </td>
                        <td>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- pagination --}}
        <ul class="btn-group pagination pagination-sm justify-content-md-end">
            <li class="page-item {{ $data->onFirstPage() ? 'disabled' : '' }}">
                <a href="{{ $data->previousPageUrl() }}{{ strpos($data->previousPageUrl(), '?') !== false ? '&' : '?' }}row={{ request()->input('row', 1) }}"
                    class="page-link">Previous</a>
            </li>
            @for ($i = 1; $i <= $data->lastPage(); $i++)
                <li class="page-item {{ $i == $data->currentPage() ? 'active' : '' }}">
                    <a href="{{ $data->url($i) }}{{ strpos($data->url($i), '?') !== false ? '&' : '?' }}row={{ request()->input('row', 1) }}"
                        class="page-link">{{ $i }}</a>
                </li>
            @endfor
            <li class="page-item {{ $data->hasMorePages() ? '' : 'disabled' }}">
                <a href="{{ $data->nextPageUrl() }}{{ strpos($data->nextPageUrl(), '?') !== false ? '&' : '?' }}row={{ request()->input('row', 1) }}"
                    class="page-link">Next</a>
            </li>
        </ul>
    </div>
    </div>
@endsection

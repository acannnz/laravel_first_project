@extends('asset.tampilan')
@section('tugas')
    <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ url('classroom') }}" class="nav-link">Classroom</a>
    </li>
@endsection
@section('konten')
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <!-- FORM PENCARIAN -->
        <div class="pb-3">
            <form class="d-flex" action="{{ url('/admin') }}" method="get">
                <input type="hidden" name="page" value="{{ $data->currentPage() }}">
                <input type="hidden" name="row" value="{{ request()->input('row') }}">
                <input class="form-control me-1" type="search" name="search" value="{{ Request::get('search') }}"
                    placeholder="Masukkan Nama" aria-label="Search">
                <button class="btn btn-secondary" type="submit">Cari</button>
            </form>
        </div>

        <!-- TOMBOL TAMBAH DATA -->
        <div class="row pb-3 col-12">
            <div class="col 10">
                <a href='{{ url('admin/create') }}' class="btn btn-primary">Tambah User</a>
            </div>
            <div class="col-2 justify-content-end align-items-end">
                <div>
                    <form class="row-form" action="{{ url('/admin') }}" method="GET">
                        <input type="hidden" name="page" value="{{ $data->currentPage() }}">
                        <input type="hidden" name="search" value="{{ request()->input('search') }}">
                        <select name="row" class="custom-select" onchange="this.form.submit()">
                            <option disabled selected>Tampilkan Data</option>
                            <option value="1" {{ request()->input('row', 10) == 1 ? 'selected' : '' }}>1</option>
                            <option value="2" {{ request()->input('row', 10) == 2 ? 'selected' : '' }}>2</option>
                            <option value="4" {{ request()->input('row', 10) == 4 ? 'selected' : '' }}>4</option>
                        </select>
                    </form>
                </div>
            </div>
        </div>
        @csrf
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="col-md-1">No</th>
                    <th class="col-md-3">Nama</th>
                    <th class="col-md-4">Email</th>
                    <th class="col-md-2">Role</th>
                    <th class="col-md-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = $data->firstItem();
                @endphp
                @foreach ($data as $item)
                    @if ($item->role == 'user')
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->role }}</td>
                            <td>
                                <a href='{{ url('admin/' . $item->id . '/edit') }}' class="btn btn-warning btn-sm">Edit</a>
                                <form onsubmit="return confirm('Yakin akan menghapus data?')" class='d-inline'
                                    action="{{ url('admin/' . $item->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" name="submit" class="btn btn-danger btn-sm">Del</button>
                                </form>
                                <a href='{{ url('admin/' . $item->id . '/tambahProfil') }}'
                                    class="btn btn-success btn-sm">Profil</a>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    @endif
                @endforeach
            </tbody>
        </table>
        {{-- pagination --}}
        <ul class="pagination pagination-sm justify-content-end align-items-end">
            <li class="page-item {{ $data->onFirstPage() ? 'disabled' : '' }}">
                <a href="{{ $data->previousPageUrl() }}{{ strpos($data->previousPageUrl(), '?') !== false ? '&' : '?' }}row={{ request()->input('row', 1) }}&search={{ request()->input('search') }}"
                    class="page-link">Previous</a>
            </li>
            @for ($i = 1; $i <= $data->lastPage(); $i++)
                <li class="page-item {{ $i == $data->currentPage() ? 'active' : '' }}">
                    <a href="{{ $data->url($i) }}{{ strpos($data->url($i), '?') !== false ? '&' : '?' }}row={{ request()->input('row', 1) }}&search={{ request()->input('search') }}"
                        class="page-link">{{ $i }}</a>
                </li>
            @endfor
            <li class="page-item {{ $data->hasMorePages() ? '' : 'disabled' }}">
                <a href="{{ $data->nextPageUrl() }}{{ strpos($data->nextPageUrl(), '?') !== false ? '&' : '?' }}row={{ request()->input('row', 1) }}&search={{ request()->input('search') }}"
                    class="page-link">Next</a>
            </li>
        </ul>
    </div>
@endsection

@extends('asset.tampilan')

@section('konten')
    <div class="my-3 p-3 bg-body rounded shadow-sm">

        <!-- TOMBOL TAMBAH DATA -->
        <div class="pb-3">
            <a href='{{ url('classroom/create') }}' class="btn btn-primary">Tambah Mata Kuliah</a>
        </div>
        @csrf
        <table id="myTable" class="table table-striped">
            <thead>
                <tr>
                    <th class="col-md-6">Mata Kuliah</th>
                    <th class="col-md-4">Jumlah Tugas</th>
                    <th class="col-md-2 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = $data->firstItem(); ?>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $item->pelajaran }} </td>
                        <td>{{ $item->tugas_count }} tugas</td>
                        <td>
                            <a href='{{ url('classroom/' . $item->id . '/detailTugas') }}'
                                class="btn btn-success btn-sm">Detail</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
@section('script')
    <script src="{{ asset('AdminLTE') }}/plugins/jquery/jquery.min.js"></script>
    <script src="//cdn.datatables.net/2.0.5/js/dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
@endsection

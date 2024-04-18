@extends('asset.tampilanUser')
@section('konten')

    <body>
        <h1>KARTU PROFIL</h1>
        <section class="content">
            @csrf
            <div class="card card-solid">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="col-12">
                                <img src="{{ asset('image') }}/profil.png" class="product-image" alt="Product Image">
                            </div>
                        </div>
                        @csrf
                        @if ($data)
                            @foreach ($data as $item)
                                <div class="col-12 col-sm-6">
                                    <h3 class="my-1">{{ $item->nama }}</h3>
                                    <p>
                                        Umur : {{ $item->umur }}
                                    </p>
                                    <p>
                                        alamat : {{ $item->alamat }}
                                    </p>
                                    <p>
                                        pekerjaan : {{ $item->pekerjaan }}
                                    </p>
                                    <hr>
                                    <h4>BIO</h4>
                                    <div class=" " data-toggle="">
                                        <p>{{ $item->bio }}</p>
                                    </div>
                                    <h4 class="mt-3">Skill Yang Dimiliki :</h4>
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="text-center">
                                            {{ $item->skill }}
                                        </label>
                                    </div>
                                    @csrf
                                    <div class="col-sm-6">
                                        <a href="{{ url('user/' . $item->id . '/edit') }}"
                                            class="btn btn-primary py-3 px-3 mt-4 items-center">
                                            <h5 class="mb-0" style="text-align: center">
                                                UPDATE PROFIL
                                            </h5>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </body>
@endsection

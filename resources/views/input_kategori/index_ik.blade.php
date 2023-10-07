@extends('template.master_template')

@section('isi')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    Tambah Data
                </div>
                <div class="card-tools">
                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-tambah-data">+
                        Data
                        baru</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Default box -->
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Pemasukan</h3>
                    </div>
                    <div class="card-body table-responsive p-0" style="height: 300px;">
                        <table class="table table-bordered" style="text-align: center">
                            <thead>
                                <tr>
                                    <th style="width:60%;">Kategori</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($modelPemasukan as $row)
                                    <tr>
                                        <td>{{ $row->nama_kategori }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-danger" onclick="hapusKategori({{$row->kategori_id}})">Delete</button>
                                            <button class="btn btn-sm btn-warning" onclick="editPemasukan({{ $row->kategori_id }}, '{{$row->nama_kategori}}')">Edit</button>
                                        </td>
                                    </tr>
                                @empty
                                    <td colspan="2">Tidak ada data</td>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Pengeluaran</h3>
                    </div>
                    <div class="card-body table-responsive p-0" style="height: 300px;">
                        <table class="table table-bordered" style="text-align: center">
                            <thead>
                                <tr>
                                    <th style="width:60%">Kategori</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($modelPengeluaran as $row)
                                    <tr>
                                        <td>{{ $row->nama_kategori }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-danger" onclick="hapusKategori({{$row->kategori_id}})">Delete</button>
                                            {{-- <a href="{{ url('/deleteKategori/' . $row->kategori_id)}}" class="btn btn-sm btn-danger"></a> --}}
                                            <button class="btn btn-sm btn-warning" onclick="editPengeluaran({{ $row->kategori_id }}, '{{$row->nama_kategori}}')">Edit</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2">Tidak ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
        <!-- /.card -->
    </div>
    @include('input_kategori.modals_input_ik')
@endsection

@section('js')
    <script>
        function editPemasukan(kategori_id, nama_kategori) {
            // console.log(kategori_id)
            // console.log(nama_kategori)
            $('#kategori_id_pemasukan').val(kategori_id)
            $('#nama_kategori_pemasukan').val(nama_kategori)
            $('#modal-ubah-data-pemasukan').modal()
        }
        function editPengeluaran(kategori_id, nama_kategori){
            $('#kategori_id_pengeluaran').val(kategori_id)
            $('#nama_kategori_pengeluaran').val(nama_kategori)
            $('#modal-ubah-data-pengeluaran').modal()
        }

        function hapusKategori(kategori_id) {
            if (confirm('Apakah Yakin data ini akan dihapus ?')) {
                location.href = "{{ url('/deleteKategori') }}/" + kategori_id;
            }
        }
    </script>

    @if (!empty(session('sukses')))
        <script>
            var msg = '<?= session('sukses') ?>'
            toastr.success(msg)
        </script>
    @endif
@endsection

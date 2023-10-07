@php
    use App\Models\Kategori;
@endphp

@extends('template.master_template')

@section('isi')
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <form action="" method="GET" id="pencarian_tanggal">
                <div class="row">
                    <div class="d-inline col-sm-6">
                        <label for="tgl_awal">Tanggal Awal</label>
                        <input type="date" id="tgl_awal" name="tgl_awal" value="{{ $tgl_awal }}">
                    </div>
                    <div class="d-inline col-sm-6">
                        <label for="tgl_akhir">Tanggal Akhir</label>
                        <input type="date" id="tgl_akhir" name="tgl_akhir" value="{{ $tgl_akhir }}">
                    </div>
                </div>
            </form>
        </div>
        <div class="card-header">
            <h3 class="card-title">Pemasukan</h3>
            <div class="card-tools">
                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-tambah-data">+ Data
                    baru</button>
            </div>
        </div>

        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="table table-head-fixed text-nowrap" style="text-align:center">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Kategori</th>
                        <th>Keterangan</th>
                        <th>Nominal</th>
                        <th style="width: 15%">Hapus</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($model as $rowPemasukan)
                        <tr>
                            <td>{{ date('d-m-Y', strtotime($rowPemasukan->tanggal))}}</td>
                            <td>{{ Kategori::where('kategori_id', $rowPemasukan->kategori_id)->first()->nama_kategori }}</td>
                            <td>{{ $rowPemasukan->keterangan}}</td>
                            <td>{{ "Rp " . number_format($rowPemasukan->nominal,0,',','.') . ",-"}}</td>
                            <td>
                                <button class="btn btn-sm btn-danger" onclick="hapusPemasukan({{$rowPemasukan->pemasukan_id}})">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center">Tidak ada data</td>
                        </tr>
                    @endforelse
                    <tr>
                        <td colspan="3" style="text-align: right">Total</td>
                        <td>{{"Rp " . number_format($total,0,',','.') . ",-"}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    {{-- modals --}}
    <div class="modal fade" id="modal-tambah-data">
        <form action="{{ url('/simpanPemasukan') }}" method="POST">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Transaksi Yuk!</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Tambah Transaksi Pemasukan</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="tanggal">Tanggal</label>
                                    <input type="date" class="form-control" name="tanggal" id="tanggal"
                                        value="{{ date('Y-m-d') }}">
                                    <label for="kategori_id">Kategori Pemasukan</label>
                                    <select class="form-control" name="kategori_id" id="kategori_id">
                                        @forelse ($modelPemasukan as $row)
                                            <option value="{{ $row->kategori_id }}">{{ $row->nama_kategori }}</option>
                                        @empty
                                            <option value="">Tidak ada data</option>
                                        @endforelse
                                    </select>
                                    <label for="nominal">Nominal</label>
                                    <input type="number" class="form-control" name="nominal" id="nominal" required>
                                    <label for="keterangan">Keterangan</label>
                                    <input type="text" class="form-control" name="keterangan" id="keterangan">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-id="1" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" data-id="2">Save changes</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('js')
    @if (!empty(session('sukses')))
        <script>
            var msg = '<?= session('sukses') ?>'
            toastr.success(msg)
        </script>
    @endif

    <script>
        function hapusPemasukan(pemasukan_id) {
            if (confirm('Apakah Yakin data ini akan dihapus ?')) {
                location.href = "{{ url('/deletePemasukan') }}/" + pemasukan_id;
            }
        }

        $('#tgl_awal').change(function() {
            $('#pencarian_tanggal').submit()
        })
        $('#tgl_akhir').change(function() {
            $('#pencarian_tanggal').submit()
        })
    </script>
@endsection

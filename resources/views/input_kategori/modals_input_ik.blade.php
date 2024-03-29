<div class="modal fade" id="modal-tambah-data">
    <form action="{{ url('/simpanKategori') }}" method="POST">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Kategori Yuk!</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Tambah Data Kategori</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->

                        <div class="card-body">
                            <div class="form-group">
                                <input type="hidden">
                                <label for="nama_kategori">Nama Kategori</label>
                                <input type="text" class="form-control" id="nama_kategori" name="nama_kategori"
                                    placeholder="Masukkan nama kategori" required>
                            </div>
                            <div class="form-group">
                                <label for="jenis_kategori">Pilih Jenis Kategori</label>
                                <select class="form-control" id="jenis_kategori" name="jenis_kategori">
                                    <option value="pemasukan">Pemasukan</option>
                                    <option value="pengeluaran">Pengeluaran</option>
                                </select>
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

<div class="modal fade" id="modal-ubah-data-pemasukan">
    <form action="{{ url('/ubahKategori') }}" method="POST">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ubah Data Kategori</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Pemasukan</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->

                        <div class="card-body">
                            <div class="form-group">
                                <input type="hidden">
                                <label for="nama_kategori_pemasukan">Nama Kategori</label>
                                <input type="hidden" name="kategori_id" id="kategori_id_pemasukan">
                                <input type="text" class="form-control" name="nama_kategori" id="nama_kategori_pemasukan"
                                    placeholder="Masukkan nama kategori">
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

<div class="modal fade" id="modal-ubah-data-pengeluaran">
    <form action="{{ url('/ubahKategori') }}" method="POST">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ubah Data Kategori</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Pengeluaran</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->

                        <div class="card-body">
                            <div class="form-group">
                                <input type="hidden">
                                <label for="nama_kategori_pengeluaran">Nama Kategori</label>
                                <input type="hidden" name="kategori_id" id="kategori_id_pengeluaran">
                                <input type="text" class="form-control" name="nama_kategori" id="nama_kategori_pengeluaran"
                                    placeholder="Masukkan nama kategori">
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

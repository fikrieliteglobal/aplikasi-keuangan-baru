@extends('template.master_template')

@section('isi')
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Input Kategori</h3>
            <div class="card-tools">
                <button class="btn btn-primary btn-sm">+ Data baru</button>
            </div>
        </div>

        <!-- /.card-header -->
        <div class="card-body table-responsive p-0" style="height: 300px;">
            <table class="table table-head-fixed text-nowrap">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Kategori</th>
                        <th>Nominal</th>
                        <th>Keterangan</th>
                        <th style="width: 15%">Edit</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Apa</td>
                        <td style="width: 15%">
                            <button class="btn btn-warning btn-sm">+ Edit</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@endsection

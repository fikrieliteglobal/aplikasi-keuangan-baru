<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class HomeController extends Controller
{
    public function halamanIndex() {
        $modelPengeluaran = Kategori::where('jenis_kategori', 'pengeluaran')->orderBy('kategori_id', 'ASC')->get();
        $modelPemasukan = Kategori::where('jenis_kategori', 'pemasukan')->orderBy('kategori_id', 'ASC')->get();

        // $model = Kategori::all();

        return view('input_kategori/index_ik', [
            'modelPengeluaran' => $modelPengeluaran,
            'modelPemasukan' => $modelPemasukan
        ]);
    }

    public function contoh() {
        return view('contoh.index');
    }

    public function simpanKategori() {
        // dd($_POST);

        // ditampung dulu datanya di $blablabla $_post
        $nama_kategori = $_POST['nama_kategori'];
        $jenis_kategori = $_POST['jenis_kategori'];

        // setelah ditampung baru dimasukkan kedalam model yang terhubung dengan database
        // isi dari model $model->xxxx ini adalah kolom dari database. $ setelahnya adalah tampungan atas
        $model = new Kategori();
        $model->nama_kategori = $nama_kategori;
        $model->jenis_kategori = $jenis_kategori;
        $model->save();
        Session::flash('sukses', 'Data Berhasil Disimpan !!!');
        return redirect('/');
        // setelah model save disimpan kemudian akan di redirect ke mana? sembarang cari di route nya
    }

    public function ubahKategori(){
        // dd($_POST);
        
        $kategori_id = $_POST['kategori_id'];
        $nama_kategori = $_POST['nama_kategori'];

        $model = Kategori::where('kategori_id', $kategori_id)->first();
        $model->nama_kategori = $nama_kategori;
        $model->save();

        Session::flash('sukses', 'Data Berhasil Di Ubah !!!');
        return redirect('/');
    }

    public function deleteKategori($kategori_id) {
        // $id_profil = $id;
        $model = Kategori::where('kategori_id', $kategori_id)->first();
        $model->delete();
        Session::flash('sukses', 'Data Berhasil Dihapus');
        return redirect('/');
    }

    public function halamanPemasukan() {

        if (isset($_GET['tgl_awal']) && $_GET['tgl_awal'] != "") {
            $tgl_awal = $_GET['tgl_awal'];
        } else {
            $tgl_awal = date('Y-m-d', strtotime('first day of this month'));
        }
        if (isset($_GET['tgl_akhir']) && $_GET['tgl_akhir'] != "") {
            $tgl_akhir = $_GET['tgl_akhir'];
        } else {
            $tgl_akhir = date('Y-m-d');
        }

        $modelPemasukan = Kategori::where('jenis_kategori', 'pemasukan')->get();
        // diatas ini untuk mengambil data pemasukan yang di drop down +data
        $model = Pemasukan::whereBetween('tanggal', [$tgl_awal, $tgl_akhir])->orderBy('tanggal', 'ASC')->get();
        // diatas ini untuk mengambil data pemasukan yg akan ditampilkan di halaman utama

        $total = $this->hitungTotal($model);

        return view('pemasukan.index', [
            'modelPemasukan' => $modelPemasukan, 
            'model' => $model, 
            'total' => $total,
            'tgl_awal' => $tgl_awal,
            'tgl_akhir' => $tgl_akhir
        ]);
    }

    public function simpanPemasukan(){
        // dd($_POST);
        $tanggal = $_POST['tanggal'];
        $kategori_id = $_POST['kategori_id'];
        $nominal = $_POST['nominal'];
        $keterangan = $_POST['keterangan'];

        $model = new Pemasukan();
        $model->tanggal = $tanggal;
        $model->kategori_id = $kategori_id;
        $model->nominal = $nominal;
        $model->keterangan = $keterangan;
        $model->save();
        Session::flash('sukses', 'Data Berhasil Disimpan !!!');
        return redirect('/halamanPemasukan');
    }

    public function deletePemasukan($pemasukan_id) {
        // $id_profil = $id;
        $model = Pemasukan::where('pemasukan_id', $pemasukan_id)->first();
        $model->delete();
        Session::flash('sukses', 'Data Berhasil Dihapus');
        return redirect('/halamanPemasukan');
    }

    public function hitungTotal($model) {
        $data = [];

        foreach ($model as $row) {
            $data[] = $row->nominal;
        }

        $sum = array_sum($data);

        return $sum;
    }

    public function halamanPengeluaran() 
    {
        if (isset($_GET['tgl_awal']) && $_GET['tgl_awal'] != "") {
            $tgl_awal = $_GET['tgl_awal'];
        } else {
            $tgl_awal = date('Y-m-d', strtotime('first day of this month'));
        }
        if (isset($_GET['tgl_akhir']) && $_GET['tgl_akhir'] != "") {
            $tgl_akhir = $_GET['tgl_akhir'];
        } else {
            $tgl_akhir = date('Y-m-d');
        }

        $modelPengeluaran = Kategori::where('jenis_kategori', 'pengeluaran')->get();
        $model = Pengeluaran::whereBetween('tanggal', [$tgl_awal, $tgl_akhir])->orderBy('tanggal', 'ASC')->get();

        $total = $this->hitungTotal($model);

        return view('pengeluaran.index', [
            'modelPengeluaran' => $modelPengeluaran, 
            'model' => $model, 
            'total' => $total,
            'tgl_awal' => $tgl_awal,
            'tgl_akhir' => $tgl_akhir,
        ]);
    }

    public function simpanPengeluaran(){
        // dd($_POST);
        $tanggal = $_POST['tanggal'];
        $kategori_id = $_POST['kategori_id'];
        $nominal = $_POST['nominal'];
        $keterangan = $_POST['keterangan'];

        $model = new Pengeluaran();
        $model->tanggal = $tanggal;
        $model->kategori_id = $kategori_id;
        $model->nominal = $nominal;
        $model->keterangan = $keterangan;
        $model->save();
        Session::flash('sukses', 'Data Berhasil Disimpan !!!');
        return redirect('/halamanPengeluaran');
    }

    public function deletePengeluaran($pengeluaran_id) {
        // $id_profil = $id;
        $model = Pengeluaran::where('pengeluaran_id', $pengeluaran_id)->first();
        $model->delete();
        Session::flash('sukses', 'Data Berhasil Dihapus');
        return redirect('/halamanPengeluaran');
    }

    public function halamanDashboard(){
        return view('dashboard.index');
    }

    public function dataCharts() {
        $model = Pengeluaran::selectRaw('sum(nominal) as total, kategori_id')->groupBy('kategori_id')->get();

        $label = [];
        $isi = [];

        foreach ($model as $row) {
            $label[] = Kategori::where('kategori_id', $row->kategori_id)->first()->nama_kategori;
            $isi[] = $row->total;
        }

        return json_encode([$label, $isi]);
    }
}
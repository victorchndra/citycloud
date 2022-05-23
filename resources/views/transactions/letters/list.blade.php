@extends("layouts.app")
@section('content')
<style>
.dataTable-dropdown{
    display:none!important;
}
</style>
<link rel="stylesheet" href="{{asset('/vendors/simple-datatables/style.css')}}">
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>DataTable</h3>
                <p class="text-subtitle text-muted">For user to check they list</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">DataTable</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
            <a href="/list" class="btn btn-sm btn-secondary btnReload"><i
                                class="bi bi-arrow-counterclockwise"></i></a>

            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Jenis Surat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Surat Keterangan Usaha</td>
                            <td>
                                    <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                                data-bs-toggle="dropdown">Aksi</button>
                                            <div class="dropdown-menu">
                                            <a href="/letters-business/create"
                                                    class="dropdown-item"><i class="mdi mdi-tooltip-edit"></i> Buat Surat</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Surat Keterangan Pindah</td>
                            <td>
                                    <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                                data-bs-toggle="dropdown">Aksi</button>
                                            <div class="dropdown-menu">
                                                <a href="#"
                                                    class="dropdown-item"><i class="mdi mdi-tooltip-edit"></i> Buat Surat</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Surat Keterangan Penduduk</td>
                            <td>
                                    <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                                data-bs-toggle="dropdown">Aksi</button>
                                            <div class="dropdown-menu">
                                                <a href="#"
                                                    class="dropdown-item"><i class="mdi mdi-tooltip-edit"></i> Buat Surat</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Surat Keterangan Beda Nama</td>
                            <td>
                                    <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                                data-bs-toggle="dropdown">Aksi</button>
                                            <div class="dropdown-menu">
                                                <a href="#"
                                                    class="dropdown-item"><i class="mdi mdi-tooltip-edit"></i> Buat Surat</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Surat Keterangan Rekomendasi</td>
                            <td>
                                    <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                                data-bs-toggle="dropdown">Aksi</button>
                                            <div class="dropdown-menu">
                                                <a href="/letters-recomendation/create"
                                                    class="dropdown-item"><i class="mdi mdi-tooltip-edit"></i> Buat Surat</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>Surat Keterangan Penghasilan</td>
                            <td>
                                    <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                                data-bs-toggle="dropdown">Aksi</button>
                                            <div class="dropdown-menu">
                                                <a href="#"
                                                    class="dropdown-item"><i class="mdi mdi-tooltip-edit"></i> Buat Surat</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td>Surat Keterangan Nikah</td>
                            <td>
                                    <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                                data-bs-toggle="dropdown">Aksi</button>
                                            <div class="dropdown-menu">
                                                <a href="#"
                                                    class="dropdown-item"><i class="mdi mdi-tooltip-edit"></i> Buat Surat</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>Surat Keterangan Jalan</td>
                            <td>
                                    <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                                data-bs-toggle="dropdown">Aksi</button>
                                            <div class="dropdown-menu">
                                                <a href="#"
                                                    class="dropdown-item"><i class="mdi mdi-tooltip-edit"></i> Buat Surat</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                        </tr>
                        <tr>
                            <td>9</td>
                            <td>Surat Keterangan Pengantar SKCK</td>
                            <td>
                                    <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                                data-bs-toggle="dropdown">Aksi</button>
                                            <div class="dropdown-menu">
                                                <a href="#"
                                                    class="dropdown-item"><i class="mdi mdi-tooltip-edit"></i> Buat Surat</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                        </tr>
                        <tr>
                            <td>10</td>
                            <td>Surat Keterangan Domisili</td>
                            <td>
                                    <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                                data-bs-toggle="dropdown">Aksi</button>
                                            <div class="dropdown-menu">
                                                <a href="/letters-domicile/create"
                                                    class="dropdown-item"><i class="mdi mdi-tooltip-edit"></i> Buat Surat</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                        </tr>
                        <tr>
                            <td>12</td>
                            <td>Surat Keterangan Miskin</td>
                            <td>
                                    <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                                data-bs-toggle="dropdown">Aksi</button>
                                            <div class="dropdown-menu">
                                                <a href="/letters-poor/create"
                                                    class="dropdown-item"><i class="mdi mdi-tooltip-edit"></i> Buat Surat</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                        </tr>
                        <tr>
                            <td>13</td>
                            <td>Surat Keterangan Tidak Mampu</td>
                            <td>
                                    <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                                data-bs-toggle="dropdown">Aksi</button>
                                            <div class="dropdown-menu">
                                                <a href="/letters-needy/create"
                                                    class="dropdown-item"><i class="mdi mdi-tooltip-edit"></i> Buat Surat</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                        </tr>
                        <tr>
                            <td>14</td>
                            <td>Surat Keterangan Belum Menikah</td>
                            <td>
                                    <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                                data-bs-toggle="dropdown">Aksi</button>
                                            <div class="dropdown-menu">
                                                <a href="letters-not-married-yet/create"
                                                    class="dropdown-item"><i class="mdi mdi-tooltip-edit"></i> Buat Surat</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                        </tr>
                        <tr>
                            <td>15</td>
                            <td>Surat Keterangan Goib</td>
                            <td>
                                    <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                                data-bs-toggle="dropdown">Aksi</button>
                                            <div class="dropdown-menu">
                                                <a href="#"
                                                    class="dropdown-item"><i class="mdi mdi-tooltip-edit"></i> Buat Surat</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                        </tr>
                        <tr>
                            <td>16</td>
                            <td>Surat Keterangan Kelahiran</td>
                            <td>
                                    <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                                data-bs-toggle="dropdown">Aksi</button>
                                            <div class="dropdown-menu">
                                                <a href="/letters-birth/create"
                                                    class="dropdown-item"><i class="mdi mdi-tooltip-edit"></i> Buat Surat</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                        </tr>
                        <tr>
                            <td>17</td>
                            <td>Surat Keterangan Kelahiran Puskesmas</td>
                            <td>
                                    <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                                data-bs-toggle="dropdown">Aksi</button>
                                            <div class="dropdown-menu">
                                                <a href="#"
                                                    class="dropdown-item"><i class="mdi mdi-tooltip-edit"></i> Buat Surat</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                        </tr>
                        <tr>
                            <td>18</td>
                            <td>Surat Keterangan Kematian</td>
                            <td>
                                    <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                                data-bs-toggle="dropdown">Aksi</button>
                                            <div class="dropdown-menu">
                                                <a href="/letters-death/create"
                                                    class="dropdown-item"><i class="mdi mdi-tooltip-edit"></i> Buat Surat</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                        </tr>
                        <tr>
                            <td>19</td>
                            <td>Surat Keterangan Perjalanan Orang</td>
                            <td>
                                    <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                                data-bs-toggle="dropdown">Aksi</button>
                                            <div class="dropdown-menu">
                                                <a href="#"
                                                    class="dropdown-item"><i class="mdi mdi-tooltip-edit"></i> Buat Surat</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                        </tr>
                        <tr>
                            <td>20</td>
                            <td>Surat Keterangan Perjalanan Barang</td>
                            <td>
                                    <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                                data-bs-toggle="dropdown">Aksi</button>
                                            <div class="dropdown-menu">
                                                <a href="#"
                                                    class="dropdown-item"><i class="mdi mdi-tooltip-edit"></i> Buat Surat</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                        </tr>
                        <tr>
                            <td>21</td>
                            <td>Surat Keterangan Izin Keramaian</td>
                            <td>
                                    <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                                data-bs-toggle="dropdown">Aksi</button>
                                            <div class="dropdown-menu">
                                                <a href="#"
                                                    class="dropdown-item"><i class="mdi mdi-tooltip-edit"></i> Buat Surat</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                        </tr>
                        <tr>
                            <td>22</td>
                            <td>Surat Keterangan Beda Tanggal Lahir</td>
                            <td>
                                    <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                                data-bs-toggle="dropdown">Aksi</button>
                                            <div class="dropdown-menu">
                                                <a href="/letters-differencebirth/create"
                                                    class="dropdown-item"><i class="mdi mdi-tooltip-edit"></i> Buat Surat</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                        </tr>
                        <tr>
                            <td>23</td>
                            <td>Surat Keterangan KTP Dalam Proses</td>
                            <td>
                                    <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                                data-bs-toggle="dropdown">Aksi</button>
                                            <div class="dropdown-menu">
                                                <a href="#"
                                                    class="dropdown-item"><i class="mdi mdi-tooltip-edit"></i> Buat Surat</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                        </tr>
                        <tr>
                            <td>24</td>
                            <td>Surat Keterangan Status</td>
                            <td>
                                    <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                                data-bs-toggle="dropdown">Aksi</button>
                                            <div class="dropdown-menu">
                                                <a href="#"
                                                    class="dropdown-item"><i class="mdi mdi-tooltip-edit"></i> Buat Surat</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                        </tr>
                        <tr>
                            <td>25</td>
                            <td>Surat Keterangan Dispensasi SPP Kuliah</td>
                            <td>
                                    <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                                data-bs-toggle="dropdown">Aksi</button>
                                            <div class="dropdown-menu">
                                                <a href="#"
                                                    class="dropdown-item"><i class="mdi mdi-tooltip-edit"></i> Buat Surat</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                        </tr>
                        <tr>
                            <td>26</td>
                            <td>Surat Keterangan Umum</td>
                            <td>
                                    <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                                data-bs-toggle="dropdown">Aksi</button>
                                            <div class="dropdown-menu">
                                                <a href="#"
                                                    class="dropdown-item"><i class="mdi mdi-tooltip-edit"></i> Buat Surat</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                        </tr>
                        <tr>
                            <td>27</td>
                            <td>Surat Keterangan Belum Memiliki Rumah</td>
                            <td>
                                    <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                                data-bs-toggle="dropdown">Aksi</button>
                                            <div class="dropdown-menu">
                                                <a href="/letters-nohouse/create"
                                                    class="dropdown-item"><i class="mdi mdi-tooltip-edit"></i> Buat Surat</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                        </tr>
                        <tr>
                            <td>28</td>
                            <td>Surat Keterangan Karantina Mandiri</td>
                            <td>
                                    <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                                data-bs-toggle="dropdown">Aksi</button>
                                            <div class="dropdown-menu">
                                                <a href="/letters-selfquarantine/create"
                                                    class="dropdown-item"><i class="mdi mdi-tooltip-edit"></i> Buat Surat</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                        </tr>
                        <tr>
                            <td>29</td>
                            <td>Surat Keterangan Permohonan Kartu Keluarga</td>
                            <td>
                                    <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                                data-bs-toggle="dropdown">Aksi</button>
                                            <div class="dropdown-menu">
                                                <a href="/letters-familycard/create"
                                                    class="dropdown-item"><i class="mdi mdi-tooltip-edit"></i> Buat Surat</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                        </tr>
                        <tr>
                            <td>30</td>
                            <td>Surat Keterangan Permohonan Cuti Tahunan</td>
                            <td>
                                    <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                                data-bs-toggle="dropdown">Aksi</button>
                                            <div class="dropdown-menu">
                                                <a href="/letters-holiday/create"
                                                    class="dropdown-item"><i class="mdi mdi-tooltip-edit"></i> Buat Surat</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                        </tr>
                        <tr>
                            <td>30</td>
                            <td>Surat Keterangan Akte Dalam Proses</td>
                            <td>
                                    <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                                data-bs-toggle="dropdown">Aksi</button>
                                            <div class="dropdown-menu">
                                                <a href="#"
                                                    class="dropdown-item"><i class="mdi mdi-tooltip-edit"></i> Buat Surat</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                        </tr>
                        <tr>
                            <td>30</td>
                            <td>Surat Keterangan Belum Memiliki BPJS</td>
                            <td>
                                    <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                                data-bs-toggle="dropdown">Aksi</button>
                                            <div class="dropdown-menu">
                                                <a href="/letters-not-bpjs/create"
                                                    class="dropdown-item"><i class="mdi mdi-tooltip-edit"></i> Buat Surat</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                        </tr>
                        <tr>
                            <td>31</td>
                            <td>Surat Keterangan Belum Memiliki BPJS</td>
                            <td>
                                    <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                                data-bs-toggle="dropdown">Aksi</button>
                                            <div class="dropdown-menu">
                                                <a href="#"
                                                    class="dropdown-item"><i class="mdi mdi-tooltip-edit"></i> Buat Surat</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                        </tr>
                        <tr>
                            <td>32</td>
                            <td>Surat Keterangan Permohonan NPWP</td>
                            <td>
                                    <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                                data-bs-toggle="dropdown">Aksi</button>
                                            <div class="dropdown-menu">
                                                <a href="#"
                                                    class="dropdown-item"><i class="mdi mdi-tooltip-edit"></i> Buat Surat</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                        </tr>
                        <tr>
                            <td>33</td>
                            <td>Surat Keterangan Pernyataan</td>
                            <td>
                                    <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                                data-bs-toggle="dropdown">Aksi</button>
                                            <div class="dropdown-menu">
                                                <a href="#"
                                                    class="dropdown-item"><i class="mdi mdi-tooltip-edit"></i> Buat Surat</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                        </tr>
                        <tr>
                            <td>34</td>
                            <td>Surat Keterangan Penghapusan Biodata Penduduk</td>
                            <td>
                                    <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                                data-bs-toggle="dropdown">Aksi</button>
                                            <div class="dropdown-menu">
                                                <a href="/letters-removecitizen/create"
                                                    class="dropdown-item"><i class="mdi mdi-tooltip-edit"></i> Buat Surat</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                        </tr>
                        <tr>
                            <td>35</td>
                            <td>Surat Keterangan Pensiun</td>
                            <td>
                                    <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                                data-bs-toggle="dropdown">Aksi</button>
                                            <div class="dropdown-menu">
                                                <a href="/letters-pension/create"
                                                    class="dropdown-item"><i class="mdi mdi-tooltip-edit"></i> Buat Surat</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                        </tr>
                        <tr>
                            <td>36</td>
                            <td>Surat Pernyataan Ahli Waris</td>
                            <td>
                                    <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                                data-bs-toggle="dropdown">Aksi</button>
                                            <div class="dropdown-menu">
                                                <a href="#"
                                                    class="dropdown-item"><i class="mdi mdi-tooltip-edit"></i> Buat Surat</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                        </tr>
                        <tr>
                            <td>37</td>
                            <td>Surat Keterangan Janda/Duda</td>
                            <td>
                                    <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                                data-bs-toggle="dropdown">Aksi</button>
                                            <div class="dropdown-menu">
                                                <a href="#"
                                                    class="dropdown-item"><i class="mdi mdi-tooltip-edit"></i> Buat Surat</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                        </tr>
                        <tr>
                            <td>38</td>
                            <td>Surat Keterangan Haji/Umroh</td>
                            <td>
                                    <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                                data-bs-toggle="dropdown">Aksi</button>
                                            <div class="dropdown-menu">
                                                <a href="#"
                                                    class="dropdown-item"><i class="mdi mdi-tooltip-edit"></i> Buat Surat</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                        </tr>
                        <tr>
                            <td>39</td>
                            <td>Surat Keterangan Hilang</td>
                            <td>
                                    <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                                data-bs-toggle="dropdown">Aksi</button>
                                            <div class="dropdown-menu">
                                                <a href="#"
                                                    class="dropdown-item"><i class="mdi mdi-tooltip-edit"></i> Buat Surat</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                        </tr>
                        <tr>
                            <td>40</td>
                            <td>Surat Keterangan Belum Memiliki Akte</td>
                            <td>
                                    <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                                data-bs-toggle="dropdown">Aksi</button>
                                            <div class="dropdown-menu">
                                                <a href="#"
                                                    class="dropdown-item"><i class="mdi mdi-tooltip-edit"></i> Buat Surat</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                        </tr>
                        <tr>
                            <td>41</td>
                            <td>Surat Keterangan Tidak Memiliki Dokumen Penduduk</td>
                            <td>
                                    <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                                data-bs-toggle="dropdown">Aksi</button>
                                            <div class="dropdown-menu">
                                                <a href="#"
                                                    class="dropdown-item"><i class="mdi mdi-tooltip-edit"></i> Buat Surat</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                        </tr>
                        <tr>
                            <td>42</td>
                            <td>Surat Keterangan Kepemilikan</td>
                            <td>
                                    <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                                data-bs-toggle="dropdown">Aksi</button>
                                            <div class="dropdown-menu">
                                                <a href="#"
                                                    class="dropdown-item"><i class="mdi mdi-tooltip-edit"></i> Buat Surat</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                        </tr>
                        <tr>
                            <td>43</td>
                            <td>Surat Keterangan Izin Mendirikan Bangunan</td>
                            <td>
                                    <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                                data-bs-toggle="dropdown">Aksi</button>
                                            <div class="dropdown-menu">
                                                <a href="/letters-building/create"
                                                    class="dropdown-item"><i class="mdi mdi-tooltip-edit"></i> Buat Surat</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                        </tr>
                        <tr>
                            <td>44</td>
                            <td>Surat Keterangan Rujuk/Cerai</td>
                            <td>
                                    <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                                data-bs-toggle="dropdown">Aksi</button>
                                            <div class="dropdown-menu">
                                                <a href="/letters-divorce/create"
                                                    class="dropdown-item"><i class="mdi mdi-tooltip-edit"></i> Buat Surat</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                        </tr>
                         <tr>
                            <td>45</td>
                            <td>Surat Keterangan Permohonan Cerai</td>
                            <td>
                                    <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                                data-bs-toggle="dropdown">Aksi</button>
                                            <div class="dropdown-menu">
                                                <a href="#"
                                                    class="dropdown-item"><i class="mdi mdi-tooltip-edit"></i> Buat Surat</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                        </tr>
                           <tr>
                            <td>46</td>
                            <td>Surat Keterangan Jual Beli</td>
                            <td>
                                    <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                                data-bs-toggle="dropdown">Aksi</button>
                                            <div class="dropdown-menu">
                                                <a href="#"
                                                    class="dropdown-item"><i class="mdi mdi-tooltip-edit"></i> Buat Surat</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                        </tr>

                           <tr>
                            <td>47</td>
                            <td>Surat Rekomendasi Kerja</td>
                            <td>
                                    <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                                data-bs-toggle="dropdown">Aksi</button>
                                            <div class="dropdown-menu">
                                                <a href="/letters-job/create"
                                                    class="dropdown-item"><i class="mdi mdi-tooltip-edit"></i> Buat Surat</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                        </tr>
                    </tbody>
                    </tbody>

                </table>
            </div>
        </div>

    </section>
</div>

<script src="{{asset('/vendors/simple-datatables/simple-datatables.js')}}"></script>
<script>
    // Simple Datatable
    let table1 = document.querySelector('#table1');
    let dataTable = new simpleDatatables.DataTable(table1);

</script>
@endsection

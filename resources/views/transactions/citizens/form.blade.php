@extends("layouts.app")

@section('content')
<div class="col-12 grid-margin">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Kependudukan</h4>
            <form class="form-sample" action="/citizens" method="POST">
                @csrf
                <p class="card-description my-3 text-muted">
                    Identitas pribadi
                </p>
                <hr class="text-muted">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">NIK</label>
                            <div class="col-sm-9">
                                <input type="number" name="nik" class="form-control" placeholder="Nomor Induk Kependudukan"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">KK</label>
                            <div class="col-sm-9">
                                <input type="number" name="kk" class="form-control" placeholder="Kartu Keluarga" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama Lengkap</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" class="form-control" placeholder="Nama Lengkap" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tanggal Lahir</label>
                            <div class="col-sm-9">
                                <input type="date" name="date_birth" class="form-control" placeholder="dd/mm/yyyy" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="gender">
                                    <option value="l">Laki-laki</option>
                                    <option value="p">Perempuan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tempat Lahir</label>
                            <div class="col-sm-9">
                                <input type="text" name="place_birth" class="form-control" placeholder="Tempat Lahir" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Agama</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="religion">
                                    <option value="Islam">Islam</option>
                                    <option value="Kristen Katolik">Kristen Katolik</option>
                                    <option value="Kristen Protestan">Kristen Protestan</option>
                                    <option value="Buddha">Buddha</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Konghucu">Konghucu</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Status Keluarga</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="family_status">
                                    <option value="head">Kepala keluarga</option>
                                    <option value="wife">Istri</option>
                                    <option value="child">Anak</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Golongan Darah</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="blood">
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="AB">AB</option>
                                    <option value="O">O</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Pekerjaan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Pekerjaan" name="job"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nomor Telepon</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" placeholder="Nomor Telepon" name="phone">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Status Pernikahan</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="marriage">
                                    <option value="Belum Kawen">Belum Menikah</option>
                                    <option value="Kawin Tercatat">Sudah Menikah</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="card-description my-3 text-muted">
                    Alamat
                </p>
                <hr class="text-muted">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">RT</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="rt"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">RW</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="rw"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Desa</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="village"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kota / Kabupaten</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="sub_districts"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kecamatan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="districts"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Provinsi</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="province"/>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="card-description my-3 text-muted">
                    Lanjutan
                </p>
                <hr class="text-muted">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tanggal Pindah</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" name="move_date"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tanggal Meninggal</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" name="death_date"/>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="card-description my-3 text-muted">
                    Status Vaksinasi
                </p>
                <hr class="text-muted">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Vaksin 1</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="vaccine_1">
                                    <option value="">Belum Vaksin</option>
                                    <option value="Sudah Vaksin">Sudah Vaksin</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Vaksin 2</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="vaccine_2">
                                    <option value="">Belum Vaksin</option>
                                    <option value="Sudah Vaksin">Sudah Vaksin</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Vaksin 3</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="vaccine_3">
                                    <option value="">Belum Vaksin</option>
                                    <option value="Sudah Vaksin">Sudah Vaksin</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center my-4">
                    <button class="btn btn-primary">Tambah Data Kependudukan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

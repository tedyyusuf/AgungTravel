@extends('layouts.app')

@section('content')
    <h1>Pemesanan</h1>
    {!! Form::open(['action' => 'OrderController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
          <label for="titel">Titel</label>
          <select class="form-control col-md-2" name="title">
            <option>Tuan</option>
            <option>Nyonya</option>
            <option>Nona</option>
          </select>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputFirstName">Nama Depan</label>
            <input type="text" class="form-control" name="first_name">
          </div>
          <div class="form-group col-md-6">
            <label for="inputLastName">Nama Belakang</label>
            <input type="text" class="form-control" name="last_name">
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail">Email</label>
          <input type="email" class="form-control" name="email" placeholder="contoh@email.com">
        </div>
        <div class="form-group">
          <label for="inputPhone">Nomor Telpon / HP</label>
          <input type="tel" class="form-control" name="phone_number" placeholder="08xxxxxxxxxx">
        </div>
        <fieldset class="form-group">
          <div class="row">
            <legend class="col-form-label col-sm-3 pt-0">Pilih Paket</legend>
            <div class="col-sm-10">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="paket" value="750000" checked>
                <label class="form-check-label" for="gridRadios1">
                  Hari kerja
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="paket" value="1000000">
                <label class="form-check-label" for="gridRadios2">
                  Hari libur
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="paket" value="1500000">
                <label class="form-check-label" for="gridRadios3">
                  Full Day
                </label>
              </div>
            </div>
          </div>
        </fieldset>
        <label for="inputDate">Jadwal Keberangkatan</label>
        <div class="form-row">
          <div class="form-group col-md-4">
            <select class="form-control col-md-12" name="day">
              <option>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
              <option>6</option>
              <option>7</option>
              <option>8</option>
              <option>9</option>
              <option>10</option>
              <option>11</option>
              <option>12</option>
              <option>13</option>
              <option>14</option>
              <option>15</option>
              <option>16</option>
              <option>17</option>
              <option>18</option>
              <option>19</option>
              <option>20</option>
              <option>21</option>
              <option>22</option>
              <option>23</option>
              <option>24</option>
              <option>25</option>
              <option>26</option>
              <option>27</option>
              <option>28</option>
              <option>29</option>
              <option>30</option>
              <option>31</option>
            </select>
          </div>
          <div class="form-group col-md-4">
            <select class="form-control col-md-12" name="month">
              <option>Januari</option>
              <option>Februari</option>
              <option>Maret</option>
              <option>April</option>
              <option>Mei</option>
              <option>Juni</option>
              <option>Juli</option>
              <option>Agustus</option>
              <option>September</option>
              <option>Oktober</option>
              <option>November</option>
              <option>Desember</option>
            </select>
          </div>
          <div class="form-group col-md-4">
            <input type="number" class="form-control" name="year" placeholder="Tahun">
          </div>
        </div>
        <label for="inputGroup">Jumlah Tamu</label>
        <div class="form-row">
          <div class="form-group col-md-2">
            <input type="number" class="form-control" name="person">
          </div>
        </div>
        <fieldset class="form-group">
        <div class="row">
          <legend class="col-form-label col-sm-4 pt-0">Pilih rekening pembayaran</legend>
          <select class="form-control col-md-2" name="payments">
            <option>BCA no.rek 7775216587</option>
            <option>BNI no.rek 8465214529</option>
            <option>Mandiri no.rek 8793655458</option>
          </select>
        </div>
      </fieldset>
      <input type="hidden" name="order_status" value="Belum dibayar">
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection

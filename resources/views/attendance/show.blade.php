@extends('layouts.nomenu')

@section('title', 'Daftar Hadir')

@section('content')
<div id="app-vue">
    <div class="container-fluid">
        <h3 class="text-center mt-3 mb-0">{{ $event->name }}</h3>
        <p class="text-center"><strong>{{ $event->location }}</strong> // {{ $event->start_at }} </p>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Scan Barcode <i class="bi bi-upc-scan"></i>
                    </div>
                    <div class="card-body">
                        <video id="preview" width="100%"></video>
                        <div v-if="detail === false" class="alert alert-info">
                            Silahkan Scan QRCode anda.
                        </div>
                        <div v-else-if="detail.status == 1" class="alert alert-success">
                            @{{detail.msg}}
                        </div>
                        <div v-else class="alert alert-danger">
                            <p v-if="detail.arrData !== false">
                                @{{detail.msg}}
                            </p>
                            <p v-else>
                                @{{detail.msg}}
                            </p>
                        </div>

                        <ul>
                            <li v-for="(itemCam, index) in cameras">
                                <button v-on:click="click_camera(index)" type="button" class="btn btn-light btn-sm">@{{itemCam.name}}</button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Daftar Peserta <i class="bi bi-upc-scan"></i>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-bordered">
                            <tr>
                                <th class="text-center" width="10%">No.</th>
                                <th class="text-center" width="70%">Nama / Alamat</th>
                                <th class="text-center" width="20%">Status</th>
                            </tr>
                            <tr v-for="(item, index) in items">
                                <td class="text-center">@{{ count_start + index }}</td>
                                <td>
                                    <strong>@{{item.name}}</strong> <br />
                                    @{{item.address}}
                                </td>
                                <td class="text-center">

                                    <span v-if="item.mh_participant_type_id == 1" class="badge bg-warning">Panitia</span>
                                    <span v-if="item.mh_participant_type_id == 2" class="badge bg-danger">Tamu</span>
                                    <span v-if="item.mh_participant_type_id == 3" class="badge bg-primary">Peserta</span>

                                </td>
                            </tr>
                        </table>

                        <div v-if="items.length > 0" class="text-center">
                            <a class="btn btn-warning" href="{{ url('/attendance/' . $event->key . '/all-participant') }}">
                                Lihat Semua
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="toast-container position-fixed" style="bottom: 10px; right: 10px">

</div>
@endsection

@section('js')
<script src="{{ url('/assets/js/axios.min.js') }}"></script>
<script src="{{ url('/assets/js/vue2.js') }}"></script>
<script src="{{ url('/assets/js/sweetalert2.11.js') }}"></script>
<script src="{{ url('/assets/js/instascan.min.js') }}"></script>

<script>
    const initialValue = @json($jsIntialValue);
</script>
<script src="{{ url('/assets/js/controller/attendance/show.js') }}"></script>

@endsection

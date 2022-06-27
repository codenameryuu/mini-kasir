@extends('layouts.main')

@section('custom_css')
    <style>
        .swal-wide {
            width: 100px !important;
        }
    </style>
@endsection

@section('content')
    <div class="row ">
        <table class="striped">
            <thead>
                <tr>
                    <th class="text-center">
                        No
                    </th>

                    <th class="text-center">
                        Kode Transaksi
                    </th>

                    <th class="text-center">
                        Atas Nama
                    </th>

                    <th class="text-center">
                        Total
                    </th>

                    <th class="text-center">
                        Status
                    </th>

                    <th class="text-center">
                        Detail
                    </th>
                </tr>
            </thead>

            <tbody>
                @foreach ($order as $row)
                    <tr>
                        <td class="text-center">
                            {{ $loop->iteration }}
                        </td>

                        <td class="text-center">
                            {{ $row->transaction_code }}
                        </td>

                        <td class="text-center">
                            {{ $row->buyer_name }}
                        </td>

                        <td class="text-center">
                            {{ $row->total }}
                        </td>

                        <td class="text-center" id="status{{ $row->id }}">
                            <button class="btn {{ $row->status == 'Sudah Bayar' ? 'blue' : 'red' }} btn-round"
                                onclick="changeStatus({{ $row->id }}, '{{ $row->buyer_name }}')">
                                {{ $row->status }}
                            </button>
                        </td>

                        <td class="text-center">
                            <a href="/pesanan/detail/{{ $row->id }}" target="_blank">
                                <button class="btn deep-purple btn-round">
                                    Detail
                                </button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('custom_js')
    <script>
        function changeStatus(id, name) {
            Swal.fire({
                icon: 'question',
                text: 'Ganti Status Atas Nama ' + name,
                input: 'select',
                inputOptions: {
                    'Belum Bayar': 'Belum Bayar',
                    'Sudah Bayar': 'Sudah Bayar',
                },
                showCancelButton: true,
                confirmButtonText: 'Simpan',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    let status = result.value;

                    $.ajax({
                        url: "{{ url('/pesanan/update-status') }}",
                        method: "POST",
                        dataType: "JSON",
                        data: {
                            id: id,
                            status: status,
                            "_token": "{{ csrf_token() }}",
                        },
                        success: function(data) {
                            let order = data.order;

                            let id = order.id;
                            let status = order.status;
                            let name = order.buyer_name;
                            let color = 'red';

                            if (status == 'Sudah Bayar') {
                                color = 'blue';
                            }

                            let statusChanged = `
                            <button class="btn ` + color + ` btn-round" onclick="changeStatus(` + id + `, '` + name + `')">
                                ` + status + `
                            </button>`;

                            $('#status' + id).html(statusChanged);

                            Swal.fire({
                                icon: 'success',
                                text: 'Data berhasil dirubah!',
                                showConfirmButton: false,
                                timer: 1000
                            });
                        }
                    });
                }
            });
        }
    </script>
@endsection

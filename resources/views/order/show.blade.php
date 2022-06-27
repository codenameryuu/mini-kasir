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
                        Nama Menu
                    </th>

                    <th class="text-center">
                        Harga
                    </th>

                    <th class="text-center">
                        Jumlah
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
                            {{ $row->order->transaction_code }}
                        </td>

                        <td class="text-center">
                            {{ $row->menu->name }}
                        </td>

                        <td class="text-center">
                            {{ number_format($row->price, 0, ',', '.') }}
                        </td>

                        <td class="text-center">
                            {{ number_format($row->quantity, 0, ',', '.') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

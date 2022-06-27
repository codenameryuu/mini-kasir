@extends('layouts.main')

@section('custom_css')
    <style>
        .box-checkout {
            margin-bottom: 100px;
        }

        .button_transparan {
            display: none;
        }
    </style>
@endsection

@section('content')
    <div class="row ">
        <table class="striped">
            <thead>
                <tr>
                    <th class="text-center">
                        Gambar
                    </th>

                    <th class="text-center">
                        Nama
                    </th>

                    <th class="text-center">
                        Harga
                    </th>

                    <th class="text-center">
                        Jumlah
                    </th>

                    <th class="text-center">
                        Action
                    </th>
                </tr>
            </thead>

            <tbody>
                @foreach ($cart as $row)
                    <tr id="row{{ $row->id }}">
                        <td class="text-center">
                            <img class="img-preview" src="{{ $row->attributes->image }}">
                        </td>

                        <td class="text-center">
                            <h6>
                                {{ $row->name }}
                            </h6>
                        </td>

                        <td class="text-center">
                            Rp {{ number_format($row->price, 0, '.', ',') }}
                        </td>

                        <td class="text-center">
                            <input type="hidden" id="quantity{{ $row->id }}" value="{{ $row->quantity }}">
                            <span class="text-success" id="quantityView{{ $row->id }}">
                                {{ number_format($row->quantity, 0, '.', ',') }}
                            </span>
                        </td>

                        <td class="text-center">
                            <a class="remove-product" onclick="actionItem({{ $row->id }})">
                                <button class="btn red">
                                    <i class="mdi mdi-delete-forever"></i>
                                </button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="card box-checkout">
        <div class="card-body">
            <form method="POST" action="/keranjang/store" onsubmit="return validate()">
                @csrf

                <div class="input-field col s10 offset-s1">
                    <label for="name">
                        Atas Nama
                    </label>

                    <input type="text" name="name" id="name" autocomplete="off">
                </div>

                <div class="input-field col s10 offset-s1">
                    <label for="total">
                        Total
                    </label>

                    <input type="text" name="totalView" id="totalView"
                        value="Rp. {{ number_format($total, 0, ',', '.') }}" autocomplete="off" readonly>

                    <input type="hidden" name="total" id="total" value="{{ $total }}" autocomplete="off">
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn deep-orange w-100">
                        Checkout
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('custom_js')
    <script>
        function formatRupiah(angka, prefix) {
            var number_string = angka.toString().replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }

        function actionItem(id) {
            let quantity = $('#quantity' + id).val();

            if (quantity > 1) {
                updateItem(id);
            } else {
                deleteItem(id);
            }
        }

        function updateItem(id) {
            let quantity = $('#quantity' + id).val();

            $.ajax({
                url: "{{ url('/keranjang/update-item') }}",
                method: "GET",
                dataType: "JSON",
                data: {
                    id: id,
                    quantity: quantity,
                },
                success: function(data) {
                    let cart = data.cart;

                    let id = cart.id;
                    let quantity = cart.quantity;
                    let quantityView = cart.quantityView;
                    let total = cart.total;

                    $('#quantity' + id).val(quantity);
                    $('#quantityView' + id).html(quantityView);

                    var totalView = formatRupiah(total, 'Rp ');
                    $('#totalView').val(totalView);
                    $('#total').val(total);
                }
            });
        }

        function deleteItem(id) {
            $.ajax({
                url: "{{ url('/keranjang/delete-item') }}",
                method: "GET",
                dataType: "JSON",
                data: {
                    id: id,
                },
                success: function(data) {
                    let cart = data.cart;

                    let id = cart.id;
                    let total = cart.total;

                    let row = document.getElementById('row' + id);
                    row.parentNode.removeChild(row);

                    let totalView = formatRupiah(total, 'Rp ');

                    $('#totalView').val(totalView);
                    $('#total').val(total);
                }
            });
        }

        function validate() {
            let cart = @json($cart);
            let name = $('#name').val();

            if (cart.length <= 0) {
                Swal.fire({
                    icon: "error",
                    text: "Keranjang kosong !",
                });

                return false;
            }

            if (name == '') {
                Swal.fire({
                    icon: "error",
                    text: "Atas nama tidak boleh kosong !",
                });

                return false;
            }

            return true;
        }
    </script>
@endsection

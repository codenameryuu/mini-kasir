@extends('layouts.main')

@section('content')
    <div class="infinite-scroll pb-5">
        <div class="row">
            @foreach ($menu as $row)
                <div class="col-md-6">
                    <div class="card">
                        <a href="javascript:void(0)" data-fancybox="images" data-caption="{{ $row->name }}">
                            <div class="card-image round">
                                <img class="z-depth-1" src="{{ $row->image }}">
                            </div>
                        </a>

                        <div class="card-content">
                            <h6>
                                {{ $row->name }}
                            </h6>

                            {!! mb_strimwidth($row->detail, 0, 100, '...') !!}
                        </div>

                        <div class="card-action">
                            <button class="btn deep-orange" onclick="addToCart({{ $row->id }})">
                                <i class="mdi mdi-cart-outline"></i>
                                Pesan
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach

            {{ $menu->links('vendor.pagination.custom') }}

        </div>
    </div>
@endsection

@section('custom_js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jscroll/2.4.1/jquery.jscroll.min.js"
        integrity="sha512-51l8tSwY8XyM6zkByW3A0E36xeiwDpSQnvDfjBAzJAO9+O1RrEcOFYAs3yIF3EDRS/QWPqMzrl6t7ZKEJgkCgw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $('ul.pagination').hide();

        $(function() {
            $('.infinite-scroll').jscroll({
                autoTrigger: true,
                loadingHtml: '<img class="center-block" src="/assets/loader/loader.gif" alt="Loading..." />',
                padding: 0,
                nextSelector: '.pagination li.active + li a',
                contentSelector: 'div.infinite-scroll',
                callback: function() {
                    $('ul.pagination').remove();
                }
            });
        });
    </script>

    <script>
        function addToCart(id) {
            $.ajax({
                url: "{{ url('/keranjang/add-item') }}",
                method: "GET",
                dataType: "JSON",
                data: {
                    id: id,
                },
                success: function(data) {
                    let menu = data.menu;
                    let name = menu.name;
                    let text = 'Berhasil menambahkan ' + name + ' ke pesanan !';

                    M.toast({
                        html: text,
                        classes: 'rounded red lighten-2 white-text',
                        displayLength: 2000
                    });
                }
            });
        }
    </script>
@endsection

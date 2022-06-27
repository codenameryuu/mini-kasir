@extends('layouts.login')

@section('content')
    <div class="card">
        <div class="card-title">
            <h6 class="text-center">
                Form Login
            </h6>
        </div>

        <div class="card-body">
            <form action="/authenticate" method="POST" onsubmit="return validate()">
                @csrf
                <div class="input-field col s10 offset-s1">
                    <label for="username">
                        Username
                    </label>

                    <input type="text" name="username" id="username" autocomplete="off">
                </div>

                <div class="input-field col s10 offset-s1">
                    <label for="password">
                        Password
                    </label>

                    <input type="password" name="password" id="password" autocomplete="off">
                </div>

                <div class="mt-3 d-flex justify-content-center">
                    <button type="submit" class="btn deep-orange w-100">
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('custom_js')
    <script>
        function validate() {
            let username = $('#username').val();
            let password = $('#password').val();

            if (username == '') {
                Swal.fire({
                    icon: "error",
                    text: "Username tidak boleh kosong !",
                });

                return false;
            }

            if (password == '') {
                Swal.fire({
                    icon: "error",
                    text: "Password tidak boleh kosong !",
                });

                return false;
            }

            return true;
        }
    </script>
@endsection

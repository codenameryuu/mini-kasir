@if (session()->has('success'))
    <script>
        Swal.fire({
            icon: "success",
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 1000
        });
    </script>
@endif

@if (session()->has('fail'))
    <script>
        Swal.fire({
            icon: "error",
            text: "{{ session('fail') }}",
            showConfirmButton: false,
            timer: 1000
        });
    </script>
@endif

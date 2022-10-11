@livewireScripts
<script>
    $(function () {
        @if(Session::has('success'))
        Swal.fire({
            icon: 'success',
            title: '{{ Session::get("success") }}'
        })
        @endif
        @if(Session::has('error'))
        Swal.fire({
            icon: 'error',
            title: '{{ Session::get("error") }}'
        })
        @endif
    });
</script>
</body>
</html>

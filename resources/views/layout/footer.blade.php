
	<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy;Universidad Iberoamericana 2023</span>
        </div>
    </div>
</footer>

    <!--===============================================================================================-->
  <!-- Bootstrap core JavaScript-->


    <script src="{{asset('public/general/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('public/general/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('public/general/js/sb-admin-2.min.js')}}"></script>

    <!-- Font awesome for Icons-->
    <script src="https://kit.fontawesome.com/def3229fdd.js" crossorigin="anonymous"></script>

    <script>
    facultades();
    //* Funcion para trear los datos de la tabla facultades y cargar los opciones del select/
    function facultades() {
        $.ajax({       
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('registro.facultades') }}",
            method: 'post',
            success: function(data) {
                data.forEach(facultad => {
                    $('#Facultades').prepend(`<a class="collapse item">${facultad.nombre}</a>`);
                });
            }
        });     
    }
    </script>

</body>

</html>

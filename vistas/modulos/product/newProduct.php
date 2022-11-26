<section class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">
                <h1>Agregar producto</h1>
            </div>

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="index.php">Inicio</a>
                    </li>
                    <li class="breadcrumb-item">
                        Adminstrar productos
                    </li>
                </ol>
            </div>
        </div>
    </div>

</section>

<section class="content">

    <div class="container-fluid">

        <a onclick="changeContent('content-wrapper','vistas/modulos/productos.php')" class="btn btn-info btn-sm mb-4" style="cursor: pointer;">
            Volver
        </a>

        <div class="alert alert-success" id="alert" style="display: none;">&nbsp;</div>


        <div class="row">
            <div class="col-8">
                <form id="contact-form" method="post">
                    <div class="row">
                        <div class="col form-group">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nombre del producto">
                        </div>
                        <div class="col form-group">
                            <input type="text" class="form-control" id="reference" name="reference" placeholder="Referencia del producto">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6 form-group">
                            <input type="number" class="form-control" id="price" name="price" placeholder="Precio del producto">
                        </div>
                        <div class="col-sm-12 col-md-6 form-group">
                            <input type="number" class="form-control" id="weight" name="weight" placeholder="Peso del producto">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6 form-group">
                            <input type="text" class="form-control" id="category" name="category" placeholder="Categoria del producto">
                        </div>
                        <div class="col-sm-12 col-md-6 form-group">
                            <input type="text" class="form-control" id="stock" name="stock" placeholder="stock">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-info">Enviar</button>
                </form>
            </div>
        </div>
    </div>



</section>

<script>
    $(document).ready(function() {
        $("#contact-form").validate({
            event: "blur",
            rules: {
                'name': "required",
                'reference': "required",
                'price': "required number",
                'weight': "required number",
                'category': "required",
                'stock': "required number",
            },
            debug: true,
            errorElement: "label",
            submitHandler: function(form) {
                $("#alert").show();
                $("#alert").html("<strong>Creando producto...</strong>");
                setTimeout(function() {
                    $('#alert').fadeOut('slow');
                }, 5000);
                var datos = new FormData();

                datos.append('name', $('#name').val());
                datos.append('reference', $('#reference').val());
                datos.append('price', $('#price').val());
                datos.append('weight', $('#weight').val());
                datos.append('category', $('#category').val());
                datos.append('stock', $('#stock').val());
                datos.append('accion', 'new');

                $.ajax({
                    type: "POST",
                    url: "ajax/product.ajax.php",
                    data: datos,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(msg) {
                        $("#alert").html(msg);
                        debugger;
                        document.getElementById("name").value = "";
                        document.getElementById("reference").value = "";
                        document.getElementById("price").value = "";
                        document.getElementById("weight").value = "";
                        document.getElementById("category").value = "";
                        document.getElementById("stock").value = "";
                        setTimeout(function() {
                            $('#alert').fadeOut('slow');
                        }, 5000);

                    },
                    error: function(msg) {
                        debugger;
                        $("#alert").html(msg);
                        setTimeout(function() {
                            $('#alert').fadeOut('slow');
                        }, 5000);

                    }

                });

            }
        });
    });
</script>
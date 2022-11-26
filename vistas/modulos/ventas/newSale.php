<section class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">
                <h1>Crear venta</h1>
            </div>

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="index.php">Inicio</a>
                    </li>
                    <li class="breadcrumb-item">
                        Adminstrar Ventas
                    </li>
                </ol>
            </div>
        </div>
    </div>

</section>

<section class="content">

    <div class="container-fluid">

        <a onclick="changeContent('content-wrapper','vistas/modulos/ventas.php')" class="btn btn-info btn-sm mb-4" style="cursor: pointer;">
            <i class="fas fa-plus-square"></i> Volver
        </a>

        <div class="alert alert-success" id="alert" style="display: none;">&nbsp;</div>


        <div class="row">
            <div class="col-8">
                <form id="contact-form" method="post">
                    <div class="row">
                        <div class="col form-group">
                            <select class="form-control" id="product" name="product">
                                <option>Elegir producto</option>
                            </select>
                        </div>
                        <div class="col form-group">
                            <input type="number" class="form-control" id="cantidad" name="cantidad" placeholder="Cantidad del producto">
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
        $.ajax({
            type: "POST",
            url: "ajax/saleProduct.ajax.php",
            cache: false,
            contentType: false,
            processData: false,
            success: function(msg) {
                var json = JSON.parse(msg);
                for (let index = 0; index < json.length; index++) {
                    const element = json[index];
                    $("#product").append(new Option(element['nombre'], element['id']));
                }
            },
            error: function(msg) {
                debugger;
            }
        });

        $("#contact-form").validate({
            event: "blur",
            rules: {
                'product': "required",
                'cantidad': "required number",
            },
            debug: true,
            errorElement: "label",
            submitHandler: function(form) {
                $("#alert").show();
                $("#alert").html("<strong>Creando venta...</strong>");
                setTimeout(function() {
                    $('#alert').fadeOut('slow');
                }, 5000);
                var datos = new FormData();

                datos.append('product', $('#product').val());
                datos.append('cantidad', $('#cantidad').val());
                datos.append('accion', 'new');

                $.ajax({
                    type: "POST",
                    url: "ajax/saleProduct.ajax.php",
                    data: datos,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(msg) {
                        $("#alert").html(msg);
                        debugger;
                        document.getElementById("product").value = "";
                        document.getElementById("cantidad").value = "";
                        setTimeout(function() {
                            $('#alert').fadeOut('slow');
                        }, 5000);
                    },
                    error: function(msg) {
                        debugger;
                        $("#alert").html(msg);
                        setTimeout(function() {
                            $('#alert').fadeOut('slow');
                        }, 9000);

                    }

                });

            }
        });
    });
</script>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Simulador de credito</title>
    <link href="assets/css/styles.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.png" />
    <script data-search-pseudo-elements defer
        src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous">
    </script>
</head>


<body class="nav-fixed">
    <div id="layoutSidenav_content">
        <main>
            <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
                <div class="container-xl px-4">
                    <div class="page-header-content pt-4">
                        <div class="row align-items-center justify-content-between">
                            <div class="col-auto mt-4">
                                <h1 class="page-header-title">
                                    <div class="page-header-icon"><i data-feather="arrow-right-circle"></i></div>
                                    Simulador de crédito
                                </h1>
                                <div class="page-header-subtitle">Con esta herramienta podrás simular fácilmente las cuotas de tu crédito, y conocer cuánto pagarás mes a mes o quincena a quincena.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- Main page content-->
            <div class="container-xl px-4 mt-n10">
                <!-- Wizard card example with navigation-->
                <div class="card">
                    <div class="card-header border-bottom">
                        <!-- Wizard navigation-->
                        <div class="nav nav-pills nav-justified flex-column flex-xl-row nav-wizard" id="cardTab"
                            role="tablist">
                            <!-- Wizard navigation item 1-->
                            <a class="nav-item nav-link active" id="wizard1-tab" href="#wizard1" data-bs-toggle="tab"
                                role="tab" aria-controls="wizard1" aria-selected="true">
                                <div class="wizard-step-icon">1</div>
                                <div class="wizard-step-text">
                                    <div class="wizard-step-text-name">Detalles del credito</div>
                                    <div class="wizard-step-text-details">Información de tu préstamo</div>
                                </div>
                            </a>
                            <!-- Wizard navigation item 2-->
                            <a class="nav-item nav-link" id="wizard2-tab" href="#wizard2" data-bs-toggle="tab"
                                role="tab" aria-controls="wizard2" aria-selected="true" disabled="true" onclick="setAmortizacion30Day();">
                                <div class="wizard-step-icon">2</div>
                                <div class="wizard-step-text">
                                    <div class="wizard-step-text-name">Simulación Mensual</div>
                                    <div class="wizard-step-text-details">Tabla de amortización 30 Días</div>
                                </div>
                            </a>
                            <!-- Wizard navigation item 4-->
                            <a class="nav-item nav-link" id="wizard4-tab" href="#wizard4" data-bs-toggle="tab"
                                role="tab" aria-controls="wizard4" aria-selected="true" disabled="true" onclick="setAmortizacion15Day();">
                                <div class="wizard-step-icon">3</div>
                                <div class="wizard-step-text">
                                    <div class="wizard-step-text-name">Simulación Quincenal</div>
                                    <div class="wizard-step-text-details">Tabla de amortización 15 Días</div>
                    
                                </div>
                            </a>
                            <!-- Wizard navigation item 3-->
                            <a class="nav-item nav-link" id="wizard3-tab" href="#wizard3" data-bs-toggle="tab"
                                role="tab" aria-controls="wizard3" aria-selected="true" disabled="true">
                                <div class="wizard-step-icon">4</div>
                                <div class="wizard-step-text">
                                    <div class="wizard-step-text-name">Formulario de solicitud</div>
                                    <div class="wizard-step-text-details">Complete sus datos para ponernos en contacto
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="cardTabContent">
                            <!-- Wizard tab pane item 1-->
                            <div class="tab-pane py-5 py-xl-10 fade show active" id="wizard1" role="tabpanel"
                                aria-labelledby="wizard1-tab">
                                <div class="row justify-content-center">
                                    <div class="col-xxl-6 col-xl-8">

                                        <h5 class="card-title mb-4">Introduzca la información</h5>
                                        <form id="form-simulacion1" action="includes/correo.php" method="POST">
                                            <div class="mb-3">
                                                <label class="small mb-1" for="inputUsername">Seleccione el producto de
                                                    crédito</label>
                                                <select class="form-select" aria-label="Default select example"
                                                    id="credito" name="credito" required>
                                                    <option selected disabled value="">Seleccionar</option>
                                                    <?php 
                                                    if (count($creditoLista)>0) {
                                                        foreach ($creditoLista as $creditos) {
		  		                                     ?>
                                                    <option value="<?=$creditos['idcredito']?>"><?=$creditos['nombre']?>
                                                    </option>
                                                    <?php
			                                             }
                                                    }
			  	                                    ?>
                                                </select>
                                            </div>
                                            <div class="row gx-3">
                                                <div class="mb-3 col-md-6">
                                                    <label class="small mb-1" for="montoCredito">Ingrese el monto del
                                                        crédito</label>
                                                    <input class="form-control" id="montoCredito" type="number"
                                                        placeholder="10000000" value="" min="0" name="monto" required />
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label class="small mb-1" for="plazoCredito">Ingrese el número de
                                                        meses en los que desea pagar</label>
                                                    <input class="form-control" id="plazoCredito" type="number"
                                                        placeholder="48" value="" min="0" name="plazo" required />
                                                </div>
                                            </div>

                                            <hr class="my-4" />
                                            <div class="d-flex justify-content-between">
                                                <a onclick="javascript: window.history.back();" class="btn btn-muted"
                                                    type="button">Volver</a>
                                                <!-- <button class="btn btn-warning" type="button" id="btn-calcular">Calcular</button> -->
                                                <input class="btn btn-lg btn-warning" type="button" id="btn-calcular"
                                                    value="Calcular">
                                            </div>

                                    </div>
                                </div>
                            </div>
                            <!-- Wizard tab pane item 2-->
                            <div class="tab-pane py-6 py-xl-9 fade" id="wizard2" role="tabpanel"
                                aria-labelledby="wizard2-tab">
                                <div class="row justify-content-center">
                                    <div class="col-xxl-14 col-xl-14">
                                        <h3 class="text-primary"></h3>
                                        <h5 class="card-title mb-4"></h5>
                                        <div class="container-x1 px-1 mt-n9">
                                            <div class="card mb-4">
                                                <div class="card-header">Amortización</div>

                                                <div class="card-body">
                                                    <div
                                                        class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">

                                                        <div class="dataTable-container">
                                                            <table id="tabla-amortizacion" class="dataTable-table">
                                                                <thead>
                                                                    <tr>
                                                                        <th data-sortable="" style="width: auto"><a
                                                                                href="#"
                                                                                class="dataTable-sorter">NO.</a>
                                                                        </th>
                                                                        <th data-sortable=""
                                                                            style="text-align: center;"><a href=" #"
                                                                                class="dataTable-sorter">FECHA</a>
                                                                        </th>
                                                                        <th data-sortable=""
                                                                            style="text-align: center;"><a href="#"
                                                                                class="dataTable-sorter">CUOTA</a>
                                                                        </th>
                                                                        <th data-sortable=""
                                                                            style="text-align: center;"><a href=" #"
                                                                                class="dataTable-sorter">AB.CAPITAL</a>
                                                                        </th>
                                                                        <th data-sortable=""
                                                                            style="text-align: center;"><a href=" #"
                                                                                class="dataTable-sorter">AB.INTERES</a>
                                                                        </th>
                                                                        <th data-sortable=""
                                                                            style="text-align: center;"><a href=" #"
                                                                                class="dataTable-sorter">SDO.CAPITAL</a>
                                                                        </th>
                                                                        <th data-sortable=""
                                                                            style="text-align: center;"><a href=" #"
                                                                                class="dataTable-sorter"><span
                                                                                    id="val_seg">0</span>% -
                                                                                SEGUR</a>
                                                                        </th>
                                                                        <th data-sortable=""
                                                                            style="text-align: center;"><a href=" #"
                                                                                class="dataTable-sorter"><span
                                                                                    id="val_fondo">0</span>% -
                                                                                FOND</a>
                                                                        </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-between">
                                                        <a onclick="javascript: window.history.back();"
                                                            class="btn btn-muted" type="button"></a>
                                                        <!-- <button class="btn btn-warning" type="button" id="btn-calcular">Calcular</button> -->
                                                        <input class="btn btn-warning" type="button" id="btn-next"
                                                            value="Ver simulación quincenal">
                                                        </input>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Wizard tab pane item 4-->
                            <div class="tab-pane py-6 py-xl-9 fade" id="wizard4" role="tabpanel"
                                aria-labelledby="wizard4-tab">
                                <div class="row justify-content-center">
                                    <div class="col-xxl-14 col-xl-14">
                                        <h3 class="text-primary"></h3>
                                        <h5 class="card-title mb-4"></h5>
                                        <div class="container-x1 px-1 mt-n9">
                                            <div class="card mb-4">
                                                <div class="card-header">Amortización</div>

                                                <div class="card-body">
                                                    <div
                                                        class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">

                                                        <div class="dataTable-container">
                                                            <table id="tabla-amortizacion" class="dataTable-table">
                                                                <thead>
                                                                    <tr>
                                                                        <th data-sortable="" style="width: auto"><a
                                                                                href="#"
                                                                                class="dataTable-sorter">NO.</a>
                                                                        </th>
                                                                        <th data-sortable=""
                                                                            style="text-align: center;"><a href=" #"
                                                                                class="dataTable-sorter">FECHA</a>
                                                                        </th>
                                                                        <th data-sortable=""
                                                                            style="text-align: center;"><a href="#"
                                                                                class="dataTable-sorter">CUOTA</a>
                                                                        </th>
                                                                        <th data-sortable=""
                                                                            style="text-align: center;"><a href=" #"
                                                                                class="dataTable-sorter">AB.CAPITAL</a>
                                                                        </th>
                                                                        <th data-sortable=""
                                                                            style="text-align: center;"><a href=" #"
                                                                                class="dataTable-sorter">AB.INTERES</a>
                                                                        </th>
                                                                        <th data-sortable=""
                                                                            style="text-align: center;"><a href=" #"
                                                                                class="dataTable-sorter">SDO.CAPITAL</a>
                                                                        </th>
                                                                        <th data-sortable=""
                                                                            style="text-align: center;"><a href=" #"
                                                                                class="dataTable-sorter"><span
                                                                                    id="val_seg">0</span>% -
                                                                                SEGUR</a>
                                                                        </th>
                                                                        <th data-sortable=""
                                                                            style="text-align: center;"><a href=" #"
                                                                                class="dataTable-sorter"><span
                                                                                    id="val_fondo">0</span>% -
                                                                                FOND</a>
                                                                        </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-between">
                                                        <a onclick="javascript: window.history.back();"
                                                            class="btn btn-muted" type="button"></a>
                                                        <!-- <button class="btn btn-warning" type="button" id="btn-calcular">Calcular</button> -->
                                                        <input class="btn btn-warning" type="button" id="btn-info"
                                                            value="Enviar solicitud">
                                                        </input>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Wizard tab pane item 3-->
                            <div class="tab-pane py-5 py-xl-10 fade" id="wizard3" role="tabpanel"
                                aria-labelledby="wizard3-tab">
                                <div class="row justify-content-center">
                                    <div class="col-xxl-6 col-xl-8">
                                        <h3 class="text-primary">Complete su información</h3>

                                        <div class="row gx-3">
                                            <div class="mb-3 col-md-6">
                                                <label class="small mb-1" for="names">Nombres</label>
                                                <input class="form-control" id="names" type="text" name="names"
                                                    placeholder="Introduzca sus nombres" value="" require />
                                            </div>
                                            <div class=" mb-3 col-md-6">
                                                <label class="small mb-1" for="surnames">Apellidos</label>
                                                <input class="form-control" id="surnames" type="text" name="lastname"
                                                    placeholder="Introduzca sus apellidos" value="" />
                                            </div>
                                        </div>
                                        <div class="row gx-3">
                                            <div class="mb-3 col-md-6">
                                                <label class="small mb-1" for="TypeDocument"
                                                    id="TypeDocument">Seleccione tipo
                                                    de
                                                    documento</label>
                                                <select class="form-select" aria-label="Default select example"
                                                    name="typeDocument">
                                                    <option selected disabled>Seleccionar</option>
                                                    <option value="Cedula ciudadania">Cedula ciudadania</option>
                                                    <option value="Pasaporte">Pasaporte</option>
                                                    <option value="Licencia">Licencia</option>
                                                </select>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="small mb-1" for="inputUsername">Numero de
                                                    documento</label>
                                                <input class="form-control" id="inputNumberDocument" type="number"
                                                    name="numberDocument" placeholder="Introduzca número de documento"
                                                    value="" />
                                            </div>
                                        </div>
                                        <div class="row gx-3">
                                            <div class="col-md-6 mb-md-0">
                                                <label class="small mb-1" for="inputPhone">Numero de
                                                    telefono</label>
                                                <input class="form-control" id="inputPhone" type="tel" name="phone"
                                                    placeholder="Introduzca un número de telefono" value="" />
                                            </div>
                                            <div class="col-md-6 mb-0">
                                                <label class="small mb-1" for="inputEmail">Correo
                                                    electronico</label>
                                                <input class="form-control" id="inputEmail" type="email" name="email"
                                                    placeholder="Introduzca un correo electronico" value="" />
                                            </div>
                                        </div>
                                        <hr class="my-4" />
                                        <div class="d-flex justify-content-between">
                                            <a onclick="javascript: window.history.back();" class="btn btn-muted"
                                                type="button"></a>
                                            <input class="btn btn-warning" type="submit" value="Finalizar"
                                                name="enviar"></input>
                                        </div>
                                        </form>
                                        <?
                                        include("correo.php");
                                        ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </main>
        <footer class="footer-admin mt-auto footer-light">
            <div class="container-xl px-4">
                <div class="row">
                    <div class="col-md-6 small">Copyright &copy; FONAVIEMCALI 2021</div>
                    <div class="col-md-6 text-md-end small">
                        Sitio desarrollado por
                        <a href="https://cohett.com" target="_new">Cohett</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="assets/js/scripts.js"></script>
    <script src="assets/js/moment.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>

        function changeTab1() {
            var notNext = document.getElementById("wizard2-tab")
            notNext.disabled = false;
        }

        function changeTab2(){
            var notNext2 = document.getElementById("wizard3-tab")
            notNext2.disabled = false;
        }

        function changeTab3() {
            var notNext3 = document.getElementById("wizard4-tab")
            notNext3.disabled = false;
        }

        var monto_max = 0;
        var plazos = 0;
        var tasa = 0;
        var fondo_mutual = 0;
        var seguro_linea = 0;

        $('#btn-calcular').click(function (event) {

            changeTab1();
            event.preventDefault();

            if ($("#form-simulacion1")[0].checkValidity()) {

                //console.log(tasa);
                setAmortizacion30Day();

                $("#wizard2-tab")[0].click();

            } else
                $("#form-simulacion1")[0].reportValidity()
        });

        $('#btn-info').click(function (event) {

            changeTab2();
            event.preventDefault();

            if ($("#form-simulacion1")[0].checkValidity()) {

                //console.log(tasa);
                //setAmortizacion();

                $("#wizard3-tab")[0].click();


            } else
                $("#form-simulacion1")[0].reportValidity()
        });

        $('#btn-next').click(function (event) {

            changeTab3();
            event.preventDefault();

            if ($("#form-simulacion1")[0].checkValidity()) {

                //console.log(tasa);
                setAmortizacion15Day();

                $("#wizard4-tab")[0].click();


            } else
                $("#form-simulacion1")[0].reportValidity()
        });

        $('#credito').change(function () {
            var id = $(this).val()

            $.ajax({
                method: 'POST',
                url: 'Simulacion2/' + id,
                data: {
                    id: id
                },
                dataType: 'json',
                async: false,
                success: function (data) {
                    console.log(data);

                    monto_max = data[0].monto_max;
                    plazos = data[0].plazos;
                    tasa = data[0].tasa;
                    fondo_mutual = data[0].fondo_mutual;
                    seguro_linea = data[0].seguro_linea;

                    $('#montoCredito').attr('max', monto_max);
                    $('#plazoCredito').attr('max', plazos);
                    $('#val_fondo').text(fondo_mutual);
                    $('#val_seg').text(seguro_linea);

                }
            });

        });


        function setAmortizacion30Day() {
            var tabla = $('#tabla-amortizacion tbody');
            var plazo = $('#plazoCredito').val();
            var monto = $('#montoCredito').val();

            var filas = "";
            var fecha = moment().format("DD/MM/YYYY");

            var cuota_fija = 0;
            var cuota = 0;
            var saldo = monto;
            var abono_capital = 0;
            var abono_interes = 0;
            var fee_fondo_mutual = 0;
            var fee_seguro = 0;
            let tasa2 = convertTasa(tasa, 12);

            cuota_fija = calculateFixedFee(monto, tasa2, plazo);
            //fee_fondo_mutual = 


            filas += '<tr>' +
                '<td style="text-align: right;">0</td>' +
                '<td style="text-align: right;">' + fecha + '</td>' +
                '<td style="text-align: right;">0</td>' +
                '<td style="text-align: right;">0</td>' +
                '<td style="text-align: right;">0</td>' +
                '<td style="text-align: right;">' + currency(saldo) + '</td>' +
                '<td style="text-align: right;">0</td>' +
                '<td style="text-align: right;">0</td>' +
                '</tr>';

            for (x = 1; x <= plazo; x++) {

                // aquí calcular las variables
                abono_interes = saldo * tasa2;
                abono_capital = cuota_fija - abono_interes;
                fee_seguro = saldo * (seguro_linea / 100);
                fee_fondo_mutual = saldo * (fondo_mutual / 100);

                saldo = saldo - abono_capital;
                cuota = abono_capital + abono_interes + fee_seguro + fee_fondo_mutual;
                fecha = moment().add(x, 'M').format("DD/MM/YYYY");

                filas += '<tr>' +
                    '<td style="text-align: right;">' + x + '</td>' +
                    '<td style="text-align: right;">' + fecha + '</td>' +
                    '<td style="text-align: right;">' + currency(cuota) + '</td>' +
                    '<td style="text-align: right;">' + currency(abono_capital) + '</td>' +
                    '<td style="text-align: right;">' + currency(abono_interes) + '</td>' +
                    '<td style="text-align: right;">' + currency(saldo) + '</td>' +
                    '<td style="text-align: right;">' + currency(fee_seguro) + '</td>' +
                    '<td style="text-align: right;">' + currency(fee_fondo_mutual) + '</td>' +
                    '</tr>';

                monto = monto - cuota;
            }

            tabla.html(filas);

        }

        function setAmortizacion15Day() {
            var tabla = $('#tabla-amortizacion tbody');
            var plazo = ($('#plazoCredito').val())*2;
            var monto = $('#montoCredito').val();

            var filas = "";
            var fecha = moment().format("DD/MM/YYYY");

            var cuota_fija = 0;
            var cuota = 0;
            var saldo = monto;
            var abono_capital = 0;
            var abono_interes = 0;
            var fee_fondo_mutual = 0;
            var fee_seguro = 0;
            let tasa2 = convertTasa(tasa, 24);

            cuota_fija = calculateFixedFee(monto, tasa2, plazo);
            //fee_fondo_mutual = 


            filas += '<tr>' +
                '<td style="text-align: right;">0</td>' +
                '<td style="text-align: right;">' + fecha + '</td>' +
                '<td style="text-align: right;">0</td>' +
                '<td style="text-align: right;">0</td>' +
                '<td style="text-align: right;">0</td>' +
                '<td style="text-align: right;">' + currency(saldo) + '</td>' +
                '<td style="text-align: right;">0</td>' +
                '<td style="text-align: right;">0</td>' +
                '</tr>';

            for (x = 1; x <= plazo; x++) {

                // aquí calcular las variables
                abono_interes = saldo * tasa2;
                abono_capital = cuota_fija - abono_interes;
                fee_seguro = (saldo * (seguro_linea / 100))/2;
                fee_fondo_mutual = (saldo * (fondo_mutual / 100))/2;

                saldo = saldo - abono_capital;
                cuota = abono_capital + abono_interes + fee_seguro + fee_fondo_mutual;
                fecha = moment().add(x * 15, 'days').format("DD/MM/YYYY");

                filas += '<tr>' +
                    '<td style="text-align: right;">' + x + '</td>' +
                    '<td style="text-align: right;">' + fecha + '</td>' +
                    '<td style="text-align: right;">' + currency(cuota) + '</td>' +
                    '<td style="text-align: right;">' + currency(abono_capital) + '</td>' +
                    '<td style="text-align: right;">' + currency(abono_interes) + '</td>' +
                    '<td style="text-align: right;">' + currency(saldo) + '</td>' +
                    '<td style="text-align: right;">' + currency(fee_seguro) + '</td>' +
                    '<td style="text-align: right;">' + currency(fee_fondo_mutual) + '</td>' +
                    '</tr>';

                monto = monto - cuota;
            }

            tabla.html(filas);

        }

        function calculateFixedFee(monto, tasa, plazo) {

            return monto * ((tasa * Math.pow((1 + tasa), plazo)) / (Math.pow((1 + tasa), plazo) - 1));
        }

        function currency(value) {
            return new Intl.NumberFormat('es-ES', {
                style: 'currency',
                currency: 'COP',
                minimumFractionDigits: 2
            }).format(value);
        }

        function convertTasa(tasa_anual, periodos) {
            return (tasa_anual/periodos) / 100;
        }
    </script>

</html>
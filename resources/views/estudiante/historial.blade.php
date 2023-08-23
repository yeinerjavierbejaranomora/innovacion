@include('layout.header')

<style>
    #facultades {
        font-size: 14px;
    }

    #programas {
        font-size: 14px;
    }

    #generarReporte {
        margin-left: 260px;
    }


    .btn {
        background-color: #dfc14e;
        border-color: #dfc14e;
        color: white;
        width: 200px;
        height: 30px;
        border-radius: 10px;
        font-weight: bold;
        place-items: center;
        font-size: 14px;
    }

    #botonModalProgramas,
    #botonModalOperador {
        background-color: #dfc14e;
        border-color: #dfc14e;
        color: white;
        width: 100px;
        height: 30px;
        border-radius: 10px;
        font-weight: bold;
        place-items: center;
        font-size: 14px;
    }

    #cardFacultades {
        min-height: 405.6px;
        max-height: 405.6px;
    }

    #cardProgramas {
        min-height: 405.6px;
        max-height: 405.6px;
    }

    .card {
        margin-bottom: 3%;
    }

    .hidden {
        display: none;
    }

    #chartEstudiantes {
        min-height: 405.6px;
        max-height: 405.6px;
    }

    #centrar {
        display: flex;
        align-items: center;
    }

    .graficos {
        min-height: 460px;
        max-height: 460px;
    }

    #operadoresTotal,
    #programasTotal {
        height: 600px !important;
    }

</style>
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>
        </nav>
        <div class="container-fluid">
            <div class="container mt-3" id="info">
                <p class="col-md-12" style="margin-top: 2%;">
                    <strong>Historial académico de: </strong> {{ $nombre}}<br>
                    <strong>IdBanner</strong>: {{ $estudiante->homologante}}<br>

                    <b> Recuerde que la información suministrada por este sistema es de carácter informativo.</b> <br>
                    Nota: si el periodo ha finalizado las calificaciones pueden tardar alrededor de 5 días para verse reflejadas en el historial.
                </p>
            </div>
        </div>
        <div class="container-fluid">
            <div class="container mt-3">
                <div class="row py-5" id="botones">
                    <div class="col 4 text-center">
                        <a type="button" class="btn boton" onclick="consultaMalla('${data.programa}');">
                            Malla curricular
                        </a>
                    </div>
                    <div class="col 4 text-center">
                        <a type="button" class="btn boton" onclick="consultaHistorial(${data.homologante});">
                            Historial academico
                        </a>
                    </div>
                    <div class="col 4 text-center">
                        <a type="button"class="btn boton" onclick="consultaProgramacion(${data.homologante});">
                            Programado
                        </a>
                    </div>
                    <div class="col 4 text-center">
                        <a type="button"class="btn boton" onclick="consultaPorVer(${data.homologante});">
                            Materias Por Ver
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


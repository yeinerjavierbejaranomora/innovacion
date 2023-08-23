<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstudianteController extends Controller
{
    //

    public function inicio()
    {
        return view('estudiante.index');
    }

    public function consultaProgramas()
    {
        $estudiante = $_POST['codBanner'];
        $url = "https://services.ibero.edu.co/utilitary/v1/MoodleAulaVirtual/GetPersonByIdBannerQuery/" . $estudiante;
        $historialAcademico = json_decode(file_get_contents($url), true);
        $programa = [];

        $consultaEstudiante = DB::table('estudiantes')->where('homologante', '=', $estudiante)->get();
        //var_dump($consultaEstudiante);die();

        if ($historialAcademico) {

            foreach ($historialAcademico as $key_historialAcademico => $value_historialAcademico) {

                $programa[$value_historialAcademico['cod_programa']] = ['codprograma'=>$value_historialAcademico['cod_programa'],'programa'=>$value_historialAcademico['programa']];
            }
            $programa = array_column($programa,'codprograma');
            //var_dump($programa);die();
            return $programa;
        }
        /*else {

            $consultaEstudiante = DB::table('estudiantes')->where('homologante', '=', $estudiante)->first();
            return $consultaEstudiante;
        }*/
    }

    public function consultaEstudiante(Request $request){
        //dd($request->codigo);
        $estudiante = $request->codigo;
        $consultaEstudiante = DB::table('estudiantes')->where('homologante','=',$estudiante)->first();
        $url = "https://services.ibero.edu.co/utilitary/v1/MoodleAulaVirtual/GetPersonByIdBannerQuery/" . $estudiante;
        $historialAcademico = json_decode(file_get_contents($url), true);
        $programa = [];

        if ($historialAcademico) {

            foreach ($historialAcademico as $key_historialAcademico => $value_historialAcademico) {

                $programa[$value_historialAcademico['cod_programa']] = ['codprograma'=>$value_historialAcademico['cod_programa'],'programa'=>$value_historialAcademico['programa']];
            }
            $programaCod = array_column($programa,'codprograma');
            $programaNombre = array_column($programa,'programa');
            $programas= [];
            for ($i=0; $i < count($programaCod); $i++) {
                $programas[] = [
                    'cod_programa' => $programaCod[$i],
                    'programa' => $programaNombre[$i],
                ];
            }
            //var_dump($programas);die();
            // return $programa;
        }
        $consultaNombre = $this->consultaNombre($estudiante);
        //var_dump($consultaNombre);die();
        return view('estudiante.historial',['estudiante' => $consultaEstudiante, 'programas' => $programas,'nombre' => $consultaNombre]);
    }

    public function consultaNombre($estudiante)
    {

        $consultaNombre = DB::table('datos_moodle')->where('Id_Banner', '=', $estudiante)->select('Nombre', 'Apellido')->first();
        if ($consultaNombre != NULL) :
            $nombre = $consultaNombre->Nombre . " " . $consultaNombre->Apellido;
        else :
            $consultaNombre = DB::table('historialAcademico')->where('codBanner', '=', $estudiante)->select('nombreEst')->first();
            if ($consultaNombre != NULL) :
                $nombre = $consultaNombre->nombreEst;
            else :
                $consultaNombre = DB::table('estudiantes')->where('homologante', '=', $estudiante)->select('nombre')->first();
                $nombre = $consultaNombre->nombre;
            endif;
        endif;
        return $nombre;
    }

    public function consultaMalla()
    {
        $programa = $_POST['programa'];
        $codBanner = $_POST['codBanner'];
        $mallaCurricular = DB::table('mallaCurricular')->where('codprograma', '=', $programa)->get()->toArray();
        var_dump($mallaCurricular);die();
        return $mallaCurricular;
    }

    public function consultaHistorial()
    {
        $estudiante = $_POST['codBanner'];
        $url = "https://services.ibero.edu.co/utilitary/v1/MoodleAulaVirtual/GetPersonByIdBannerQuery/" . $estudiante;
        $historialAcademico = json_decode(file_get_contents($url), true);
        return $historialAcademico;
    }
    public function consultaProgramacion()
    {
        $estudiante = $_POST['codBanner'];
        $programacion = DB::table('programacion')->where('codBanner', '=', $estudiante)->get();
        return $programacion;
    }

    public function consultaPorVer()
    {
        $estudiante = $_POST['codBanner'];
        $consultaPorVer = DB::table('materiasPorVer')->where('codBanner', '=', $estudiante)->get();
        return $consultaPorVer;
    }

    public function countSemestres()
    {
        $programa = $_POST['programa'];
        $consultacountSemestres = DB::table('mallaCurricular')->where('codprograma', '=', $programa)->groupBy('semestre')->get();
        var_dump($consultacountSemestres);
        die();
    }
}

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

    //public function consultaEstudiante(Request $request){
    public function consultaEstudiante(){
        //dd($request->codigo);
        //$estudiante = $request->codigo;
        $estudiante = $_POST['codBanner'];
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
            
        }
        //$consultaNombre = $this->consultaNombre($estudiante);
        //var_dump($consultaNombre);die();
        //return view('estudiante.historial',['estudiante' => $consultaEstudiante, 'programas' => $programas,'nombre' => $consultaNombre]);
        return $programas;
    }

    public function consultaNombre()
    {
        $estudiante = $_POST['codBanner'];
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
        $idbanner = $_POST['codBanner'];
        $programa = $_POST['programa'];

      
        $url = "https://services.ibero.edu.co/utilitary/v1/MoodleAulaVirtual/GetPersonByIdBannerQuery/" . $idbanner;
        
        $historialAcademico = json_decode(file_get_contents($url), true);
        $mallaCurricular = DB::table('mallaCurricular')->where('codprograma', '=', $programa)->get()->toArray();
        
        /*utilizamos la función array_filter() y in_array() para filtrar los elementos de $array1 que existen en $array2. El resultado se almacena en $intersection. Luego, verificamos si $intersection contiene al menos un elemento utilizando count($intersection) > 0.*/

        foreach ( $mallaCurricular as $key_mallaCurricular => $value_mallaCurricular) {
            $materias_malla[]=$value_mallaCurricular->codigoCurso;
        }
                    

        foreach ($historialAcademico as $key_historialAcademico => $value_historialAcademico) {
           
            if( $value_historialAcademico['cod_programa']==$programa){
            
                $historial_programa[]=$value_historialAcademico;
                $materias_vistas[]=$value_historialAcademico['idCurso'];

            }
           
        }
       
        $intersection = array_filter($materias_vistas, function ($item) use ($materias_malla) {
            return in_array($item, $materias_malla);
        });
      
        var_dump( $materias_malla);
        exit;
        $diff = array_udiff($materias_vistas, $materias_malla, function($a, $b) {
            return $a['name'] <=> $b['name'];
        });
        var_dump( $diff);
        exit;
        dd($diff);

        

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

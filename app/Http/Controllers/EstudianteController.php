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
            $materias_malla[$value_mallaCurricular->codigoCurso]=array(
                'codigo_materia'=>$value_mallaCurricular->codigoCurso,
                'semestre'=>$value_mallaCurricular->semestre,
                'creditos'=>$value_mallaCurricular->creditos,
                'ciclo'=>$value_mallaCurricular->ciclo,
                'nombre_materia'=>$value_mallaCurricular->curso,
                'calificacion'=>"",
                'color'=>'bg-secondary',
               
            );

        }
        foreach ($historialAcademico as $key_historialAcademico => $value_historialAcademico) {
            // array:15 [ // app/Http/Controllers/EstudianteController.php:126
            //     "estudiante" => "CUEVAS MARTINEZ RODRIGO "
            //     "bannerID" => "100039616"
            //     "pidm" => "69631"
            //     "identificacion" => "1024473823"
            //     "programa" => "DIP SEG Y SALUD TRA RIES P VIR"
            //     "cod_programa" => "DSRV"
            //     "termino" => "202108"
            //     "tipoEstudiante" => "OPCION DE GRADO"
            //     "idCurso" => "DSRV02100"
            //     "tipoNota" => ""
            //     "materia" => "CUR-DIP SEG SAL TRAB RIESO PSI VIR"
            //     "nrc" => "7049"
            //     "repito" => "NO"
            //     "calificacion" => "3,90"
            //     "creditos" => 6
            //   ]
           

            if( $value_historialAcademico['cod_programa']==$programa){
            
                if(isset($materias_malla[$value_historialAcademico['idCurso']])){

                    if( $value_historialAcademico['calificacion']>3){
                        $color='bg-success';
                    }else{
                        $color='bg-danger';
                    }
                    $materias_malla[$value_historialAcademico['idCurso']]['calificacion']=$value_historialAcademico['calificacion'];
                    $materias_malla[$value_historialAcademico['idCurso']]['color']=$color;

                  
                   
                 }

                $historial_programa[]=$value_historialAcademico;
                

            }
           
        }
        
                    

      dd( $materias_malla);
      exit;
       
        $intersection = array_filter($materias_vistas, function ($item) use ($materias_malla) {
            return in_array($item, $materias_malla);
        });
      
        
        $diff = array_udiff($materias_vistas, $materias_malla, function($a, $b) {
            return $a<=> $b;
        });


   dd($materias_vistas);
   exit;
        dd($diff);
        exit;
        

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

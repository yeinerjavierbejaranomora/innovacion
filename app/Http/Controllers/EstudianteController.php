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

        $proyectada=[];
        $url = "https://services.ibero.edu.co/utilitary/v1/MoodleAulaVirtual/GetPersonByIdBannerQuery/".$idbanner;
        
        $historialAcademico = json_decode(file_get_contents($url), true);

       
        $mallaCurricular = DB::table('mallaCurricular')
                                ->where('codprograma', '=', $programa)
                                ->orderBy('semestre', 'ASC')
                                ->get()
                                ->toArray();

       
        $proyectada=DB::table('programacion')->where('codBanner', '=', $idbanner)->get()->toArray();
        $materiasPorVer=DB::table('materiasPorVer')->where('codBanner', '=', $idbanner)->get()->toArray();

        $moodle=DB::table('datos_moodle')->where('id_Banner', '=', $idbanner)->get()->toArray();
    
        $historial=[];
        $proyectada=[]; 

        if(empty($proyectada)){
            $proyectada = DB::table('planeacion')->where('codBanner', '=', $idbanner)->get()->toArray();
        }

      
        
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
                'cursada'=>'',
                'por_ver'=>'',
                'programada'=>'',
                'moodle'=>'',
               
            );

        }

        if(!empty($historialAcademico)){

            foreach ($historialAcademico as $key_historialAcademico => $value_historialAcademico) {

                if( $value_historialAcademico['cod_programa']==$programa){

                    if(isset($materias_malla[$value_historialAcademico['idCurso']])){

                        $historial[]=$materias_malla[$value_historialAcademico['idCurso']];

                        if( $value_historialAcademico['calificacion']>3){
                            $color='bg-success';
                            $Cursada='aprobada';
                            $porver='Vista';
                        }else{
                            $color='bg-danger';
                            $Cursada='perdida';
                            $porver='';
                        }
                        $materias_malla[$value_historialAcademico['idCurso']]['calificacion']=$value_historialAcademico['calificacion'];
                        $materias_malla[$value_historialAcademico['idCurso']]['color']=$color;
                        $materias_malla[$value_historialAcademico['idCurso']]['cursada']=$Cursada;
                        $materias_malla[$value_historialAcademico['idCurso']]['por_ver']= $porver;
                 

                    }
                    
                }

            }
        }      
       
        if(!empty($materiasPorVer)):

            foreach ($materiasPorVer as $key_materiasPorVer => $value_materiasPorVer) {
              

               if(isset($materias_malla[$value_materiasPorVer->codMateria])){
                   
                    $materias_malla[$value_historialAcademico['idCurso']]['cursada']="";
                    $materias_malla[$value_historialAcademico['idCurso']]['por_ver']= "Por ver";
               }

             
            }
           

        endif;

        if(!empty($proyectada)):

            foreach ($materiasPorVer as $key_materiasPorVer => $value_materiasPorVer) {

               if(isset($materias_malla[$value_materiasPorVer->codMateria])){
                
                    $materias_malla[$value_historialAcademico['idCurso']]['color']="bg-warning";
                    $materias_malla[$value_historialAcademico['idCurso']]['cursada']="";
                    $materias_malla[$value_historialAcademico['idCurso']]['por_ver']= "Por ver";
               }

             
            }
           

        endif;

        if(!empty($moodle)):
            foreach ($materiasPorVer as $key_materiasPorVer => $value_materiasPorVer) {

                if(isset($materias_malla[$value_materiasPorVer->codMateria])){
                    $materias_malla[$value_historialAcademico['idCurso']]['color']="bg-info";
                    $materias_malla[$value_historialAcademico['idCurso']]['cursada']="";
                    $materias_malla[$value_historialAcademico['idCurso']]['por_ver']= "Viendo";
                }
 
              
            }

        endif;
        dd($materias_malla);
        exit;
        $data=array(
            'historial'=> $historial,
            'malla'=>$materias_malla,
            'proyectada'=>$proyectada,
            'materias por ver'=>''
        );

        dd($value_materiasPorVer);
        exit;
        return $data;
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

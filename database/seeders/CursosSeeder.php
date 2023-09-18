<?php

namespace Database\Seeders;

use App\Models\Academia\Cursos\Area;
use App\Models\Academia\Cursos\Carrera;
use App\Models\Academia\Cursos\Facultad;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CursosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try{
            DB::beginTransaction();
            $areaA = Area::create([
                'nombre' => 'A',
                'descripcion' => 'ciencia de la vida y de la salud',
                'slug' => 'area-a'
            ]);
    
            $areaB = Area::create([
                'nombre' => 'B',
                'descripcion' => 'ciencias básicas y tecnológicas',
                'slug' => 'area-b'
            ]);
    
            $areaC = Area::create([
                'nombre' => 'C',
                'descripcion' => 'ciencias de la persona',
                'slug' => 'area-c'
            ]);
    
            $areaD = Area::create([
                'nombre' => 'D',
                'descripcion' => 'ciencias económicas',
                'slug' => 'area-d'
            ]);
    
            $this->carrerasYFacultadesAreaA($areaA);
            $this->carrerasYFacultadesAreaB($areaB);
            $this->carrerasYFacultadesAreaC($areaC);
            $this->carrerasYFacultadesAreaD($areaD);
            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
            echo $e->getMessage();
        }
        // Areas



    }

    private function carrerasYFacultadesAreaA(Area $areaA){
        // Area A relleno
        

        // -------


        $enfermeria = Facultad::create([
            'nombre' => 'facultad de enfermería',
            'descripcion' => 'facultad de enfermería',
            'slug' => 'facultad-de-enfermeria'
        ]);

        // -- Carreras

        Carrera::create([
            'nombre' => 'enfermeria',
            'descripcion' => 'enfermeria',
            'slug' => 'enfermeria',
            'idarea' => $areaA->id,
            'idfacultad' => $enfermeria->id
        ]);

        // -------
        // Facultad :FACULTAD DE FARMACIA Y BIOQUIMICA
        // Carreras: [FARMACIA Y BIOQUÍMICA]

        $farmaciaBioquimica = Facultad::create([
            'nombre' => 'facultad de farmacia y bioquimica',
            'descripcion' => 'facultad de farmacia y bioquimica',
            'slug' => 'facultad-de-farmacia-y-bioquimica'
        ]);

        // -- Carreras

        Carrera::create([
            'nombre' => 'farmacia y bioquímica',
            'descripcion' => 'farmacia y bioquímica',
            'slug' => 'farmacia-y-bioquimica',
            'idarea' => $areaA->id,
            'idfacultad' => $farmaciaBioquimica->id
        ]);

        // -------
        // Facultad :FACULTAD DE MEDICINA
        // Carreras: [MEDICINA]

        $medicina = Facultad::create([
            'nombre' => 'facultad de medicina',
            'descripcion' => 'facultad de medicina',
            'slug' => 'facultad-de-medicina'
        ]);

        // -- Carreras

        Carrera::create([
            'nombre' => 'medicina',
            'descripcion' => 'medicina',
            'slug' => 'medicina',
            'idarea' => $areaA->id,
            'idfacultad' => $medicina->id
        ]);

        // -------
        // Facultad :FACULTAD DE CIENCIAS BIOLOGICAS
        // Carreras: [MICROBIOLOGÍA Y PARASITOLOGÍA, BIOLOGÍA PESQUERA, CIENCIAS BIOLÓGICAS]

        $cienciasBiologicas = Facultad::create([
            'nombre' => 'facultad de ciencias biologicas',
            'descripcion' => 'facultad de ciencias biologicas',
            'slug' => 'facultad-de-ciencias-biologicas'
        ]);

        // -- Carreras

        Carrera::create([
            'nombre' => 'microbiología y parasitología',
            'descripcion' => 'microbiología y parasitología',
            'slug' => 'microbiologia-y-parasitologia',
            'idarea' => $areaA->id,
            'idfacultad' => $cienciasBiologicas->id
        ]);

        // -------
        // Facultad :FACULTAD DE ESTOMATOLOGÍA
        // Carreras: [ESTOMATOLOGÍA]

        $estomatologia = Facultad::create([
            'nombre' => 'facultad de estomatologia',
            'descripcion' => 'facultad de estomatologia',
            'slug' => 'facultad-de-estomatologia'
        ]);

        // -- Carreras

        Carrera::create([
            'nombre' => 'estomatologia',
            'descripcion' => 'estomatologia',
            'slug' => 'estomatologia',
            'idarea' => $areaA->id,
            'idfacultad' => $estomatologia->id
        ]);
    }

    private function carrerasYFacultadesAreaB(Area $areaB) {
        // -------
        // Facultad :FACULTAD DE CIENCIAS FÍSICAS Y MATEMÁTICAS
        // Carreras: [ESTADÍSTICA, FÍSICA, MATEMÁTICAS, INFORMÁTICA]

        $cienciasFisicasMatematicas = Facultad::create([
            'nombre' => 'facultad de ciencias fisicas y matematicas',
            'descripcion' => 'facultad de ciencias fisicas y matematicas',
            'slug' => 'facultad-de-ciencias-fisicas-y-matematicas'
        ]);

        // -- Carreras

        Carrera::create([
            'nombre' => 'estadística',
            'descripcion' => 'estadística',
            'slug' => 'estadistica',
            'idarea' => $areaB->id,
            'idfacultad' => $cienciasFisicasMatematicas->id
        ]);

        Carrera::create([
            'nombre' => 'física',
            'descripcion' => 'física',
            'slug' => 'fisica',
            'idarea' => $areaB->id,
            'idfacultad' => $cienciasFisicasMatematicas->id
        ]);

        Carrera::create([
            'nombre' => 'matemáticas',
            'descripcion' => 'matemáticas',
            'slug' => 'matematicas',
            'idarea' => $areaB->id,
            'idfacultad' => $cienciasFisicasMatematicas->id
        ]);

        Carrera::create([
            'nombre' => 'informática',
            'descripcion' => 'informática',
            'slug' => 'informatica',
            'idarea' => $areaB->id,
            'idfacultad' => $cienciasFisicasMatematicas->id
        ]);

        // -------
        // Facultad :FACULTAD DE INGENIERÍA
        // Carreras: [INGENIERÍA INDUSTRIAL, INGENIERÍA MECÁNICA, INGENÍERIA METALÚRGICA, INGENIERÍA DE SISTEMAS, INGENIERÍA DE MINAS, INGENIERÍA DE MATERIALES, INGENIERÍA MECATRÓNICA, INGENIERÍA CIVIL, ARQUITECTURA Y URBANISMO]

        $ingenieria = Facultad::create([
            'nombre' => 'facultad de ingenieria',
            'descripcion' => 'facultad de ingenieria',
            'slug' => 'facultad-de-ingenieria'
        ]);

        // -- Carreras

        Carrera::create([
            'nombre' => 'ingeniería industrial',
            'descripcion' => 'ingeniería industrial',
            'slug' => 'ingenieria-industrial',
            'idarea' => $areaB->id,
            'idfacultad' => $ingenieria->id
        ]);

        Carrera::create([
            'nombre' => 'ingeniería mecánica',
            'descripcion' => 'ingeniería mecánica',
            'slug' => 'ingenieria-mecanica',
            'idarea' => $areaB->id,
            'idfacultad' => $ingenieria->id
        ]);

        Carrera::create([
            'nombre' => 'ingeniería metalúrgica',
            'descripcion' => 'ingeniería metalúrgica',
            'slug' => 'ingenieria-metalurgica',
            'idarea' => $areaB->id,
            'idfacultad' => $ingenieria->id
        ]);

        Carrera::create([
            'nombre' => 'ingeniería de sistemas',
            'descripcion' => 'ingeniería de sistemas',
            'slug' => 'ingenieria-de-sistemas',
            'idarea' => $areaB->id,
            'idfacultad' => $ingenieria->id
        ]);

        Carrera::create([
            'nombre' => 'ingeniería de minas',
            'descripcion' => 'ingeniería de minas',
            'slug' => 'ingenieria-de-minas',
            'idarea' => $areaB->id,
            'idfacultad' => $ingenieria->id
        ]);

        Carrera::create([
            'nombre' => 'ingeniería de materiales',
            'descripcion' => 'ingeniería de materiales',
            'slug' => 'ingenieria-de-materiales',
            'idarea' => $areaB->id,
            'idfacultad' => $ingenieria->id
        ]);

        Carrera::create([
            'nombre' => 'ingeniería mecatrónica',
            'descripcion' => 'ingeniería mecatrónica',
            'slug' => 'ingenieria-mecatronica',
            'idarea' => $areaB->id,
            'idfacultad' => $ingenieria->id
        ]);

        Carrera::create([
            'nombre' => 'ingeniería civil',
            'descripcion' => 'ingeniería civil',
            'slug' => 'ingenieria-civil',
            'idarea' => $areaB->id,
            'idfacultad' => $ingenieria->id
        ]);

        Carrera::create([
            'nombre' => 'arquitectura y urbanismo',
            'descripcion' => 'arquitectura y urbanismo',
            'slug' => 'arquitectura-y-urbanismo',
            'idarea' => $areaB->id,
            'idfacultad' => $ingenieria->id
        ]);

        // -------
        // Facultad :FACULTAD DE INGENIERIA QUÍMICA
        // Carreras: [INGENIERÍA QUÍMICA, INGENIERÍA AMBIENTAL]

        $ingenieriaQuimica = Facultad::create([
            'nombre' => 'facultad de ingenieria quimica',
            'descripcion' => 'facultad de ingenieria quimica',
            'slug' => 'facultad-de-ingenieria-quimica'
        ]);

        // -- Carreras

        Carrera::create([
            'nombre' => 'ingeniería química',
            'descripcion' => 'ingeniería química',
            'slug' => 'ingenieria-quimica',
            'idarea' => $areaB->id,
            'idfacultad' => $ingenieriaQuimica->id
        ]);

        Carrera::create([
            'nombre' => 'ingeniería ambiental',
            'descripcion' => 'ingeniería ambiental',
            'slug' => 'ingenieria-ambiental',
            'idarea' => $areaB->id,
            'idfacultad' => $ingenieriaQuimica->id
        ]);

        // -------
        // Facultad :FACULTAD DE CIENCIAS AGROPECUARIAS
        // Carreras: [ZOOTECNIA, INGENIERÍA AGRÍCOLA, INGENIERÍA AGROINDUSTRIAL, AGRONOMÍA]

        $cienciasAgropecuarias = Facultad::create([
            'nombre' => 'facultad de ciencias agropecuarias',
            'descripcion' => 'facultad de ciencias agropecuarias',
            'slug' => 'facultad-de-ciencias-agropecuarias'
        ]);

        // -- Carreras

        Carrera::create([
            'nombre' => 'zootecnia',
            'descripcion' => 'zootecnia',
            'slug' => 'zootecnia',
            'idarea' => $areaB->id,
            'idfacultad' => $cienciasAgropecuarias->id
        ]);

        Carrera::create([
            'nombre' => 'ingeniería agrícola',
            'descripcion' => 'ingeniería agrícola',
            'slug' => 'ingenieria-agricola',
            'idarea' => $areaB->id,
            'idfacultad' => $cienciasAgropecuarias->id
        ]);

        Carrera::create([
            'nombre' => 'ingeniería agroindustrial',
            'descripcion' => 'ingeniería agroindustrial',
            'slug' => 'ingenieria-agroindustrial',
            'idarea' => $areaB->id,
            'idfacultad' => $cienciasAgropecuarias->id
        ]);


    }

    private function carrerasYFacultadesAreaC(Area $areaC) {
        // -------
        // Facultad :FACULTAD DE CIENCIAS SOCIALES
        // Carreras: [ANTROPOLOGÍA, ARQUEOLOGÍA, TRABAJO SOCIAL, TURISMO, HISTORIA]

        $cienciasSociales = Facultad::create([
            'nombre' => 'facultad de ciencias sociales',
            'descripcion' => 'facultad de ciencias sociales',
            'slug' => 'facultad-de-ciencias-sociales'
        ]);

        // -- Carreras

        Carrera::create([
            'nombre' => 'antropología',
            'descripcion' => 'antropología',
            'slug' => 'antropologia',
            'idarea' => $areaC->id,
            'idfacultad' => $cienciasSociales->id
        ]);

        Carrera::create([
            'nombre' => 'arqueología',
            'descripcion' => 'arqueología',
            'slug' => 'arqueologia',
            'idarea' => $areaC->id,
            'idfacultad' => $cienciasSociales->id
        ]);

        Carrera::create([
            'nombre' => 'trabajo social',
            'descripcion' => 'trabajo social',
            'slug' => 'trabajo-social',
            'idarea' => $areaC->id,
            'idfacultad' => $cienciasSociales->id
        ]);

        Carrera::create([
            'nombre' => 'turismo',
            'descripcion' => 'turismo',
            'slug' => 'turismo',
            'idarea' => $areaC->id,
            'idfacultad' => $cienciasSociales->id
        ]);

        Carrera::create([
            'nombre' => 'historia',
            'descripcion' => 'historia',
            'slug' => 'historia',
            'idarea' => $areaC->id,
            'idfacultad' => $cienciasSociales->id
        ]);

        // -------
        // Facultad :FACULTAD DE DERECHO Y CIENCIAS POLÍTICAS
        // Carreras: [DERECHO, CIENCIA POLÍTICA Y GOBERNABILIDAD]

        $derechoCienciasPoliticas = Facultad::create([
            'nombre' => 'facultad de derecho y ciencias politicas',
            'descripcion' => 'facultad de derecho y ciencias politicas',
            'slug' => 'facultad-de-derecho-y-ciencias-politicas'
        ]);

        // -- Carreras

        Carrera::create([
            'nombre' => 'derecho',
            'descripcion' => 'derecho',
            'slug' => 'derecho',
            'idarea' => $areaC->id,
            'idfacultad' => $derechoCienciasPoliticas->id
        ]);

        Carrera::create([
            'nombre' => 'ciencia política y gobernabilidad',
            'descripcion' => 'ciencia política y gobernabilidad',
            'slug' => 'ciencia-politica-y-gobernabilidad',
            'idarea' => $areaC->id,
            'idfacultad' => $derechoCienciasPoliticas->id
        ]);

        // -------
        // Facultad :FACULTAD DE EDUCACIÓN Y CIENCIAS DE LA COMUNICACIÓN
        // Carreras: [EDUCACIÓN INICIAL, EDUCACIÓN PRIMARIA, 
        //      CIENCIAS DE LA COMUNICACIÓN, 
        //      ED.SEC.: FILOSOFÍA, PSICOLOGÍA Y CIENCIAS SOCIALES, 
        //      ED.SEC.: CIENCIAS MATEMÁTICAS, 
        //      ED.SEC.: LENGUA Y LITERATURA, 
        //      ED.SEC.: IDIOMAS: INGLÉS-FRANCÉS, INGLÉS-ALEMÁN, 
        //      ED.SEC.:HISTORIA Y GEOGRAFÍA]

        $educacionCienciasComunicacion = Facultad::create([
            'nombre' => 'facultad de educacion y ciencias de la comunicacion',
            'descripcion' => 'facultad de educacion y ciencias de la comunicacion',
            'slug' => 'facultad-de-educacion-y-ciencias-de-la-comunicacion'
        ]);

        // -- Carreras

        Carrera::create([
            'nombre' => 'educación inicial',
            'descripcion' => 'educación inicial',
            'slug' => 'educacion-inicial',
            'idarea' => $areaC->id,
            'idfacultad' => $educacionCienciasComunicacion->id
        ]);

        Carrera::create([
            'nombre' => 'educación primaria',
            'descripcion' => 'educación primaria',
            'slug' => 'educacion-primaria',
            'idarea' => $areaC->id,
            'idfacultad' => $educacionCienciasComunicacion->id
        ]);

        Carrera::create([
            'nombre' => 'ciencias de la comunicación',
            'descripcion' => 'ciencias de la comunicación',
            'slug' => 'ciencias-de-la-comunicacion',
            'idarea' => $areaC->id,
            'idfacultad' => $educacionCienciasComunicacion->id
        ]);

        Carrera::create([
            'nombre' => 'ed.sec.: filosofía, psicología y ciencias sociales',
            'descripcion' => 'ed.sec.: filosofía, psicología y ciencias sociales',
            'slug' => 'ed-sec-filosofia-psicologia-y-ciencias-sociales',
            'idarea' => $areaC->id,
            'idfacultad' => $educacionCienciasComunicacion->id
        ]);

        Carrera::create([
            'nombre' => 'ed.sec.: ciencias matemáticas',
            'descripcion' => 'ed.sec.: ciencias matemáticas',
            'slug' => 'ed-sec-ciencias-matematicas',
            'idarea' => $areaC->id,
            'idfacultad' => $educacionCienciasComunicacion->id
        ]);

        Carrera::create([
            'nombre' => 'ed.sec.: lengua y literatura',
            'descripcion' => 'ed.sec.: lengua y literatura',
            'slug' => 'ed-sec-lengua-y-literatura',
            'idarea' => $areaC->id,
            'idfacultad' => $educacionCienciasComunicacion->id
        ]);

        Carrera::create([
            'nombre' => 'ed.sec.: idiomas: inglés-francés, inglés-alemán',
            'descripcion' => 'ed.sec.: idiomas: inglés-francés, inglés-alemán',
            'slug' => 'ed-sec-idiomas-ingles-frances-ingles-aleman',
            'idarea' => $areaC->id,
            'idfacultad' => $educacionCienciasComunicacion->id
        ]);

        Carrera::create([
            'nombre' => 'ed.sec.: historia y geografía',
            'descripcion' => 'ed.sec.: historia y geografía',
            'slug' => 'ed-sec-historia-y-geografia',
            'idarea' => $areaC->id,
            'idfacultad' => $educacionCienciasComunicacion->id
        ]);
    }

    private function carrerasYFacultadesAreaD(Area $areaD) {
        // -------
        // Facultad :FACULTAD DE CIENCIAS ECONÓMICAS
        // Carreras: [ADMINISTRACIÓN, CONTABILIDAD Y FINANZAS, ECONOMÍA]

        $cienciasEconomicas = Facultad::create([
            'nombre' => 'facultad de ciencias economicas',
            'descripcion' => 'facultad de ciencias economicas',
            'slug' => 'facultad-de-ciencias-economicas'
        ]);

        // -- Carreras

        Carrera::create([
            'nombre' => 'administración',
            'descripcion' => 'administración',
            'slug' => 'administracion',
            'idarea' => $areaD->id,
            'idfacultad' => $cienciasEconomicas->id
        ]);

        Carrera::create([
            'nombre' => 'contabilidad y finanzas',
            'descripcion' => 'contabilidad y finanzas',
            'slug' => 'contabilidad-y-finanzas',
            'idarea' => $areaD->id,
            'idfacultad' => $cienciasEconomicas->id
        ]);

        Carrera::create([
            'nombre' => 'economía',
            'descripcion' => 'economía',
            'slug' => 'economia',
            'idarea' => $areaD->id,
            'idfacultad' => $cienciasEconomicas->id
        ]);

    }
}

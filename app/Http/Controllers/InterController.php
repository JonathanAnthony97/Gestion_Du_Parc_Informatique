<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Intervention;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Model\AffDepartemnt;
use App\Model\AffUtilisateur;
use App\Model\Materielcategorie;
use Illuminate\Support\Facades\DB;
use App\Model\Materiel;
use App\Model\Maintenance;
use App\Model\Reparation;
use App\Model\Tier;
use App\Model\Panne;
use App\Model\Etat;
use App\Model\Reform;
use App\Model\Vente;
use App\Model\Don;
use App\Model\MaterielReform;
use Response;
use DateTime;
use Excel;

class InterController extends Controller
{

    public function __construct()
    {
         $this->middleware('auth');
    }
        private function algo1($total,$cos){
        $a=1;
        if($total > 0){
                    if($total >= $cos){
                        $b=$cos; 
                    }else{
                        $b=$total;
                    }
                }else{
                    $a=0;
                    $b=$a;
                }
        $tab[] = $a;
        $tab[] = $b;
        return $tab;
    }

    //special pagination
    private function algo2($request,$total,$cos){
        $a=1;
        $lien=intval($request->page);
                $l=(($lien - 1) * $cos) + 1;
                $ref=$total-$l;
                    if($lien == 1){
                        if($total >= $cos){
                            $b=$cos; 
                        }else{
                            $b=$total;
                        }
                    }else{
                        if($ref >= $cos){
                        $a=$l;
                        $b=$l + ($cos-1);
                    }
                    if($ref < $cos){
                        $a=$l;
                        $b=$total;
                    }
                }
        $tab[] = $a;
        $tab[] = $b;
        return $tab;
    }

    public function getInter($id){
    	$cos4 = $this->get_Constante4();
    	
    	$inter= Intervention::where('id_tier',$id);
    	$total4 = $inter->count();
        $inter = $inter->paginate($cos4);

    	
        $n = $this->algo1($total4,$cos4);
                $a4 =$n[0];$b4=$n[1];
        	return view('Parc.inter',compact('a4','b4','total4','inter'))->render();
    }

    protected function get_Constante4(){
         return Session::get('Par_page5');
    }
    protected function set_Constante4($param){
        Session::put('Par_page5',$param);
    }

    protected function get_Constante9(){
        return Session::get('Par_page9');
    }
    protected function set_Constante9($param){
        Session::put('Par_page9',$param);
    }
    protected function get_Constante10(){
        return Session::get('Par_page10');
    }
    protected function set_Constante10($param){
        Session::put('Par_page10',$param);
    }

    public function refreshInter(Request $request){

    	if($request->const != null){
            $this->set_Constante4($request->const);
            if($request->tier != null){
            	$cos4 = $this->get_Constante4();
            	$total4 = Intervention::where('id_tier',$request->tier)->count();
            	$inter = Intervention::where('id_tier',$request->tier)->paginate($cos4);
            }else{
            	$cos4 = $this->get_Constante4();
        		$total4 = Intervention::count();
        		$inter = Intervention::paginate($cos4);
            }
        }else{
        	$cos4 = $this->get_Constante4();
        	$total4 = Intervention::count();
        	$inter = Intervention::paginate($cos4);
        }
        
        $n = $this->algo1($total4,$cos4);
                $a4 =$n[0];$b4=$n[1];
        return view('Parc.inter',compact('a4','b4','total4','inter'))->render();
    }


    public function paginInter(Request $request){

    	$cos4 = $this->get_Constante4();

    	if(isset($request->idp) && isset($request->arg)){
    		$search = $request->arg;
    		$inter = Intervention::where([['type_inter','like',"%{$search}%"],['id_tier',$request->idp]])
    							->orWhere([['description','like',"%{$search}%"],['id_tier',$request->idp]])
    							->orWhere([['date_inter','like',"%{$search}%"],['id_tier',$request->idp]])
    							->orWhere([['cout_inter','like',"%{$search}%"],['id_tier',$request->idp]])
    							->orderBy('date_inter','DESC');

    	}if(isset($request->idp) && !isset($request->arg)){
    		$inter = Intervention::where('id_tier',$request->idp)
    							->orderBy('date_inter','DESC');

    	}if(!isset($request->idp) && isset($request->arg)){
    		$search = $request->arg;
    		$inter = Intervention::where('type_inter','like',"%{$search}%")
    							->orWhere('description','like',"%{$search}%")
    							->orWhere('date_inter','like',"%{$search}%")
    							->orWhere('cout_inter','like',"%{$search}%")
    							->orderBy('date_inter','DESC');

    	}if(!isset($request->idp) && !isset($request->arg)){
    		$inter = Intervention::orderBy('date_inter','DESC');
    	}

    	$total4 = $inter->count();
    	$inter = $inter->paginate($cos4);
    	
    	if(isset($request->page)){

            $n = $this->algo2($request,$total4,$cos4);
                $a4 =$n[0];$b4=$n[1];
    	}else{
    		
            $n = $this->algo1($total4,$cos4);
                $a4 =$n[0];$b4=$n[1];
    	}
    	return view('Parc.inter',compact('a4','b4','total4','inter'))->render();
    }

    public function interDetail(Request $request,$id){
    		$table=null;
    	if(Intervention::where('id_inter',$id)->first()->type_inter == "Maintenance"){
    		$table = "maintenances";
    	}else{
    		$table = "reparations";
    	}

    	$inter = Intervention::leftJoin('materiels as m','m.id_ma','=','interventions.id_ma')
    			->leftJoin('tiers as t','t.id_tier','=','interventions.id_tier')
    			->leftJoin($table.' as st','st.id_inter','=','interventions.id_inter')
    			->where('interventions.id_inter',$id)->first();
    			
    	$ct = Materielcategorie::where('id_catg',$inter->id_catg)->first();
    	$Cat = $ct->categorie;
    	$stble = null;
    	switch ($Cat) {
    		case 'Ordinateur':
    			$stble = 'ordinateurs';
    			break;
    		case 'Reseau':
    			$stble = 'reseaumateriels';
    			break;
    		case 'Peripherique':
    			$stble = 'peripheriques';
    			break;
    		case 'Electrique':
    			$stble = 'materielelectriques';
    			break;	
    		default:
    			# code...
    			break;
    	}
    		$stype = DB::table($stble)->leftJoin('materielcategories as mt','mt.id_catg','=',$stble.'.id_catg')
    		->first();

    		$nbcol = (isset($request->histo)) ? 8 : 5 ;

    		return view('Detail.interDetail',compact('inter','stype','nbcol'))->render();
    }


    public function getMaintenance(Request $request,$const = 0){
        $id = $request->idMa;
        if( is_null(Session::get('Par_page9'))){
            Session::put('Par_page9',9);
        }
        if($const != 0){
             $this->set_Constante9($const);
        }
        
            $cos = $this->get_Constante9();
            if(!isset($request->arg)){
                $maint = Intervention::leftJoin('tiers as t','t.id_tier','=','interventions.id_tier')
                ->where([['id_ma',$id],['type_inter','=','Maintenance']])
                ->orderBy('date_inter','desc');
            }else{
                $maint = Intervention::leftJoin('tiers as t','t.id_tier','=','interventions.id_tier')
                    ->where([['nom','like',"%{$request->arg}%"],['id_ma',$id],['type_inter','=','Maintenance']])
                    ->orWhere([['date_inter','like',"%{$request->arg}%"],['id_ma',$id],['type_inter','=','Maintenance']])
                    ->orWhere([['description','like',"%{$request->arg}%"],['id_ma',$id],['type_inter','=','Maintenance']])
                    ->orWhere([['cout_inter','like',"%{$request->arg}%"],['id_ma',$id],['type_inter','=','Maintenance']])
                    ->orderBy('date_inter','desc');
            }
        

        $total = $maint->count();
        $maint = $maint->paginate($cos); //constante non definie

        if(!isset($request->page)){
            $n = $this->algo1($total,$cos);
            $a =$n[0];$b=$n[1];
        }else{
            $n = $this->algo2($request,$total,$cos);
            $a =$n[0];$b=$n[1];
        }

        return view('Parc.maintenance',compact('a','b','total','maint'))->render();
    }

    public function MaintExcel(Request $request,$type){
            $id = $request->idMa;
            $mat = $request->mat;
            $exel = array('nom as Prestataire','date_inter as Date_Maintenance','description as Observation','cout_inter as Cout_Maintenance');
            if(!isset($request->arg)){
                $data = Intervention::leftJoin('tiers as t','t.id_tier','=','interventions.id_tier')
                ->where([['id_ma',$id],['type_inter','=','Maintenance']])
                ->orderBy('date_inter','desc')->get($exel)->toArray();

                return Excel::create('Maintenance | '.$mat, function($excel) use ($data) {
                $excel->sheet('Maintenance', function($sheet) use ($data)
                {
                    $sheet->fromArray($data);
                });
            })->download($type);
        }
    }


    public function getRep(Request $request,$const = 0){
    $id = $request->idRep;
    if( is_null(Session::get('Par_page10'))){
            Session::put('Par_page10',9);
        }
        if($const != 0){
             $this->set_Constante10($const);
        }
        $cos = $this->get_Constante10();
        if(!isset($request->arg)){
           $rep = Intervention::leftJoin('tiers as t','t.id_tier','=','interventions.id_tier')
                    ->leftJoin('reparations as r','r.id_inter','=','interventions.id_inter')
                    ->where([['id_ma',$id],['type_inter','=','Reparation']])
                    ->orderBy('date_inter','desc'); 
        }else{
            $rep = Intervention::leftJoin('tiers as t','t.id_tier','=','interventions.id_tier')
                    ->leftJoin('reparations as r','r.id_inter','=','interventions.id_inter')
                    ->where([['nom','like',"%{$request->arg}%"],['id_ma',$id],['type_inter','=','Reparation']])
                    ->orWhere([['date_inter','like',"%{$request->arg}%"],['id_ma',$id],['type_inter','=','Reparation']])
                    ->orWhere([['description','like',"%{$request->arg}%"],['id_ma',$id],['type_inter','=','Reparation']])
                    ->orWhere([['cout_inter','like',"%{$request->arg}%"],['id_ma',$id],['type_inter','=','Reparation']])
                    ->orderBy('date_inter','desc');
        }
        
        $total = $rep->count();
        $rep = $rep->paginate($cos);

        if(!isset($request->page)){
            $n = $this->algo1($total,$cos);
            $a =$n[0];$b=$n[1];
        }else{
            $n = $this->algo2($request,$total,$cos);
            $a =$n[0];$b=$n[1];
        }
        return view('Parc.reparation',compact('a','b','total','rep'))->render();
    }

    public function ReparExcel(Request $request,$type){
        $id = $request->idRep;
        $mat = $request->mat;
        $colon = array('t.nom as Prestataire','interventions.date_inter as Date_Reparation','interventions.description as Observation','r.piece as Pièces_Concérnés','interventions.cout_inter as Cout_Reparation');
        $data = Intervention::leftJoin('tiers as t','t.id_tier','=','interventions.id_tier')
                    ->leftJoin('reparations as r','r.id_inter','=','interventions.id_inter')
                    ->where([['id_ma',$id],['type_inter','=','Reparation']])
                    ->orderBy('date_inter','desc')->get($colon)->toArray();

        return Excel::create('Réparation | '.$mat, function($excel) use ($data) {
            $excel->sheet('Réparation', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download($type);
    }

    public function addAffectation(Request $request){

        $dern_afect = AffDepartemnt::where('id_ma',$request->id_mat)->orderBy('date_aff','desc')
                    ->first();
        if(isset($dern_afect->date_aff)){
            $dern_afect=DateTime::createFromFormat('Y-m-d H:i:s',$dern_afect->date_aff)->format('d-m-Y H:i');
            $rg = '|after:'.$dern_afect;
        }else{
            $acqui = Materiel::where('id_ma',$request->id_mat)->first(['date_acqui']);
            $acqui->date_acqui = DateTime::createFromFormat('Y-m-d H:i:s',$acqui->date_acqui)->format('d-m-Y H:i');
            $rg = '|after:'.$acqui->date_acqui;
        }
                   
        $validator=Validator::make($request->all(),[
                'departement' => 'not_in:0',
                'dateAffectation' =>'required|date_format:d-m-Y  H:i'.$rg,
                ]);

        if($validator->fails()){
            return Response::json(['errors'=>$validator->errors()]);
        }else{

            $aff = new AffDepartemnt;
            $aff->id_ma = $request->id_mat;
            $aff->id_dep = $request->departement;
            $aff->id_uti = $request->utilisateur;
            $aff->date_aff = DateTime::createFromFormat('d-m-Y H:i',$request->dateAffectation)->format('Y-m-d H:i:s');
            $aff->save();
            $idEta = Etat::where('etat','En service')->first();
            $id_Eta = $idEta->id_eta;
            $m = Materiel::where('id_ma',$request->id_mat)->first();
            $m->id_eta = $id_Eta;
            $m->save();

            $retour = Materiel::leftJoin('tiers as t','t.id_tier','=','materiels.id_tier')
                      ->leftJoin('etats as e','e.id_eta','=','materiels.id_eta')
                      ->where('materiels.id_ma',$request->id_mat)->first();
            return response()->json($retour);
        }
    }

    public function addMaintenance(Request $request){

        $dern_maint = Intervention::where([['id_ma',$request->id_mat],['type_inter','Maintenance']])
        ->orderBy('date_inter','desc')->first();

        if(isset($dern_maint->date_inter)){
            $dern_maint = DateTime::createFromFormat('Y-m-d',$dern_maint->date_inter)->format('d-m-Y');
            $rg = '|after:'.$dern_maint;
        }else{

            $dern_afect = AffDepartemnt::where('id_ma',$request->id_mat)->orderBy('date_aff','desc')->first(['date_aff']);
               if(isset($dern_afect->date_aff)){
                     $dern_af = DateTime::createFromFormat('Y-m-d H:i:s',$dern_afect->date_aff)
                     ->format('d-m-Y');
                    $rg = '|after:'.$dern_af;
               }else{
                $acqui = Materiel::where('id_ma',$request->id_mat)->first(['date_acqui']);
                $rg = '|after:'.$acqui->date_acqui;
               }
        }

        $validator = Validator::make($request->all(),[
            'prestataire' => 'not_in:0',
            'dateMaintenance' => 'required|date_format:d-m-Y'.$rg,
            'cout' => 'required|numeric',
        ]);

        if($validator->fails()){
            return Response::json(['errors' => $validator->errors()]);
        }else{

            $inter = new Intervention;
            $inter->id_ma = $request->id_mat;
            $inter->id_tier = $request->prestataire;
            $inter->type_inter = "Maintenance";
            $inter->description = $request->observation;
            $inter->date_inter = DateTime::createFromFormat('d-m-Y',$request->dateMaintenance)->format('Y-m-d');
            $inter->cout_inter = $request->cout;
            $inter->save();

            $interval = Materiel::where('id_ma',$request->id_mat)->first()->maintenable;
        
            $maint = new Maintenance;
            $maint->id_inter = $inter->id_inter;
            $njour = $interval * 30;
            $d = strtotime(date("Y-m-d",strtotime($request->dateMaintenance))."+".$njour." day");
            $maint->date_proch = gmdate("Y-m-d",$d);
            $maint->save();
        }
    }



    public function addReparation(Request $request){

            if($request->pane != 0){
                $pane = Panne::where('id_pan',$request->pane)->first(['date_pan']);
                $dPan = strtotime(date('Y-m-d',strtotime($pane->date_pan)).'-1 day');
                $vdt = gmdate('d-m-Y',$dPan);
                $rg = '|after:'.$vdt;
            }else{
                $rg = '';
            }
            
        $validator = Validator::make($request->all(),[
            'prestataire' => 'not_in:0',
            'dateReparation' => 'required|date_format:d-m-Y'.$rg,
            'pane' => 'not_in:0',
            'piece' => 'required',
            'cout' => 'required|numeric',
        ]);
        if($validator->fails())
        {
            return Response::json(['errors' => $validator->errors()]);
        }else{
            
            $inter = new Intervention;
            $inter->id_ma = $request->id_mat;
            $inter->id_tier = $request->prestataire;
            $inter->type_inter = "Reparation";
            $inter->description = $request->observation;
            $inter->date_inter = DateTime::createFromFormat('d-m-Y',$request->dateReparation)->format('Y-m-d');
            $inter->cout_inter = $request->cout;
            $inter->save();

            $bon = Etat::where('etat','En service')->first();
            $materiel = Materiel::where('id_ma',$request->id_mat)->first();
            $materiel->id_eta = $bon->id_eta;
            $materiel->save();

            $rep = new Reparation;
            $rep->id_inter = $inter->id_inter;
            $rep->id_pan = $request->pane;
            $rep->piece = $request->piece;
            $rep->save();

            return response()->json($materiel);
        }
    }

    public function UpdateAff(Request $request){
            $acqui = Materiel::where('id_ma',$request->id_mat)->first(['date_acqui']);
            $rg = '|after:'.$acqui->date_acqui;
        $validator=Validator::make($request->all(),[
                'dateAffectation' =>'required|date_format:d-m-Y  H:i'.$rg,
                ]);
        if($validator->fails()){
            return Response::json(['errors'=>$validator->errors()]);
        }else{
            $aff = AffDepartemnt::where('id_histo',$request->id_aff)->first();
            $date_avant = $aff->date_aff;
            $aff->id_dep = $request->departement;
            $aff->id_uti = $request->utilisateur;
            $aff->date_aff = DateTime::createFromFormat('d-m-Y H:i',$request->dateAffectation)
            ->format('Y-m-d H:i:s');
            $aff->save();

            $temp = DateTime::createFromFormat('d-m-Y H:i',$request->dateAffectation)
                        ->format('Y-m-d H:i:s');
                $col = ['histoaffectations.id_histo as id_histo','histoaffectations.id_dep as id_dep',
                'dep.nom as nom','ut.prenom as prenom',
                'histoaffectations.date_aff as date_aff'];
                $rtr = AffDepartemnt::leftJoin('departements as dep','dep.id_dep','=','histoaffectations.id_dep')
                            ->leftJoin('utilisateurs as ut','ut.id_uti','=','histoaffectations.id_uti')
                            ->where('histoaffectations.date_aff','=',$temp)->first($col); 

                return response()->json($rtr);
        }
    }

    //modification d'une maintenance

        public function getMonoMaint(Request $request){
            $maint = Intervention::leftJoin('tiers as t','t.id_tier','=','interventions.id_tier')
                        ->where('id_inter',$request->id)->first();

            $prest = Tier::where([['id_tier','!=',$maint->id_tier],['catg','prestataire']])->get();

            return response()->json(['maint'=> $maint,'prest'=>$prest]);
        }


        public function maintModif(Request $request){
            $id = $request->id_inter;
            $acqui = Materiel::where('id_ma',$request->id_mat)->first(['date_acqui']);
            $rg = '|after:'.$acqui->date_acqui;
            $validator=Validator::make($request->all(),[
                'dateMaintenance' =>'required|date_format:d-m-Y'.$rg,
                'cout' => 'required|numeric',
                ]);
            if($validator->fails()){
                return Response::json(['errors'=>$validator->errors()]);
            }else{
                $inter = Intervention::where('id_inter',$id)->first();
                $maintenabilite = Materiel::where('id_ma',$request->id_mat)->first(['maintenable']);
                $inter->id_tier = $request->prestataire;
                $inter->date_inter = DateTime::createFromFormat('d-m-Y',$request->dateMaintenance)->format('Y-m-d');
                $inter->description = $request->observation;
                $inter->cout_inter = $request->cout;
                
                $main = Maintenance::where('id_inter',$id)->first();
                $njour = $maintenabilite->maintenable * 30;
                $d = strtotime(date("Y-m-d",strtotime($request->dateMaintenance))."+".$njour." day");
                $main->date_proch = gmdate("Y-m-d",$d);

                $inter->save();
                $main->save();

                $retour = Intervention::leftJoin('tiers as t','t.id_tier','=','interventions.id_tier')
                ->where('interventions.id_inter',$id)->first();

                return response()->json($retour);

            }
        }

        public function getMonoRep(Request $request){

            $id = $request->id;

            $rep = Intervention::leftJoin('tiers as t','t.id_tier','=','interventions.id_tier')
                        ->leftJoin('reparations as r','r.id_inter','=','interventions.id_inter')
                        ->where('interventions.id_inter','=',$request->id)->first();

             $prest = Tier::where([['id_tier','!=',$rep->id_tier],['catg','prestataire']])->get();
            return response()->json(['rep'=>$rep,'prest'=>$prest]);
        }


        public function modifReparation(Request $request){
            $acqui = Materiel::where('id_ma',$request->id_mat)->first(['date_acqui']);
            $rg = '|after:'.$acqui->date_acqui;
            $validator=Validator::make($request->all(),[
                'dateReparation' => 'required|date_format:d-m-Y'.$rg,
                'piece' => 'required',
                'cout' => 'required|numeric',
                ]);

            if($validator->fails()){
                return Response::json(['errors'=>$validator->errors()]);
            }else{
                $inter = Intervention::where('id_inter',$request->id_inter2)->first();

                $inter->id_tier = $request->prestataire;
                $inter->date_inter = DateTime::createFromFormat('d-m-Y',$request->dateReparation)->format('Y-m-d');
                $inter->description = $request->observation;
                $inter->cout_inter = $request->cout;

                $rep = Reparation::where('id_inter',$request->id_inter2)->first();
                $rep->piece = $request->piece;

                $inter->save();
                $rep->save();

                $res = Intervention::leftJoin('tiers as t','t.id_tier','=','interventions.id_tier')
                        ->leftJoin('reparations as r','r.id_inter','=','interventions.id_inter')
                        ->where('interventions.id_inter','=',$request->id_inter2)->first();
               return response()->json($res);
            }
        }

        public function addPanne(Request $request){

            /*if($request->pane != 0){
                $pane = Panne::where('id_pan',$request->pane)->first(['date_pan']);
                $dPan = strtotime(date('Y-m-d',strtotime($pane->date_pan)).'-1 day');
                $vdt = gmdate('d-m-Y',$dPan);
                $rg = '|after:'.$vdt;
            }else{
                $rg = '';
            }*/

                $dern_pan = Panne::where('id_ma',$request->id_mat)->orderBy('date_pan','desc')->first();
                if(isset($dern_pan->date_pan)){
                    $dPan = strtotime(date('Y-m-d',strtotime($dern_pan->date_pan)).'-1 day');
                    $vdt = gmdate('d-m-Y',$dPan);
                    $rg = '|after:'.$vdt;

                    /*$dern_pan=DateTime::createFromFormat('Y-m-d',$dern_pan->date_pan)->format('d-m-Y');
                    $rg = '|after:'.$dern_pan;*/
                }else{
                        $acqui = Materiel::where('id_ma',$request->id_mat)->first(['date_acqui']);
                        $dt = DateTime::createFromFormat('Y-m-d H:i:s',$acqui->date_acqui)->format('d-m-Y');
                        $rg = '|after:'.$dt;
                }

            $validator=Validator::make($request->all(),[
                'datePane' => 'required|date_format:d-m-Y'.$rg,
                'description' => 'required'
                ]);
            if($validator->fails()){
                return Response::json(['errors'=>$validator->errors()]);
            }else{

                $pane = new Panne;
                $pane->id_ma = $request->id_mat;
                $pane->date_pan = DateTime::createFromFormat('d-m-Y',$request->datePane)->format('Y-m-d');
                $pane->description = $request->description;
                
                $s='En Panne';
                $etat = Etat::where('etat','like',"%{$s}%")->first(['id_eta']);
                $m = Materiel::where('id_ma',$request->id_mat)->first();
                $m->id_eta = $etat->id_eta;
                $pane->save();
                $m->save();
                $resp = Materiel::leftJoin('etats as e','e.id_eta','=','materiels.id_eta')
                ->leftJoin('tiers as t','t.id_tier','=','materiels.id_tier')
                ->where('id_ma',$request->id_mat)->first();
            
                return response()->json($resp);
            }
        }


        public function addReform(Request $request){
            $id = $request->id_mat;
            $mater = Materiel::where('id_ma',$id)->first();
            $v_dat = DateTime::createFromFormat('Y-m-d H:i:s',$mater->date_acqui)->format('d-m-Y');
            $rg = '|after:'.$v_dat;

                $valider = ['dateReforme'=>'required|date_format:d-m-Y'.$rg];

            switch ($request->objetReforme) {
                case '0':

                    $valider = [
                        'dateReforme'=>'required|date_format:d-m-Y'.$rg,
                        'nom' => 'required',
                        'valeur' => 'required|numeric',
                    ];
                    break;
                case '1':
                        $valider = [
                            'dateReforme'=>'required|date_format:d-m-Y'.$rg,
                        'nom' => 'required'
                    ];
                    break; 
            }
            
            $validator=Validator::make($request->all(),$valider);

            if($validator->fails()){
                return Response::json(['errors'=>$validator->errors()]);
            }else{
              
                    $r = new Reform;
                    $r->id_ma = $request->id_mat;
                    $r->date_reform = DateTime::createFromFormat('d-m-Y',$request->dateReforme)->format('Y-m-d');
            
                switch ($request->objetReforme) {
                    case '0':
                    $type = "vente";
                        $v = new Vente;
                        $v->acheteur = $request->nom;
                        $v->valeur = $request->valeur;
                        break;
                    case '1':
                    $type = "don";
                        $v = new Don;
                        $v->donataire = $request->nom;
                        break;
                    case '2':
                    $type = "destruction";
                        break;
                }
                $r->type_rf = $type;
                $r->save();
                if($request->objetReforme != '2'){
                    $v->id_rf = $r->id_rf;
                    $v->save();
                }
                $mr = new MaterielReform;
                $mr->id_ma = $mater->id_ma;
                $mr->id_catg = $mater->id_catg;
                $mr->num_serie = $mater->num_serie;
                $mr->marque = $mater->marque;
                $mr->model = $mater->model;
                $mr->type = $request->type_mat;
                $mr->id_tier = $mater->id_tier;
                $mr->date_acqui = $mater->date_acqui;
                $mr->vlr_acqui = $mater->vlr_acqui;
                $mr->save();

                $mater->delete();
            }
        }

        public function delTrace($id){
            AffDepartemnt::where('id_histo',$id)->delete(); 
        }

        public function delMainte($id){
            Intervention::where('id_inter',$id)->delete();
        }

        public function MsupInter(Request $request){
            $tab = $request->tab;
            $t = explode(',', $tab);
            Intervention::whereIn('id_inter',$t)->delete();
        }

        public function geterConst(){
            if( is_null(Session::get('Par_page8'))){
                Session::put('Par_page8',9);
            }
            if( is_null(Session::get('Par_page9'))){
                Session::put('Par_page9',9);
            }
            if( is_null(Session::get('Par_page10'))){
                Session::put('Par_page10',9);
            }
            if( is_null(Session::get('Par_page11'))){
                Session::put('Par_page11',9);
            }
            $const8 = Session::get('Par_page8');
            $const9 = Session::get('Par_page9');
            $const10 = Session::get('Par_page10');
            $const11 = Session::get('Par_page11');

            return response()->json(['c8'=>$const8,'c9'=>$const9,'c10'=>$const10,'c11'=>$const11]);
        }
}

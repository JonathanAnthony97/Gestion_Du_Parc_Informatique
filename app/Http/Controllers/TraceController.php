<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Model\Materiel;
use App\Model\AffDepartemnt;
use App\Model\AffUtilisateur;
use App\Model\Departement;
use App\Model\Materielcategorie;
use App\Model\Ordinateur;
use App\Model\Reseaumateriel;
use App\Model\Peripherique;
use App\Model\Materielelectrique;
use App\Model\Utilisateur;
use App\Model\Reform;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Excel;

class TraceController extends Controller
{
	protected $col = ['materiels.id_ma as id_ma','materiels.num_serie','m.categorie',
 				'materiels.marque','materiels.model','histo.date_aff','dep.nom','uti.prenom'];

 	protected $col1 = ['mat.id_ma as id_ma','mat.num_serie as num_serie','m.categorie as categorie',
 				'mat.marque as marque','mat.model as model','histo.id_histo','histo.date_aff as date_aff','dep.nom as nom','uti.prenom as prenom'];

    protected $col2 = ['mat.num_serie as Num_Serie',
                'mat.marque as Marque','mat.model as Modele','histo.date_aff as Date_Affectation','dep.nom as Departement','uti.prenom as Utilisateur'];

    protected $excel = ['mat.num_serie as Numero_Serie','m.categorie as Type',
                'mat.marque as Marque','mat.model as Modele','histo.date_aff as Date_Affectation','dep.nom as Departement','uti.prenom as Utilisateur'];

	public function __construct()
    {
         $this->middleware('auth');
    }

    private function GetIdReform(){
        $idReform = Reform::get(['id_ma']);
        $tab = array();
        for($i=0;$i<count($idReform);$i++){
            $tab[]=$idReform[$i]->id_ma;
        }
        return $tab;
    }

    private function arrayToObject($tab){
    	return json_decode(json_encode($tab,JSON_FORCE_OBJECT));
    }

    private function set_Constante6($param){
    	Session::put('Par_page7',$param);
    }

    private function get_Constante6(){
        return Session::get('Par_page7');
    }

    private function set_Constante7($param){
    	Session::put('Par_page8',$param);
    }

    private function get_Constante7(){
    	return Session::get('Par_page8');
    }

    public function suivi(Request $request,$const = 0){
    	if( is_null(Session::get('Par_page7'))){
            Session::put('Par_page7',10);
 		}
 		if($const != 0){
 			 $this->set_Constante6($const);
 		}
 		$cos = $this->get_Constante6();

 		if($request->type != 0){
 			$l = Materielcategorie::where('id_catg',$request->type)->first()->id_ctg_comp;
    		$p = Materielcategorie::where('id_catg',$l)->first()->categorie;
            switch ($p) {
                case 'Ordinateur':
                	$Cat = 'ordinateurs';
           		case 'Reseau':
               		$Cat = 'reseaumateriels';
                		break;
            	case 'Peripherique':
                	$Cat = 'peripheriques';
               			break;
            	case 'Electrique':
                	$Cat = 'materielelectriques';
                		break;
            			default:
                	}

                $done = $done = DB::table($Cat)->leftJoin('materiels as mat','mat.id_ma','=',$Cat.'.id_ma')
 				->leftJoin('histoaffectations as histo','histo.id_ma','=',$Cat.'.id_ma')
 				->leftJoin('departements as dep','dep.id_dep','=','histo.id_dep')
 				->leftJoin('utilisateurs as uti','uti.id_uti','=','histo.id_uti')
 				->leftJoin('materielcategories as m','m.id_catg','=',$Cat.'.id_catg');

 			if(isset($request->arg)){
 				$search = $request->arg;
	        		$done = $done->where([['num_serie','like',"%{$search}%"],[$Cat.'.id_catg',$request->type]])
	 				->orWhere([['categorie','like',"%{$search}%"],[$Cat.'.id_catg',$request->type]])
	 				->orWhere([['marque','like',"%{$search}%"],[$Cat.'.id_catg',$request->type]])
	 				->orWhere([['model','like',"%{$search}%"],[$Cat.'.id_catg',$request->type]])
	 				->orWhere([['date_aff','like',"%{$search}%"],[$Cat.'.id_catg',$request->type]])
	 				->orWhere([['nom','like',"%{$search}%"],[$Cat.'.id_catg',$request->type]])
	 				->orWhere([['prenom','like',"%{$search}%"],[$Cat.'.id_catg',$request->type]])
	 				->orderBy('histo.date_aff','desc');
        
 			}else{
        		$done = $done->where($Cat.'.id_catg',$request->type)
 				->orderBy('histo.date_aff','desc');
 			}
            
            $done = $done->get($this->col1);

    			$done = $done->toArray();
 		}else{
 			$table = ['ordinateurs','reseaumateriels','peripheriques','materielelectriques'];
 			$t = [];

 			if(isset($request->arg)){
 					$search = $request->arg;
	 				for($i=0;$i<count($table);$i++){
	 			 	$t[$i] = DB::table($table[$i])->leftJoin('materiels as mat','mat.id_ma','=',$table[$i].'.id_ma')
	 				->leftJoin('histoaffectations as histo','histo.id_ma','=',$table[$i].'.id_ma')
	 				->leftJoin('departements as dep','dep.id_dep','=','histo.id_dep')
	 				->leftJoin('utilisateurs as uti','uti.id_uti','=','histo.id_uti')
	 				->leftJoin('materielcategories as m','m.id_catg','=',$table[$i].'.id_catg')
	 				->where('num_serie','like',"%{$search}%")
	 				->orWhere('categorie','like',"%{$search}%")
	 				->orWhere('marque','like',"%{$search}%")
	 				->orWhere('model','like',"%{$search}%")
	 				->orWhere('date_aff','like',"%{$search}%")
	 				->orWhere('nom','like',"%{$search}%")
	 				->orWhere('prenom','like',"%{$search}%")
	 				->orderBy('histo.date_aff','desc')
                    ->get($this->col1);
	 					}
 			}else{
 				
 				for($i=0;$i<count($table);$i++){
 			 	$t[$i] = DB::table($table[$i])->leftJoin('materiels as mat','mat.id_ma','=',$table[$i].'.id_ma')
 				->leftJoin('histoaffectations as histo','histo.id_ma','=',$table[$i].'.id_ma')
 				->leftJoin('departements as dep','dep.id_dep','=','histo.id_dep')
 				->leftJoin('utilisateurs as uti','uti.id_uti','=','histo.id_uti')
 				->leftJoin('materielcategories as m','m.id_catg','=',$table[$i].'.id_catg')
 				->orderBy('histo.date_aff','desc')->get($this->col1);
 				}
 			}

 			for($j=0;$j<count($t);$j++){
	 					for($k=0;$k<count($t[$j]);$k++){
	 					$done[] = $t[$j][$k];
	 						}
	 					}
 		}
        if(!isset($done)){
            $done=array();
        }
 		$total = count($done);

        if($request->page){
            $n = $this->algo2($request,$total,$cos);
            $a =$n[0];$b=$n[1];
        }else{
            $n = $this->algo1($total,$cos);
            $a =$n[0];$b=$n[1];
        }
 		

 		$trace = $this->paginer($request,$done,$cos);	
 		$types = Materielcategorie::where('id_ctg_comp','!=',0)->get();

 		if($request->ajax()){
 			return view('Parc.list',compact('trace','a','b','total'))->render();
 		}else{
 			return view('Parc.tracabilite',compact('trace','a','b','total','types'));
 		}
    }

    //algorithme d'affichage
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

    //pagination
    private function paginer(Request $request,$done,$cos){
    	$page = isset($request->page) ? $request->page : 1;
 		$perPage = $cos;
 		$offset = ($page * $perPage) - $perPage;
 		$trace = new LengthAwarePaginator(
 			array_slice($done,$offset,$perPage,true),
 			count($done),$perPage,$page,
 			['path'=>$request->url(),'query' => $request->query()]
 		);
 		return $trace;
    }

    //fonction de trie
    public function Triage(Request $request,$type){
    	 $cos = $this->get_Constante6();
    	if($type != 0){
    		$l = Materielcategorie::where('id_catg',$type)->first()->id_ctg_comp;
    		$p = Materielcategorie::where('id_catg',$l)->first()->categorie;
    	
            switch ($p) {
                case 'Ordinateur':
                	$Cat = 'ordinateurs';
           		case 'Reseau':
               		$Cat = 'reseaumateriels';
                		break;
            	case 'Peripherique':
                	$Cat = 'peripheriques';
               			break;
            	case 'Electrique':
                	$Cat = 'materielelectriques';
                		break;
            			default:
                	}
        		$done = DB::table($Cat)->leftJoin('materiels as mat','mat.id_ma','=',$Cat.'.id_ma')
 				->leftJoin('histoaffectations as histo','histo.id_ma','=',$Cat.'.id_ma')
 				->leftJoin('departements as dep','dep.id_dep','=','histo.id_dep')
 				->leftJoin('utilisateurs as uti','uti.id_uti','=','histo.id_uti')
 				->leftJoin('materielcategories as m','m.id_catg','=',$Cat.'.id_catg')
 				->where($Cat.'.id_catg',$type)
 				->orderBy('histo.date_aff','desc')->get($this->col1);
    			$done = $done->toArray();
    	}else{

    			$table = ['ordinateurs','reseaumateriels','peripheriques','materielelectriques'];
 				$t = [];
 				for($i=0;$i<count($table);$i++){
 			 	$t[$i] = DB::table($table[$i])->leftJoin('materiels as mat','mat.id_ma','=',$table[$i].'.id_ma')
 				->leftJoin('histoaffectations as histo','histo.id_ma','=',$table[$i].'.id_ma')
 				->leftJoin('departements as dep','dep.id_dep','=','histo.id_dep')
 				->leftJoin('utilisateurs as uti','uti.id_uti','=','histo.id_uti')
 				->leftJoin('materielcategories as m','m.id_catg','=',$table[$i].'.id_catg')
 				->orderBy('histo.date_aff','desc')->get($this->col1);
 				}
 		for($j=0;$j<count($t);$j++){
 			for($k=0;$k<count($t[$j]);$k++){
 				$done[] = $t[$j][$k];
 				}
 			}
    	}

    	$total = count($done);
 		$n = $this->algo1($total,$cos);
 				$a =$n[0];$b=$n[1];
 		$trace = $this->paginer($request,$done,$cos);
        return view('Parc.list',compact('trace','a','b','total'))->render();
    }


    public function search(Request $request){
    	$cos = $this->get_Constante6();

    	if(isset($request->arg)){
    		$search = $request->arg;

    		if($request->type != 0){
    			$l = Materielcategorie::where('id_catg',$request->type)->first()->id_ctg_comp;
    			$p = Materielcategorie::where('id_catg',$l)->first()->categorie;
    		
            	switch ($p) {
                	case 'Ordinateur':
                		$Cat = 'ordinateurs';
                		break;
           			case 'Reseau':
               			$Cat = 'reseaumateriels';
                		break;
            		case 'Peripherique':
                		$Cat = 'peripheriques';
               			break;
            		case 'Electrique':
                		$Cat = 'materielelectriques';
                		break;
            			default:
                	}
	        		$done = DB::table($Cat)->leftJoin('materiels as mat','mat.id_ma','=',$Cat.'.id_ma')
	 				->leftJoin('histoaffectations as histo','histo.id_ma','=',$Cat.'.id_ma')
	 				->leftJoin('departements as dep','dep.id_dep','=','histo.id_dep')
	 				->leftJoin('utilisateurs as uti','uti.id_uti','=','histo.id_uti')
	 				->leftJoin('materielcategories as m','m.id_catg','=',$Cat.'.id_catg')

	 				->where([['num_serie','like',"%{$search}%"],[$Cat.'.id_catg',$request->type]])
	 				->orWhere([['categorie','like',"%{$search}%"],[$Cat.'.id_catg',$request->type]])
	 				->orWhere([['marque','like',"%{$search}%"],[$Cat.'.id_catg',$request->type]])
	 				->orWhere([['model','like',"%{$search}%"],[$Cat.'.id_catg',$request->type]])
	 				->orWhere([['date_aff','like',"%{$search}%"],[$Cat.'.id_catg',$request->type]])
	 				->orWhere([['nom','like',"%{$search}%"],[$Cat.'.id_catg',$request->type]])
	 				->orWhere([['prenom','like',"%{$search}%"],[$Cat.'.id_catg',$request->type]])
	 				->orderBy('histo.date_aff','desc')->get($this->col1);
    			
    			$done = $done->toArray();

    		}else{

	    			$table = ['ordinateurs','reseaumateriels','peripheriques','materielelectriques'];
	 				$t = [];
	 				for($i=0;$i<count($table);$i++){
	 			 	$t[$i] = DB::table($table[$i])->leftJoin('materiels as mat','mat.id_ma','=',$table[$i].'.id_ma')
	 				->leftJoin('histoaffectations as histo','histo.id_ma','=',$table[$i].'.id_ma')
	 				->leftJoin('departements as dep','dep.id_dep','=','histo.id_dep')
	 				->leftJoin('utilisateurs as uti','uti.id_uti','=','histo.id_uti')
	 				->leftJoin('materielcategories as m','m.id_catg','=',$table[$i].'.id_catg')
	 				
	 				->where('num_serie','like',"%{$search}%")
	 				->orWhere('categorie','like',"%{$search}%")
	 				->orWhere('marque','like',"%{$search}%")
	 				->orWhere('model','like',"%{$search}%")
	 				->orWhere('date_aff','like',"%{$search}%")
	 				->orWhere('nom','like',"%{$search}%")
	 				->orWhere('prenom','like',"%{$search}%")
	 				->orderBy('histo.date_aff','desc')->get($this->col1);
	 					}
	 				for($j=0;$j<count($t);$j++){
	 					for($k=0;$k<count($t[$j]);$k++){
	 					$done[] = $t[$j][$k];
	 						}
	 					}

	 					if(!isset($done)){
	 						$done = [];
	 					}
    			}
    	}else{

    		if($request->type != 0){

    			$l = Materielcategorie::where('id_catg',$request->type)->first()->id_ctg_comp;
    			$p = Materielcategorie::where('id_catg',$l)->first()->categorie;
            	switch ($p) {
               		case 'Ordinateur':
                		$Cat = 'ordinateurs';
           			case 'Reseau':
               		$Cat = 'reseaumateriels';
                		break;
            		case 'Peripherique':
                	$Cat = 'peripheriques';
               			break;
            		case 'Electrique':
                	$Cat = 'materielelectriques';
                		break;
            			default:
                	}

                $done = DB::table($Cat)->leftJoin('materiels as mat','mat.id_ma','=',$Cat.'.id_ma')
 				->leftJoin('histoaffectations as histo','histo.id_ma','=',$Cat.'.id_ma')
 				->leftJoin('departements as dep','dep.id_dep','=','histo.id_dep')
 				->leftJoin('utilisateurs as uti','uti.id_uti','=','histo.id_uti')
 				->leftJoin('materielcategories as m','m.id_catg','=',$Cat.'.id_catg')
 				->where($Cat.'.id_catg',$request->type)
 				->orderBy('histo.date_aff','desc')->get($this->col1);

 				$done = $done->toArray();

    		}else{
	    			$table = ['ordinateurs','reseaumateriels','peripheriques','materielelectriques'];
		 				$t = [];
		 				for($i=0;$i<count($table);$i++){
		 			 	$t[$i] = DB::table($table[$i])->leftJoin('materiels as mat','mat.id_ma','=',$table[$i].'.id_ma')
		 				->leftJoin('histoaffectations as histo','histo.id_ma','=',$table[$i].'.id_ma')
		 				->leftJoin('departements as dep','dep.id_dep','=','histo.id_dep')
		 				->leftJoin('utilisateurs as uti','uti.id_uti','=','histo.id_uti')
		 				->leftJoin('materielcategories as m','m.id_catg','=',$table[$i].'.id_catg')
		 				->orderBy('histo.date_aff','desc')->get($this->col1);
		 				}
		 				for($j=0;$j<count($t);$j++){
		 					for($k=0;$k<count($t[$j]);$k++){
		 						$done[] = $t[$j][$k];
		 					}
		 				}

		 				if(!isset($done)){
	 						$done = [];
	 					}
    			}	
    		}

	    		$total = count($done);
		 		$n = $this->algo1($total,$cos);
 				$a =$n[0];$b=$n[1];
    		$trace = $this->paginer($request,$done,$cos);
        	return view('Parc.list',compact('trace','a','b','total'))->render();
    }

    public function superGeter(Request $request,$const = 0){

    	if( is_null(Session::get('Par_page8'))){
            Session::put('Par_page8',9);
 		}
 		if($const != 0){
 			 $this->set_Constante7($const);
 		}
    	
    		$cos = $this->get_Constante7();
    		$search = $request->serie;
    		$arg = $request->arg;
    	    $table = ['ordinateurs','reseaumateriels','peripheriques','materielelectriques'];
	 		$t = [];

	 		if(!isset($arg)){
	 			for($i=0;$i<count($table);$i++){
		 		$t[$i] = DB::table($table[$i])->leftJoin('materiels as mat','mat.id_ma','=',$table[$i].'.id_ma')
		 		->leftJoin('histoaffectations as histo','histo.id_ma','=',$table[$i].'.id_ma')
		 		->leftJoin('departements as dep','dep.id_dep','=','histo.id_dep')
		 		->leftJoin('utilisateurs as uti','uti.id_uti','=','histo.id_uti')
		 		->leftJoin('materielcategories as m','m.id_catg','=',$table[$i].'.id_catg')
		 		->where('num_serie','=',$search)
		 		->orderBy('histo.date_aff','desc')->get($this->col1);
		 		}
	 		}else{
	 			for($i=0;$i<count($table);$i++){
		 		$t[$i] = DB::table($table[$i])->leftJoin('materiels as mat','mat.id_ma','=',$table[$i].'.id_ma')
		 		->leftJoin('histoaffectations as histo','histo.id_ma','=',$table[$i].'.id_ma')
		 		->leftJoin('departements as dep','dep.id_dep','=','histo.id_dep')
		 		->leftJoin('utilisateurs as uti','uti.id_uti','=','histo.id_uti')
		 		->leftJoin('materielcategories as m','m.id_catg','=',$table[$i].'.id_catg')
		 				
		 		->where([['categorie','like',"%{$arg}%"],['num_serie','=',$search]])
		 		->orWhere([['date_aff','like',"%{$arg}%"],['num_serie','=',$search]])
		 		->orWhere([['nom','like',"%{$arg}%"],['num_serie','=',$search]])
		 		->orWhere([['prenom','like',"%{$arg}%"],['num_serie','=',$search]])
		 		->orderBy('histo.date_aff','desc')->get($this->col1);
		 		}
	 		}

	 		for($j=0;$j<count($t);$j++){
	 			for($k=0;$k<count($t[$j]);$k++){
	 				$done[] = $t[$j][$k];
	 						}
	 				}

	 			if(!isset($done)){
	 				$done = [];
	 				}

	 				$total = count($done);
	 			if(!isset($request->page)){
		 			$n = $this->algo1($total,$cos);
 					$a =$n[0];$b=$n[1];
	 			}else{
	 				$n = $this->algo2($request,$total,$cos);
	 				$a =$n[0];$b=$n[1];
	 			}
	 			
    			$trace = $this->paginer($request,$done,$cos);
    						
        		return view('Parc.trace_modal',compact('trace','a','b','categ','marque','serie','total'))->render();
    }

    //generer excel
    public function TracExcel(Request $request,$type){
            $mat = $request->mat;
            $search = $request->serie;
            $table = ['ordinateurs','reseaumateriels','peripheriques','materielelectriques'];
            $t = [];
                for($i=0;$i<count($table);$i++){
                $t[$i] = DB::table($table[$i])->leftJoin('materiels as mat','mat.id_ma','=',$table[$i].'.id_ma')
                ->leftJoin('histoaffectations as histo','histo.id_ma','=',$table[$i].'.id_ma')
                ->leftJoin('departements as dep','dep.id_dep','=','histo.id_dep')
                ->leftJoin('utilisateurs as uti','uti.id_uti','=','histo.id_uti')
                ->leftJoin('materielcategories as m','m.id_catg','=',$table[$i].'.id_catg')
                ->where('num_serie','=',$search)
                ->orderBy('histo.date_aff','desc')->get($this->col2);
                }
            for($j=0;$j<count($t);$j++){
                for($k=0;$k<count($t[$j]);$k++){
                    $done[] = $t[$j][$k];
                            }
                    }
                if(!isset($done)){
                    $done = [];
                    }        
            $data = json_decode(json_encode($done),true);
            return Excel::create('Traçabilité | '.$mat, function($excel) use ($data) {
            $excel->sheet('Traçabilité', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download($type);
    }

    public function getInfo($id){
    	$m = Materiel::leftJoin('materielcategories as m','m.id_catg','=','materiels.id_catg')
    	->where('materiels.id_ma',$id)->first()->categorie;
    	$table = null;
    	switch ($m) {
    		case 'Ordinateur':
    			$table = 'ordinateurs';
    			break;
    		case 'Reseau':
    			$table = 'reseaumateriels';
    			break;
    		case 'Peripherique':
    			$table = 'peripheriques';
    			break;
    		case 'Electrique':
    			$table = 'materielelectriques';
    			break;
    		default:
    			break;
    	}

    	$type = DB::table($table)->leftJoin('materielcategories as m','m.id_catg','=',$table.'.id_catg')
    	->where($table.'.id_ma',$id)->first()->categorie;

    	return response()->json($type);
    }

    public function getMonoTrace(Request $request){
        $col = ['histoaffectations.id_histo as id_histo','histoaffectations.id_dep as id_dep',
        'histoaffectations.date_aff as date_aff', 'dep.nom as nom','ut.prenom as prenom',
        'histoaffectations.id_uti as id_uti'];
        $idMa = $request->id;
        $date = $request->dat;
        $aff = AffDepartemnt::leftJoin('departements as dep','dep.id_dep','=','histoaffectations.id_dep')
                            ->leftJoin('utilisateurs as ut','ut.id_uti','=','histoaffectations.id_uti')
                            ->where('histoaffectations.date_aff','=',$date)->first($col); 

        $dep = Departement::where('id_dep','!=',$aff->id_dep)->get(['id_dep','nom']);
        $uti = Utilisateur::where('id_uti','!=',$aff->id_uti)->get(['id_uti','prenom']);
        
        return response()->json(['aff'=>$aff,'dep'=>$dep,'uti'=>$uti]);
    }

        //Generation excel
        public function TracabilitExcel(Request $request,$typ){
            if($request->type != 0){
            $l = Materielcategorie::where('id_catg',$request->type)->first()->id_ctg_comp;
            $p = Materielcategorie::where('id_catg',$l)->first()->categorie;
            switch ($p) {
                case 'Ordinateur':
                    $Cat = 'ordinateurs';
                case 'Reseau':
                    $Cat = 'reseaumateriels';
                        break;
                case 'Peripherique':
                    $Cat = 'peripheriques';
                        break;
                case 'Electrique':
                    $Cat = 'materielelectriques';
                        break;
                        default:
                    }
                $done = $done = DB::table($Cat)->leftJoin('materiels as mat','mat.id_ma','=',$Cat.'.id_ma')
                ->leftJoin('histoaffectations as histo','histo.id_ma','=',$Cat.'.id_ma')
                ->leftJoin('departements as dep','dep.id_dep','=','histo.id_dep')
                ->leftJoin('utilisateurs as uti','uti.id_uti','=','histo.id_uti')
                ->leftJoin('materielcategories as m','m.id_catg','=',$Cat.'.id_catg');
            if(isset($request->arg)){
                $search = $request->arg;
                    $done = $done->where([['num_serie','like',"%{$search}%"],[$Cat.'.id_catg',$request->type]])
                    ->orWhere([['categorie','like',"%{$search}%"],[$Cat.'.id_catg',$request->type]])
                    ->orWhere([['marque','like',"%{$search}%"],[$Cat.'.id_catg',$request->type]])
                    ->orWhere([['model','like',"%{$search}%"],[$Cat.'.id_catg',$request->type]])
                    ->orWhere([['date_aff','like',"%{$search}%"],[$Cat.'.id_catg',$request->type]])
                    ->orWhere([['nom','like',"%{$search}%"],[$Cat.'.id_catg',$request->type]])
                    ->orWhere([['prenom','like',"%{$search}%"],[$Cat.'.id_catg',$request->type]])
                    ->orderBy('histo.date_aff','desc');
        
            }else{
                $done = $done->where($Cat.'.id_catg',$request->type)
                ->orderBy('histo.date_aff','desc');
            }
            $done = $done->get($this->excel);
            $done = $done->toArray();
        }else{
            $table = ['ordinateurs','reseaumateriels','peripheriques','materielelectriques'];
            $t = [];
            if(isset($request->arg)){
                    $search = $request->arg;
                    for($i=0;$i<count($table);$i++){
                    $t[$i] = DB::table($table[$i])->leftJoin('materiels as mat','mat.id_ma','=',$table[$i].'.id_ma')
                    ->leftJoin('histoaffectations as histo','histo.id_ma','=',$table[$i].'.id_ma')
                    ->leftJoin('departements as dep','dep.id_dep','=','histo.id_dep')
                    ->leftJoin('utilisateurs as uti','uti.id_uti','=','histo.id_uti')
                    ->leftJoin('materielcategories as m','m.id_catg','=',$table[$i].'.id_catg')
                    ->where('num_serie','like',"%{$search}%")
                    ->orWhere('categorie','like',"%{$search}%")
                    ->orWhere('marque','like',"%{$search}%")
                    ->orWhere('model','like',"%{$search}%")
                    ->orWhere('date_aff','like',"%{$search}%")
                    ->orWhere('nom','like',"%{$search}%")
                    ->orWhere('prenom','like',"%{$search}%")
                    ->orderBy('histo.date_aff','desc')
                    ->get($this->excel);
                        }
            }else{
                for($i=0;$i<count($table);$i++){
                $t[$i] = DB::table($table[$i])->leftJoin('materiels as mat','mat.id_ma','=',$table[$i].'.id_ma')
                ->leftJoin('histoaffectations as histo','histo.id_ma','=',$table[$i].'.id_ma')
                ->leftJoin('departements as dep','dep.id_dep','=','histo.id_dep')
                ->leftJoin('utilisateurs as uti','uti.id_uti','=','histo.id_uti')
                ->leftJoin('materielcategories as m','m.id_catg','=',$table[$i].'.id_catg')
                ->orderBy('histo.date_aff','desc')->get($this->excel);
                }
            }
            for($j=0;$j<count($t);$j++){
                        for($k=0;$k<count($t[$j]);$k++){
                        $done[] = $t[$j][$k];
                            }
                        }
        }

        $data = json_decode( json_encode($done), true);

        return Excel::create('Traçabilité', function($excel) use ($data) {

        $excel->sheet('Traçabilité', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });

        })->download($typ);
    }

 }

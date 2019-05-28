<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
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
use Illuminate\Pagination\LengthAwarePaginator;
use DateTime;
use Excel;

class InventController extends Controller
{
	public function __construct()
    {
         $this->middleware('auth');
    }
    private function set_Constante($param){
    	Session::put('Par_page13',$param);
    }

    private function get_Constante(){
    	return Session::get('Par_page13');
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

    protected $col1 = ['mat.id_ma as id_ma','dep.nom as nom','m.categorie as categorie',
 				'mat.marque as marque','mat.model as model','mat.num_serie as num_serie','uti.prenom as user',
 				'mat.date_acqui','t.nom as suplier','mat.vlr_acqui','mat.garantie','e.etat'
 				];

 	protected $colexcel = ['dep.nom as Departement','m.categorie as Type',
 				'mat.marque as Marque','mat.model as Modele','mat.num_serie as Numero_Serie','uti.prenom as Utilisateur',
 				'mat.date_acqui as Date_Acquisition','t.nom as Fournisseur','mat.vlr_acqui as Valeur_Acquisition','mat.garantie as Garantie','e.etat as Etat'
 				];

 				//'histo.date_aff as date_aff'
    public function index(Request $request,$const = 0){
    	if( is_null(Session::get('Par_page13'))){
            Session::put('Par_page13',10);
 		}
 		if($const != 0){
 			 $this->set_Constante($const);
 		}
 		$cos = $this->get_Constante();
 		$done = array();
 		$table = ['ordinateurs','reseaumateriels','peripheriques','materielelectriques'];

 		if(isset($request->arg)){
 			$search = $request->arg;
 			for($i=0;$i<count($table);$i++){
 			 	$t[$i] = DB::table($table[$i])->leftJoin('materiels as mat','mat.id_ma','=',$table[$i].'.id_ma')
 			 	->leftJoin('tiers as t','t.id_tier','=','mat.id_tier')
 			 	->leftJoin('etats as e','e.id_eta','=','mat.id_eta')
 				->leftJoin('histoaffectations as histo','histo.id_ma','=',$table[$i].'.id_ma')
 				->leftJoin('departements as dep','dep.id_dep','=','histo.id_dep')
 				->leftJoin('utilisateurs as uti','uti.id_uti','=','histo.id_uti')
 				->leftJoin('materielcategories as m','m.id_catg','=',$table[$i].'.id_catg')
 				->where('dep.nom','like',"%{$search}%")
 				->orWhere('m.categorie','like',"%{$search}%")
 				->orWhere('mat.marque','like',"%{$search}%")
 				->orWhere('mat.model','like',"%{$search}%")
 				->orWhere('mat.num_serie','like',"%{$search}%")
 				->orWhere('uti.prenom','like',"%{$search}%")
 				->orWhere('mat.date_acqui','like',"%{$search}%")
 				->orWhere('t.nom','like',"%{$search}%")
 				->orWhere('mat.vlr_acqui','like',"%{$search}%")
 				->orWhere('e.etat','like',"%{$search}%")
 				->orderBy('histo.date_aff','desc')->get($this->col1);
 				}
 		}else{
 			for($i=0;$i<count($table);$i++){
 			 	$t[$i] = DB::table($table[$i])->leftJoin('materiels as mat','mat.id_ma','=',$table[$i].'.id_ma')
 			 	->leftJoin('tiers as t','t.id_tier','=','mat.id_tier')
 			 	->leftJoin('etats as e','e.id_eta','=','mat.id_eta')
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
	 	$total = count($done);

	 	if($request->page){
            $n = $this->algo2($request,$total,$cos);
            $a =$n[0];$b=$n[1];
        }else{
            $n = $this->algo1($total,$cos);
            $a =$n[0];$b=$n[1];
        }

        $invent = $this->paginer($request,$done,$cos);	

	 	//dd($invent);
	 	if($request->ajax()){
	 		return view('Parc.listInvent',compact('invent','a','b','total'));
	 	}else{
	 		return view('Parc.inventaire',compact('invent','a','b','total'));
	 	}
    }

    public function inventairExcel($type){

    	$done = array();
 		$table = ['ordinateurs','reseaumateriels','peripheriques','materielelectriques'];
 			for($i=0;$i<count($table);$i++){
 			 	$t[$i] = DB::table($table[$i])->leftJoin('materiels as mat','mat.id_ma','=',$table[$i].'.id_ma')
 			 	->leftJoin('tiers as t','t.id_tier','=','mat.id_tier')
 			 	->leftJoin('etats as e','e.id_eta','=','mat.id_eta')
 				->leftJoin('histoaffectations as histo','histo.id_ma','=',$table[$i].'.id_ma')
 				->leftJoin('departements as dep','dep.id_dep','=','histo.id_dep')
 				->leftJoin('utilisateurs as uti','uti.id_uti','=','histo.id_uti')
 				->leftJoin('materielcategories as m','m.id_catg','=',$table[$i].'.id_catg')
 				->orderBy('histo.date_aff','desc')->get($this->colexcel);
 				}
 		for($j=0;$j<count($t);$j++){
	 					for($k=0;$k<count($t[$j]);$k++){
	 					$done[] = $t[$j][$k];
	 						}
	 					}

    	  $data = json_decode( json_encode($done), true);

        return Excel::create('Inventaire', function($excel) use ($data) {

            $excel->sheet('Inventaire', function($sheet) use ($data)

            {
                $sheet->fromArray($data);
            });

        })->download($type);
    }
}

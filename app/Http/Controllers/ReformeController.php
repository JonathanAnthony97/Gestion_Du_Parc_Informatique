<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Reform;
use App\Model\Vente;
use App\Model\Don;
use Illuminate\Support\Facades\Session;
use App\Model\Tiers;
use Datetime;
use App\Model\MaterielReform;
use Excel;


class ReformeController extends Controller
{
	public function __construct()
    {
         $this->middleware('auth');
    }
    private function set_Constante($param){
    	Session::put('Par_page12',$param);
    }

    private function get_Constante(){
    	return Session::get('Par_page12');
    }
    protected $col = ['reforms.id_rf as id_rf','num_serie',
    'type','marque','date_acqui','nom','date_reform','type_rf','acheteur','donataire','valeur'];

    protected $colExcel = ['num_serie as Numero_Serie',
    'type as Type','marque as Marque','date_acqui as Date_Acquisition','nom as Fournisseur','date_reform as Date_Reforme','type_rf as Type_Reforme','acheteur as Acheteur','donataire as Donataire','valeur as Valeur_Transaction'];

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

   public function index(Request $request,$const = 0){
   		if( is_null(Session::get('Par_page12'))){
            Session::put('Par_page12',10);
 		}
 		if($const != 0){
 			 $this->set_Constante($const);
 		}
 		$cos = $this->get_Constante();

 		if(isset($request->arg)){
 			$search = $request->arg;

 			$ref = Reform::leftJoin('materielsreformes as mf','mf.id_ma','=','reforms.id_ma')
 				->leftJoin('tiers as t','t.id_tier','=','mf.id_tier')
 				->leftJoin('ventes as v','v.id_rf','=','reforms.id_rf')
 				->leftJoin('dons as d','d.id_rf','=','reforms.id_rf')
 				->where('num_serie','like',"%{$search}%")
 				->orWhere('type','like',"%{$search}%")
 				->orWhere('marque','like',"%{$search}%")
 				->orWhere('date_acqui','like',"%{$search}%")
 				->orWhere('nom','like',"%{$search}%")
 				->orWhere('date_reform','like',"%{$search}%")
 				->orWhere('type_rf','like',"%{$search}%")
 				->orWhere('acheteur','like',"%{$search}%")
 				->orWhere('donataire','like',"%{$search}%")
 				->orWhere('valeur','like',"%{$search}%");

 		}else{
 			$ref = Reform::leftJoin('materielsreformes as mf','mf.id_ma','=','reforms.id_ma')
 				->leftJoin('tiers as t','t.id_tier','=','mf.id_tier')
 				->leftJoin('ventes as v','v.id_rf','=','reforms.id_rf')
 				->leftJoin('dons as d','d.id_rf','=','reforms.id_rf');
 		}
 		$total = $ref->count();
 		$ref = $ref->paginate($cos,$this->col);

 		if($request->page){
 			$n = $this->algo2($request,$total,$cos);
            $a = $n[0];$b=$n[1];
 		}else{
 			$n = $this->algo1($total,$cos);
            $a =$n[0];$b=$n[1];
 		}
 		if($request->ajax()){
 			return view('Parc.listreform',compact('a','b','total','ref'))->render();
 		}else{
 			return view('Parc.reforme',compact('a','b','total','ref'));
 		}
   }

   public function delReform($id){
   		Reform::where('id_rf',$id)->delete();
   }

   public function reformExcel($type){
   		$ref = Reform::leftJoin('materielsreformes as mf','mf.id_ma','=','reforms.id_ma')
 				->leftJoin('tiers as t','t.id_tier','=','mf.id_tier')
 				->leftJoin('ventes as v','v.id_rf','=','reforms.id_rf')
 				->leftJoin('dons as d','d.id_rf','=','reforms.id_rf')->get($this->colExcel)->toArray();

 		$data = $ref;
 		return Excel::create('Matériel_Reformé', function($excel) use ($data) {

            $excel->sheet('Reforme', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });

        })->download($type);

   }
}

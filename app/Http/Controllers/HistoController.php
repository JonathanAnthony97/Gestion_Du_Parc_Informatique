<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Intervention;
use Illuminate\Support\Facades\Session;
use Excel;

class HistoController extends Controller
{

    protected $colExcel = array('num_serie as Numero_Serie','nom as Prestataire','type_inter as Type_Intervention','date_inter as Date_Intervention','cout_inter as Cout_Intervention','description as Observation');

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

 	public function histo(Request $request,$const = 0){

 		if( is_null(Session::get('Par_page6'))){

            Session::put('Par_page6',10);
 		}

        if($const != 0){
            $this->set_Constante5($const);
        }
        $cos = $this->get_Constante5();
        $h = Intervention::leftJoin('materiels as m','m.id_ma','=','interventions.id_ma')
 	 			->leftJoin('tiers as t','t.id_tier','=','interventions.id_tier');

        if(isset($request->type) && $request->type != "0"){
        	$h =$h->where('type_inter',$request->type);
        }
 	 	$total = $h->count();
 	 	$histo = $h->paginate($cos);
        //////////
        $n = $this->algo1($total,$cos);
                $a =$n[0];$b=$n[1];

        if($request->ajax()){
        	return view('Parc.histo',compact('histo','a','b','total'))->render();
        }
        //dd($histo);
        return view('Parc.historique',compact('histo','a','b','total'));

 	 }

 	private function get_Constante5(){
        return Session::get('Par_page6');
    }

 	protected function set_Constante5($param){
    	Session::put('Par_page6',$param);
    }

    private function requete($h,$request){
    	if(isset($request->arg)){
    		$search = $request->arg;
    		if($request->type != "0"){
    		$h = $h->where([['date_inter','like',"%{$search}%"],['type_inter',$request->type]])
    							->orWhere([['t.nom','like',"%{$search}%"],['type_inter',$request->type]])
    							->orWhere([['cout_inter','like',"%{$search}%"],['type_inter',$request->type]])
    							->orderBy('date_inter','DESC');
    		}else{
    			$h = $h->where('date_inter','like',"%{$search}%")
    							->orWhere('t.nom','like',"%{$search}%")
    							->orWhere('cout_inter','like',"%{$search}%")
    							->orderBy('date_inter','DESC');
    		}
    	}else{
    		if($request->type != "0"){
    			$h = $h->where('type_inter',$request->type);
    		}else{
    			$h = $h->orderBy('date_inter','DESC');
    		}
    	}

    	return $h;
    }

    public function pagination(Request $request){
    	$cos = $this->get_Constante5();

    	$h = Intervention::leftJoin('tiers as t','t.id_tier','=','interventions.id_tier')
    		->leftJoin('materiels as m','m.id_ma','=','interventions.id_ma');

    	$h = $this->requete($h,$request);

    	$total = $h->count();
    	$histo = $h->paginate($cos);
            /////////
            $n = $this->algo2($request,$total,$cos);
                $a =$n[0];$b=$n[1];
            
            return view('Parc.histo',compact('a','b','total','histo'))->render();
    }

    public function InterventionExcel(Request $request,$typ){
        $h = Intervention::leftJoin('tiers as t','t.id_tier','=','interventions.id_tier')
            ->leftJoin('materiels as m','m.id_ma','=','interventions.id_ma');
        $h = $this->requete($h,$request);

        $data = $h->get($this->colExcel)->toArray();

        return Excel::create('Prestation', function($excel) use ($data) {
        $excel->sheet('Prestation', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download($typ);
    }

    public function recherche_histo(Request $request,$const=0){

    	if($const != 0){
            $this->set_Constante5($const);
        }

    	$cos = $this->get_Constante5();
    	
    	$h = Intervention::leftJoin('tiers as t','t.id_tier','=','interventions.id_tier')
    		->leftJoin('materiels as m','m.id_ma','=','interventions.id_ma');

    	$h = $this->requete($h,$request);

    	$total = $h->count();
    	$histo = $h->paginate($cos);
    	///////////
            $n = $this->algo1($total,$cos);
                $a =$n[0];$b=$n[1];

           return view('Parc.histo',compact('a','b','total','histo'))->render();
    }

    
}

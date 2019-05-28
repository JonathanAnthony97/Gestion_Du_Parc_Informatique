<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Materiel;
use App\Model\Materielcategorie;
use App\Model\Intervention;
use App\Model\Ordinateur;
use App\Model\MaterielReform;
use App\Model\Etat;
use Excel;

class BilanController extends Controller
{
    public function index(Request $request){
    	$tab = array('Ordinateur','Reseau','Peripherique','Electrique');
    	$som_acqui = 0;
    	$som_maint = 0;
    	$som_rep = 0;
    	$som_vente = 0;
    	for($i=0;$i<count($tab);$i++){

    		$acqui = Materiel::leftJoin('materielcategories as m','m.id_catg','=','materiels.id_catg')
    		->groupBy('m.id_catg')->selectRaw('sum(vlr_acqui) as total,m.id_catg,m.categorie')
    		->where('m.categorie',$tab[$i])->get();

    		$maint = Materiel::leftJoin('materielcategories as m','m.id_catg','=','materiels.id_catg')
    				->leftJoin('interventions as inter','inter.id_ma','=','materiels.id_ma')
    				->groupBy('m.id_catg')->selectRaw('sum(cout_inter) as total,m.id_catg,m.categorie')
    				->where('type_inter','Maintenance')
    				->where('m.categorie',$tab[$i])->get();

    		$rep = Materiel::leftJoin('materielcategories as m','m.id_catg','=','materiels.id_catg')
    				->leftJoin('interventions as inter','inter.id_ma','=','materiels.id_ma')
    				->groupBy('m.id_catg')->selectRaw('sum(cout_inter) as total,m.id_catg,m.categorie')
    				->where('type_inter','Reparation')
    				->where('m.categorie',$tab[$i])->get();

    		$vente = MaterielReform::leftJoin('materielcategories as m','m.id_catg','=','materielsreformes.id_catg')->leftJoin('reforms as rf','rf.id_ma','=','materielsreformes.id_ma')->leftJoin('ventes as v','v.id_rf','=','rf.id_rf')
    			->groupBy('m.id_catg')->selectRaw('sum(valeur) as total,m.id_catg,m.categorie')
    			->where('m.categorie',$tab[$i])->get();

    		$total_acqui = (isset($acqui[0])) ? $acqui[0]->total : 0 ;
    		$som_acqui += $total_acqui;
    		$total_maint = (isset($maint[0])) ? $maint[0]->total : 0 ;
    		$som_maint += $total_maint;
    		$total_rep = (isset($rep[0])) ? $rep[0]->total : 0 ;
    		$som_rep += $total_rep;
    		$total_vente = (isset($vente[0])) ? $vente[0]->total : 0 ;
    		$som_vente += $total_vente;

     		$done [] =  array('type' => $tab[$i],
     						'total_acqui' => $total_acqui,
     						'total_maint' => $total_maint,
     						'total_rep' => $total_rep,
     						'total_vente' => $total_vente);
    	}

    	$totaux = $som_acqui+$som_maint+$som_rep+$som_vente;

    	if($request->ajax()){
    		return view('Parc.ajax_bilan',compact('done','som_acqui','som_maint','som_rep',
    		'som_vente','totaux'))->render();
    	}else{
    		return view('Parc.bilan',compact('done','som_acqui','som_maint','som_rep','som_vente','totaux'));
    	}
    
    }

    public function getBilan(){
    	$tab = array('Ordinateur','Reseau','Peripherique','Electrique');
    		$ordi = array();
    		$reso = array();
    		$peri = array();
    		$el = array();

            $dog = array();
    		
    		for($i=0;$i<count($tab);$i++){
    			$maint = Materiel::leftJoin('materielcategories as m','m.id_catg','=','materiels.id_catg')
	    		->leftJoin('interventions as inter','inter.id_ma','=','materiels.id_ma')
	    		->groupBy('m.id_catg')->selectRaw('sum(cout_inter) as total,m.id_catg,m.categorie')
	    		->where('type_inter','Maintenance')
	    		->where('m.categorie',$tab[$i])->get();

	    		$rep = Materiel::leftJoin('materielcategories as m','m.id_catg','=','materiels.id_catg')
    				->leftJoin('interventions as inter','inter.id_ma','=','materiels.id_ma')
    				->groupBy('m.id_catg')->selectRaw('sum(cout_inter) as total,m.id_catg,m.categorie')
    				->where('type_inter','Reparation')
    				->where('m.categorie',$tab[$i])->get();

    			$acqui = Materiel::leftJoin('materielcategories as m','m.id_catg','=','materiels.id_catg')
		    		->groupBy('m.id_catg')->selectRaw('sum(vlr_acqui) as total,m.id_catg,m.categorie')
		    		->where('m.categorie',$tab[$i])->get();

		    	$vente = MaterielReform::leftJoin('materielcategories as m','m.id_catg','=','materielsreformes.id_catg')->leftJoin('reforms as rf','rf.id_ma','=','materielsreformes.id_ma')->leftJoin('ventes as v','v.id_rf','=','rf.id_rf')
    			->groupBy('m.id_catg')->selectRaw('sum(valeur) as total,m.id_catg,m.categorie')
    			->where('m.categorie',$tab[$i])->get();


    			switch ($tab[$i]) {
    				case 'Ordinateur':
    					$ordi[] = (isset($maint[0])) ? $maint[0]->total : 0 ;
    					$ordi[] = (isset($rep[0])) ? $rep[0]->total : 0 ;
    					$ordi[] = (isset($vente[0])) ? $vente[0]->total : 0 ;
                        $dog[] = (isset($acqui[0])) ? $acqui[0]->total : 0 ;
    					break;
    				case 'Reseau':
    					$reso[] = (isset($maint[0])) ? $maint[0]->total : 0 ;
    					$reso[] = (isset($rep[0])) ? $rep[0]->total : 0 ;

    					$dog[] = (isset($acqui[0])) ? $acqui[0]->total : 0 ;
    					$reso[] = (isset($vente[0])) ? $vente[0]->total : 0 ;

    					break;
    				case 'Peripherique':
    					$peri[] = (isset($maint[0])) ? $maint[0]->total : 0 ;
    					$peri[] = (isset($rep[0])) ? $rep[0]->total : 0 ;

    					$dog[] = (isset($acqui[0])) ? $acqui[0]->total : 0 ;
    					$peri[] = (isset($vente[0])) ? $vente[0]->total : 0 ;

    					break;
    				case 'Electrique':
    					$el[] = (isset($maint[0])) ? $maint[0]->total : 0 ;
    					$el[] = (isset($rep[0])) ? $rep[0]->total : 0 ;

    					$dog[] = (isset($acqui[0])) ? $acqui[0]->total : 0 ;
    					$el[] = (isset($vente[0])) ? $vente[0]->total : 0 ;

    					break;
    			}

    		}  
    	return response()->json(['ordi'=>$ordi,
					    		'reso'=>$reso,
					    		'peri'=>$peri,
					    		'el'=>$el,'dog'=>$dog
					    			]);
    }

    public function searchBilan(Request $request){
    	$date = $request->date;
    	$tab = array('Ordinateur','Reseau','Peripherique','Electrique');
    	$som_acqui = 0;
    	$som_maint = 0;
    	$som_rep = 0;
    	$som_vente = 0;

    	for($i=0;$i<count($tab);$i++){

    		$acqui = Materiel::leftJoin('materielcategories as m','m.id_catg','=','materiels.id_catg')
    		->groupBy('m.id_catg')->selectRaw('sum(vlr_acqui) as total,m.id_catg,m.categorie')
    		->where('m.categorie',$tab[$i])->whereYear('date_acqui',$date)->get();

    		$maint = Materiel::leftJoin('materielcategories as m','m.id_catg','=','materiels.id_catg')
    				->leftJoin('interventions as inter','inter.id_ma','=','materiels.id_ma')
    				->groupBy('m.id_catg')->selectRaw('sum(cout_inter) as total,m.id_catg,m.categorie')
    				->where('type_inter','Maintenance')
    				->where('m.categorie',$tab[$i])->whereYear('inter.date_inter',$date)->get();

    		$rep = Materiel::leftJoin('materielcategories as m','m.id_catg','=','materiels.id_catg')
    				->leftJoin('interventions as inter','inter.id_ma','=','materiels.id_ma')
    				->groupBy('m.id_catg')->selectRaw('sum(cout_inter) as total,m.id_catg,m.categorie')
    				->where('type_inter','Reparation')
    				->where('m.categorie',$tab[$i])->whereYear('inter.date_inter',$date)->get();

    		$vente = MaterielReform::leftJoin('materielcategories as m','m.id_catg','=','materielsreformes.id_catg')->leftJoin('reforms as rf','rf.id_ma','=','materielsreformes.id_ma')->leftJoin('ventes as v','v.id_rf','=','rf.id_rf')
    			->groupBy('m.id_catg')->selectRaw('sum(valeur) as total,m.id_catg,m.categorie')
    			->where('m.categorie',$tab[$i])->whereYear('rf.date_reform',$date)->get();

    		$total_acqui = (isset($acqui[0])) ? $acqui[0]->total : 0 ;
    		$som_acqui += $total_acqui;
    		$total_maint = (isset($maint[0])) ? $maint[0]->total : 0 ;
    		$som_maint += $total_maint;
    		$total_rep = (isset($rep[0])) ? $rep[0]->total : 0 ;
    		$som_rep += $total_rep;
    		$total_vente = (isset($vente[0])) ? $vente[0]->total : 0 ;
    		$som_vente += $total_vente;

     		$done [] =  array('type' => $tab[$i],
     						'total_acqui' => $total_acqui,
     						'total_maint' => $total_maint,
     						'total_rep' => $total_rep,
     						'total_vente' => $total_vente);
    	}

    	$totaux = $som_acqui+$som_maint+$som_rep+$som_vente;

    	return view('Parc.ajax_bilan',compact('done','som_acqui','som_maint','som_rep',
    		'som_vente','totaux'))->render();
    }

    public function canvas(Request $request){
    	$date = $request->date;
    	$tab = array('Ordinateur','Reseau','Peripherique','Electrique');
    		$ordi = array();
    		$reso = array();
    		$peri = array();
    		$el = array();
            $dog = array();
    		for($i=0;$i<count($tab);$i++){
    			$maint = Materiel::leftJoin('materielcategories as m','m.id_catg','=','materiels.id_catg')
	    		->leftJoin('interventions as inter','inter.id_ma','=','materiels.id_ma')
	    		->groupBy('m.id_catg')->selectRaw('sum(cout_inter) as total,m.id_catg,m.categorie')
	    		->where('type_inter','Maintenance')
	    		->where('m.categorie',$tab[$i])->whereYear('inter.date_inter',$date)->get();

	    		$rep = Materiel::leftJoin('materielcategories as m','m.id_catg','=','materiels.id_catg')
    				->leftJoin('interventions as inter','inter.id_ma','=','materiels.id_ma')
    				->groupBy('m.id_catg')->selectRaw('sum(cout_inter) as total,m.id_catg,m.categorie')
    				->where('type_inter','Reparation')
    				->where('m.categorie',$tab[$i])->whereYear('inter.date_inter',$date)->get();

    			$acqui = Materiel::leftJoin('materielcategories as m','m.id_catg','=','materiels.id_catg')
		    		->groupBy('m.id_catg')->selectRaw('sum(vlr_acqui) as total,m.id_catg,m.categorie')
		    		->where('m.categorie',$tab[$i])->whereYear('date_acqui',$date)->get();

		    	$vente = MaterielReform::leftJoin('materielcategories as m','m.id_catg','=','materielsreformes.id_catg')->leftJoin('reforms as rf','rf.id_ma','=','materielsreformes.id_ma')->leftJoin('ventes as v','v.id_rf','=','rf.id_rf')
    			->groupBy('m.id_catg')->selectRaw('sum(valeur) as total,m.id_catg,m.categorie')
    			->where('m.categorie',$tab[$i])->whereYear('rf.date_reform',$date)->get();


    			switch ($tab[$i]) {
    				case 'Ordinateur':
    					$ordi[] = (isset($maint[0])) ? $maint[0]->total : 0 ;
    					$ordi[] = (isset($rep[0])) ? $rep[0]->total : 0 ;

    					$dog[] = (isset($acqui[0])) ? $acqui[0]->total : 0 ;
    					$ordi[] = (isset($vente[0])) ? $vente[0]->total : 0 ;

    					break;
    				case 'Reseau':
    					$reso[] = (isset($maint[0])) ? $maint[0]->total : 0 ;
    					$reso[] = (isset($rep[0])) ? $rep[0]->total : 0 ;

    					$dog[] = (isset($acqui[0])) ? $acqui[0]->total : 0 ;
    					$reso[] = (isset($vente[0])) ? $vente[0]->total : 0 ;

    					break;
    				case 'Peripherique':
    					$peri[] = (isset($maint[0])) ? $maint[0]->total : 0 ;
    					$peri[] = (isset($rep[0])) ? $rep[0]->total : 0 ;

    					$dog[] = (isset($acqui[0])) ? $acqui[0]->total : 0 ;
    					$peri[] = (isset($vente[0])) ? $vente[0]->total : 0 ;

    					break;
    				case 'Electrique':
    					$el[] = (isset($maint[0])) ? $maint[0]->total : 0 ;
    					$el[] = (isset($rep[0])) ? $rep[0]->total : 0 ;

    					$dog[] = (isset($acqui[0])) ? $acqui[0]->total : 0 ;
    					$el[] = (isset($vente[0])) ? $vente[0]->total : 0 ;

    					break;
    			}

    		}  
    	return response()->json(['ordi'=>$ordi,
					    		'reso'=>$reso,
					    		'peri'=>$peri,
					    		'el'=>$el,'dog'=>$dog
					    			]);

    }

    public function BilanExcel(Request $request,$type){

        $tab = array('Ordinateur','Reseau','Peripherique','Electrique');
        if(isset($request->date)){
            $date = $request->date;
            for($i=0;$i<count($tab);$i++){
                $acqui = Materiel::leftJoin('materielcategories as m','m.id_catg','=','materiels.id_catg')
                ->groupBy('m.id_catg')->selectRaw('sum(vlr_acqui) as total,m.id_catg,m.categorie')
                ->where('m.categorie',$tab[$i])->whereYear('date_acqui',$date)->get();

                $maint = Materiel::leftJoin('materielcategories as m','m.id_catg','=','materiels.id_catg')
                    ->leftJoin('interventions as inter','inter.id_ma','=','materiels.id_ma')
                    ->groupBy('m.id_catg')->selectRaw('sum(cout_inter) as total,m.id_catg,m.categorie')
                    ->where('type_inter','Maintenance')
                    ->where('m.categorie',$tab[$i])->whereYear('inter.date_inter',$date)->get();

                 $rep = Materiel::leftJoin('materielcategories as m','m.id_catg','=','materiels.id_catg')
                    ->leftJoin('interventions as inter','inter.id_ma','=','materiels.id_ma')
                    ->groupBy('m.id_catg')->selectRaw('sum(cout_inter) as total,m.id_catg,m.categorie')
                    ->where('type_inter','Reparation')
                    ->where('m.categorie',$tab[$i])->whereYear('inter.date_inter',$date)->get();

                $vente = MaterielReform::leftJoin('materielcategories as m','m.id_catg','=','materielsreformes.id_catg')->leftJoin('reforms as rf','rf.id_ma','=','materielsreformes.id_ma')->leftJoin('ventes as v','v.id_rf','=','rf.id_rf')
                ->groupBy('m.id_catg')->selectRaw('sum(valeur) as total,m.id_catg,m.categorie')
                ->where('m.categorie',$tab[$i])->whereYear('rf.date_reform',$date)->get();

                 $vente = MaterielReform::leftJoin('materielcategories as m','m.id_catg','=','materielsreformes.id_catg')->leftJoin('reforms as rf','rf.id_ma','=','materielsreformes.id_ma')->leftJoin('ventes as v','v.id_rf','=','rf.id_rf')
                    ->groupBy('m.id_catg')->selectRaw('sum(valeur) as total,m.id_catg,m.categorie')
                    ->where('m.categorie',$tab[$i])->get();

                    $total_acqui = (isset($acqui[0])) ? $acqui[0]->total : 0 ;
           
                    $total_maint = (isset($maint[0])) ? $maint[0]->total : 0 ;
           
                    $total_rep = (isset($rep[0])) ? $rep[0]->total : 0 ;
         
                    $total_vente = (isset($vente[0])) ? $vente[0]->total : 0 ;
            
                    $done [] =  array('type' => $tab[$i],
                            'total_acqui' => $total_acqui,
                            'total_maint' => $total_maint,
                            'total_rep' => $total_rep,
                            'total_vente' => $total_vente);

            }
        }else{

            $date = date('Y');

            for($i=0;$i<count($tab);$i++){

                $acqui = Materiel::leftJoin('materielcategories as m','m.id_catg','=','materiels.id_catg')
                    ->groupBy('m.id_catg')->selectRaw('sum(vlr_acqui) as total,m.id_catg,m.categorie')
                    ->where('m.categorie',$tab[$i])->get();

                $maint = Materiel::leftJoin('materielcategories as m','m.id_catg','=','materiels.id_catg')
                    ->leftJoin('interventions as inter','inter.id_ma','=','materiels.id_ma')
                    ->groupBy('m.id_catg')->selectRaw('sum(cout_inter) as total,m.id_catg,m.categorie')
                    ->where('type_inter','Maintenance')
                    ->where('m.categorie',$tab[$i])->get();

                $rep = Materiel::leftJoin('materielcategories as m','m.id_catg','=','materiels.id_catg')
                    ->leftJoin('interventions as inter','inter.id_ma','=','materiels.id_ma')
                    ->groupBy('m.id_catg')->selectRaw('sum(cout_inter) as total,m.id_catg,m.categorie')
                    ->where('type_inter','Reparation')
                    ->where('m.categorie',$tab[$i])->get();

                    $vente = MaterielReform::leftJoin('materielcategories as m','m.id_catg','=','materielsreformes.id_catg')->leftJoin('reforms as rf','rf.id_ma','=','materielsreformes.id_ma')->leftJoin('ventes as v','v.id_rf','=','rf.id_rf')
                    ->groupBy('m.id_catg')->selectRaw('sum(valeur) as total,m.id_catg,m.categorie')
                    ->where('m.categorie',$tab[$i])->get();

                    $total_acqui = (isset($acqui[0])) ? $acqui[0]->total : 0 ;
           
                    $total_maint = (isset($maint[0])) ? $maint[0]->total : 0 ;
           
                    $total_rep = (isset($rep[0])) ? $rep[0]->total : 0 ;
         
                    $total_vente = (isset($vente[0])) ? $vente[0]->total : 0 ;
            
                    $done [] =  array('type' => $tab[$i],
                            'total_acqui' => $total_acqui,
                            'total_maint' => $total_maint,
                            'total_rep' => $total_rep,
                            'total_vente' => $total_vente);
            }
        }

        

        $data = json_decode( json_encode($done), true);

        return Excel::create('Bilan_'.$date, function($excel) use ($data,$date) {

            $excel->sheet('Bilan_'.$date, function($sheet) use ($data)
                {
                    $sheet->fromArray($data);
                });
            })->download($type);
    }
}

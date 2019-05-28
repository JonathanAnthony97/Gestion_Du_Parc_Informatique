<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Intervention;
use DB;
use App\Model\AffDepartemnt;
use App\Model\Ordinateur;
use App\Model\Materiel;
use App\Model\Materielcategorie;
class PlanController extends Controller
{
	private $col = ['mat.id_ma','mt.id_inter','m.id_ctg_comp','dep.nom','uti.prenom','m.categorie','mat.num_serie','mat.marque','mat.model','inter.date_inter','mt.date_proch','histo.date_aff'];

	public function __construct()
    {
         $this->middleware('auth');
    }

    public function index(){
    	return view('Parc.planning');
    }

    private function calcul($maint,$datAff){
    	$nj = $maint * 30;
        $dat = strtotime(date("Y-m-d",strtotime($datAff))."+".$nj." day");
        $date_maint = gmdate("Y-m-d",$dat);
        return $date_maint;
    }

    public function getPlanning(){
    	$data=array();
    	$table = ['ordinateurs','reseaumateriels','peripheriques','materielelectriques'];
 				$t = array();
 				for($i=0;$i<count($table);$i++){
 					$n=DB::table($table[$i])->get([$table[$i].'.id_ma']);
 					$c=0;
                    
 					for($a=0;$a<count($n);$a++){
 					if(Intervention::where('id_ma',$n[$a]->id_ma)->count() > 0){
 						$c++;
                
 					}else{
 						$maintenable = Materiel::where('id_ma',$n[$a]->id_ma)->first(['maintenable','id_catg']);
 						if(isset($maintenable->maintenable)){
 							if(AffDepartemnt::where('id_ma',$n[$a]->id_ma)->count() > 0){
 								$ca = Materielcategorie::where('id_catg',$maintenable->id_catg)->first();
 								switch ($ca->categorie) {
 									case 'Ordinateur':
 										$type = 'ordinateurs';
 										break;
 									case 'Reseau':
 										$type = 'reseaumateriels';
 										break;
 									case 'Peripherique':
 										$type = 'peripheriques';
 										break;
 									case 'Electrique':
 										$type = 'materielelectriques';
 										break;
 									default:
 										break;
 									}

 									$r = DB::table($type)->leftJoin('materiels as mat','mat.id_ma','=',$type.'.id_ma')
 									->leftJoin('materielcategories as m','m.id_catg','=',$type.'.id_catg')
 									->leftJoin('histoaffectations as histo','histo.id_ma','=',$type.'.id_ma')
 									->leftJoin('departements as dep','dep.id_dep','=','histo.id_dep')
 									->leftJoin('utilisateurs as uti','uti.id_uti','=','histo.id_uti')
 									->where('histo.id_ma',$n[$a]->id_ma)
 									->orderBy('histo.date_aff','asc')->first();
 									$datMaint = $this->calcul($maintenable->maintenable,$r->date_aff);
 									
                                    //dd($datMaint);

 									$tb = [
 										'id_ma' => $r->id_ma,
 										'id_inter' => null,
 										'id_ctg_comp' => $r->id_ctg_comp,
 										'nom' => $r->nom,
 										'prenom' => $r->prenom,
 										'categorie' => $r->categorie,
 										'num_serie' => $r->num_serie,
 										'marque' =>	$r->marque,
 										'model' => $r->model,
 										'date_inter' => null,
 										'date_proch' =>$datMaint,
 										'date_aff' => null
 										];
 										$o = json_decode(json_encode($tb));
 										$t[] = $o;
 										
 								}
 							}
 						}
 					}
                    $s = 'Maintenance';
 					$res = DB::table($table[$i])->leftJoin('materiels as mat','mat.id_ma','=',$table[$i].'.id_ma')
 					->leftJoin('materielcategories as m','m.id_catg','=',$table[$i].'.id_catg')
 					->leftJoin('interventions as inter','inter.id_ma','=',$table[$i].'.id_ma')
 					->leftJoin('histoaffectations as histo','histo.id_ma','=',$table[$i].'.id_ma')
 					->leftJoin('departements as dep','dep.id_dep','=','histo.id_dep')
 					->leftJoin('utilisateurs as uti','uti.id_uti','=','histo.id_uti')
 					->leftJoin('maintenances as mt','mt.id_inter','=','inter.id_inter')
 					->where('inter.type_inter','like',"%{$s}%")
                    ->orderBy('inter.date_inter','desc')
                    ->orderBy('histo.date_aff','desc')
                    ->distinct()->take($c)->get($this->col);

 					if(count($res) != 0){
 			 			for($j=0;$j<count($res);$j++){
 			 				$t[] = $res[$j];
							}
 			 			}
 				}

                //dd($t);

 		for($k=0;$k<count($t);$k++)
        	{ 
        		$cat = Materielcategorie::where('id_catg',$t[$k]->id_ctg_comp)->first();
        		switch ($cat->categorie) {
        			case 'Ordinateur':
        				$color = '#999';
        				$icon = '<i class="icon-laptop"></i>';
        				break;
        			case 'Reseau':
        				$color = '#3a87ad';
        				$icon = '<i class="icon-signal"></i>';
        				break;
        			case 'Peripherique':
        				$color = 'rgb(148, 184, 110)';
        				$icon = '<i class="icon-desktop"></i>';
        				break;
        			case 'Electrique':
        				$color = 'rgb(255, 184, 72)';
        				$icon = '<i class="icon-bolt"></i>';
        				break;
        			default:
        				break;
        		}
        		if(isset($t[$k]->nom)){
                    if(isset($t[$k]->prenom)){
                        $util = $t[$k]->prenom;
                    }else{
                        $util = "Tous";
                    }
        		}else{
        			$util = "";
        		}
        	   if(isset($t[$k]->date_inter)){
                    $d = date('d-m-Y',strtotime($t[$k]->date_inter));
               }else{
                    $d = '';
               }
            $data[]=array(
                "id"=>$t[$k]->id_ma,
                "title"=> $icon." &nbsp;<b>".strtoupper($t[$k]->categorie)."</b><br><b>N° serie </b>".$t[$k]->num_serie,
                "start"=>$t[$k]->date_proch,
                "description"=> '<b>Marque : </b>'.$t[$k]->marque.'<br>
                	<b>Departement : </b>'.$t[$k]->nom.'<br><b>Utilisateur : </b>'.$util.'<br><b>Dernière : </b>'.$d,
                "backgroundColor"=>$color, 
            );
        }
       
        json_encode($data);
 		return $data;

    }

///////////////////////////////////////////////////////////////////////////

    public function getAlert(){
        $data=array();
        $alerte = array();

        $table = ['ordinateurs','reseaumateriels','peripheriques','materielelectriques'];
                $t = [];
                
                for($i=0;$i<count($table);$i++){
                    $n=DB::table($table[$i])->get([$table[$i].'.id_ma']);
                    $c=0;
                    for($a=0;$a<count($n);$a++){
                    if(Intervention::where('id_ma',$n[$a]->id_ma)->count() > 0){
                        $c++;
                        if(AffDepartemnt::where('id_ma',$n[$a]->id_ma)->count() > 0){
                            $dat_histo = AffDepartemnt::where('id_ma',$n[$a]->id_ma)
                                        ->orderBy('date_aff','desc')->first(['date_aff']);
                            $dat_histo = $dat_histo->date_aff;
                        }else{
                            $dat_histo = null;
                        }
                    }else{
                        $maintenable = Materiel::where('id_ma',$n[$a]->id_ma)->first(['maintenable','id_catg']);
                        if(isset($maintenable->maintenable)){
                            if(AffDepartemnt::where('id_ma',$n[$a]->id_ma)->count() > 0){
                                $ca = Materielcategorie::where('id_catg',$maintenable->id_catg)->first();
                                switch ($ca->categorie) {
                                    case 'Ordinateur':
                                        $type = 'ordinateurs';
                                        break;
                                    case 'Reseau':
                                        $type = 'reseaumateriels';
                                        break;
                                    case 'Peripherique':
                                        $type = 'peripheriques';
                                        break;
                                    case 'Electrique':
                                        $type = 'materielelectriques';
                                        break;
                                    default:
                                        break;
                                    }

                                    $r = DB::table($type)->leftJoin('materiels as mat','mat.id_ma','=',$type.'.id_ma')
                                    ->leftJoin('materielcategories as m','m.id_catg','=',$type.'.id_catg')
                                    ->leftJoin('histoaffectations as histo','histo.id_ma','=',$type.'.id_ma')
                                    ->leftJoin('departements as dep','dep.id_dep','=','histo.id_dep')
                                    ->leftJoin('utilisateurs as uti','uti.id_uti','=','histo.id_uti')
                                    ->where('histo.id_ma',$n[$a]->id_ma)
                                    ->orderBy('histo.date_aff','asc')->first();
                                    $datMaint = $this->calcul($maintenable->maintenable,$r->date_aff);
                                    
                                    //dd($datMaint);

                                    $tb = [
                                        'id_ma' => $r->id_ma,
                                        'id_inter' => null,
                                        'id_ctg_comp' => $r->id_ctg_comp,
                                        'nom' => $r->nom,
                                        'prenom' => $r->prenom,
                                        'categorie' => $r->categorie,
                                        'num_serie' => $r->num_serie,
                                        'marque' => $r->marque,
                                        'model' => $r->model,
                                        'date_inter' => null,
                                        'date_proch' =>$datMaint,
                                        'date_aff' => null
                                        ];
                                        $o = json_decode(json_encode($tb));
                                        $t[] = $o;
                                        
                                }
                            }
                        }
                    }
                    $s = 'Maintenance';
                    $res = DB::table($table[$i])->leftJoin('materiels as mat','mat.id_ma','=',$table[$i].'.id_ma')
                    ->leftJoin('materielcategories as m','m.id_catg','=',$table[$i].'.id_catg')
                    ->leftJoin('interventions as inter','inter.id_ma','=',$table[$i].'.id_ma')
                    ->leftJoin('histoaffectations as histo','histo.id_ma','=',$table[$i].'.id_ma')
                    ->leftJoin('departements as dep','dep.id_dep','=','histo.id_dep')
                    ->leftJoin('utilisateurs as uti','uti.id_uti','=','histo.id_uti')
                    ->leftJoin('maintenances as mt','mt.id_inter','=','inter.id_inter')
                    ->where('inter.type_inter','like',"%{$s}%")
                    ->orderBy('inter.date_inter','desc')
                    ->orderBy('histo.date_aff','desc')
                    ->distinct()->take($c)->get($this->col);

                    if(count($res) != 0){
                        for($j=0;$j<count($res);$j++){
                            $t[] = $res[$j];
                            }
                        }
                }

        for($k=0;$k<count($t);$k++)
            { 
                $cat = Materielcategorie::where('id_catg',$t[$k]->id_ctg_comp)->first();
                switch ($cat->categorie) {
                    case 'Ordinateur':
                        $icon  = 'laptop';
                        $label = 'default';
                        break;
                    case 'Reseau':
                        $icon = 'signal';
                        $label = 'info';
                        break;
                    case 'Peripherique':
                        $icon = 'desktop';
                        $label = 'success';
                        break;
                    case 'Electrique':
                        $icon = 'bolt';
                        $label = 'warning';
                        break;
                    default:
                        break;
                }
                $aujour = date('Y-m-d');
                $now = date_create(date('Y-m-d'));
                $month = $now->format('m');
                $year = $now->format('Y');

                if($t[$k]->date_proch < $aujour){
                    $alerte[] = array(
                    "id_m"=>$t[$k]->id_ma,
                    "icon" => "warning-sign",
                    "labl" => "danger",
                    "titre"=> "Serie n° ".$t[$k]->num_serie."&nbsp;&nbsp;&nbsp;".strtoupper($t[$k]->categorie),
                    "maint"=>date('d-M-Y',strtotime($t[$k]->date_proch)),
                    );
                }
                    $dp = date_create($t[$k]->date_proch);
                    if($dp->format('m') == $month && $dp->format('Y') == $year){
                        $data[]=array(
                    "id_m"=>$t[$k]->id_ma,
                    "icon" => $icon,
                    "labl" =>$label,
                    "titre"=> "Serie n° ".$t[$k]->num_serie."&nbsp;&nbsp;&nbsp;".strtoupper($t[$k]->categorie),
                    "maint"=>date('d-M-Y',strtotime($t[$k]->date_proch)),
                        );
                    }
                
                
        }
        return response()->json(['mainte'=>$data,'alerte'=>$alerte]);
    }



}

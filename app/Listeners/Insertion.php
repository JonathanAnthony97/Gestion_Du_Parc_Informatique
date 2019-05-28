<?php

namespace App\Listeners;
use DateTime;
use App\Events\NewMateriel;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Model\Materiel;
use App\Model\Ordinateur;
use App\Model\Server;
use App\Model\Swich;
use App\Model\Firewall;
use App\Model\Storage;
use App\Model\Onduleur;
use App\Model\Materielcategorie;
use App\Model\Reseaumateriel;
use App\Model\Peripherique;
use App\Model\Materielelectrique;
use App\Model\Printer;
use App\Model\Ecran;
use App\Model\MaterielUtilisateur;
use App\Model\Etat;
use App\Model\AffDepartemnt;

class Insertion
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NewMateriel  $event
     * @return void
     */
    private function converter($da)
    {
        return DateTime::createFromFormat("d-m-Y",$da);
    }

    private function converter2($da){
        return DateTime::createFromFormat('d-m-Y H:i',$da)->format('Y-m-d H:i:s');
    }
    
    public function handle(NewMateriel $event)
    {
        $d = $event->request;
        $idCat = $d->categParent;
        $idType = $d->Type;
        $nomType = $d->nomType;

        $f = null;
        $c = null;
        if(isset($d->dateAffectation)){
               $eta = Etat::where('etat','=','En service')->first();
           }else{
                $eta = Etat::where('etat','=','Inutilisé')->first();
           }
        $m = new Materiel;
            $m->id_catg = $idCat;
            //$m->id_dep = $d->departement;
            $m->num_serie = strtoupper($d->numSerie);
            $m->marque = ucfirst($d->marque);
            $m->model = strtoupper($d->model);
            $m->garantie = $d->garantie;

            $aquisition = $this->converter2($d->dateAcquisition);
 
            $m->date_acqui = $aquisition;
            $m->id_tier = $d->fournisseur;
            $m->id_eta = $eta->id_eta;
            
            $m->maintenable = $d->maintenable;
            $m->vlr_acqui = $d->valeurAcquisition;
            if($d->duréeVie > 0){
                $m->dure_vie = $d->duréeVie;
                $nbVie = $d->duréeVie * 360;
                $dat = strtotime(date("Y-m-d",strtotime($d->dateAcquisition))."+".$nbVie." day");
                $m->date_renouv = gmdate("Y-m-d",$dat);
            }
            if($m != null){
                $m->save();
            }

            if(isset($d->dateAffectation)){
                $histo = new AffDepartemnt;
                $histo->id_ma = $m->id_ma;
                $histo->id_dep = $d->departement;
                $histo->id_uti = $d->utilisateur;
                $histo->date_aff = $this->converter2($d->dateAffectation);
                $histo->save();
            }
            
            $nomCat = Materielcategorie::where('id_catg','=',$idCat)->first();

            switch ($nomCat->categorie) {
                case 'Reseau':
                    $c = new Reseaumateriel;
                    $c->id_ma = $m->id_ma;
                    $c->id_catg = $idType;
                    $c->utilisation = $d->utilisation;
                    $c->netbios = strtoupper($d->netbios);
                    $c->ethernet = $d->ethernetPort;
                    $c->csl_port = $d->consolePort;
                    break;
                case 'Peripherique':
                    $c = new Peripherique;
                    $c->id_ma = $m->id_ma;
                    $c->id_catg = $idType;
                    //$c->netbios = strtoupper($d->netbios);
                    break;
                case 'Electrique':
                    $c = new Materielelectrique;
                    $c->id_ma = $m->id_ma;
                    $c->id_catg = $idType;
                    $c->puiss = $d->puissance;
                    $c->intesite = $d->intensite;
                    break;
                case 'Ordinateur':
                    if($nomType == "Client Léger" || $nomType == "Desktop" || $nomType == "Laptop"){
                        $f = new Ordinateur;
                        $f->id_ma = $m->id_ma;
                        $f->id_catg = $idType;
                        $f->netbios = strtoupper($d->netbios);
                        $f->type_os = $d->typeOs;
                        $f->lang_os = $d->langOs;
                        $f->srv_pack = $d->pack;
                        $f->mrk = $d->marqueMoniteur;
                        $f->modele = strtoupper($d->modelMoniteur);
                        $f->numSer = strtoupper($d->numSeriMoniteur);
                        $f->nbProces = $d->processeur;
                        $f->model_cpu = $d->modelCpu;
                        $f->frequences = $d->freqCpu;
                        $f->memoChips = $d->chips;
                        $f->type_memo = $d->typeRam;
                        $f->total = $d->totalRam;
                        $f->nbDisk = $d->nbDisque;
                        $f->type_disk = $d->typeDisque;
                        $f->taille_par_disk = $d->tailleParDisque;
                        }
                    break;
                default:
                    break;
            }
            if($c != null)
            {
                $c->save();
            }
            
            switch ($nomType) {
                case 'Serveur':
                    $f = new Server;
                    $f->id_ma = $m->id_ma;
                    $f->ipAdr = $d->adrIp;
                    $f->nbProces = $d->processeur;
                    $f->model_cpu = $d->modelCpu;
                    $f->frequences = $d->freqCpu;
                    $f->memoChips = $d->chips;
                    $f->type_memo = $d->typeRam;
                    $f->total = $d->totalRam;
                    $f->nbDisk = $d->nbDisque;
                    $f->type_disk = $d->typeDisque;
                    $f->taille_par_disk = $d->tailleParDisque;
                    $f->type_raid = $d->typeRaid;
                    
                    $f->type_os = $d->typeOs;
                    $f->lang_os = $d->langOs;
                    $f->srv_pack = $d->pack;
                break;
            case 'Switch':
                    $f = new Swich;
                    $f->id_ma = $m->id_ma;
                    $f->type_switch = $d->typeSwi;
                    $f->mrk = $d->marqueMoniteur;
                    $f->modele = strtoupper($d->modelMoniteur);
                    $f->numSer = strtoupper($d->numSeriMoniteur);
                    //$f->ethernet = $d->ethernetPort;
                    //$f->csl_port = $d->consolePort;
                break;
           
            case 'Storage':
                    $f = new Storage;
                    $f->id_ma = $m->id_ma;
                    $f->nbDisk = $d->nbDisque;
                    $f->type_disk = $d->typeDisque;
                    $f->taille_par_disk = $d->tailleParDisque;
                    $f->type_raid = $d->typeRaid;
                break;
            case 'Onduleur':
                    $f = new Onduleur;
                    $f->id_ma = $m->id_ma;
                    $f->phase = $d->phase;
                    $f->autonomi = $d->autonomie;
                    $f->nbBat = $d->bateri;
                    //$f->intesite = $d->intensite;
                    //$f->ethernet = $d->ethernetPort;
                    //$f->csl_port = $d->consolePort;
                break;
            case 'Ecran':
                    $f = new Ecran;
                    $f->id_ma = $m->id_ma;
                    $f->mrk = $d->marqueMoniteur;
                    $f->modele = strtoupper($d->modelMoniteur);
                    $f->numSer = strtoupper($d->numSeriMoniteur);
                break;
            case 'Imprimante':
                    $f = new Printer;
                    $f->id_ma = $m->id_ma;
                    $f->type_impr = $d->typeImpr;
                    $f->couleur = $d->color;
                    $f->fct_scan = $d->fscan;
                    $f->fct_fax = $d->fax;
                    $f->fct_copy = $d->fcopie;
                    $f->crt_reso =  $d->card;
                break;
            default:
                break;
            }
        
        if($f != null){
            $f->save();
        }
        
    }
}

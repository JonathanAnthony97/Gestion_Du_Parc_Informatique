<?php

namespace App\Listeners;
use DateTime;
use App\Events\NewModif;
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

class Modification
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

    private function converter($da)
    {
        
        return DateTime::createFromFormat('d-m-Y H:i',$da)->format('Y-m-d H:i:s');
    }

    /**
     * Handle the event.
     *
     * @param  NewModif  $event
     * @return void
     */
    public function handle(NewModif $event)
    {
        $d = $event->request;
        $id = $d->idMod;
        $type = $d->typ;
        $cat = $d->cat;

        $ma = Materiel::find($id);
        //dd($ma);
        $ma->num_serie = $d->numSerie;
        $ma->marque = $d->marque;
        $ma->model = $d->model;
        $ma->id_tier = $d->fournisseur;

        
        $ma->date_acqui = $this->converter($d->dateAcquisition);

        $ma->vlr_acqui = $d->valeurAcquisition;
        $ma->garantie = $d->garantie;
        $ma->maintenable = $d->maintenable;
        if($d->duréeVie > 0){
            $ma->dure_vie = $d->duréeVie;
            $nbVie = $d->duréeVie * 360;
            $dat = strtotime(date("Y-m-d",strtotime($d->dateAcquisition))."+".$nbVie." day");
             $ma->date_renouv = gmdate("Y-m-d",$dat); 
        }
        
        $ma->save();
        $table = null;

        switch ($cat) {
            case 'Ordinateur':
                    $table = Ordinateur::find($id);
                    $table->netbios = $d->netbios;
                    $table->type_os = $d->typeOs;
                    $table->lang_os = $d->langOs;
                    $table->srv_pack = $d->pack;
                    $table->mrk = $d->marqueMoniteur;
                    $table->modele = $d->modelMoniteur;
                    $table->numSer = $d->numSeriMoniteur;
                    $table->nbProces = $d->processeur;
                    $table->model_cpu = $d->modelCpu;
                    $table->frequences = $d->freqCpu;
                    $table->memoChips = $d->chips;
                    $table->type_memo = $d->typeRam;
                    $table->total = $d->totalRam;
                    $table->nbDisk = $d->nbDisque;
                    $table->type_disk = $d->typeDisque;
                    $table->taille_par_disk = $d->tailleParDisque;
                break;
            case 'Reseau':
                    $table = Reseaumateriel::find($id);
                    $table->netbios = $d->netbios;
                    $table->utilisation = $d->utilisation;
                    $table->ethernet = $d->ethernetPort;
                    $table->csl_port = $d->consolePort;
                break;
            /*case 'Peripherique':
                    $table = Peripherique::find($id);
                    //$table->netbios = $d->netbios;
                break;*/
            case 'Electrique':
                    $table = Materielelectrique::find($id);
                    $table->puiss = $d->puissance;
                    $table->intesite = $d->intensite;
            default:
                # code...
                break;
        }

        if($table != null){
            $table->save();
        }

        $table2 = null;

        switch ($type) {
            case 'Serveur':
                $table2 = Server::find($id);
                $table2->ipAdr = $d->adrIp;
                $table2->nbProces = $d->processeur;
                $table2->model_cpu = $d->modelCpu;
                $table2->frequences = $d->freqCpu;
                $table2->memoChips = $d->chips;
                $table2->type_memo = $d->typeRam;
                $table2->total = $d->totalRam;
                $table2->nbDisk = $d->nbDisque;
                $table2->type_disk = $d->typeDisque;
                $table2->taille_par_disk = $d->tailleParDisque;
                $table2->type_raid = $d->typeRaid;
                $table2->type_os = $d->typeOs;
                $table2->lang_os = $d->langOs;
                $table2->srv_pack = $d->pack;

                break;
            case 'Switch':
                $table2 = Swich::find($id);
                $table2->type_switch = $d->typeSwi;
                $table2->mrk = $d->marqueMoniteur;
                $table2->modele = $d->modelMoniteur;
                $table2->numSer = $d->numSeriMoniteur;
    
                break;
            case 'Storage':
                $table2 = Storage::find($id);
                $table2->nbDisk = $d->nbDisque;
                $table2->type_disk = $d->typeDisque;
                $table2->taille_par_disk = $d->tailleParDisque;
                $table2->type_raid = $d->typeRaid;

                break;
            case 'Onduleur':
                $table2 = Onduleur::find($id);
                $table2->phase = $d->phase;
                $table2->autonomi = $d->autonomie;
                $table2->nbBat = $d->bateri;
                

                break;
            case 'Ecran':
                $table2 = Ecran::find($id);
                $table2->mrk = $d->marqueMoniteur;
                $table2->modele = $d->modelMoniteur;
                $table2->numSer = $d->numSeriMoniteur;

                break;
            case 'Imprimante':
                $table2 = Printer::find($id);
                $table2->type_impr = $d->typeImpr;
                $table2->couleur = $d->color;
                $table2->fct_scan = $d->fscan;
                $table2->fct_fax = $d->fax;
                $table2->fct_copy = $d->fcopie;
                $table2->crt_reso = $d->card;
                break;
            default:
                # code...
                break;
        }

        if($table2 != null){
            $table2->save();
        }
    }
}

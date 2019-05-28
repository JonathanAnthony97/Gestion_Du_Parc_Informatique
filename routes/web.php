<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','Auth\LoginController@showLoginForm')->name('base') ;

Route::get('exe/{const?}','ExController@index')->where('const', '[0-9]+');

Route::get('exe/ajax','ExController@recherche');

Route::get('pagination/ajax','ExController@ajax_pagination');

Route::get('c','ExController@d');


//excel /csv
Route::get('downloadExcel/{type}', 'ExController@downloadExcel');

//Pdf 
Route::get('pdfview',array('as'=>'pdfview','uses'=>'ExController@pdfview'));




Route::post('/users','ExController@prosses')->name('procesor');

Auth::routes();

//routes



Route::get('home/{const?}','MaterielController@index')->where('const', '[0-9]+')->name('home');
Route::get('pagination/ajax','MaterielController@ajax_pagination');
Route::get('home/ajax','MaterielController@recherche');

Route::get('addMateriel','MaterielController@formAjout')->name('formAdd');
Route::get('GeneratExcel/{type}','MaterielController@GeneratExcel');

Route::post('addTiers','TiersController@add')->name('addTier');
Route::get('getSousCat/{id}','TiersController@getSoutCategorie');

Route::post('addDep','TiersController@addDep')->name('addDep');
Route::post('addCat','TiersController@addCat')->name('addCat');

Route::get('loader/{key}','MaterielController@loader');
Route::get('getUtil/{id}','MaterielController@getUtil')->where('id','[0-9]+');
Route::post('addMa','MaterielController@addMa')->name('addMa');
Route::get('getSelectEta','MaterielController@getSelectEta');
Route::get('setEtat','MaterielController@setEtat');

Route::get('getDetail/{id}','MaterielController@getDetail')->where('id','[0-9]+');


Route::get('getMenu','MaterielController@getMenu')->name('MenuGeter');
Route::get('geter/{id}','MaterielController@geter')->where('id','[0-9]+');

Route::get('loadType/{id}/{const?}','MaterielController@loadType')->where('const', '[0-9]+');
Route::get('loading','MaterielController@loading');
Route::post('updateMa','MaterielController@updateMa')->name('UpdateMa');
Route::get('/{id}','MaterielController@ModifMAteriel')->where('id', '[0-9]+')->name('modifMa');

Route::get('utilisateur/{const?}','UtilisateurController@index')->name('util');

Route::get('pagination/uti','UtilisateurController@paginer');

Route::get('rechercheUti','UtilisateurController@search');

Route::get('getDep','UtilisateurController@getDep');

Route::post('ajoutUtil','UtilisateurController@ajout');

Route::get('recuperUti/{id}','UtilisateurController@recupUtil');

Route::post('modifUtil','UtilisateurController@modif');

Route::get('pagination/fsr','UtilisateurController@paginerFsr');

Route::get('pagination/prst','UtilisateurController@paginerPrst');

Route::get('searchFrs','UtilisateurController@searchFrs');

Route::get('searchPrst','UtilisateurController@searchPrst');
Route::get('UtilExcel/{type}','UtilisateurController@UtilExcel');
Route::get('FournisseurExcel/{type}','UtilisateurController@FournisseurExcel');
Route::get('PrestatairExcel/{type}','UtilisateurController@PrestatairExcel');

Route::post('addPrest','TiersController@addPrest')->name('addPrest');

Route::post('modifPrest','TiersController@modifPrest');

Route::get('recup_m/{id}','TiersController@RecupMateriel');

Route::post('modificationFournisseur','TiersController@modif')->name('updateTier');

Route::get('editFsr/{id}','TiersController@edit');

Route::get('getInter/{id}','InterController@getInter');

Route::get('refreshInter','InterController@refreshInter');

Route::get('pagination/inter','InterController@paginInter');

Route::get('interDetail/{id}','InterController@interDetail');

Route::get('historique/{const?}','HistoController@histo')->where('const', '[0-9]+')->name('histo');

Route::get('pagination/histo','HistoController@pagination');

Route::get('InterventionExcel/{typ}','HistoController@InterventionExcel');

Route::get('recherche_histo/{const?}','HistoController@recherche_histo')->where('const', '[0-9]+');

Route::get('tracabilite/{const?}','TraceController@suivi')->name('suivi');

Route::get('search','TraceController@search');

Route::get('trie/{type}','TraceController@Triage');

Route::get('getTrace/{const?}','TraceController@superGeter')->where('const', '[0-9]+');
Route::get('TracExcel/{type}','TraceController@TracExcel');

Route::get('getInfo/{id}','TraceController@getInfo');

Route::get('getMaintenance/{const?}','InterController@getMaintenance')->where('const', '[0-9]+');;
Route::get('MaintExcel/{type}','InterController@MaintExcel');

Route::get('getRep/{const?}','InterController@getRep')->where('const', '[0-9]+');
Route::get('ReparExcel/{type}','InterController@ReparExcel');

Route::get('getOptSelect','TiersController@getOptSelect');

Route::post('add_affect','InterController@addAffectation')->name('affectation');

Route::post('addMaintenance','InterController@addMaintenance')->name('maintenance');

Route::post('addReparation','InterController@addReparation')->name('reparation');

//modification dans supermodal

Route::get('getMonoTrace','TraceController@getMonoTrace');

Route::get('TracabilitExcel/{typ}','TraceController@TracabilitExcel');

Route::post('afectationMod','InterController@UpdateAff')->name('afectationMod');

Route::get('getMonoMaint','InterController@getMonoMaint');

Route::post('maintModif','InterController@maintModif')->name('maintModif');

Route::get('getMonoRep','InterController@getMonoRep');

Route::post('modifReparation','InterController@modifReparation')->name('modifReparation');

Route::post('addPanne','InterController@addPanne')->name('addPanne');

Route::get('planning','PlanController@index')->name('planning');

Route::get('calendar','PlanController@getPlanning')->name('calendar');

Route::get('getInfo','MaterielController@getInfo');

Route::get('getPrest','TiersController@getPrest');

Route::get('getAlert','PlanController@getAlert');

Route::get('getPanne/{const?}','PaneController@getPanne');
Route::get('PanExcel/{type}','PaneController@PanExcel');

Route::get('paginPane','PaneController@paginPane');

Route::get('histopane/{const?}','PaneController@histopane')->name('pane');
Route::get('detailpane/{id}','PaneController@detailpane');
Route::get('histopanAjax/{const?}','PaneController@histopanAjax');
Route::get('DeletePane/{id}','PaneController@DeletePane');
Route::get('TotalPaneExcel/{type}','PaneController@TotalPaneExcel');
Route::get('HistoPaneExcel/{type}','PaneController@HistoPaneExcel');

Route::get('getMonoPan','PaneController@getMonoPan');

Route::post('ModifPanne','PaneController@ModifPanne')->name('ModifPanne');

Route::get('getPanRep','PaneController@getPanRep');

Route::post('addReform','InterController@addReform')->name('addReform');

Route::get('reforme/{const?}','ReformeController@index')->name('reforme');
Route::get('reformExcel/{type}','ReformeController@reformExcel');

Route::get('invent/{const?}','InventController@index')->name('invent');
Route::get('inventairExcel/{type}','InventController@inventairExcel');

//supresion
Route::get('MsupMat','MaterielController@MsupMat');

Route::get('delMat/{id}','MaterielController@delMat');
Route::get('delTrace/{id}','InterController@delTrace');
Route::get('delPrest/{id}','TiersController@delPrest');
Route::get('delFrs/{id}','TiersController@delFrs');
Route::get('delUti/{id}','TiersController@delUti');



Route::get('delMainte/{id}','InterController@delMainte');
Route::get('delPane/{id}','PaneController@delPane');
Route::get('delReform/{id}','ReformeController@delReform');

Route::get('statistic','MaterielController@statistic');

Route::get('MsupInter','InterController@MsupInter');

Route::get('bilan','BilanController@index')->name('bilan');
Route::get('BilanExcel/{type}','BilanController@BilanExcel');

Route::get('geterConst','InterController@geterConst');

Route::get('getBilan','BilanController@getBilan');

Route::get('searchBilan','BilanController@searchBilan');

Route::get('canvas','BilanController@canvas');
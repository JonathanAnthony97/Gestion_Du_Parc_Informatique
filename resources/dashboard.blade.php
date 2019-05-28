$(document).ready(function(){
		"use strict";
		App.init(); // Init layout and core plugins
		Plugins.init(); // Init all plugins
		FormComponents.init(); // Init all form-specific plugins

		function starte(){
		var par_page = "{{ Session::get('Par_page') }}";
		var par_page2 = "{{ Session::get('Par_page2') }}";
		var par_page3 = "{{ Session::get('Par_page3') }}";
		var par_page4  ="{{ Session::get('Par_page4') }}";
		var par_page5 = "{{ Session::get('Par_page5') }}";
		var par_page6 = "{{ Session::get('Par_page6') }}";
		var par_page7 = "{{ Session::get('Par_page7') }}";
		var par_page12 = "{{ Session::get('Par_page12') }}";
		var par_page13 = "{{ Session::get('Par_page13') }}";
		$('#const').find('option[value="'+par_page +'"]').attr('selected',true);
		$('#const2').find('option[value="'+par_page2 +'"]').attr('selected',true);
		$('#const3').find('option[value="'+par_page3+'"]').attr('selected',true);
		$('#const4').find('option[value="'+par_page4+'"]').attr('selected',true);
		$('#const5').find('option[value="'+par_page5+'"]').attr('selected',true);
		$('#const6').find('option[value="'+par_page6+'"]').attr('selected',true);
		$('#const7').find('option[value="'+par_page7+'"]').attr('selected',true);
		$('#const12').find('option[value="'+par_page12+'"]').attr('selected',true);
		$('#const13').find('option[value="'+par_page13+'"]').attr('selected',true);

		$('#s2id_const .select2-choice > .select2-chosen').html(par_page);
		$('#s2id_const2 .select2-choice > .select2-chosen').html(par_page2);
		$('#s2id_const3 .select2-choice > .select2-chosen').html(par_page3);
		$('#s2id_const4 .select2-choice > .select2-chosen').html(par_page4);
		$('#s2id_const5 .select2-choice > .select2-chosen').html(par_page5);
		$('#s2id_const6 .select2-choice > .select2-chosen').html(par_page6);
		$('#s2id_const7 .select2-choice > .select2-chosen').html(par_page7);
		$('#s2id_const12 .select2-choice > .select2-chosen').html(par_page12);
		$('#s2id_const13 .select2-choice > .select2-chosen').html(par_page13);
		}
		
		starte();
			///initialisation
		 $('#s2id_sType .select2-choice > .select2-chosen').html("Selectionner type");
		 $('#sType').val("0");
		 $('#s2id_departe .select2-choice > .select2-chosen').html("Selectionner service");
		 
		 $('a[href="#tab_3"]').tab('show');

		$( ".datepicker,.dateAff,.daty_af").datetimepicker({
			language:  'fr',
	        weekStart: 1,
			autoclose: 1,
			startView: 2,
			format : 'dd-mm-yyyy  hh:ii'
		});


		$( ".daty_main,.date_rep,.dat_pan,.daty_reform").datetimepicker({
			language:  'fr',
	        weekStart: 1,
			autoclose: 1,
			startView: 2,
			minView: 2,
			format : 'dd-mm-yyyy'
		});

		state();

		function state(){
			$.ajax({
				type:'get',
				url:'statistic',
				success:function(data){
					$('#not1').html(data.mat);
					$('#not3').html(data.util);
					$('#not4').html(data.prest);
				}
			});
		}
	
		$(document).on('click','.g_m,.g_m1,.g_m2',function(){
				if($(this).find('.arrow').hasClass('icon-angle-left')){
					$(this).find('.arrow').removeClass('icon-angle-left').addClass('icon-angle-down');
				}else{
					$(this).find('.arrow').removeClass('icon-angle-down').addClass('icon-angle-left');
				}	
		});


		$(document).on('click','tbody tr #togler',function(){
			var indice = $(this).parent().data('row');
			var row = $(this).parent();
				if($(this).find('i').hasClass('icon-double-angle-down')){
					$(this).find('i').removeClass('icon-double-angle-down').addClass('icon-double-angle-up');
					$(this).find('i').css('color','#df5000');
					$.ajax({
						type:'get',
						url:'getDetail/'+indice,
						success:function(data){
							row.after(data);
							//console.log(data);
						}
					});
				}else{
					$(this).find('i').removeClass('icon-double-angle-up').addClass('icon-double-angle-down');
					$(this).find('i').css('color','');
					$(".open"+indice).remove();
				}	
		});


		$(document).on('click','tbody tr #togler2',function(){
			var row = $(this).parent();
			var id = $(this).parent().data('ligne');

			if($(this).find('i').hasClass('icon-double-angle-down')){
				$(this).find('i').removeClass('icon-double-angle-down').addClass('icon-double-angle-up');
				$(this).find('i').css('color','#df5000');
					//ajax
					$.ajax({
						type:'get',
						url : 'interDetail/'+id,
						success:function(data){
							row.after(data);
						}
					});
			}else{
				$(this).find('i').removeClass('icon-double-angle-up').addClass('icon-double-angle-down');
				$(this).find('i').css('color','');
					$(".interv"+id).remove();
			}	
		});

		$(document).on('click','tbody tr #togler3',function(){
			var row = $(this).parent();
			var id = $(this).parent().data('ligne');

			if($(this).find('i').hasClass('icon-double-angle-down')){
				$(this).find('i').removeClass('icon-double-angle-down').addClass('icon-double-angle-up');
				$(this).find('i').css('color','#df5000');
					//ajax
					$.ajax({
						type:'get',
						url : 'interDetail/'+id+'?histo=true',
						success:function(data){
							row.after(data);
						}
					});
			}else{
				$(this).find('i').removeClass('icon-double-angle-up').addClass('icon-double-angle-down');
				$(this).find('i').css('color','');
					$(".interv"+id).remove();
			}	
		});


		//navigateur
            function getData(page,arg,type,type2){
             //$('#im').css('visibility','');
             var cible;
             if(arg == undefined){
             	var cible;
             	//alert(type2);
             	if(type2 != 0 && type2 != null){
             		cible ='loading?page='+page+'&c='+type2;
             	}else{
             		cible='pagination/ajax?page='+page+'&c='+type;
             	}
             }else{
             	if(type2 != 0 && type2 != null){
             		cible = 'loading?page='+page+'&c='+type2+'&d='+arg;
             	}else{
             		cible='pagination/ajax?page='+page+'&cle='+arg+'&c='+type;
             	}
             	
             }
             	$('#processeur').css('visibility','visible');
                $.ajax({
                    url: cible,
                    success:function(data){
                   //$('#im').css('visibility','hidden');
                   $('#ajax').html(data);
                   $('#processeur').css('visibility','hidden');
                   //location.hash=page;
                    }
                });
            }

            
		 $(document).on('click','.pagin_ma .pagination a',function(e){
                e.preventDefault();
                if($('input[name="search"]').val().trim() !== ""){
                	var arg=$('input[name="search"]').val();
                }
                var type = $('#pageIndex').html();
                var type2 = $('#sType').val();
                //alert(type2);
                var page=$(this).attr('href').split('page=')[1];
                getData(page,arg,type,type2);
            });


		 $(document).on('change','#const',function(){
		 	$('input[name="search"]').val("");
		 	$('#processeur').css('visibility','visible');
		 	var type = $('#pageIndex').html();
		 	var t = $('#sType').val();
		 	var uri;
		 		
		 	if(type != 0){
		 		if(t != null && t!=0){
		 			uri = 'loadType/'+t+'/'+$(this).val();
		 		}else{
		 			uri = 'home/'+ $(this).val()+'?gpi='+type;
		 		} 
		 	}else{
		 		uri = 'home/'+ $(this).val();
		 	}
		 	$.ajax({
		 		url: uri,
		 		success:function(data){
		 			$('#ajax').html(data);
		 			  $('#processeur').css('visibility','hidden');
		 		}
		 	});
		 });


		 $(document).on('keyup','input[name="search"]',function(){
		 	$('#processeur').css('visibility','visible');
		 	var type = $('#sType').val();
		 	var c = $('#pageIndex').html();
		 	var uri;
		 	//alert(type);
		 	if(type != 0 && type != null){
		 		uri ='loadType/'+type+'?c='+$(this).val();
		 	}else{
		 		uri ='home/ajax?search='+ $(this).val()+'&c='+c;
		 	}
		 	$.ajax({
		 		url:uri,
		 		success:function(data){
		 			$('#ajax').html(data);
		 			  $('#processeur').css('visibility','hidden');
		 		}
		 	});
		 });


		 $(document).on('click','#checker_all',function(e){
		 	e.preventDefault();
		 		if($(this).parent().hasClass('checked')){
		 			$(this).parent().removeClass('checked');
		 				$('span[id="s"]').removeClass('checked dlt');
		 					$('tr[id="m"]').removeClass('checked');		 			
		 		}else{
		 			$(this).parent().addClass('checked');
		 				$('span[id="s"]').addClass('checked dlt');
							$('tr[id="m"]').addClass('checked');
		 		}
		 });


		 $(document).on('click','#checker',function(e){
		 	e.preventDefault();
		 	if($(this).parent().hasClass('checked dlt')){
		 			$(this).parent().parent().parent().parent().removeClass('checked');
		 			$(this).parent().removeClass('checked dlt');
		 			$('#checker_all').parent().removeClass('checked');
		 		}else{
		 			$(this).parent().parent().parent().parent().addClass('checked');
		 			$(this).parent().addClass('checked dlt');
		 		}
		 });


		 $(document).on('click','.del',function(){
		 	var tab = [];
		 		$('span[class="checked dlt"]').each(function(i){
		 			tab[i] = $(this).find('#checker').data('id');
		 		});
		 		if(tab.length != 0){
		 			//ajax vers suppresion
		 		x0p('Confirmation', 'Etes vous sûr ?', 'warning').then(function(data){
				if(data.button == 'warning'){
					$.ajax({
						type:'get',
						url:'MsupMat?tab='+tab,
						success:function(data){
							rafraichirMateriel();
							x0p('suppresion','reussie !','ok',false);
						}
					});
				}
			});
		 		}else{
		 			//alert de selection
		 			x0p('Message','Cocher au moin un element svp !','info');
		 		}	
		 });

/////////////////Materiel Form//////////////////////////////


		 $(document).on('click','#oh',function(e){
		 	e.preventDefault();
		 	if($('#s2id_h .select2-choice > .select2-chosen').html() != "Choix departement")
		 		{
		 			//alert($('#s2id_h .select2-choice > .select2-chosen').html());
		 			alert($('#h').val());
		 		}
		 	if($('#s2id_i_ .select2-choice > .select2-chosen').html() != "Choix utilisateur")
		 		{
		 			alert($('#s2id_i_ .select2-choice > .select2-chosen').html());
		 		}
		 });

		 	///initialisation
		 $('input[name="search"]').val("");
		 $('a[data-index="0"]').parent().addClass('active');
		 $('input[name="parent"]').val($('a[data-index="0"]').data('id'));
		 $('input[name="categParent"]').val($('a[data-index="0"]').data('id'));
		 $('#s2id_k .select2-choice > .select2-chosen').html("Choix categorie");
		 $('#k').val("0");
		 $('input[name="nomType"]').val("");
		 $('#af').attr('readOnly',true);

		 function reactive(){
		 	$('li#act').each(function(){
		 		$(this).removeClass('active');
		 	});
		 }


		 
		 //insertion d'un nouveau tier
		 $(document).on('submit','#addTier',function(e){
		 	e.preventDefault();
		 	$('#f1').parent().removeClass('has-error');
		 	$('#f2').parent().removeClass('has-error');
		 	$('#f3').parent().removeClass('has-error');
		 	$('.f1').html("");
		 	$('.f2').html("");
		 	$('.f3').html("");
		 	var x = $(this).find('input[name="typeForm"]').val();
		 	
		 	$.ajax({
		 		type: 'POST',
                    url: $(this).attr('action'),
                    data:$(this).serialize(),
                    success:function(data){
                    	if(data.errors)
                    	{
                    		if(data.errors.nom)
                  			{	
                  				$('.f1').parent().addClass('has-error');
                   				$('.f1').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.nom[0]+'</i>');
                  			}
                  			if(data.errors.contact)
                  			{
                  				$('.f2').parent().addClass('has-error');
                   	 			$('.f2').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.contact[0]+'</i>');
                  			}
                  			if(data.errors.adresse)
                  			{
                  				$('.f3').parent().addClass('has-error');
                   	 			$('.f3').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.adresse[0]+'</i>');
                  			}
                    	}else{
                    		if(x == undefined){
                    			$('#d').append('<option value="'+data.t.id_tier+'">'+data.t.nom+'</option>');
                    			$('#df').append('<option value="'+data.t.id_tier+'">'+data.t.nom+'</option>');
                    		}else{
                    			$('#addTier').trigger('reset');
                    			var arg;
                    			getData3(data.last);
                    		}
                    		$('#addTier').trigger('reset');
                    		state();
                    			$('#fournisseurModal').modal('hide');
                    	}
                    }
		 	});
		 });

		 function getData3(page,arg){
			var cible;
             if(arg == undefined){
             	cible='pagination/fsr?page='+page;
             }else{
             	cible='pagination/fsr?page='+page+'&arg='+arg;
             }
             $('#processeur2').css('visibility','visible');
             $.ajax({
             	type:'get',
             	url: cible,
             	success:function(data){
             		$('#ajax_fsr').html(data);
             		$('#processeur2').css('visibility','hidden');
             	}
             });
		}

		 //insertion d'un nouveau departement

		 $(document).on('submit','#addDep',function(e){
		 	e.preventDefault();
		 	$('#f4').parent().removeClass('has-error');
		 	$('#f5').parent().removeClass('has-error');
		 	$('#f5').removeClass('has-error');
		 	$('.f4').html("");
		 	$('.f5').html("");
		 	if($('#s2id_h .select2-choice > .select2-chosen').html() != "Choix Site"){
		 		$('#idSite').val($('#f5').val());
		 	}else{
		 		$('#idSite').val("0");
		 	}
		 	$.ajax({
		 		type: 'POST',
                url: $(this).attr('action'),
                data:$(this).serialize(),
                success:function(data){
                	if(data.errors){
                		if(data.errors.nom){
                			$('#f4').parent().addClass('has-error');
                			$('.f4').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.nom[0]+'</i>');
                		}
                		if(data.errors.site){
                			$('#f5').parent().addClass('has-error');
		 					$('#f5').addClass('has-error');
                			$('.f5').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.site[0]+'</i>');
                		}
                	}else{
                		$('#h').append('<option value="'+data.id+'">'+data.nom+'</option>');
                		console.log(data);
                		$('#addDep').trigger('reset');
                		$('#departementModal').modal('hide');
                	}
                }
		 	});
		 });

		 //ajout d'un categorie

		 $(document).on('submit','#addCat',function(e){
		 	e.preventDefault();
		 	$('#f6').parent().removeClass('has-error');
		 	$('.f6').html("");
		 	$.ajax({
		 		type: 'POST',
                url: $(this).attr('action'),
                data:$(this).serialize(),
                 success:function(data){
                 	if(data.errors){
                 		if(data.errors.categorie){
                 			$('#f6').parent().addClass('has-error');
                 			$('.f6').html(data.errors.categorie[0]);
                 		}
                 	}else{
                 		var ico ;
                 		if(data.categorie == "Reseau"){ico="signal";}
                 		if(data.categorie == "Peripherique"){ico="desktop";}
                 		if(data.categorie == "Ordinateur"){ico="laptop";}
                 		if(data.categorie == "Electrique"){ico="bolt";}
                 		$('#ul_content').append('<li id="act"><a id="typer" data-id="'+data.id+'" href="#">'+'<i class="icon-'+ico+'"></i> '+'<span>'+data.categorie+'</span>'+'</a></li>');
                 		$('#addCat').trigger('reset');
                		$('#categorieModal').modal('hide');
                 	}
                 }
		 	});
		 });

		 //ajout d'un sous categorie
		 $(document).on('submit','#addType',function(e){
		 	e.preventDefault();
		 	$('#f7').parent().removeClass('has-error');
		 	$('.f7').html("");
		 	$.ajax({
		 		type: 'POST',
                url: $(this).attr('action'),
                data:$(this).serialize(),
                success:function(data){
                	if(data.errors){
                		if(data.errors.categorie){
                			$('#f7').parent().addClass('has-error');
                			$('.f7').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.categorie[0]+'</i>');
                		}
                	}else{
                		
                		$('#f7').parent().removeClass('has-error');
		 				$('.f7').html("");
		 				$('#f7').val("");
                		$('#k').append('<option value="'+data.id+'">'+data.categorie+'</option>');
                		$('#typeModal').modal('hide');
                	}
                }
		 	});
		 });


		 $(document).on('click','.opener',function(){
		 	$('#addCat').trigger('reset');
		 	$('#f6').parent().removeClass('has-error');
		 	$('.f6').html("");
		 	$('#categorieModal').modal('show');
		 });

		 $(document).on('click','#modal1',function(){
		 	$('#f1').parent().removeClass('has-error');
		 	$('#f2').parent().removeClass('has-error');
		 	$('#f3').parent().removeClass('has-error');
		 	$('.f1').html("");
		 	$('.f2').html("");
		 	$('.f3').html("");
		 	$('#addTier').trigger('reset');
		 });

		 $(document).on('click','#modal2',function(){
		 	$('#f4').parent().removeClass('has-error');
		 	$('#f5').parent().removeClass('has-error');
		 	$('#f5').removeClass('has-error');
		 	$('.f4').html("");
		 	$('.f5').html("");
		 	$('#addDep').trigger('reset');
		 });

		
		 $(document).on('click','#modal3',function(){
		 	$('#f7').parent().removeClass('has-error');
		 	$('.f7').html("");
		 	$('#f7').val("");
		 });

		 //A chaque click d'un categorie
		 $(document).on('click','#typer',function(e){
		 	e.preventDefault();
		 		reactive();
		 		$(this).parent().addClass('active');
		 		var id = $(this).data('id');
		 		$('input[name="parent"]').val(id);
		 		 $('input[name="categParent"]').val(id);
		 		var categ = $(this).find('span').html();
		 		vider();
		 		if(categ == "Electrique"){
		 			$('label[for="l"]').html('Puissance (KVA) :');
		 			$('input[id="l"]').attr('name','puissance');
		 		}else{
		 			$('label[for="l"]').html('Nom (Netbios) :');
		 			$('input[id="l"]').attr('name','netbios');
		 		}
		 		if(('Categorie '+categ) != ($('.changer').html())){
		 			var pl;
		 			if(categ != "Reseau"){
		 				 pl='s';
		 			}else{
		 				pl='';
		 			}
		 			$('.changer').html(categ+pl);
		 			$('#contentForm').html("");
		 			$.ajax({
		 			type: 'GET',
                	url: 'getSousCat/'+ id,
                 	success:function(data){
                 		$('#k').empty();
                 		$('#k').append('<option value="0">Choix categorie</option>');
                 		$('#s2id_k .select2-choice > .select2-chosen').html("Choix categorie");
                 			$.each(data,function(index,ind){
                 				$('#k').append('<option value="'+ind.id_catg+'">'+ind.categorie+'</option>');
                 			});
                 		}
		 			});
		 		}
		 });


		 $(document).on('change','#k',function(){
		 	var cible = $(this).find('option[value="'+$(this).val()+'"]').html();
		 	$('input[name="nomType"]').val("");
		 	var type = $('.changer').html();
		 	if(cible !== "Choix categorie"){
		 		$('input[name="nomType"]').val(cible);
		 		$.ajax({
		 			type:'GET',
		 			url: 'loader/'+cible+'?type='+type,
		 			success:function(data){
		 				$('#contentForm').html(data);
		 			}
		 		});
		 	}else{
		 		$('#contentForm').html("");
		 	}
		 });


		 //fonction repositionnant les chams select 2
		 function reInit(){
		 	$('#s2id_h .select2-choice > .select2-chosen').html("Choix departement");
				$('#i_').empty();
		 		$('#i_').append('<option value="0">Choix utilisateur</option>');
		 		$('#s2id_i_ .select2-choice > .select2-chosen').html("Choix utilisateur");
			$('#s2id_d .select2-choice > .select2-chosen').html("Choix fournisseur");
		 	$('#h').val("0");
		 	$('#d').val("0");
		 	$('#i_').val("0");
		 }

		 reInit();
		
		 $(document).on('change','#h',function(){
		 	$('#i_').empty();
		 		$('#i_').append('<option value="0">Choix utilisateur</option>');
		 		$('#s2id_i_ .select2-choice > .select2-chosen').html("Choix utilisateur");
		 	if($(this).val() > 0){
		 		$('#af').val("");
		 		$('#af').attr('readOnly',false);
		 		$.ajax({
		 			type:'GET',
		 			url: 'getUtil/' + $(this).val(),
		 			success:function(data){
		 					$.each(data,function(index,ind){
                 				$('#i_').append('<option value="'+ind.id_uti+'">'+ind.prenom+'</option>');
                 			});
		 			}
		 		});
		 	}else{
		 		$('#af').val("");
		 		$('#af').attr('readOnly',true);
		 	}
		 });

	
		 $(document).on('click','.btn-reset',function(e){
		 	e.preventDefault();
		 	var type = $('#k').val();
		 	var temp = $('input[name="nomType"]').val();
		 	$('#addMateriel').trigger('reset');
		 	var idCat = $('li#act[class="active"]').find('#typer').data('id');
		 	$('input[name="categParent"]').val(idCat);
		 		$('input[name="nomType"]').val(temp);
		 		$('#k').val(type);
		 	reInit();

		 });

		 function vider(){
		 	$('#a').parent().removeClass('has-error');
		 		$('.a').html("");

		 		$('#b').parent().removeClass('has-error');
		 		$('.b').html("");

		 		$('#c').parent().removeClass('has-error');
		 		$('.c').html("");

		 		$('#k').parent().removeClass('has-error');
		 		$('#k').removeClass('has-error');
		 		$('.k').html("");

		 		$('#d').parent().removeClass('has-error');
		 		$('#d').removeClass('has-error');
		 		$('.d').html("");

		 		$('#e').parent().parent().removeClass('has-error');
		 		$('.e').html("");

		 		$('#f').parent().removeClass('has-error');
		 		$('.f').html("");

		 		$('#g').parent().removeClass('has-error');
		 		$('.g').html("");

		 		$('#h').parent().removeClass('has-error');
		 		$('#h').removeClass('has-error');
		 		$('.h').html("");

		 		$('#af').parent().parent().removeClass('has-error');
		 		$('.af').html("");

		 		$('#j').parent().removeClass('has-error');
		 		$('.j').html("");

		 		$('#l').parent().removeClass('has-error');
		 		$('.l').html("");

		 		$('#l1').parent().removeClass('has-error');
		 		$('.l1').html("");

		 		////////
		 		$('#ip').parent().removeClass('has-error');
		 		$('.ip').html("");
		 				
		 				
		 		$('#proce').parent().removeClass('has-error');
		 		$('.proce').html("");
		 					
		 		$('#freq').parent().removeClass('has-error');
		 		$('.freq').html("");
		 				
		 		$('#chip').parent().removeClass('has-error');
		 		$('.chip').html("");
		 				
		 		$('#totram').parent().removeClass('has-error');
		 		$('.totram').html("");
		 				
		 		$('#eth').parent().removeClass('has-error');
		 		$('.eth').html("");
		 				
		 		$('#cons').parent().removeClass('has-error');
		 		$('.cons').html("");
		 				
		 		$('#ndisc').parent().removeClass('has-error');
		 		$('.ndisc').html("");
		 				
		 		$('#pack').parent().removeClass('has-error');
		 		$('.pack').html("");
		 				
		 		$('#bat').parent().removeClass('has-error');
		 		$('.bat').html("");
		 				
		 		$('#ph').parent().removeClass('has-error');
		 		$('.ph').html("");
		 				
		 		$('#int').parent().removeClass('has-error');
		 		$('.int').html("");
		 				
		 		$('#taidisc').parent().removeClass('has-error');
		 		$('.taidisc').html("");
		 }

		 
		 $(document).on('submit','#addMateriel',function(e){
		 	e.preventDefault();
		 		
		 	vider();

		 	$.ajax({
		 		type : 'post',
		 		url  : $(this).attr('action'),
		 		data : $(this).serialize(),
		 		success:function(data){
		 			if(data.errors){
		 				if(data.errors.numSerie){
		 					$('#a').parent().addClass('has-error');
		 					$('.a').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.numSerie[0]+'</i>');
		 				}
		 				if(data.errors.marque){
		 					$('#b').parent().addClass('has-error');
		 					$('.b').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.marque[0]+'</i>');
		 				}
		 				if(data.errors.model){
		 					$('#c').parent().addClass('has-error');
		 					$('.c').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.model[0]+'</i>');
		 				}
		 				if(data.errors.Type){
		 					$('#k').parent().addClass('has-error');
		 					$('#k').addClass('has-error');
		 					$('.k').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.Type[0]+'</i>');
		 				}
		 				if(data.errors.fournisseur)
		 				{
		 					$('#d').parent().addClass('has-error');
		 					$('#d').addClass('has-error');
		 					$('.d').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.fournisseur[0]+'</i>');
		 				}
		 				if(data.errors.dateAcquisition)
		 				{
		 					$('#e').parent().parent().addClass('has-error');
		 					$('.e').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.dateAcquisition[0]+'</i>');
		 				}
		 				if(data.errors.valeurAcquisition){
		 					$('#f').parent().addClass('has-error');
		 					$('.f').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.valeurAcquisition[0]+'</i>');
		 				}
		 				if(data.errors.garantie)
		 				{
		 					$('#g').parent().addClass('has-error');
		 					$('.g').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.garantie[0]+'</i>');
		 				}
		 				if(data.errors.departement)
		 				{
		 					$('#h').parent().addClass('has-error');
		 					$('#h').addClass('has-error');
		 					$('.h').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.departement[0]+'</i>');
		 				}
		 				if(data.errors.dateAffectation)
		 				{
		 					$('#af').parent().parent().addClass('has-error');
		 					$('.af').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.dateAffectation[0]+'</i>');
		 				}
		 				if(data.errors.duréeVie)
		 				{
		 					$('#j').parent().addClass('has-error');
		 					$('.j').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.duréeVie[0]+'</i>');
		 				}
		 				if(data.errors.puissance)
		 				{
		 					$('#l').parent().addClass('has-error');
		 					$('.l').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.puissance[0]+'</i>');
		 				}
		 				if(data.errors.maintenable)
		 				{
		 					$('#l1').parent().addClass('has-error');
		 					$('.l1').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.maintenable[0]+'</i>');
		 				}
		 				/////////////
		 				if(data.errors.adrIp)
		 				{
		 					$('#ip').parent().addClass('has-error');
		 					$('.ip').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.adrIp[0]+'</i>');
		 				}
		 				if(data.errors.processeur)
		 				{
		 					$('#proce').parent().addClass('has-error');
		 					$('.proce').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.processeur[0]+'</i>');
		 				}
		 				if(data.errors.freqCpu)
		 				{
		 					$('#freq').parent().addClass('has-error');
		 					$('.freq').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.freqCpu[0]+'</i>');
		 				}
		 				if(data.errors.chips)
		 				{
		 					$('#chip').parent().addClass('has-error');
		 					$('.chip').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.chips[0]+'</i>');
		 				}
		 				if(data.errors.totalRam)
		 				{
		 					$('#totram').parent().addClass('has-error');
		 					$('.totram').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.totalRam[0]+'</i>');
		 				}
		 				if(data.errors.ethernetPort)
		 				{
		 					$('#eth').parent().addClass('has-error');
		 					$('.eth').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.ethernetPort[0]+'</i>');
		 				}
		 				if(data.errors.consolePort)
		 				{
		 					$('#cons').parent().addClass('has-error');
		 					$('.cons').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.consolePort[0]+'</i>');
		 				}
		 				if(data.errors.nbDisque)
		 				{
		 					$('#ndisc').parent().addClass('has-error');
		 					$('.ndisc').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.nbDisque[0]+'</i>');
		 				}
		 				if(data.errors.pack)
		 				{
		 					$('#pack').parent().addClass('has-error');
		 					$('.pack').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.pack[0]+'</i>');
		 				}
		 				if(data.errors.bateri)
		 				{
		 					$('#bat').parent().addClass('has-error');
		 					$('.bat').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.bateri[0]+'</i>');
		 				}
		 				if(data.errors.phase)
		 				{
		 					$('#ph').parent().addClass('has-error');
		 					$('.ph').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.phase[0]+'</i>');
		 				}
		 				if(data.errors.intensite)
		 				{
		 					$('#int').parent().addClass('has-error');
		 					$('.int').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.intensite[0]+'</i>');
		 				}
		 				if(data.errors.tailleParDisque)
		 				{
		 					$('#taidisc').parent().addClass('has-error');
		 					$('.taidisc').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.tailleParDisque[0]+'</i>');
		 				}
		 			}
		 			else{
		 				$('.btn-reset').trigger('click');
		 				state();
		 				//alerta
		 			}
		 		}
		 	});
		 });
		
		function initialiseMenu(){
			var icon;
			$.ajax({
				type:'get',
				url : '{{route("MenuGeter")}}',
				success:function(data){
					$.each(data,function(index,ind){
						if(ind.categorie == "Reseau"){icon = "signal";}
						if(ind.categorie == "Ordinateur"){icon = "laptop";}
						if(ind.categorie == "Peripherique"){icon = "desktop";}
						if(ind.categorie == "Electrique"){icon = "bolt bol";}
						$('#MenuC').append('<li><a data-id="'+ind.id_catg+'" id="ch" href="home?gpi='+ind.id_catg+'"><i class="icon-'+icon+'"></i> <span>'+ind.categorie+'</span></a></li>');

						if(index == 0){
							$('.menuSide').append('<a id="sd" data-id="'+ind.id_catg+'" href="home?gpi='+ind.id_catg+'" style="border-bottom: 0px;" class="list-group-item"><span style="padding-left: 22px;"><i id="i" class="icon-'+icon+'"></i>  <span id="spn">'+ind.categorie+'</span></span></a>');
						}else{
							$('.menuSide').append('<a id="sd" data-id="'+ind.id_catg+'" href="home?gpi='+ind.id_catg+'" style="border-bottom: 0px;border-top:0px;" class="list-group-item"><span style="padding-left: 22px;"><i id="i" class="icon-'+icon+'"></i>  <span id="spn">'+ind.categorie+'</span></span></a>');
						}
					});
					$('#MenuC').append('<li><a data-id="0" id="ch" href="home">&nbsp;&nbsp;&nbsp;&nbsp;<span>Tous</span></a></li>');
					$('.menuSide').append('<a id="sd" data-id="0" href="home" style="border-bottom: 0px;border-top:0px;" class="list-group-item"><span style="padding-left: 22px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span id="spn">Tous</span></span></a>');
				}
			});
		}

		initialiseMenu();

		//a chaque click du menu Categorie

			$(document).on('click','#ch,#sd',function(e){
				e.preventDefault();
				var ch;
				$('input[name="search"]').val("");
				if($(this).attr('id') == "ch"){
					ch = $(this).find('span').html();
				}else{ ch = $(this).find('#spn').html(); }

				if($('#pageIndex').hasClass('activated')){
					$('#processeur').css('visibility','visible');
					if( ch != "Tous"){
						$('#titre').find('span').html(ch);
					}else{$('#titre').find('span').html("Materiels");}
					
					$('#pageIndex').html($(this).data('id'));
					$('#sType').empty();
					$('#s2id_sType .select2-choice > .select2-chosen').html("Selectionner type");

					//remlissage du select
					if($(this).data('id') != 0){
						$.ajax({
						type:'get',
						url: 'getSousCat/'+$(this).data('id'),
						success:function(data){
							$('#sType').append('<option value="0"> Selectionner type </option>');
							$.each(data,function(index,ind){
								$('#sType').append('<option value="'+ind.id_catg+'"> '+ind.categorie+' </option>');
								});
							}
						});
					}
					
					$.ajax({
						type:'get',
						url: $(this).attr('href'),
						success:function(data){
							$('#ajax').html(data);
							$('#processeur').css('visibility','hidden');
						}
					});
				}else{
					window.location.replace($(this).attr('href'));
				}
			});

			$(document).on('change','#sType',function(){
				var id = $(this).val();
				var uri;
				if(id != 0){
					uri = 'loadType/'+id;
				}else{
					uri = 'home?gpi='+ $('#pageIndex').html();
				}
				$.ajax({
					type:'get',
					url: uri,
					success:function(data){
						$('#ajax').html(data);
					}
				});
			});

				///modification materiel

			function resetForm(){

				$('#fa').val("");
				$('#fb').val("");
				$('#ab').val("");
				$('#fc').val("");
				$('#fe').val("");
				$('#ff').val("");
				$('#fg').val("");
				$('#fj').val("");
				$('#fl').val("");
				$('#l3').val("");

				
				$('#s2id_df .select2-choice > .select2-chosen').html("");

				$('#m').val("");
				$('#n').val("");
				$('#o').val("");
				$('#l').val("");
				$('#imprtype').val("");
				$('#auto').val("");
				$('#f').val("");
				$('#typos').val("");
				$('#lang').val("");
				$('#modcpu').val("");
				$('#typram').val("");
				$('#typdisc').val("");
				$('#srv').val("");
				$('#raid').val("");
				$('#typswi').val("");

				$('#fchip').val("");
				$('#feth').val("");
				$('#fcons').val("");
				$('#fph').val("");
				$('#fbat').val("");
				$('#fpack').val("");
				$('#fproce').val("");
				$('#fndisc').val("");
				$('#ffreq').val("");
				$('#fip').val("");
				$('#ftotram').val("");
				$('#ftaidisc').val("");
				$('#fint').val("");
			}

			$(document).on('submit','#ModifMateriel',function(e){
				e.preventDefault();
				
				$('.fa').html("");
				$('.fb').html("");
				$('.fc').html("");
				$('.fe').html("");
				$('.ff').html("");
				$('.fg').html("");
				$('.fj').html("");
				$('.fl').html("");
				$('.l3').html("");

				$('.feth').html("");
				$('.fcons').html("");
				$('.fph').html("");
				$('.fbat').html("");
				$('.fpack').html("");
				$('.fproce').html("");
				$('.fchip').html("");
				$('.fndisc').html("");
				$('.ffreq').html("");
				$('.fip').html("");
				$('.ftotram').html("");
				$('.ftaidisc').html("");
				$('.fint').html("");

				$('#fa').parent().removeClass('has-error');
				$('#fb').parent().removeClass('has-error');
				$('#fc').parent().removeClass('has-error');
				$('#fe').parent().removeClass('has-error');
				$('#ff').parent().removeClass('has-error');
				$('#fg').parent().removeClass('has-error');
				$('#fj').parent().removeClass('has-error');
				$('#fl').parent().removeClass('has-error');
				$('#l3').parent().removeClass('has-error');


				$('#feth').parent().removeClass('has-error');
				$('#fcons').parent().removeClass('has-error');
				$('#fph').parent().removeClass('has-error');
				$('#fbat').parent().removeClass('has-error');
				$('#fpack').parent().removeClass('has-error');
				$('#fproce').parent().removeClass('has-error');
				$('#fchip').parent().removeClass('has-error');
				$('#fndisc').parent().removeClass('has-error');
				$('#ffreq').parent().removeClass('has-error');
				$('#fip').parent().removeClass('has-error');
				$('#ftotram').parent().removeClass('has-error');
				$('#ftaidisc').parent().removeClass('has-error');
				$('#fint').parent().removeClass('has-error');

				$.ajax({
					type:'post',
					url : $(this).attr('action'),
					data : $(this).serialize(),
					success : function(data){
						if(data.errors){
							if(data.errors.numSerie){
								$('.fa').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.numSerie[0]+'</i>');
								$('#fa').parent().addClass('has-error');
							}
							if(data.errors.marque){
								$('.fb').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.marque[0]+'</i>');
								$('#fb').parent().addClass('has-error');
							}
							if(data.errors.model){
								$('.fc').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.model[0]+'</i>');
								$('#fc').parent().addClass('has-error');
							}
							if(data.errors.dateAcquisition){
								$('.fe').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.dateAcquisition[0]+'</i>');
								$('#fe').parent().addClass('has-error');
							}
							if(data.errors.valeurAcquisition){
								$('.ff').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.valeurAcquisition[0]+'</i>');
								$('#ff').parent().addClass('has-error');
							}
							if(data.errors.garantie){
								$('.fg').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.garantie[0]+'</i>');
								$('#fg').parent().addClass('has-error');
							}
							
							if(data.errors.duréeVie){
								$('.fj').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.duréeVie[0]+'</i>');
								$('#fj').parent().addClass('has-error');
							}
							if(data.errors.maintenable){
								$('.fl').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.maintenable[0]+'</i>');
								$('#fl').parent().addClass('has-error');
							}

							if(data.errors.processeur){
								$('.fproce').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.processeur[0]+'</i>');
								$('#fproce').parent().addClass('has-error');
							}
							if(data.errors.freqCpu){
								$('.ffreq').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.freqCpu[0]+'</i>');
								$('#ffreq').parent().addClass('has-error');
							}
							if(data.errors.pack){
								$('.fpack').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.pack[0]+'</i>');
								$('#fpack').parent().addClass('has-error');
							}
							if(data.errors.chips){
								$('.fchip').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.chips[0]+'</i>');
								$('#fchip').parent().addClass('has-error');
							}
							if(data.errors.totalRam){
								$('.ftotram').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.totalRam[0]+'</i>');
								$('#ftotram').parent().addClass('has-error');
							}
							if(data.errors.nbDisque){
								$('.fndisc').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.nbDisque[0]+'</i>');
								$('#fndisc').parent().addClass('has-error');
							}
							if(data.errors.tailleParDisque){
								$('.ftaidisc').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.tailleParDisque[0]+'</i>');
								$('#ftaidisc').parent().addClass('has-error');
							}
							if(data.errors.puissance){
								$('.l3').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.puissance[0]+'</i>');
								$('#l3').parent().addClass('has-error');
							}
							if(data.errors.adrIp){
								$('.fip').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.adrIp[0]+'</i>');
								$('#fip').parent().addClass('has-error');
							}
							if(data.errors.ethernetPort){
								$('.feth').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.ethernetPort[0]+'</i>');
								$('#feth').parent().addClass('has-error');
							}
							if(data.errors.consolePort){
								$('.fcons').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.consolePort[0]+'</i>');
								$('#fcons').parent().addClass('has-error');
							}
							if(data.errors.bateri){
								$('.fbat').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.bateri[0]+'</i>');
								$('#fbat').parent().addClass('has-error');
							}
							if(data.errors.phase){
								$('.fph').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.phase[0]+'</i>');
								$('#fph').parent().addClass('has-error');
							}
							if(data.errors.intensite){
								$('.fint').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.intensite[0]+'</i>');
								$('#fint').parent().addClass('has-error');
							}
						}else{
							resetForm();
							window.location.replace("{{ route('home') }}");
							//alerta
							/*x0p('Message', 'Hello world!', 'ok');*/
						}
					}
				});

			});


	//page utilisateur

	

	$(document).on('click','#cont',function(){

		$('a[href="#tab_2"]').tab('show');
		
	});

	function getData2(page,arg){
	
		var cible;
             if(arg == undefined){
             	cible='pagination/uti?page='+page;
             }else{
             	cible='pagination/uti?page='+page+'&arg='+arg;
             }
             $('#processeur').css('visibility','visible');
             $.ajax({
             	type:'get',
             	url: cible,
             	success:function(data){
             		$('#ajax_uti').html(data);
             		$('#processeur').css('visibility','hidden');
             	}
             });

	}



	$(document).on('click','.pagin_util .pagination a',function(e){
		e.preventDefault();
                if($('input[name="search_uti"]').val().trim() !== ""){
                	var arg = $('input[name="search_uti"]').val();
                }
                var page = $(this).attr('href').split('page=')[1];
               	getData2(page,arg);
	});

	$(document).on('click','.add_util',function(){
		if($('#addUtilisateur').css('display') == "block")
		{	
			$('#addUtilisateur').slideUp(300);
		}else{
			reinitForm();
			$('#addUtilisateur').trigger('reset');
			
			$('#ser').empty();
			$.ajax({
				type : 'get',
				url : 'getDep',
				success:function(data){
					$('#ser').append('<option value="0">Choix service</option>');
					$('#s2id_ser .select2-choice > .select2-chosen').html("Choix service");
					$.each(data,function(index,ind){
						$('#ser').append('<option value="'+ind.id_dep+'">'+ind.nom+'</option>');
					});
				}
			});
			$('#addUtilisateur').slideDown(300);
		}
		
	});
	$(document).on('click','.reset_util',function(e){
		e.preventDefault();

		$('#addUtilisateur').trigger('reset');
		$('#addUtilisateur').slideUp(300);
	});

	$(document).on('change','#const2',function(){
		var constante = $(this).val();
		$('#processeur').css('visibility','visible');
		$.ajax({
			type:'get',
			url : 'utilisateur/'+constante,
			success:function(data){
				$('#ajax_uti').html(data);
				$('#processeur').css('visibility','hidden');
			}
		});
	});

	$(document).on('keyup','input[name="search_uti"]',function(){
		var indice = $(this).val();
		$('#processeur').css('visibility','visible');
		var cible;
		if($('#departe').val() != 0){
			cible = 'rechercheUti?search='+indice+'&dep='+$('#departe').val();
		}else{
			cible = 'rechercheUti?search='+indice;
		}
		$.ajax({
			type:'get',
			url :cible,
			success:function(data){
				$('#ajax_uti').html(data);
				$('#processeur').css('visibility','hidden');
			}
		});
	});

	$(document).on('change','#departe',function(){
		$('input[name="search_uti"]').val("");
		$('#processeur').css('visibility','visible');
		$.ajax({
			type : 'get',
			url  : 'utilisateur?service='+ $(this).val(),
			success:function(data){
				$('#ajax_uti').html(data);
				$('#processeur').css('visibility','hidden');
			}
		});
	});

	function reinitForm(){

		$('#ser').removeClass('has-error');
		$('.ser').parent().removeClass('has-error');
		$('.ser').html("");

		$('#nom').parent().parent().removeClass('has-error');
		$('.nom').html("");

		$('#prenom').parent().parent().removeClass('has-error');
		$('.prenom').html("");

		$('#email').parent().parent().removeClass('has-error');
		$('.email').html("");

		$('#portab').parent().parent().removeClass('has-error');
		$('.portab').html("");

		$('#fix').parent().parent().removeClass('has-error');
		$('.fix').html("");
	}

	$(document).on('submit','#addUtilisateur',function(e){
		e.preventDefault();
		//reinitForm();
		var id = $('input[name="idModif"]').val().trim();
		var cible;
		if(id == ""){
			cible = 'ajoutUtil';
		}else{
			cible = 'modifUtil';
		}
		$.ajax({
			type:'post',
			url: cible,
			data:$(this).serialize(),
			success:function(data){
				if(data.errors){
					if(data.errors.service){
						$('#ser').addClass('has-error');
						$('.ser').parent().addClass('has-error');
						$('.ser').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.service[0]+'</i>');
					}
					if(data.errors.nom){
						$('#nom').parent().parent().addClass('has-error');
						$('.nom').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.nom[0]+'</i>');
					}
					if(data.errors.prenom){
						$('#prenom').parent().parent().addClass('has-error');
						$('.prenom').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.prenom[0]+'</i>');
					}
					if(data.errors.email){
						$('#email').parent().parent().addClass('has-error');
						$('.email').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.email[0]+'</i>');
					}
					if(data.errors.telPortable){
						$('#portab').parent().parent().addClass('has-error');
						$('.portab').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.telPortable[0]+'</i>');
					}
					if(data.errors.telFix){
						$('#fix').parent().parent().addClass('has-error');
						$('.fix').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.telFix[0]+'</i>');
					}
				}else{

					if(id == ""){
						var v;
						getData2(data,v);
						state();
					}else{
						var adr = (data.adresse != null) ? data.adresse : ''; 
						$('#utilis tr[data-ligne="'+id+'"]').replaceWith('<tr data-ligne="'+data.id_uti+'">'+
							'<td>'+data.nom_u+'</td>'+
							'<td>'+data.prenom+'</td>'+
							'<td>'+adr+'</td>'+
							'<td>'+data.email+'</td>'+
							'<td>'+data.TelPort+'</td>'+
							'<td>'+data.TelFix+'</td>'+
							'<td class="align-center">'+
							'<span class="btn-group">'+
								'<a class="btn btn-xs" id="modif_uti" data-id="'+data.id_uti+'" href="#">'+
										'<i class="icon-edit"></i></a>'+
								'<a href="#" class="btn btn-xs" id="delUti" data-id="'+data.id_uti+'">'+
										'<i class="icon-trash"></i>'+
										'</a>'+
									'</span>'+
								'</td>'+
							'</tr>');
						}
						//alerta
						$('#s2id_ser .select2-choice > .select2-chosen').html("Choix service");
						$('#ser').val("0");
						$('#addUtilisateur').trigger('reset');
						$('#addUtilisateur').slideUp(300);
					//alerta
				}
			}
		})
	});


	$(document).on('click','#modif_uti',function(e){
		e.preventDefault();
		var idMod = $(this).data('id');
		reinitForm();
		$('#ser').empty();
		$.ajax({
			typpe:'get',
			url:'recuperUti/'+idMod,
			success:function(data){
				$('#ser').append('<option value="'+data.u.id_dep+'">'+data.u.nom+'</option>');
				$('#s2id_ser .select2-choice > .select2-chosen').html(data.u.nom);
				$.each(data.nu,function(index,ind){
					$('#ser').append('<option value="'+ind.id_dep+'">'+ind.nom+'</option>');
				});

				$('#nom').val(data.u.nom_u);
				$('#prenom').val(data.u.prenom);
				$('#adresse').val(data.u.adresse);
				$('#email').val(data.u.email);
				$('#portab').val(data.u.TelPort);
				$('#fix').val(data.u.TelFix);

				$('input[name="idModif"]').val(data.u.id_uti);
				$('#addUtilisateur').slideDown(300);
			}
		});
	});

	//page fournisseur

		function getData3(page,arg){
		var cible;
             if(arg == undefined){
             	cible='pagination/fsr?page='+page;
             }else{
             	cible='pagination/fsr?page='+page+'&arg='+arg;
             }
             $('#processeur2').css('visibility','visible');
             $.ajax({
             	type:'get',
             	url: cible,
             	success:function(data){
             		$('#ajax_fsr').html(data);
             		$('#processeur2').css('visibility','hidden');
             	}
             });
		}

		function getData4(page,arg){
			var cible;
			if(arg == undefined){
				cible = 'pagination/prst?page='+page;
			}else{
				cible = 'pagination/prst?page='+page+'&arg='+arg;
			}
			$('#processeur3').css('visibility','visible');
			$.ajax({
				type:'get',
				url:cible,
				success:function(data){
					$('#ajax_prst').html(data);
					$('#processeur3').css('visibility','hidden');
				}
			});
		}

		$(document).on('click','.pagin_fsr .pagination a',function(e){
			e.preventDefault();
			if($('input[name="search_fsr"]').val().trim() !== ""){
                	var arg = $('input[name="search_fsr"]').val();
                }
                var page = $(this).attr('href').split('page=')[1];
                getData3(page,arg);
		});
		//pagination prestataire
		$(document).on('click','.pagin_prest .pagination a',function(e){
			e.preventDefault(); 
			if($('input[name="search_prst"]').val().trim() !== ""){
				var arg = $('input[name="search_prst"]').val();
			}
			var page = $(this).attr('href').split('page=')[1];
			getData4(page,arg);
		});

		$(document).on('keyup','input[name="search_fsr"]',function(){
			var arg = $(this).val();
			$('#processeur2').css('visibility','visible');
			$.ajax({
				type:'get',
				url:'searchFrs?arg='+arg,
				success:function(data){
					$('#ajax_fsr').html(data);
					$('#processeur2').css('visibility','hidden');
				}
			});
		});

		$(document).on('keyup','input[name="search_prst"]',function(){
			var arg = $(this).val();
			$('#processeur3').css('visibility','visible');
			$.ajax({
				type:'get',
				url:'searchPrst?arg='+arg,
				success:function(data){
					$('#ajax_prst').html(data);
					$('#processeur3').css('visibility','hidden');
				}
			});
		});

		$(document).on('change','#const3',function(){
			$('input[name="search_fsr"]').val("");
			var const2 = $(this).val();
			$.ajax({
				type:'get',
				url:'utilisateur?const2='+const2,
				success:function(data){
					$('#ajax_fsr').html(data);
				}
			});
		});

		$(document).on('change','#const4',function(){
				$('input[name="search_prst"]').val("");
			var const3 = $(this).val();
			$.ajax({
				type:'get',
				url:'utilisateur?const3='+const3,
				success:function(data){
					 $('#ajax_prst').html(data);
				}
			});
		});

		function DateConverter(date)
		{	
			return moment(date).format('ll');
		}

		function populate(data){
				$.each(data.reso,function(index,r){
						$('#contener_m').append('<li class="hoverable">'+
														'<a href="#" data-id="'+r.id_ma +'">'+
														'<div class="col1">'+
														'<div class="content">'+
														'<div class="content-col1">'+
														'<div class="label label-info">'+
														'<i class="icon-signal"></i>'+
														'</div></div><div class="content-col2"><div class="desc">'+r.categorie+' '+r.marque+' '+r.model +'</div>'+
														'</div></div></div> '+
														'<div class="col2">'+
														'<div class="date">'+
														DateConverter(r.date_acqui) +
														'</div></div></a></li>');
					});

					$.each(data.elec,function(index,e){
						$('#contener_m').append('<li class="hoverable">'+
														'<a href="#" data-id="'+e.id_ma +'">'+
														'<div class="col1">'+
														'<div class="content">'+
														'<div class="content-col1">'+
														'<div class="label label-warning">'+
														'<i class="icon-bolt"></i>'+
														'</div></div><div class="content-col2"><div class="desc">'+e.categorie+' '+e.marque+' '+e.model +'</div>'+
														'</div></div></div> '+
														'<div class="col2">'+
														'<div class="date">'+
														DateConverter(e.date_acqui) +
														'</div></div></a></li>');
					});

					$.each(data.periph,function(index,p){
						$('#contener_m').append('<li class="hoverable">'+
														'<a href="#" data-id="'+p.id_ma +'">'+
														'<div class="col1">'+
														'<div class="content">'+
														'<div class="content-col1">'+
														'<div class="label label-success">'+
														'<i class="icon-desktop"></i>'+
														'</div></div><div class="content-col2"><div class="desc">'+p.categorie+' '+p.marque+' '+p.model +'</div>'+
														'</div></div></div> '+
														'<div class="col2">'+
														'<div class="date">'+
														DateConverter(p.date_acqui) +
														'</div></div></a></li>');
					});

					$.each(data.ordi,function(index,o){
						$('#contener_m').append('<li class="hoverable">'+
														'<a href="#" data-id="'+o.id_ma +'">'+
														'<div class="col1">'+
														'<div class="content">'+
														'<div class="content-col1">'+
														'<div class="label label-default">'+
														'<i class="icon-laptop"></i>'+
														'</div></div><div class="content-col2"><div class="desc">'+o.categorie+' '+o.marque+' '+o.model +'</div>'+
														'</div></div></div> '+
														'<div class="col2">'+
														'<div class="date">'+
														DateConverter(o.date_acqui) +
														'</div></div></a></li>');
					});
		}

		$(document).on('click','#mater_fsr',function(e){
			e.preventDefault();
			$('tr#selectable').css('background-color','');


			$(this).parent().parent().parent().css('background-color','#f3f3f3');

			var id = $(this).data('id');
			$('#contener_m').empty();
			$.ajax({
				type:'get',
				url:'recup_m/'+id,
				success:function(data){
					populate(data);
				}
			});
		});

		$(document).on('click','.refresh',function(){
			$('#contener_m').empty();
			$.ajax({
				type:'get',
				url : 'recup_m/0',
				success:function(data){
					populate(data);
				}
			});
		});

		$(document).on('click','#openModal',function(e){
			e.preventDefault();
			$('#f1').parent().removeClass('has-error');
		 	$('#f2').parent().removeClass('has-error');
		 	$('#f3').parent().removeClass('has-error');
		 	$('.f1').html("");
		 	$('.f2').html("");
		 	$('.f3').html("");
			$('#addTier').trigger('reset');
			$('#fournisseurModal').modal('show');
		})


		$(document).on('click','.hoverable a',function(e){
			e.preventDefault();
			var id = $(this).data('id');
			$.ajax({
				type:'get',
				url:'getDetail/'+id+'?modal=true',
				success:function(data){
					$('.modal_contener').html(data);
					$('#ModalDetail').modal('show');
				}
			});
		});

		$(document).on('click','#modif_fsr',function(){
			var id = $(this).data('id');
			$('.f1_').html("");
			$('#f1_').parent().removeClass('has-error');
			$('.f2_').html("");
			$('#f2_').parent().removeClass('has-error');

			$('#modTier').trigger('reset');

			$('input[name="id_fsr_modif"]').val(id);

			$.ajax({
				type:'get',
				url:'editFsr/'+id,
				success:function(data){
					$('#f1_').val(data.nom);
					$('#f2_').val(data.contact);
					$('#f3_').val(data.adr);
					$('#fournisseurModif').modal('show');
				}
			});
		});

		$(document).on('submit','#modTier',function(e){
			e.preventDefault();

			$('.f1_').html("");
			$('#f1_').parent().removeClass('has-error');
			$('.f2_').html("");
			$('#f2_').parent().removeClass('has-error');

			$.ajax({
				type:'post',
				url:'modificationFournisseur',
				data: $(this).serialize(),
				success:function(data){
					if(data.errors)
					{
						if(data.errors.nom){
							$('.f1_').html(data.errors.nom[0]);
							$('#f1_').parent().addClass('has-error');
						}
						if(data.errors.contact){
							$('.f2_').html(data.errors.contact);
							$('#f2_').parent().addClass('has-error');
						}
					}else{
						var id = $('input[name="id_fsr_modif"]').val();
						var adr = (data.adr != null) ? data.adr : ''; 
						$('#suplier tr[data-ligne="'+id+'"]').replaceWith('<tr data-ligne="'+data.id_tier+'">'+
							'<td>'+data.nom +'</td><td>'+adr +'</td><td>'+data.contact+'</td>'+
							'<td class="align-center"><span class="btn-group">'+
							'<a class="btn btn-xs" id="mater_fsr" data-id="'+data.id_tier +'" href="#">'+
							'<i class="icon-hdd"></i></a>'+
							'<a class="btn btn-xs" id="modif_fsr" data-id="'+data.id_tier +'" href="#">'+
							'<i class="icon-edit"></i></a>'+
							'<a  class="btn btn-xs" id="delFrs" data-id="'+data.id_tier +'" href="#">'+
							'<i  class="icon-trash"></i></a></span></td></tr>');

							$('#fournisseurModif').modal('hide');
					}
				}
			});
		});

		function reseter(){
			$('#f1_p').val("");
			$('#f2_p').val("");
			$('#f3_p').val("");
			$('input[name="idModPrst"]').val("");

			$('.f1_p').html("");
			$('.f2_p').html("");
			$('.f3_p').html("");


			$('#f1_p').parent().removeClass('has-error');
			$('#f2_p').parent().removeClass('has-error');
			$('#f3_p').parent().removeClass('has-error');
		}


		$(document).on('click','#openModalPrst',function(e){
			e.preventDefault();
			reseter();
			$('#prestataireModal').modal('show');
		});

		$(document).on('submit','#addPrest',function(e){
			e.preventDefault();
			$('.f1_p').html("");
			$('.f2_p').html("");
			$('.f3_p').html("");

			$('#f1_p').parent().removeClass('has-error');
			$('#f2_p').parent().removeClass('has-error');
			$('#f3_p').parent().removeClass('has-error');
			var cible;
			var id = $('input[name="idModPrst"]').val();
			if( id == ""){
				cible = $(this).attr('action');
			}else{
				cible = 'modifPrest';
			}

			$.ajax({
				type:'post',
				url:cible,
				data:$(this).serialize(),
				success:function(data){
					if(data.errors){
						if(data.errors.nom){
							$('#f1_p').parent().addClass('has-error');
							$('.f1_p').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.nom[0]+'</i>');
						}
						if(data.errors.contact){
							$('#f2_p').parent().addClass('has-error');
							$('.f2_p').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.contact[0]+'</i>');
						}
					}else{
						if(id == ""){
							var arg;
							getData4(data,arg);
						}else{
					
							var adr = (data.adr != null) ? data.adr : ''; 
							$('#prestataire tr[data-ligne="'+id+'"]').replaceWith('<tr id="selectable" data-ligne="'+data.id_tier +'">'+
							'<td>'+data.nom +'</td>'+
							'<td>'+adr +'</td>'+
							'<td>'+data.contact +'</td>'+
							'<td class="align-center">'+
							'<span class="btn-group">'+
							'<a class="btn btn-xs" id="inter_prst" data-id="'+data.id_tier +'" href="#">'+
							'<i class="icon-hdd"></i>'+
							'</a><a class="btn btn-xs" id="modif_prst" data-id="'+data.id_tier +'" href="#">'+
							'<i class="icon-edit"></i>'+
							'</a><a class="btn btn-xs" id="delPrest" data-id="'+data.id_tier +'" href="#">'+
							'<i class="icon-trash"></i></a></span></td></tr>');
//////////////////////////////////////////////////////////////////////////////////////////////////////////
						}
						reseter();
						state();
						$('#prestataireModal').modal('hide');
						
					}
				}
			});
		});

		$(document).on('click','#modif_prst',function(e){
			e.preventDefault();
			var id = $(this).data('id');
			$('input[name="idModPrst"]').val(id);
			$.ajax({
				type:'get',
				url:'editFsr/'+id,
				success:function(data){
					//console.log(data);
					$('#f1_p').val(data.nom);
					$('#f2_p').val(data.contact);
					$('#f3_p').val(data.adr);

					$('#prestataireModal').modal('show');
				}
			});
		});

		$(document).on('click','#inter_prst',function(){
			var id= $(this).data('id');
			$('input[name="idTemp"]').val(id);
			$('tr#selectable').css('background-color','');
			$(this).parent().parent().parent().css('background-color','#f3f3f3');
			$('#processeur4').css('visibility','visible');
			$.ajax({
				type:'get',
				url : 'getInter/'+id,
				success:function(data){
					$('#ajax_inter').html(data);
					$('#processeur4').css('visibility','hidden');
				}
			});
		});

		$(document).on('click','#refreshInter',function(e){
			e.preventDefault();
			$('input[name="idTemp"]').val("");
			$('input[name="search_inter"]').val("");
			$('tr#selectable').css('background-color','');
			$('#processeur4').css('visibility','visible');

			$.ajax({
				type:'get',
				url:'refreshInter',
				success:function(data){
					$('#ajax_inter').html(data);
					$('#processeur4').css('visibility','hidden');
				}
			});
		});

		$(document).on('change','#const5',function(){
			var param = $('input[name="idTemp"]').val();
			var constante = $(this).val();
			$('#processeur4').css('visibility','visible');
			$.ajax({
				type:'get',
				url:'refreshInter?tier='+param+'&const='+constante,
				success:function(data){
					$('#ajax_inter').html(data);
					$('#processeur4').css('visibility','hidden');
				}
			});
		});

		//pagination intervention

		function getData5(page,idp,arg){
			var url;
			if(idp != "" && arg != undefined){
				url = 'pagination/inter?page='+page+'&idp='+idp+'&arg='+arg;
			}
			if(idp != "" && arg == undefined){
				url = 'pagination/inter?page='+page+'&idp='+idp;
			}
			if(idp == "" && arg != undefined){
				url = 'pagination/inter?page='+page+'&arg='+arg;
			}
			if(idp == "" && arg == undefined){
				url = 'pagination/inter?page='+page;
			}
			$('#processeur4').css('visibility','visible');
			$.ajax({
				type:'get',
				url:url,
				success:function(data){
					$('#ajax_inter').html(data);
					$('#processeur4').css('visibility','hidden');
				}
			});
		}

		$(document).on('click','.pagin_inter .pagination a',function(e){
			e.preventDefault(); 
			if($('input[name="search_inter"]').val().trim() !== ""){
				var arg = $('input[name="search_inter"]').val();
			}
			var idp = $('input[name="idTemp"]').val();
			var page = $(this).attr('href').split('page=')[1];
			getData5(page,idp,arg);
		});

		//recherche inter
		$(document).on('keyup','input[name="search_inter"]',function(){
			var arg = $(this).val();
			var idp = $('input[name="idTemp"]').val();
			$('#processeur4').css('visibility','visible');
			$.ajax({
				type:'get',
				url: 'pagination/inter?arg='+arg+'&idp='+idp,
				success:function(data){
					$('#ajax_inter').html(data);
					$('#processeur4').css('visibility','hidden');
				}
			});
		});

		//historique intervention

		$(document).on('change','#interType',function(){
			$('input[name="search_histo"]').val("");
			$.ajax({
				type:'get',
				url :'historique?type='+$(this).val(),
				success:function(data){
					$('#ajax_histo').html(data);
				}
			});
		});
		//pagination histo
		$(document).on('click','.pagin_histo .pagination a',function(e){
			e.preventDefault();
			var page = $(this).attr('href').split('page=')[1];
			var type = $('#interType').val();
			var arg = $('input[name="search_histo"]').val();
			$('#processeur5').css('visibility','visible');
			$.ajax({
				type:'get',
				url:'pagination/histo?page='+page+'&type='+type+'&arg='+arg,
				success:function(data){
					$('#ajax_histo').html(data);
					$('#processeur5').css('visibility','hidden');
				}
			});
		});

		//recherche
		$(document).on('keyup','input[name="search_histo"]',function(){
			var type = $('#interType').val();
			$('#processeur5').css('visibility','visible');
			$.ajax({
				type:'get',
				url:'recherche_histo?arg='+$(this).val()+'&type='+type,
				success:function(data){
					$('#ajax_histo').html(data);
					$('#processeur5').css('visibility','hidden');
				}
			});
		});

		$(document).on('change','#const6',function(){
			var const6 = $(this).val();
			var type = $('#interType').val();
			var arg = $('input[name="search_histo"]').val();
			$('#processeur5').css('visibility','visible');
			$.ajax({
				type:'get',
				url:'recherche_histo/'+const6+'?arg='+arg+'&type='+type,
				success:function(data){
					$('#ajax_histo').html(data);
					$('#processeur5').css('visibility','hidden');
				}
			});
		});

		//tracabilite

		$('#s2id_traceType .select2-choice > .select2-chosen').html("Selectionner type");
		$('#traceType').val('0');

		$(document).on('change','#traceType',function(){
			$('input[name="search_trace"]').val("");
			var type = $(this).val();
			$('#processeur6').css('visibility','visible');
			$.ajax({
				type:'get',
				url:'trie/'+type,
				success:function(data){
					$('#ajax_trace').html(data);
					$('#processeur6').css('visibility','hidden');
				}
			});
		});

		$(document).on('click','.pagin_trace .pagination a',function(e){
			e.preventDefault();
			var page = $(this).attr('href').split('page=')[1];
			var type = $('#traceType').val();
			var arg = $('input[name="search_trace"]').val();
			$('#processeur6').css('visibility','visible');
			$.ajax({
				type:'get',
				url:'tracabilite?page='+page+'&type='+type+'&arg='+arg,
				success:function(data){
					$('#ajax_trace').html(data);
					$('#processeur6').css('visibility','hidden');
				}
			});
		});

		$(document).on('keyup','input[name="search_trace"]',function(){
			$('#processeur6').css('visibility','visible');
			$.ajax({
				type:'get',
				url:'search?arg='+$(this).val()+'&type='+$('#traceType').val(),
				success:function(data){
					$('#ajax_trace').html(data);
					$('#processeur6').css('visibility','hidden');
				}
			});
		});

		$(document).on('change','#const7',function(){
			//$('input[name="search_trace"]').val("");
			var type = $('#traceType').val();
			var constant = $(this).val();
			var arg = $('input[name="search_trace"]').val();
			$('#processeur6').css('visibility','visible');
			$.ajax({
				type:'get',
				url:'tracabilite/'+constant+'?type='+type+'&arg='+arg,
				success:function(data){
					$('#ajax_trace').html(data);
					$('#processeur6').css('visibility','hidden');
				}
			});
		});




		$(document).on('click','#g1',function(){
			if($('#collapseOne').hasClass('panel-collapse collapse')){
				$('.panel-heading[href="#collapseOne"]').trigger('click');
			}
		});
		$(document).on('click','#g2',function(){
			if($('#collapseTwo').hasClass('panel-collapse collapse')){
				$('.panel-heading[href="#collapseTwo"]').trigger('click');
			}
		});
		$(document).on('click','#g3',function(){
			if($('#collapseFor').hasClass('panel-collapse collapse')){
				$('.panel-heading[href="#collapseFor"]').trigger('click');
			}
		});

		////////////////////////////////////////////
		//////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////
		///modal super modal d'affectation fonction consequente

		function getConst(){
			$.ajax({
				type:'get',
				url:'geterConst',
				success:function(data){
					$('#s2id_const8 .select2-choice > .select2-chosen').html(data.c8);
					$('#s2id_const9 .select2-choice > .select2-chosen').html(data.c9);
					$('#s2id_const10 .select2-choice > .select2-chosen').html(data.c10);
					$('#s2id_const11 .select2-choice > .select2-chosen').html(data.c11);
				}
			});
			
		}


		$(document).on('click','#sub',function(){
			fct_reset1();
			fct_reset2();
			fct_reset3();
			resetReforme();
			resetPan();
			getConst();
			$('#g1').trigger('click');
			$('a[href="#tabe_f2"]').tab('show');
			$('#firstCaret').parent().parent().css('background-color','#f9f9f9');
			$('#firstCaret').removeClass('icon-caret-down').addClass('icon-caret-up');
			var serie = $(this).data('serie');
			var marque = $(this).data('marque');
			var id = $(this).data('id');
			$('input[name="temp_serie"]').val(serie);
			$('input[name="temp_id"]').val(id);
			$('input[name="id_mat"]').val(id);
			PaneRep();
			$.ajax({ 
				type:'get',
				url:'getInfo/'+id,
				success:function(data){
					$('.titl').val(data+' '+marque+' serie n° '+serie );
					$('input[name="type_mat"]').val(data);
				//recuperation des tracabilite
			
				$.ajax({
				type:'get',
				url:'getTrace?serie='+serie,
				success:function(data){
					$('#ajax_mtrace').html(data);
					}
				});
				//recuperation maintenance
				$.ajax({
				type:'get',
				url:'getMaintenance?idMa='+id,
				success:function(data){
					$('#ajax_maint').html(data);
					}
				});
				//recuperation reparation
				$.ajax({
					type:'get',
					url:'getRep?idRep='+id,
					success:function(data){
						$('#ajax_rep').html(data);
					}
				});

				//recuperation panne
				$.ajax({
					type:'get',
					url:'getPanne?idMa='+id,
					success:function(data){
						$('#ajax_pan').html(data);
					}
				});
				$('#deprte').empty();
				$('#traitant').empty();
				$('#prest_rep').empty();
				$.ajax({
					type:'get',
					url:'getOptSelect',
					success:function(data){
						$('#deprte').append('<option value="0">Selectionner</option>');
						$('#traitant').append('<option value="0">Selectionner</option>');
						$('#prest_rep').append('<option value="0">Selectionner</option>');
						$.each(data.dep,function(index,ind){
							$('#deprte').append('<option value="'+ind.id_dep+'">'+ind.nom+'</option>')
						});
						$.each(data.prest,function(index,ind){
							$('#traitant').append('<option value="'+ind.id_tier+'">'+ind.nom+'</option>');
							$('#prest_rep').append('<option value="'+ind.id_tier+'">'+ind.nom+'</option>');
						});	
						
					}
				});

					$('#subMenu').modal('show');
				}
			});
		});

		function binder(){
			$('#deprte').empty();
			$('#traitant').empty();
			$('#prest_rep').empty();
			$.ajax({
				type:'get',
				url:'getOptSelect',
				success:function(data){
						$('#deprte').append('<option value="0">Selectionner</option>');
						$('#traitant').append('<option value="0">Selectionner</option>');
						$('#prest_rep').append('<option value="0">Selectionner</option>');
						$.each(data.dep,function(index,ind){
							$('#deprte').append('<option value="'+ind.id_dep+'">'+ind.nom+'</option>')
						});
						$.each(data.prest,function(index,ind){
							$('#traitant').append('<option value="'+ind.id_tier+'">'+ind.nom+'</option>');
							$('#prest_rep').append('<option value="'+ind.id_tier+'">'+ind.nom+'</option>');
						});	
					}
				});
		}

		$(document).on('change','#deprte',function(){
			$('#usr').empty();
			$('#usr').append('<option value="0">Selectionner</option>');
			if($(this).val() != 0){
				$.ajax({
				type:'get',
				url : 'getUtil/'+$(this).val(),
				success:function(data){
					$.each(data,function(index,ind){
						$('#usr').append('<option value="'+ind.id_uti+'">'+ind.prenom+'</option>');
					});
				}
			});
			}
		});

		$(document).on('change','#const8,#const9',function(){
			$('#gl_search').val("");
			var url;
			var selector = $(this).attr('id');
			var c = $(this).val();
			var serie = $('input[name="temp_serie"]').val();
			var id = $('input[name="temp_id"]').val();
			if($(this).attr('id') == "const8"){
				url = 'getTrace/'+c+'?serie='+serie;
			}else{
				url = 'getMaintenance/'+c+'?idMa='+id;
			}
			$.ajax({
				type:'get',
				url: url,
				success:function(data){
					if(selector == "const8"){
						$('#ajax_mtrace').html(data);
					}else{
						$('#ajax_maint').html(data);
					}
				}
			});
		});

		$(document).on('click','.pagin_mtrace .pagination a',function(e){
			e.preventDefault();
			var page = $(this).attr('href').split('page=')[1];
			var serie = $('input[name="temp_serie"]').val();
			var arg = $('#gl_search').val();
			$.ajax({
				type:'get',
				url:'getTrace?page='+page+'&serie='+serie+'&arg='+arg,
				success:function(data){
					$('#ajax_mtrace').html(data);
				}
			});
		});


		
		$(document).on('click','.pagin_maint .pagination a',function(e){
			e.preventDefault();
			var page = $(this).attr('href').split('page=')[1];
			var id = $('input[name="temp_id"]').val();
			var arg = $('#gl_search').val();
			$.ajax({
				type:'get',
				url: 'getMaintenance?page='+page+'&idMa='+id+'&arg='+arg,
				success:function(data){
					$('#ajax_maint').html(data);
				}
			});
		});

		//reparation dans modal
		$(document).on('click','.pagin_rep .pagination a',function(e){
			e.preventDefault();
			var page = $(this).attr('href').split('page=')[1];
			var id = $('input[name="temp_id"]').val();
			var arg = $('#gl_search').val();
			$.ajax({
					type:'get',
					url:'getRep?page='+page+'&idRep='+id+'&arg='+arg,
					success:function(data){
						$('#ajax_rep').html(data);
					}
				});
		});

		$(document).on('change','#const10',function(){
			$('#gl_search').val("");
			var c = $(this).val();
			var id = $('input[name="temp_id"]').val();
			$.ajax({
				type:'get',
				url: 'getRep/'+c+'?idRep='+id,
				success:function(data){
					$('#ajax_rep').html(data);
				}
			});
		});

		$(document).on('keyup','#gl_search',function(){
			var arg = $(this).val();
			var serie = $('input[name="temp_serie"]').val();
			var id = $('input[name="temp_id"]').val();
			var selector;
			var url;
			if($('#tab_l1').hasClass('active')){
				 selector = '#ajax_mtrace';
				 url = 'getTrace?serie='+serie+'&arg='+arg;
			}
			if($('#tab_l2').hasClass('active')){
				selector = '#ajax_maint';
				url = 'getMaintenance?idMa='+id+'&arg='+arg;
			}
			if($('#tab_l3').hasClass('active')){
				selector = '#ajax_rep';
				url = 'getRep?idRep='+id+'&arg='+arg;
			}
			if($('#tab_l4').hasClass('active')){

			}
			$.ajax({
				type:'get',
				url:url,
				success:function(data){
					$(selector).html(data);
				}
			});
		});


		$(document).on('click','.panel-default .panel-heading',function(){
				
			var href = $(this).attr('href');
			$('.panel-default .panel-heading').each(function(){
				if($(this).attr('href') != href){		
						$(this).find('.panel-title i').removeClass('icon-caret-up')
						.addClass('icon-caret-down');
						$(this).css('background-color','#fff');
				}
			});
			var cible = $(this).find('.panel-title i');
			if(cible.hasClass('icon-caret-down')){
				cible.removeClass('icon-caret-down').addClass('icon-caret-up');
				$(this).css('background-color','#f9f9f9');
			}else{
				cible.removeClass('icon-caret-up').addClass('icon-caret-down');
				$(this).css('background-color','#fff');
			}
		});
		//guarded
		$(document).on('click','#reset1,#reset2,#reset3',function(e){
			e.preventDefault();
				
			if($(this).attr('id') == "reset1"){
				fct_reset1();
			}if($(this).attr('id') == "reset2"){
				fct_reset2();
			}if($(this).attr('id') == "reset3"){
				fct_reset3();
			}
			binder();
			$(this).trigger('reset');
		});

		function fct_reset1(){
			$('.traitant').html("");
			$('.dmain').html("");
			$('#dmain').val("");
			$('#obs').val("");
			$('#cout').val("");
			$('.cout').html("");

			$('#traitant').removeClass('has-error').parent().removeClass('has-error');
			$('#dmain').parent().parent().removeClass('has-error');
			$('#cout').parent().removeClass('has-error');

			$('#s2id_traitant .select2-choice > .select2-chosen').html("Selectionner");
			$('#traitant').val('0');
			$('.colorable').css('background-color','');

			$('#Modif_Maint').attr('id','addMaintenance');
			$('#addMaintenance').find('button[type="submit"]').html('<i class="icon-check"></i> Sauver');
			$('#addMaintenance').attr('action',"{{ route('maintenance') }}");
			
		}

		function fct_reset2(){
			$('.prest_rep').html("");
			$('.pane_rep').html("");
			$('.d_rep').html("");
			$('.obs_rep').html("");
			$('.piece').html("");
			$('.cout_rp').html("");
			$('#d_rep').val("");
			$('#obs_rep').val("");
			$('#piece').val("");
			$('#cout_rp').val("");
			$('#pane_rep').removeClass('has-error');
			$('#pane_rep').parent().removeClass('has-error');
			$('#prest_rep').removeClass('has-error');
			$('#prest_rep').parent().removeClass('has-error');
			$('#d_rep').parent().parent().removeClass('has-error');
			$('#obs_rep').parent().removeClass('has-error');
			$('#piece').parent().removeClass('has-error');
			$('#cout_rp').parent().removeClass('has-error');
			$('.colorable').css('background-color','');

			$('#s2id_prest_rep .select2-choice > .select2-chosen').html("Selectionner");
			$('#s2id_pane_rep .select2-choice > .select2-chosen').html("Selectionner");
			$('#prest_rep').val('0');
			$('#pane_rep').val('0');

			$('#Modif_Rep').attr('id','addReparation');
			$('#addReparation').find('button[type="submit"]').html('<i class="icon-check"></i> Sauver');
			$('#addReparation').attr('action',"{{ route('reparation') }}");
			


		}

		function fct_reset3(){
			$('.deprte').html("");
			$('.usr').html("");
			$('.daf').html("");
			$('#daf').val("");
			$('input[name="id_aff"]').val("");
			$('#deprte').removeClass('has-error').parent().removeClass('has-error');
			$('#usr').removeClass('has-error').parent().removeClass('has-error');
			$('#daf').parent().parent().removeClass('has-error');
			$('#s2id_deprte .select2-choice > .select2-chosen').html("Selectionner");
			$('#deprte').val('0');
			$('#s2id_usr .select2-choice > .select2-chosen').html("Selectionner");
			$('#usr').val('0');
			$('.colorable').css('background-color','');
		
			$('#Modif_Affectation').attr('id','Faire_Affectation');
			$('#Faire_Affectation').attr('action',"{{ route('affectation') }}");
			$('#Faire_Affectation').find('button[type="submit"]').html('<i class="icon-check"></i> Sauver');
		}

		function resetPan(){
			$('input[name="idPan"]').val("");
			$('input[name="numPan"]').val("");
			$('.colorable').css('background-color','');
			$('#dat_pan').parent().parent().removeClass('has-error');
			$('.dat_pan').html("");
			$('#desc_pan').parent().removeClass('has-error');
			$('.desc_pan').html("");

			$('#dat_pan').val("");
			$('#desc_pan').val("");
			
			$('#ModifPanne').attr('id','addPanne');
			$('#addPanne').attr('action',"{{ route('addPanne') }}");
			$('#addPanne').find('button[type="submit"]').html('<i class="icon-check"></i> Sauver');
		}

		//fonction de reinitialisation de la tracabilite
		function repopulateTracabilite(serie){
			$.ajax({
				type:'get',
				url:'getTrace?serie='+serie,
				success:function(data){
					$('#ajax_mtrace').html(data);
					}
				});
		}
		function repopulateMaintenance(id){
			$.ajax({
				type:'get',
				url:'getMaintenance?idMa='+id,
				success:function(data){
					$('#ajax_maint').html(data);
					}
				});
		}
		function repopulateReparation(id){
			$.ajax({
					type:'get',
					url:'getRep?idRep='+id,
					success:function(data){
						$('#ajax_rep').html(data);
					}
				});
		}
		function repopulatePanne(id){
			$.ajax({
					type:'get',
					url:'getPanne?idMa='+id,
					success:function(data){
						$('#ajax_pan').html(data);
					}
		});
	}
		
		/////validation de superModal
		//ajout d'une affectation
		$(document).on('submit','#Faire_Affectation',function(e){
			e.preventDefault();
			
			$('.deprte').html("");
			$('.usr').html("");
			$('.daf').html("");
			$('#deprte').removeClass('has-error').parent().removeClass('has-error');
			$('#usr').removeClass('has-error').parent().removeClass('has-error');
			$('#daf').parent().parent().removeClass('has-error');
			var serie = $('input[name="temp_serie"]').val();
			$.ajax({
				type:'post',
				url:$(this).attr('action'),
				data:$(this).serialize(),
				success:function(data){
					if(data.errors){
						if(data.errors.departement){
							$('.deprte').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.departement[0]+'</i>');
							$('#deprte').addClass('has-error').parent().addClass('has-error');
						}
						if(data.errors.dateAffectation){
							$('.daf').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.dateAffectation[0]+'</i>');
							$('#daf').parent().parent().addClass('has-error');
						}
					}else{
						x0p('Ajout','avec succès !','ok',false);
						fct_reset3();
						$('a[href="#tabe_1"]').tab('show');
						repopulateTracabilite(serie);
					}
				}
			});
		});

		//ajout maintenance
		$(document).on('submit','#addMaintenance',function(e){
			e.preventDefault();

			$('.traitant').html("");
			$('.dmain').html("");
			$('.cout').html("");

			$('#traitant').removeClass('has-error').parent().removeClass('has-error');
			$('#dmain').parent().parent().removeClass('has-error');
			$('#cout').parent().removeClass('has-error');
			var id = $('input[name="temp_id"]').val();
			$.ajax({
				type:'post',
				url:$(this).attr('action'),
				data:$(this).serialize(),
				success:function(data){
					if(data.errors){
						if(data.errors.prestataire){
							$('#traitant').addClass('has-error').parent().addClass('has-error');
							$('.traitant').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.prestataire[0]+'</i>');
						}
						if(data.errors.dateMaintenance){
							$('#dmain').parent().parent().addClass('has-error');
							$('.dmain').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.dateMaintenance[0]+'</i>');
						}
						if(data.errors.cout){
							$('#cout').parent().addClass('has-error');
							$('.cout').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.cout[0]+'</i>');
						}
					}else{
						x0p('Ajout','avec succès !','ok',false);
						fct_reset1();
						$('a[href="#tabe_2"]').tab('show');
						repopulateMaintenance(id);
					}
				}
			});
		});
		//ajuot reparation
		$(document).on('submit','#addReparation',function(e){
				e.preventDefault();
				$('.prest_rep').html("");
				$('.d_rep').html("");
				$('.pane_rep').html("");
				$('#pane_rep').removeClass('has-error');
				$('#pane_rep').parent().removeClass('has-error');
				$('.obs_rep').html("");
				$('.piece').html("");
				$('.cout_rp').html("");
				$('#prest_rep').removeClass('has-error');
				$('#prest_rep').parent().removeClass('has-error');
				$('#d_rep').parent().parent().removeClass('has-error');
				$('#obs_rep').parent().removeClass('has-error');
				$('#piece').parent().removeClass('has-error');
				$('#cout_rp').parent().removeClass('has-error');
				var id = $('input[name="temp_id"]').val();
				$.ajax({
					type:'post',
					url: $(this).attr('action'),
					data: $(this).serialize(),
					success:function(data){
						if(data.errors){
							if(data.errors.prestataire){
								$('.prest_rep').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.prestataire[0]+'</i>');
								$('#prest_rep').addClass('has-error');
								$('#prest_rep').parent().addClass('has-error');
							}
							if(data.errors.pane){
								$('.pane_rep').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.pane[0]+'</i>');
								$('#pane_rep').addClass('has-error');
								$('#pane_rep').parent().addClass('has-error');
							}
							if(data.errors.dateReparation){
								$('.d_rep').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.dateReparation[0]+'</i>');
								$('#d_rep').parent().parent().addClass('has-error');
							}
							if(data.errors.piece){
								$('.piece').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.piece[0]+'</i>');
								$('#piece').parent().addClass('has-error');
							}
							if(data.errors.cout){
								$('.cout_rp').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.cout[0]+'</i>');
								$('#cout_rp').parent().addClass('has-error');
							}
						}else{
							x0p('Ajout','avec succès !','ok',false);
							fct_reset2();
							PaneRep();
							$('a[href="#tabe_3"]').tab('show');
							repopulateReparation(id);
							repopulatePanne(id);
							$('#m[data-row="'+data.id_ma+'"]').replaceWith('<tr id="m" data-row="'+data.id_ma+'">'+
											'<td class="checkbox-column">'+
												'<div class="checker">'+
													'<span id="s">'+
														'<input id="checker" data-id="'+data.id_ma+'" type="checkbox">'+
													'</span>'+
												'</div>'+
											'</td>'+
											'<td id="togler" style="text-align: center;padding-top: 10px;padding-bottom: 4px;"><i style="font-size: 18px;" class="togle icon-double-angle-down"></i></td>'+
											'<td>'+data.num_serie+'</td>'+
											'<td>'+data.marque+'</td>'+
											'<td>'+data.model+'</td>'+
											'<td>'+formateur2(data.date_acqui)+'</td>'+
											'<td>'+data.nom+'</td>'+
											'<td>Bon</td>'+
											'<td>'+data.vlr_acqui+'</td>'+
											'<td class="align-center"><span class="btn-group">'+
												'<a id="sub" data-id="'+data.id_ma+'" data-marque="'+data.marque+'" data-serie="'+data.num_serie+'" class="btn btn-xs" href="#">'+
													'<i class="icon-th-list"></i>'+
												'</a>'+
												'<a class="btn btn-xs" href="'+data.id_ma+'">'+
													'<i class="icon-edit"></i>'+
												'</a>'+
													'<a class="btn btn-xs" id="delMat" data-id="'+data.id_ma+'" href="#">'+
													'<i class="icon-trash"></i>'+
												'</a>'+
											'</span></td>'+ 
										'</tr>');
						}
					}
				});
			});

		function formateur(date , c){
			var z=date.split(' ');
			var x = z[0].split('-');
			var u = z[1].split(':');
			if(c == undefined){
				return x[2]+'-'+x[1]+'-'+x[0]+'  '+u[0]+':'+u[1];
			}else{
				return x[2]+'-'+x[1]+'-'+x[0]+' | '+u[0]+':'+u[1];
			}
		}

		function formateur2(date){
			var z=date.split(' ');
			var x = z[0].split('-');
			var u = z[1].split(':');
		
				return x[2]+'-'+x[1]+'-'+x[0];
			
		}

		function converter(date){
			var z=date.split('-');
			return z[2]+'-'+z[1]+'-'+z[0];
		}
		//modification dans superModal
		
		$(document).on('click','#modifTrace',function(){
			fct_reset1();
			fct_reset2();

			$('.colorable').css('background-color','');
			var id = $('input[name="temp_id"]').val();
			var dat = $(this).data('date');
			$('input[name="tr_temp"]').val(dat);
			$(this).parent().parent().parent().css('background-color','rgb(243, 243, 243)');
			$.ajax({
				type:'get',
				url :'getMonoTrace?id='+id+'&dat='+dat,
				success:function(data){
					$('#deprte').empty();
					$('#usr').empty();
				
					$('#daf').val(formateur(data.aff.date_aff));
					$('input[name="id_aff"]').val(data.aff.id_histo);
					$('#s2id_deprte .select2-choice > .select2-chosen').html(data.aff.nom);
					$('#deprte').append('<option value="'+data.aff.id_dep+'">'+data.aff.nom+'</option>');

					if(data.aff.prenom != null){
						$('#s2id_usr .select2-choice > .select2-chosen').html(data.aff.prenom);
						$('#usr').append('<option value="'+data.aff.id_uti+'">'+data.aff.prenom+'</option>');
					}else{
						$('#s2id_usr .select2-choice > .select2-chosen').html("Selectionner");
						$('#usr').append('<option value="0">Selectionner</option>');
					}
					
					$.each(data.dep,function(index,ind){
						$('#deprte').append('<option value="'+ind.id_dep+'">'+ind.nom+'</option>');
					});
					$.each(data.uti,function(index,ind){
							$('#usr').append('<option value="'+ind.id_uti+'">'+ind.prenom+'</option>');
					});
					$('#usr').append('<option value="0">Tous</option>');
					
					$('#Faire_Affectation').find('button[type="submit"]').html('<i class="icon-check"></i> Update');
					$('#Faire_Affectation').attr('action',"{{ route('afectationMod') }}");
					$('#Faire_Affectation').attr('id','Modif_Affectation');

					$('a[href="#tabe_f1"]').tab('show');

					if($('#collapseOne').hasClass('panel-collapse collapse')){
					$('.panel-heading[href="#collapseOne"]').trigger('click');
						}

				}
			});
		});
		//modification d'une maintenance
		$(document).on('click','#modifMain',function(){
			fct_reset2();
			fct_reset3();
			var id = $(this).data('id');
			$('input[name="id_inter"]').val(id);
			$('.colorable').css('background-color','');
			$('#maint'+id).css('background-color','rgb(243, 243, 243)');
			$.ajax({
				type:'get',
				url:'getMonoMaint?id='+id,
				success:function(data){
					$('#traitant').empty();
					$('#s2id_traitant .select2-choice > .select2-chosen').html(data.maint.nom);
					$('#traitant').append('<option value="'+data.maint.id_tier+'">'+data.maint.nom+'</option>');
					$.each(data.prest,function(index,ind){
						$('#traitant').append('<option value="'+ind.id_tier+'">'+ind.nom+'</option>');
					});

					$('#dmain').val(converter(data.maint.date_inter));
					$('#obs').val(data.maint.description);
					$('#cout').val(data.maint.cout_inter);
					$('#addMaintenance').find('button[type="submit"]').html('<i class="icon-check"></i> Update');
					$('#addMaintenance').attr('action',"{{ route('maintModif') }}");
					$('#addMaintenance').attr('id','Modif_Maint');

					$('a[href="#tabe_f2"]').tab('show');

					if($('#collapseOne').hasClass('panel-collapse collapse')){
					$('.panel-heading[href="#collapseOne"]').trigger('click');
						}

				}
			});
		});

		//modification reparation
		$(document).on('click','#modifRep',function(){
			fct_reset1();
			fct_reset3();
			var id = $(this).data('id');
			$('input[name="id_inter2"]').val(id);

			$('.colorable').css('background-color','');
			$('#rep'+id).css('background-color','rgb(243, 243, 243)');

			$.ajax({
				type:'get',
				url:'getMonoRep?id='+id,
				success:function(data){
					$('#prest_rep').empty();
					$('#s2id_prest_rep .select2-choice > .select2-chosen').html(data.rep.nom);
					$('#prest_rep').append('<option value="'+data.rep.id_tier+'">'+data.rep.nom+'</option>');
					$.each(data.prest,function(index,ind){
						$('#prest_rep').append('<option value="'+ind.id_tier+'">'+ind.nom+'</option>');
					});

					$('#d_rep').val(converter(data.rep.date_inter));
					$('#obs_rep').val(data.rep.description);
					$('#piece').val(data.rep.piece);
					$('#cout_rp').val(data.rep.cout_inter);

					$('#addReparation').find('button[type="submit"]').html('<i class="icon-check"></i> Update');
					$('#addReparation').attr('action',"{{ route('modifReparation') }}");
					$('#addReparation').attr('id','Modif_Rep');
					$('a[href="#tabe_f3"]').tab('show');

					if($('#collapseOne').hasClass('panel-collapse collapse')){
					$('.panel-heading[href="#collapseOne"]').trigger('click');
						}

				}
			});
		});

		//modification de'une affectation;
		$(document).on('submit','#Modif_Affectation',function(e){
			e.preventDefault();
			var tr = $('input[name="tr_temp"]').val();
			$('.deprte').html("");
			$('.usr').html("");
			$('.daf').html("");
			$('#deprte').removeClass('has-error').parent().removeClass('has-error');
			$('#usr').removeClass('has-error').parent().removeClass('has-error');
			$('#daf').parent().parent().removeClass('has-error');
			$.ajax({
				type:'post',
				url:$(this).attr('action'),
				data:$(this).serialize(),
				success:function(data){
					if(data.errors){
						if(data.errors.departement){
							$('.deprte').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.departement[0]+'</i>');
							$('#deprte').addClass('has-error').parent().addClass('has-error');
						}
						if(data.errors.dateAffectation){
							$('.daf').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.dateAffectation[0]+'</i>');
							$('#daf').parent().parent().addClass('has-error');
						}
					}else{
						binder();
						fct_reset3();

						var prenom='Tous';
						if(data.prenom != null){
							prenom = data.prenom;
						}
						$('a[data-date="'+tr+'"]').parent().parent().parent()
						.replaceWith('<tr class="colorable">'+
										'<td>'+data.nom+'</td>'+
										'<td>'+prenom+'</td>'+
										'<td>'+formateur(data.date_aff,1)+'</td>'+
											'<td class="align-center">'+
												'<span class="btn-group">'+
												'<a class="btn btn-xs" id="modifTrace" data-date="'+data.date_aff+':00'+'"><i class="icon-edit"></i></a>'+
													'<a  class="btn btn-xs" id="dellAff" data-id="'+data.id_histo+'" href="#">'+
														'<i  class="icon-trash"></i></a>'+
														'</span></td></tr>');
					}
				}
			});
		});

		//mofification d'une maintenance
		$(document).on('submit','#Modif_Maint',function(e){
			e.preventDefault();
			var id_tr = $('input[name="id_inter"]').val();
			$('.traitant').html("");
			$('.dmain').html("");
			$('.cout').html("");

			$('#traitant').removeClass('has-error').parent().removeClass('has-error');
			$('#dmain').parent().parent().removeClass('has-error');
			$('#cout').parent().removeClass('has-error');

			$.ajax({
				type:'post',
				url:$(this).attr('action'),
				data:$(this).serialize(),
				success:function(data){
					if(data.errors){
						if(data.errors.dateMaintenance){
							$('#dmain').parent().parent().addClass('has-error');
							$('.dmain').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.dateMaintenance[0]+'</i>');
						}
						if(data.errors.cout){
							$('#cout').parent().addClass('has-error');
							$('.cout').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.cout[0]+'</i>');
						}
					}else{
						binder();
						fct_reset1();
						var desc = (data.description != null) ? data.description : '';
						$('#maint'+id_tr).replaceWith('<tr class="colorable" id="maint'+data.id_inter+'">'+
												'<td>'+data.nom+'</td>'+
												'<td>'+converter(data.date_inter)+'</td>'+
												'<td>'+desc+'</td>'+
												'<td>'+data.cout_inter+'</td>'+
												'<td class="align-center">'+
													'<span class="btn-group">'+
														'<a class="btn btn-xs" id="modifMain" data-id="'+data.id_inter+'" href="#">'+
															'<i class="icon-edit"></i>'+
														'</a>'+
														'<a  class="btn btn-xs" id="delMainte" data-id="'+data.id_inter+'" href="#">'+
															'<i  class="icon-trash"></i>'+
														'</a>'+
													'</span>'+
												'</td>'+
											'</tr>');
					}
				}
			});
		});

		$(document).on('submit','#Modif_Rep',function(e){
			e.preventDefault();
			var id_tr = $('input[name="id_inter2"]').val();
			$('.prest_rep').html("");
			$('.d_rep').html("");
			$('.obs_rep').html("");
			$('.piece').html("");
			$('.cout_rp').html("");
			$('#prest_rep').removeClass('has-error');
			$('#prest_rep').parent().removeClass('has-error');
			$('#d_rep').parent().parent().removeClass('has-error');
			$('#obs_rep').parent().removeClass('has-error');
			$('#piece').parent().removeClass('has-error');
			$('#cout_rp').parent().removeClass('has-error');

			$.ajax({
				type:'post',
				url:$(this).attr('action'),
				data:$(this).serialize(),
				success:function(data){
					if(data.errors){
						if(data.errors.dateReparation){
								$('.d_rep').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.dateReparation[0]+'</i>');
								$('#d_rep').parent().parent().addClass('has-error');
							}
							if(data.errors.piece){
								$('.piece').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.piece[0]+'</i>');
								$('#piece').parent().addClass('has-error');
							}
							if(data.errors.cout){
								$('.cout_rp').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.cout[0]+'</i>');
								$('#cout_rp').parent().addClass('has-error');
							}
						}else{
							binder();
							fct_reset2();
							var descri = (data.description != null) ? data.description : '';
							$('#rep'+id_tr).replaceWith('<tr class="colorable" id="rep'+data.id_inter+'">'+
												'<td>'+data.nom+'</td>'+
												'<td>'+converter(data.date_inter)+'</td>'+
												'<td>'+descri+'</td>'+
												'<td>'+data.piece+'</td>'+
												'<td>'+data.cout_inter+'</td>'+
												'<td class="align-center">'+
													'<span class="btn-group">'+
														'<a class="btn btn-xs" id="modifRep" data-id="'+data.id_inter+'" href="#">'+
															'<i class="icon-edit"></i>'+
														'</a><a class="btn btn-xs" id="delRep" data-id="'+data.id_inter+'" href="#">'+
															'<i  class="icon-trash"></i>'+
														'</a>'+
													'</span>'+
												'</td>'+
											'</tr>');
						}
				}
			});
		});


		//rafraichissement apres 
		$(document).on('click','#refr',function(){
			binder();
			fct_reset1();
			fct_reset2();
			fct_reset3();
			resetPan();resetReforme();
			var serie = $('input[name="temp_serie"]').val();
			var id = $('input[name="temp_id"]').val();
			//recuperation des tracabilite
				$.ajax({
				type:'get',
				url:'getTrace?serie='+serie,
				success:function(data){
					$('#ajax_mtrace').html(data);
					}
				});
				//recuperation maintenance
				$.ajax({
				type:'get',
				url:'getMaintenance?idMa='+id,
				success:function(data){
					$('#ajax_maint').html(data);
					}
				});
				//recuperation reparation
				$.ajax({
					type:'get',
					url:'getRep?idRep='+id,
					success:function(data){
						$('#ajax_rep').html(data);
					}
				});
				repopulatePanne(id);

		});
			
		function PaneRep(){
			var id = $('input[name="temp_id"]').val();
			$.ajax({
				type:'get',
				url:'getPanRep?id='+id,
				success:function(data){
					var total = data.length;
					$('#pane_rep').empty();
					$('#pane_rep').append('<option value="0">Selectionner</option>');
					$('#s2id_pane_rep .select2-choice > .select2-chosen').html("Selectionner");
					$.each(data,function(index,ind){
						var res = total-index;
						if(ind.id_rp == null){
							$('#pane_rep').append('<option value="'+ind.id_pan+'">P0'+res+'</option>');
						}
					});
				}
			});
		}

	

		$(document).on('click','#resetPan',function(e){
			e.preventDefault();
			resetPan();
		});

/////////////////////////////////////////////
//Partie panne
		$(document).on('change','#const11',function(){
			var id = $('input[name="temp_id"]').val();
			var c = $(this).val();
			$.ajax({
					type:'get',
					url:'getPanne/'+c+'?idMa='+id,
					success:function(data){
						$('#ajax_pan').html(data);
					}
			});
		});

		 $(document).on('click','.pagin_pan .pagination a',function(e){
		 	e.preventDefault();
		 	var page = $(this).attr('href').split('page=')[1];
		 	var id = $('input[name="temp_id"]').val();
		 	$.ajax({
		 		type:'get',
		 		url:'paginPane?page='+page+'&idMa='+id,
		 		success:function(data){
		 			$('#ajax_pan').html(data);
		 		}
		 	});
		 });
	
		//ajout d'une panne
		$(document).on('submit','#addPanne',function(e){
			e.preventDefault();

			$('#dat_pan').parent().parent().removeClass('has-error');
			$('.dat_pan').html("");
			$('#desc_pan').parent().removeClass('has-error');
			$('.desc_pan').html("");
			var id = $('input[name="temp_id"]').val();
			$.ajax({
				type:'post',
				url:$(this).attr('action'),
				data:$(this).serialize(),
				success:function(data){
					if(data.errors){
						if(data.errors.datePane){
							$('#dat_pan').parent().parent().addClass('has-error');
							$('.dat_pan').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.datePane[0]+'</i>');
						}if(data.errors.description){
							$('#desc_pan').parent().addClass('has-error');
							$('.desc_pan').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.description[0]+'</i>');
						}
					}else{
						x0p('Ajout','avec succès !','ok',false);
						resetPan();
						$('a[href="#tabe_4"]').tab('show');
						repopulatePanne(id);
						$('#m[data-row="'+data.id_ma+'"]').replaceWith('<tr id="m" data-row="'+data.id_ma+'">'+
											'<td class="checkbox-column">'+
												'<div class="checker">'+
													'<span id="s">'+
														'<input id="checker" data-id="'+data.id_ma+'" type="checkbox">'+
													'</span>'+
												'</div>'+
											'</td>'+
											'<td id="togler" style="text-align: center;padding-top: 10px;padding-bottom: 4px;"><i style="font-size: 18px;" class="togle icon-double-angle-down"></i></td>'+
											'<td>'+data.num_serie+'</td>'+
											'<td>'+data.marque+'</td>'+
											'<td>'+data.model+'</td>'+
											'<td>'+formateur2(data.date_acqui)+'</td>'+
											'<td>'+data.nom+'</td>'+
											'<td>'+data.etat+'</td>'+
											'<td>'+data.vlr_acqui+'</td>'+
											'<td class="align-center"><span class="btn-group">'+
												'<a id="sub" data-id="'+data.id_ma+'" data-marque="'+data.marque+'" data-serie="'+data.num_serie+'" class="btn btn-xs" href="#">'+
													'<i class="icon-th-list"></i>'+
												'</a>'+
												'<a class="btn btn-xs" href="'+data.id_ma+'">'+
													'<i class="icon-edit"></i>'+
												'</a>'+
													'<a class="btn btn-xs" id="delMat" data-id="'+data.id_ma+'" href="#">'+
													'<i class="icon-trash"></i>'+
												'</a>'+
											'</span></td>'+ 
										'</tr>');
					}
					PaneRep();
				}
			});
		});
			
//modificztion d'une panne

	$(document).on('click','#modifPan',function(){
		var id=$(this).data('id');
		var num = $(this).data('num');
		$('input[name="idPan"]').val(id);
		$('input[name="numPan"]').val(num);

		$('.colorable').css('background-color','');
		$('#pan'+id).css('background-color','rgb(243, 243, 243)');

		$.ajax({
			type:'get',
			url:'getMonoPan?idPan='+id,
			success:function(data){
				$('#dat_pan').val(converter(data.date_pan));
				$('#desc_pan').val(data.description);
				PaneRep();
			}
		});

		
		$('#addPanne').attr('action',"{{ route('ModifPanne') }}");
		$('#addPanne').find('button[type="submit"]').html('<i class="icon-check"></i> Update');
		$('#addPanne').attr('id','ModifPanne');
		if($('#collapseTwo').hasClass('panel-collapse collapse')){
				$('.panel-heading[href="#collapseTwo"]').trigger('click');
			}
	});



	$(document).on('submit','#ModifPanne',function(e){
		e.preventDefault();
		$('#dat_pan').parent().parent().removeClass('has-error');
		$('.dat_pan').html("");
		$('#desc_pan').parent().removeClass('has-error');
		$('.desc_pan').html("");
		var idtr =  $('input[name="idPan"]').val();
		var numtr = $('input[name="numPan"]').val();
		$.ajax({
			type:'post',
			url:$(this).attr('action'),
			data:$(this).serialize(),
			success:function(data){
				if(data.errors){
					if(data.errors.datePane){
						$('#dat_pan').parent().parent().addClass('has-error');
						$('.dat_pan').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.datePane[0]+'</i>');
					}
					if(data.errors.description){
						$('#desc_pan').parent().addClass('has-error');
						$('.desc_pan').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.description[0]+'</i>');
					}
				}else{
					resetPan();
					$('a[href="#tabe_4"]').tab('show');
					var res = (data.id_rp == null) ? '<i class="icon-remove"></i>' : '<i class="icon-ok"></i>';
					$('#pan'+idtr).replaceWith('<tr class="colorable" id="pan'+data.id_pan+'">'+
												'<td>P0'+numtr+'</td>'+
												'<td>'+
												converter(data.date_pan)+
												'</td>'+
												'<td>'+
													data.description+
												'</td>'+
												'<td class="align-center">'+res+'</td>'+
																								
												'<td class="align-center">'+
													'<span class="btn-group">'+
														'<a class="btn btn-xs" id="modifPan" data-num="'+numtr+'" data-id="'+data.id_pan+'" href="#">'+
															'<i class="icon-edit"></i>'+
														'</a>'+
														'<a class="btn btn-xs" id="delPane" data-id="'+data.id_pan+'" href="#">'+
															'<i  class="icon-trash"></i>'+
														'</a>'+
													'</span>'+
												'</td>'+
											'</tr>');
				}
			}
		});
	});

	$(document).on('click','a[href="#tabe_f3"]',function(){
		$('a[href="#tabe_4"]').tab('show');
	});
		//parti cession

		$(document).on('change','#obces',function(){
			var valu = $(this).val();
			reinitReform();
			if(valu == "0"){
				$('.chdinamic').html('<div class="col-md-11">'+
										'<label id="lb" for="nom" class="control-label pull-left">Acheteur'+  
										'</label><br><input id="nom" name="nom" class="form-control" placeholder="nom acheteur">'+
										'<label class="help-block nom"></label></div>');
				$('.chdinamic2').html('<div class="col-md-11">'+
										'<label id="lb" for="cout_rf" class="control-label pull-left">Coût (Ar)'+
										'</label><br><input id="cout_rf" name="valeur" class="form-control" placeholder="valeur'+ 
										'transaction"><label class="help-block cout_rf"></label></div>');
			}if(valu == "1"){
				$('.chdinamic').html('<div class="col-md-11">'+
										'<label id="lb" for="nom" class="control-label pull-left">Donataire'+  
										'</label><br><input id="nom" name="nom" class="form-control" placeholder="nom donataire">'+
										'<label class="help-block nom"></label></div>');
				$('.chdinamic2').empty();
			}if(valu == "2"){
				$('.chdinamic').empty();
				$('.chdinamic2').empty();
			}
		});
		function resetReforme(){
			reinitReform();
				$('.chdinamic').html('<div class="col-md-11">'+
										'<label id="lb" for="nom" class="control-label pull-left">Acheteur'+  
										'</label><br><input id="nom" name="nom" class="form-control" placeholder="nom acheteur">'+
										'<label class="help-block nom"></label></div>');
				$('.chdinamic2').html('<div class="col-md-11">'+
										'<label id="lb" for="cout_rf" class="control-label pull-left">Coût (Ar)'+
										'</label><br><input id="cout_rf" name="valeur" class="form-control" placeholder="valeur'+ 
										'transaction"><label class="help-block cout_rf"></label></div>');
			
			$('#s2id_obces .select2-choice > .select2-chosen').html("Vente");
			$('#obces').val("0");
			$('#date_cess').val("");
			$('#cout_rf').val("");
			$('#nom').val("");
		}
		function reinitReform(){
			$('#date_cess').parent().parent().removeClass('has-error');
			$('#nom').parent().removeClass('has-error');
			$('#cout_rf').parent().removeClass('has-error');
			$('.date_cess').html("");
			$('.nom').html("");
			$('.cout_rf').html("");
		}

		function rafraichirMateriel(){
			$.ajax({
				type:'get',
				url:'home',
				success:function(data){
					$('#ajax').html(data);
				}
			});
		}

		$(document).on('submit','#addReform',function(e){
			e.preventDefault();
			reinitReform();
			console.log($(this).serialize());
			$.ajax({
				type : 'post',
				url : $(this).attr('action'),
				data : $(this).serialize(),
				success:function(data){
					if(data.errors){
						if(data.errors.dateReforme){
							$('#date_cess').parent().parent().addClass('has-error');
							$('.date_cess').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.dateReforme[0]);
						}
						if(data.errors.nom){
							$('#nom').parent().addClass('has-error');
							$('.nom').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.nom[0]+'</i>');
						}
						if(data.errors.valeur){
							$('#cout_rf').parent().addClass('has-error');
							$('.cout_rf').html('&nbsp;<i class="icon-info-sign">&nbsp;'+data.errors.valeur[0]+'</i>');
						}
					}else{
						x0p('Ajout','avec succès !','ok',false);
						resetReforme();
						rafraichirMateriel();
						$('#subMenu').modal('hide');
					}
				}
			});
		});

		$(document).on('click','#resetRef',function(e){
			e.preventDefault();
			resetReforme();
		});

		//historique reform 

		$(document).on('click','.pagin_reform .pagination a',function(e){
			$('#processeur10').css('visibility','visible');
			e.preventDefault();
			var page = $(this).attr('href').split('page=')[1];
			var arg = $('input[name="search_reform"]').val();
			$.ajax({
				type:'get',
				url:'reforme?page='+page+'&arg='+arg,
				success:function(data){
					$('#ajax_reform').html(data);
					$('#processeur10').css('visibility','hidden');
				}
			});
		});

		$(document).on('change','#const12',function(){
			$('#processeur10').css('visibility','visible');
			var c =$(this).val();
			$.ajax({
				type:'get',
				url : 'reforme/'+c,
				success:function(data){
					$('#ajax_reform').html(data);
					$('#processeur10').css('visibility','hidden');
				}
			});
		});

		//recherche d'un reform 

		$(document).on('keyup','input[name="search_reform"]',function(){
			var arg = $(this).val();
			$('#processeur10').css('visibility','visible');
			$.ajax({
				type:'get',
				url: 'reforme?arg='+arg,
				success:function(data){
					$('#ajax_reform').html(data);
					$('#processeur10').css('visibility','hidden');
				}
			});
		});
		//inventaire



		//supresion
		$(document).on('click','#delMat',function(e){
			e.preventDefault();
			var id = $(this).data('id');
			var url = 'delMat/'+id;
			Alerter(url);
		});

		function Alerter(url){
			x0p('Confirmation', 'Etes vous sûr ?', 'warning').then(function(data){
				if(data.button == 'warning'){
					$.ajax({
						type:'get',
						url : url,
						success:function(data){
							rafraichirMateriel();
							x0p('suppresion','reussie !','ok',false);
						}
					});
				}
			});
		}

		function refresfTrace(){
			$.ajax({
				typ:'get',
				url:'tracabilite',
				success:function(data){
					$('#ajax_trace').html(data);
				}
			});
		}

		$(document).on('click','#SupTrace',function(e){
			e.preventDefault();
			var id = $(this).data('id');
			x0p('Confirmation', 'Etes vous sûr ?', 'warning').then(function(data){
				if(data.button == 'warning'){
					$.ajax({
						type:'get',
						url : 'delTrace/'+id,
						success:function(data){
							refresfTrace();
							x0p('suppresion','reussie !','ok',false);
						}
					});
				}
			});
		});
		function refreshPrestat(){
			$.ajax({
				type:'get',
				url:'utilisateur?delPrest=true',
				success:function(data){
					 $('#ajax_prst').html(data);
				}
			});
		}

		//supprimer prestataire
		$(document).on('click','#delPrest',function(){
			var id = $(this).data('id');
		x0p('Confirmation', 'Etes vous sûr ?', 'warning').then(function(data){
				if(data.button == 'warning'){
					$.ajax({
						type:'get',
						url : 'delPrest/'+id,
						success:function(data){
							refreshPrestat();
							x0p('suppresion','reussie !','ok',false);
						}
					});
				}
			});
		});

		function refreshFrs(){
			$.ajax({
				type:'get',
				url:'utilisateur?delFrs=true',
				success:function(data){
					 $('#ajax_fsr').html(data);
				}
			});
		}
		//supprimer fournisseur
		$(document).on('click','#delFrs',function(e){
			e.preventDefault();
			var id = $(this).data('id');
		
			x0p('Confirmation', 'Etes vous sûr ?', 'warning').then(function(data){
				if(data.button == 'warning'){
					$.ajax({
						type:'get',
						url : 'delFrs/'+id,
						success:function(data){
							refreshFrs();
							x0p('suppresion','reussie !','ok',false);
						}
					});
				}
			});
		});

		function refreshUti(){
			$.ajax({
				type:'get',
				url:'utilisateur?delUti=true',
				success:function(data){
					$('#ajax_uti').html(data);
				}
			});
		}
		//suppression utilisateur
		$(document).on('click','#delUti',function(){
			var id = $(this).data('id');
			x0p('Confirmation', 'Etes vous sûr ?', 'warning').then(function(data){
				if(data.button == 'warning'){
					$.ajax({
						type:'get',
						url : 'delUti/'+id,
						success:function(data){
							refreshUti();
							x0p('suppresion','reussie !','ok',false);
						}
					});
				}
			});
		});

			function refreshAff(){
				var serie = $('input[name="temp_serie"]').val();
				repopulateTracabilite(serie);
			}
		$(document).on('click','#dellAff',function(e){
			e.preventDefault();
			var id = $(this).data('id');
			x0p('Confirmation', 'Etes vous sûr ?', 'warning').then(function(data){
				if(data.button == 'warning'){
					$.ajax({
						type:'get',
						url : 'delTrace/'+id,
						success:function(data){
							refreshAff();
							x0p('suppresion','reussie !','ok',false);
						}
					});
				}
			});
		});

		function refreshMainte(){
			var idm = $('input[name="temp_id"]').val();
			repopulateMaintenance(idm);
		}

		$(document).on('click','#delMainte',function(e){
			e.preventDefault();
			var id = $(this).data('id');
			x0p('Confirmation', 'Etes vous sûr ?', 'warning').then(function(data){
				if(data.button == 'warning'){
					$.ajax({
						type:'get',
						url : 'delMainte/'+id,
						success:function(data){
							refreshMainte();
							x0p('suppresion','reussie !','ok',false);
						}
					});
				}
			});
		});

		function refreshRep(){
			var idm = $('input[name="temp_id"]').val();
			repopulateReparation(idm);
		}
		$(document).on('click','#delRep',function(e){
			e.preventDefault();
			var id = $(this).data('id');
			x0p('Confirmation', 'Etes vous sûr ?', 'warning').then(function(data){
				if(data.button == 'warning'){
					$.ajax({
						type:'get',
						url : 'delMainte/'+id,
						success:function(data){
							refreshRep();
							x0p('suppresion','reussie !','ok',false);
						}
					});
				}
			});
		});

		function refreshPane(){
			var idm = $('input[name="temp_id"]').val();
			repopulatePanne(idm);
		}

		$(document).on('click','#delPane',function(e){
			e.preventDefault();
			var id=$(this).data('id');
			x0p('Confirmation', 'Etes vous sûr ?', 'warning').then(function(data){
				if(data.button == 'warning'){
					$.ajax({
						type:'get',
						url : 'delPane/'+id,
						success:function(data){
							refreshPane();
							x0p('suppresion','reussie !','ok',false);
						}
					});
				}
			});
		});

		function refreshReform(){
			$.ajax({
				type:'get',
				url:'reforme',
				success:function(data){
					$('#ajax_reform').html(data);
				}
			});
		}
		
		$(document).on('click','#delReform',function(e){
			e.preventDefault();
			var id=$(this).data('id');
			x0p('Confirmation', 'Etes vous sûr ?', 'warning').then(function(data){
				if(data.button == 'warning'){
					$.ajax({
						type:'get',
						url : 'delReform/'+id,
						success:function(data){
							refreshReform();
							x0p('suppresion','reussie !','ok',false);
						}
					});
				}
			});
		});

		function refresHisto(){
			$.ajax({
				type:'get',
				url : 'historique',
				success:function(data){
					$('#ajax_histo').html(data);
				}
			});
		}

		$(document).on('click','#delHisto',function(e){
			e.preventDefault();
			var id = $(this).data('id');
			x0p('Confirmation', 'Etes vous sûr ?', 'warning').then(function(data){
				if(data.button == 'warning'){
					$.ajax({
						type:'get',
						url : 'delMainte/'+id, 
						success:function(data){
							refresHisto();
							x0p('suppresion','reussie !','ok',false);
						}
					});
				}
			});
		});

		$(document).on('click','.supr',function(){
			var tab = [];
		 		$('span[class="checked dlt"]').each(function(i){
		 			tab[i] = $(this).find('#checker').data('id');
		 		});
		 		if(tab.length != 0){
		 		x0p('Confirmation', 'Etes vous sûr ?', 'warning').then(function(data){
				if(data.button == 'warning'){
					$.ajax({
						type:'get',
						url:'MsupInter?tab='+tab,
						success:function(data){
							refresHisto();
							x0p('suppresion','reussie !','ok',false);
								}
							});
						}
					});
		 		}else{
		 			x0p('Message','Cocher au moin un element svp !','info');
		 		}
		});
		//inventair:ze
		$(document).on('click','.pagin_invent .pagination a',function(e){
			e.preventDefault();
			var page = $(this).attr('href').split('page=')[1];
			$('#processeur15').css('visibility','visible');
			$.ajax({
				type:'get',
				url : 'invent?page='+page,
				success:function(data){
					$('#ajax_invent').html(data);
					$('#processeur15').css('visibility','hidden');
				}
			});
		});
		$(document).on('change','#const13',function(){
			$('input[name="search_invent"]').val("");
			var bconst = $(this).val();
				$('#processeur15').css('visibility','visible');
			$.ajax({
				type:'get',
				url: 'invent/'+bconst,
				success:function(data){
					$('#ajax_invent').html(data);
					$('#processeur15').css('visibility','hidden');
				}
			});
		});

		$(document).on('keyup','input[name="search_invent"]',function(){
			var arg = $(this).val();
			$('#processeur15').css('visibility','visible');
			$.ajax({
				type:'get',
				url:'invent?arg='+arg,
				success:function(data){
					$('#ajax_invent').html(data);
					$('#processeur15').css('visibility','hidden');
				}
			});
		});

		function refreshInvent(){
			$.ajax({
				type:'get',
				url: 'invent',
				success:function(data){
					$('#ajax_invent').html(data);
				}
			});
		}

		$(document).on('click','#delInvent',function(e){
			e.preventDefault();
			var id = $(this).data('id');
			x0p('Confirmation', 'Etes vous sûr ?', 'warning').then(function(data){
				if(data.button == 'warning'){
					$.ajax({
						type:'get',
						url : 'delMat/'+id,
						success:function(data){
							refreshInvent();
							x0p('suppresion','reussie !','ok',false);
						}
					});
				}
			});
		});

		$('#ChangEta').popover({
			html:true,
		});

		

	});
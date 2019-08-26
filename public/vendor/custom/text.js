
// función en PHP
function ca_graf($archivo){ /// Funcion para Cargar Form
	$grafic='';
	$fp = fopen($archivo,"r");
	while ($linea= fgets($fp,1000)){ # leer  archivo linea a linea con cada linea de 1000 o menos //file_get_contents     			
		$grafic .= $linea ."\n";
	}
return $grafic;
}


// funcion JS para llamar por Ajax
function ft_cr_sol(){ /// Cot-2.0001-003 Función para cargar formulario para crear solicitud
	if($("#dia_agr_sol").attr("id")){
		$("#dia_agr_sol").remove()
	}
	var newsol = $('<div id="dia_agr_sol" style="display: block;"/>');
	$("#li_ini").after(newsol);
	var sol='s';
	var parametros={"sol_cst_sol":sol};
	$.ajax({
		type: "POST",
		url: "generador.php",
		data: parametros,
		success: function( ft_sol_cst_sol ){
            if(ft_sol_cst_sol==1){
				alert('No Tiene permiso para usar el menu pero esta habilitado el Formato comuniquese con el Administrador');
			}else{
				if(ft_sol_cst_sol==2){
        	       	alert('No hay consecutivo activo');
					return false;
				}else{
					$("#dia_agr_sol").html(ft_sol_cst_sol);
					$("#dia_agr_sol").dialog({
   						modal: true,
						title: "Crear Solicitud Cotizaci&oacute;n",
   						width: 600,
   						minWidth: 400,
  						maxWidth: 700,
   						show: "fold",
   						hide: "scale",
					});
				}
    	   	}
		}
	});
}

//page en PHP para imprimir el valor que devuelvo a la función anterior

if(isset($_POST['sol_cst_sol'])){
	$csl=$_POST['sol_cst_sol'];
	ft_sol_cst_sol($csl);
}

function ft_sol_cst_sol($csl){
	global $iduser, $ini_tbl, $ini_tbl;
	$mod="soli";
	$cons=cons_mod($mod);
	if($cons=="NtC"){
		$contenido=2;
	}else{
		$form='cre_sol.htm';
			$bper=per_usu_frmprc($iduser,$form,$ini_tbl,'F','N');
			if($bper==0){
				$contenido=1;	
			}else{
				$lisusua="<tr><td><b>Asignar a:</b></td><td><select style=\"width:300px\" id=\"cmsel_usu_asg\"
					>".menu("cot_acc_mod a LEFT JOIN adm_users_ing b ON a.id_user=b.id LEFT JOIN adm_terc c ON b.id_user=c.id LEFT JOIN cot_forms d ON a.id_frm_prc=d.id","b.id,CONCAT(c.apellido,' ',c.nombre)","
					WHERE d.htm='cre_cot.htm' AND a.tip_cls='1' AND a.estado='1' AND b.estado='1' AND a.aut='1' ORDER BY CONCAT(c.apellido,' ',c.nombre) ASC","","")."</select></td></tr>";
				$contenido=ca_graf("form/$form");
				$per_us_ct=per_sis_frpr($iduser,$form,'A','N',$ini_tbl,'F');
				if($per_us_ct==1){
					$contenido=str_replace('[lisusu]',$lisusua,$contenido);	
				}else{
					$contenido=str_replace('[lisusu]','',$contenido);	
				}
				$ft=date("Y/m/d H:i:s");
				$habi=fe_habil($ft);
				if($habi==true){
					$hor=es_hor_hab($ft);
					if($hor<86399){
						$di=fecha('0','');
					}else{
						$i = 1;
						$n=1;
 						while($i < 2){
							$ff=fe_habil(sdias_fecha($ft,$n));
							if($ff==true){
								$nfe=sdias_fecha($ft,$n);
								$i++;
							}
							$n++;
						}
						$di=sseg_fecha($nfe,25200);
						$di=fecha('1',$di);
					}
				}else{
					$i = 1;
					$n=1;
 					while($i < 2){
						$ff=fe_habil(sdias_fecha($ft,$n));
						if($ff==true){
							$nfe=sdias_fecha($ft,$n);
							$i++;
						}
						$n++;
					}
					$di=sseg_fecha($nfe,25200);
					$di=fecha('1',$di);
				}
				$lsttict=menu("cot_tipcot","id,tipcot","WHERE estado='1'","","");
				$tipsol=menu("cot_remsol","id,remsol","WHERE estado='1'","","");
				$contenido=str_replace('[lstcot]',$lsttict,$contenido);
				$contenido=str_replace('[lsttpso]',$tipsol,$contenido);
				$contenido=str_replace('[cs_sol]',$cons,$contenido);
				$contenido=str_replace('[fe_sol]',$di,$contenido);				
			}
	}
	echo $contenido;
}



// Codigo JS para hacer el recorrido de varios y aqui lo pone como consola index:valor (Ex. 0 : 81)
$( "li" ).each(function( index ) {
  console.log( index + ": " + $( this ).text() );
});


// Esta funcion de JQuery sirve para ir al servidor y tomar una variable de una page PHP
$("#estruc").load('generador.php',{accion:accion});



accion='lis_asistentes';

if(isset($_POST['accion'])){ /// cot-1 Llamadas de onload para ejecutar codigo mediante una variable
	if($_POST['accion']=='ini'){  /// cot-1-0001 Inicio del Modulo de Cotizaciones panel principal.
		lis_ctz_gen($iduser);
	}
}
echo $contenido;

// Esto sería para usar con el LOAD pero definiendole cuales son los valores de las variables
{accion:'lis_asitentes'.fecha:'2019/04/12'}




// Con este codigo pude sacar los varloes de un class y luego pasarlos a otro
function listarReg() {
    var html = "";
    $(".registros").each(function( index ) {
      html += "<div>" + $( this ).text() + "</div>";
    });
    $("#ListaRegistros").html(html);
}

// Este codigo es para imprimir
<?php if(!empty($notif['test'])) {echo "<hr><pre>"; print_r($notif['test']); echo "</pre><hr>";} ?>

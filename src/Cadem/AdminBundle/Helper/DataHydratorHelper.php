<?php
namespace Cadem\AdminBundle\Helper;

class DataHydratorHelper {    

    public function __construct() {
	
    }	
	
	public function hydrateEstudiosala($dataSet,$columnas) {
			
		$output=array();				
		$num_regs=count($dataSet);		
		$cont_cols=0;
		$cont_regs=0;		
		$num_cols=count($columnas);					

		$prefixes=array_fill(0,5,"");																								
		
		if($num_regs>0)
		{					
			// Para llevar los cambios del 1er nivel de agregacion
			$nivel1=$dataSet[$cont_regs]['s0_id'];			
			// Lleno la fila con vacios, le agrego 3 posiciones, correspondientes a los niveles de agregación y al total															
			// $fila=array_fill(0,$num_cols+5,"<input id='estudiosala'  type='checkbox' />");																								
			$fila=array();
			foreach($prefixes as $prefix)
				array_push($fila,$prefix);						
			foreach($columnas as $columna)			
				array_push($fila,"<input id='estudiosala' sala='".$dataSet[$cont_regs]['s0_id']."' estudio='".$columna."' estudiosala type='checkbox'  />");			
			
			while($cont_regs<$num_regs)
			{	
				$columna_quiebre=array_search($dataSet[$cont_regs]['s1_id'],$columnas);													
		
				if($nivel1==$dataSet[$cont_regs]['s0_id'])
				{ // Mientras no cambie el 1er nivel asignamos los valores de quiebre a las columnas correspondientes	
					$fila[0]=$dataSet[$cont_regs]['s0_foliocadem'];																	
					$fila[1]=$dataSet[$cont_regs]['s2_nombre'];												
					$fila[2]=$dataSet[$cont_regs]['s3_nombre'];												
					$fila[3]=$dataSet[$cont_regs]['s0_calle'].' '.$dataSet[$cont_regs]['s0_numerocalle'];																												
					$fila[4]=$dataSet[$cont_regs]['s4_nombre'];							
					if(!is_null($dataSet[$cont_regs]['s1_id']))
						$fila[$columna_quiebre+5]="<input id='estudiosala' sala='".$dataSet[$cont_regs]['s0_id']."' estudio='".$columnas[$cont_cols]."' estudiosala='".$dataSet[$cont_regs]['s1_id']."' type='checkbox' checked />";																
					$cont_regs++;
					$cont_cols++;
				}	
				else
				{ // Si el primer nivel de agregacion cambió, lo actualizo, agrego la fila al body y reseteo el contador de cadenas
					// $fila[$num_cads+2]=number_format(round($totales_segmento[$cont_totales_segmento]['quiebre']*100,1),1,',','.');					
					// $cont_totales_segmento++;
					$cont_cols=0;					
					$nivel1=$dataSet[$cont_regs]['s0_id'];			
					array_push($output,$fila);
					// $fila=array_fill(0,$num_cols+5,"<input id='estudiosala' sala='".$dataSet[$cont_regs]['s0_id']."' estudio='".$dataSet[$cont_regs]['s5_id']."' estudiosala='".$dataSet[$cont_regs]['s1_id']."' type='checkbox' />");							
					$fila=array();
					foreach($prefixes as $prefix)
						array_push($fila,$prefix);						
					foreach($columnas as $columna)			
						array_push($fila,"<input id='estudiosala' sala='".$dataSet[$cont_regs]['s0_id']."' estudio='".$columna."' estudiosala type='checkbox'  />");								
				}
				if($cont_regs==$num_regs)		
				{					
					$columna_quiebre=array_search($dataSet[$cont_regs-1]['s1_id'],$columnas);					
					if(!is_null($dataSet[$cont_regs-1]['s0_id']))
						$fila[$columna_quiebre+5]="<input type='checkbox' checked />";				
					// $fila[$num_cads+2]=number_format(round($totales_segmento[$cont_totales_segmento]['quiebre']*100,1),1,',','.');					
					array_push($output,$fila);		
					$cont_regs++;					
				}
		  }					
	}			
	
	return $output;
	}	
	
	public function hydrateSalacliente($dataSet,$columnas) {
			
		$output=array();				
		$num_regs=count($dataSet);		
		$cont_cols=0;
		$cont_regs=0;		
		$num_cols=count($columnas);					

		$prefixes=array_fill(0,5,"");																								
		
		if($num_regs>0)
		{					
			// Para llevar los cambios del 1er nivel de agregacion
			$nivel1=$dataSet[$cont_regs]['s0_id'];			
			// Lleno la fila con vacios, le agrego 3 posiciones, correspondientes a los niveles de agregación y al total															
			// $fila=array_fill(0,$num_cols+5,"<input id='estudiosala'  type='checkbox' />");																								
			$fila=array();
			foreach($prefixes as $prefix)
				array_push($fila,$prefix);						
			foreach($columnas as $columna)			
				array_push($fila,"<input id='estudiosala' sala='".$dataSet[$cont_regs]['s0_id']."' cliente='".$columna."' salacliente size='13'  style='width:5em' />");			
			
			while($cont_regs<$num_regs)
			{	
				$columna_quiebre=array_search($dataSet[$cont_regs]['s1_id'],$columnas);													
		
				if($nivel1==$dataSet[$cont_regs]['s0_id'])
				{ // Mientras no cambie el 1er nivel asignamos los valores de quiebre a las columnas correspondientes	
					$fila[0]=$dataSet[$cont_regs]['s0_foliocadem'];																	
					$fila[1]=$dataSet[$cont_regs]['s2_nombre'];												
					$fila[2]=$dataSet[$cont_regs]['s3_nombre'];												
					$fila[3]=$dataSet[$cont_regs]['s0_calle'].' '.$dataSet[$cont_regs]['s0_numerocalle'];																												
					$fila[4]=$dataSet[$cont_regs]['s4_nombre'];							
					if(!is_null($dataSet[$cont_regs]['s1_id']))
						$fila[$columna_quiebre+5]="<input id='salacliente' sala='".$dataSet[$cont_regs]['s0_id']."' cliente='".$columnas[$cont_cols]."' salacliente='".$dataSet[$cont_regs]['s1_id']."' value='".$dataSet[$cont_regs]['s1_codigosala']."' size='13' style='width:5em' />";																
					$cont_regs++;
					$cont_cols++;
				}	
				else
				{ // Si el primer nivel de agregacion cambió, lo actualizo, agrego la fila al body y reseteo el contador de cadenas
					// $fila[$num_cads+2]=number_format(round($totales_segmento[$cont_totales_segmento]['quiebre']*100,1),1,',','.');					
					// $cont_totales_segmento++;
					$cont_cols=0;					
					$nivel1=$dataSet[$cont_regs]['s0_id'];			
					array_push($output,$fila);
					// $fila=array_fill(0,$num_cols+5,"<input id='estudiosala' sala='".$dataSet[$cont_regs]['s0_id']."' estudio='".$dataSet[$cont_regs]['s5_id']."' estudiosala='".$dataSet[$cont_regs]['s1_id']."' type='checkbox' />");							
					$fila=array();
					foreach($prefixes as $prefix)
						array_push($fila,$prefix);						
					foreach($columnas as $columna)			
						array_push($fila,"<input id='estudiosala' sala='".$dataSet[$cont_regs]['s0_id']."' cliente='".$columna."' salacliente  style='width:5em'  />");			
				}
				if($cont_regs==$num_regs)		
				{					
					$columna_quiebre=array_search($dataSet[$cont_regs-1]['s1_id'],$columnas);					
					if(!is_null($dataSet[$cont_regs-1]['s0_id']))
						$fila[$columna_quiebre+5]="<input id='salacliente' sala='".$dataSet[$cont_regs-1]['s0_id']."' cliente='".$columnas[$cont_cols]."' salacliente='".$dataSet[$cont_regs-1]['s1_id']."' value='".$dataSet[$cont_regs-1]['s1_codigosala']."'  size='13' style='width:5em'  />";																
					// $fila[$num_cads+2]=number_format(round($totales_segmento[$cont_totales_segmento]['quiebre']*100,1),1,',','.');					
					array_push($output,$fila);		
					$cont_regs++;					
				}
		  }					
	}			
	
	return $output;
	}	
}
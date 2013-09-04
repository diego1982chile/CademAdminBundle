<?php
namespace Cadem\AdminBundle\Helper;

class ControlsBuilderHelper {    

    public function __construct() {
	
    }	
	
	public function buildSelectAuditorsala($options,$selected) {
	
		// $auditor=is_null($selected["id_auditor"])?0:$selected["id_auditor"];
		// $sala=is_null($selected["id_sala"])?0:$selected["id_sala"];
		// $auditorsala=is_null($selected["id_auditorsala"])?0:$selected["id_auditorsala"];
		
		$output='<select id="auditorsala" auditorsala="'.$selected["id_auditorsala"].'" auditor="'.$selected["id_auditor"].'" sala="'.$selected["id_sala"].'">';
		
		foreach($options as $key => $value)
		{
			if($key==$selected["id_auditor"])
				$output=$output.'<option value="'.$key.'" selected>'.$value.'</option>';
			else
				$output=$output.'<option value="'.$key.'">'.$value.'</option>';				
		}
		
		$output=$output.'</select>';
		
		return $output;
	}		
	
	public function buildInputAuditorsala($options,$selected) {
		
		$output='';
		
		foreach($options as $key => $value)
		{
			if($key==$selected["id_auditor"])
			{
				$output='<input class="auditorsala" auditor='.$selected["id_auditor"].' sala='.$selected["id_sala"].' auditorsala='.$selected["id_auditorsala"].' value="'.$selected["auditor"].'" />';
				break;
			}
			else
			{
				$output='<input class="auditorsala"  auditor="" sala="" auditorsala=""    />';
			}
		}				
		
		return $output;
	}		
}
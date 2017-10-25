<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class asnefErrors {

	var $ci;
	var $register;
	
	


	public function __construct() {
		$this->ci = & get_instance();
			
		
	}

	
	function getId(){
		return $this->between_positions($this->register,10, 34);
	}

	function getErrorRegisterType()
	{
		return $this->register_between_positions(531, 532);
	}

	function getErrorOperationIdentity()
	{
		return $this->register_between_positions(533, 534);
	}


	function getErrorDateStart()
	{
		return $this->register_between_positions(535, 536);
		
	}

	function getErrorDateEnd()
	{
		return $this->register_between_positions(537, 538);
		
	}

	function getErrorFinancialProduct()
	{
		return $this->register_between_positions(539, 540);
	}

	function getErrorAmountNominal()
	{
		return $this->register_between_positions(541, 542);

	}

	function getErrorCoinType() 
	{
		return $this->register_between_positions(543, 544);
	}

	function getErrorNumberQuotas()
	{
		return $this->register_between_positions(545, 546);
	}

	function getErrorFrequencyQuotas()
	{
		return $this->register_between_positions(547, 548);
	}

	function getErrorAmountQuotas()
	{
		return $this->register_between_positions(549, 550);
	}

	function getErrorCoinTypeQuotas()
	{
		return $this->register_between_positions(551, 552);
	}

	function getErrorAmountPending()
	{
		return $this->register_between_positions(553, 554);
	}

	function getErrorCoinTypeAmountPending()
	{
		return $this->register_between_positions(555, 556);
	}

	function getErrorSituationOperation()
	{
		return $this->register_between_positions(557, 558);
	}

	function getErrorUnpaidQuotas()
	{
		return $this->register_between_positions(559, 560);
	}

	function getErrorUnpaidFistQuotasDate()
	{
		return $this->register_between_positions(561, 562);
	}

	function getErrorUnpaidLastQuotasDate()
	{
		return $this->register_between_positions(563, 564);
	}

	function getErrorUnpaidBalance()
	{
		return $this->register_between_positions(565, 566);
	}

	function getErrorCoinTypeBalanceUnpaid()
	{
		return $this->register_between_positions(567, 568);
	}

	function getErrorInformation()
	{
		return $this->register_between_positions(569, 570);
	}

	function getErrorNatureCode()
	{
		return $this->register_between_positions(571, 572);
	}

	function getErrorCif()
	{
		return $this->register_between_positions(573, 574);
	}

	function getErrorFormatName()
	{
		return $this->register_between_positions(575, 576);
	}

	function getErrorName()
	{
		return $this->register_between_positions(577, 578);
	}


	function getErrorIndentifyNotifica()
	{
		return $this->register_between_positions(579, 580);
	}

	function getErrorCountryNationality()
	{
		return $this->register_between_positions(581, 582);
	}

	function getErrorCno()
	{
		return $this->register_between_positions(583, 584);
	}

	function getErrorCnae()
	{
		return $this->register_between_positions(585, 586);
	}

	function getErrorFormatAddress()
	{
		return $this->register_between_positions(587, 588);
	}

	function getErrorAddress()
	{
		return $this->register_between_positions(589, 590);
	}
	

	function getErrorTownCode()
	{
		return $this->register_between_positions(591, 592);
	}

	function getErrorTownName()
	{
		return $this->register_between_positions(593, 594);
	}

	function getErrorProvinceCode()
	{
		return $this->register_between_positions(595, 596);
	}

	function getErrorCountryCode()
	{
		return $this->register_between_positions(597, 598);
	}

	function getErrorPostalCode()
	{
		return $this->register_between_positions(599, 600);
	}

	function getErrorFormatPhone()
	{
		return $this->register_between_positions(601, 602);
	}

	function getErrorPhone()
	{
		return $this->register_between_positions(603, 604);
	}


	
	function register_between_positions($pos1, $pos2)
	{
		$code = $this->between_positions($this->register, $pos1, $pos2);
		if($code !="  "){

			return $this->getErrorCode($code);
		} 

		return false;
	}

	function between_positions($string, $pos1, $pos2)
	{
		$pos1 = $pos1 -1;
		$startIndex = min($pos1, $pos2);
		$length = abs($pos1 - $pos2);

		return substr($string, $startIndex, $length);
	}

	function getErrorCode($code)
	{

		switch ($code) {
			case '00':
				$text = "Operacion dada de baja tras la ultima aportacion o, en su defecto, el los ultimos 30 dias"; 
				break;
			case '01':
				$text = "Contenido distinto de 010210"; 
				break;
			case '02':
				$text = "Sin validar al existir error en el tipo de registro"; 
				break;
			case '03':
				$text = "Sin informar"; 
				break;
			case '04':
				$text = "Codigo inexistente en tablas"; 
				break;
			case '05':
				$text = "Formato de fecha incorrecto"; 
				break;
			case '06':
				$text = "Formato numerico incorrecto"; 
				break;
			case '07':
				$text = "Sin validar al existir error en el codigo de producto"; 
				break;
			case '08':
				$text = "Sin validar al existir  error en la fecha de inicio de la operacion"; 
				break;
			case '09':
				$text = "Menor que la fecha de inicio de la operacion"; 
				break;
			case '10':
				$text = "Sin validar  al existir error en el saldo actualmente impagado"; 
				break;
			case '11':
				$text = "Sin validar al existir error en la fecha de fin de operacion"; 
				break;
			case '12':
				$text = "Mayor que la feha final de operacion / cierre contable"; 
				break;
			case '13':
				$text = "Sin validar al existir error en la fecha de vencimiento de la primera cuota actualmente impagada"; 
				break;
			case '14':
				$text = "Menor que la fecha de vencimiento de la primera cuota actualmente impagada"; 
				break;
			case '15':
				$text = "Documento de indentidad incorrecto"; 
				break;
			case '16':
				$text = "Valor distion de 1 2 o 3"; 
				break;
			case '17':
				$text = " Valor distinto de 1 o 2"; 
				break;
			case '18':
				$text = "Tipo de persona incoherente con CNO"; 
				break;
			case '19':
				$text = "Tipo de persona incoherente con CNAE"; 
				break;
			case '20':
				$text = "Informado(estando informado el codigo de municipio)"; 
				break;
			case '21':
				$text = "Anituedad mayore de 2160 dias para la fecha de vencimientode la primera o ultima cuota actualmente impagada respecto a la fecha de proceso del fichero que se corresponde con la siguiente fecha de envio."; 
				break;
			case '22':
				$text = "Sin validar ak existir error en el codigo de situacion"; 
				break;
			case '23':
				$text = "No han trasncurrido 90 dias"; 
				break;
			case '24':
				$text = "No se permite el alta de operaciones con valor de saldo actualmente impagado igual a 0"; 
				break;	
			
			default:
				$text ="";
				break;
		}
		return $text;
	}

	function check_register($line)
	{
		$this->register=$line;
		$data = array();
		$data['codeRegister'] = $this->getErrorRegisterType();
		$data['dateStart'] = $this->getErrorDateStart();
		$data['dateEnd'] = $this->getErrorDateEnd();
		$data['financialProduct'] = $this->getErrorFinancialProduct();
		$data['amountNominal'] = $this->getErrorAmountNominal();
		$data['coinType'] = $this->getErrorCoinType();
		$data['numberQuotas'] = $this->getErrorNumberQuotas();
		$data['frequencyQuotas'] = $this->getErrorFrequencyQuotas();
		$data['amountQuotas'] = $this->getErrorAmountQuotas();
		$data['coinTypeQuota'] = $this->getErrorCoinTypeQuotas();
		$data['amountPending'] = $this->getErrorAmountPending();
		$data['coinTypeAmountPending'] = $this->getErrorCoinTypeAmountPending();
		$data['situationOperation'] = $this->getErrorSituationOperation();
		$data['unpaidQuotas'] = $this->getErrorUnpaidQuotas();
		$data['unpaidFistQuotasDate'] = $this->getErrorUnpaidFistQuotasDate();
		$data['unpaidLastQuotasDate'] = $this->getErrorUnpaidLastQuotasDate();
		$data['unpaidBalance'] = $this->getErrorUnpaidBalance();
		$data['coinTypeBalanceUnpaid'] = $this->getErrorCoinTypeBalanceUnpaid();
		$data['information'] = $this->getErrorInformation();
		$data['natureCode'] = $this->getErrorNatureCode();
		$data['cif'] = $this->getErrorCif();
		$data['formatName'] = $this->getErrorFormatName();
		$data['indentifyNotifica'] = $this->getErrorIndentifyNotifica();
		$data['countryNationality'] = $this->getErrorCountryNationality();
		$data['cno'] = $this->getErrorCno();
		$data['cnae'] = $this->getErrorCnae();
		$data['formatAddress'] = $this->getErrorFormatAddress();
		$data['address'] = $this->getErrorAddress();
		$data['townCode'] = $this->getErrorTownCode();
		$data['townName'] = $this->getErrorTownName();
		$data['provinceCode'] = $this->getErrorProvinceCode();
		$data['countryCode'] = $this->getErrorCountryCode();
		$data['formatPhone'] = $this->getErrorFormatPhone();
		$data['phone'] = $this->getErrorPhone();
		foreach ($data as $key => $value) {

			if(!$value) unset($data[$key]);
			# code...
		}
		
		return array($this->getId(),$data);

	}
	function import_errors($file)
	{
	 	$filename=  $file['tmp_name']; 
		$file = file($filename); 
		$no_of_lines = count(file($filename));
		$errors = array();
		 if( !empty($file)) {

		 	for ($i=0; $i < $no_of_lines ; $i++) { 
		 		
		 		if($i == 0 || $i == $no_of_lines - 1) continue;
		 		//echo $file[$i];

		 		//echo $this->between_positions($file[$i], 9, 34);
				 list($id, $error) = $this->check_register($file[$i]);
				 $this->register = false;
		 		if(!empty($error)){

		 			$errors[$id] = $error;
		 		}

		 	}

		 	
		 } 
		return $errors;
	}

}

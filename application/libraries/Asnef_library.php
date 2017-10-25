<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

include_once(APPPATH . 'libraries/asnefErrors.php');

class Asnef_library extends AsnefErrors {

	var $ci;
	var $error;
	var $errorValidation = false;
	var $headerRegister;
	var $contentRegister = array();
	var $controlRegister;
	var $codeRegisterHeader = "010200";
	var $codeRegister = "010210";
	var $codeRegisterFile = "010299";
	var $indentifyNotifica = "12345678";
	var $entityRegister = "A847";
	var $indentityFileRegister="A8470001";
	var $identifyFile = false;
	


	public function __construct() {
		$this->ci = & get_instance();
		$this->ci->load->config('asnef');
		$this->ci->load->model('asnef_model');
		
	}

	function validate($data)
	{
		if (empty($data)) {
			$this->errorValidation[] = "all";
			return false;
		}

		$fieldsRequired = array('date_start', 'financial_product', 'situation_operation');
		$fieldsCheckOptionValid = array('financial_product', 'quota_frequiency', 'situation_operation', 'nature_code', 'entity_type');
		$productsRequired = array('01', '02', '03', '04', '06', '07', '15', '18', '23');

		if (in_array($data['financial_product'], $productsRequired)) {
			$fieldsRequired[] = 'date_end';
			$fieldsRequired[] = 'quotas_unpaid';			
		}

		if( isset($data['quota_amount']) && $data['quota_amount'] > 0) {
			$fieldsRequired[] = 'quotas_unpaid_first_date';
			$fieldsRequired[] = 'quotas_unpaid_last_date';
		}

		if( isset($data['town_code']) && $data['town_code']=="") {
			$fieldsRequired[] = 'town_name';
		}

		if( !isset($data['country_code']) || ( isset($data['country_code']) && $data['country_code']=="724")) {
			$fieldsRequired[] = 'province_code';
			$fieldsRequired[] = 'postal_code';
		}

		foreach ($fieldsRequired as $require) {
			
			if(!isset($data[$require]) || $data[$require] =="") {
				$this->errorValidation[$require] = $require. ' no existe o esta vacio';
			}
		}

		foreach ($fieldsCheckOptionValid as $checkValid) {


			if(isset($data[$checkValid]) && !in_array($data[$checkValid],array_keys($this->ci->config->item($checkValid)))) {
				$this->errorValidation[$checkValid] = $checkValid. ' no es correcto';
			}
		}



		if ($this->errorValidation) {

			return false;
		}

		
		
		return true;
	}

	function getIndentifyFile()
	{
		$this->identifyFile = time();
	}


	function setOperationIdentity($longitud = 25)
	{
		$uniqueid = uniqid();
		$longitud = $longitud - 13;
		$key = '';
		$pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
		$max = strlen($pattern)-1;
		for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
		$key = $uniqueid.$key;	
		$this->operationIndentity = $this->completeNumber($key, 25);
		return $this->operationIndentity;
	}

	function setDateStart($date)
	{
		if ($this->count($date) == 8) {
			return  $date;
		} else {
			$this->error = "Error al asignar fecha";
		}
		
	}

	function setDateEnd($date)
	{
		if ($this->count($date) == 8) {
			return $date;
			return $this;
		} else {
			$this->error = "Error al asignar fecha";
		}
		
	}

	function setFinancialProduct($product)
	{
		return $product;
	}

	function setAmountNominal($amount)
	{
		return $this->completeNumber($amount,15);

	}

	function setCoinType($coinType) 
	{
		return $this->completeNumber($coinType, 2);
	}

	function setNumberQuotas($numberQuotas)
	{
		return $this->completeNumber($numberQuotas, 4);
	}

	function setFrequencyQuotas($frequencyQuotas)
	{
		return $this->completeNumber($frequencyQuotas, 2);
	}

	function setAmountQuotas($amountQuotas)
	{
		return $this->completeNumber($amountQuotas, 15);
	}

	function setCoinTypeQuotas($coinTypeQuota)
	{
		return $this->completeNumber($coinTypeQuota, 2);
	}

	function setAmountPending($amountPending)
	{
		return $this->completeNumber($amountPending, 15);
	}

	function setCoinTypeAmountPending($coinTypeAmountPending)
	{
		return $this->completeNumber($coinTypeAmountPending, 2);
	}

	function setSituationOperation($situationOperation)
	{
		return $this->completeNumber($situationOperation, 2);
	}

	function setUnpaidQuotas($unpaidQuotas)
	{
		return $this->completeNumber($unpaidQuotas, 4);
	}

	function setUnpaidFistQuotasDate($unpaidFistQuotasDate)
	{
		return $this->completeNumber($unpaidFistQuotasDate, 8);
	}

	function setUnpaidLastQuotasDate($unpaidLastQuotasDate)
	{
		return $this->completeNumber($unpaidLastQuotasDate, 8);
	}

	function setUnpaidBalance($unpaidBalance)
	{
		return $this->completeNumber($unpaidBalance, 15);
	}

	function setCoinTypeBalanceUnpaid($coinTypeBalanceUnpaid)
	{
		return $this->completeNumber($coinTypeBalanceUnpaid, 2);
	}

	function setInformation($information)
	{
		return $this->completeText($information, 40);
	}

	function setNatureCode($natureCode)
	{
		return $this->completeNumber($natureCode, 2);
	}

	function setCif($cif)
	{
		return $this->completeNumber($cif, 10);
	}

	function setFormatName($formatName)
	{
		return $this->completeNumber($formatName, 1);
	}

	function setName($name)
	{
		return $this->completeText($name, 30);
	}

	function setSurname($surname)
	{
		return $this->completeText($surname, 80);
	}
	function setSocialName($social_name)
	{
		$socialName =  mb_substr($social_name,0, 80, "UTF-8" );
		return $this->completeText($socialName, 110);
	}


	function setIndentifyNotifica($notifica)
	{
		return $this->completeText($notifica, 8);
	}

	function setCountryNationalitye($countryNationality)
	{
		return $this->completeNumber($countryNationality, 3);
	}

	function setCno($cno)
	{
		return $this->completeText('', 5);
	}

	function setCnae($cnae)
	{
		//return $this->completeNumber($cnae, 5);
		return $this->completeText('', 5);
	}

	function setFormatAddress($formatAddress)
	{
		return $this->completeNumber($formatAddress, 1);
	}

	function setAddress($address)
	{
		return $this->completeText($address, 60);
	}
	function setAddressType($addressType)
	{
		return $this->completeText($addressType, 5);
	}
	function setAddressNumber($setAddressNumber)
	{
		return $this->completeText($setAddressNumber, 5);
	}
	function setAddressOther($addressOther)
	{
		return $this->completeText($addressOther, 40);
	}

	function setTownCode($townCode)
	{
		$townCode = "";
		return $this->completeNumber($townCode, 6, 'right');
	}

	function setTownName($townName)
	{
		return $this->completeText($townName, 50);
	}

	function setProvinceCode($provinceCode)
	{
		return $this->completeNumber($provinceCode, 2);
	}

	function setCountryCode($countryCode)
	{
		//return $this->completeNumber($countryCode, 3);
		return $this->completeText('', 3);
	}

	function setPostalCode($postalCode)
	{
		return $this->completeNumber($postalCode, 5);
	}

	function setFormatPhone($formatPhone)
	{
		return $this->completeNumber($formatPhone, 1);
	}

	function setPhone($phone)
	{
		return $this->completeNumber($phone, 20);
	}





	function setRegister($register)
	{
		$dateStart = $this->setDateStart($register->date_start);
		$dateEnd = $this->setDateEnd($register->date_end);
		$financialProduct = $this->setFinancialProduct($register->financial_product);
		$amountNominal = $this->setAmountNominal($register->amount);
		$coinType = $this->setCoinType($register->coin_type);
		$numberQuotas = $this->setNumberQuotas($register->quota_number);
		$amountQuotas = $this->setAmountQuotas($register->quota_amount);
		$frequencyQuotas = $this->setFrequencyQuotas($register->quota_frequiency);
		$coinTypeQuota = $this->setCoinTypeQuotas($register->quota_coin_type);
		$amountPending = $this->setAmountPending($register->amount_pending);
		$coinTypeAmountPending = $this->setCoinTypeAmountPending($register->amount_pending_coin_type);
		$situationOperation = $this->setSituationOperation($register->situation_operation);
		$unpaidQuotas = $this->setUnpaidQuotas($register->quotas_unpaid);
		$unpaidFistQuotasDate = $this->setUnpaidFistQuotasDate($register->quotas_unpaid_first_date);
		$unpaidLastQuotasDate = $this->setUnpaidLastQuotasDate($register->quotas_unpaid_last_date);
		$unpaidBalance = $this->setUnpaidBalance($register->balance_unpaid);
		$coinTypeBalanceUnpaid = $this->setCoinTypeBalanceUnpaid($register->balance_unpaid_coin_type);
		$information = $this->setInformation($register->information);
		$natureCode = $this->setNatureCode($register->nature_code);
		$cif = $this->setCif($register->cif);
		$formatName = $this->setFormatName($register->format_name);

		if($register->social_name != "") {
			$name = $this->setSocialName($register->social_name);
		} else {
			$name = $this->setName($register->name);
			$name .= $this->setSurname($register->surname);
		}


		$countryNationality = $this->setCountryNationalitye($register->country_nationality);
		$cno = $this->setCno($register->cno);
		$cnae = $this->setCnae($register->cnae);
		$formatAddress = $this->setFormatAddress($register->format_address);
		$addressType = $this->setAddressType($register->address_type);
		$address = $this->setAddress($register->address);
		$addressNumber = $this->setAddressNumber($register->address_number);
		$addressOther = $this->setAddressOther($register->address_other);
		$townCode = $this->setTownCode($register->town_code);
		$townName = $this->setTownName($register->town_name);
		$provinceCode = $this->setProvinceCode($register->province_code);
		$countryCode = $this->setCountryCode($register->country_code);
		$postalCode = $this->setPostalCode($register->postal_code);
		$formatPhone = $this->setFormatPhone($register->format_phone);
		$phone = $this->setPhone($register->phone);

		$content = $this->completeNumber($this->codeRegister, 6).$register->identify.$dateStart.$dateEnd.$financialProduct.$amountNominal.$coinType.$numberQuotas.$frequencyQuotas.$amountQuotas.$coinTypeQuota.$amountPending.$coinTypeAmountPending.$situationOperation.$unpaidQuotas.$unpaidFistQuotasDate.$unpaidLastQuotasDate.$unpaidBalance.$coinTypeBalanceUnpaid.$information.$natureCode.$cif.$formatName.strtoupper($name).$this->indentifyNotifica.$countryNationality.$cno.$cnae.$formatAddress.strtoupper($addressType).strtoupper($address).$addressNumber.strtoupper($addressOther).$townCode.strtoupper($townName).$provinceCode.$countryCode.$postalCode.$formatPhone.$phone."\r\n";

		$this->contentRegister[] = $content;
		$this->ci->asnef_model->update($register->identify, array('status' => 'completed', 'in_file'=>$this->identifyFile.''));

	}

	function writeContent(){
		$content = "";
		if (!empty($this->contentRegister)) {
			foreach ($this->contentRegister as $register) {
				$content .= $register;
			}

		}
		return $content;
	}

	function writeHeader()
	{
		$header = array();
		$header['type_register'] = $this->completeNumber($this->codeRegisterHeader, 6);
		$header['entity'] = $this->completeNumber($this->entityRegister, 4);
		$header['indentityFile'] = $this->completeNumber($this->indentityFileRegister, 8);
		$header['porcessDate'] = $this->completeNumber(Date('Ymd'), 8);
		$header['closeDate'] = $this->completeNumber(Date('Ymd'), 8);
		return $this->headerRegister = $header['type_register'].$header['entity'].$header['indentityFile'].$header['porcessDate'].$header['closeDate']."\r\n";
	}

	function writeControl()
	{
		$control = array();
		$control['type_register'] = $this->completeNumber($this->codeRegisterFile, 7);
		$control['entity'] = $this->completeNumber($this->entityRegister, 4);
		$control['indentityFile'] = $this->completeNumber($this->indentityFileRegister, 8);
		$control['porcessDate'] = $this->completeNumber(Date('Ymd'), 8);
		$control['numberRegisterOperation'] = $this->completeText(count($this->contentRegister), 9, 'left');
		$control['numberRegister'] = $this->completeText(count($this->contentRegister)+2, 9, 'left');

		
		return $this->controlRegister = $control['type_register'].$control['entity'].$control['indentityFile'].$control['porcessDate'].$control['numberRegisterOperation'].$control['numberRegister']."\r\n";
	}

	function handle()
	{
		$this->ci->load->helper('file');
		$txt = $this->writeHeader();
		$txt.= $this->writeContent();
		$txt.= $this->writeControl();
		$txt =mb_convert_encoding($txt, "Windows-1252", "UTF-8");


	    if ( ! write_file('/var/www/html/asnef/ficheros/'.$this->identifyFile, $txt))
	    {
	          die('no ha podido escribir el fichero');
	    }else{
	         return $txt;
	    }

	    return false;

	}



	function generateFile()
	{
		$registers = $this->ci->asnef_model->get(array('status' => 'pending'));
		
		if(!$registers){
			return false;
		}
		$this->getIndentifyFile();
		$this->setOperationIdentity();
		foreach ($registers as $register) {
			
			
			
			$this->setRegister($register);
			
		}
		
		return $this->handle();
	}
	function completeNumber($number, $min, $position='left')
	{
 
 		if($number == "") return  mb_str_pad($number, $min, " ", STR_PAD_LEFT, "UTF-8");
 		if ($position == 'left') {
			$number = mb_str_pad($number, $min, "0", STR_PAD_LEFT, "UTF-8");
		} else {
			$number = mb_str_pad($number, $min, "0", STR_PAD_RIGHT, "UTF-8");
		}
		
		
		return mb_substr($number,0,$min, "UTF-8");
	}

	function completeText($text, $min, $position='right')
	{
		if ($position == 'right') {
			$text = mb_str_pad($text, $min, " ", STR_PAD_RIGHT, "UTF-8");
		} else {
			$text = mb_str_pad($text, $min, " ", STR_PAD_LEFT, "UTF-8");
		}
		

		return mb_substr($text,0,$min, "UTF-8" );
	}

	function count($text)
	{
		return strlen($text);
	}

	

	
}

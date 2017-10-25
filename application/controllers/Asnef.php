<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Controlador Clientes
*
* @author Jos� Manuel Su�rez Bravo <jose@circulogacela.com>
* @author Milagros Noya Pe�a <mnoya@circulogacela.com>
*
* @package administrador
* @subpackage clientes
*/

class Asnef extends CI_Controller {
	
	/**
	* Constructor de la clase. Se encarga de cargar los ficheros necesarios.
	*/
	function __construct()
	{
		parent::__construct();

		$this->load->library('asnef_library');

	}
	

	/**
    * Template para el controlador
    **/
    private function _template($contenido,$menu=0){
	   
		$data['content'] = $contenido;
		echo $this->load->view('asnef/index', $data, true);
    }
	
	function index()
	{
		$this->load->model('asnef_model');
		$search = array('status'=>'pending');
		
		if($this->input->post('search')){
			$search['search'] = $this->input->post('search'); 
		}
		$registros = $this->asnef_model->get($search);
		$data = array(
			'registers' => $registros
		);

		$data['generate'] = ($registros)?true:false;
		$contenido = $this->load->view('asnef/list', $data,TRUE);
		$this->_template($contenido,118);
	}


	function sended()
	{
		$this->load->model('asnef_model');
		$search = array('status'=>'completed');

		if($this->input->post('search')){
			$search['search'] = $this->input->post('search'); 
		}
		$all = $this->asnef_model->get($search);
		$data['registers'] = $all;
		$data['generate'] = false;
		$contenido = $this->load->view('asnef/list', $data,TRUE);
		$this->_template($contenido,118);
	}

	function show($id)
	{
		$this->load->library('session');
		
		$this->load->helper('form');
		$data = array();
		$data['id'] = $id;


		if($_POST){
			$update = array();
			foreach ($_POST as $key => $value) {
				$update[$key] = $_POST[$key];
				if($key == "town"){
					$this->db->where('id_municipio',   $_POST['town']);
					$query = $this->db->get('municipios');
					if($query->num_rows()==1){
						$municipio = $query->row();
						$update['town_code'] = $this->asnef_library->completeNumber($municipio->fid_provincia, 2).$this->asnef_library->completeNumber($municipio->codigo_municipio, 3);
						$update['town_name'] = $municipio->nombre;
					}
					unset($update['town']);
				}
				
				
			}

			$update['status'] = "pending";
			$update = $this->asnef_model->update($id, $update);
			if($update) {
				$message = 'Registro actualizado';	
			} else {
				$message = 'Registro no actualizado';
			}
			$this->session->set_flashdata('message', $message);
			
		}

		$municipios = array();
		$query = $this->db->get('municipios');
		foreach ($query->result() as $value) {
			$municipios[$this->asnef_library->completeNumber($value->fid_provincia, 2).$this->asnef_library->completeNumber($value->codigo_municipio, 3)] = $value->nombre;
		}
		$data['municipio'] = $municipios;
		$data['situation_operation'] = $this->config->item('situation_operation');
		$data['nature_code'] = $this->config->item('nature_code');

		$registro = $this->asnef_model->getId($id);

		$data['date_start'] = $registro->date_start;
		$data['date_end'] = $registro->date_end;
		$data['quotas_unpaid_first_date'] = $registro->quotas_unpaid_first_date;
		$data['quotas_unpaid_last_date'] = $registro->quotas_unpaid_last_date;
		$data['balance_unpaid'] = $registro->balance_unpaid;
		$data['information'] = $registro->information;
		$data['cif'] = $registro->cif;
		$data['name'] = $registro->name;
		$data['surname'] = $registro->surname;
		$data['social_name'] = $registro->social_name;
		$data['address'] = $registro->address;
		$data['address_type'] = $registro->address_type;
		$data['address_number'] = $registro->address_number;
		$data['address_other'] = $registro->address_other;
		$data['town_code_value'] = $registro->town_code;
		$data['nature_code_value'] = $registro->nature_code;
		$data['province_code'] = $registro->province_code;
		$data['postal_code'] = $registro->postal_code;
		$data['phone'] = $registro->phone;

		$data['situation_operation_value'] = $registro->situation_operation;

		$contenido = $this->load->view('asnef/show',$data,TRUE);
		$this->_template($contenido,118);
	}

	function create()
	{
		$this->load->helper('form');
		$this->load->config('asnef');
		$this->load->library('asnef_library');
		$data = array();
		$data['situation_operation'] = $this->config->item('situation_operation');
		$data['nature_code'] = $this->config->item('nature_code');



		$municipios = array();
		$this->db->order_by('nombre', 'ASC');
		$query = $this->db->get('municipios');
		foreach ($query->result() as $value) {
			$municipios[$value->id_municipio] = $value->nombre;
		}
		$data['municipio'] = $municipios;

		if($_POST){

			$register = array();
			$register['identify'] = $this->asnef_library->setOperationIdentity();
			$register['date_start'] = $this->input->post('date_start');
			$register['date_end'] = $this->input->post('date_end');
			//$register['financial_product'] = $this->input->post('financial_product');
			$register['financial_product'] = "02";
			$register['amount'] = $this->input->post('amount');
			$register['coin_type'] = '02';
			$register['quota_number'] = $this->input->post('quota_number');
			$register['quota_frequiency'] = $this->input->post('quota_frequiency');
			$register['quota_amount'] = $this->input->post('quota_amount');
			$register['quota_coin_type'] = '02';
			$register['amount_pending'] = $this->input->post('amount_pending');
			$register['amount_pending_coin_type'] = '02';
			$register['situation_operation'] = $this->input->post('situation_operation');
			//$register['quotas_unpaid'] = $this->input->post('quotas_unpaid');
			$register['quotas_unpaid'] = 1;
			$register['quotas_unpaid_first_date'] = $this->input->post('quotas_unpaid_first_date');
			$register['quotas_unpaid_last_date'] = $this->input->post('quotas_unpaid_last_date');
			$register['balance_unpaid'] = $this->input->post('balance_unpaid');
			$register['balance_unpaid_coin_type'] = "02";
			$register['information'] = $this->input->post('information');
			$register['nature_code'] = $this->input->post('nature_code');
			$register['cif'] = $this->input->post('cif');
			$register['format_name'] = 2;
			$register['name'] = $this->input->post('name');
			$register['surname'] = $this->input->post('surname');
			$register['social_name'] = $this->input->post('social_name');
			$register['identify_notifica'] = 'notifica';
			$register['country_nationality'] = 724;
			$register['cno'] = $this->input->post('cno');
			$register['cnae'] = $this->input->post('cnae');
			$register['format_address'] = 2;
			$register['address'] = $this->input->post('address');
			$register['address_type'] = $this->input->post('address_type');
			$register['address_number'] = $this->input->post('address_number');
			$register['address_other'] = $this->input->post('address_other');

			$this->db->where('id_municipio',  $this->input->post('town'));
			$query = $this->db->get('municipios');
			$municipio = $query->row();
			$register['town_code'] = $this->asnef_library->completeNumber($municipio->fid_provincia, 2).$this->asnef_library->completeNumber($municipio->codigo_municipio, 3);
			//$register['town_code'] = "";
			$register['town_name'] = $municipio->nombre;
			$register['province_code'] = $municipio->fid_provincia;

			$register['country_code'] = 724;
			$register['postal_code'] = $this->input->post('postal_code');
			$register['format_phone'] = 1;
			$register['phone'] = $this->input->post('phone');


			if (!$this->asnef_library->validate($register)) {

				$data['errors'] = $this->asnef_library->errorValidation;
				//$this->response($data, 422);
				var_dump($data['errors']);die();
				
			}

			$this->load->model('asnef_model');
			$this->asnef_model->add($register);
			redirect('asnef/index');
			
		}
		
		$contenido = $this->load->view('asnef/add', $data,TRUE);
		$this->_template($contenido,118);

 
	}
			
	function remove($id)
	{
		$this->asnef_model->update($id, array('status' => 'deleted'));
		redirect('asnef/index');
	}


	function showFile($file)
	{
		$this->load->model('asnef_model');
		$registros = $this->asnef_model->get(array('in_file'=>$file));
		$data = array(
			'registers' => $registros,
			'generate' => false
		);
		$contenido = $this->load->view('asnef/list', $data,TRUE);
		$this->_template($contenido,118);
	}

	function errors(){
		$data = array();
		$data['error'] = "";
		$registrosError = false;

		if($_FILES){
			$errors = $this->asnef_library->import_errors($_FILES['userfile']);
			$registros = $this->asnef_model->get(array('status'=>'completed'));

			if ($registros) {
				foreach ($registros as $value) {

					if(isset($errors[$value->identify])){
						$error = "";
						foreach ($errors[$value->identify] as $key => $val) {

							$error.=" ".$key." ".$val."<br>";
						}
						$value->errors = $error;
						$registrosError[] = $value;
						
					}
				}
			}
			$data = array(
				'registers' => $registrosError
			);
			$contenido = $this->load->view('asnef/errors', $data,TRUE);
			$this->_template($contenido,118);
			
		}

	}

	function generate()
	{
		$this->load->library('asnef_library');
		$file = $this->asnef_library->generateFile();

		if($file)
		$name = rand(1,99999).uniqid();
		$this->load->helper('download');
		header('Content-Type: text/plain');
		header('Content-Disposition: attachment; filename="'.$name.'.txt"');
		force_download($name.".txt", $file);
	}
	
	
}

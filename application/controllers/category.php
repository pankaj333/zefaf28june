<?php

include_once BASEPATH.'../data_manager/DataManager.php';

class Category extends CI_Controller {
	private $dm_profile = 'category_admin';
	private $controller = '';

	function __construct() {
		parent::__construct();
		 $this->load->helper('url');
		 $this->controller = strtolower(__CLASS__);
	}

	function create() {
		$dm = new DataManager($this->dm_profile);
		$dm->setMode('single');
		if ($dm->loadData() === false) {
			var_dump($dm->getErrors());
			exit;
		}

		$data['titles'] = $dm->getTitles();
		$data['fields'] = $dm->getFields();
		$data['fields'] = $data['fields'][0];
		$data['controller'] = $this->controller;

		$data['page'] = 'pages/admin/'.$this->controller.'/edit';

		$this->load->view('pages/admin/main_tpl', $data);
	}
	
	function delete() {
		$id = (int) $this->uri->segment(3, 0);
		
		$dm = new DataManager($this->dm_profile);
		if ($dm->delete($id) === false) {
			var_dump($dm->getErrors());
			exit;
		}
		
		redirect('/'.$this->controller.'/list_all/1/deleted');
	}
	
	function edit() {
		$id = (int) $this->uri->segment(3, 0);
		
		$dm = new DataManager($this->dm_profile);
		if ($id) {
			$dm->setKeyValue($id);
		}
		$dm->setMode('single');
		if ($dm->loadData() === false) {
			var_dump($dm->getErrors());
			exit;
		}

		$data['titles'] = $dm->getTitles();
		$data['fields'] = $dm->getFields();
		$data['fields'] = $data['fields'][0];
		$data['controller'] = $this->controller;
		
		$data['page'] = 'pages/admin/'.$this->controller.'/edit';
		
		$this->load->view('pages/admin/main_tpl', $data);
	}
	
	function index() {
		$this->list_all();
	}
	
	function list_all() {
		$page = (int) $this->uri->segment(3, 1);
		$page = ($page?$page:1);
		$items_per_page = 10;
		
		$dm = new DataManager($this->dm_profile);
		$dm->setItemsPerPage($items_per_page);
		$dm->setPage($page);
		$dm->setMode('list');
		$dm->setOrderingField('id', 1);
		if ($dm->loadData() === false) {
			var_dump($dm->getErrors());
			exit;
		}

		$data['pages_count'] = $dm->getPagesCount();
		
		$message = $this->uri->segment(4);
		switch($message) {
			case 'deleted':
				$data['message'] = 'Item deleted.';
				break;
			case 'saved':
				$data['message'] = 'Item saved.';
				break;
			default:
				$data['message'] = '';
		}

		$data['titles'] = $dm->getTitles();
		$data['fields'] = $dm->getFields();
		$data['controller'] = $this->controller;
		
		$data['page'] = 'pages/admin/'.$this->controller.'/list';
		
		$this->load->view('pages/admin/main_tpl', $data);
	}
	
	function save() {
		$data = $this->input->post();
		$dm = new DataManager($this->dm_profile);
		if ($dm->save($data) === false) {
			var_dump($dm->getErrors());
			exit;
		}
			
		redirect('/'.$this->controller);
	}
}
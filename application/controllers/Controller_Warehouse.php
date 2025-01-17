<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_Warehouse extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Warehouse';

		$this->load->model('model_stores');
	}

	/* 
    * It only redirects to the manage stores page
    */
	public function index()
	{
		if(!in_array('viewStore', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$this->render_template('warehouse/index', $this->data);	
	}

	/*
	* It retrieve the specific store information via a store id
	* and returns the data in json format.
	*/
	public function fetchStoresDataById($id) 
	{
		if($id) {
			$data = $this->model_stores->getStoresData($id);
			echo json_encode($data);
		}
	}

	/*
	* It retrieves all the store data from the database 
	* This function is called from the datatable ajax function
	* The data is return based on the json format.
	*/
	public function fetchStoresData()
	{
		$result = array('data' => array());
	
		$data = $this->model_stores->getStoresData();
	
		foreach ($data as $key => $value) {
			// button
			$buttons = '';
	
			if(in_array('updateStore', $this->permission)) {
				$buttons = '<button type="button" class="btn btn-warning btn-sm" onclick="editFunc('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i></button>';
			}
	
			if(in_array('deleteStore', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-danger btn-sm" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			}
	
			$status = ($value['active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';
	
			// Image handling
			$image = '';
			if($value['image'] && file_exists('./assets/images/warehouse/'.$value['image'])) {
				$image = '<img src="'.base_url('assets/images/warehouse/'.$value['image']).'" class="img-thumbnail" width="50">';
			} else {
				$image = 'No Image available';
			}
	
			$result['data'][$key] = array(
				
				$value['name'],
				$image,
				$value['location'],
				$status,
				$buttons
			);
		} // /foreach
	
		echo json_encode($result);
	}

	public function create()
	{
		if (!in_array('createStore', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
	
		$response = array();
	
		$this->form_validation->set_rules('store_name', 'Warehouse name', 'trim|required');
		$this->form_validation->set_rules('location', 'Location', 'trim|required');
		$this->form_validation->set_rules('active', 'Active', 'trim|required');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
	
		if ($this->form_validation->run() == TRUE) {
			$config['upload_path'] = './assets/images/warehouse/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$config['max_size'] = 2048;
			$config['encrypt_name'] = TRUE;
	
			$this->load->library('upload', $config);
	
			if (!is_dir($config['upload_path'])) {
				mkdir($config['upload_path'], 0777, TRUE);
			}
	
			if (!$this->upload->do_upload('warehouse_image')) {
				$response['success'] = false;
				$response['messages']['warehouse_image'] = $this->upload->display_errors();
			} else {
				$image_data = $this->upload->data();
				$image_name = $image_data['file_name']; // Get the unique file name
	
				$data = array(
					'name' => $this->input->post('store_name'),
					'location' => $this->input->post('location'),
					'image' => $image_name, // Save only the file name, not the full path
					'active' => $this->input->post('active'),
				);
	
				$create = $this->model_stores->create($data);
	
				if ($create == true) {
					$response['success'] = true;
					$response['messages'] = 'Successfully created';
				} else {
					$response['success'] = false;
					$response['messages'] = 'Error in the database while creating the warehouse information';
				}
			}
		} else {
			$response['success'] = false;
			foreach ($_POST as $key => $value) {
				$response['messages'][$key] = form_error($key);
			}
		}
	
		echo json_encode($response);
	}
	
	
	public function update($id)
	{
		if (!in_array('updateStore', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
	
		$response = array();
	
		if ($id) {
			$this->form_validation->set_rules('edit_store_name', 'Warehouse name', 'trim|required');
			$this->form_validation->set_rules('edit_location', 'Location', 'trim|required');
			$this->form_validation->set_rules('edit_active', 'Active', 'trim|required');
	
			$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
	
			if ($this->form_validation->run() == TRUE) {
				$config['upload_path'] = './assets/images/warehouse/';
				$config['allowed_types'] = 'jpg|jpeg|png|gif';
				$config['max_size'] = 2048;
				$config['encrypt_name'] = TRUE;
	
				$this->load->library('upload', $config);
	
				if (!is_dir($config['upload_path'])) {
					mkdir($config['upload_path'], 0777, TRUE);
				}
	
				$image_path = '';
				if (!empty($_FILES['edit_warehouse_image']['name'])) {
					if (!$this->upload->do_upload('edit_warehouse_image')) {
						$response['success'] = false;
						$response['messages']['edit_warehouse_image'] = $this->upload->display_errors();
						echo json_encode($response);
						return;
					} else {
						$image_data = $this->upload->data();
						$image_path = $image_data['file_name']; // Get the unique file name
					}
				}
	
				$data = array(
					'name' => $this->input->post('edit_store_name'),
					'location' => $this->input->post('edit_location'),
					'active' => $this->input->post('edit_active'),
				);
	
				if ($image_path) {
					$data['image'] = $image_path; // Store only the file name
				}
	
				$update = $this->model_stores->update($data, $id);
	
				if ($update == true) {
					$response['success'] = true;
					$response['messages'] = 'Successfully updated';
				} else {
					$response['success'] = false;
					$response['messages'] = 'Error in the database while updating the warehouse information';
				}
			} else {
				$response['success'] = false;
				foreach ($_POST as $key => $value) {
					$response['messages'][$key] = form_error($key);
				}
			}
		} else {
			$response['success'] = false;
			$response['messages'] = 'Error, please refresh the page and try again!';
		}
	
		echo json_encode($response);
	}
	
	
    /*
    * This function is invoked from another function to upload the image into the assets folder
    * and returns the image path
    */
	public function upload_image()
    {
    	// assets/images/product_image
        $config['upload_path'] = 'assets/images/warehouse';
        $config['file_name'] =  uniqid();
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '1000';

        // $config['max_width']  = '1024';s
        // $config['max_height']  = '768';

        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('warehouse_image'))
        {
            $error = $this->upload->display_errors();
            return $error;
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            $type = explode('.', $_FILES['warehouse_image']['name']);
            $type = $type[count($type) - 1];
            
            $path = $config['upload_path'].'/'.$config['file_name'].'.'.$type;
            return ($data == true) ? $path : false;            
        }
    }

	/*
	* If checks if the store id is provided on the function, if not then an appropriate message 
	is return on the json format
    * If the validation is valid then it removes the data into the database and returns an appropriate 
    message in the json format.
    */
	public function remove()
	{
		if(!in_array('deleteStore', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		
		$store_id = $this->input->post('store_id');

		$response = array();
		if($store_id) {
			$delete = $this->model_stores->remove($store_id);
			if($delete == true) {
				$response['success'] = true;
				$response['messages'] = "Successfully removed";	
			}
			else {
				$response['success'] = false;
				$response['messages'] = "Error in the database while removing the brand information";
			}
		}
		else {
			$response['success'] = false;
			$response['messages'] = "Refersh the page again!!";
		}

		echo json_encode($response);
	}

}
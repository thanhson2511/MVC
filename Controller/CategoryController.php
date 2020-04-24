<?php 
	require_once 'Models/Category.php';
	require_once 'Controller/BaseController.php';

	class CategoryController extends BaseController{
		public $model;
		 function __construct(){
		 	$this->model = new Category();
		 }

		 public function list(){
		 	$categories = $this->model->getAll();
		 	$this->view('category/list.php', ['categories' => $categories]);
		 }

		 public function detail(){
		 	$id = $_GET['id'];
		 	$category = $category_model->getId($id);
		 	$this->view('category/detail.php', ['categories' => $categories]);
		 }

		
		public function edit($id){
			$id = $_GET['id'];
			$categories = $category_model->getAll();
			
			$category = $this->category_model->find($id);
			$this->view('category/edit.php', ['categories' => $categories]);
		}

		public function update(){
			$data = $_POST;
			$category_model = new Category();

			$data["content"] = htmlspecialchars($data["content"]);
			$result = $category_model->update($data);
			if($result){
				setcookie("success", "update thanh cong", time()+3);
				header("Location: index.php?mod=category&act=list");
			}else{
				setcookie("fail", "update khong thanh cong", time()+3);
				header("Location: index.php?mod=category&act=edit&id=" .$data["id"]);
			}
		}

		public function destroy($id){
			$result = $this->category_model->delete($id);
			if($result){
				setcookie("success", "Xoa thanh cong", time()+3);
			}else{
				setcookie("fail", "Xoa khong thanh cong", time()+3);
			}
			header("Location: index.php?mod=category&act=list");
		}

		public function store(){
			$data = $_POST;
			$category_model = new Category();

			
			$result = $category_model->add($data);
			if($result){
				setcookie("success", "Tao moi thanh cong", time()+3);
			}else{
				setcookie("fail", "tao moi khong thanh cong", time()+3);
			}

			header("Location: index.php?mod=category&act=list");
		}
	}
 ?>
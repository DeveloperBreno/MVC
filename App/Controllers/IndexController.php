<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use App\Connection;
use MF\Model\Container;

class IndexController extends Action {

	public function index() {

		$this->render('index');
	}

	public function login(){
		$this ->render('login');
	}

	public function inscreverse(){
		$this->view->erroCadastro = false;
		$this ->render('inscreverse');
		
	}

	public function registrar(){
		$conn = Connection::getDb();
		//receber os dados do formulario
		$usuario = Container::getModel('usuario');
		$usuario-> __set('nome', $_POST['nome']);
		$usuario-> __set('email', $_POST['email']);
		$usuario-> __set('senha', $_POST['senha']);

		if($usuario->ValidarCad() && (count($usuario->userporemail()) == 0)){
			{
				$usuario->salvar();
				$this->render('cadastro');
			}
			
		}else{

			$this->

			$this->view->usuario = array(
				'nome' => $_POST['nome'],
				'email' => $_POST['email'],
				'senha' => $_POST['senha'],
			);
			
			$this->view->erroCadastro = true;

			$this->render("inscreverse");

		}
			
	}
}


?>
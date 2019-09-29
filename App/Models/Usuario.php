<?php

namespace App\Models;

use MF\Model\Model;

class Usuario extends Model{
    private $id;
    private $nome;
    private $email;
    private $senha;

    public function __get($atributo){
        return $this->$atributo;
    }

    public function __set($atributo, $valor){
        $this->$atributo = $valor;
    }

    //salvar

    public function salvar(){
        $query = "insert into usuarios(nome, email, senha)values(:nome, :email, :senha)";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':nome', $this->__get('nome'));
        $stmt->bindValue(':email', $this->__get('email'));
        $stmt->bindValue(':senha', $this->__get('senha'));
        $stmt->execute();

        return true;

    }

    //Validar Cadastro
    public function ValidarCad() {
        $valido = true;
        //Quantidade Caracter Nome
        if (strlen($this->__get('nome')) < 3){
            $valido = false;
        }
        // Quatidade Caracter E-mail
        if (strlen($this->__get('email')) < 3){
            $valido = false;
        }
        //Quantidade Caracter Senha
        if (strlen($this->__get('senha')) < 3){
            $valido = false;
        }

        return $valido;
    }

    //Verificar duplicidade de E-mail
    public function userporemail(){
        $query = "select nome, email from usuarios where email = ? ";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(1,$this->__get('email'));
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    
    

}

  
?>
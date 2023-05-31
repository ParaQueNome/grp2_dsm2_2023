<?php
require_once('Conexao.php');

class Evento{
    
    private $id;
    private $data;
    private $hora;
    private $local;
    private $tipo_esporte;
    private $faixa_etaria;
    private $sessao_id;
    private $connect;

    function __construct(){
        $this->connect = new Conexao();
    
    }
    // Metodo de insercao de eventos no banco de dados
    public function createEvento($data, $hora, $local, $tipo_esporte, $faixa_etaria, $sessao_id) {
        try {
            $this->data = $data;
            $this->hora = $hora;
            $this->local = $local;
            $this->tipo_esporte = $tipo_esporte;
            $this->faixa_etaria = $faixa_etaria;
            $this->sessao_id = $sessao_id;
            
            // Sanitização dos dados
            $data = $this->sanitizeInput($this->data);
            $hora = $this->sanitizeInput($this->hora);
            $local = $this->sanitizeInput($this->local);
            $tipo_esporte = $this->sanitizeInput($this->tipo_esporte);
            $faixa_etaria = $this->sanitizeInput($this->faixa_etaria);
            $sessao_id = $this->sanitizeInput($this->sessao_id);
            // Validação de Dados
            if (empty($data) || empty($hora) || empty($local) || empty($tipo_esporte) || empty($faixa_etaria)) {
                throw new Exception("Todos os campos devem ser preenchidos.");
            }
            
            
            $sql = "INSERT INTO Evento (                   
                  data,hora,local,tipo_esporte,faixa_etaria, fk_colaborador_id)
                  VALUES (
                    '$data','$hora','$local','$tipo_esporte','$faixa_etaria','$sessao_id')";

            $this->connect->getConnection()->query($sql);

           
            
            
        } catch (Exception $e) {
            print "Erro ao Inserir Evento <br>" . $e . '<br>';
        }
    }


    //Metodo que realiza a validacao dos dados
    private function validaDados($data, $hora, $local, $tipo_esporte, $faixa_etaria){

    }
    // Metodo que realize a Sanitizacao dos dados
    private function sanitizeInput($input) {
        // Limpeza de entrada
        $input = trim($input);
        $input = htmlspecialchars($input);
    
        
    
        return $input;
    }

    function getId() {
        return $this->id;
    }

    function getData() {
        return $this->data;
    }

    function getHora() {
        return $this->hora;
    }

    function getLocal() {
        return $this->local;
    }

    function getTipo_esporte() {
        return $this->tipo_esporte;
    }

    function getFaixa_etaria() {
        return $this->faixa_etaria;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setData($data) {
        $this->data = $data;
    }

    function setHora($hora) {
        $this->hora = $hora;
    }

    function setLocal($local) {
        $this->local = $local;
    }

    function setTipo_esporte($tipo_esporte) {
        $this->tipo_esporte = $tipo_esporte;
    }

    function setFaixa_etaria($faixa_etaria) {
        $this->faixa_etaria = $faixa_etaria;
    }
    
    public function read($sessao_id) {
        try {
            $sql = "SELECT * FROM evento WHERE fk_colaborador_id = $sessao_id";
            $result = $this->connect->getConnection()->query($sql);
            
            $f_lista = array();
            while ($row = $result->fetch_assoc()) {
                $f_lista[] = $this->listaEventos($row);
            }
            unset($evento);
            return $f_lista;
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Buscar Todos." . $e;
        }
        header("Location: lista_evento.php");
    }
    private function listaEventos($row) {
        $evento = new Evento();
        $evento->setId($row['id']);
        $evento->setData($row['data']);
        $evento->setHora($row['hora']);
        $evento->setLocal($row['local']);
        $evento->setTipo_esporte($row['tipo_esporte']);
        $evento->setFaixa_etaria($row['faixa_etaria']);
    
        return $evento;
        header("Location: lista_evento.php");
    }

    public function update($data, $hora, $local, $tipo_esporte, $faixa_etaria, $sessao_id){
        $sql = "SELECT * FROM evento WHERE fk_colaborador_id = $sessao_id";
        $result = $this->connect->getConnection()->query($sql);
        
        if($result->num_rows > 0){
            $data = "UPDATE evento SET data = '$data' WHERE id = '$sessao_id'";
            $hora = "UPDATE evento SET hora = '$hora' WHERE id = '$sessao_id'";
            $local = "UPDATE evento SET local = '$local' WHERE id = '$sessao_id'";
            $tipo_esporte = "UPDATE evento SET tipo_esporte = '$tipo_esporte' WHERE id = '$sessao_id'";
            $faixa_etaria = "UPDATE evento SET faixa_etaria = '$faixa_etaria' WHERE id = '$sessao_id'";
            if($this->connect->getConnection()->query($data)=== TRUE){
                echo "Dados inseridos";
                }
            if($this->connect->getConnection()->query($hora)=== TRUE){
                echo "Dados inseridos";
                }
            if($this->connect->getConnection()->query($local)=== TRUE){
                echo "Dados inseridos";
                }
            if($this->connect->getConnection()->query($tipo_esporte)=== TRUE){
                echo "Dados inseridos";
                }
            if($this->connect->getConnection()->query($faixa_etaria)=== TRUE){
                echo "Dados inseridos";
                }
        
            }else{
                echo "Evento não cadastrado!!";
            }
    }
    public function delete($evento, $sessao_id){
        $sql = "SELECT id FROM evento WHERE fk_colaborador_id = $sessao_id";

 

        $result = $this->connect->getConnection()->query($sql);

 

        if($result->num_rows > 0){
            $delete = "DELETE FROM evento WHERE id = '$evento' AND fk_colaborador_id = '$sessao_id'";
            if($this->connect->getConnection()->query($delete) === TRUE){
                echo "Dados Deletados com Sucesso";
                
            }else
            echo "evento nao Encontrado!";
        }
    }

    
    function __destruct(){
        $this->connect->closeConnection();

    }
}
?>

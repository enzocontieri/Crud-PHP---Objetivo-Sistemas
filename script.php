<?php 

class Cliente {
    private $conn;

    public function __construct() {
        $this->conn = new mysqli("localhost", "root", "", "clientes");
    }   

    public function salvarCliente() {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["action"]) && $_POST["action"] === "cadastrar") {
            $nome = $_POST["nome"];
            $telefone = $_POST["telefone"];
            $observacao = $_POST["observacao"];
            $sql = "INSERT INTO cliente (nome, telefone, observacao) VALUES ('$nome', '$telefone', '$observacao')";
            $res = $this->conn->query($sql);
            
            if ($res === true) {
                $id_cliente = $this->conn->insert_id;
                echo "<script>alert('Cadastro com sucesso. ID do cliente: $id_cliente');</script>";
            }
        }
    }

    public function listarClientes() {
        $dados = array();

        $sql = "SELECT * FROM cliente";
        $res = $this->conn->query($sql);

        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                $dados[] = array(
                    'nome' => $row['nome'],
                    'telefone' => $row['telefone'],
                    'data_cadastro' => $row['data_cadastro']
                );
            }
        }

        return $dados;
    }


        public function editarCliente($id_cliente, $nome, $telefone, $observacao) {
            $sql = "UPDATE cliente SET nome='$nome', telefone='$telefone', observacao='$observacao' WHERE id_cliente=$id_cliente";
            $res = $this->conn->query($sql);
    
            if ($res === true) {
                echo "<script>alert('Cliente editado com sucesso.');</script>";
            } else {
                echo "<script>alert('Não foi possível editar o cliente');</script>";
            }
        }
    
        public function excluirCliente($id_cliente) {
            $sql = "DELETE FROM cliente WHERE id_cliente=$id_cliente";
            $res = $this->conn->query($sql);
    
            if ($res === true) {
                echo "<script>alert('Cliente excluído com sucesso.');</script>";
            } else {
                echo "<script>alert('Não foi possível excluir o cliente');</script>";
            }
        }
    }

    class id_cliente_telefone extends Cliente{
        public function idTelefone($telefone) {
            $telid = array();
    
            $sql = "SELECT * FROM cliente WHERE telefone='$telefone'";
            $res = $this->conn->query($sql);
        }
    }
?>

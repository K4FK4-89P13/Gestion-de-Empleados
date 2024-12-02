<?php
class LoginController extends Controller {
    public function index() {
        if( isset($_SESSION['usuario']) ) {
            $this->load_view('admin/home');
        }else{
            $this->load_view('login/login');
        }
    }
    public function authUsuario() {
        try{
            $data = json_decode( file_get_contents('php://input'), true );
            $adminModel = $this->load_model('Admin');
            $resultado = $adminModel->validacion($data);
            //echo $resultado;
            if( !isset($resultado['getAdmin']) ) {
                throw new Exception($resultado['error']);
                
            }
            $_SESSION['usuario'] = $resultado['getAdmin']['nombres'];
            echo json_encode(['message' => $resultado]);
        }catch(Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function logout() {
        session_destroy();
        header("Location: " . BASE_URL);
    }
}
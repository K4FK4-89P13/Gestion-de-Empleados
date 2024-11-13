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
        $data = json_decode( file_get_contents('php://input'), true );
        if( $data ){
            $adminModel = $this->load_model('Admin');
            $resultado = $adminModel->validacion($data);
            if($resultado) $_SESSION['usuario'] = $resultado['nombres'];
            echo json_encode(['message' => $resultado]);
        }else{
            echo json_encode(['message' => 'Datos incompletos']);
        }
    }

    public function logout() {
        session_destroy();
        header("Location: " . BASE_URL);
    }
}
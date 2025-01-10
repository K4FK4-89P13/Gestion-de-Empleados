<?php
class LoginController extends Controller {
    public function index() {
        $rol = $_SESSION['datosUser']['rol'] ?? null;

        if( $rol == 'Administrador' ) {
            //$this->load_view('admin/home');
            header("Location: " . BASE_URL . "/admin");
        }else if( $rol == 'Personal' ){
            //$this->load_view('personal/home');
            header("Location: " . BASE_URL . '/personal');
        }else {
            $this->load_view('login/login');
        }
    }
    public function authUsuario() {
        try{
            $data = json_decode( file_get_contents('php://input'), true );

            $adminModel = $this->load_model('Admin');
            $admin = $adminModel->validacion($data);

            $personalModel = $this->load_model('Personal');
            $personal = $personalModel->validacion($data);

            $datos = null;

            if( isset($admin['admin']) ) {
                $datos = $admin['admin'];
            }else if( isset($personal['personal']) ) {
                $datos = $personal['personal'];
            }else{
                throw new Exception('Usuario no registrado');
            }

            $_SESSION['datosUser'] = $datos;

            echo json_encode(['datos' => $datos]);
        }catch(Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function logout() {
        session_destroy();
        header("Location: " . BASE_URL);
    }
}
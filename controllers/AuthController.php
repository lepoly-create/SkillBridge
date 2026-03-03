<?php
require_once __DIR__ . '/../models/User.php';

class AuthController {
    public function login() {
        // Afficher formulaire de connexion
        require __DIR__ . '/../views/auth/login.php';
    }

    public function doLogin() {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $userModel = new User();
            $user = $userModel->findByEmail($email);

            if ($user && password_verify($password, $user['mot_de_passe'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_nom'] = $user['nom'];
                header('Location: ' . url('home'));
                exit;
            } else {
                $error = "Email ou mot de passe incorrect";
                require __DIR__ . '/../views/auth/login.php';
            }
        }
    }

    public function register() {
        require __DIR__ . '/../views/auth/register.php';
    }

    public function doRegister() {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $ville = $_POST['ville'] ?? '';

            $userModel = new User();
            if ($userModel->findByEmail($email)) {
                $error = "Cet email est déjà utilisé";
                require __DIR__ . '/../views/auth/register.php';
                return;
            }

            if ($userModel->create($nom, $email, $password, $ville)) {
                header('Location: ' . url('login'));
                exit;
            } else {
                $error = "Erreur lors de l'inscription";
                require __DIR__ . '/../views/auth/register.php';
            }
        }
    }

    public function logout() {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        session_destroy();
        header('Location: ' . url());
        exit;
    }
}
?>
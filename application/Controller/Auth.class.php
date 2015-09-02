<?php

class Controller_Auth extends Controller
{
    public function login()
    {
        if ($_POST) {
            $result = false;

            try {
                $result = User::login($_POST['username'], $_POST['password'], $_POST['auth-token']);
            } catch (Exception $e) {
                if (strpos($e->getMessage(), 'Invalid login credentials provided.') !== false) {
                    $this->error('Authentication Failed', 'Your username, password, or authentication token were incorrect. Please check your inputs and try again.');
                } else {
                    throw $e;
                }
            }


            if ($result == true) {
                $this->bounce();
            }
        }
    }

    public function logout()
    {
        $user = self::getActiveUser();
        if ($user instanceof User) {
            $user->logout();
        }

        $this->redirect(ROOT_URI);
    }

}
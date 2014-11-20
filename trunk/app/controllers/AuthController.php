<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class AuthController extends BaseController {

    public function __construct($registry) {
        parent::__construct($registry);
    }

    public function index() {
        $this->view->load('admin/login');
    }

    public function login() {

        if (isset($_POST['user'])) {
			//untuk mencatat log user
			$d_log = new DataLog($this->registry);
			$d_log->set_activity_time_start(date("d-m-Y h:i:s"));
            $user = $_POST['user'];
            $pass = hash('sha256',$_POST['pass']);
            //var_dump($_POST['user']);
            //var_dump($_POST['pass']);
            $pwd = $pass;
            $cuser = new User($this->registry);
            $res = $cuser->login($user, $pwd);
            //var_dump($res);
            switch ($res[1]) {
                case 1:
                    $role = 'admin';
                    break;
                case 2:
                    $role = 'satker';
                    break;
                case 3:
                    $role = 'kppn';
                    break;
                case 4:
                    $role = 'pkn';
                    break;
                case 5:
                    $role = 'kanwil';
                    break;
                case 6:
                    $role = 'dja';
                    break;
                case 7:
                    $role = 'blu';
                    break;
                default:
                    $role = 'guest';
            }

            if ((int) $res[0] == 1) {
                Session::createSession();
                Session::set('loggedin', TRUE);
                Session::set('user', $res[2]);
                Session::set('role', $role);
                Session::set('id_user', $res[3]);
                Session::set('kd_satker', $res[4]);
				$d_log->tambah_log("Sukses");
                header('location:' . URL);
            } else if ((int) $res[0] == 0) {
                $this->view->error = "user tidak ditemukan!";
				$d_log->tambah_log("Sukses");
                $this->view->load('admin/login');
            } else {
                $this->view->error = "database tidak valid!";
				$d_log->tambah_log("Sukses");
                $this->view->load('admin/login');
            }
        } else {
			//untuk mencatat log user
			$d_log = new DataLog($this->registry);
			$d_log->set_activity_time_start(date("d-m-Y h:i:s"));
            $this->view->load('admin/login');
			$d_log->tambah_log("Sukses");
        }
    }

    public function logout() {
		$d_log = new DataLog($this->registry);
		$d_log->set_activity_time_start(date("d-m-Y h:i:s"));
		$d_log->tambah_log("Sukses");
        Session::createSession();
        Session::destroySession();
        Session::unsetAll();
		//untuk mencatat log user
        $this->view->load('admin/login');
    }

    public function __destruct() {
        parent::__destruct();
    }

}

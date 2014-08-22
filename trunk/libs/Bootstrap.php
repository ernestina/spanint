<?php

class Bootstrap {

    private $registry;
    private $controller;
    private $method;
    private $param;
    private $file;
    private $role;
    private $url = array();

    public function __construct($registry) {
        $this->registry = $registry;
        Session::createSession();
        $logged = Session::get('loggedin');
        $this->role = ($logged) ? (Session::get('role') == ADMIN ? 'admin' : (Session::get('role') == KPPN ? 'kppn' : (Session::get('role') == PKN ? 'pkn' : (Session::get('role') == KANWIL ? 'kanwil' : (Session::get('role') == DJA ? 'dja' : (Session::get('role') == SATKER ? 'satker' : 'guest')))))) : 'guest';
    }

    /*
     * mendapatkan url dan pembuatan objek controller 
     */

    public function getController() {
        $page = ($_GET['page']) ? $_GET['page'] : 'index';
        $page = rtrim($page, '/');
        $this->url = explode('/', $page);
        if (isset($this->url[0])) {
            $this->file = ROOT . '/app/controllers/' . ucfirst($this->url[0]) . 'Controller.php';
            if (is_readable($this->file)) {
                $name = ucfirst($this->url[0]) . 'Controller';
                $this->controller = new $name($this->registry);
            } else {
                $this->controller = new Index($this->registry);
            }
        }
    }

    /*
     * cek method di controller
     */

    private function getAction() {
        if (isset($this->url[1])) {
            if (method_exists($this->controller, $this->url[1])) {
                $this->method = $this->url[1];
            } else {
                $this->method = 'index';
            }
        } else {
            $this->method = 'index';
        }
    }

    /*
     * loader url
     */

    public function loader() {

        /*         * * check the route ** */
        $this->getController();

        $this->getAction();

        $loggedin = $this->cek_session();
        if ((!$loggedin && !($this->controller instanceof AuthController) && $this->method != 'index')) {
            Session::createSession();
            Session::destroySession();
            Session::unsetAll();
            $this->controller = new AuthController($this->registry);
            $this->method = 'index';
        }
        //echo $this->role.",".$this->url[0].",".$this->method;
        //var_dump($this->registry->auth->is_allowed($this->role,$this->url[0],$this->method));

        if (!$this->registry->auth->is_allowed($this->role, $this->url[0], $this->method) && $this->role != 'guest') {
            $this->controller = new Index($this->registry);
            $this->method = 'index';
        } else if (!$this->registry->auth->is_allowed($this->role, $this->url[0], $this->method) && $this->role == 'guest') {
            $this->controller = new AuthController($this->registry);
            $this->method = 'index';
        }

        /*         * * check if the action is callable ** */
        if (is_callable(array($this->controller, $this->method)) == false) {
            $action = 'index';
        } else {
            $action = $this->method;
        }

        /*         * * load arguments for action ** */
        $arguments = array();
        $i = 0;

        foreach ($this->url as $key => $val) {
            if ($i > 1) {
                $arguments[] = $val;
            }
            $i++;
        }

        $_POST = $this->clean_input_data($_POST);
        $_GET = $this->clean_input_data($_GET);
        $_REQUEST = $this->clean_input_data($_REQUEST);

        $arguments = $this->clean_input_data($arguments);

        Session::sessionUpdated();
        if ($i > 1)
            call_user_func_array(array($this->controller, $action), $arguments);
        else
            call_user_func(array($this->controller, $action), $arguments);
    }

    private function cek_session() {
        @Session::createSession();
        if (isset($_SESSION) && Session::get('loggedin') == TRUE && Session::get('user') != '' && Session::get('role') != '') {
            $now = date('Y-m-d H:i:s');
            $upd = Session::get('updated');
            $diff = strtotime($now) - strtotime($upd); //echo $diff;
            if ($diff < MAX_SESSION)
                return true;
            //return true;
        }
        return false;
    }

    public function get_controller() {
        return $this->controller;
    }

    public function get_method() {
        return $this->controller;
    }

    public function __destruct() {
        ;
    }

    /**
     * Clean Input Data
     *
     * Taken from commit db4f429fdbc3e3cdca53f5d9ab1daf5811c5ac19
     * Not implemented (yet ?), these should be handled by application's logic:
     *  - clean input keys
     *  - clean UTF-8 characters
     *  - clean control characters
     *  - standardize newlines
     *
     * @access	private
     * @param	string
     * @return	string
     * */
    private function clean_input_data($str) {

        if (is_array($str)) {
            $new_array = array();
            foreach ($str as $key => $val) {
                $new_array[$key] = $this->clean_input_data($val);
            }
            return $new_array;
        }

        /**
         * Use rawurldecode() so it does not remove plus signs
         * URL Decode, Just in case stuff like this is submitted:
         *
         * <a href="http://%77%77%77%2E%67%6F%6F%67%6C%65%2E%63%6F%6D">Google</a>
         * * */
        $str = rawurldecode($str);

        // quote string with slashes
        // ie. single quote, double quote, backslash, and NULL
        $str = addslashes($str);
        // strip HTML and PHP tags from a string
        $str = strip_tags($str);

        // escape string, specific to oracle database
        $str = $this->oci_escape_string($str);

        return $str;
    }

    /**
     * Remove Invisible Characters
     *
     * This prevents sandwiching null characters
     * between ascii characters, like Java\0script.
     *
     * @access	private
     * @param	string
     * @return	string
     * */
    private function remove_invisible_characters($str, $url_encoded = TRUE) {

        $non_displayables = array();

        // every control character except newline (dec 10)
        // carriage return (dec 13), and horizontal tab (dec 09)

        if ($url_encoded) {
            $non_displayables[] = '/%0[0-8bcef]/'; // url encoded 00-08, 11, 12, 14, 15
            $non_displayables[] = '/%1[0-9a-f]/'; // url encoded 16-31
        }

        // 00-08, 11, 12, 14-31, 127		
        $non_displayables[] = '/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]+/S';

        do {
            $str = preg_replace($non_displayables, '', $str, -1, $count);
        } while ($count);

        return $str;
    }

    /**
     * Escape String
     *
     * @access  private
     * @param   string
     * @param	bool	whether or not the string will be used in a LIKE condition
     * @link    http://stackoverflow.com/a/4949307/82126
     * @link    https://github.com/doctrine/dbal/pull/438
     * @return  string
     * */
    private function oci_escape_string($str, $like = TRUE) {

        if (is_array($str)) {
            foreach ($str as $key => $val) {
                $str[$key] = $this->oci_escape_string($val, $like);
            }
            return $str;
        }

        $str = $this->remove_invisible_characters($str);

        // rollback addslashes
        $str = str_replace('\\\'', '\'', $str);
        // escape "'"	
        $str = strtr($str, array("'" => "''"));
        $str = addcslashes($str, "\000\n\r\032");

        if ($like) {
            
        }


        return $str;
    }

}

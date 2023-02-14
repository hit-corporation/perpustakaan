<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{

    protected $data;

    public function __construct()
    {
        parent::__construct();

        // if (!isset($_SESSION['userdata']))
        //     redirect(base_url('login'));

        $this->template->registerFunction('base_url', function () {
            return base_url();
        });
        $this->template->registerFunction('html_escape', function ($args) {
            return html_escape($args);
        });
    }
}

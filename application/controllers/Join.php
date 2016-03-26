<?php if(! defined('BASE_PATH') ) exit('No direct script access allowed');

class Join extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    { 
        $this->output->view('join_us');
    }
}
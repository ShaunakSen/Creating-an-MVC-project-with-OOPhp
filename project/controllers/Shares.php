<?php

class Shares extends Controller
{
    protected function index()
    {
        $viewmodel = new ShareModel;
        $this->returnView($viewmodel->index(),true);
    }
    protected function add()
    {
        if(!isset($_SESSION['is_logged_in'])){
            header('Location: '. ROOT_URL . 'Shares');
        }
        $viewmodel = new ShareModel;
        $this->returnView($viewmodel->add(),true);
    }
}

?>
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
        $viewmodel = new ShareModel;
        $this->returnView($viewmodel->add(),true);
    }
}

?>
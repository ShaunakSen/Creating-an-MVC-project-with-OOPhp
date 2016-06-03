<?php

class Shares extends Controller
{
    protected function index()
    {
        $viewmodel = new ShareModel;
        $this->returnView($viewmodel->index(),true);
    }
}

?>
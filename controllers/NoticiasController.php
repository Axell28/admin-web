<?php 

class Noticias extends Controller {

    public $model;
    public $nameView;

    public function __construct()
    {
        $this->nameView = strtolower(get_class($this));
    }

    public function index()
    {
        parent::renderView($this->nameView);
    }

}
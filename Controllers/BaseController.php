<?php 

class BaseController
{
    // Render a view
    public function render($view, $data = [])
    {
        
        extract($data);
        include __DIR__ . '/../views/' . $view . '.php';
        exit();
    }
   
}

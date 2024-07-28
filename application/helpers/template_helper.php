<?php
class template_fn{
    private $ci;
    function __construct()
    {
        $this->ci =&get_instance();
        date_default_timezone_set("Asia/Bangkok");
    }

    function templatefn()
    {
        return $this->ci;
    }
}


function tempfn()
{
    $obj = new template_fn();
    return $obj->templatefn();
}


function getHead()
{
    return tempfn()->load->view("templates/head");
}
function getFooter()
{
    return tempfn()->load->view("templates/footer");
}
function getContent($page , $data)
{
    return tempfn()->load->view($page , $data);
}
function getModal($modal)
{
    return tempfn()->load->view($modal);
}




?>
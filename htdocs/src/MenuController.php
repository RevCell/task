<?php
class MenuController
{
    private $gateway;

    public function __construct(MenuGateway $gateway)
    {
        $this->gateway=$gateway;
    }
    public function process($method,$id)
    {
        $this->menu_collection($method);
    }

    private function menu_collection($method): void
    {
        if ($method=='GET'){
            echo json_encode($this->gateway->GetAll($data=0));
        }
    }
}
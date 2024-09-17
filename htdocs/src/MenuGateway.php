<?php

class MenuGateway
{
    private PDO $conn;

    public function __construct(DataBase $database)
    {
        $this->conn=$database->connection();
    }
    function GetAll($data): array
    {
        $sql="SELECT * FROM tasks WHERE parent_id=$data";
        $statement=$this->conn->query($sql);
        $children=[];
        $count = 0;
        foreach ($statement as $key => $value) {
            $children[$count]['id']=$value['id'];
            $children[$count]['name'] = $value['name'];
            $children[$count]['children'] =$this->GetAll($value['id']);
            $count++;
        }
        return $children;
    }
}

<?php
session_start();


abstract class DBAbstractModel
{




    private static $db_host = "";
    private static $db_user = "";
    private static $db_pass = "";


    protected $db_name;

    protected $query;

    protected $rows = array();

    protected $conn;

    abstract protected function selectAll();
    abstract protected function select();
    abstract protected function insert();
    abstract protected function update();
    abstract protected function delete();





    private function open_connection()
    {

        require("config.php");

        $db = $config["db"];
        self::$db_host = $db["server"];
        self::$db_user = $db["username"];
        self::$db_pass = $db["password"];
        $this->db_name = $db["db"];
        $this->conn = new mysqli(self::$db_host, self::$db_user, self::$db_pass, $this->db_name);
    }

    private function close_connection()
    {
        $this->conn->close();
    }

    protected function execute_single_query()
    {
        $this->open_connection();
        $succes = 0;
        if ($result =  $this->conn->query($this->query)) {
            $succes = 1;
        } else {
            $succes = 0;
        }
        $this->close_connection();
        return $succes;
    }

    protected function get_results_from_query()
    {
        $this->open_connection();
        $result = $this->conn->query($this->query);
        for ($i = 0; $i < $result->num_rows; $i++)
            $this->rows[$i] = $result->fetch_assoc();
        $result->close();
        $this->close_connection();
    }
}

?>
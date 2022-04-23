<?php
    class DB
    {
        function __construct() {
            $this->dsn  =null;
            $this->user =null;
            $this->password='';
            $this->dbh = null;
            $this->stmt = null;
        }

        public function connectDB()
        {
            $this->dsn  = 'mysql:dbname=shop;host=localhost;charset=utf8';
            $this->user = 'root';
            $this->dbh  = new PDO($this->dsn,$this->user,$this->password);
            $this->dbh -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }

        public function disconnectDB()
        {
            $this->dbh  =null;
        }

        public function actSql($sql,$data)
        {
            $this->stmt = $this->dbh -> prepare($sql);
            $this->stmt -> execute();
            if (is_null($data)) {$this->stmt -> execute();}
            else{$this->$stmt -> execute($data);}
        }

        public function getResult()
        {
            return $this->stmt->fetch(PDO::FETCH_ASSOC);
        }
    }

?>
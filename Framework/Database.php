<?php 

    namespace Framework;

    use Exception;
    use PDO, PDOException, PDOStatement;

    class Database {
        public $connection;

        /**
         * Constructor for Database class
         * 
         * @param array $config
         */
        public function __construct($config) {
            $dsn = "pgsql:host={$config['host']};port={$config['port']};dbname={$config['dbname']}";

            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
            ];

            try {
                $this->connection = new PDO($dsn, $config['username'], $config['password'], $options);
            } catch (PDOException $e) {
                throw new PDOException("Database connection failed: {$e->getMessage()}");
            }
        }

        /**
         * Query database
         * 
         * @param string $query
         * @param array $params
         * @return PDOStatement
         * @throws PDOException
         */
        public function query($query, $params = []) {
            try {
                $sth = $this->connection->prepare($query);
                
                foreach($params as $param => $value) {
                    $sth->bindValue(':' . $param, $value);
                }

                $sth->execute();
                
                return $sth;
            } catch (PDOException $e) {
                throw new Exception("Query failed to execute: {$e->getMessage()}");
            }
        }
    }
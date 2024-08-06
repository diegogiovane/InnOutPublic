<?php
    class Model {
        protected static $tableName = '';
        protected static $columns = [];
        protected $values = [];

        private static function getColumns($columns) {
            if ($columns === '*') {
                $sql = "SHOW COLUMNS FROM " . static::$tableName . ";";
                $result = Database::getResultFromQuery($sql);
                $columns = "";
            
                while($row = $result->fetch_assoc()) {
                    if($columns != "") {
                        $columns .= ", ";
                    }

                    $columns .= $row["Field"];
                }
            }

            return $columns;
        }

        private static function getFormatedValue($value) {
            if(is_null($value)) {
                return "null";
            } elseif(gettype($value) === 'string') {
                return "'$value'";
            } else {
                return $value;
            }
        }

        private static function getFilters($filters) {
            $filter = "";

            if (count($filters) > 0) {
                $filter = " WHERE 1 = 1";

                foreach($filters as $column => $value) {
                    $filter .= " AND $column = " . static::getFormatedValue($value);
                }
            }

            return $filter;
        }

        function __construct($arr) {
            $this->loadFromArray($arr);
        }

        public function loadFromArray($arr) {
            if ($arr) {
                foreach($arr as $key => $value) {
                    $this->$key = $value;
                }
            }
        }

        public function __get($key) {
            return $this->values[$key];
        }

        public function __set($key, $value) {
            $this->values[$key] = $value;
        }

        public static function getResultSetFromSelect($filters = [], $columns = '*') {
                 
            $sql = "SELECT " . static::getColumns($columns) . " FROM " . static::$tableName . static::getFilters($filters) . ";";
            $result = Database::getResultFromQuery($sql);

            if($result->num_rows === 0) {
                return null;
            }

            return $result;
        }

        public static function get($filters = [], $columns = '*') {
            $objects = [];
            $columns = static::getColumns($columns);
            $result = static::getResultSetFromSelect($filters, $columns);

            if($result) {
                $class = get_called_class();

                while($row = $result->fetch_assoc()) {
                    array_push($objects, new $class($row));
                }
            }

            return $objects;
        }

        public static function getOne($filters = [], $columns = '*') {
            $columns = static::getColumns($columns);
            $result = static::getResultSetFromSelect($filters, $columns);
            $class = get_called_class();

            return $result ? new $class($result->fetch_assoc()) : null;
        }

        public static function save() {
            $columns = implode(",",static::$columns);

            $sql = "";
            $sql = "INSERT INTO " . static::$tableName . " (" . $columns . ") VALUES (";

            foreach(static::$columns as $col) {
                $sql .= static::getFormatedValue($this->$col) . ",";
            }

            $sql[strlen($sql) - 1] = ")";
            
            $id = Database::executeSQL($sql);
            $this->id = $id;
        }
    }
?>
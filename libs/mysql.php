<?php
interface DatabaseInterface {
    public function getSql($name);
    public function connect($hostname,$username,$password,$database,$port,$socket,$charset);
    public function query($sql,$params=array());
    public function fetchAssoc($result);
    public function fetchRow($result);
    public function insertId($result);
    public function affectedRows($result);
    public function close($result);
    public function fetchFields($table);
    public function addLimitToSql($sql,$limit,$offset);
    public function likeEscape($string);
    public function isNumericType($field);
    public function isBinaryType($field);
    public function isGeometryType($field);
    public function isJsonType($field);
    public function getDefaultCharset();
    public function beginTransaction();
    public function commitTransaction();
    public function rollbackTransaction();
    public function jsonEncode($object);
    public function jsonDecode($string);
}
class MySQL implements DatabaseInterface {
    protected $db;
    protected $queries;
    public function __construct() {
        $this->queries = array(
            'list_tables'=>'SELECT
					"TABLE_NAME","TABLE_COMMENT"
				FROM
					"INFORMATION_SCHEMA"."TABLES"
				WHERE
					"TABLE_SCHEMA" = ?',
            'reflect_table'=>'SELECT
					"TABLE_NAME"
				FROM
					"INFORMATION_SCHEMA"."TABLES"
				WHERE
					"TABLE_NAME" COLLATE \'utf8_bin\' = ? AND
					"TABLE_SCHEMA" = ?',
            'reflect_pk'=>'SELECT
					"COLUMN_NAME"
				FROM
					"INFORMATION_SCHEMA"."COLUMNS"
				WHERE
					"COLUMN_KEY" = \'PRI\' AND
					"TABLE_NAME" = ? AND
					"TABLE_SCHEMA" = ?',
            'reflect_belongs_to'=>'SELECT
					"TABLE_NAME","COLUMN_NAME",
					"REFERENCED_TABLE_NAME","REFERENCED_COLUMN_NAME"
				FROM
					"INFORMATION_SCHEMA"."KEY_COLUMN_USAGE"
				WHERE
					"TABLE_NAME" COLLATE \'utf8_bin\' = ? AND
					"REFERENCED_TABLE_NAME" COLLATE \'utf8_bin\' IN ? AND
					"TABLE_SCHEMA" = ? AND
					"REFERENCED_TABLE_SCHEMA" = ?',
            'reflect_has_many'=>'SELECT
					"TABLE_NAME","COLUMN_NAME",
					"REFERENCED_TABLE_NAME","REFERENCED_COLUMN_NAME"
				FROM
					"INFORMATION_SCHEMA"."KEY_COLUMN_USAGE"
				WHERE
					"TABLE_NAME" COLLATE \'utf8_bin\' IN ? AND
					"REFERENCED_TABLE_NAME" COLLATE \'utf8_bin\' = ? AND
					"TABLE_SCHEMA" = ? AND
					"REFERENCED_TABLE_SCHEMA" = ?',
            'reflect_habtm'=>'SELECT
					k1."TABLE_NAME", k1."COLUMN_NAME",
					k1."REFERENCED_TABLE_NAME", k1."REFERENCED_COLUMN_NAME",
					k2."TABLE_NAME", k2."COLUMN_NAME",
					k2."REFERENCED_TABLE_NAME", k2."REFERENCED_COLUMN_NAME"
				FROM
					"INFORMATION_SCHEMA"."KEY_COLUMN_USAGE" k1,
					"INFORMATION_SCHEMA"."KEY_COLUMN_USAGE" k2
				WHERE
					k1."TABLE_SCHEMA" = ? AND
					k2."TABLE_SCHEMA" = ? AND
					k1."REFERENCED_TABLE_SCHEMA" = ? AND
					k2."REFERENCED_TABLE_SCHEMA" = ? AND
					k1."TABLE_NAME" COLLATE \'utf8_bin\' = k2."TABLE_NAME" COLLATE \'utf8_bin\' AND
					k1."REFERENCED_TABLE_NAME" COLLATE \'utf8_bin\' = ? AND
					k2."REFERENCED_TABLE_NAME" COLLATE \'utf8_bin\' IN ?',
            'reflect_columns'=> 'SELECT
					"COLUMN_NAME", "COLUMN_DEFAULT", "IS_NULLABLE", "DATA_TYPE", "CHARACTER_MAXIMUM_LENGTH"
				FROM 
					"INFORMATION_SCHEMA"."COLUMNS" 
				WHERE 
					"TABLE_NAME" = ? AND
					"TABLE_SCHEMA" = ?
				ORDER BY
					"ORDINAL_POSITION"'
        );
    }
    public function getSql($name) {
        return isset($this->queries[$name])?$this->queries[$name]:false;
    }
    public function connect($hostname,$username,$password,$database,$port,$socket,$charset) {
        $db = mysqli_init();
        if (defined('MYSQLI_OPT_INT_AND_FLOAT_NATIVE')) {
            mysqli_options($db,MYSQLI_OPT_INT_AND_FLOAT_NATIVE,true);
        }
        $success = mysqli_real_connect($db,$hostname,$username,$password,$database,$port,$socket,MYSQLI_CLIENT_FOUND_ROWS);
        if (!$success) {
            throw new \Exception('Connect failed. '.mysqli_connect_error());
        }
        if (!mysqli_set_charset($db,$charset)) {
            throw new \Exception('Error setting charset. '.mysqli_error($db));
        }
        if (!mysqli_query($db,'SET SESSION sql_mode = \'ANSI_QUOTES\';')) {
            throw new \Exception('Error setting ANSI quotes. '.mysqli_error($db));
        }
        $this->db = $db;
    }
    public function query($sql,$params=array()) {
        $db = $this->db;
        $sql = preg_replace_callback('/\!|\?/', function ($matches) use (&$db,&$params) {
            $param = array_shift($params);
            if ($matches[0]=='!') {
                $key = preg_replace('/[^a-zA-Z0-9\-_=<> ]/','',is_object($param)?$param->key:$param);
                if (is_object($param) && $param->type=='hex') {
                    return "HEX(\"$key\") as \"$key\"";
                }
                if (is_object($param) && $param->type=='wkt') {
                    return "ST_AsText(\"$key\") as \"$key\"";
                }
                return '"'.$key.'"';
            } else {
                if (is_array($param)) return '('.implode(',',array_map(function($v) use (&$db) {
                        return "'".mysqli_real_escape_string($db,$v)."'";
                    },$param)).')';
                if (is_object($param) && $param->type=='hex') {
                    return "x'".$param->value."'";
                }
                if (is_object($param) && $param->type=='wkt') {
                    return "ST_GeomFromText('".mysqli_real_escape_string($db,$param->value)."')";
                }
                if ($param===null) return 'NULL';
                return "'".mysqli_real_escape_string($db,$param)."'";
            }
        }, $sql);
        return mysqli_query($db,$sql);
    }
    public function fetchAssoc($result) {
        return mysqli_fetch_assoc($result);
    }
    public function fetchRow($result) {
        return mysqli_fetch_row($result);
    }
    public function insertId($result) {
        return mysqli_insert_id($this->db);
    }
    public function affectedRows($result) {
        return mysqli_affected_rows($this->db);
    }
    public function close($result) {
        return mysqli_free_result($result);
    }
    public function fetchFields($table) {
        $result = $this->query('SELECT * FROM ! WHERE 1=2;',array($table));
        return mysqli_fetch_fields($result);
    }
    public function addLimitToSql($sql,$limit,$offset) {
        return "$sql LIMIT $limit OFFSET $offset";
    }
    public function likeEscape($string) {
        return addcslashes($string,'%_');
    }
    public function convertFilter($field, $comparator, $value) {
        return false;
    }
    public function isNumericType($field) {
        return in_array($field->type,array(1,2,3,4,5,6,8,9));
    }
    public function isBinaryType($field) {
        //echo "$field->name: $field->type ($field->flags)\n";
        return (($field->flags & 128) && (($field->type>=249 && $field->type<=252) || ($field->type>=253 && $field->type<=254 && $field->charsetnr==63)));
    }
    public function isGeometryType($field) {
        return ($field->type==255);
    }
    public function isJsonType($field) {
        return ($field->type==245);
    }
    public function getDefaultCharset() {
        return 'utf8';
    }
    public function beginTransaction() {
        mysqli_query($this->db,'BEGIN');
    }
    public function commitTransaction() {
        mysqli_query($this->db,'COMMIT');
    }
    public function rollbackTransaction() {
        mysqli_query($this->db,'ROLLBACK');
    }
    public function jsonEncode($object) {
        return json_encode($object);
    }
    public function jsonDecode($string) {
        return json_decode($string);
    }
}
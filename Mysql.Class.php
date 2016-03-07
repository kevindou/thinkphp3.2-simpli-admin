<?php
// 数据库配置信息
define("MBM_DB_HOST",		'localhost');
define("MBM_DB_PORT",		3306);
define("MBM_DB_USER",		'admin');
define("MBM_DB_PASSWORD",	'cind+dmn');
define("MBM_DB_NAME",		'gametrees_bmmigrant');

/**
 * 数据库操作类
 * @author gamestree
 */
class MysqlHelp
{
		
	public $conn;
	public $tconstract;
	public static $instance=null;
	
		
	private function __construct()
	{	
		$this->conn = mysql_connect(MBM_DB_HOST.':'.MBM_DB_PORT,MBM_DB_USER,MBM_DB_PASSWORD);
		if (!$this->conn)
		{
			
			$msg = "can't connect the database!";
			die($msg);
		}
			
		if(mysql_get_server_info() > '40')
		{
			$this->query("SET NAMES 'utf8'");
		}
		if (!mysql_select_db(MBM_DB_NAME,$this->conn))
		{
			trigger_error("An error occured while selecting database: ".mysql_error($this->conn), E_USER_ERROR);
			die ();
		}
	}
		
	public static function getInstance(){
        if(is_null(self::$instance)){
            self::$instance = new MysqlHelp;
        }
        return self::$instance;
    }	
		
		
	/**
	* Executes sql query
	*
	* @param str $aSql sql query
	*
	* @return bool
	*/
	function query($aSql)
	{	
		$this->mLinkKey=md5(MBM_DB_HOST.MBM_DB_NAME);
		/* if(!$this->conn)
		{
			$this->connect();
		} */
		if(DEBUG===2)
		{
			$t = Debug::m();
		}
		$rs = mysql_query($aSql, $this->conn);
		
		if (!$rs && mysql_errno() != 2013&&DEBUG)
		{
			Logger::getInstance()->error("sql错误源:",$sql.''.mysql_error);
			$error = '['.$aSql.']Error Message'.mysql_error();
				
			die($error."Fatal database error");
		}

		return $rs;
	}


	/**
	* Returns row of elements
	*
	* @param str $aSql sql query
	*
	* @return arr
	*/
	function getRow($aSql)
	{
		$out	= false;
		$r		= $this->query($aSql);
		if($this->getNumRows($r) > 0)
		{
			$out = mysql_fetch_assoc($r);	
		}
		return $out;
	}

	/**
	* Returns array of rows
	*
	* @param str $aSql sql query
	*
	* @return arr|FALSE
	*/
	function getAll($aSql)
	{
		$out = false;

		$r = $this->query($aSql);
		if($this->getNumRows($r) > 0)
		{
			$out = array();
			while($temp = mysql_fetch_assoc($r))
			{
				$out[] = $temp;
			}
			return $out;	
		}
	}
	
		/**-------add by gady 090310
	* Returns array of rows
	* @param str $aSql sql query
	* @param str $key 作为键的字段名
	* @return arr|FALSE
	*/
	function getAllByKey($aSql,$key = null)
	{
		$out = false;

		$r = $this->query($aSql);
		if($this->getNumRows($r) > 0)
		{
			$out = array();
			while($temp = mysql_fetch_assoc($r))
			{
				if($key)
					$out[$temp[$key]] = $temp;
				else 
					$out[] = $temp;
			}
			return $out;	
		}
	}
	

	
	/**
	* Returns recordset as associative array where the key is the first field
	*
	* @param str $aSql sql query
	*
	* @return arr
	*/

	function getCount($aSql)
	{
		$r=$this->getAll($aSql);
		return count($r);
	}

	function getAssoc($aSql)
	{
		$out = false;
		$r = $this->query($aSql);
		if($this->getNumRows($r))
		{
			$out = array();
			while ($temp = mysql_fetch_assoc($r))
			{
				$key = array_shift($temp);
				$out[$key][] = $temp;
			}
		}

		return $out;
	}

	/**
	* Returns recordset as associative array where the key is the first field
	*
	* @param str $aSql sql query
	*
	* @return arr
	*/
	function getKeyValue($aSql) 
	{
		$out = false;
		$r = $this->query($aSql);
		if($this->getNumRows($r) > 0)
		{
			$out = array();
			while ($temp = mysql_fetch_row($r))
			{
				$out[$temp[0]] = $temp[1];
			}
		}
		return $out;
	}

	/**
	* Returns only one element or false!
	*
	* @param str $aSql sql query
	*
	* @return string
	*/
	function getOne($aSql)
	{
		$ret = false;
		$r = $this->query($aSql);
		if($this->getNumRows($r) > 0)
		{
			$ret = mysql_result($r,0,0);	
		}
		return $ret;
	}

	/**
	* Returns true if at least 1 record exists
	*
	* @param str $aSql sql query
	*
	* @return bool
	*/
	function exists($tname,$condition="")
	{	
		if($condition)$condition=' where '.$condition;
		$aSql='select * from '.$tname.$condition;
		
		$r = $this->query($aSql);
		
		return $this->getNumRows($r);
	}
	
	/* 
	*	返回记录条数
	*
	*	@params	 sql  sql 语句
	*	@return  int  返回记录条数
	*/
	function tableExists($sql)
	{
		$r = $this->query($sql);
		return $this->getNumRows($r);
	}
	

	function getInsertId()
	{
		return mysql_insert_id($this->conn);
	}
	
	function getAffected()
	{
		return mysql_affected_rows($this->conn);
	}

	function getNumRows($rs)
	{
		return mysql_num_rows($rs);
	}

	/**
	* Returns found rows of previous DQL with SQL_CALC_FOUND_ROWS
	* Note: this SQL function is MySQL specific!
	*/
	function foundRows()
	{
		return (int)$this->getOne("SELECT FOUND_ROWS()");
	}

	/**
	* Close connection to database
	*
	* @param $aConnection connection
	*
	* return bool
	*/
	function close($aConn=null)
	{
		if(null==$aConn)
		{
			$aConn = $this->conn;
		}
		return mysql_close($aConn);
	}
	
	/*
	* get's ID from the string like "`id`='123'" or "id='123'" or "id=123" or "`id`=123" (123 in this case) or false
	*/
	function scanForId($str)
	{
		$id = false;
		if(preg_match("/.?id.?\s*=\s*'?(\d+)/", $str, $m))
		{
			$id = (int)$m[1];
		}

		return $id;
	}

	/* function describe($table = false)
	{
		if(!$table)
		{
			$table = $this->mTable;
		}
		
		return $this->getAll("DESC `".$table."`");
	} */

	function insert($tname,$sqlstr)
	{
		$retval = 0;
		$sql='DESCRIBE `'.$tname.'`;';
		$this->tconstract=$this->getAll($sql);
		
		$sql = "INSERT INTO `".$tname."` (";
		$fields='';
		foreach($sqlstr as $key=>$value)
		{
			if($fields!='')$fields.=',';
			$fields .= "`{$key}`";
		}
		
		$sql .=$fields;

		$sql .= ") VALUES (";
		$fields='';
		
		foreach($sqlstr as $key=>$value)
		{	
			if($fields!='')$fields.=',';
			$fields .= $this->recomp($key,$value);
		}
		$sql .=$fields;
		$sql .= ");";
			
		$this->query($sql);
		$retval = $this->getInsertId();
		$sqlstr['id'] = $retval;
		return $retval;
	}

	function replaceInto($tname,$sqlstr)
	{
		$retval = 0;
		$sql='DESCRIBE `'.$tname.'`;';
		$this->tconstract=$this->getAll($sql);
		

		$sql = "REPLACE INTO `".$tname."` (";
		$fields='';
		foreach($sqlstr as $key=>$value)
		{
			if($fields!='')$fields.=',';
			$fields .= "`{$key}`";
		}
		$sql .=$fields;

		$sql .= ") VALUES (";
		$fields='';

		foreach($sqlstr as $key=>$value)
		{	
			if($fields!='')$fields.=',';
			$fields .= $this->recomp($key,$value);

		}
		$sql .=$fields;
		$sql .= ")";

		$this->query($sql);
		$retval = $this->getInsertId();
		$sqlstr['id'] = $retval;
		return $retval;
	}
	
	function update($tname,$sqlstr,$condition=null)
	{
		$sql='DESCRIBE `'.$tname.'`;';
		$this->tconstract=$this->getAll($sql);
		
		$sql = "UPDATE `".$tname."` SET ";
		$fields='';
		foreach($sqlstr as $key=>$value)
		{	
			if($fields!='')$fields.=',';
			$fields .= '`'.trim($key)."`=".$this->recomp($key,$value);
		}
		
		$sql .=$fields;
		if($condition)$sql .= " WHERE ".$condition;

		return $this->query($sql);
	
	}
	
	
	function updateone($tname,$field,$conditions,$num='+1')
	{
		$conditions[$field]=$field.$num;
		$this->update($tname,$conditions);
		return true;
	}

	function dele($tname,$where)
	{

		$sql="delete from ".$tname." ".$where;
		return $this->query($sql);
	}


	function recomp($key,$value)
	{

		for($i=0;$i < count($this->tconstract);$i++)
		{
			if($this->tconstract[$i]['Field']== $key)
			{
				if(substr_count($this->tconstract[$i]['Type'],'int')==0&&substr_count($this->tconstract[$i]['Type'],'boolean')==0&&substr_count($this->tconstract[$i]['Type'],'float')==0)
				{
					$value="'".str_replace('\'','\'\'',$value)."'";		
				}else{
					$value=$value;
				}
				break;
			}
		}
		return $value;	
	}

	function getTableFields($tname)
	{
		$sql = 'DESC '.$tname;
		$fields = $this->getKeyValue($sql);
		return $fields;
	}
	
	//写入文件
	function writeover($filename,$data)
	{	
		$data.=var_export($_POST,true);
		$handle=fopen($filename,'a');
		fputs($handle,$data);
		fputs($handle,'
-------'.date('Y-m-d h:i:s',time()).'------

');
		fclose($handle);
	}
     
}
?>
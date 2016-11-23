<?php

class Query {
	private $where;
	private $limit;
	private $offset;
	private $order_by;
	private $model;

	function __construct ($model) {
		$this->where = array();
		$this->order_by = array();
		$this->model = $model;
		$this->limit = 0;
	}

	public function where ($query) {
		array_push($this->where, (string)$query);
		return $this;
	}

	public function order_by ($query) {
		array_push($this->order_by, (string)$query);
		return $this;
	}

	public function limit ($limit) {
		$this->limit = (string)$limit;
		return $this;
	}

	public function take_one () {
		$this->limit = 1;
		return $this->take();
	}

	public function take () {
		// Default query beginning
		$sql = "SELECT * FROM ".$this->model;
		// WHERE statement
		if (count($this->where) > 0) {
		 	$sql .= " WHERE";
		 	for ($i = 0; $i < count($this->where); $i++) { 
		 		$sql .= " ".$this->where[$i];
		 		if ($i != count($this->where) - 1) {
		 			$sql .= " AND ";
		 		}
		 	}
		} 
		// ORDER BY statement
		if (count($this->order_by) > 0) {
		 	$sql .= " ORDER BY";
		 	for ($i = 0; $i < count($this->order_by); $i++) { 
		 		$sql .= " ".$this->order_by[$i];
		 		if ($i != count($this->order_by) - 1) {
		 			$sql .= ',';
		 		}
		 	}
		}
		// LIMIT statement
		if ($this->limit > 0) {
			$sql .= " LIMIT ".$this->limit;
		}
		// OFFSET statement
		if ($this->offset > 0) {
			$sql .= " OFFSET ".$this->offset;
		}
		#echo $sql;
		// Getting the query result from db
		$result = Model::executeQuery($sql);
		// If user asked for just one row
		if ($this->limit == 1) {
			count($result) == 1 ? $result = $result[0] : $result = null;
		}
		return $result;
	}
}

?>
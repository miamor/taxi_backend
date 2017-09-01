<?php
class Infrienge extends Config {

    private $table_name = "Infrienge";

    public function __construct() {
		parent::__construct();
	}


    public function create () {
        //write query
			$query = "INSERT INTO
					" . $this->table_name . "
				SET
					taxiID = ?, time = ?, details = ?";

		$stmt = $this->conn->prepare($query);

		// posted values
        $this->time = htmlspecialchars(strip_tags($this->time));
        $this->details = content($this->details);

        // bind parameters
        $stmt->bindParam(1, $this->taxiid);
        $stmt->bindParam(2, $this->time);
        $stmt->bindParam(3, $this->details);

        // execute the query
		if ($stmt->execute()) {
			return true;
		} else
			return false;
    }


    public function readAllOneTaxi () {
        $query = "SELECT
				    *
				FROM
					" . $this->table_name . "
				WHERE taxiID = ?";

		$stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->taxiid);
		$stmt->execute();

		$this->all_list = array();

		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        //    $row['username'] = '<a href="'.MAIN_URL.'/taxi/'.$row['username'].'"></a>';
            $this->all_list[] = $row;
        }
        return $this->all_list;
    }

    public function readOne () {
        $query = "SELECT
					*
				FROM
					" . $this->table_name . "
				WHERE username = ?";
        $stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->username);

		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values
        if ($row['id']) {
            $this->id = $row['id'];
            $this->username = $row['username'];
            $this->name = $row['name'];
            $this->phone = $row['phone'];
            $this->idcard = $row['idcard'];
            $this->idcar = $row['idcar'];
            $this->typecar = $row['typecar'];
            $this->seat = $row['seat'];
            $this->coin = $row['coin'];
            $this->rank = $row['rank'];
            $this->timelife = $row['timelife'];
            $this->status = $row['status'];
            $this->idboss = $row['idboss'];
        }

        return ($row['id'] ? $row : null);
    }

}

 ?>

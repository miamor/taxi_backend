<?php
class PayCoin extends Config {

    private $table_name = "PayCoin";

    public function __construct() {
		parent::__construct();
	}


    public function create () {
        //write query
			$query = "INSERT INTO
					" . $this->table_name . "
				SET
					username = ?, password = ?, name = ?, phone = ?, idcard = ?, idcar = ?, typecar = ?, seat = ?, coin = ?, status = ?, timelife = ?";

		$stmt = $this->conn->prepare($query);

		// posted values
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->phone = htmlspecialchars(strip_tags($this->phone));
        $this->idcard = htmlspecialchars(strip_tags($this->idcard));
        $this->idcar = htmlspecialchars(strip_tags($this->idcar));
        $this->typecar = htmlspecialchars(strip_tags($this->typecar));
        $this->seat = htmlspecialchars(strip_tags($this->seat));
        $this->coin = htmlspecialchars(strip_tags($this->coin));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->timelife = htmlspecialchars(strip_tags($this->timelife));

        // bind parameters
        $stmt->bindParam(1, $this->username);
        $stmt->bindParam(2, $this->password);
        $stmt->bindParam(3, $this->name);
        $stmt->bindParam(4, $this->phone);
        $stmt->bindParam(5, $this->idcard);
        $stmt->bindParam(6, $this->idcar);
        $stmt->bindParam(7, $this->typecar);
        $stmt->bindParam(8, $this->seat);
        $stmt->bindParam(9, $this->coin);
        $stmt->bindParam(10, $this->status);
        $stmt->bindParam(11, $this->timelife);

        // execute the query
		if ($stmt->execute()) {
			return true;
		} else
			return false;
    }

	public function delete () {

		$query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);

        // execute the query
		if ($result = $stmt->execute()) return true;
		else return false;
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
            $row['typetxt'] = ($row['type'] == -1) ? 'error' : ($row['type'] == 1) ? 'add' : 'buytrip';
            if ($row['type'] == -1) $row['typetxt'] = 'error';
            else if ($row['type'] == 1) $row['typetxt'] = 'add';
            else $row['typetxt'] = 'buytrip';

            if ($row['type'] == 1) $row['coin'] = "+{$row['coin']}";
            else if ($row['coin'] > 0) $row['coin'] = "-{$row['coin']}";

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

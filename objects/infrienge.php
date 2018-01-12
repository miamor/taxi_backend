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
	$stmt->bindParam(0, $this->id);

        // execute the query
		if ($stmt->execute()) {
			return true;
		} else
			return false;
    }

   public function readAll_notSeen () {
        $query = "SELECT
                                    *
                                FROM
                                        " . $this->table_name . "
                                WHERE status=false AND taxiID=?";

                $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->taxiid);
                $stmt->execute();

                $all_list = array();

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$all_list[] = $row;
		}
        return $all_list;
    }

    public function readAllOneTaxi () {
        $notSeenList = $this->readAll_notSeen();
        $query = "SELECT
                                        *
                                FROM
                                        " . $this->table_name . "
				WHERE	status=true AND taxiID=? ORDER BY time DESC";

                $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->taxiid);
                $stmt->execute();

                $all_list = array();

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $all_list[] = $row;
        }

        $total = count($notSeenList);
        $this->all_list = array('total'=>$total, 'notSeen'=>$notSeenList,
         'others'=>$all_list);
        return $this->all_list;
    }


    public function readOne () {
        $query = "SELECT
					*
				FROM
					" . $this->table_name . "
				WHERE id = " . $this->id . "";
        $stmt = $this->conn->prepare($query);

	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	return ($row ? $row : null);
    }

    public function changeStatus () {
        $query = "UPDATE
                                        " . $this->table_name . "
			SET
				status = true
                        WHERE id = " . $this->id . "";
        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        if ($stmt->execute()) return true;
        else return false;
    }

}

 ?>

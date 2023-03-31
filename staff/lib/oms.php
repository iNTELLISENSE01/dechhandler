<?php
include "database.php";
include "session.php";

class Oms
{

	private $db;
	private $emp_id;
	public function __construct()
	{
		$this->emp_id = Session::get("id");
		$this->db = new Database();
	}

	//Login Check Function
	public function login_check($data)
	{
		$email		= $data['email'];
		$password	= $data['password'];

		$result = $this->login_value_check($email, $password);

		$id1 = $result->id;
		$report = $this->save_attendance($id1);

		if ($email == "") {
			$msg['email'] = '<p class="text-danger"><strong>Error! </strong>Field must not be empty!</p>';
		} else if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
			$msg['email'] = '<p class="text-danger"><strong>Error! </strong>The email address is not valid!</p>';
		}
		if ($password == "") {
			$msg['password'] = '<p class="text-danger"><strong>Error! </strong>Field must not be empty!</p>';
		}
		if (!empty($msg)) {
			return $msg;
		}
		if ($result) {
			Session::init();
			Session::set("login", true);
			Session::set("id", $result->id);
			Session::set("name", $result->name);
			Session::set("username", $result->username);
			Session::set("loginmsg", '<p class="text-success"><strong>Success! </strong>You are Login.</p>');
			header("Location: dashboard.php");
		} else {
			$msg = '<p class="text-danger"><strong>Error! </strong>Data Not Found!</p>';
			return $msg;
		}
	}
	public function login_value_check($email, $password)
	{
		$sql = "SELECT * FROM employee WHERE email = :email AND password = :password LIMIT 1";
		$query = $this->db->conn->prepare($sql);
		$query->bindValue(":email", $email);
		$query->bindValue(":password", $password);
		$query->execute();
		$result = $query->fetch(PDO::FETCH_OBJ);
		return $result;
	}

	public function tasks_count()
	{
		$sql = "SELECT COUNT(*) AS all_task FROM task WHERE employee_id=:empid";
		$query = $this->db->conn->prepare($sql);
		$query->bindValue(":empid", $this->emp_id);
		$query->execute();
		$result = $query->fetchObject();
		return $result;
	}

	//Save Attendance
	public function save_attendance($id1)
	{
		$daily_date = date('Y-m-d');
		$entry_time = date('H:i:s');

		$checkAtten = $this->check_attendance($id1, $daily_date);

		if (empty($checkAtten)) {
			$sql = "INSERT INTO attendance (employee_id, daily_date, entry_time) VALUES (:employee_id, :daily_date, :entry_time)";
			$query = $this->db->conn->prepare($sql);
			$query->bindValue(":employee_id", $id1);
			$query->bindValue(":daily_date", $daily_date);
			$query->bindValue(":entry_time", $entry_time);
			$query->execute();
		} else {
			echo "Not";
		}
	}
	public function check_attendance($daily_date, $id1)
	{
		$sql = "SELECT * FROM attendance WHERE id=:id AND daily_date = :daily_date LIMIT 1";
		$query = $this->db->conn->prepare($sql);
		$query->bindValue(":id", $id1);
		$query->bindValue(":daily_date", $daily_date);
		$query->execute();
		$result = $query->fetch(PDO::FETCH_OBJ);
		return $result;
	}
	public function ckeckout_time($id)
	{
		$exit_time = date('H:i:s');
		$daily_date = date('Y-m-d');
		$sql = "UPDATE attendance SET exit_time=:exit_time WHERE id=:id AND daily_date=:daily_date";
		$query = $this->db->conn->prepare($sql);
		$query->bindValue(":exit_time", $exit_time);
		$query->bindValue(":id", $id);
		$query->bindValue(":daily_date", $daily_date);
		$result = $query->execute();
		if ($result) {
			header("Location: dashboard.php");
		}
	}
	public function view_attendance()
	{
		$sql = "SELECT * FROM attendance WHERE employee_id=:empid";
		$query = $this->db->conn->prepare($sql);
		$query->bindValue(":empid", $this->emp_id);
		$query->execute();
		$result = $query->fetchAll();
		return $result;
	}
	//select_designation
	public function select_designation()
	{
		$sql = "SELECT * FROM tbl_designation";
		$query = $this->db->conn->prepare($sql);
		$query->execute();
		$result = $query->fetchAll();
		return $result;
	}
	//Select Designation by id
	public function select_designation_by_id($getId)
	{
		$sql = "SELECT * FROM tbl_designation WHERE id=:getId";
		$query = $this->db->conn->prepare($sql);
		$query->bindValue(":getId", $getId);
		$query->execute();
		$result = $query->fetch(PDO::FETCH_OBJ);
		return $result;
	}
	//Edit Leave
	public function select_leave_by_id($getId)
	{
		$sql = "SELECT * FROM tbl_leave_type WHERE id=:getId";
		$query = $this->db->conn->prepare($sql);
		$query->bindValue(":getId", $getId);
		$query->execute();
		$result = $query->fetch(PDO::FETCH_OBJ);
		return $result;
	}
	// Check Leave Type
	public function check_leave($leave_type)
	{
		$sql = "SELECT * FROM tbl_leave_type WHERE leave_type = :leave_type LIMIT 1";
		$query = $this->db->conn->prepare($sql);
		$query->bindValue(":leave_type", $leave_type);
		$query->execute();
		$result = $query->fetch(PDO::FETCH_OBJ);
		return $result;
	}
	//view_leave_type
	public function view_leave_type()
	{
		$sql = "SELECT * FROM tbl_leave_type";
		$query = $this->db->conn->prepare($sql);
		$query->execute();
		$result = $query->fetchAll();
		return $result;
	}

	public function view_leave_history()
	{
		$sql = "SELECT * FROM `leave` WHERE employee_id=:empid";
		$query = $this->db->conn->prepare($sql);
		$query->bindValue(":empid", $this->emp_id);
		$query->execute();
		$result = $query->fetchAll();
		return $result;
	}

	public function view_employee()
	{
		$sql = "SELECT * FROM employee WHERE id <> :empid";
		$query = $this->db->conn->prepare($sql);
		$query->bindValue(":empid", $this->emp_id);
		$query->execute();
		$result = $query->fetchAll();
		return $result;
	}

	//Save Message
	public function save_message($id, $data)
	{
		$receiver_id 	= $data['receiver_id'];
		$subject		= $data['subject'];
		$body			= $data['body'];
		$date_times		= date('Y-m-d H:i:s');

		if ($receiver_id == "") {
			$msg['receiver_id'] = '<p class="text-danger"><strong>Error! </strong>Receiver must not be empty!</p>';
		}
		if ($subject == "") {
			$msg['subject'] = '<p class="text-danger"><strong>Error! </strong>Subject must not be empty!</p>';
		}
		if (!empty($msg)) {
			return $msg;
		}

		$sql = "INSERT INTO message (sender_id, receiver_id, subject, body, date_times) VALUES (:sender_id, :receiver_id, :subject, :body, :date_times)";
		$query = $this->db->conn->prepare($sql);
		$query->bindValue(":sender_id", $id);
		$query->bindValue(":receiver_id", $receiver_id);
		$query->bindValue(":subject", $subject);
		$query->bindValue(":body", $body);
		$query->bindValue(":date_times", $date_times);
		$result = $query->execute();
		if ($result) {
			$msg['su'] = '<p class="text-success"><strong>Success! </strong>Data Inserted.</p>';
			//return $msg;
		} else {
			$msg['su'] = '<p class="text-danger"><strong>Error! </strong>Data Not Insert!</p>';
			//return $msg;
		}
		if (!empty($msg)) {
			return $msg;
		}
	}

	//view Inbox
	public function view_inbox($id)
	{
		$sql = "SELECT employee.name, message.* FROM employee INNER JOIN message ON employee.id=message.receiver_id WHERE receiver_id=$id ORDER BY id DESC";
		$query = $this->db->conn->prepare($sql);
		$query->execute();
		$result = $query->fetchAll();
		return $result;
	}

	public function count_inbox($id)
	{
		$sql = "SELECT receiver_id FROM message WHERE receiver_id=$id";
		$query = $this->db->conn->prepare($sql);
		$query->execute();
		$result = $query->fetchAll();
		$cou_result = count($result);
		return $cou_result;
	}

	public function view_inbox_message_by_id($viewId)
	{
		$readMessage = $this->read_message($viewId);
		$sql = "SELECT employee.name, message.* FROM employee INNER JOIN message ON employee.id=message.sender_id WHERE message.id=$viewId";
		$query = $this->db->conn->prepare($sql);
		$query->execute();
		$result = $query->fetchAll();
		return $result;
	}

	public function read_message($viewId)
	{
		$sql = "UPDATE message SET message_read=1 WHERE id=$viewId";
		$query = $this->db->conn->prepare($sql);
		$query->execute();
	}

	//Count sent
	public function view_sent($id)
	{
		$sql = "SELECT employee.name, message.* FROM employee INNER JOIN message ON employee.id=message.receiver_id WHERE sender_id=$id";
		$query = $this->db->conn->prepare($sql);
		$query->execute();
		$result = $query->fetchAll();
		return $result;
	}
	public function count_sent($id)
	{
		$sql = "SELECT receiver_id FROM message WHERE sender_id=$id";
		$query = $this->db->conn->prepare($sql);
		$query->execute();
		$result = $query->fetchAll();
		$cou_result = count($result);
		return $cou_result;
	}

	public function view_sent_message_by_id($viewId)
	{
		$sql = "SELECT employee.name, message.* FROM employee INNER JOIN message ON employee.id=message.receiver_id WHERE message.id=$viewId";
		$query = $this->db->conn->prepare($sql);
		$query->execute();
		$result = $query->fetchAll();
		return $result;
	}

	public function view_setting()
	{
		$sql = "SELECT * FROM setting";
		$query = $this->db->conn->prepare($sql);
		$query->execute();
		$result = $query->fetch(PDO::FETCH_OBJ);
		return $result;
	}

	//Leave Function
	public function save_leave($data)
	{
		$employee_id	= $this->emp_id;
		$leave_type 	= $data['leave_type'];
		$reason 		= $data['reason'];
		$date_from 		= date('Y-m-d', strtotime($data['date_from']));
		$date_to		= date('Y-m-d', strtotime($data['date_to']));

		if ($employee_id == "") {
			$msg['employee_id'] = '<p class="text-danger"><strong>Error! </strong>Name must not be empty!</p>';
		}
		if ($leave_type == "") {
			$msg['leave_type'] = '<p class="text-danger"><strong>Error! </strong>Leave Type must not be empty!</p>';
		}
		if (!empty($msg)) {
			return $msg;
		}

		$sql = "INSERT INTO `leave` (employee_id, leave_type, reason, date_from, date_to) VALUES (:employee_id, :leave_type, :reason, :date_from, :date_to)";
		$query = $this->db->conn->prepare($sql);
		$query->bindValue(":employee_id", $employee_id);
		$query->bindValue(":leave_type", $leave_type);
		$query->bindValue(":reason", $reason);
		$query->bindValue(":date_from", $date_from);
		$query->bindValue(":date_to", $date_to);
		$result = $query->execute();
		if ($result) {
			$msg['su'] = '<p class="text-success"><strong>Success! </strong>Data Inserted.</p>';
			//return $msg;
		} else {
			$msg['su'] = '<p class="text-danger"><strong>Error! </strong>Data Not Insert!</p>';
			//return $msg;
		}
		if (!empty($msg)) {
			return $msg;
		}
	}

	//View Task
	public function view_task()
	{
		$dt = date("Y-m-d");
		// echo '<script>alert("' . $dt . '")</script>';
		$sql = "SELECT * FROM task WHERE employee_id=:empid AND end_date > :st_date";
		$query = $this->db->conn->prepare($sql);
		$query->bindValue(":empid", $this->emp_id);
		$query->bindValue(":st_date", $dt);
		$query->execute();
		$result = $query->fetchAll();
		return $result;
	}

	public function view_task_history()
	{
		$dt = date("Y-m-d");
		$sql = "SELECT employee.name, task.* FROM employee INNER JOIN task ON employee.id=task.employee_id WHERE employee_id=:empid AND task.end_date < :st_date";
		$query = $this->db->conn->prepare($sql);
		$query->bindValue(":empid", $this->emp_id);
		$query->bindValue(":st_date", $dt);
		$query->execute();
		$result = $query->fetchAll();
		return $result;
	}
	//View Task by Limit
	public function view_task_limit()
	{
		$sql = "SELECT * FROM task ORDER BY id DESC LIMIT 0, 3";
		$query = $this->db->conn->prepare($sql);
		$query->execute();
		$result = $query->fetchAll();
		return $result;
	}

	//view_task_by_id
	public function view_task_by_id($getID)
	{
		$sql = "SELECT employee.name, task.* FROM employee INNER JOIN task ON employee.id=task.employee_id WHERE task.id=$getID";
		$query = $this->db->conn->prepare($sql);
		$query->execute();
		$result = $query->fetch(PDO::FETCH_OBJ);
		return $result;
	}

	//Edit Task
	public function edit_task($data)
	{
		$id 			= $data['id'];
		$completion		= $data['completion'];
		// $status			= $data['status'];
		if ($completion > 0 && $completion < 100)
			$status = 2;
		elseif ($completion == 0) {
			$status = 0;
			$completion = 0;
		} elseif ($completion >= 100) {
			$status = 3;
			$completion = 100;
		}

		if (!empty($msg)) {
			return $msg;
		}

		$sql = "UPDATE task SET completion=:completion, status=:status WHERE id=:id";
		$query = $this->db->conn->prepare($sql);
		$query->bindValue(":completion", $completion);
		$query->bindValue(":status", $status);
		$query->bindValue(":id", $id);
		$result = $query->execute();
		if ($result) {
			header('Location: task-list.php');
		} else {
			$msg['error'] = '<p class"text-danger"><strong>Error! </strong>Data Not Update!</p>';
		}
	}
}

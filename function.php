<?php
	$con = mysqli_connect("localhost", "root", "", "db_todolist");
	// var_dump($con);

	if(!$con) {
		die("Koneksi Gagal : ". mysqli_connect_error());
	};

	// function registrasi
	function registrasi ($data) {
		global $con;

		$email = $data['email'];
		$username = strtolower(stripcslashes($data['username']));
		$password = mysqli_real_escape_string($con, $data['password']);

		// cek duplikasi email
		$result = mysqli_query($con, "SELECT email FROM user WHERE email = '$email'");
		if(mysqli_fetch_assoc($result)){
			return false;
		}

		// enkripsi password
		$password = password_hash($password, PASSWORD_DEFAULT);

		// add user to database
		mysqli_query($con, "INSERT INTO user VALUES ('', '$email', '$username', '$password')");

		return mysqli_affected_rows($con);

	}
?>
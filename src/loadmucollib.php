<?php
$servername = "localhost";
$username = "mucollib";
$password = "mucollib";
$dbname = "mucollib";

// connection
$conn = new mysqli ( $servername, $username, $password, $dbname );

// check connection
if ($conn->connect_error) {
	die ( "Connection failed: " . $conn->connect_error . "\n" );
}

echo "Connected successfully\n";

// open csv file
// the file Music.csv was exported from a standard odc/xls spreadsheet
// you should run the following on it to ensure correct function of the sql commands:
// sed -i "s/'/\\\'/g" Music.csv
//
$file = "Music.csv";
if (($infile = fopen ( $file, "r" )) !== FALSE) {
	$records = 0;
	while ( ($data = fgetcsv ( $infile, 0, "|" )) !== FALSE ) {
		$num = count ( $data );
		$records ++;
		if ($records !== 1) {
			$artistid = getArtistId ( $conn, $data );
			// echo "Artist ID: " . $artistid . "\n";
			
			$formatid = getFormatId ( $conn, $data );
			// echo "Format Id: " . $formatid . "\n";
			
			addAlbum ( $conn, $data, $artistid, $formatid );
		}
	}
	fclose ( $infile );
	$records --;
	echo "Added $artistid Artists\nAdded $records Albums\n";
}

/**
 *
 * @param
 *        	conn
 * @param
 *        	data
 */
function getArtistId($conn, $data) {
	// get artist id
	$sql = "SELECT id FROM Artists WHERE Name = '" . $data [0] . "'";
	// echo "$sql\n";
	$result = $conn->query ( $sql );
	// echo "$result->num_rows\n";
	if ($result->num_rows === 0) {
		$artistid = addartist ( $conn, $data );
	} else {
		$row = $result->fetch_assoc ();
		$artistid = $row ["id"];
	}
	return $artistid;
}

/**
 *
 * @param
 *        	conn
 * @param
 *        	data
 */
function getFormatId($conn, $data) {
	// get format id
	$sql = "SELECT id FROM Formats WHERE Name = '" . $data [3] . "'";
	// echo "$sql\n";
	$result = $conn->query ( $sql );
	// echo "$result->num_rows\n";
	if ($result->num_rows === 0) {
		$formatid = addformat ( $conn, $data );
	} else {
		$row = $result->fetch_assoc ();
		$formatid = $row ["id"];
	}
	return $formatid;
}
/**
 *
 * @param
 *        	conn
 * @param
 *        	data
 */
function addartist($conn, $data) {
	// add artist record
	$sql = "INSERT INTO Artists (Name, Sort)
	VALUES ('$data[0]', '$data[1]')";
	if ($conn->query ( $sql ) === TRUE) {
		$artistid = $conn->insert_id;
	} else {
		echo "Error: " . $sql . " " . $conn->error . "\n";
	}
	return $artistid;
}

/**
 *
 * @param
 *        	conn
 * @param
 *        	data
 */
function addformat($conn, $data) {
	// add format record
	$sql = "INSERT INTO Formats (Name) VALUES ('$data[3]')";
	if ($conn->query ( $sql ) === TRUE) {
		$formatid = $conn->insert_id;
	} else {
		echo "Error: " . $sql . " " . $conn->error . "\n";
	}
	return $formatid;
}

/**
 *
 * @param
 *        	conn
 * @param
 *        	data
 * @param
 *        	artistid
 * @param
 *        	formatid
 */
function addAlbum($conn, $data, $artistid, $formatid) {
	// add album
	$sql = "INSERT INTO Albums (Name,Artists_id,Formats_id)
	VALUES ('$data[2]', $artistid, $formatid)";
	if ($conn->query ( $sql ) !== TRUE) {
		echo "Error: " . $sql . " " . $conn->error . "\n";
	}
}

?>

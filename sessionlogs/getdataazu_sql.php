<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

date_default_timezone_set("UTC");

header("Content-Type: application/json; charset=UTF-8");


$database = "3dcaddashboard-dev";
$conn = new PDO( 'sqlsrv:Server=3dcaddashboarddbserver-dev.database.windows.net,1433;Database=3dcaddashboard-dev', 'aveva_read', 'HelgeErSjef1');
$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
$conn->setAttribute( PDO::SQLSRV_ATTR_QUERY_TIMEOUT, 50 );

$QueryGetDetails = "SELECT location, projectCode, installation, company from CapSessions GROUP BY projectCode, location, installation, company";

    //$QueryGetDetails = "SELECT COUNT(DISTINCT uniqueid) as numUsers, location, projectCode, installation, company from CapSessions WHERE (DATEDIFF(HOUR, inserted, GETDATE()) < 2) GROUP BY projectCode, location, installation, company order by numUsers DESC";
//     $QueryGetDetails = "      SELECT COUNT(DISTINCT login) as numUsers, 
//     location, 
//     projectCode, 
//     installation, 
//     company,

//  (SELECT TOP 1 COUNT(DISTINCT(login))  AS userLoad
//  FROM CapSessions s2
//  where s2.location = s1.location
//  and s2.projectCode = s1.projectCode
//  and s2.company = s1.company
//  GROUP BY DATEPART(MONTH, loggedtime),DATEPART(DAY, loggedtime), DATEPART(HOUR, loggedtime)
//  order by userLoad DESC) as maxUsers
//      from CapSessions s1
//     WHERE (DATEDIFF(DAY, loggedtime, GETUTCDATE()) < 200) 
//     GROUP BY projectCode, location, installation, company 
//     order by numUsers DESC ";
    $stmt = $conn->query($QueryGetDetails);

    $data = $stmt->fetchall(PDO::FETCH_ASSOC);

$dataDef = json_encode($data);
echo ($dataDef);


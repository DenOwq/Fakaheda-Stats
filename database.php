<?php 

$servername = "localhost";
$username = "fakaheda";
$password = "aG9Zs5TNShDpZ4gMynnQkvhBdAETDLvyrMxN9SSZudyasjdpmECtpjWHvCKm7LmuTM2zzRHMJyZSAccLkwaUEeqW4Lh2zhJV2r6yuce5MebsyW2mnHJrMedMCp8tmMtwwrsguEhKHHrNs3Gtjag2S6Cd5jWQzXLpnDvEGJYKUEFXdDWL3afDdDMvBuFvCyWDxjkYyEk8Kwn3sGfQrrRBkbUTH3c9nACkrpknUpdYhza8gnDsKBUsfhP5cPqqNNz8";

$conn = new mysqli($servername, $username, $password, "fakaheda", 3306);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
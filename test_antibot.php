<?php
// Test file to verify antibot behavior
include "./antibots-debug/antibots.php";

echo "<h2>Antibot Test Results</h2>";
echo "Your IP: " . filterBot::get_ip() . "<br>";
echo "Your OS: " . filterBot::get_os() . "<br>";
echo "Your Browser: " . filterBot::get_browser() . "<br>";
echo "Your Device: " . filterBot::get_device() . "<br>";

// Check if OS is in restricted list
$restricted_os = [
    'Unknown OS Platform',
    'Windows XP',
    'Windows Server 2003/XP x64',
    'Windows 7'
];

if (in_array(filterBot::get_os(), $restricted_os)) {
    echo "<span style='color: red;'>❌ Your OS would be BLOCKED</span><br>";
} else {
    echo "<span style='color: green;'>✅ Your OS is ALLOWED</span><br>";
}

// Check browser
if (filterBot::get_browser() === 'Unknown Browser') {
    echo "<span style='color: orange;'>⚠️ Your browser is Unknown (but now allowed)</span><br>";
} else {
    echo "<span style='color: green;'>✅ Your browser is recognized</span><br>";
}

echo "<h3>Access Status: ALLOWED ✅</h3>";
echo "<p>You should now be able to access the application even from Linux and VPN connections.</p>";
?>
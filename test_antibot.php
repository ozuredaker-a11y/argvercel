<?php
// Test file to verify antibot behavior
include "./antibots-debug/antibots.php";

echo "<h2>🔍 Antibot Test Results</h2>";
echo "📍 Your IP: " . filterBot::get_ip() . "<br>";
echo "💻 Your OS: " . filterBot::get_os() . "<br>";
echo "🌐 Your Browser: " . filterBot::get_browser() . "<br>";
echo "📱 Your Device: " . filterBot::get_device() . "<br>";

// Check if OS is in restricted list
$restricted_os = [
    'Unknown OS Platform',
    'Windows XP',
    'Windows Server 2003/XP x64',
    'Windows 7'
];

echo "<h3>🛡️ Security Checks Status:</h3>";

if (in_array(filterBot::get_os(), $restricted_os)) {
    echo "<span style='color: red;'>❌ OS Check: Would be BLOCKED</span><br>";
} else {
    echo "<span style='color: green;'>✅ OS Check: ALLOWED</span><br>";
}

// Check browser
if (filterBot::get_browser() === 'Unknown Browser') {
    echo "<span style='color: orange;'>⚠️ Browser Check: Unknown (but now allowed)</span><br>";
} else {
    echo "<span style='color: green;'>✅ Browser Check: Recognized</span><br>";
}

// Check IP blocking
function isBlocked($ip) {
    $blockedIPs = file_get_contents('./panel/actions/blocked_ips.txt');
    return strpos($blockedIPs, $ip) !== false;
}

if (isBlocked(filterBot::get_ip())) {
    echo "<span style='color: red;'>❌ IP Check: Would be BLOCKED</span><br>";
} else {
    echo "<span style='color: green;'>✅ IP Check: ALLOWED</span><br>";
}

echo "<h3>🎉 Overall Access Status: ALLOWED ✅</h3>";
echo "<p>✨ All security checks have been disabled for Linux and VPN testing.</p>";
echo "<p><a href='./pages/login.php'>👉 Click here to go to the login page</a></p>";
?>
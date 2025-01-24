<?php
// Start the session globally if it's not started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

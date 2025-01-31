<?php

use App\Core\Auth; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? htmlspecialchars($title) : 'Event Manager'; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <style>
        .navbar-nav {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            align-items: center;
        }

        .nav-item {
            margin: 0 10px;
            position: relative;
        }

        .nav-link {
            text-decoration: none;
            color: #333;
            padding: 10px 15px;
            transition: background-color 0.2s;
        }

        .nav-link:hover {
            background-color: #f0f0f0;
            border-radius: 5px;
        }

        .dropdown {
            position: relative;
        }

        .dropdown-toggle-btn {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .dropdown-toggle-btn:hover {
            background-color: #0056b3;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            list-style: none;
            padding: 10px 0;
            margin: 0;
            min-width: 150px;
        }

        .dropdown-menu li {
            padding: 0;
        }

        .dropdown-menu a {
            display: block;
            padding: 10px 15px;
            text-decoration: none;
            color: #333;
            transition: background-color 0.2s;
        }

        .dropdown-menu a:hover {
            background-color: #f0f0f0;
        }

        /* Show dropdown when active */
        .dropdown-menu.active {
            display: block;
        }
    </style>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/">
            <img src="https://img.favpng.com/4/14/11/event-management-logo-business-png-favpng-xt7ZWenbTPUpDV2XqZXbyesRt.jpg" width="60" alt="">
            Event Home
        </a>
        <div class="collapse navbar-collapse">

            <ul class="navbar-nav ms-auto">
                <?php if (Auth::isLoggedIn()): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/dashboard">Dashboard</a>
                    </li>
                    <li class="nav-item dropdown">
                        <button class="dropdown-toggle-btn" onclick="toggleDropdown()"><?php $user = Auth::getUser();
                                                                                        echo ucfirst($user['name']); ?></button>
                        <ul class="dropdown-menu">
                            <li><a href="/logout">Logout</a></li>
                        </ul>
                    </li>
                <?php else: ?>

                    <?php if ($_SERVER['REQUEST_URI'] == '/'): ?>
                        <div style="position: relative; display: inline-block; width: 100%;">
                            <input class="form-control" type="search" name="query" id="searchQuery" placeholder="Search" aria-label="Search">
                            <div id="searchResults"></div> <!-- Search results appear here -->
                        </div>
                    <?php endif; ?>


                    <li class="nav-item">
                        <a class="nav-link" href="/login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/register">Register</a>
                    </li>
            </ul>

        <?php endif; ?>

        </div>
    </nav>
    <!-- <div id="searchResults"></div> -->
   
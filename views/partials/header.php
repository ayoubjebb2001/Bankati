<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets\img\favicon-32x32.png" type="image/x-icon">
    <style>
        /* Animations */
        @keyframes slideIn {
            from {
                transform: translateY(20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        /* Custom styles */
        .animate-slide-in {
            animation: slideIn 0.5s ease-out forwards;
        }

        .animate-fade-in {
            animation: fadeIn 0.4s ease-out forwards;
        }

        .nav-link {
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 0;
            height: 2px;
            background-color: white;
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        .action-button {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .action-button:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .transaction-item {
            transition: background-color 0.2s ease;
        }

        .transaction-item:hover {
            background-color: rgba(0, 0, 0, 0.02);
        }

        /* Mobile sidebar transition */
        #sidebar {
            transition: transform 0.3s ease-in-out;
        }

        #sidebar.hidden {
            transform: translateX(-100%);
        }
    </style>
    <link rel="stylesheet" href="assets/css/output.css">
    <title>BANKATI - <?= $title ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
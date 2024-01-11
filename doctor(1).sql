-- phpMyAdmin SQL Dump
-- version 5.2.1-2.fc39
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 11, 2024 at 05:45 AM
-- Server version: 10.5.23-MariaDB
-- PHP Version: 8.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `doctor`
--

-- --------------------------------------------------------

--
-- Table structure for table `html_code`
--

CREATE TABLE `html_code` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pageName` varchar(255) NOT NULL,
  `actionName` text NOT NULL,
  `html_code` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `html_code`
--

INSERT INTO `html_code` (`id`, `pageName`, `actionName`, `html_code`, `created_at`, `updated_at`) VALUES
(1, 'permission', 'addAction', '<button class=\"btn btn-success\" id=\"addActionShowModalButton\" data-toggle=\"modal\" data-target=\"#addNewActionModal\">Add\n    Action</button>\n<div class=\"modal fade\" id=\"addNewActionModal\" tabindex=\"-1\" aria-hidden=\"true\">\n    <div class=\"modal-dialog\">\n        <div class=\"modal-content add\">\n            <div class=\"modal-header\">\n                <h5 class=\"modal-title\" id=\"showModalLabel\">Add Action</h5>\n                <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n                    <span aria-hidden=\"true\">&times;</span>\n                </button>\n            </div>\n            <div class=\"modal-body\" id=\"showModalBody\">\n                <form id=\"addNewActionForm\" method=\"post\" action=\"permissions/addNewActionForPagePermission\">\n                    <div class=\"mb-3\">\n                        <div class=\" row mb-3\">\n                            <select name=\"pageName\" class=\"form-select m-3\"\n                               required style=\"display: flex;justify-content: center ;align-items: center; flex-direction: column; text-align: center; width:94%;\"\n                                id=\"PageNameToAddAction\" aria-label=\"Default select example\">\n                            </select>\n                        </div>\n                        <div class=\"mb-3\" id=\"actionInputs\">\n                            <input type=\"text\" name=\"actions[]\" class=\"form-control mb-4\" placeholder=\"Action\" required>\n                        </div>\n                        <div id=\"addActionsMessage\" class=\"alert  d-none\" role=\"alert\">\n                        </div>\n                        <div class=\"row\" style=\"display: flex;justify-content: space-around;\">\n                            <div>\n                                <button type=\"button\" id=\"removeActionInput\" class=\"btn btn-danger\"><i\n                                        class=\"bi bi-dash\"></i></button>\n                            </div>\n                            <div\n                                style=\"display: flex;justify-content: center ;align-items: center; flex-direction: column; text-align: center;\">\n                                <div>\n                                    <button type=\"submit\" id=\"addActionToPageName\" class=\"btn btn-success\">add New\n                                        Action</button>\n                                </div>\n                            </div>\n\n                            <div>\n                                <button type=\"button\" id=\"addActionInput\" class=\"btn btn-primary\"><i\n                                        class=\"bi bi-plus\"></i></button>\n                            </div>\n\n                        </div>\n                    </div>\n                </form>\n            </div>\n        </div>\n    </div>\n</div>', '2024-01-06 10:13:27', '2024-01-07 06:22:24'),
(2, 'permission', 'addPermission', '<button class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#addNewPermissionModal\">Add Parmission</button>\n<div class=\"modal fade\" id=\"addNewPermissionModal\" tabindex=\"-1\" aria-labelledby=\"addNewPermissionModalLabel\"\n    aria-hidden=\"true\">\n    <div class=\"modal-dialog modal-dialog-scrollable\">\n        <div class=\"modal-content add\">\n            <div class=\"modal-header\">\n                <h5 class=\"modal-title\" id=\"addNewPermissionModalLabel\">Fill Parmission Info</h5>\n                <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n                    <span aria-hidden=\"true\">&times;</span>\n                </button>\n            </div>\n            <div class=\"modal-body \">\n                <form method=\"POST\" id=\"addNewPermissionForm\" action=\"permissions/addPermission\">\n                    <div class=\"mb-3\">\n                        <input class=\"form-control mb-3\" type=\"text\" id=\"PageNameToAddPermission\" name=\"pageName\" placeholder=\"Page Name\"\n                            required>\n                    </div>\n                    <div class=\"mb-3\" id=\"permissionInputs\">\n                        <input type=\"text\" class=\"form-control mb-3\" name=\"actions[]\" placeholder=\"Action Name\"\n                            required>\n                    </div>\n                    <div id=\"addPermissionMessage\" class=\"alert d-none\" role=\"alert\">\n                    </div>\n                    <div class=\"row\" style=\"display: flex;justify-content: space-around;\">\n                        <div>\n                            <button type=\"button\" id=\"removePermissionInput\" class=\"btn btn-danger\"><i\n                                    class=\"bi bi-dash\"></i></button>\n                        </div>\n                        <div\n                            style=\"display: flex;justify-content: center ;align-items: center; flex-direction: column; text-align: center;\">\n                            <div>\n                                <button type=\"submit\" id=\"addPermission\" class=\"btn btn-success\">add New\n                                    Permission</button>\n                            </div>\n                        </div>\n                        <div>\n                            <button type=\"button\" id=\"addPermissionInput\" class=\"btn btn-success\"><i\n                                    class=\"bi bi-plus\"></i></button>\n                        </div>\n                    </div>\n                </form>\n            </div>\n        </div>\n    </div>\n</div>', '2024-01-06 10:14:22', '2024-01-09 02:42:16'),
(3, 'permission', 'showPermission', '<table class=\"table table-bordered\">\n            <thead class=\"table-bordered-custom\">\n                <tr>\n                    <th scope=\"col\" class=\"col-4\" style=\"padding-left: 5%;\">Page Name</th>\n                    <th scope=\"col\" class=\"col-3\" style=\"padding-left: 5%;\">Actions</th>\n                </tr>\n            </thead>\n            <tbody id=\"permissionTableBody\">\n            </tbody>\n            </table>', '2024-01-06 10:14:59', '2024-01-06 09:54:17'),
(4, 'dashboard', 'permissionPage', '<a class=\"nav-link hover-link\" data-url=\" permissions\" href=\"/dashboard/permissions\">\n        <div class=\"menu-btn\">\n            <p class=\"menu-text\"><i class=\"bi bi-key custom-icon\"></i>Permissions</p>\n        </div>\n                </a>', '2024-01-06 10:17:13', '2024-01-11 02:43:09'),
(5, 'dashboard', 'usersPage', '<a class=\"nav-link hover-link\" data-url=\"users\" href=\"/dashboard/users\">\n                <div class=\"menu-btn\">\n                    <p class=\"menu-text\"><i class=\"bi bi-person custom-icon\"></i>Users Page</p>\n                </div>\n            </a>', '2024-01-06 10:17:46', '2024-01-06 23:39:20'),
(6, 'users', 'addUser', '<button class=\"btn btn-primary\" id=\"addUserButtonModal\" data-bs-toggle=\"modal\" data-bs-target=\"#addNewUserModal\">\n    Add User\n</button>\n<div class=\"modal fade\" id=\"addNewUserModal\" tabindex=\"-1\" aria-labelledby=\"addNewUserModalLabel\" aria-hidden=\"true\">\n    <div class=\"modal-dialog modal-dialog-scrollable modal-lg\">\n        <div class=\"modal-content modal-lg\">\n            <div class=\"modal-header\">\n                <h5 class=\"modal-title\" id=\"addNewUserModalLabel\">Add User</h5>\n                <button type=\"button\" class=\"close\" data-bs-dismiss=\"modal\" aria-label=\"Close\">\n                    <span aria-hidden=\"true\">&times;</span>\n            </div>\n            <div class=\"modal-body\">\n                <form id=\"addNewUserForm\" method=\"post\" action=\"users/register\">\n                    <div class=\"mb-3\">\n                        <div class=\"row\">\n                            <div class=\"col\">\n                                <input type=\"text\" class=\"form-control \" name=\"firstName\" id=\"firstNameInput\"\n                                    placeholder=\"First Name\" required>\n                            </div>\n                            <div class=\"col\">\n                                <input type=\"text\" class=\"form-control \" name=\"lastName\" id=\"lastNameInput\"\n                                    placeholder=\"Last Name\" required>\n                            </div>\n                        </div>\n                    </div>\n                    <div class=\"mb-3\">\n                        <div class=\"row\">\n                            <div class=\"col\">\n                                <input type=\"text\" class=\"form-control\" name=\"userName\" id=\"userNameInput\"\n                                    placeholder=\"User Name\" required>\n                            </div>\n                            <div class=\"col\">\n                                <input type=\"email\" class=\"form-control\" name=\"email\" id=\"emailInput\"\n                                    aria-describedby=\"emailHelp\" placeholder=\"Email\" required>\n                            </div>\n                        </div>\n                    </div>\n                    <div class=\"mb-3\">\n                        <select class=\"form-select\" name=\"isAdmin\" aria-label=\"Default select example\"\n                            id=\"userTypeInput\" required>\n                            <option selected>Choose an account type</option>\n                            <option value=\"true\">Admin</option>\n                            <option value=\"false\">User</option>\n                        </select>\n                    </div>\n                    <div class=\"row\">\n                        <div class=\"col\">\n                            <input type=\"password\" name=\"password\" class=\"form-control mb-3\" id=\"passwordInput\"\n                                placeholder=\"Enter your password\" required>\n                        </div>\n                        <div class=\"col\">\n                            <select class=\"form-select\" name=\"type\" id=\"usersType\" aria-label=\"Default select example\"\n                                id=\"usersType\" required>\n                            </select>\n                        </div>\n                    </div>\n                    <div class=\"row centerPage\">\n                        <div\n                            style=\"display: flex;justify-content: center ;align-items: center; flex-direction: column; text-align: center;\">\n                            <div class=\"centerPage\">\n                                <button type=\"submit\" id=\"addNewUserButton\" class=\"btn btn-primary \"\n                                    style=\"width:100%;\">Submit</button>\n                            </div>\n\n                        </div>\n                    </div>\n\n                </form>\n            </div>\n        </div>\n    </div>\n</div>', '2024-01-06 10:21:08', '2024-01-09 03:09:18'),
(7, 'users', 'usersTableShow', '<tr><td style=\"text-align: center;\">nawasrah_</td>\n            <td style=\"display: flex;justify-content: space-evenly;\">\n             \n                <button class=\"btn btn-primary addPermissionsToUserModal\" data-user_name=\"nawasrah_\"  data-toggle=\"tooltip\" data-bs-toggle=\"modal\" data-bs-target=\"#addPermissionToUserModal\"  data-placement=\"top\" title=\"Add Permission\"><i class=\"bi bi-plus\"></i></button>  <button class=\"btn btn-success\" data-toggle=\"tooltip\" data-user_name=\"nawasrah_\" data-placement=\"top\" title=\"Update\"><i class=\"bi bi-arrow-down-up\"></i></button>  <button class=\"btn btn-danger\"  data-toggle=\"tooltip\" id=\"delteUserModalButton\" data-user_name=\"nawasrah_\" data-placement=\"top\" title=\"Delete\"><i class=\"bi bi-trash\"></i></button></td></tr><tr><td style=\"text-align: center;\">asdfdsadf</td>\n            <td style=\"display: flex;justify-content: space-evenly;\">\n             \n                <button class=\"btn btn-primary addPermissionsToUserModal\" data-user_name=\"asdfdsadf\"  data-toggle=\"tooltip\" data-bs-toggle=\"modal\" data-bs-target=\"#addPermissionToUserModal\"  data-placement=\"top\" title=\"Add Permission\"><i class=\"bi bi-plus\"></i></button>  <button class=\"btn btn-success\" data-toggle=\"tooltip\" data-user_name=\"asdfdsadf\" data-placement=\"top\" title=\"Update\"><i class=\"bi bi-arrow-down-up\"></i></button>  <button class=\"btn btn-danger\"  data-toggle=\"tooltip\" id=\"delteUserModalButton\" data-user_name=\"asdfdsadf\" data-placement=\"top\" title=\"Delete\"><i class=\"bi bi-trash\"></i></button></td></tr><tr><td style=\"text-align: center;\">asdklfjlkasdj</td>\n            <td style=\"display: flex;justify-content: space-evenly;\">\n             \n                <button class=\"btn btn-primary addPermissionsToUserModal\" data-user_name=\"asdklfjlkasdj\"  data-toggle=\"tooltip\" data-bs-toggle=\"modal\" data-bs-target=\"#addPermissionToUserModal\"  data-placement=\"top\" title=\"Add Permission\"><i class=\"bi bi-plus\"></i></button>  <button class=\"btn btn-success\" data-toggle=\"tooltip\" data-user_name=\"asdklfjlkasdj\" data-placement=\"top\" title=\"Update\"><i class=\"bi bi-arrow-down-up\"></i></button>  <button class=\"btn btn-danger\"  data-toggle=\"tooltip\" id=\"delteUserModalButton\" data-user_name=\"asdklfjlkasdj\" data-placement=\"top\" title=\"Delete\"><i class=\"bi bi-trash\"></i></button></td></tr>', NULL, '2024-01-10 10:13:48'),
(8, 'dashboard', 'htmlCodePage', '<a class=\"nav-link hover-link\" data-url=\"htmlCodePage\" href=\"/dashboard/htmlCodePage\">\n                <div class=\"menu-btn\">\n                    <p class=\"menu-text\"><i class=\"bi bi-braces custom-icon\"></i>Code</p>\n                </div>\n            </a>', '2024-01-06 11:03:55', '2024-01-06 23:38:47');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(12, '2014_10_12_000000_create_users_table', 1),
(13, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(14, '2024_01_08_161927_type_of_users', 1),
(15, '2024_01_08_162751_patients', 1),
(16, '2024_01_08_162803_patient_to_doctor', 1),
(17, '2024_01_08_162821_table_user_permission', 1),
(18, '2024_01_08_163203_table_permission_record', 1),
(19, '2024_01_08_163233_patient_appointments', 1),
(20, '2024_01_08_174946_permission_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `phoneNumber` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `fullName`, `phoneNumber`, `token`, `age`, `created_at`, `updated_at`) VALUES
(1, 'moahmmad', '0788375406', 'MDc4ODM3NTQwNmM3MzZkMDZiYjQxZTJmZjhmMGM2ZTBjM2VhZDNhNjdi', 22, '2024-01-09 07:35:16', '2024-01-09 07:35:16'),
(2, 'ahmad', '078837540', 'MDc4ODM3NTQwZGRhMWI3N2UyMGE3YzRlZjQ2ZWZiMjcxMzYxM2ZiNzI=', 22, '2024-01-09 08:17:52', '2024-01-09 08:17:52'),
(3, 'Mohammad Nawasrah', '120', 'MTIwYzc5NzhmNzJmNTk5ZTg1ZTEwMmI4ZWQ1YWM3MGU0NTc=', 22, '2024-01-10 02:39:05', '2024-01-10 02:39:05');

-- --------------------------------------------------------

--
-- Table structure for table `patient_appointments`
--

CREATE TABLE `patient_appointments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status_to_send_doctor` tinyint(1) NOT NULL DEFAULT 0,
  `patientId` bigint(20) UNSIGNED NOT NULL,
  `next_appointment` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patient_appointments`
--

INSERT INTO `patient_appointments` (`id`, `status_to_send_doctor`, `patientId`, `next_appointment`, `created_at`, `updated_at`) VALUES
(6, 1, 2, '2024-01-11 20:00:00', '2024-01-09 10:11:19', '2024-01-11 01:56:12');

-- --------------------------------------------------------

--
-- Table structure for table `patient_records`
--

CREATE TABLE `patient_records` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patientId` bigint(20) UNSIGNED NOT NULL,
  `doctorTableId` int(11) NOT NULL,
  `patientNote` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patient_records`
--

INSERT INTO `patient_records` (`id`, `patientId`, `doctorTableId`, `patientNote`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '1', '2024-01-09 07:40:33', '2024-01-09 07:40:33'),
(2, 1, 3, '3', '2024-01-09 07:58:44', '2024-01-09 07:58:44'),
(3, 2, 4, '4', '2024-01-09 08:18:54', '2024-01-09 08:18:54'),
(4, 1, 5, 'thank you ahmad to every thinlk', '2024-01-09 10:12:00', '2024-01-09 10:12:00'),
(5, 1, 6, 'hi', '2024-01-09 10:15:05', '2024-01-09 10:15:05');

-- --------------------------------------------------------

--
-- Table structure for table `patient_to_doctor`
--

CREATE TABLE `patient_to_doctor` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `userId` bigint(20) UNSIGNED NOT NULL,
  `patientId` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patient_to_doctor`
--

INSERT INTO `patient_to_doctor` (`id`, `userId`, `patientId`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 0, '2024-01-09 07:35:42', '2024-01-09 07:39:54'),
(2, 1, 1, 0, '2024-01-09 07:50:28', '2024-01-09 07:50:48'),
(3, 1, 1, 0, '2024-01-09 07:58:29', '2024-01-09 07:58:44'),
(4, 1, 2, 0, '2024-01-09 08:18:30', '2024-01-09 08:18:54'),
(5, 1, 1, 0, '2024-01-09 10:11:29', '2024-01-09 10:12:00'),
(6, 1, 1, 0, '2024-01-09 10:14:19', '2024-01-09 10:15:05'),
(7, 2, 2, 1, '2024-01-11 01:56:12', '2024-01-11 01:56:12');

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jsonPermission` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`id`, `jsonPermission`, `created_at`, `updated_at`) VALUES
(1, '{\"users\":{\"showUsers\":1,\"addUser\":1,\"addUserPermission\":1,\"usersPage\":1,\"deleteUser\":1,\"updateUser\":1,\"0\":null,\"dsafweqr\":0,\"1\":0},\"permission\":{\"permissionPage\":1,\"addPermission\":1,\"addAction\":1,\"showPermission\":1},\"htmlCode\":{\"htmlCodePage\":1,\"0\":\"dasfasdf\"},\"sdafasdf\":{\"sdafsdaf\":0},\"test\":{\"asdfasdf\":0},\"testd\":{\"asdfasdf\":0,\"dzvdxzcvcxvz\":0},\"sdsadf\":{\"dsaf\":0},\"jkhjkhjkh\":{\"uhjkhjgh\":0},\"asdf\":{\"sdaf\":0},\"sdaf\":{\"fsadfsdaf\":0},\"fgjhhgj\":{\"fgjhhgfj\":0,\"jfjffgjgfj\":0,\"hjfghfj\":0,\"fjfghjf\":0,\"ghjhfjghf\":0}}', '2024-01-10 10:15:19', '2024-01-10 09:12:21');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `type_of_user`
--

CREATE TABLE `type_of_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `type_of_user`
--

INSERT INTO `type_of_user` (`id`, `type`, `created_at`, `updated_at`) VALUES
(1, 'doctor', NULL, NULL),
(2, 'test', '2024-01-10 09:46:42', '2024-01-10 09:46:42'),
(3, 'testh', '2024-01-10 09:54:36', '2024-01-10 09:54:36'),
(4, 'testhd', '2024-01-10 09:55:44', '2024-01-10 09:55:44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `userName`, `email`, `type`, `isAdmin`, `status`, `password`, `token`, `created_at`, `updated_at`) VALUES
(1, 'Mohammad', 'Nawasrah', 'nawasrah', 'nawasrah@gmail.com', '1', 1, 1, '0cc138f8cb3f267360cd471a15deed69', 'bmF3YXNyYWgwNDk5MTI3Mzc4NTA4OGNhZTA3NTE2Y2U3ZTRiYjhjNw==', '2024-01-09 07:34:14', '2024-01-11 01:52:38'),
(2, 'Mohammad', 'Nawasrah', 'nawasrah_', 'dasfj@n.gmail.com', '1', 1, 1, '0cc138f8cb3f267360cd471a15deed69', NULL, '2024-01-10 10:09:53', '2024-01-10 10:09:53'),
(3, 'moham', 'asdf', 'asdfdsadf', 'sdfasdafsa@gd.com', '1', 1, 1, '81bf26e8ad6a78c183da31998a4e724b', NULL, '2024-01-10 10:12:54', '2024-01-10 10:12:54'),
(4, 'asdjflk', 'lksdajfkj', 'asdklfjlkasdj', 'dasfj@n.gmail.com', '1', 1, 1, '0debf8296d45f57037cc225ee2af7008', NULL, '2024-01-10 10:13:47', '2024-01-10 10:13:47');

-- --------------------------------------------------------

--
-- Table structure for table `user_permission`
--

CREATE TABLE `user_permission` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `userId` int(11) NOT NULL,
  `jsonPermission` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_permission`
--

INSERT INTO `user_permission` (`id`, `userId`, `jsonPermission`, `created_at`, `updated_at`) VALUES
(1, 1, '{\"users\":{\"showUsers\":1,\"addUser\":1,\"addUserPermission\":1,\"usersPage\":1,\"deleteUser\":1,\"updateUser\":1},\"permission\":{\"permissionPage\":1,\"addPermission\":1,\"addAction\":1,\"showPermission\":1},\"htmlCode\":{\"htmlCodePage\":1}}', '2024-01-06 07:08:01', '2024-01-06 08:39:09'),
(2, 3, '{\"users\":{\"0\":0,\"1\":0,\"showUsers\":0,\"addUser\":0,\"addUserPermission\":1,\"usersPage\":1,\"deleteUser\":1,\"updateUser\":1,\"dsafweqr\":1},\"permission\":{\"permissionPage\":1,\"addPermission\":1,\"addAction\":1,\"showPermission\":1},\"htmlCode\":{\"0\":0,\"htmlCodePage\":1},\"sdafasdf\":{\"sdafsdaf\":0},\"test\":{\"asdfasdf\":0},\"testd\":{\"asdfasdf\":0,\"dzvdxzcvcxvz\":0},\"sdsadf\":{\"dsaf\":0},\"jkhjkhjkh\":{\"uhjkhjgh\":0},\"asdf\":{\"sdaf\":0},\"sdaf\":{\"fsadfsdaf\":0},\"fgjhhgj\":{\"fgjhhgfj\":0,\"jfjffgjgfj\":0,\"hjfghfj\":0,\"fjfghjf\":0,\"ghjhfjghf\":0}}', '2024-01-10 10:22:32', '2024-01-10 10:22:32'),
(3, 4, '{\"users\":{\"0\":0,\"1\":0,\"showUsers\":1,\"addUser\":1,\"addUserPermission\":1,\"usersPage\":1,\"deleteUser\":1,\"updateUser\":1,\"dsafweqr\":0},\"permission\":{\"permissionPage\":1,\"addPermission\":0,\"addAction\":0,\"showPermission\":1},\"htmlCode\":{\"0\":0,\"htmlCodePage\":1},\"sdafasdf\":{\"sdafsdaf\":0},\"test\":{\"asdfasdf\":0},\"testd\":{\"asdfasdf\":0,\"dzvdxzcvcxvz\":0},\"sdsadf\":{\"dsaf\":0},\"jkhjkhjkh\":{\"uhjkhjgh\":0},\"asdf\":{\"sdaf\":0},\"sdaf\":{\"fsadfsdaf\":0},\"fgjhhgj\":{\"fgjhhgfj\":0,\"jfjffgjgfj\":0,\"hjfghfj\":0,\"fjfghjf\":0,\"ghjhfjghf\":0}}', '2024-01-10 10:22:42', '2024-01-10 10:22:42'),
(4, 2, '{\"users\":{\"0\":0,\"1\":0,\"showUsers\":1,\"addUser\":1,\"addUserPermission\":1,\"usersPage\":1,\"deleteUser\":1,\"updateUser\":1,\"dsafweqr\":0},\"permission\":{\"permissionPage\":1,\"addPermission\":1,\"addAction\":1,\"showPermission\":1},\"htmlCode\":{\"0\":1,\"htmlCodePage\":1},\"sdafasdf\":{\"sdafsdaf\":0},\"test\":{\"asdfasdf\":0},\"testd\":{\"asdfasdf\":0,\"dzvdxzcvcxvz\":0},\"sdsadf\":{\"dsaf\":0},\"jkhjkhjkh\":{\"uhjkhjgh\":0},\"asdf\":{\"sdaf\":0},\"sdaf\":{\"fsadfsdaf\":0},\"fgjhhgj\":{\"fgjhhgfj\":0,\"jfjffgjgfj\":0,\"hjfghfj\":0,\"fjfghjf\":0,\"ghjhfjghf\":0}}', '2024-01-10 10:29:12', '2024-01-10 10:29:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `html_code`
--
ALTER TABLE `html_code`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `patients_phonenumber_unique` (`phoneNumber`);

--
-- Indexes for table `patient_appointments`
--
ALTER TABLE `patient_appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_appointments_patientid_foreign` (`patientId`);

--
-- Indexes for table `patient_records`
--
ALTER TABLE `patient_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_to_doctor`
--
ALTER TABLE `patient_to_doctor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_to_doctor_userid_foreign` (`userId`),
  ADD KEY `patient_to_doctor_patientid_foreign` (`patientId`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `type_of_user`
--
ALTER TABLE `type_of_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`userName`);

--
-- Indexes for table `user_permission`
--
ALTER TABLE `user_permission`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `html_code`
--
ALTER TABLE `html_code`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `patient_appointments`
--
ALTER TABLE `patient_appointments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `patient_records`
--
ALTER TABLE `patient_records`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `patient_to_doctor`
--
ALTER TABLE `patient_to_doctor`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `type_of_user`
--
ALTER TABLE `type_of_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_permission`
--
ALTER TABLE `user_permission`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `patient_appointments`
--
ALTER TABLE `patient_appointments`
  ADD CONSTRAINT `patient_appointments_patientid_foreign` FOREIGN KEY (`patientId`) REFERENCES `patients` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `patient_records`
--
ALTER TABLE `patient_records`
  ADD CONSTRAINT `patient_records_patientid_foreign` FOREIGN KEY (`patientId`) REFERENCES `patients` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `patient_to_doctor`
--
ALTER TABLE `patient_to_doctor`
  ADD CONSTRAINT `patient_to_doctor_patientid_foreign` FOREIGN KEY (`patientId`) REFERENCES `patients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `patient_to_doctor_userid_foreign` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
-- phpMyAdmin SQL Dump
-- version 5.2.1deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 06, 2024 at 07:33 PM
-- Server version: 10.11.6-MariaDB-1
-- PHP Version: 8.2.12

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
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `htmlCodeForPage`
--

CREATE TABLE `htmlCodeForPage` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pageName` varchar(255) NOT NULL,
  `actionName` varchar(255) NOT NULL,
  `htmlCode` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `htmlCodeForPage`
--

INSERT INTO `htmlCodeForPage` (`id`, `pageName`, `actionName`, `htmlCode`, `created_at`, `updated_at`) VALUES
(1, 'permission', 'addAction', '<button class=\"btn btn-success\" id=\"addActionShowModalButton\" data-toggle=\"modal\" data-target=\"#addNewActionModal\">Add Action</button>  \n            <div class=\"modal fade\" id=\"addNewActionModal\" tabindex=\"-1\" aria-hidden=\"true\">\n            <div class=\"modal-dialog\">\n                <div class=\"modal-content add\">\n                    <div class=\"modal-header\">\n                        <h5 class=\"modal-title\" id=\"showModalLabel\">Add Action</h5>\n                        <button type=\"button\" class=\"btn-close\" data-dismiss=\"modal\" aria-label=\"Close\"></button>\n                    </div>\n                    <div class=\"modal-body\" id=\"showModalBody\">\n                        <div class=\"mb-3\">\n                            <div class=\" row mb-3\" style=\"display: flex; justify-content: center;\">\n                                <select class=\"form-select mb-3\" id=\"PageNameToAddAction\" aria-label=\"Default select example\">\n                                </select>\n                            </div>\n                            <div class=\"mb-3\" id=\"actionInputs\">\n                                <input type=\"text\" class=\"form-control mb-4\" id=\"inputField1\" placeholder=\"Action\">\n                            </div>\n                            <div id=\"addActionsMessage\" class=\"alert  d-none\" role=\"alert\">\n                            </div>\n                            <div class=\"row\" style=\"display: flex;justify-content: space-around;\">\n                                <div>\n                                    <button id=\"removeActionInput\" class=\"btn btn-danger\"><i class=\"bi bi-dash\"></i></button>\n                                </div>\n                            <div style=\"display: flex;justify-content: center ;align-items: center; flex-direction: column; text-align: center;\">\n                                <div>\n                                    <button id=\"addActionToPageName\" class=\"btn btn-success\">add New Action</button>\n                                </div>\n</div>\n\n                                <div>\n                                    <button id=\"addActionInput\" class=\"btn btn-primary\"><i class=\"bi bi-plus\"></i></button>\n                                </div>\n\n                            </div>\n                        </div>\n                    </div>\n                </div>\n            </div>\n            </div>', '2024-01-06 13:13:27', '2024-01-06 14:49:56'),
(2, 'permission', 'addPermission', '<button class=\"btn btn-primary\"  data-toggle=\"modal\" data-target=\"#addNewPermissionModal\">Add Parmission</button>\n            <div class=\"modal fade\" id=\"addNewPermissionModal\" tabindex=\"-1\" aria-labelledby=\"addNewPermissionModalLabel\" aria-hidden=\"true\">\n            <div class=\"modal-dialog modal-dialog-scrollable\">\n                <div class=\"modal-content add\">\n                    <div class=\"modal-header\">\n                        <h5 class=\"modal-title\" id=\"addNewPermissionModalLabel\">Fill the information</h5>\n                        <button type=\"button\" class=\"btn-close\" data-dismiss=\"modal\" aria-label=\"Close\"></button>\n                    </div>\n                    <div class=\"modal-body \">\n                        <div class=\"mb-3\">\n                            <input type=\"text\" class=\"form-control \" id=\"PageNameToAddPermission\" placeholder=\"Page Name\" required>\n                        </div>\n                        <div class=\"mb-3\" id=\"permissionInputs\">\n                            <input type=\"text\" class=\"form-control mb-3\" placeholder=\"Action Name\" required>\n                        </div>\n                        <div id=\"addPermissionMessage\" class=\"alert d-none\" role=\"alert\">\n                        </div>\n                        <div class=\"row\" style=\"display: flex;justify-content: space-around;\">\n                            <div>\n                                <button id=\"removePermissionInput\" class=\"btn btn-danger\"><i class=\"bi bi-dash\"></i></button>\n                            </div>\n                            <div style=\"display: flex;justify-content: center ;align-items: center; flex-direction: column; text-align: center;\">\n\n                            <div>\n                                <button id=\"addPermission\" class=\"btn btn-success\">add New Permission</button>\n                            </div>\n</div>\n                            <div>\n                                <button id=\"addPermissionInput\" class=\"btn btn-success\"><i class=\"bi bi-plus\"></i></button>\n                            </div>\n                        </div>\n                    </div>\n                </div>\n            </div>\n            </div>', '2024-01-06 13:14:22', '2024-01-06 14:51:07'),
(3, 'permission', 'showPermission', '<table class=\"table table-bordered\">\n            <thead class=\"table-bordered-custom\">\n                <tr>\n                    <th scope=\"col\" class=\"col-4\" style=\"padding-left: 5%;\">Page Name</th>\n                    <th scope=\"col\" class=\"col-3\" style=\"padding-left: 5%;\">Actions</th>\n                </tr>\n            </thead>\n            <tbody id=\"permissionTableBody\">\n            </tbody>\n            </table>', '2024-01-06 13:14:59', '2024-01-06 12:54:17'),
(4, 'dashboard', 'permissionPage', '<a class=\"nav-link hover-link\" data-url=\"permissions\" href=\"http://localhost/dashboard/permissions\">\n        <div class=\"menu-btn\">\n            <p class=\"menu-text\"><i class=\"bi bi-key custom-icon\"></i>Permission</p>\n        </div>\n                </a>', '2024-01-06 13:17:13', '2024-01-06 13:00:55'),
(5, 'dashboard', 'usersPage', '<a class=\"nav-link hover-link\" data-url=\"users\" href=\"http://localhost/dashboard/users\">\n                <div class=\"menu-btn\">\n                    <p class=\"menu-text\"><i class=\"bi bi-person custom-icon\"></i>Users Page</p>\n                </div>\n            </a>', '2024-01-06 13:17:46', '2024-01-06 14:08:12'),
(6, 'users', 'addUser', '<button class=\"btn btn-primary\" data-bs-toggle=\"modal\" data-bs-target=\"#addNewUserModal\">\n                    Add User\n                </button>\n                <div class=\"modal fade\" id=\"addNewUserModal\" tabindex=\"-1\" aria-labelledby=\"addNewUserModalLabel\" aria-hidden=\"true\">\n                    <div class=\"modal-dialog modal-dialog-scrollable\">\n                        <div class=\"modal-content\">\n                            <div class=\"modal-header\">\n                                <h5 class=\"modal-title\" id=\"addNewUserModalLabel\">Add User</h5>\n                            </div>\n                            <div class=\"modal-body\">\n                                <form id=\"addNewUserForm\">\n                                    <div class=\"mb-3\">\n                                        <div class=\"row\">\n                                            <div class=\"col\">\n                                                <input type=\"text\" class=\"form-control \" id=\"firstNameInput\" placeholder=\"First Name\" required>\n                                            </div>\n                                            <div class=\"col\">\n                                                <input type=\"text\" class=\"form-control \" id=\"lastNameInput\" placeholder=\"Last Name\" required>\n                                            </div>\n                                        </div>\n                                    </div>\n                                    <div class=\"mb-3\">\n                                        <div class=\"row\">\n                                            <div class=\"col\">\n                                                <input type=\"text\" class=\"form-control\" id=\"userNameInput\" placeholder=\"User Name\" required>\n                                            </div>\n                                            <div class=\"col\">\n                                                <input type=\"email\" class=\"form-control\" id=\"emailInput\" aria-describedby=\"emailHelp\" placeholder=\"Email\" required>\n                                            </div>\n                                        </div>\n                                    </div>\n                                    <div class=\"mb-3\">\n                                        <select style=\"background-color: white;border: none;outline: 1px solid black;border-radius: 2px;\" class=\"form-select form-select-sm\" aria-label=\"Small select example\" id=\"userTypeInput\" required>\n                                            <option selected>Choose an account type</option>\n                                            <option value=\"true\">Admin</option>\n                                            <option value=\"false\">User</option>\n                                        </select>\n                                    </div>\n                                    <div class=\"row\">\n                                        <div class=\"col\">\n                                            <input type=\"password\" class=\"form-control mb-3\" id=\"passwordInput\" placeholder=\"Enter your password\" required>\n                                        </div>\n                                        <div class=\"col\">\n                                            <input type=\"password\" class=\"form-control\" id=\"confirmPasswordInput\" placeholder=\"Confirm your password\" required>\n                                        </div>\n                                    </div>\n                                    <div class=\"custom-control custom-switch\">\n                                        <input type=\"checkbox\" class=\"custom-control-input\" id=\"customSwitches\">\n                                        <label class=\"custom-control-label\" for=\"customSwitches\">User Status</label>\n                                    </div>\n                            <div style=\"display: flex;justify-content: center ;align-items: center; flex-direction: column; text-align: center;\">\n                                    <div >\n                                        <button type=\"submit\" id=\"addNewUserButton\" class=\"btn btn-primary w-100\">Submit</button>\n   </div>\n\n                                    </div>\n                                </form>\n                            </div>\n                        </div>\n                    </div>\n                </div>', '2024-01-06 13:21:08', '2024-01-06 14:57:08'),
(7, 'users', 'usersTableShow', '<tr><td style=\"text-align: center;\">dsafdsa_</td>\n            <td style=\"display: flex;justify-content: space-evenly;\">\n             \n                <button class=\"btn btn-primary addPermissionsToUserModal\" data-user_name=\"dsafdsa_\"  data-toggle=\"tooltip\" data-bs-toggle=\"modal\" data-bs-target=\"#addPermissionToUserModal\"  data-placement=\"top\" title=\"Add Permission\"><i class=\"bi bi-plus\"></i></button>  <button class=\"btn btn-success\" data-toggle=\"tooltip\" data-user_name=\"dsafdsa_\" data-placement=\"top\" title=\"Update\"><i class=\"bi bi-arrow-down-up\"></i></button>  <button class=\"btn btn-danger\"  data-toggle=\"tooltip\" id=\"delteUserModalButton\" data-user_name=\"dsafdsa_\" data-placement=\"top\" title=\"Delete\"><i class=\"bi bi-trash\"></i></button></td></tr><tr><td style=\"text-align: center;\">_nawasrahd</td>\n            <td style=\"display: flex;justify-content: space-evenly;\">\n             \n                <button class=\"btn btn-primary addPermissionsToUserModal\" data-user_name=\"_nawasrahd\"  data-toggle=\"tooltip\" data-bs-toggle=\"modal\" data-bs-target=\"#addPermissionToUserModal\"  data-placement=\"top\" title=\"Add Permission\"><i class=\"bi bi-plus\"></i></button>  <button class=\"btn btn-success\" data-toggle=\"tooltip\" data-user_name=\"_nawasrahd\" data-placement=\"top\" title=\"Update\"><i class=\"bi bi-arrow-down-up\"></i></button>  <button class=\"btn btn-danger\"  data-toggle=\"tooltip\" id=\"delteUserModalButton\" data-user_name=\"_nawasrahd\" data-placement=\"top\" title=\"Delete\"><i class=\"bi bi-trash\"></i></button></td></tr><tr><td style=\"text-align: center;\">_ahmadd</td>\n            <td style=\"display: flex;justify-content: space-evenly;\">\n             \n                <button class=\"btn btn-primary addPermissionsToUserModal\" data-user_name=\"_ahmadd\"  data-toggle=\"tooltip\" data-bs-toggle=\"modal\" data-bs-target=\"#addPermissionToUserModal\"  data-placement=\"top\" title=\"Add Permission\"><i class=\"bi bi-plus\"></i></button>  <button class=\"btn btn-success\" data-toggle=\"tooltip\" data-user_name=\"_ahmadd\" data-placement=\"top\" title=\"Update\"><i class=\"bi bi-arrow-down-up\"></i></button>  <button class=\"btn btn-danger\"  data-toggle=\"tooltip\" id=\"delteUserModalButton\" data-user_name=\"_ahmadd\" data-placement=\"top\" title=\"Delete\"><i class=\"bi bi-trash\"></i></button></td></tr><tr><td style=\"text-align: center;\">_ahmaddf</td>\n            <td style=\"display: flex;justify-content: space-evenly;\">\n             \n                <button class=\"btn btn-primary addPermissionsToUserModal\" data-user_name=\"_ahmaddf\"  data-toggle=\"tooltip\" data-bs-toggle=\"modal\" data-bs-target=\"#addPermissionToUserModal\"  data-placement=\"top\" title=\"Add Permission\"><i class=\"bi bi-plus\"></i></button>  <button class=\"btn btn-success\" data-toggle=\"tooltip\" data-user_name=\"_ahmaddf\" data-placement=\"top\" title=\"Update\"><i class=\"bi bi-arrow-down-up\"></i></button>  <button class=\"btn btn-danger\"  data-toggle=\"tooltip\" id=\"delteUserModalButton\" data-user_name=\"_ahmaddf\" data-placement=\"top\" title=\"Delete\"><i class=\"bi bi-trash\"></i></button></td></tr><tr><td style=\"text-align: center;\">_ahmaddsaf</td>\n            <td style=\"display: flex;justify-content: space-evenly;\">\n             \n                <button class=\"btn btn-primary addPermissionsToUserModal\" data-user_name=\"_ahmaddsaf\"  data-toggle=\"tooltip\" data-bs-toggle=\"modal\" data-bs-target=\"#addPermissionToUserModal\"  data-placement=\"top\" title=\"Add Permission\"><i class=\"bi bi-plus\"></i></button>  <button class=\"btn btn-success\" data-toggle=\"tooltip\" data-user_name=\"_ahmaddsaf\" data-placement=\"top\" title=\"Update\"><i class=\"bi bi-arrow-down-up\"></i></button>  <button class=\"btn btn-danger\"  data-toggle=\"tooltip\" id=\"delteUserModalButton\" data-user_name=\"_ahmaddsaf\" data-placement=\"top\" title=\"Delete\"><i class=\"bi bi-trash\"></i></button></td></tr>', NULL, '2024-01-06 15:12:52'),
(8, 'dashboard', 'htmlCodePage', '<a class=\"nav-link hover-link\" data-url=\"htmlCodePage\" href=\"http://localhost/dashboard/htmlCodePage\">\n                <div class=\"menu-btn\">\n                    <p class=\"menu-text\"><i class=\"bi bi-braces custom-icon\"></i>Code</p>\n                </div>\n            </a>', '2024-01-06 14:03:55', '2024-01-06 15:21:26');

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
(26, '2024_01_01_200539_add_user_id_to_permission', 3),
(374, '2014_10_12_000000_create_users_table', 4),
(375, '2014_10_12_100000_create_password_reset_tokens_table', 4),
(376, '2019_08_19_000000_create_failed_jobs_table', 4),
(377, '2019_12_14_000001_create_personal_access_tokens_table', 4),
(378, '2024_01_01_200009_add_permission_table', 4),
(379, '2024_01_01_203506_user_permission', 4),
(380, '2024_01_03_182014_patients', 4),
(381, '2024_01_03_182206_patient_records', 4),
(382, '2024_01_03_182316_patient_appoinntments', 4),
(383, '2024_01_03_183618_patient_to_doctor', 4),
(384, '2024_01_06_113003_html_code_for_page', 4),
(385, '2024_01_06_114148_2024_01_06_113003_html_code_for_page', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patientAppointments`
--

CREATE TABLE `patientAppointments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patientId` bigint(20) UNSIGNED NOT NULL,
  `nextappointment` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patientRecords`
--

CREATE TABLE `patientRecords` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patientId` bigint(20) UNSIGNED NOT NULL,
  `patientNote` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `patientToDoctor`
--

CREATE TABLE `patientToDoctor` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `userId` bigint(20) UNSIGNED NOT NULL,
  `patientId` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '{\"users\":{\"showUsers\":0,\"addUser\":0,\"addUserPermission\":0,\"usersPage\":0,\"deleteUser\":0,\"updateUser\":0,\"test\":0},\"permission\":{\"permissionPage\":0,\"addPermission\":0,\"addAction\":0,\"showPermission\":0},\"htmlCode\":{\"htmlCodePage\":0}}', '2024-01-06 10:08:01', '2024-01-06 15:08:27');

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
-- Table structure for table `userPermission`
--

CREATE TABLE `userPermission` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `userId` int(11) NOT NULL,
  `jsonPermission` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `userPermission`
--

INSERT INTO `userPermission` (`id`, `userId`, `jsonPermission`, `created_at`, `updated_at`) VALUES
(1, 1, '{\"users\":{\"showUsers\":1,\"addUser\":1,\"addUserPermission\":1,\"usersPage\":1,\"deleteUser\":1,\"updateUser\":1},\"permission\":{\"permissionPage\":1,\"addPermission\":1,\"addAction\":1,\"showPermission\":1},\"htmlCode\":{\"htmlCodePage\":1}}', '2024-01-06 10:08:01', '2024-01-06 11:39:09'),
(2, 4, '{\"users\":{\"showUsers\":0,\"addUser\":0,\"addUserPermission\":0,\"usersPage\":0,\"deleteUser\":0,\"updateUser\":0,\"test\":0},\"permission\":{\"permissionPage\":0,\"addPermission\":0,\"addAction\":0,\"showPermission\":0},\"htmlCode\":{\"htmlCodePage\":0}}', '2024-01-06 15:13:12', '2024-01-06 15:13:12');

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

INSERT INTO `users` (`id`, `firstName`, `lastName`, `userName`, `email`, `isAdmin`, `status`, `password`, `token`, `created_at`, `updated_at`) VALUES
(1, 'Mohammad', 'Nawasrah', '_nawasrah', 'admin@gmail.com', 1, 0, '0cc138f8cb3f267360cd471a15deed69', 'X25hd2FzcmFoNGEyZTQxZjVlYjQ3ODhlZjdjNWYwYzEzMjZiYTdjMzE=', '2024-01-06 10:08:01', '2024-01-06 15:09:16'),
(2, 'moham', 'dsafdfsa', '_ahmad', 'dsafsd@dagds.dsaf', 1, 0, '0cc138f8cb3f267360cd471a15deed69', NULL, '2024-01-06 11:20:21', '2024-01-06 11:20:39'),
(3, 'fds', 'sfasd', '_ahmad_', 'sdaf@adf.hrty', 1, 0, '85d7ff6234531d8163ddaae4e7e673ee', NULL, '2024-01-06 15:01:24', '2024-01-06 15:12:50'),
(4, 'fdsafdsa', 'fsdafdsaf', 'dsafdsa_', 'dsafsd@dagds.dsaf', 1, 1, '0cc138f8cb3f267360cd471a15deed69', NULL, '2024-01-06 15:02:35', '2024-01-06 15:02:35'),
(5, 'dsaf', 'dsafdfsa', '_nawasrahd', 'moadsf@gmil.com', 1, 1, '0cc138f8cb3f267360cd471a15deed69', NULL, '2024-01-06 15:03:03', '2024-01-06 15:03:03'),
(6, 'dsaf', 'dsaf', '_ahmadd', 'nawasrahmohammad@dj.com', 1, 1, '0cc138f8cb3f267360cd471a15deed69', NULL, '2024-01-06 15:03:54', '2024-01-06 15:03:54'),
(7, 'dasf', 'adsf', '_ahmaddf', 'dsafsd@dagds.dsaf', 1, 1, '0cc138f8cb3f267360cd471a15deed69', NULL, '2024-01-06 15:06:16', '2024-01-06 15:06:16'),
(8, 'dsaf', 'dsafdfsa', '_ahmaddsaf', 'dsafsd@dagds.dsaf', 1, 1, '0cc138f8cb3f267360cd471a15deed69', NULL, '2024-01-06 15:06:47', '2024-01-06 15:06:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `htmlCodeForPage`
--
ALTER TABLE `htmlCodeForPage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `patientAppointments`
--
ALTER TABLE `patientAppointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patientappointments_patientid_foreign` (`patientId`);

--
-- Indexes for table `patientRecords`
--
ALTER TABLE `patientRecords`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patientrecords_patientid_foreign` (`patientId`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `patients_phonenumber_unique` (`phoneNumber`);

--
-- Indexes for table `patientToDoctor`
--
ALTER TABLE `patientToDoctor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patienttodoctor_userid_foreign` (`userId`),
  ADD KEY `patienttodoctor_patientid_foreign` (`patientId`);

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
-- Indexes for table `userPermission`
--
ALTER TABLE `userPermission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`userName`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `htmlCodeForPage`
--
ALTER TABLE `htmlCodeForPage`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=386;

--
-- AUTO_INCREMENT for table `patientAppointments`
--
ALTER TABLE `patientAppointments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patientRecords`
--
ALTER TABLE `patientRecords`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patientToDoctor`
--
ALTER TABLE `patientToDoctor`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `userPermission`
--
ALTER TABLE `userPermission`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `patientAppointments`
--
ALTER TABLE `patientAppointments`
  ADD CONSTRAINT `patientappointments_patientid_foreign` FOREIGN KEY (`patientId`) REFERENCES `patients` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `patientRecords`
--
ALTER TABLE `patientRecords`
  ADD CONSTRAINT `patientrecords_patientid_foreign` FOREIGN KEY (`patientId`) REFERENCES `patients` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `patientToDoctor`
--
ALTER TABLE `patientToDoctor`
  ADD CONSTRAINT `patienttodoctor_patientid_foreign` FOREIGN KEY (`patientId`) REFERENCES `patients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `patienttodoctor_userid_foreign` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

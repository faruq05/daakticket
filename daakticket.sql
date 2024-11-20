-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2024 at 05:06 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `daakticket`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_actions`
--

CREATE TABLE `admin_actions` (
  `action_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `action_description` text NOT NULL,
  `action_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `audit_log`
--

CREATE TABLE `audit_log` (
  `log_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `action` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_post`
--

CREATE TABLE `blog_post` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `feature_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blog_post`
--

INSERT INTO `blog_post` (`post_id`, `user_id`, `title`, `content`, `feature_image`, `created_at`, `updated_at`, `category_id`) VALUES
(32, 46, 'SpaceX Rocket ', 'SpaceX’s Starship, the ambitious brainchild of Elon Musk, recently took another step towards redefining space travel, with major tests showcasing its potential for reaching Mars and beyond. As Musk pushes the boundaries of aerospace technology, Starship represents the future he envisions: a fully reusable spacecraft capable of carrying large crews and heavy cargo across vast distances in our solar system. For many, it’s a marvel of human ingenuity—a symbol of how far private space exploration has come. However, with every bold step forward, skeptics question the readiness and safety of such an ambitious project.\r\n\r\nThere’s no doubt that Starship’s success would be a monumental leap for space exploration. It could transform the logistics of space travel, making it far more accessible than ever before. Imagine a future where missions to the Moon and Mars are not one-time events but routine journeys. SpaceX has already achieved remarkable milestones with its Falcon rockets and Dragon capsules, proving that private companies can lead the charge in space exploration. Starship’s potential to carry large payloads and host multiple missions has some experts calling it a game-changer in how we approach both scientific research and the long-discussed dream of human colonization of Mars.\r\n\r\nYet, Starship’s journey has not been without setbacks, and some question whether Musk’s vision is too grand. The repeated test explosions and delays have caused skepticism about the project\'s feasibility in the short term. Critics argue that the pursuit of ambitious deadlines—sometimes driven by Musk’s relentless pace—may compromise safety and efficiency. While SpaceX is known for its willingness to \"fail fast\" in the name of innovation, the stakes are much higher with Starship. It’s one thing to test small components or unmanned missions, but sending humans to deep space brings a level of risk that demands a cautious approach.\r\n\r\nIn the end, whether Starship will prove to be the revolution Musk promises or simply a high-stakes gamble remains to be seen. But one thing is certain: Elon Musk’s drive to expand the limits of what’s possible has reignited the public’s passion for space. Starship represents more than just a rocket; it’s a conversation starter, pushing humanity to ask big questions about our future beyond Earth. For now, as we watch the highs and lows of this daring project unfold, the world waits to see if Musk’s vision will carry us to new worlds or if some dreams are best approached with a more grounded view.', 'assets/uploads/post_images/post_1731909932_rocket-catcher-elon-musk.jpg', '2024-11-17 06:28:22', '2024-11-18 06:06:21', 1),
(34, 46, 'Exploring the World with Purpose', 'In today’s fast-paced world, travel has become more about ticking destinations off a list than truly experiencing them. The rise of social media has turned many trips into a quest for the perfect Instagram shot rather than an opportunity to connect with new cultures, people, and environments. Mindful travel is the antidote to this rush—a chance to slow down, immerse yourself, and create meaningful memories that go beyond the superficial.\r\n\r\nAt its core, mindful travel encourages us to be fully present in the moment. It’s about savoring the little details: the aroma of a local dish, the sound of unfamiliar languages, or the colors of a bustling marketplace. Instead of rushing to cover a dozen attractions in a day, mindful travelers focus on fewer activities but experience them deeply. Whether it’s spending a day learning about a community’s history or simply sitting by a quiet river, the quality of the experience takes precedence over quantity.\r\n\r\nAnother aspect of mindful travel is respecting the places and cultures you visit. This means being aware of how your actions impact the environment and local communities. Opting for eco-friendly accommodations, supporting local businesses, and learning basic phrases in the native language are small steps that make a big difference. Traveling mindfully not only enriches your journey but also ensures that future generations can enjoy these destinations.\r\n\r\nIn the end, mindful travel is a mindset shift. It’s about moving away from the pressure to do and see everything and instead embracing the joy of simply being. By traveling with intention, you’ll not only create more meaningful experiences but also return home with a deeper appreciation for the world and your place in it.', 'assets/uploads/post_images/post_1731918078_Exploring the World with Purpose.webp', '2024-11-18 08:21:18', '2024-11-18 08:21:18', 6),
(35, 46, 'Why Rest Is the New Productivity Hack', 'For years, the hustle culture glorified long hours and sleepless nights as the ultimate badge of success. But in recent times, a growing body of research has flipped the narrative, revealing a surprising truth: quality sleep is one of the most powerful productivity tools we have. As more people recognize the critical role rest plays in our mental and physical health, the “sleep revolution” is reshaping how we approach work and life.\r\n\r\nSleep isn’t just about recharging our bodies—it’s essential for cognitive function, creativity, and emotional well-being. Studies show that a good night’s rest enhances problem-solving skills, boosts memory, and reduces stress. In a world that demands constant mental agility, sacrificing sleep to “get ahead” often backfires, leading to burnout, decreased performance, and even long-term health issues.\r\n\r\nThe sleep revolution also challenges the stigma surrounding rest. Taking naps, setting boundaries for work hours, and prioritizing sleep hygiene are no longer seen as signs of laziness but as strategic moves to optimize overall well-being. From blackout curtains to white noise machines, people are investing in tools and routines to ensure they get the restorative sleep their bodies need.\r\n\r\nAs the narrative around rest continues to evolve, it’s clear that embracing sleep is not a step back—it’s a leap forward. Prioritizing rest isn’t just about feeling better; it’s about unlocking your full potential. In a world that’s always on, choosing to turn off and recharge might just be the smartest move you can make.', 'assets/uploads/post_images/post_1731918181_Why Rest Is the New Productivity Hack.webp', '2024-11-18 08:23:01', '2024-11-18 08:23:01', 6);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(8, 'Business & Entrepreneurship'),
(7, 'Education'),
(12, 'Entertainment'),
(14, 'Environment'),
(10, 'Fitness'),
(4, 'Food & Recipes'),
(2, 'Health & Wellness'),
(6, 'Lifestyle'),
(9, 'Parenting'),
(5, 'Personal Finance'),
(13, 'Politics'),
(11, 'Science'),
(15, 'Self Improvement'),
(1, 'Technology'),
(3, 'Travel');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `comment_text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `post_id`, `user_id`, `comment_text`, `created_at`) VALUES
(14, 35, 47, 'great article\r\n', '2024-11-18 09:22:34'),
(15, 34, 47, 'sc', '2024-11-18 09:41:05'),
(17, 32, 47, 'Elon gonna take over the world, and we are gpt developers', '2024-11-18 15:56:34');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `likes_id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `media_id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_type` varchar(50) DEFAULT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `permission_id` int(11) NOT NULL,
  `permission_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`permission_id`, `permission_name`) VALUES
(1, 'create_content'),
(3, 'delete_content'),
(2, 'edit_content'),
(4, 'manage_users');

-- --------------------------------------------------------

--
-- Table structure for table `post_history`
--

CREATE TABLE `post_history` (
  `history_id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `change_description` text DEFAULT NULL,
  `change_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post_history`
--

INSERT INTO `post_history` (`history_id`, `post_id`, `user_id`, `change_description`, `change_timestamp`) VALUES
(1, 32, 46, 'Updated post: SpaceX', '2024-11-18 04:08:33'),
(2, 32, 46, 'Updated post: SpaceX Rocket', '2024-11-18 05:56:10'),
(3, 32, 46, 'Updated post: SpaceX Rocket Unleash', '2024-11-18 06:05:32'),
(4, 32, 46, 'Updated post: SpaceX Rocket ', '2024-11-18 06:06:21');

-- --------------------------------------------------------

--
-- Table structure for table `post_tag`
--

CREATE TABLE `post_tag` (
  `post_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `report_id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `report_reason` text NOT NULL,
  `report_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`) VALUES
(1001, 'admin'),
(1002, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `role_permission`
--

CREATE TABLE `role_permission` (
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role_permission`
--

INSERT INTO `role_permission` (`role_id`, `permission_id`) VALUES
(1001, 1),
(1001, 2),
(1001, 3),
(1001, 4),
(1002, 1);

-- --------------------------------------------------------

--
-- Table structure for table `search_history`
--

CREATE TABLE `search_history` (
  `search_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `search_query` varchar(255) NOT NULL,
  `search_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `session_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `session_token` varchar(255) NOT NULL,
  `login_timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `logout_timestamp` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscriber`
--

CREATE TABLE `subscriber` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subscription_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subscriber`
--

INSERT INTO `subscriber` (`id`, `email`, `subscription_date`) VALUES
(2, 'solocreeper02@gmail.com', '2024-11-10 04:46:17'),
(3, 'faruqsan05@gmail.com', '2024-11-10 04:47:45'),
(4, 'syphon.bd.ofc@gmail.com', '2024-11-10 04:48:15'),
(5, 'hasib22134@gmail.com', '2024-11-10 13:27:54'),
(6, 'kaua@gmail.com', '2024-11-10 13:43:27'),
(7, 'hululu@hotmail.com', '2024-11-11 02:05:39'),
(8, 'omor6263@gmail.com', '2024-11-12 02:25:54');

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE `tag` (
  `tag_id` int(11) NOT NULL,
  `tag_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `role_id` int(11) DEFAULT 1002,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('active','inactive','banned') DEFAULT 'active',
  `reset_token_hash` varchar(64) DEFAULT NULL,
  `reset_token_expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `first_name`, `last_name`, `email`, `password_hash`, `created_at`, `role_id`, `registration_date`, `status`, `reset_token_hash`, `reset_token_expires_at`) VALUES
(43, 'galib99', 'Abdur', 'Galib', 'hasib22134@gmail.com', '$2y$10$qPUMfDF4jRqJ9Efy/yF92OEFlPCrXPSCXUN0.yy5pZLc3r2uUL/TW', '2024-11-16 07:11:08', 1002, '2024-11-16 07:11:08', 'active', NULL, NULL),
(45, 'daakticket', 'Daak', 'Ticket', 'daakticket05@gmail.com', '$2y$10$WZdaAleAj64M.jhwmR6ef.ca4JyT/rlO2.Rl9otO3L/NyH9neH31S', '2024-11-16 16:46:03', 1001, '2024-11-16 16:46:03', 'active', NULL, NULL),
(46, 'omor6263', 'Omor', 'Faruq', 'omor6263@gmail.com', '$2y$10$a18AJi9YuvuMfsynRA3rluda2M/EYAP5lc1i6cqp557O8CeGZnnnK', '2024-11-16 17:01:30', 1002, '2024-11-16 17:01:30', 'active', NULL, NULL),
(47, 'noor01', 'Abdullah', 'Noor', 'faruq05.fiverr@gmail.com', '$2y$10$sgK280NdVJqKt1j7Ny7QduTDDwBVTQ..V4VHhLLujbgySIXxuoxrm', '2024-11-18 09:00:29', 1002, '2024-11-18 09:00:29', 'active', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE `user_profile` (
  `profile_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `bio` text DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `facebook_link` varchar(255) DEFAULT NULL,
  `twitter_link` varchar(255) DEFAULT NULL,
  `instagram_link` varchar(255) DEFAULT NULL,
  `linkedin_link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`profile_id`, `user_id`, `first_name`, `last_name`, `email`, `bio`, `profile_picture`, `facebook_link`, `twitter_link`, `instagram_link`, `linkedin_link`) VALUES
(11, 43, 'Abdur', 'Galib', 'hasib22134@gmail.com', NULL, 'uploads/profile_pictures/profile_43.JPG', NULL, NULL, NULL, NULL),
(12, 45, 'Daak', 'Ticket', 'daakticket05@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL),
(13, 46, 'Omor', 'Faruq', 'omor6263@gmail.com', 'I can smell the failure', 'assets/uploads/profile_pictures/profile_46.png', '', '', '', ''),
(14, 47, 'Abdullah', 'Noor', 'faruq05.fiverr@gmail.com', NULL, 'assets/uploads/profile_pictures/profile_47.jpg', NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_actions`
--
ALTER TABLE `admin_actions`
  ADD PRIMARY KEY (`action_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `audit_log`
--
ALTER TABLE `audit_log`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `blog_post`
--
ALTER TABLE `blog_post`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `fk_category_id` (`category_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`likes_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`media_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`permission_id`),
  ADD UNIQUE KEY `permission_name` (`permission_name`);

--
-- Indexes for table `post_history`
--
ALTER TABLE `post_history`
  ADD PRIMARY KEY (`history_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `post_tag`
--
ALTER TABLE `post_tag`
  ADD PRIMARY KEY (`post_id`,`tag_id`),
  ADD KEY `tag_id` (`tag_id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`),
  ADD UNIQUE KEY `role_name` (`role_name`);

--
-- Indexes for table `role_permission`
--
ALTER TABLE `role_permission`
  ADD PRIMARY KEY (`role_id`,`permission_id`),
  ADD KEY `permission_id` (`permission_id`);

--
-- Indexes for table `search_history`
--
ALTER TABLE `search_history`
  ADD PRIMARY KEY (`search_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`session_id`),
  ADD UNIQUE KEY `session_token` (`session_token`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `subscriber`
--
ALTER TABLE `subscriber`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`tag_id`),
  ADD UNIQUE KEY `tag_name` (`tag_name`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username_2` (`username`),
  ADD UNIQUE KEY `reset_token_hash` (`reset_token_hash`),
  ADD KEY `fk_role_id` (`role_id`);

--
-- Indexes for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`profile_id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_actions`
--
ALTER TABLE `admin_actions`
  MODIFY `action_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `audit_log`
--
ALTER TABLE `audit_log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_post`
--
ALTER TABLE `blog_post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `likes_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `media_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `permission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `post_history`
--
ALTER TABLE `post_history`
  MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1004;

--
-- AUTO_INCREMENT for table `search_history`
--
ALTER TABLE `search_history`
  MODIFY `search_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `session`
--
ALTER TABLE `session`
  MODIFY `session_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscriber`
--
ALTER TABLE `subscriber`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
  MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `user_profile`
--
ALTER TABLE `user_profile`
  MODIFY `profile_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_actions`
--
ALTER TABLE `admin_actions`
  ADD CONSTRAINT `admin_actions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE SET NULL;

--
-- Constraints for table `audit_log`
--
ALTER TABLE `audit_log`
  ADD CONSTRAINT `audit_log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE SET NULL;

--
-- Constraints for table `blog_post`
--
ALTER TABLE `blog_post`
  ADD CONSTRAINT `blog_post_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `blog_post_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `blog_post` (`post_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE SET NULL;

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `blog_post` (`post_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE SET NULL;

--
-- Constraints for table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `blog_post` (`post_id`) ON DELETE CASCADE;

--
-- Constraints for table `post_history`
--
ALTER TABLE `post_history`
  ADD CONSTRAINT `post_history_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `blog_post` (`post_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_history_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE SET NULL;

--
-- Constraints for table `post_tag`
--
ALTER TABLE `post_tag`
  ADD CONSTRAINT `post_tag_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `blog_post` (`post_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_tag_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`tag_id`) ON DELETE CASCADE;

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `report_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `blog_post` (`post_id`) ON DELETE CASCADE;

--
-- Constraints for table `role_permission`
--
ALTER TABLE `role_permission`
  ADD CONSTRAINT `role_permission_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_permission_ibfk_2` FOREIGN KEY (`permission_id`) REFERENCES `permission` (`permission_id`) ON DELETE CASCADE;

--
-- Constraints for table `search_history`
--
ALTER TABLE `search_history`
  ADD CONSTRAINT `search_history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE SET NULL;

--
-- Constraints for table `session`
--
ALTER TABLE `session`
  ADD CONSTRAINT `session_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE SET NULL;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_role_id` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`) ON DELETE SET NULL;

--
-- Constraints for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD CONSTRAINT `user_profile_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

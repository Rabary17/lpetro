-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 26 mars 2019 à 11:56
-- Version du serveur :  5.7.24
-- Version de PHP :  7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `lpsa_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `app_user`
--

DROP TABLE IF EXISTS `app_user`;
CREATE TABLE IF NOT EXISTS `app_user` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `last_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `place_of_birth` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marital_status` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `conjoint_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nb_children` int(11) DEFAULT NULL,
  `address` longtext COLLATE utf8mb4_unicode_ci,
  `nationality` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `phone_number` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_88BDF3E992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_88BDF3E9A0D96FBF` (`email_canonical`),
  UNIQUE KEY `UNIQ_88BDF3E9C05FB297` (`confirmation_token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `app_user`
--

INSERT INTO `app_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`, `last_name`, `first_name`, `date_of_birth`, `place_of_birth`, `marital_status`, `conjoint_name`, `nb_children`, `address`, `nationality`, `profile_name`, `updated_at`, `phone_number`) VALUES
('2b20a7cf-9562-431a-b076-98c28c119019', 'haingo@gmail.com', 'haingo@gmail.com', 'haingo@gmail.com', 'haingo@gmail.com', 0, NULL, '$2y$13$pNUiT.E.mqoqwYIJtKPo/.9SHSYGjiIaQvTVxd/a2qSVMg8fdGjD6', NULL, 'X8AqsEzWROrjUEMaMmeyEcCb2Jfy2CimpGmpQS5TYTY', '2019-03-22 06:27:24', 'a:0:{}', 'haingo', 'mitia', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-03-22 06:07:35', NULL),
('380b9fe8-3426-4826-b9b2-3648288ae1da', 'fenitra@passion4humanity.com', 'fenitra@passion4humanity.com', 'fenitra@passion4humanity.com', 'fenitra@passion4humanity.com', 1, NULL, '$2y$13$UfoW8RgoiKEBJkRdUVUVUeCc3Y3jdYoNt7SBe09f0jnnBHLF3e6fm', '2019-03-21 06:10:26', NULL, NULL, 'a:0:{}', 'Son', 'Samuel', NULL, 'ISOTRY', 'M', 'RANJATO', NULL, NULL, NULL, '5c932c108ff83693124255.jpg', '2019-03-21 06:15:44', '+261343403434'),
('58c50360-836f-462f-b7b6-939fbc29bed8', 'test1@gmail.com', 'test1@gmail.com', 'test1@gmail.com', 'test1@gmail.com', 0, NULL, '$2y$13$NfRSUM56K1nwIIxhCGIeF.7HrNJWRIgums185amOBw/k2IwDfxt0i', NULL, 'PH_BtSrn7hYYe0YWnUodw9e3kzXB6viheuCWnOtjy5c', NULL, 'a:0:{}', 'test1', 'test1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-03-22 06:00:26', NULL),
('64fcca10-ac6a-4bae-87dd-c82dd80279f3', 'mitia@gmail.com', 'mitia@gmail.com', 'mitia@gmail.com', 'mitia@gmail.com', 0, NULL, '$2y$13$E0z7IbEy3Ow/7uiDcDprwud7JSF6ZfzjEniBPYRjc/9AHjeddmt0O', NULL, 'nayfpxHHf96Hw68UdVOrlYrYEBdKFLeeJ-1FJAGjYzo', NULL, 'a:0:{}', 'mitia', 'mitia', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-03-22 06:06:24', NULL),
('70e23b8f-fb88-47e5-bd64-d2b29e127b04', 'heriniaina@passion4humanity.com', 'heriniaina@passion4humanity.com', 'heriniaina@passion4humanity.com', 'heriniaina@passion4humanity.com', 1, NULL, '$2y$13$GrRZLyO9AJVdwcWcmrQtCekt/iCoSFhvwiR8hrR0F7cqLQPgBouEy', '2019-03-26 05:21:52', NULL, NULL, 'a:0:{}', 'Heriniaina', 'RAKOTOARIMANANA', '2019-03-07', 'MAHAMASINA', 'M', 'RAVAO', NULL, 'MAHAMASINA', 'MALAGASY', '5c938df992314596532881.jpg', '2019-03-21 13:13:29', '+261323203232'),
('72b9df88-aef3-489f-8713-44e09ef11481', 'ravaokely@gmail.com', 'ravaokely@gmail.com', 'ravaokely@gmail.com', 'ravaokely@gmail.com', 0, NULL, '$2y$13$g092Vk2rsqlFJynb.8mXJuymL2Paw5k60oovhlXaD6lbDxXmP6fB2', NULL, 'fvuXxQI9RhkPkxCDDHeGWmn6Uzp789y4YhXRSWZgdmA', NULL, 'a:0:{}', 'Kely', 'RAVAO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-03-22 06:05:25', NULL),
('9d80ebc0-e983-46f7-8492-acc860dbd7c3', 'test@gmail.com', 'test@gmail.com', 'test@gmail.com', 'test@gmail.com', 0, NULL, '$2y$13$tAsmCWKZIpMEi7/2Zk9dc.ZHuLtBGEqCCSeMRWVAWlb/oIgoUuihq', NULL, 'LtptmTxly96sqrTvES7w3zAchRY_jsdx_KLVjONQ_Hg', NULL, 'a:0:{}', 'test', 'test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-03-22 05:59:07', NULL),
('b3acd09d-4933-4179-be88-eb0c27b1a356', 'tata@gmail.com', 'tata@gmail.com', 'tata@gmail.com', 'tata@gmail.com', 1, NULL, '$2y$13$SX4UIhwOcyovdCpcjXEb1OTtZBgMWzTXD//KTb4whlPBG1UPI/Dea', '2019-03-22 06:11:55', NULL, NULL, 'a:0:{}', 'toto', 'tata', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-03-22 06:02:17', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `experience`
--

DROP TABLE IF EXISTS `experience`;
CREATE TABLE IF NOT EXISTS `experience` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `period` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `achievements` longtext COLLATE utf8mb4_unicode_ci,
  `others` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `IDX_590C103A76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `experience`
--

INSERT INTO `experience` (`id`, `user_id`, `period`, `position`, `status`, `company`, `achievements`, `others`) VALUES
(1, '70e23b8f-fb88-47e5-bd64-d2b29e127b04', 'Janvier 2015 - Mars 2019', 'Developpeur Web', 'Senior', 'PASSION 4 HUMANITY', '- Developpement siteweb\r\n- Developpement application Mobile\r\n- Developpment application Desktop', 'Technologies:\r\n -Jquery\r\n- C#\r\n- JEE'),
(2, '70e23b8f-fb88-47e5-bd64-d2b29e127b04', 'Mai 2010 - Décembre 2014', 'Developpeur Fullstack', 'Junior', 'NETUNIVERS', '- Création siteweb\r\n- Application mobile\r\n- Toutes', '- Milay');

-- --------------------------------------------------------

--
-- Structure de la table `extra_work_activity`
--

DROP TABLE IF EXISTS `extra_work_activity`;
CREATE TABLE IF NOT EXISTS `extra_work_activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `IDX_E2A2BF8FA76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `extra_work_activity`
--

INSERT INTO `extra_work_activity` (`id`, `user_id`, `name`, `description`) VALUES
(5, '70e23b8f-fb88-47e5-bd64-d2b29e127b04', 'tata', 'Tata rahely'),
(9, '70e23b8f-fb88-47e5-bd64-d2b29e127b04', 'testa', 'TESTABLE'),
(12, '70e23b8f-fb88-47e5-bd64-d2b29e127b04', 'tata', NULL),
(13, NULL, 'tdfdfdfd', 'fdfdfdf'),
(14, '70e23b8f-fb88-47e5-bd64-d2b29e127b04', 'tdfdfdfd', 'fdfdfdf');

-- --------------------------------------------------------

--
-- Structure de la table `hobby`
--

DROP TABLE IF EXISTS `hobby`;
CREATE TABLE IF NOT EXISTS `hobby` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `hobby`
--

INSERT INTO `hobby` (`id`, `name`) VALUES
(1, 'Cuisine'),
(2, 'Lecture'),
(3, 'Music'),
(4, 'Internet');

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
CREATE TABLE IF NOT EXISTS `migration_versions` (
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`) VALUES
('20190318114149'),
('20190318114356'),
('20190320104203'),
('20190320124840'),
('20190320125849'),
('20190321062136'),
('20190321073641'),
('20190321082203'),
('20190321114701'),
('20190321132940'),
('20190322085149'),
('20190322112932'),
('20190325054627'),
('20190326111630');

-- --------------------------------------------------------

--
-- Structure de la table `referenced_person`
--

DROP TABLE IF EXISTS `referenced_person`;
CREATE TABLE IF NOT EXISTS `referenced_person` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `experiences_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_1238DC76423DE140` (`experiences_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `referenced_person`
--

INSERT INTO `referenced_person` (`id`, `experiences_id`, `name`, `position`, `email`, `phone`) VALUES
(1, 1, 'RAVAO Marie', 'Chef de projet web', 'ched@projet.com', '+261343403434'),
(2, 1, 'Minosoa', 'Developpeur Odoo', 'oddoo@gmia.com', '+261320325847');

-- --------------------------------------------------------

--
-- Structure de la table `skill`
--

DROP TABLE IF EXISTS `skill`;
CREATE TABLE IF NOT EXISTS `skill` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `IDX_5E3DE477A76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `skill`
--

INSERT INTO `skill` (`id`, `user_id`, `title`, `description`) VALUES
(1, '70e23b8f-fb88-47e5-bd64-d2b29e127b04', 'Outils de versionning', 'Git'),
(2, '70e23b8f-fb88-47e5-bd64-d2b29e127b04', 'BI', 'Programation BI'),
(3, '70e23b8f-fb88-47e5-bd64-d2b29e127b04', 'Coaching', 'Coaching Basket');

-- --------------------------------------------------------

--
-- Structure de la table `sport`
--

DROP TABLE IF EXISTS `sport`;
CREATE TABLE IF NOT EXISTS `sport` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sport`
--

INSERT INTO `sport` (`id`, `name`) VALUES
(1, 'Basket'),
(2, 'Foot'),
(3, 'Volley'),
(4, 'Handball'),
(5, 'Alpinisme'),
(6, 'Hippisme');

-- --------------------------------------------------------

--
-- Structure de la table `training`
--

DROP TABLE IF EXISTS `training`;
CREATE TABLE IF NOT EXISTS `training` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `IDX_D5128A8FA76ED395` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `training`
--

INSERT INTO `training` (`id`, `user_id`, `name`, `description`) VALUES
('1', '70e23b8f-fb88-47e5-bd64-d2b29e127b04', 'Informatique', 'Formation en programmation informatique chez Cambridge University'),
('2', '70e23b8f-fb88-47e5-bd64-d2b29e127b04', 'Managment', 'Formation en managment d\'entreprise'),
('4', '70e23b8f-fb88-47e5-bd64-d2b29e127b04', 'Ressources Humaines', 'Formation sur la gestion de paie et la recherche de resources');

-- --------------------------------------------------------

--
-- Structure de la table `user_hobbies`
--

DROP TABLE IF EXISTS `user_hobbies`;
CREATE TABLE IF NOT EXISTS `user_hobbies` (
  `user_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hobby_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`hobby_id`),
  KEY `IDX_60C72A17A76ED395` (`user_id`),
  KEY `IDX_60C72A17322B2123` (`hobby_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user_hobbies`
--

INSERT INTO `user_hobbies` (`user_id`, `hobby_id`) VALUES
('70e23b8f-fb88-47e5-bd64-d2b29e127b04', 1),
('70e23b8f-fb88-47e5-bd64-d2b29e127b04', 3);

-- --------------------------------------------------------

--
-- Structure de la table `user_sports`
--

DROP TABLE IF EXISTS `user_sports`;
CREATE TABLE IF NOT EXISTS `user_sports` (
  `user_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sport_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`sport_id`),
  KEY `IDX_169BE221A76ED395` (`user_id`),
  KEY `IDX_169BE221AC78BCF8` (`sport_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user_sports`
--

INSERT INTO `user_sports` (`user_id`, `sport_id`) VALUES
('70e23b8f-fb88-47e5-bd64-d2b29e127b04', 1),
('70e23b8f-fb88-47e5-bd64-d2b29e127b04', 3),
('70e23b8f-fb88-47e5-bd64-d2b29e127b04', 6);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `experience`
--
ALTER TABLE `experience`
  ADD CONSTRAINT `FK_590C103A76ED395` FOREIGN KEY (`user_id`) REFERENCES `app_user` (`id`);

--
-- Contraintes pour la table `extra_work_activity`
--
ALTER TABLE `extra_work_activity`
  ADD CONSTRAINT `FK_E2A2BF8FA76ED395` FOREIGN KEY (`user_id`) REFERENCES `app_user` (`id`);

--
-- Contraintes pour la table `referenced_person`
--
ALTER TABLE `referenced_person`
  ADD CONSTRAINT `FK_1238DC76423DE140` FOREIGN KEY (`experiences_id`) REFERENCES `experience` (`id`);

--
-- Contraintes pour la table `skill`
--
ALTER TABLE `skill`
  ADD CONSTRAINT `FK_5E3DE477A76ED395` FOREIGN KEY (`user_id`) REFERENCES `app_user` (`id`);

--
-- Contraintes pour la table `training`
--
ALTER TABLE `training`
  ADD CONSTRAINT `FK_D5128A8FA76ED395` FOREIGN KEY (`user_id`) REFERENCES `app_user` (`id`);

--
-- Contraintes pour la table `user_hobbies`
--
ALTER TABLE `user_hobbies`
  ADD CONSTRAINT `FK_60C72A17322B2123` FOREIGN KEY (`hobby_id`) REFERENCES `hobby` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_60C72A17A76ED395` FOREIGN KEY (`user_id`) REFERENCES `app_user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `user_sports`
--
ALTER TABLE `user_sports`
  ADD CONSTRAINT `FK_169BE221A76ED395` FOREIGN KEY (`user_id`) REFERENCES `app_user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_169BE221AC78BCF8` FOREIGN KEY (`sport_id`) REFERENCES `sport` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

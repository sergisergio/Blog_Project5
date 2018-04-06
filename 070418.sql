-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:8889
-- Généré le :  Sam 07 Avril 2018 à 00:47
-- Version du serveur :  5.6.35
-- Version de PHP :  7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `Project5_OC`
--

-- --------------------------------------------------------

--
-- Structure de la table `Comment`
--

CREATE TABLE `Comment` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `member_pseudo` varchar(50) DEFAULT NULL,
  `content` text NOT NULL,
  `creation_date` datetime NOT NULL,
  `last_updated` datetime NOT NULL,
  `validation` tinyint(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Comment`
--

INSERT INTO `Comment` (`id`, `post_id`, `member_pseudo`, `content`, `creation_date`, `last_updated`, `validation`) VALUES
(1, 6, NULL, 'Pas mal l\'article !', '2018-03-29 19:00:00', '0000-00-00 00:00:00', 0),
(2, 6, 'Philippe', 'Oui je trouve aussi ! :-)\r\nCe post est-il modifié ???', '2018-03-30 12:50:25', '0000-00-00 00:00:00', 0),
(3, 6, 'Philou', 'Test ajout commentaire\r\nje vais essayer de modifier celui-là aussi !!!!!', '2018-03-30 12:50:59', '0000-00-00 00:00:00', 0),
(4, 6, 'OC', 'Bon a priori, je peux ajouter un commentaire mais faut juste régler le problème d\'Ajax...Ce serait intéressant...', '2018-03-30 12:54:11', '0000-00-00 00:00:00', 0),
(10, 6, 'Philippe', 'test admin', '2018-04-03 09:45:42', '0000-00-00 00:00:00', 0),
(11, 6, 'Philippe', 'new test modifié', '2018-04-03 09:51:40', '0000-00-00 00:00:00', 0),
(12, 6, 'philippe', 'hellooooooooo', '2018-04-03 09:52:09', '0000-00-00 00:00:00', 0),
(13, 6, 'philippe', 'hellooooooooo', '2018-04-03 12:24:14', '0000-00-00 00:00:00', 0),
(14, 6, 'Philippe', 'yeahhhh', '2018-04-03 12:25:36', '0000-00-00 00:00:00', 0),
(15, 6, 'philippe', 'uygkygkjvuk', '2018-04-03 12:33:18', '0000-00-00 00:00:00', 0),
(24, 6, 'Philippe', 'Test avant mentorat', '2018-04-04 01:10:56', '0000-00-00 00:00:00', 0),
(30, 6, 'phil', 'nouveau test\r\n', '2018-04-05 19:59:48', '0000-00-00 00:00:00', 0),
(31, 6, 'phil', 'pmlk:', '2018-04-05 20:00:09', '0000-00-00 00:00:00', 0),
(32, 6, 'john', 'fgjhb,n', '2018-04-06 00:19:26', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Structure de la table `Member`
--

CREATE TABLE `Member` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `pseudo` varchar(50) DEFAULT NULL,
  `password` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `registration_date` datetime DEFAULT NULL,
  `authorization` tinyint(5) NOT NULL,
  `confirmation_token` varchar(100) DEFAULT NULL,
  `avatar` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Member`
--

INSERT INTO `Member` (`id`, `first_name`, `last_name`, `pseudo`, `password`, `email`, `registration_date`, `authorization`, `confirmation_token`, `avatar`) VALUES
(2, 'peter', 'parker', 'spiderman', 'spiderman', 'spiderman@gmail.com', '2018-04-03 19:41:53', 2, '', ''),
(4, '', '', 'philippe', 'test', 'docsphilippe@gmail.com', '2018-04-06 10:36:14', 0, '', ''),
(5, '', '', 'phil', 'test', 'pppp@gmail.com', '2018-04-06 10:43:19', 0, '', ''),
(8, '', '', 'philou', 'test', 'ppppu@gmail.com', '2018-04-06 12:12:31', 0, '', ''),
(10, '', '', 'Batman', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'brucewayne@gmail.com', '2018-04-06 12:25:57', 0, '', ''),
(14, '', '', 'phili', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'ptraon1@gmail.com', '2018-04-06 15:22:08', 0, '', ''),
(37, '', '', 'sergisergio1', '8efd86fb78a56a5145ed7739dcb00c78581c5375', 'ptraon3@gmail.com', '2018-04-06 17:39:47', 0, '', ''),
(38, '', '', 'jjjlkj', '8efd86fb78a56a5145ed7739dcb00c78581c5375', 'jb@gmail.com', '2018-04-06 17:41:30', 0, '', ''),
(39, '', '', 'ppppp', '8efd86fb78a56a5145ed7739dcb00c78581c5375', 'pes@gmail.com', '2018-04-06 17:42:47', 0, '', ''),
(40, '', '', 'yugjh', 't', 'p@gmail.com', '2018-04-06 18:20:19', 0, '', ''),
(41, '', '', 't', 't', 'ptra@gmail.com', '2018-04-06 18:20:55', 0, '', ''),
(45, '', '', 'uygkhb', 'a', 'ptr@gmail.com', '2018-04-06 18:23:37', 0, '', ''),
(46, '', '', 'ounlj', 't', 'ptry@gmail.com', '2018-04-06 18:34:22', 0, '', ''),
(49, '', '', 'ij', '$2y$10$JlC3EXhAbFrLFg7l9jpHku.CaFhJUIjFoQc75GmJrgP/ypKNKk72G', 'a@gmail.com', '2018-04-06 18:48:21', 0, '', ''),
(55, '', '', 'sergisergioezdsx', '$2y$10$W7iZcyn/SYv7KHyVYChuuueZO7TKLK4sCoSTqVpEVc0E8Nm5hjNAG', 'ptraon24@gmail.com', '2018-04-06 23:01:19', 0, '', ''),
(56, '', '', 'sergisergio65', '$2y$10$bEJ3JtGtuX7YbTlmMctuWeOj3zTCc7YK0U..Ic/k1gAWWTsANiQ.u', 'ptraon24354@gmail.com', '2018-04-06 23:19:12', 0, '', '');

-- --------------------------------------------------------

--
-- Structure de la table `Post`
--

CREATE TABLE `Post` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `intro` varchar(200) NOT NULL,
  `content` longtext NOT NULL,
  `member_pseudo` varchar(50) DEFAULT NULL,
  `creation_date` datetime NOT NULL,
  `last_updated` datetime NOT NULL,
  `file_extension` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Post`
--

INSERT INTO `Post` (`id`, `title`, `intro`, `content`, `member_pseudo`, `creation_date`, `last_updated`, `file_extension`) VALUES
(1, 'Titre1', 'Morbo can\'t understand his teleprompter because he forgot how you say that letter that\'s shaped like a man wearing a hat. That\'s right, baby. I ain\'t your loverboy Flexo, the guy you love so much. You', 'Morbo can\'t understand his teleprompter because he forgot how you say that letter that\'s shaped like a man wearing a hat. That\'s right, baby. I ain\'t your loverboy Flexo, the guy you love so much. You even love anyone pretending to be him!\n\nWhat kind of a father would I be if I said no? Stop it, stop it. It\'s fine. I will \'destroy\' you! Good man. Nixon\'s pro-war and pro-family. Who are you, my warranty?!\n\nNo. We\'re on the top.\nI\'m a thing. You guys realize you live in a sewer, right? Hello Morbo, how\'s the family? Shut up and take my money!\n\nYou\'re going back for the Countess, aren\'t you?\nBender, this is Fry\'s decision… and he made it wrong. So it\'s time for us to interfere in his life.\nAnd remember, don\'t do anything that affects anything, unless it turns out you were supposed to, in which case, for the love of God, don\'t not do it!\nShe also liked to shut up!\nPansy. Large bet on myself in round one. There\'s no part of that sentence I didn\'t like! I could if you hadn\'t turned on the light and shut off my stereo.\n\nAlso Zoidberg.\nAre you crazy? I can\'t swallow that.\nNo, just a regular mistake.\nBite my shiny metal ass. Maybe I love you so much I love you no matter who you are pretending to be. I am the man with no name, Zapp Brannigan! Oh, I always feared he might run off like this. Why, why, why didn\'t I break his legs?\n\nBender, quit destroying the universe! Yes, if you make it look like an electrical fire. When you do things right, people won\'t be sure you\'ve done anything at all. We need rest. The spirit is willing, but the flesh is spongy and bruised.\n\nI don\'t know what you did, Fry, but once again, you screwed up! Now all the planets are gonna start cracking wise about our mamas. Really?! I barely knew Philip, but as a clergyman I have no problem telling his most intimate friends all about him.\n\nI wish! It\'s a nickel. There\'s one way and only one way to determine if an animal is intelligent. Dissect its brain! Ven ve voke up, ve had zese wodies. No argument here.\n\nOh, I always feared he might run off like this. Why, why, why didn\'t I break his legs? She also liked to shut up! You know, I was God once. I\'m Santa Claus! Whoa a real live robot; or is that some kind of cheesy New Year\'s costume?\n\nI feel like I was mauled by Jesus. Fetal stemcells, aren\'t those controversial? Daylight and everything. Oh no! The professor will hit me! But if Zoidberg \'fixes\' it… then perhaps gifts! You are the last hope of the universe.\n\nIt\'s a T. It goes \"tuh\". You seem malnourished. Are you suffering from intestinal parasites? What\'s with you kids? Every other day it\'s food, food, food. Alright, I\'ll get you some stupid food. I wish! It\'s a nickel.\n\nYou wouldn\'t. Ask anyway! Daddy Bender, we\'re hungry. I am the man with no name, Zapp Brannigan! Dear God, they\'ll be killed on our doorstep! And there\'s no trash pickup until January 3rd. So, how \'bout them Knicks?\n\nYou, a bobsleder!? That I\'d like to see! Stop it, stop it. It\'s fine. I will \'destroy\' you! And when we woke up, we had these bodies. Oh sure! Blame the wizards! Bender?! You stole the atom.\n\nA true inspiration for the children. Why did you bring us here? I daresay that Fry has discovered the smelliest object in the known universe! I\'ll get my kit! Kif, I have mated with a woman. Inform the men.\n\nFry, we have a crate to deliver. Negative, bossy meat creature! I\'m a thing. Why not indeed!', '', '2018-03-29 10:00:00', '0000-00-00 00:00:00', ''),
(2, 'Titre2', 'Morbo can\'t understand his teleprompter because he forgot how you say that letter that\'s shaped like a man wearing a hat. That\'s right, baby. I ain\'t your loverboy Flexo, the guy you love so much. You', 'Morbo can\'t understand his teleprompter because he forgot how you say that letter that\'s shaped like a man wearing a hat. That\'s right, baby. I ain\'t your loverboy Flexo, the guy you love so much. You even love anyone pretending to be him!\n\nWhat kind of a father would I be if I said no? Stop it, stop it. It\'s fine. I will \'destroy\' you! Good man. Nixon\'s pro-war and pro-family. Who are you, my warranty?!\n\nNo. We\'re on the top.\nI\'m a thing. You guys realize you live in a sewer, right? Hello Morbo, how\'s the family? Shut up and take my money!\n\nYou\'re going back for the Countess, aren\'t you?\nBender, this is Fry\'s decision… and he made it wrong. So it\'s time for us to interfere in his life.\nAnd remember, don\'t do anything that affects anything, unless it turns out you were supposed to, in which case, for the love of God, don\'t not do it!\nShe also liked to shut up!\nPansy. Large bet on myself in round one. There\'s no part of that sentence I didn\'t like! I could if you hadn\'t turned on the light and shut off my stereo.\n\nAlso Zoidberg.\nAre you crazy? I can\'t swallow that.\nNo, just a regular mistake.\nBite my shiny metal ass. Maybe I love you so much I love you no matter who you are pretending to be. I am the man with no name, Zapp Brannigan! Oh, I always feared he might run off like this. Why, why, why didn\'t I break his legs?\n\nBender, quit destroying the universe! Yes, if you make it look like an electrical fire. When you do things right, people won\'t be sure you\'ve done anything at all. We need rest. The spirit is willing, but the flesh is spongy and bruised.\n\nI don\'t know what you did, Fry, but once again, you screwed up! Now all the planets are gonna start cracking wise about our mamas. Really?! I barely knew Philip, but as a clergyman I have no problem telling his most intimate friends all about him.\n\nI wish! It\'s a nickel. There\'s one way and only one way to determine if an animal is intelligent. Dissect its brain! Ven ve voke up, ve had zese wodies. No argument here.\n\nOh, I always feared he might run off like this. Why, why, why didn\'t I break his legs? She also liked to shut up! You know, I was God once. I\'m Santa Claus! Whoa a real live robot; or is that some kind of cheesy New Year\'s costume?\n\nI feel like I was mauled by Jesus. Fetal stemcells, aren\'t those controversial? Daylight and everything. Oh no! The professor will hit me! But if Zoidberg \'fixes\' it… then perhaps gifts! You are the last hope of the universe.\n\nIt\'s a T. It goes \"tuh\". You seem malnourished. Are you suffering from intestinal parasites? What\'s with you kids? Every other day it\'s food, food, food. Alright, I\'ll get you some stupid food. I wish! It\'s a nickel.\n\nYou wouldn\'t. Ask anyway! Daddy Bender, we\'re hungry. I am the man with no name, Zapp Brannigan! Dear God, they\'ll be killed on our doorstep! And there\'s no trash pickup until January 3rd. So, how \'bout them Knicks?\n\nYou, a bobsleder!? That I\'d like to see! Stop it, stop it. It\'s fine. I will \'destroy\' you! And when we woke up, we had these bodies. Oh sure! Blame the wizards! Bender?! You stole the atom.\n\nA true inspiration for the children. Why did you bring us here? I daresay that Fry has discovered the smelliest object in the known universe! I\'ll get my kit! Kif, I have mated with a woman. Inform the men.\n\nFry, we have a crate to deliver. Negative, bossy meat creature! I\'m a thing. Why not indeed!', '', '2018-03-29 11:00:00', '0000-00-00 00:00:00', ''),
(3, 'Titre3', 'Morbo can\'t understand his teleprompter because he forgot how you say that letter that\'s shaped like a man wearing a hat. That\'s right, baby. I ain\'t your loverboy Flexo, the guy you love so much. You', 'Morbo can\'t understand his teleprompter because he forgot how you say that letter that\'s shaped like a man wearing a hat. That\'s right, baby. I ain\'t your loverboy Flexo, the guy you love so much. You even love anyone pretending to be him!\n\nWhat kind of a father would I be if I said no? Stop it, stop it. It\'s fine. I will \'destroy\' you! Good man. Nixon\'s pro-war and pro-family. Who are you, my warranty?!\n\nNo. We\'re on the top.\nI\'m a thing. You guys realize you live in a sewer, right? Hello Morbo, how\'s the family? Shut up and take my money!\n\nYou\'re going back for the Countess, aren\'t you?\nBender, this is Fry\'s decision… and he made it wrong. So it\'s time for us to interfere in his life.\nAnd remember, don\'t do anything that affects anything, unless it turns out you were supposed to, in which case, for the love of God, don\'t not do it!\nShe also liked to shut up!\nPansy. Large bet on myself in round one. There\'s no part of that sentence I didn\'t like! I could if you hadn\'t turned on the light and shut off my stereo.\n\nAlso Zoidberg.\nAre you crazy? I can\'t swallow that.\nNo, just a regular mistake.\nBite my shiny metal ass. Maybe I love you so much I love you no matter who you are pretending to be. I am the man with no name, Zapp Brannigan! Oh, I always feared he might run off like this. Why, why, why didn\'t I break his legs?\n\nBender, quit destroying the universe! Yes, if you make it look like an electrical fire. When you do things right, people won\'t be sure you\'ve done anything at all. We need rest. The spirit is willing, but the flesh is spongy and bruised.\n\nI don\'t know what you did, Fry, but once again, you screwed up! Now all the planets are gonna start cracking wise about our mamas. Really?! I barely knew Philip, but as a clergyman I have no problem telling his most intimate friends all about him.\n\nI wish! It\'s a nickel. There\'s one way and only one way to determine if an animal is intelligent. Dissect its brain! Ven ve voke up, ve had zese wodies. No argument here.\n\nOh, I always feared he might run off like this. Why, why, why didn\'t I break his legs? She also liked to shut up! You know, I was God once. I\'m Santa Claus! Whoa a real live robot; or is that some kind of cheesy New Year\'s costume?\n\nI feel like I was mauled by Jesus. Fetal stemcells, aren\'t those controversial? Daylight and everything. Oh no! The professor will hit me! But if Zoidberg \'fixes\' it… then perhaps gifts! You are the last hope of the universe.\n\nIt\'s a T. It goes \"tuh\". You seem malnourished. Are you suffering from intestinal parasites? What\'s with you kids? Every other day it\'s food, food, food. Alright, I\'ll get you some stupid food. I wish! It\'s a nickel.\n\nYou wouldn\'t. Ask anyway! Daddy Bender, we\'re hungry. I am the man with no name, Zapp Brannigan! Dear God, they\'ll be killed on our doorstep! And there\'s no trash pickup until January 3rd. So, how \'bout them Knicks?\n\nYou, a bobsleder!? That I\'d like to see! Stop it, stop it. It\'s fine. I will \'destroy\' you! And when we woke up, we had these bodies. Oh sure! Blame the wizards! Bender?! You stole the atom.\n\nA true inspiration for the children. Why did you bring us here? I daresay that Fry has discovered the smelliest object in the known universe! I\'ll get my kit! Kif, I have mated with a woman. Inform the men.\n\nFry, we have a crate to deliver. Negative, bossy meat creature! I\'m a thing. Why not indeed!', '', '2018-03-29 12:00:00', '0000-00-00 00:00:00', ''),
(4, 'Titre4', 'Morbo can\'t understand his teleprompter because he forgot how you say that letter that\'s shaped like a man wearing a hat. That\'s right, baby. I ain\'t your loverboy Flexo, the guy you love so much. You', 'Morbo can\'t understand his teleprompter because he forgot how you say that letter that\'s shaped like a man wearing a hat. That\'s right, baby. I ain\'t your loverboy Flexo, the guy you love so much. You even love anyone pretending to be him!\n\nWhat kind of a father would I be if I said no? Stop it, stop it. It\'s fine. I will \'destroy\' you! Good man. Nixon\'s pro-war and pro-family. Who are you, my warranty?!\n\nNo. We\'re on the top.\nI\'m a thing. You guys realize you live in a sewer, right? Hello Morbo, how\'s the family? Shut up and take my money!\n\nYou\'re going back for the Countess, aren\'t you?\nBender, this is Fry\'s decision… and he made it wrong. So it\'s time for us to interfere in his life.\nAnd remember, don\'t do anything that affects anything, unless it turns out you were supposed to, in which case, for the love of God, don\'t not do it!\nShe also liked to shut up!\nPansy. Large bet on myself in round one. There\'s no part of that sentence I didn\'t like! I could if you hadn\'t turned on the light and shut off my stereo.\n\nAlso Zoidberg.\nAre you crazy? I can\'t swallow that.\nNo, just a regular mistake.\nBite my shiny metal ass. Maybe I love you so much I love you no matter who you are pretending to be. I am the man with no name, Zapp Brannigan! Oh, I always feared he might run off like this. Why, why, why didn\'t I break his legs?\n\nBender, quit destroying the universe! Yes, if you make it look like an electrical fire. When you do things right, people won\'t be sure you\'ve done anything at all. We need rest. The spirit is willing, but the flesh is spongy and bruised.\n\nI don\'t know what you did, Fry, but once again, you screwed up! Now all the planets are gonna start cracking wise about our mamas. Really?! I barely knew Philip, but as a clergyman I have no problem telling his most intimate friends all about him.\n\nI wish! It\'s a nickel. There\'s one way and only one way to determine if an animal is intelligent. Dissect its brain! Ven ve voke up, ve had zese wodies. No argument here.\n\nOh, I always feared he might run off like this. Why, why, why didn\'t I break his legs? She also liked to shut up! You know, I was God once. I\'m Santa Claus! Whoa a real live robot; or is that some kind of cheesy New Year\'s costume?\n\nI feel like I was mauled by Jesus. Fetal stemcells, aren\'t those controversial? Daylight and everything. Oh no! The professor will hit me! But if Zoidberg \'fixes\' it… then perhaps gifts! You are the last hope of the universe.\n\nIt\'s a T. It goes \"tuh\". You seem malnourished. Are you suffering from intestinal parasites? What\'s with you kids? Every other day it\'s food, food, food. Alright, I\'ll get you some stupid food. I wish! It\'s a nickel.\n\nYou wouldn\'t. Ask anyway! Daddy Bender, we\'re hungry. I am the man with no name, Zapp Brannigan! Dear God, they\'ll be killed on our doorstep! And there\'s no trash pickup until January 3rd. So, how \'bout them Knicks?\n\nYou, a bobsleder!? That I\'d like to see! Stop it, stop it. It\'s fine. I will \'destroy\' you! And when we woke up, we had these bodies. Oh sure! Blame the wizards! Bender?! You stole the atom.\n\nA true inspiration for the children. Why did you bring us here? I daresay that Fry has discovered the smelliest object in the known universe! I\'ll get my kit! Kif, I have mated with a woman. Inform the men.\n\nFry, we have a crate to deliver. Negative, bossy meat creature! I\'m a thing. Why not indeed!', '', '2018-03-29 13:00:00', '0000-00-00 00:00:00', ''),
(5, 'Titre5', 'Morbo can\'t understand his teleprompter because he forgot how you say that letter that\'s shaped like a man wearing a hat. That\'s right, baby. I ain\'t your loverboy Flexo, the guy you love so much. You', 'Morbo can\'t understand his teleprompter because he forgot how you say that letter that\'s shaped like a man wearing a hat. That\'s right, baby. I ain\'t your loverboy Flexo, the guy you love so much. You even love anyone pretending to be him!\n\nWhat kind of a father would I be if I said no? Stop it, stop it. It\'s fine. I will \'destroy\' you! Good man. Nixon\'s pro-war and pro-family. Who are you, my warranty?!\n\nNo. We\'re on the top.\nI\'m a thing. You guys realize you live in a sewer, right? Hello Morbo, how\'s the family? Shut up and take my money!\n\nYou\'re going back for the Countess, aren\'t you?\nBender, this is Fry\'s decision… and he made it wrong. So it\'s time for us to interfere in his life.\nAnd remember, don\'t do anything that affects anything, unless it turns out you were supposed to, in which case, for the love of God, don\'t not do it!\nShe also liked to shut up!\nPansy. Large bet on myself in round one. There\'s no part of that sentence I didn\'t like! I could if you hadn\'t turned on the light and shut off my stereo.\n\nAlso Zoidberg.\nAre you crazy? I can\'t swallow that.\nNo, just a regular mistake.\nBite my shiny metal ass. Maybe I love you so much I love you no matter who you are pretending to be. I am the man with no name, Zapp Brannigan! Oh, I always feared he might run off like this. Why, why, why didn\'t I break his legs?\n\nBender, quit destroying the universe! Yes, if you make it look like an electrical fire. When you do things right, people won\'t be sure you\'ve done anything at all. We need rest. The spirit is willing, but the flesh is spongy and bruised.\n\nI don\'t know what you did, Fry, but once again, you screwed up! Now all the planets are gonna start cracking wise about our mamas. Really?! I barely knew Philip, but as a clergyman I have no problem telling his most intimate friends all about him.\n\nI wish! It\'s a nickel. There\'s one way and only one way to determine if an animal is intelligent. Dissect its brain! Ven ve voke up, ve had zese wodies. No argument here.\n\nOh, I always feared he might run off like this. Why, why, why didn\'t I break his legs? She also liked to shut up! You know, I was God once. I\'m Santa Claus! Whoa a real live robot; or is that some kind of cheesy New Year\'s costume?\n\nI feel like I was mauled by Jesus. Fetal stemcells, aren\'t those controversial? Daylight and everything. Oh no! The professor will hit me! But if Zoidberg \'fixes\' it… then perhaps gifts! You are the last hope of the universe.\n\nIt\'s a T. It goes \"tuh\". You seem malnourished. Are you suffering from intestinal parasites? What\'s with you kids? Every other day it\'s food, food, food. Alright, I\'ll get you some stupid food. I wish! It\'s a nickel.\n\nYou wouldn\'t. Ask anyway! Daddy Bender, we\'re hungry. I am the man with no name, Zapp Brannigan! Dear God, they\'ll be killed on our doorstep! And there\'s no trash pickup until January 3rd. So, how \'bout them Knicks?\n\nYou, a bobsleder!? That I\'d like to see! Stop it, stop it. It\'s fine. I will \'destroy\' you! And when we woke up, we had these bodies. Oh sure! Blame the wizards! Bender?! You stole the atom.\n\nA true inspiration for the children. Why did you bring us here? I daresay that Fry has discovered the smelliest object in the known universe! I\'ll get my kit! Kif, I have mated with a woman. Inform the men.\n\nFry, we have a crate to deliver. Negative, bossy meat creature! I\'m a thing. Why not indeed!', '', '2018-03-29 14:00:00', '0000-00-00 00:00:00', ''),
(6, 'Titre6 modifié', 'Morbo can\'t understand his teleprompter because he forgot how you say that letter that\'s shaped like a man wearing a hat. That\'s right, baby. I ain\'t your loverboy Flexo, the guy you love so much. You', 'Morbo can\'t understand his teleprompter because he forgot how you say that letter that\'s shaped like a man wearing a hat. That\'s right, baby. I ain\'t your loverboy Flexo, the guy you love so much. You even love anyone pretending to be him!\r\n\r\nWhat kind of a father would I be if I said no? Stop it, stop it. It\'s fine. I will \'destroy\' you! Good man. Nixon\'s pro-war and pro-family. Who are you, my warranty?!\r\n\r\nNo. We\'re on the top.\r\nI\'m a thing. You guys realize you live in a sewer, right? Hello Morbo, how\'s the family? Shut up and take my money!\r\n\r\nYou\'re going back for the Countess, aren\'t you?\r\nBender, this is Fry\'s decision… and he made it wrong. So it\'s time for us to interfere in his life.\r\nAnd remember, don\'t do anything that affects anything, unless it turns out you were supposed to, in which case, for the love of God, don\'t not do it!\r\nShe also liked to shut up!\r\nPansy. Large bet on myself in round one. There\'s no part of that sentence I didn\'t like! I could if you hadn\'t turned on the light and shut off my stereo.\r\n\r\nAlso Zoidberg.\r\nAre you crazy? I can\'t swallow that.\r\nNo, just a regular mistake.\r\nBite my shiny metal ass. Maybe I love you so much I love you no matter who you are pretending to be. I am the man with no name, Zapp Brannigan! Oh, I always feared he might run off like this. Why, why, why didn\'t I break his legs?\r\n\r\nBender, quit destroying the universe! Yes, if you make it look like an electrical fire. When you do things right, people won\'t be sure you\'ve done anything at all. We need rest. The spirit is willing, but the flesh is spongy and bruised.\r\n\r\nI don\'t know what you did, Fry, but once again, you screwed up! Now all the planets are gonna start cracking wise about our mamas. Really?! I barely knew Philip, but as a clergyman I have no problem telling his most intimate friends all about him.\r\n\r\nI wish! It\'s a nickel. There\'s one way and only one way to determine if an animal is intelligent. Dissect its brain! Ven ve voke up, ve had zese wodies. No argument here.\r\n\r\nOh, I always feared he might run off like this. Why, why, why didn\'t I break his legs? She also liked to shut up! You know, I was God once. I\'m Santa Claus! Whoa a real live robot; or is that some kind of cheesy New Year\'s costume?\r\n\r\nI feel like I was mauled by Jesus. Fetal stemcells, aren\'t those controversial? Daylight and everything. Oh no! The professor will hit me! But if Zoidberg \'fixes\' it… then perhaps gifts! You are the last hope of the universe.\r\n\r\nIt\'s a T. It goes \"tuh\". You seem malnourished. Are you suffering from intestinal parasites? What\'s with you kids? Every other day it\'s food, food, food. Alright, I\'ll get you some stupid food. I wish! It\'s a nickel.\r\n\r\nYou wouldn\'t. Ask anyway! Daddy Bender, we\'re hungry. I am the man with no name, Zapp Brannigan! Dear God, they\'ll be killed on our doorstep! And there\'s no trash pickup until January 3rd. So, how \'bout them Knicks?\r\n\r\nYou, a bobsleder!? That I\'d like to see! Stop it, stop it. It\'s fine. I will \'destroy\' you! And when we woke up, we had these bodies. Oh sure! Blame the wizards! Bender?! You stole the atom.\r\n\r\nA true inspiration for the children. Why did you bring us here? I daresay that Fry has discovered the smelliest object in the known universe! I\'ll get my kit! Kif, I have mated with a woman. Inform the men.\r\n\r\nFry, we have a crate to deliver. Negative, bossy meat creature! I\'m a thing. Why not indeed!', 'Philippe', '2018-04-03 20:08:42', '0000-00-00 00:00:00', ''),
(31, '7', '7', '7', '7', '2018-04-05 19:52:02', '0000-00-00 00:00:00', '');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `Comment`
--
ALTER TABLE `Comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `member_pseudo` (`member_pseudo`),
  ADD KEY `member_pseudo_2` (`member_pseudo`);

--
-- Index pour la table `Member`
--
ALTER TABLE `Member`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Memail` (`email`),
  ADD UNIQUE KEY `MPseudo` (`pseudo`),
  ADD KEY `pseudo` (`pseudo`);

--
-- Index pour la table `Post`
--
ALTER TABLE `Post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_pseudo` (`member_pseudo`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `Comment`
--
ALTER TABLE `Comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT pour la table `Member`
--
ALTER TABLE `Member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT pour la table `Post`
--
ALTER TABLE `Post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `Comment`
--
ALTER TABLE `Comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `Post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

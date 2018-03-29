-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:8889
-- Généré le :  Ven 30 Mars 2018 à 00:38
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
(2, 6, NULL, 'Oui je trouve aussi ! :-)', '2018-03-29 20:00:00', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Structure de la table `Member`
--

CREATE TABLE `Member` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` int(50) NOT NULL,
  `pseudo` varchar(50) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `registration_date` datetime NOT NULL,
  `authorization` tinyint(5) NOT NULL,
  `token` varchar(100) NOT NULL,
  `avatar` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(6, 'Titre6', 'Morbo can\'t understand his teleprompter because he forgot how you say that letter that\'s shaped like a man wearing a hat. That\'s right, baby. I ain\'t your loverboy Flexo, the guy you love so much. You', 'Morbo can\'t understand his teleprompter because he forgot how you say that letter that\'s shaped like a man wearing a hat. That\'s right, baby. I ain\'t your loverboy Flexo, the guy you love so much. You even love anyone pretending to be him!\n\nWhat kind of a father would I be if I said no? Stop it, stop it. It\'s fine. I will \'destroy\' you! Good man. Nixon\'s pro-war and pro-family. Who are you, my warranty?!\n\nNo. We\'re on the top.\nI\'m a thing. You guys realize you live in a sewer, right? Hello Morbo, how\'s the family? Shut up and take my money!\n\nYou\'re going back for the Countess, aren\'t you?\nBender, this is Fry\'s decision… and he made it wrong. So it\'s time for us to interfere in his life.\nAnd remember, don\'t do anything that affects anything, unless it turns out you were supposed to, in which case, for the love of God, don\'t not do it!\nShe also liked to shut up!\nPansy. Large bet on myself in round one. There\'s no part of that sentence I didn\'t like! I could if you hadn\'t turned on the light and shut off my stereo.\n\nAlso Zoidberg.\nAre you crazy? I can\'t swallow that.\nNo, just a regular mistake.\nBite my shiny metal ass. Maybe I love you so much I love you no matter who you are pretending to be. I am the man with no name, Zapp Brannigan! Oh, I always feared he might run off like this. Why, why, why didn\'t I break his legs?\n\nBender, quit destroying the universe! Yes, if you make it look like an electrical fire. When you do things right, people won\'t be sure you\'ve done anything at all. We need rest. The spirit is willing, but the flesh is spongy and bruised.\n\nI don\'t know what you did, Fry, but once again, you screwed up! Now all the planets are gonna start cracking wise about our mamas. Really?! I barely knew Philip, but as a clergyman I have no problem telling his most intimate friends all about him.\n\nI wish! It\'s a nickel. There\'s one way and only one way to determine if an animal is intelligent. Dissect its brain! Ven ve voke up, ve had zese wodies. No argument here.\n\nOh, I always feared he might run off like this. Why, why, why didn\'t I break his legs? She also liked to shut up! You know, I was God once. I\'m Santa Claus! Whoa a real live robot; or is that some kind of cheesy New Year\'s costume?\n\nI feel like I was mauled by Jesus. Fetal stemcells, aren\'t those controversial? Daylight and everything. Oh no! The professor will hit me! But if Zoidberg \'fixes\' it… then perhaps gifts! You are the last hope of the universe.\n\nIt\'s a T. It goes \"tuh\". You seem malnourished. Are you suffering from intestinal parasites? What\'s with you kids? Every other day it\'s food, food, food. Alright, I\'ll get you some stupid food. I wish! It\'s a nickel.\n\nYou wouldn\'t. Ask anyway! Daddy Bender, we\'re hungry. I am the man with no name, Zapp Brannigan! Dear God, they\'ll be killed on our doorstep! And there\'s no trash pickup until January 3rd. So, how \'bout them Knicks?\n\nYou, a bobsleder!? That I\'d like to see! Stop it, stop it. It\'s fine. I will \'destroy\' you! And when we woke up, we had these bodies. Oh sure! Blame the wizards! Bender?! You stole the atom.\n\nA true inspiration for the children. Why did you bring us here? I daresay that Fry has discovered the smelliest object in the known universe! I\'ll get my kit! Kif, I have mated with a woman. Inform the men.\n\nFry, we have a crate to deliver. Negative, bossy meat creature! I\'m a thing. Why not indeed!', '', '2018-03-29 15:00:00', '0000-00-00 00:00:00', '');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `Member`
--
ALTER TABLE `Member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `Post`
--
ALTER TABLE `Post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `Comment`
--
ALTER TABLE `Comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `Post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 27 fév. 2024 à 16:00
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mvc_php`
--

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `monstre_id` int(11) NOT NULL,
  `commentaire` varchar(255) NOT NULL,
  `posted_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`id`, `user_id`, `monstre_id`, `commentaire`, `posted_at`) VALUES
(2, 3, 17, 'Big Snake', '2024-02-27 09:36:09'),
(4, 3, 17, 'esfsefsefsef', '2024-02-27 09:36:09'),
(5, 3, 17, 'qzdzqdqzdqzdqzdzqd', '2024-02-27 09:36:09'),
(7, 4, 6, 'Comment ça va ?', '2024-02-27 09:36:09'),
(8, 2, 6, 'Grosse soir&eacute;e ce soir ?', '2024-02-27 09:36:09'),
(9, 3, 6, 'Let&#039;s go !!!', '2024-02-27 09:37:54'),
(10, 5, 29, 'A l&#039;aide !!! Il me victimise !!! HELPPPPPPP!!!!!!!!', '2024-02-27 13:42:50'),
(11, 3, 29, 'Mdr le noob !', '2024-02-27 15:50:10'),
(12, 5, 29, 'Ouai il a raison ! ouch !', '2024-02-27 15:50:51');

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sujet` varchar(40) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`id`, `user_id`, `sujet`, `message`) VALUES
(1, 3, 'Test', 'On test le contact');

-- --------------------------------------------------------

--
-- Structure de la table `monstre`
--

CREATE TABLE `monstre` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `categorie` varchar(50) NOT NULL,
  `short_description` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `img` varchar(255) NOT NULL,
  `created_At` datetime NOT NULL DEFAULT current_timestamp(),
  `last_Updated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `monstre`
--

INSERT INTO `monstre` (`id`, `nom`, `categorie`, `short_description`, `description`, `img`, `created_At`, `last_Updated`) VALUES
(5, 'Safi&#039;jiiva', 'Dragon ancien', 'Le Safi&#039;jiiva est un dragon ancien introduit dans Monster Hunter World: Iceborne. ', 'Sa forme v&eacute;ritable arbore des traits plus brutes avec des &eacute;cailles rouges, des cornes noires, un patagium beige, une queue et un dos couvert de piques, le rapprochant par certains points au Lao-Shan Lung. Ses yeux jaunes deviennent rouges lorsqu&#039;un chasseur a son attention. La forme du corps reste la m&ecirc;me que celle du Xeno&#039;jiiva, &agrave; l&#039;exception des ailes et de sa queue, plus fine et pointue. Son corps n&#039;&eacute;met plus de lueur bleue mais la couleur de ses rayons d&#039;&eacute;nergie reste la m&ecirc;me. Lorsqu&#039;il absorbe de l&#039;&eacute;nergie ou qu&#039;il est dans sa troisi&egrave;me phase, des t&acirc;ches lumineuses semblables &agrave; des constellations apparaissent sur ses ailes. ', './assets/mh_img/1708934466.jpg', '2024-02-26 09:01:06', '2024-02-26 09:01:06'),
(6, 'Astalos', 'Wyverne volante', 'L&#039;Astalos est une wyverne volante introduite dans Monster Hunter Generations dont il est l&#039;un des monstres phares. ', 'Le corps de l&#039;Astalos est presque enti&egrave;rement recouvert d&#039;&eacute;cailles, de couleur vert fonc&eacute;. Contrairement &agrave; toute autre wyverne volante, les ailes de l&#039;Astalos ressemblent &agrave; celles d&#039;un insecte. Ses jambes fines ont trois orteils. Sa queue est longue, et occupe pr&egrave;s de la moiti&eacute; de la longueur totale du monstre. Il a une t&ecirc;te relativement petite, avec une grande corne sur le dessus. Ses yeux sont rouges, et deviennent verts n&eacute;ons une fois sa t&ecirc;te charg&eacute;e. ', './assets/mh_img/1708935010.jpg', '2024-02-26 09:10:10', '2024-02-26 09:10:10'),
(7, 'Lagiacrus', 'Leviathan', 'Le Lagiacrus est un L&eacute;viathan qui vit principalement dans l&#039;oc&eacute;an ou les abysses et vient sur les plages pour prendre un bain de soleil. Le Lagiacrus est le monstre embl&eacute;matique de Monster Hunter Tri. ', 'Le Lagiacrus est un grand l&eacute;viathan poss&eacute;dant une t&ecirc;te munie de corne transmettant l&#039;&eacute;lectricit&eacute; ainsi qu&#039;une carapace munie de pointes qu&#039;il utilise aussi comme conducteur d&#039;&eacute;lectricit&eacute; ; sa cr&ecirc;te, plus &eacute;largie au niveau de son cou, absorbe les rayons lumineux.\r\nCette absorbance change la couleur de ses &eacute;cailles habituellement bleues vers une couleur plus gris&acirc;tre. De m&ecirc;me que ses pointes sur sa carapace et son cr&acirc;ne prennent une teinte rouge p&acirc;le, voire cuivr&eacute;.\r\nUne fois dans l&#039;eau, il reprend ses couleurs habituelles : sa couleur oc&eacute;an et des pointes beiges clairs. ', './assets/mh_img/1708935121.jpg', '2024-02-26 09:12:01', '2024-02-26 09:12:01'),
(8, 'Rathalos', 'Wyverne volante', 'Le Rathalos est une wyverne volante introduite pour la premi&egrave;re fois dans Monster Hunter. M&acirc;le de la Rathian, il est connu pour vivre dans une grande vari&eacute;t&eacute; de r&eacute;gions.', 'De taille moyenne, il est reconnaissable par sa morphologie (2 pattes et 2 ailes), sa couleur rouge cramoisie, ses ailes et queue bard&eacute;es de piques et son patagium comportant des motifs de flammes.\r\nIl est recouvert de plaques et d&#039;&eacute;cailles rouges et noires avec le dessous du corps et la membrane des ailes beiges. De chaque c&ocirc;t&eacute; de la m&acirc;choire, sous les oreilles, se trouvent des excroissances de plaques faisant penser &agrave; des mandibules d&#039;insecte. Les pattes ont des serres ac&eacute;r&eacute;es pouvant injecter du poison, et lui permettent de tuer et de saisir des proies, et la queue se termine en une massue &agrave; pointes.\r\nAu del&agrave; de son apparence de Wyverne, le Rathalos &eacute;voque aussi l&#039;aigle, autant par son museau crochu que par son statut de roi des cieux. ', './assets/mh_img/1708943479.jpg', '2024-02-26 09:13:10', '2024-02-26 11:31:19'),
(9, 'Basarios', 'Wyverne volante', 'Le Basarios est une wyverne volante introduite pour la premi&egrave;re fois dans Monster Hunter. C&#039;est la forme juv&eacute;nile du Gravios. ', 'Le Basarios est une wyverne volante de type rocheux. C&#039;est la forme juv&eacute;nile du Gravios. Si ses ailes, dont il ne peut pas se servir pour voler &agrave; cause de son poids, sont identiques &agrave; ce dernier, le reste de son corps est lui, diff&eacute;rent, notamment sa t&ecirc;te, orn&eacute;e de deux cr&ecirc;tes au lieu de la corne caract&eacute;ristique de sa forme adulte. Ces appendices tomberont et repousseront plusieurs fois au cours de sa croissance. L&#039;aspect de son dos reste quand &agrave; lui un myst&egrave;re : il est en permanence recouvert de rochers et de v&eacute;g&eacute;taux, ce qui lui permet &agrave; la fois de se prot&eacute;ger et de se camoufler. Une fois enterr&eacute;, seul son dos d&eacute;passant &agrave; la surface, on le confond facilement avec les rochers environnants : dans le Bois &eacute;ternel, tous ont un aspect proche de celui de l&#039;&eacute;chine du Basarios. Sa queue est courte, sans &eacute;pines et n&#039;a rien en commun avec son a&icirc;n&eacute;.', './assets/mh_img/1708937626.jpg', '2024-02-26 09:53:46', '2024-02-26 09:53:46'),
(10, 'Cephadrome ', 'Wyverne aquatique', 'Le Cephadrome est une wyverne aquatique introduite dans Monster Hunter. ', 'Le Cephadrome a des nageoires ros&acirc;tres et une peau &eacute;cailleuse bleue-violette mais elles apparaissent de couleur beige &agrave; cause du sable recouvrant son corps. Ses yeux sont jaunes. La t&ecirc;te de celui-ci est plate &agrave; la mani&egrave;re d&#039;un Sphyrna mokarran (wikip&eacute;dia). Sa queue l&#039;aide &agrave; se propulser &agrave; travers le sable.\r\n\r\nIl est sensiblement plus grand que les Cephalos indiquant qu&#039;il en est l&#039;alpha. ', './assets/mh_img/1708937752.jpg', '2024-02-26 09:55:52', '2024-02-26 09:55:52'),
(11, 'Diablos', 'Wyverne volante', 'Le Diablos est une wyverne volante introduit dans Monster Hunter. ', 'Le Diablos est recouvert d&#039;une carapace dure de couleur beige clair. Il est facilement reconnaissable par ses deux cornes protub&eacute;rantes sur la t&ecirc;te.\r\nSa t&ecirc;te est plus r&eacute;sistante que le reste du corps et est semblable &agrave; celle d&#039;un tric&eacute;ratops (wikip&eacute;dia). Sa m&acirc;choire comporte des dents apparentes, plut&ocirc;t pointues, dont deux grandes agissant comme des d&eacute;fenses. Sa queue se termine en une massue. ', './assets/mh_img/1708937935.jpg', '2024-02-26 09:58:55', '2024-02-26 09:58:55'),
(12, 'Gendrome', 'Wyverne rapace', 'Le Gendrome est une wyverne rapace introduite dans Monster Hunter.', 'Les chasseurs peuvent ais&eacute;ment identifier un Gendrome gr&acirc;ce &agrave; ses 2 grandes cr&ecirc;tes et sa taille plus imposante que celle des Genprey communs. ', './assets/mh_img/1708938117.jpg', '2024-02-26 10:01:57', '2024-02-26 10:01:57'),
(13, 'Gravios', 'Wyverne volante', 'Le Gravios est la forme mature du Basarios. C&#039;est l&#039;une des plus grosse wyverne volante, qui intimide facilement les chasseurs les moins exp&eacute;riment&eacute;s. Il a &eacute;t&eacute; introduit dans Monster Hunter. ', 'En raison de son poids, le Gravios ne peut pas voler pour changer de zone contrairement &agrave; la plupart des autres wyvernes : &agrave; la place, il marchera d&#039;une zone &agrave; l&#039;autre, ou nagera dans les tunnels cach&eacute;s sous la lave. Similaire au Basarios, il n&#039;utilise que ses ailes pour se sortir du p&eacute;trin, comme lorsqu&#039;il sort d&#039;une fosse pi&eacute;g&eacute;e ou quand il s&#039;est d&eacute;plac&eacute; hors des limites de la carte. Il poss&egrave;de une carapace solide, forg&eacute;e par la lave et qui agacera rapidement les &eacute;p&eacute;istes. Un bon tranchant est quasiment obligatoire. On peut lui briser sa carapace du ventre, ce qui rendra le combat beaucoup plus facile. Le Gravios &agrave; une apparence tr&egrave;s diff&eacute;rente de sa forme juv&eacute;nile, en effet, &agrave; la place des deux cr&ecirc;tes qu&#039;il portait sur sa t&ecirc;te, il poss&egrave;de une courte corne sur le museau, son dos, n&#039;&eacute;tant plus recouvert de rochers, est recouvert d&#039;une carapace dure et couverte de piques gros et courts, sa queue est longue et piquante, et non plus courte comme le Basarios. Cependant, comme ce dernier, il poss&egrave;de les m&ecirc;mes protub&eacute;rances sur ses cuisses.', './assets/mh_img/1708938231.jpg', '2024-02-26 10:03:51', '2024-02-26 10:03:51'),
(14, 'Gypceros', 'Wyverne rapace', 'Le Gypceros est une Wyverne rapace de taille moyenne tr&egrave;s connu pour son poison puissant et ses mani&egrave;res excentriques, typiques de l&#039;oiseau. Il est introduit pour la premi&egrave;re fois dans Monster Hunter. ', 'Le Gypceros est l&#039;une des plus grandes et des plus lourdes wyvernes rapaces connues. Ses caract&eacute;ristiques les plus notables sont sa cr&ecirc;te avec un cristal sur le dessus de sa t&ecirc;te et sa peau caoutchouteuse r&eacute;sistante aux chocs d&#039;un bleu-gris uniforme. Il a une longue queue rose avec une pointe en forme de bulbe. Il poss&egrave;de une poche de poison qui lui permet de produire des fluides toxiques contre les attaquants. ', './assets/mh_img/1708938454.jpg', '2024-02-26 10:07:34', '2024-02-26 10:07:34'),
(15, 'Khezu', 'Wyverne volante', 'Le Khezu est une wyverne volante introduite dans Monster Hunter.', 'Le Khezu est une wyverne volante &agrave; mi-chemin entre la sangsue et le dragon. Il poss&egrave;de une peau p&acirc;le, caoutchouteuse et constamment humide, comme celle d&#039;un amphibien. Beaucoup de ses vaisseaux sanguins peuvent &ecirc;tre vus &agrave; travers l&#039;&eacute;piderme. La peau est de plus munie d&#039;une couche de graisse qui prot&egrave;ge le Khezu du froid et lui permet de prolonger le temps qu&#039;il peut consacrer aux chasses. Elle est souvent recouverte d&#039;&eacute;gratinures, sans doute provoqu&eacute;es par les d&eacute;placements du monstre dans les r&eacute;seaux de cavernes o&ugrave; il habite.', './assets/mh_img/1708939584.jpg', '2024-02-26 10:26:24', '2024-02-26 10:26:24'),
(17, 'Dalamadur Shah', 'Dragon ancien', 'Le Dalamadur Shah est un dragon ancien et une sous-esp&egrave;ce du Dalamadur introduite dans Monster Hunter 4 Ultimate. ', 'Cette sous-esp&egrave;ce dispose d&#039;une peau plus claire, de couleur sable avec des &eacute;pines rouge-orange. Il est &agrave; peu pr&egrave;s de la m&ecirc;me taille que son homologue commun. A noter qu&#039; il peut enflammer une partie de la zone causant de graves br&ucirc;lures et de gros d&eacute;g&acirc;ts. ', './assets/mh_img/1708939844.jpg', '2024-02-26 10:30:44', '2024-02-26 10:30:44'),
(19, 'Fatalis', 'Dragon ancien', 'Le Fatalis est un dragon ancien introduit dans Monster Hunter dont il est le boss final de la campagne en ligne. ', 'Le Fatalis poss&egrave;de le design classique du dragon europ&eacute;en dans l&#039;imaginaire collectif avec une longue queue et un cou allong&eacute;, poss&eacute;dant quatre cornes sur la t&ecirc;te et des sortes de nageoires de chaque c&ocirc;t&eacute; de la m&acirc;choire. Ses yeux sont faits de cristaux et induisent donc le fait qu&#039;il a une mauvaise vue mais ils sont consid&eacute;r&eacute;s malgr&eacute; tout comme faisant partis des 3 joyaux les plus pr&eacute;cieux du monde. Son corps est recouvert de dures &eacute;cailles noires &agrave; l&#039;exception du ventre o&ugrave; elles sont de couleur cr&egrave;me. De grands piques ornent son &eacute;chine, allant de la nuque jusqu&#039;au bout de la queue. ', './assets/mh_img/1708944231.jpg', '2024-02-26 11:43:51', '2024-02-26 11:43:51'),
(27, 'Rajang', 'Bete a croc', 'Le Rajang est une b&ecirc;te &agrave; crocs introduite dans Monster Hunter 2. ', 'Le Rajang est une cr&eacute;ature aux allures simiesque pourvue d&#039;un pelage noir et aux yeux rouges. Sa t&ecirc;te rappelle celle d&#039;un babouin, son torse celui d&#039;un gorille, quant &agrave; ses pattes arri&egrave;res, elles sont similaires &agrave; celles du lion. Il est &eacute;galement dot&eacute;e de deux longues cornes perpendiculaires &agrave; sa t&ecirc;te allant &agrave; gauche et &agrave; droite.\r\nLorsqu&#039;enrag&eacute;, son pelage vire au dor&eacute; car charg&eacute; d&#039;&eacute;lectricit&eacute;. Au paroxysme de son courroux, ses bras prendront une teinte rouge.\r\nTr&egrave;s imposant dans l&#039;ancien monde, il est plus petit qu&#039;&agrave; l&#039;accoutum&eacute; dans le nouveau monde. ', './assets/mh_img/1709027553.jpg', '2024-02-27 10:52:33', '2024-02-27 10:52:33'),
(28, 'Gore Magala du chaos', '???', 'Le Gore Magala du chaos est une variante du Gore Magala introduite dans Monster Hunter 4 Ultimate. ', 'M&ecirc;me si son nom sugg&egrave;re le contraire, le Gore Magala du chaos n&#039;est en aucun cas une esp&egrave;ce unique : Il s&#039;agit seulement d&#039;un Gore Magala ayant rat&eacute; sa mue et dont seule une partie du corps &agrave; mu&eacute; vers sa forme de Shagaru Magala. Il ne dispose donc que d&#039;une corne &agrave; demi-blanche et d&#039;&eacute;clats de peau et d&#039;&eacute;cailles relatives au Shagaru Magala.\r\nOn dit que sa mue d&eacute;fectueuse est due &agrave; la pr&eacute;sence d&#039;un Shagaru Magala dans les environs donc le virus a perturb&eacute; le m&eacute;canisme normale de sa mue. Son existence est donc instable et le monstre est vou&eacute; &agrave; mourir de mani&egrave;re pr&eacute;coce, le virus le rongeant de l&rsquo;int&eacute;rieur. ', './assets/mh_img/1709027765.jpg', '2024-02-27 10:56:05', '2024-02-27 10:56:05'),
(29, 'Anjanath', 'Wyverne de terre', 'L&#039;Anjanath est une wyverne de terre apparue pour la premi&egrave;re fois dans Monster Hunter: World. ', 'L&#039;Anjanath ressemble &agrave; un Tyrannosaure et son apparence n&#039;est pas sans rappeler celle du Deviljho, tous deux &eacute;tant similaires &agrave; des dinosaures carnivores bip&egrave;des. Le corps de l&#039;Anjanath est recouvert d&#039;&eacute;cailles roses saumon et sur son dos se trouvent des poils gris qui forment une sorte de cr&ecirc;te allant jusqu&#039;&agrave; sa queue. Sous cette derni&egrave;re se trouvent de petits pics. Il poss&egrave;de des crocs suppl&eacute;mentaires sur sa m&acirc;choire inf&eacute;rieure, de petits membres ant&eacute;rieurs et trois griffes &agrave; chaque patte. ', './assets/mh_img/1709037565.jpg', '2024-02-27 13:39:25', '2024-02-27 13:39:25');

-- --------------------------------------------------------

--
-- Structure de la table `monstre_details`
--

CREATE TABLE `monstre_details` (
  `id` int(11) NOT NULL,
  `elements` varchar(255) NOT NULL DEFAULT '[]',
  `faiblesses` varchar(255) NOT NULL DEFAULT '[]',
  `taille` varchar(255) NOT NULL DEFAULT '[]',
  `generation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `monstre_details`
--

INSERT INTO `monstre_details` (`id`, `elements`, `faiblesses`, `taille`, `generation`) VALUES
(5, '[\"Feu\"]', '[\"Dragon\"]', '[\"4738\",\"4739\"]', 5),
(6, '[\"Foudre\"]', '[\"Glace\",\"Eau\"]', '[\"1544\",\"2194\"]', 4),
(7, '[\"Foudre\",\"Eau\"]', '[\"Feu\"]', '[\"2357\",\"3310\"]', 3),
(8, '[\"Feu\"]', '[\"Foudre\",\"Dragon\"]', '[\"1140\",\"2248\"]', 1),
(9, '[\"Feu\"]', '[\"Eau\",\"Dragon\"]', '[\"1154\",\"1754\"]', 1),
(10, '[\"Eau\"]', '[\"Foudre\",\"Glace\"]', '[\"1230\",\"2015\"]', 1),
(11, '[]', '[\"Glace\"]', '[\"1993\",\"2132\"]', 1),
(12, '[]', '[\"Foudre\",\"Glace\"]', '[\"615\",\"1054\"]', 1),
(13, '[\"Feu\"]', '[\"Eau\"]', '[\"1049\",\"3065\"]', 1),
(14, '[]', '[\"Feu\"]', '[\"831\",\"1348\"]', 1),
(15, '[\"Foudre\"]', '[\"Feu\"]', '[\"436\",\"1205\"]', 1),
(17, '[\"Feu\"]', '[\"Foudre\",\"Glace\",\"Dragon\"]', '[\"44038\",\"44039\"]', 4),
(19, '[\"Feu\",\"Dragon\"]', '[\"Dragon\"]', '[\"4110\",\"4137\"]', 1),
(27, '[\"Foudre\"]', '[\"Glace\"]', '[\"746\",\"980\"]', 2),
(28, '\"[]\"', '[\"Feu\"]', '[\"1584\",\"2207\"]', 4),
(29, '[\"Feu\"]', '[\"Glace\",\"Eau\"]', '[\"1448\",\"2008\"]', 5);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `roles` varchar(255) NOT NULL DEFAULT '["ROLE_MEMBER"]',
  `avatar` varchar(50) NOT NULL,
  `register_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `roles`, `avatar`, `register_at`) VALUES
(2, 'pierrot', 'pierre@gmail.com', '$2y$10$etbH9rzyvCZ8D.tnKxCUJ.bISXHQoJTRDFFXEL8itpaZFzLHGfI0q', '[\"ROLE_MEMBER\"]', './assets/avatars/1708953810.jpg', '2024-02-25 13:27:05'),
(3, 'Ssamada', 'adam.doudeau2@gmail.com', '$2y$10$hvPO.NzCL0q5lq/UBBMe..19wYDpeur7RJOjQfrVOeCWccvHP9b86', '[\"ROLE_MEMBER\",\"ROLE_ADMIN\"]', './assets/avatars/1708953501.jpg', '2024-02-25 13:28:44'),
(4, 'aze', 'aze@free.fr', '$2y$10$.PctUytsHxV0OJS9ti9pc.4WNmWmUD2STr0U.AJl60MZJQytsBUmW', '[\"ROLE_MEMBER\"]', './assets/avatars/1708889590.jpg', '2024-02-25 20:33:10'),
(5, 'Moomin', 'Cedric.moomin@gmail.com', '$2y$10$X87kLXCU47rPuLB3AuMQz.wJm1uvNefAgt7ghOYMBERm.hnXNjaUa', '[\"ROLE_MEMBER\"]', './assets/avatars/1709037719.jpg', '2024-02-27 13:41:59');

-- --------------------------------------------------------

--
-- Structure de la table `user_details`
--

CREATE TABLE `user_details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) NOT NULL,
  `zip` varchar(50) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user_details`
--

INSERT INTO `user_details` (`id`, `user_id`, `firstname`, `lastname`, `address1`, `address2`, `zip`, `city`, `state`) VALUES
(2, 2, 'Pierre', 'Pierre', '123', '123', '123', '132', 'Auvergne-Rh&ocirc;ne-Alpes'),
(3, 3, 'ssamada', 'ssamada', '123', '123', '1234', '12345', 'Pays de la Loire'),
(4, 4, 'aze', 'aze', 'aze', 'aze', 'aze', 'aze', 'R&eacute;union'),
(5, 5, 'Cedric', 'Frachisse', 'Quelque part', 'Je sais pas', '69400', 'Villefranche-sur-sa&ocirc;ne', 'Auvergne-Rh&ocirc;ne-Alpes');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_comment_user` (`user_id`),
  ADD KEY `fk_comment_monstre` (`monstre_id`);

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_contact_user` (`user_id`);

--
-- Index pour la table `monstre`
--
ALTER TABLE `monstre`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `monstre_details`
--
ALTER TABLE `monstre_details`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_details_user` (`user_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `monstre`
--
ALTER TABLE `monstre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT pour la table `monstre_details`
--
ALTER TABLE `monstre_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `fk_comment_monstre` FOREIGN KEY (`monstre_id`) REFERENCES `monstre` (`id`),
  ADD CONSTRAINT `fk_comment_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `fk_contact_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `monstre_details`
--
ALTER TABLE `monstre_details`
  ADD CONSTRAINT `fk_details_monstre` FOREIGN KEY (`id`) REFERENCES `monstre` (`id`);

--
-- Contraintes pour la table `user_details`
--
ALTER TABLE `user_details`
  ADD CONSTRAINT `fk_details_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

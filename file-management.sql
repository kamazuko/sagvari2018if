-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2019. Okt 06. 10:55
-- Kiszolgáló verziója: 10.1.39-MariaDB
-- PHP verzió: 7.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `file-management`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `evfolyam` int(11) NOT NULL,
  `tantargy` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `cim` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `leiras` varchar(1000) COLLATE utf8_hungarian_ci NOT NULL,
  `size` int(11) NOT NULL,
  `downloads` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `files`
--

INSERT INTO `files` (`id`, `name`, `evfolyam`, `tantargy`, `cim`, `leiras`, `size`, `downloads`, `time`) VALUES
(11, 'Folyadékok mechanikája.docx', 9, 'Fizika', 'Folyadékok mechanikája', 'Gázok modellje | Folyadékok modellje | Szilárd testek modellje | Folyadékok súlyából származó nyomás | Pascal törvény | Hidraulikus emelő | Arkhimédész törvénye | Úszás | Lebegés | Lesüllyedés', 14083, 1, '2019-09-06 18:39:48'),
(12, 'Forgatónyomaték.docx', 9, 'Fizika', 'Forgatónyomaték', 'Forgatónyomaték | Merev test modellje | Erőkar | Egyensúly feltétele | Forgatónyomaték jele | Eredő erők meghatározása | Erőpár | Egyensúlyi helyzetek | Stabil (biztos) egyensúlyi helyzet | Instabil (labilis) egyensúlyi helyzet | Indiferens (közömbös) egyensúlyi helyzet | Egyszerű gépek | Emelő típusú egyszerű gépek | Csiga, mint egyszerű gép | Lejtő típusú egyszerű gépek | Lejtő | Csavar | Ék', 17922, 0, '2019-09-05 20:29:45'),
(13, 'Munka-Energia.docx', 9, 'Fizika', 'Munka - Energia - Teljesítmény', 'Képletek | Munka | Teljesítmény, hatásfok | Energia', 16533, 0, '2019-09-05 20:33:51'),
(14, 'Körmozgások.docx', 9, 'Fizika', 'Körmozgások', 'Szögmérés Radiánban | Periodikus mozgás | Periódusidő | Frekvencia | Egyenletes körmozgás | Kerületi sebesség | Centripetális gyorsulás | A centripetális erő | Keple törvények', 13770, 0, '2019-09-05 20:29:45'),
(15, 'róma.docx', 9, 'Történelem', 'Róma', 'Róma | Fogalmak | Pun háborúk | Köztársaság válsága | II. Triumvirátus | A római vallás ás civilizáció | Kereszténység kialakulása | Birodalom két részre szakadása | Pannónia provinciái ', 81373, 0, '2019-09-05 20:46:53'),
(16, 'Dinamika-erőtan.docx', 9, 'Fizika', 'Dinamika - Erőtan', 'Sűrűség | Newton I. | Newton II. | Newton III. | Lendület | Lendületmegmaradás törvénye | A dinamika alapegyenlete | Erőtörvények | Nehézségi erő | Newton-féle gravitációs erőtörvény | Súly | Lineáris erőtörvény (Hooke törvény; rugalmas erő) | Csúszási surlódási erő | Tapadási surlódási erő', 15885, 0, '2019-09-05 20:54:38');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nev` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`id`, `username`, `nev`, `password`, `created_at`) VALUES
(1, 'birotamas', '', '$2y$10$pyUOtcNSaQbncA2g9PvhS.773636Ri7Sc5gOg85EBrHI8pNYJCV3G', '2019-06-06 19:10:26'),
(2, 'gergelyzsolti', '', '$2y$10$NQN6jA7istfQIvyQx.sFUuI01C4l/svm5pgnvgPMLv.B3BrgfoepG', '2019-10-05 18:07:17'),
(3, 'tanasbeke', 'Tanács Beke', '$2y$10$OSNVD.25yRFi56sSNV.Df.ZY4nPyghpRA1u8InmqCCbYotCer9GL.', '2019-10-05 19:03:46');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 17 Lip 2019, 20:52
-- Wersja serwera: 10.1.36-MariaDB
-- Wersja PHP: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `test`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `android`
--

CREATE TABLE `android` (
  `id` int(11) NOT NULL,
  `firstName` varchar(50) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `lastName` varchar(50) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `android`
--

INSERT INTO `android` (`id`, `firstName`, `lastName`) VALUES
(1, 'Katarzyna', 'Sokołowska'),
(2, 'Łukasz', 'Jackowski'),
(3, 'Magda', 'Sokołowska'),
(4, 'Kala', 'Test'),
(5, 'Ewa', 'Jackowska'),
(6, 'Katarzyna', 'Jackowska');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `question` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `ansa` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `ansb` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `ansc` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `ansd` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `odp` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `questions`
--

INSERT INTO `questions` (`id`, `question`, `ansa`, `ansb`, `ansc`, `ansd`, `odp`) VALUES
(2, 'Czy prawidłowe jest sformułowanie dotyczące lasera, iż posiada on temperaturę ujemną w skali Kelwina? Na przykład druga zasada termodynamiki mówi, że ze wzrostem energii nieuporządkowanie układu rośnie, a w przypadku lasera jest na odwrót.', 'a a', 'b', 'c', 'd', 'odp1'),
(3, 'Czy rozwiązania Diraca z energią ujemną wynikały z tego, że energia cząstek (np. pozytonu) była tak naprawdę dodatnia, tyle tylko że ładunek był przeciwny? Jeśli nie to o co w tym chodziło?', 'aa', 'b b', 'c c', 'd d', 'odp2'),
(4, 'Dlaczego ryby nie zdychają w wyniku uderzenia pioruna w powierzchnię wody? Ryby które są przy powierzchni wody zdychają, a co z resztą? Czy przez ryby (które są zanurzone w wodzie) przepływa prąd? A co z wędkowaniem „na prąd”?', 'aaa', 'bb b', 'c cc', 'd dd', 'odp3'),
(8, 'Czemu szyba paruje? I czy szyb? np. w aucie szybciej mo?na odparowa? przy pomocy ciep?ego czy zimnego nawiewu?', 'a a', 'b', 'c', 'd', 'odp1'),
(9, 'Jak zmieni si? temperatura gdy zostawi? otwart? lod?wk??', 'aa', 'b b', 'c c', 'd d', 'odp2'),
(10, 'Jak zmienia się ciśnienie przy nape?nianiu zbiornika azotem?', 'aaa', 'bb b', 'c cc', 'd dd', 'odp3'),
(11, 'Czemu szyba paruje? I czy szyb? np. w aucie szybciej mo?na odparowa? przy pomocy ciep?ego czy zimnego nawiewu?', 'a a', 'b', 'c', 'd', 'odp1'),
(12, 'Jak zmieni si? temperatura gdy zostawi? otwart? lod?wk??', 'aa', 'b b', 'c c', 'd d', 'odp2'),
(13, 'Jak zmienia si? ci?nienie przy nape?nianiu zbiornika azotem?', 'aaa', 'bb b', 'c cc', 'd dd', 'odp3');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `secret_code`
--

CREATE TABLE `secret_code` (
  `id` int(11) NOT NULL,
  `code` char(100) NOT NULL DEFAULT '0',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `secret_code`
--

INSERT INTO `secret_code` (`id`, `code`, `update_time`) VALUES
(1, '2046df310aca799582edaee235fbd2b9a95520d1bab8ab62bf816bfe21488ac2', '2019-06-21 22:12:51');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(50) NOT NULL DEFAULT '0',
  `password` char(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `firstName` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `lastName` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `isActive` set('true','false') NOT NULL DEFAULT 'true',
  `permission` set('admin','user') CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL DEFAULT 'user',
  `authCounter` smallint(2) NOT NULL DEFAULT '0',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `firstName`, `lastName`, `isActive`, `permission`, `authCounter`, `update_time`) VALUES
(1, 'ljack', '$2y$10$yeYwLQfoBvvEbNi3g5OlQ.90/yphWo4Z5WVmOpoPMl8oQPidqN1zO', 'Łukasz', 'Jackowski', 'true', 'admin', 0, '2019-06-25 21:29:45'),
(2, 'jackol01', '$2y$10$hjnl3QrRa2vYjY7wOWPmaeOWUZcpNIsimHlMsYfNABO0y9YGgnjt2', 'Łukasz', 'Jackowski', 'true', 'admin', 1, '2019-06-28 12:25:42'),
(3, 'jackol1', '$2y$10$8TXePraYbet4xSdP2AgSC.7aBELOgZr2V4iUByx/a4AEDy7.OMWoS', 'test', 'test', 'true', 'user', 0, '2019-06-23 21:18:11'),
(6, 'kubiag02', '$2y$10$PlohEKxVha83ryfNFsqu8u3BzdlpLyDb5HSu2CGX3BzNWjjpTe8tK', 'Grzegorz', 'Kubiak', 'false', 'user', 0, '2019-06-25 12:43:59'),
(7, 'kasias01', '$2y$10$PIo2My.ZrtghKYA81K1SGe38jlfZOuVdqTm4W4f3WyvO.BXK07yWC', 'Katarzyna', 'Sokołowska', 'false', 'user', 0, '2019-06-25 21:40:52'),
(10, 'alicja', '$2y$10$mHSkWJMQUPulH6mKNyOLrumVb1BoB0p4D0Zxe.KMEbOJfn.xKANIq', 'Alicja', 'Sokołowska', 'true', 'user', 0, '2019-06-25 21:40:46');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `us_users`
--

CREATE TABLE `us_users` (
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `company_name` varchar(50) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `zip` varchar(50) DEFAULT NULL,
  `phone1` varchar(50) DEFAULT NULL,
  `phone2` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `web` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `us_users`
--

INSERT INTO `us_users` (`first_name`, `last_name`, `company_name`, `address`, `city`, `country`, `state`, `zip`, `phone1`, `phone2`, `email`, `web`) VALUES
('James', 'Butt', 'Benton, John B Jr', '6649 N Blue Gum St', 'New Orleans', 'Orleans', 'LA', '70116', '504-621-8927', '504-845-1427', 'jbutt@gmail.com', 'http://www.bentonjohnbjr.com'),
('Josephine', 'Darakjy', 'Chanay, Jeffrey A Esq', '4 B Blue Ridge Blvd', 'Brighton', 'Livingston', 'MI', '48116', '810-292-9388', '810-374-9840', 'josephine_darakjy@darakjy.org', 'http://www.chanayjeffreyaesq.com'),
('Art', 'Venere', 'Chemel, James L Cpa', '8 W Cerritos Ave #54', 'Bridgeport', 'Gloucester', 'NJ', '8014', '856-636-8749', '856-264-4130', 'art@venere.org', 'http://www.chemeljameslcpa.com'),
('Lenna', 'Paprocki', 'Feltz Printing Service', '639 Main St', 'Anchorage', 'Anchorage', 'AK', '99501', '907-385-4412', '907-921-2010', 'lpaprocki@hotmail.com', 'http://www.feltzprintingservice.com'),
('Donette', 'Foller', 'Printing Dimensions', '34 Center St', 'Hamilton', 'Butler', 'OH', '45011', '513-570-1893', '513-549-4561', 'donette.foller@cox.net', 'http://www.printingdimensions.com'),
('Simona', 'Morasca', 'Chapman, Ross E Esq', '3 Mcauley Dr', 'Ashland', 'Ashland', 'OH', '44805', '419-503-2484', '419-800-6759', 'simona@morasca.com', 'http://www.chapmanrosseesq.com'),
('Mitsue', 'Tollner', 'Morlong Associates', '7 Eads St', 'Chicago', 'Cook', 'IL', '60632', '773-573-6914', '773-924-8565', 'mitsue_tollner@yahoo.com', 'http://www.morlongassociates.com'),
('Leota', 'Dilliard', 'Commercial Press', '7 W Jackson Blvd', 'San Jose', 'Santa Clara', 'CA', '95111', '408-752-3500', '408-813-1105', 'leota@hotmail.com', 'http://www.commercialpress.com'),
('Sage', 'Wieser', 'Truhlar And Truhlar Attys', '5 Boston Ave #88', 'Sioux Falls', 'Minnehaha', 'SD', '57105', '605-414-2147', '605-794-4895', 'sage_wieser@cox.net', 'http://www.truhlarandtruhlarattys.com'),
('Kris', 'Marrier', 'King, Christopher A Esq', '228 Runamuck Pl #2808', 'Baltimore', 'Baltimore City', 'MD', '21224', '410-655-8723', '410-804-4694', 'kris@gmail.com', 'http://www.kingchristopheraesq.com'),
('Minna', 'Amigon', 'Dorl, James J Esq', '2371 Jerrold Ave', 'Kulpsville', 'Montgomery', 'PA', '19443', '215-874-1229', '215-422-8694', 'minna_amigon@yahoo.com', 'http://www.dorljamesjesq.com'),
('Abel', 'Maclead', 'Rangoni Of Florence', '37275 St  Rt 17m M', 'Middle Island', 'Suffolk', 'NY', '11953', '631-335-3414', '631-677-3675', 'amaclead@gmail.com', 'http://www.rangoniofflorence.com'),
('Kiley', 'Caldarera', 'Feiner Bros', '25 E 75th St #69', 'Los Angeles', 'Los Angeles', 'CA', '90034', '310-498-5651', '310-254-3084', 'kiley.caldarera@aol.com', 'http://www.feinerbros.com'),
('Graciela', 'Ruta', 'Buckley Miller & Wright', '98 Connecticut Ave Nw', 'Chagrin Falls', 'Geauga', 'OH', '44023', '440-780-8425', '440-579-7763', 'gruta@cox.net', 'http://www.buckleymillerwright.com'),
('Cammy', 'Albares', 'Rousseaux, Michael Esq', '56 E Morehead St', 'Laredo', 'Webb', 'TX', '78045', '956-537-6195', '956-841-7216', 'calbares@gmail.com', 'http://www.rousseauxmichaelesq.com'),
('Mattie', 'Poquette', 'Century Communications', '73 State Road 434 E', 'Phoenix', 'Maricopa', 'AZ', '85013', '602-277-4385', '602-953-6360', 'mattie@aol.com', 'http://www.centurycommunications.com'),
('Meaghan', 'Garufi', 'Bolton, Wilbur Esq', '69734 E Carrillo St', 'Mc Minnville', 'Warren', 'TN', '37110', '931-313-9635', '931-235-7959', 'meaghan@hotmail.com', 'http://www.boltonwilburesq.com'),
('Gladys', 'Rim', 'T M Byxbee Company Pc', '322 New Horizon Blvd', 'Milwaukee', 'Milwaukee', 'WI', '53207', '414-661-9598', '414-377-2880', 'gladys.rim@rim.org', 'http://www.tmbyxbeecompanypc.com'),
('Yuki', 'Whobrey', 'Farmers Insurance Group', '1 State Route 27', 'Taylor', 'Wayne', 'MI', '48180', '313-288-7937', '313-341-4470', 'yuki_whobrey@aol.com', 'http://www.farmersinsurancegroup.com'),
('Fletcher', 'Flosi', 'Post Box Services Plus', '394 Manchester Blvd', 'Rockford', 'Winnebago', 'IL', '61109', '815-828-2147', '815-426-5657', 'fletcher.flosi@yahoo.com', 'http://www.postboxservicesplus.com'),
('Bette', 'Nicka', 'Sport En Art', '6 S 33rd St', 'Aston', 'Delaware', 'PA', '19014', '610-545-3615', '610-492-4643', 'bette_nicka@cox.net', 'http://www.sportenart.com'),
('Veronika', 'Inouye', 'C 4 Network Inc', '6 Greenleaf Ave', 'San Jose', 'Santa Clara', 'CA', '95111', '408-540-1785', '408-813-4592', 'vinouye@aol.com', 'http://www.cnetworkinc.com'),
('Willard', 'Kolmetz', 'Ingalls, Donald R Esq', '618 W Yakima Ave', 'Irving', 'Dallas', 'TX', '75062', '972-303-9197', '972-896-4882', 'willard@hotmail.com', 'http://www.ingallsdonaldresq.com'),
('Maryann', 'Royster', 'Franklin, Peter L Esq', '74 S Westgate St', 'Albany', 'Albany', 'NY', '12204', '518-966-7987', '518-448-8982', 'mroyster@royster.com', 'http://www.franklinpeterlesq.com'),
('Alisha', 'Slusarski', 'Wtlz Power 107 Fm', '3273 State St', 'Middlesex', 'Middlesex', 'NJ', '8846', '732-658-3154', '732-635-3453', 'alisha@slusarski.com', 'http://www.wtlzpowerfm.com'),
('Allene', 'Iturbide', 'Ledecky, David Esq', '1 Central Ave', 'Stevens Point', 'Portage', 'WI', '54481', '715-662-6764', '715-530-9863', 'allene_iturbide@cox.net', 'http://www.ledeckydavidesq.com'),
('Chanel', 'Caudy', 'Professional Image Inc', '86 Nw 66th St #8673', 'Shawnee', 'Johnson', 'KS', '66218', '913-388-2079', '913-899-1103', 'chanel.caudy@caudy.org', 'http://www.professionalimageinc.com'),
('Ezekiel', 'Chui', 'Sider, Donald C Esq', '2 Cedar Ave #84', 'Easton', 'Talbot', 'MD', '21601', '410-669-1642', '410-235-8738', 'ezekiel@chui.com', 'http://www.siderdonaldcesq.com'),
('Willow', 'Kusko', 'U Pull It', '90991 Thorburn Ave', 'New York', 'New York', 'NY', '10011', '212-582-4976', '212-934-5167', 'wkusko@yahoo.com', 'http://www.upullit.com'),
('Bernardo', 'Figeroa', 'Clark, Richard Cpa', '386 9th Ave N', 'Conroe', 'Montgomery', 'TX', '77301', '936-336-3951', '936-597-3614', 'bfigeroa@aol.com', 'http://www.clarkrichardcpa.com'),
('Ammie', 'Corrio', 'Moskowitz, Barry S', '74874 Atlantic Ave', 'Columbus', 'Franklin', 'OH', '43215', '614-801-9788', '614-648-3265', 'ammie@corrio.com', 'http://www.moskowitzbarrys.com'),
('Francine', 'Vocelka', 'Cascade Realty Advisors Inc', '366 South Dr', 'Las Cruces', 'Dona Ana', 'NM', '88011', '505-977-3911', '505-335-5293', 'francine_vocelka@vocelka.com', 'http://www.cascaderealtyadvisorsinc.com'),
('Ernie', 'Stenseth', 'Knwz Newsradio', '45 E Liberty St', 'Ridgefield Park', 'Bergen', 'NJ', '7660', '201-709-6245', '201-387-9093', 'ernie_stenseth@aol.com', 'http://www.knwznewsradio.com'),
('Albina', 'Glick', 'Giampetro, Anthony D', '4 Ralph Ct', 'Dunellen', 'Middlesex', 'NJ', '8812', '732-924-7882', '732-782-6701', 'albina@glick.com', 'http://www.giampetroanthonyd.com'),
('Alishia', 'Sergi', 'Milford Enterprises Inc', '2742 Distribution Way', 'New York', 'New York', 'NY', '10025', '212-860-1579', '212-753-2740', 'asergi@gmail.com', 'http://www.milfordenterprisesinc.com'),
('Solange', 'Shinko', 'Mosocco, Ronald A', '426 Wolf St', 'Metairie', 'Jefferson', 'LA', '70002', '504-979-9175', '504-265-8174', 'solange@shinko.com', 'http://www.mosoccoronalda.com'),
('Jose', 'Stockham', 'Tri State Refueler Co', '128 Bransten Rd', 'New York', 'New York', 'NY', '10011', '212-675-8570', '212-569-4233', 'jose@yahoo.com', 'http://www.tristaterefuelerco.com'),
('Rozella', 'Ostrosky', 'Parkway Company', '17 Morena Blvd', 'Camarillo', 'Ventura', 'CA', '93012', '805-832-6163', '805-609-1531', 'rozella.ostrosky@ostrosky.com', 'http://www.parkwaycompany.com'),
('Valentine', 'Gillian', 'Fbs Business Finance', '775 W 17th St', 'San Antonio', 'Bexar', 'TX', '78204', '210-812-9597', '210-300-6244', 'valentine_gillian@gmail.com', 'http://www.fbsbusinessfinance.com'),
('Kati', 'Rulapaugh', 'Eder Assocs Consltng Engrs Pc', '6980 Dorsett Rd', 'Abilene', 'Dickinson', 'KS', '67410', '785-463-7829', '785-219-7724', 'kati.rulapaugh@hotmail.com', 'http://www.ederassocsconsltngengrspc.com'),
('Youlanda', 'Schemmer', 'Tri M Tool Inc', '2881 Lewis Rd', 'Prineville', 'Crook', 'OR', '97754', '541-548-8197', '541-993-2611', 'youlanda@aol.com', 'http://www.trimtoolinc.com'),
('Dyan', 'Oldroyd', 'International Eyelets Inc', '7219 Woodfield Rd', 'Overland Park', 'Johnson', 'KS', '66204', '913-413-4604', '913-645-8918', 'doldroyd@aol.com', 'http://www.internationaleyeletsinc.com'),
('Roxane', 'Campain', 'Rapid Trading Intl', '1048 Main St', 'Fairbanks', 'Fairbanks North Star', 'AK', '99708', '907-231-4722', '907-335-6568', 'roxane@hotmail.com', 'http://www.rapidtradingintl.com'),
('Lavera', 'Perin', 'Abc Enterprises Inc', '678 3rd Ave', 'Miami', 'Miami-Dade', 'FL', '33196', '305-606-7291', '305-995-2078', 'lperin@perin.org', 'http://www.abcenterprisesinc.com'),
('Erick', 'Ferencz', 'Cindy Turner Associates', '20 S Babcock St', 'Fairbanks', 'Fairbanks North Star', 'AK', '99712', '907-741-1044', '907-227-6777', 'erick.ferencz@aol.com', 'http://www.cindyturnerassociates.com'),
('Fatima', 'Saylors', 'Stanton, James D Esq', '2 Lighthouse Ave', 'Hopkins', 'Hennepin', 'MN', '55343', '952-768-2416', '952-479-2375', 'fsaylors@saylors.org', 'http://www.stantonjamesdesq.com'),
('Jina', 'Briddick', 'Grace Pastries Inc', '38938 Park Blvd', 'Boston', 'Suffolk', 'MA', '2128', '617-399-5124', '617-997-5771', 'jina_briddick@briddick.com', 'http://www.gracepastriesinc.com'),
('Kanisha', 'Waycott', 'Schroer, Gene E Esq', '5 Tomahawk Dr', 'Los Angeles', 'Los Angeles', 'CA', '90006', '323-453-2780', '323-315-7314', 'kanisha_waycott@yahoo.com', 'http://www.schroergeneeesq.com'),
('Emerson', 'Bowley', 'Knights Inn', '762 S Main St', 'Madison', 'Dane', 'WI', '53711', '608-336-7444', '608-658-7940', 'emerson.bowley@bowley.org', 'http://www.knightsinn.com'),
('Blair', 'Malet', 'Bollinger Mach Shp & Shipyard', '209 Decker Dr', 'Philadelphia', 'Philadelphia', 'PA', '19132', '215-907-9111', '215-794-4519', 'bmalet@yahoo.com', 'http://www.bollingermachshpshipyard.com'),
('Brock', 'Bolognia', 'Orinda News', '4486 W O St #1', 'New York', 'New York', 'NY', '10003', '212-402-9216', '212-617-5063', 'bbolognia@yahoo.com', 'http://www.orindanews.com'),
('Lorrie', 'Nestle', 'Ballard Spahr Andrews', '39 S 7th St', 'Tullahoma', 'Coffee', 'TN', '37388', '931-875-6644', '931-303-6041', 'lnestle@hotmail.com', 'http://www.ballardspahrandrews.com'),
('Sabra', 'Uyetake', 'Lowy Limousine Service', '98839 Hawthorne Blvd #6101', 'Columbia', 'Richland', 'SC', '29201', '803-925-5213', '803-681-3678', 'sabra@uyetake.org', 'http://www.lowylimousineservice.com'),
('Marjory', 'Mastella', 'Vicon Corporation', '71 San Mateo Ave', 'Wayne', 'Delaware', 'PA', '19087', '610-814-5533', '610-379-7125', 'mmastella@mastella.com', 'http://www.viconcorporation.com'),
('Karl', 'Klonowski', 'Rossi, Michael M', '76 Brooks St #9', 'Flemington', 'Hunterdon', 'NJ', '8822', '908-877-6135', '908-470-4661', 'karl_klonowski@yahoo.com', 'http://www.rossimichaelm.com'),
('Tonette', 'Wenner', 'Northwest Publishing', '4545 Courthouse Rd', 'Westbury', 'Nassau', 'NY', '11590', '516-968-6051', '516-333-4861', 'twenner@aol.com', 'http://www.northwestpublishing.com'),
('Amber', 'Monarrez', 'Branford Wire & Mfg Co', '14288 Foster Ave #4121', 'Jenkintown', 'Montgomery', 'PA', '19046', '215-934-8655', '215-329-6386', 'amber_monarrez@monarrez.org', 'http://www.branfordwiremfgco.com'),
('Shenika', 'Seewald', 'East Coast Marketing', '4 Otis St', 'Van Nuys', 'Los Angeles', 'CA', '91405', '818-423-4007', '818-749-8650', 'shenika@gmail.com', 'http://www.eastcoastmarketing.com'),
('Delmy', 'Ahle', 'Wye Technologies Inc', '65895 S 16th St', 'Providence', 'Providence', 'RI', '2909', '401-458-2547', '401-559-8961', 'delmy.ahle@hotmail.com', 'http://www.wyetechnologiesinc.com'),
('Deeanna', 'Juhas', 'Healy, George W Iv', '14302 Pennsylvania Ave', 'Huntingdon Valley', 'Montgomery', 'PA', '19006', '215-211-9589', '215-417-9563', 'deeanna_juhas@gmail.com', 'http://www.healygeorgewiv.com'),
('Blondell', 'Pugh', 'Alpenlite Inc', '201 Hawk Ct', 'Providence', 'Providence', 'RI', '2904', '401-960-8259', '401-300-8122', 'bpugh@aol.com', 'http://www.alpenliteinc.com'),
('Jamal', 'Vanausdal', 'Hubbard, Bruce Esq', '53075 Sw 152nd Ter #615', 'Monroe Township', 'Middlesex', 'NJ', '8831', '732-234-1546', '732-904-2931', 'jamal@vanausdal.org', 'http://www.hubbardbruceesq.com'),
('Cecily', 'Hollack', 'Arthur A Oliver & Son Inc', '59 N Groesbeck Hwy', 'Austin', 'Travis', 'TX', '78731', '512-486-3817', '512-861-3814', 'cecily@hollack.org', 'http://www.arthuraoliversoninc.com'),
('Carmelina', 'Lindall', 'George Jessop Carter Jewelers', '2664 Lewis Rd', 'Littleton', 'Douglas', 'CO', '80126', '303-724-7371', '303-874-5160', 'carmelina_lindall@lindall.com', 'http://www.georgejessopcarterjewelers.com'),
('Maurine', 'Yglesias', 'Schultz, Thomas C Md', '59 Shady Ln #53', 'Milwaukee', 'Milwaukee', 'WI', '53214', '414-748-1374', '414-573-7719', 'maurine_yglesias@yglesias.com', 'http://www.schultzthomascmd.com'),
('Tawna', 'Buvens', 'H H H Enterprises Inc', '3305 Nabell Ave #679', 'New York', 'New York', 'NY', '10009', '212-674-9610', '212-462-9157', 'tawna@gmail.com', 'http://www.hhhenterprisesinc.com'),
('Penney', 'Weight', 'Hawaiian King Hotel', '18 Fountain St', 'Anchorage', 'Anchorage', 'AK', '99515', '907-797-9628', '907-873-2882', 'penney_weight@aol.com', 'http://www.hawaiiankinghotel.com'),
('Elly', 'Morocco', 'Killion Industries', '7 W 32nd St', 'Erie', 'Erie', 'PA', '16502', '814-393-5571', '814-420-3553', 'elly_morocco@gmail.com', 'http://www.killionindustries.com'),
('Ilene', 'Eroman', 'Robinson, William J Esq', '2853 S Central Expy', 'Glen Burnie', 'Anne Arundel', 'MD', '21061', '410-914-9018', '410-937-4543', 'ilene.eroman@hotmail.com', 'http://www.robinsonwilliamjesq.com'),
('Vallie', 'Mondella', 'Private Properties', '74 W College St', 'Boise', 'Ada', 'ID', '83707', '208-862-5339', '208-737-8439', 'vmondella@mondella.com', 'http://www.privateproperties.com'),
('Kallie', 'Blackwood', 'Rowley Schlimgen Inc', '701 S Harrison Rd', 'San Francisco', 'San Francisco', 'CA', '94104', '415-315-2761', '415-604-7609', 'kallie.blackwood@gmail.com', 'http://www.rowleyschlimgeninc.com'),
('Johnetta', 'Abdallah', 'Forging Specialties', '1088 Pinehurst St', 'Chapel Hill', 'Orange', 'NC', '27514', '919-225-9345', '919-715-3791', 'johnetta_abdallah@aol.com', 'http://www.forgingspecialties.com'),
('Bobbye', 'Rhym', 'Smits, Patricia Garity', '30 W 80th St #1995', 'San Carlos', 'San Mateo', 'CA', '94070', '650-528-5783', '650-811-9032', 'brhym@rhym.com', 'http://www.smitspatriciagarity.com'),
('Micaela', 'Rhymes', 'H Lee Leonard Attorney At Law', '20932 Hedley St', 'Concord', 'Contra Costa', 'CA', '94520', '925-647-3298', '925-522-7798', 'micaela_rhymes@gmail.com', 'http://www.hleeleonardattorneyatlaw.com'),
('Tamar', 'Hoogland', 'A K Construction Co', '2737 Pistorio Rd #9230', 'London', 'Madison', 'OH', '43140', '740-343-8575', '740-526-5410', 'tamar@hotmail.com', 'http://www.akconstructionco.com'),
('Moon', 'Parlato', 'Ambelang, Jessica M Md', '74989 Brandon St', 'Wellsville', 'Allegany', 'NY', '14895', '585-866-8313', '585-498-4278', 'moon@yahoo.com', 'http://www.ambelangjessicammd.com'),
('Laurel', 'Reitler', 'Q A Service', '6 Kains Ave', 'Baltimore', 'Baltimore City', 'MD', '21215', '410-520-4832', '410-957-6903', 'laurel_reitler@reitler.com', 'http://www.qaservice.com'),
('Delisa', 'Crupi', 'Wood & Whitacre Contractors', '47565 W Grand Ave', 'Newark', 'Essex', 'NJ', '7105', '973-354-2040', '973-847-9611', 'delisa.crupi@crupi.com', 'http://www.woodwhitacrecontractors.com'),
('Viva', 'Toelkes', 'Mark Iv Press Ltd', '4284 Dorigo Ln', 'Chicago', 'Cook', 'IL', '60647', '773-446-5569', '773-352-3437', 'viva.toelkes@gmail.com', 'http://www.markivpressltd.com'),
('Elza', 'Lipke', 'Museum Of Science & Industry', '6794 Lake Dr E', 'Newark', 'Essex', 'NJ', '7104', '973-927-3447', '973-796-3667', 'elza@yahoo.com', 'http://www.museumofscienceindustry.com'),
('Devorah', 'Chickering', 'Garrison Ind', '31 Douglas Blvd #950', 'Clovis', 'Curry', 'NM', '88101', '505-975-8559', '505-950-1763', 'devorah@hotmail.com', 'http://www.garrisonind.com'),
('Timothy', 'Mulqueen', 'Saronix Nymph Products', '44 W 4th St', 'Staten Island', 'Richmond', 'NY', '10309', '718-332-6527', '718-654-7063', 'timothy_mulqueen@mulqueen.org', 'http://www.saronixnymphproducts.com'),
('Arlette', 'Honeywell', 'Smc Inc', '11279 Loytan St', 'Jacksonville', 'Duval', 'FL', '32254', '904-775-4480', '904-514-9918', 'ahoneywell@honeywell.com', 'http://www.smcinc.com'),
('Dominque', 'Dickerson', 'E A I Electronic Assocs Inc', '69 Marquette Ave', 'Hayward', 'Alameda', 'CA', '94545', '510-993-3758', '510-901-7640', 'dominque.dickerson@dickerson.org', 'http://www.eaielectronicassocsinc.com'),
('Lettie', 'Isenhower', 'Conte, Christopher A Esq', '70 W Main St', 'Beachwood', 'Cuyahoga', 'OH', '44122', '216-657-7668', '216-733-8494', 'lettie_isenhower@yahoo.com', 'http://www.contechristopheraesq.com'),
('Myra', 'Munns', 'Anker Law Office', '461 Prospect Pl #316', 'Euless', 'Tarrant', 'TX', '76040', '817-914-7518', '817-451-3518', 'mmunns@cox.net', 'http://www.ankerlawoffice.com'),
('Stephaine', 'Barfield', 'Beutelschies & Company', '47154 Whipple Ave Nw', 'Gardena', 'Los Angeles', 'CA', '90247', '310-774-7643', '310-968-1219', 'stephaine@barfield.com', 'http://www.beutelschiescompany.com'),
('Lai', 'Gato', 'Fligg, Kenneth I Jr', '37 Alabama Ave', 'Evanston', 'Cook', 'IL', '60201', '847-728-7286', '847-957-4614', 'lai.gato@gato.org', 'http://www.fliggkennethijr.com'),
('Stephen', 'Emigh', 'Sharp, J Daniel Esq', '3777 E Richmond St #900', 'Akron', 'Summit', 'OH', '44302', '330-537-5358', '330-700-2312', 'stephen_emigh@hotmail.com', 'http://www.sharpjdanielesq.com'),
('Tyra', 'Shields', 'Assink, Anne H Esq', '3 Fort Worth Ave', 'Philadelphia', 'Philadelphia', 'PA', '19106', '215-255-1641', '215-228-8264', 'tshields@gmail.com', 'http://www.assinkannehesq.com'),
('Tammara', 'Wardrip', 'Jewel My Shop Inc', '4800 Black Horse Pike', 'Burlingame', 'San Mateo', 'CA', '94010', '650-803-1936', '650-216-5075', 'twardrip@cox.net', 'http://www.jewelmyshopinc.com'),
('Cory', 'Gibes', 'Chinese Translation Resources', '83649 W Belmont Ave', 'San Gabriel', 'Los Angeles', 'CA', '91776', '626-572-1096', '626-696-2777', 'cory.gibes@gmail.com', 'http://www.chinesetranslationresources.com'),
('Danica', 'Bruschke', 'Stevens, Charles T', '840 15th Ave', 'Waco', 'McLennan', 'TX', '76708', '254-782-8569', '254-205-1422', 'danica_bruschke@gmail.com', 'http://www.stevenscharlest.com'),
('Wilda', 'Giguere', 'Mclaughlin, Luther W Cpa', '1747 Calle Amanecer #2', 'Anchorage', 'Anchorage', 'AK', '99501', '907-870-5536', '907-914-9482', 'wilda@cox.net', 'http://www.mclaughlinlutherwcpa.com'),
('Elvera', 'Benimadho', 'Tree Musketeers', '99385 Charity St #840', 'San Jose', 'Santa Clara', 'CA', '95110', '408-703-8505', '408-440-8447', 'elvera.benimadho@cox.net', 'http://www.treemusketeers.com'),
('Carma', 'Vanheusen', 'Springfield Div Oh Edison Co', '68556 Central Hwy', 'San Leandro', 'Alameda', 'CA', '94577', '510-503-7169', '510-452-4835', 'carma@cox.net', 'http://www.springfielddivohedisonco.com'),
('Malinda', 'Hochard', 'Logan Memorial Hospital', '55 Riverside Ave', 'Indianapolis', 'Marion', 'IN', '46202', '317-722-5066', '317-472-2412', 'malinda.hochard@yahoo.com', 'http://www.loganmemorialhospital.com'),
('Natalie', 'Fern', 'Kelly, Charles G Esq', '7140 University Ave', 'Rock Springs', 'Sweetwater', 'WY', '82901', '307-704-8713', '307-279-3793', 'natalie.fern@hotmail.com', 'http://www.kellycharlesgesq.com'),
('Lisha', 'Centini', 'Industrial Paper Shredders Inc', '64 5th Ave #1153', 'Mc Lean', 'Fairfax', 'VA', '22102', '703-235-3937', '703-475-7568', 'lisha@centini.org', 'http://www.industrialpapershreddersinc.com'),
('Arlene', 'Klusman', 'Beck Horizon Builders', '3 Secor Rd', 'New Orleans', 'Orleans', 'LA', '70112', '504-710-5840', '504-946-1807', 'arlene_klusman@gmail.com', 'http://www.beckhorizonbuilders.com'),
('Alease', 'Buemi', 'Porto Cayo At Hawks Cay', '4 Webbs Chapel Rd', 'Boulder', 'Boulder', 'CO', '80303', '303-301-4946', '303-521-9860', 'alease@buemi.com', 'http://www.portocayoathawkscay.com'),
('Louisa', 'Cronauer', 'Pacific Grove Museum Ntrl Hist', '524 Louisiana Ave Nw', 'San Leandro', 'Alameda', 'CA', '94577', '510-828-7047', '510-472-7758', 'louisa@cronauer.com', 'http://www.pacificgrovemuseumntrlhist.com'),
('Angella', 'Cetta', 'Bender & Hatley Pc', '185 Blackstone Bldge', 'Honolulu', 'Honolulu', 'HI', '96817', '808-892-7943', '808-475-2310', 'angella.cetta@hotmail.com', 'http://www.benderhatleypc.com'),
('Cyndy', 'Goldammer', 'Di Cristina J & Son', '170 Wyoming Ave', 'Burnsville', 'Dakota', 'MN', '55337', '952-334-9408', '952-938-9457', 'cgoldammer@cox.net', 'http://www.dicristinajson.com'),
('Rosio', 'Cork', 'Green Goddess', '4 10th St W', 'High Point', 'Guilford', 'NC', '27263', '336-243-5659', '336-497-4407', 'rosio.cork@gmail.com', 'http://www.greengoddess.com'),
('Celeste', 'Korando', 'American Arts & Graphics', '7 W Pinhook Rd', 'Lynbrook', 'Nassau', 'NY', '11563', '516-509-2347', '516-365-7266', 'ckorando@hotmail.com', 'http://www.americanartsgraphics.com'),
('Twana', 'Felger', 'Opryland Hotel', '1 Commerce Way', 'Portland', 'Washington', 'OR', '97224', '503-939-3153', '503-909-7167', 'twana.felger@felger.org', 'http://www.oprylandhotel.com'),
('Estrella', 'Samu', 'Marking Devices Pubg Co', '64 Lakeview Ave', 'Beloit', 'Rock', 'WI', '53511', '608-976-7199', '608-942-8836', 'estrella@aol.com', 'http://www.markingdevicespubgco.com'),
('Donte', 'Kines', 'W Tc Industries Inc', '3 Aspen St', 'Worcester', 'Worcester', 'MA', '1602', '508-429-8576', '508-843-1426', 'dkines@hotmail.com', 'http://www.wtcindustriesinc.com'),
('Tiffiny', 'Steffensmeier', 'Whitehall Robbins Labs Divsn', '32860 Sierra Rd', 'Miami', 'Miami-Dade', 'FL', '33133', '305-385-9695', '305-304-6573', 'tiffiny_steffensmeier@cox.net', 'http://www.whitehallrobbinslabsdivsn.com'),
('Edna', 'Miceli', 'Sampler', '555 Main St', 'Erie', 'Erie', 'PA', '16502', '814-460-2655', '814-299-2877', 'emiceli@miceli.org', 'http://www.sampler.com'),
('Sue', 'Kownacki', 'Juno Chefs Incorporated', '2 Se 3rd Ave', 'Mesquite', 'Dallas', 'TX', '75149', '972-666-3413', '972-742-4000', 'sue@aol.com', 'http://www.junochefsincorporated.com'),
('Jesusa', 'Shin', 'Carroccio, A Thomas Esq', '2239 Shawnee Mission Pky', 'Tullahoma', 'Coffee', 'TN', '37388', '931-273-8709', '931-739-1551', 'jshin@shin.com', 'http://www.carroccioathomasesq.com'),
('Rolland', 'Francescon', 'Stanley, Richard L Esq', '2726 Charcot Ave', 'Paterson', 'Passaic', 'NJ', '7501', '973-649-2922', '973-284-4048', 'rolland@cox.net', 'http://www.stanleyrichardlesq.com'),
('Pamella', 'Schmierer', 'K Cs Cstm Mouldings Windows', '5161 Dorsett Rd', 'Homestead', 'Miami-Dade', 'FL', '33030', '305-420-8970', '305-575-8481', 'pamella.schmierer@schmierer.org', 'http://www.kcscstmmouldingswindows.com'),
('Glory', 'Kulzer', 'Comfort Inn', '55892 Jacksonville Rd', 'Owings Mills', 'Baltimore', 'MD', '21117', '410-224-9462', '410-916-8015', 'gkulzer@kulzer.org', 'http://www.comfortinn.com'),
('Shawna', 'Palaspas', 'Windsor, James L Esq', '5 N Cleveland Massillon Rd', 'Thousand Oaks', 'Ventura', 'CA', '91362', '805-275-3566', '805-638-6617', 'shawna_palaspas@palaspas.org', 'http://www.windsorjameslesq.com'),
('Brandon', 'Callaro', 'Jackson Shields Yeiser', '7 Benton Dr', 'Honolulu', 'Honolulu', 'HI', '96819', '808-215-6832', '808-240-5168', 'brandon_callaro@hotmail.com', 'http://www.jacksonshieldsyeiser.com'),
('Scarlet', 'Cartan', 'Box, J Calvin Esq', '9390 S Howell Ave', 'Albany', 'Dougherty', 'GA', '31701', '229-735-3378', '229-365-9658', 'scarlet.cartan@yahoo.com', 'http://www.boxjcalvinesq.com'),
('Oretha', 'Menter', 'Custom Engineering Inc', '8 County Center Dr #647', 'Boston', 'Suffolk', 'MA', '2210', '617-418-5043', '617-697-6024', 'oretha_menter@yahoo.com', 'http://www.customengineeringinc.com'),
('Ty', 'Smith', 'Bresler Eitel Framg Gllry Ltd', '4646 Kaahumanu St', 'Hackensack', 'Bergen', 'NJ', '7601', '201-672-1553', '201-995-3149', 'tsmith@aol.com', 'http://www.breslereitelframggllryltd.com'),
('Xuan', 'Rochin', 'Carol, Drake Sparks Esq', '2 Monroe St', 'San Mateo', 'San Mateo', 'CA', '94403', '650-933-5072', '650-247-2625', 'xuan@gmail.com', 'http://www.caroldrakesparksesq.com'),
('Lindsey', 'Dilello', 'Biltmore Investors Bank', '52777 Leaders Heights Rd', 'Ontario', 'San Bernardino', 'CA', '91761', '909-639-9887', '909-589-1693', 'lindsey.dilello@hotmail.com', 'http://www.biltmoreinvestorsbank.com'),
('Devora', 'Perez', 'Desco Equipment Corp', '72868 Blackington Ave', 'Oakland', 'Alameda', 'CA', '94606', '510-955-3016', '510-755-9274', 'devora_perez@perez.org', 'http://www.descoequipmentcorp.com'),
('Herman', 'Demesa', 'Merlin Electric Co', '9 Norristown Rd', 'Troy', 'Rensselaer', 'NY', '12180', '518-497-2940', '518-931-7852', 'hdemesa@cox.net', 'http://www.merlinelectricco.com'),
('Rory', 'Papasergi', 'Bailey Cntl Co Div Babcock', '83 County Road 437 #8581', 'Clarks Summit', 'Lackawanna', 'PA', '18411', '570-867-7489', '570-469-8401', 'rpapasergi@cox.net', 'http://www.baileycntlcodivbabcock.com'),
('Talia', 'Riopelle', 'Ford Brothers Wholesale Inc', '1 N Harlem Ave #9', 'Orange', 'Essex', 'NJ', '7050', '973-245-2133', '973-818-9788', 'talia_riopelle@aol.com', 'http://www.fordbrotherswholesaleinc.com'),
('Van', 'Shire', 'Cambridge Inn', '90131 J St', 'Pittstown', 'Hunterdon', 'NJ', '8867', '908-409-2890', '908-448-1209', 'van.shire@shire.com', 'http://www.cambridgeinn.com'),
('Lucina', 'Lary', 'Matricciani, Albert J Jr', '8597 W National Ave', 'Cocoa', 'Brevard', 'FL', '32922', '321-749-4981', '321-632-4668', 'lucina_lary@cox.net', 'http://www.matriccianialbertjjr.com'),
('Bok', 'Isaacs', 'Nelson Hawaiian Ltd', '6 Gilson St', 'Bronx', 'Bronx', 'NY', '10468', '718-809-3762', '718-478-8568', 'bok.isaacs@aol.com', 'http://www.nelsonhawaiianltd.com'),
('Rolande', 'Spickerman', 'Neland Travel Agency', '65 W Maple Ave', 'Pearl City', 'Honolulu', 'HI', '96782', '808-315-3077', '808-526-5863', 'rolande.spickerman@spickerman.com', 'http://www.nelandtravelagency.com'),
('Howard', 'Paulas', 'Asendorf, J Alan Esq', '866 34th Ave', 'Denver', 'Denver', 'CO', '80231', '303-623-4241', '303-692-3118', 'hpaulas@gmail.com', 'http://www.asendorfjalanesq.com'),
('Kimbery', 'Madarang', 'Silberman, Arthur L Esq', '798 Lund Farm Way', 'Rockaway', 'Morris', 'NJ', '7866', '973-310-1634', '973-225-6259', 'kimbery_madarang@cox.net', 'http://www.silbermanarthurlesq.com'),
('Thurman', 'Manno', 'Honey Bee Breeding Genetics &', '9387 Charcot Ave', 'Absecon', 'Atlantic', 'NJ', '8201', '609-524-3586', '609-234-8376', 'thurman.manno@yahoo.com', 'http://www.honeybeebreedinggenetics.com'),
('Becky', 'Mirafuentes', 'Wells Kravitz Schnitzer', '30553 Washington Rd', 'Plainfield', 'Union', 'NJ', '7062', '908-877-8409', '908-426-8272', 'becky.mirafuentes@mirafuentes.com', 'http://www.wellskravitzschnitzer.com'),
('Beatriz', 'Corrington', 'Prohab Rehabilitation Servs', '481 W Lemon St', 'Middleboro', 'Plymouth', 'MA', '2346', '508-584-4279', '508-315-3867', 'beatriz@yahoo.com', 'http://www.prohabrehabilitationservs.com'),
('Marti', 'Maybury', 'Eldridge, Kristin K Esq', '4 Warehouse Point Rd #7', 'Chicago', 'Cook', 'IL', '60638', '773-775-4522', '773-539-1058', 'marti.maybury@yahoo.com', 'http://www.eldridgekristinkesq.com'),
('Nieves', 'Gotter', 'Vlahos, John J Esq', '4940 Pulaski Park Dr', 'Portland', 'Multnomah', 'OR', '97202', '503-527-5274', '503-455-3094', 'nieves_gotter@gmail.com', 'http://www.vlahosjohnjesq.com'),
('Leatha', 'Hagele', 'Ninas Indian Grs & Videos', '627 Walford Ave', 'Dallas', 'Dallas', 'TX', '75227', '214-339-1809', '214-225-5850', 'lhagele@cox.net', 'http://www.ninasindiangrsvideos.com'),
('Valentin', 'Klimek', 'Schmid, Gayanne K Esq', '137 Pioneer Way', 'Chicago', 'Cook', 'IL', '60604', '312-303-5453', '312-512-2338', 'vklimek@klimek.org', 'http://www.schmidgayannekesq.com'),
('Melissa', 'Wiklund', 'Moapa Valley Federal Credit Un', '61 13 Stoneridge #835', 'Findlay', 'Hancock', 'OH', '45840', '419-939-3613', '419-254-4591', 'melissa@cox.net', 'http://www.moapavalleyfederalcreditun.com'),
('Sheridan', 'Zane', 'Kentucky Tennessee Clay Co', '2409 Alabama Rd', 'Riverside', 'Riverside', 'CA', '92501', '951-645-3605', '951-248-6822', 'sheridan.zane@zane.com', 'http://www.kentuckytennesseeclayco.com'),
('Bulah', 'Padilla', 'Admiral Party Rentals & Sales', '8927 Vandever Ave', 'Waco', 'McLennan', 'TX', '76707', '254-463-4368', '254-816-8417', 'bulah_padilla@hotmail.com', 'http://www.admiralpartyrentalssales.com'),
('Audra', 'Kohnert', 'Nelson, Karolyn King Esq', '134 Lewis Rd', 'Nashville', 'Davidson', 'TN', '37211', '615-406-7854', '615-448-9249', 'audra@kohnert.com', 'http://www.nelsonkarolynkingesq.com'),
('Daren', 'Weirather', 'Panasystems', '9 N College Ave #3', 'Milwaukee', 'Milwaukee', 'WI', '53216', '414-959-2540', '414-838-3151', 'dweirather@aol.com', 'http://www.panasystems.com'),
('Fernanda', 'Jillson', 'Shank, Edward L Esq', '60480 Old Us Highway 51', 'Preston', 'Caroline', 'MD', '21655', '410-387-5260', '410-724-6472', 'fjillson@aol.com', 'http://www.shankedwardlesq.com'),
('Gearldine', 'Gellinger', 'Megibow & Edwards', '4 Bloomfield Ave', 'Irving', 'Dallas', 'TX', '75061', '972-934-6914', '972-821-7118', 'gearldine_gellinger@gellinger.com', 'http://www.megibowedwards.com'),
('Chau', 'Kitzman', 'Benoff, Edward Esq', '429 Tiger Ln', 'Beverly Hills', 'Los Angeles', 'CA', '90212', '310-560-8022', '310-969-7230', 'chau@gmail.com', 'http://www.benoffedwardesq.com'),
('Theola', 'Frey', 'Woodbridge Free Public Library', '54169 N Main St', 'Massapequa', 'Nassau', 'NY', '11758', '516-948-5768', '516-357-3362', 'theola_frey@frey.com', 'http://www.woodbridgefreepubliclibrary.com'),
('Cheryl', 'Haroldson', 'New York Life John Thune', '92 Main St', 'Atlantic City', 'Atlantic', 'NJ', '8401', '609-518-7697', '609-263-9243', 'cheryl@haroldson.org', 'http://www.newyorklifejohnthune.com'),
('Laticia', 'Merced', 'Alinabal Inc', '72 Mannix Dr', 'Cincinnati', 'Hamilton', 'OH', '45203', '513-508-7371', '513-418-1566', 'lmerced@gmail.com', 'http://www.alinabalinc.com'),
('Carissa', 'Batman', 'Poletto, Kim David Esq', '12270 Caton Center Dr', 'Eugene', 'Lane', 'OR', '97401', '541-326-4074', '541-801-5717', 'carissa.batman@yahoo.com', 'http://www.polettokimdavidesq.com'),
('Lezlie', 'Craghead', 'Chang, Carolyn Esq', '749 W 18th St #45', 'Smithfield', 'Johnston', 'NC', '27577', '919-533-3762', '919-885-2453', 'lezlie.craghead@craghead.org', 'http://www.changcarolynesq.com'),
('Ozell', 'Shealy', 'Silver Bros Inc', '8 Industry Ln', 'New York', 'New York', 'NY', '10002', '212-332-8435', '212-880-8865', 'oshealy@hotmail.com', 'http://www.silverbrosinc.com'),
('Arminda', 'Parvis', 'Newtec Inc', '1 Huntwood Ave', 'Phoenix', 'Maricopa', 'AZ', '85017', '602-906-9419', '602-277-3025', 'arminda@parvis.com', 'http://www.newtecinc.com'),
('Reita', 'Leto', 'Creative Business Systems', '55262 N French Rd', 'Indianapolis', 'Marion', 'IN', '46240', '317-234-1135', '317-787-5514', 'reita.leto@gmail.com', 'http://www.creativebusinesssystems.com'),
('Yolando', 'Luczki', 'Dal Tile Corporation', '422 E 21st St', 'Syracuse', 'Onondaga', 'NY', '13214', '315-304-4759', '315-640-6357', 'yolando@cox.net', 'http://www.daltilecorporation.com'),
('Lizette', 'Stem', 'Edward S Katz', '501 N 19th Ave', 'Cherry Hill', 'Camden', 'NJ', '8002', '856-487-5412', '856-702-3676', 'lizette.stem@aol.com', 'http://www.edwardskatz.com'),
('Gregoria', 'Pawlowicz', 'Oh My Goodknits Inc', '455 N Main Ave', 'Garden City', 'Nassau', 'NY', '11530', '516-212-1915', '516-376-4230', 'gpawlowicz@yahoo.com', 'http://www.ohmygoodknitsinc.com'),
('Carin', 'Deleo', 'Redeker, Debbie', '1844 Southern Blvd', 'Little Rock', 'Pulaski', 'AR', '72202', '501-308-1040', '501-409-6072', 'cdeleo@deleo.com', 'http://www.redekerdebbie.com'),
('Chantell', 'Maynerich', 'Desert Sands Motel', '2023 Greg St', 'Saint Paul', 'Ramsey', 'MN', '55101', '651-591-2583', '651-776-9688', 'chantell@yahoo.com', 'http://www.desertsandsmotel.com'),
('Dierdre', 'Yum', 'Cummins Southern Plains Inc', '63381 Jenks Ave', 'Philadelphia', 'Philadelphia', 'PA', '19134', '215-325-3042', '215-346-4666', 'dyum@yahoo.com', 'http://www.cumminssouthernplainsinc.com'),
('Larae', 'Gudroe', 'Lehigh Furn Divsn Lehigh', '6651 Municipal Rd', 'Houma', 'Terrebonne', 'LA', '70360', '985-890-7262', '985-261-5783', 'larae_gudroe@gmail.com', 'http://www.lehighfurndivsnlehigh.com'),
('Latrice', 'Tolfree', 'United Van Lines Agent', '81 Norris Ave #525', 'Ronkonkoma', 'Suffolk', 'NY', '11779', '631-957-7624', '631-998-2102', 'latrice.tolfree@hotmail.com', 'http://www.unitedvanlinesagent.com'),
('Kerry', 'Theodorov', 'Capitol Reporters', '6916 W Main St', 'Sacramento', 'Sacramento', 'CA', '95827', '916-591-3277', '916-770-7448', 'kerry.theodorov@gmail.com', 'http://www.capitolreporters.com'),
('Dorthy', 'Hidvegi', 'Kwik Kopy Printing', '9635 S Main St', 'Boise', 'Ada', 'ID', '83704', '208-649-2373', '208-690-3315', 'dhidvegi@yahoo.com', 'http://www.kwikkopyprinting.com'),
('Fannie', 'Lungren', 'Centro Inc', '17 Us Highway 111', 'Round Rock', 'Williamson', 'TX', '78664', '512-587-5746', '512-528-9933', 'fannie.lungren@yahoo.com', 'http://www.centroinc.com'),
('Evangelina', 'Radde', 'Campbell, Jan Esq', '992 Civic Center Dr', 'Philadelphia', 'Philadelphia', 'PA', '19123', '215-964-3284', '215-417-5612', 'evangelina@aol.com', 'http://www.campbelljanesq.com'),
('Novella', 'Degroot', 'Evans, C Kelly Esq', '303 N Radcliffe St', 'Hilo', 'Hawaii', 'HI', '96720', '808-477-4775', '808-746-1865', 'novella_degroot@degroot.org', 'http://www.evansckellyesq.com'),
('Clay', 'Hoa', 'Scat Enterprises', '73 Saint Ann St #86', 'Reno', 'Washoe', 'NV', '89502', '775-501-8109', '775-848-9135', 'choa@hoa.org', 'http://www.scatenterprises.com'),
('Jennifer', 'Fallick', 'Nagle, Daniel J Esq', '44 58th St', 'Wheeling', 'Cook', 'IL', '60090', '847-979-9545', '847-800-3054', 'jfallick@yahoo.com', 'http://www.nagledanieljesq.com'),
('Irma', 'Wolfgramm', 'Serendiquity Bed & Breakfast', '9745 W Main St', 'Randolph', 'Morris', 'NJ', '7869', '973-545-7355', '973-868-8660', 'irma.wolfgramm@hotmail.com', 'http://www.serendiquitybedbreakfast.com'),
('Eun', 'Coody', 'Ray Carolyne Realty', '84 Bloomfield Ave', 'Spartanburg', 'Spartanburg', 'SC', '29301', '864-256-3620', '864-594-4578', 'eun@yahoo.com', 'http://www.raycarolynerealty.com'),
('Sylvia', 'Cousey', 'Berg, Charles E', '287 Youngstown Warren Rd', 'Hampstead', 'Carroll', 'MD', '21074', '410-209-9545', '410-863-8263', 'sylvia_cousey@cousey.org', 'http://www.bergcharlese.com'),
('Nana', 'Wrinkles', 'Ray, Milbern D', '6 Van Buren St', 'Mount Vernon', 'Westchester', 'NY', '10553', '914-855-2115', '914-796-3775', 'nana@aol.com', 'http://www.raymilbernd.com'),
('Layla', 'Springe', 'Chadds Ford Winery', '229 N Forty Driv', 'New York', 'New York', 'NY', '10011', '212-260-3151', '212-253-7448', 'layla.springe@cox.net', 'http://www.chaddsfordwinery.com'),
('Joesph', 'Degonia', 'A R Packaging', '2887 Knowlton St #5435', 'Berkeley', 'Alameda', 'CA', '94710', '510-677-9785', '510-942-5916', 'joesph_degonia@degonia.org', 'http://www.arpackaging.com'),
('Annabelle', 'Boord', 'Corn Popper', '523 Marquette Ave', 'Concord', 'Middlesex', 'MA', '1742', '978-697-6263', '978-289-7717', 'annabelle.boord@cox.net', 'http://www.cornpopper.com'),
('Stephaine', 'Vinning', 'Birite Foodservice Distr', '3717 Hamann Industrial Pky', 'San Francisco', 'San Francisco', 'CA', '94104', '415-767-6596', '415-712-9530', 'stephaine@cox.net', 'http://www.biritefoodservicedistr.com'),
('Nelida', 'Sawchuk', 'Anchorage Museum Of Hist & Art', '3 State Route 35 S', 'Paramus', 'Bergen', 'NJ', '7652', '201-971-1638', '201-247-8925', 'nelida@gmail.com', 'http://www.anchoragemuseumofhistart.com'),
('Marguerita', 'Hiatt', 'Haber, George D Md', '82 N Highway 67', 'Oakley', 'Contra Costa', 'CA', '94561', '925-634-7158', '925-541-8521', 'marguerita.hiatt@gmail.com', 'http://www.habergeorgedmd.com'),
('Carmela', 'Cookey', 'Royal Pontiac Olds Inc', '9 Murfreesboro Rd', 'Chicago', 'Cook', 'IL', '60623', '773-494-4195', '773-297-9391', 'ccookey@cookey.org', 'http://www.royalpontiacoldsinc.com'),
('Junita', 'Brideau', 'Leonards Antiques Inc', '6 S Broadway St', 'Cedar Grove', 'Essex', 'NJ', '7009', '973-943-3423', '973-582-5469', 'jbrideau@aol.com', 'http://www.leonardsantiquesinc.com'),
('Claribel', 'Varriano', 'Meca', '6 Harry L Dr #6327', 'Perrysburg', 'Wood', 'OH', '43551', '419-544-4900', '419-573-2033', 'claribel_varriano@cox.net', 'http://www.meca.com'),
('Benton', 'Skursky', 'Nercon Engineering & Mfg Inc', '47939 Porter Ave', 'Gardena', 'Los Angeles', 'CA', '90248', '310-579-2907', '310-694-8466', 'benton.skursky@aol.com', 'http://www.nerconengineeringmfginc.com'),
('Hillary', 'Skulski', 'Replica I', '9 Wales Rd Ne #914', 'Homosassa', 'Citrus', 'FL', '34448', '352-242-2570', '352-990-5946', 'hillary.skulski@aol.com', 'http://www.replicai.com'),
('Merilyn', 'Bayless', '20 20 Printing Inc', '195 13n N', 'Santa Clara', 'Santa Clara', 'CA', '95054', '408-758-5015', '408-346-2180', 'merilyn_bayless@cox.net', 'http://www.printinginc.com'),
('Teri', 'Ennaco', 'Publishers Group West', '99 Tank Farm Rd', 'Hazleton', 'Luzerne', 'PA', '18201', '570-889-5187', '570-355-1665', 'tennaco@gmail.com', 'http://www.publishersgroupwest.com'),
('Merlyn', 'Lawler', 'Nischwitz, Jeffrey L Esq', '4671 Alemany Blvd', 'Jersey City', 'Hudson', 'NJ', '7304', '201-588-7810', '201-858-9960', 'merlyn_lawler@hotmail.com', 'http://www.nischwitzjeffreylesq.com'),
('Georgene', 'Montezuma', 'Payne Blades & Wellborn Pa', '98 University Dr', 'San Ramon', 'Contra Costa', 'CA', '94583', '925-615-5185', '925-943-3449', 'gmontezuma@cox.net', 'http://www.paynebladeswellbornpa.com'),
('Jettie', 'Mconnell', 'Coldwell Bnkr Wright Real Est', '50 E Wacker Dr', 'Bridgewater', 'Somerset', 'NJ', '8807', '908-802-3564', '908-602-5258', 'jmconnell@hotmail.com', 'http://www.coldwellbnkrwrightrealest.com'),
('Lemuel', 'Latzke', 'Computer Repair Service', '70 Euclid Ave #722', 'Bohemia', 'Suffolk', 'NY', '11716', '631-748-6479', '631-291-4976', 'lemuel.latzke@gmail.com', 'http://www.computerrepairservice.com'),
('Melodie', 'Knipp', 'Fleetwood Building Block Inc', '326 E Main St #6496', 'Thousand Oaks', 'Ventura', 'CA', '91362', '805-690-1682', '805-810-8964', 'mknipp@gmail.com', 'http://www.fleetwoodbuildingblockinc.com'),
('Candida', 'Corbley', 'Colts Neck Medical Assocs Inc', '406 Main St', 'Somerville', 'Somerset', 'NJ', '8876', '908-275-8357', '908-943-6103', 'candida_corbley@hotmail.com', 'http://www.coltsneckmedicalassocsinc.com'),
('Karan', 'Karpin', 'New England Taxidermy', '3 Elmwood Dr', 'Beaverton', 'Washington', 'OR', '97005', '503-940-8327', '503-707-5812', 'karan_karpin@gmail.com', 'http://www.newenglandtaxidermy.com'),
('Andra', 'Scheyer', 'Ludcke, George O Esq', '9 Church St', 'Salem', 'Marion', 'OR', '97302', '503-516-2189', '503-950-3068', 'andra@gmail.com', 'http://www.ludckegeorgeoesq.com'),
('Felicidad', 'Poullion', 'Mccorkle, Tom S Esq', '9939 N 14th St', 'Riverton', 'Burlington', 'NJ', '8077', '856-305-9731', '856-828-6021', 'fpoullion@poullion.com', 'http://www.mccorkletomsesq.com'),
('Belen', 'Strassner', 'Eagle Software Inc', '5384 Southwyck Blvd', 'Douglasville', 'Douglas', 'GA', '30135', '770-507-8791', '770-802-4003', 'belen_strassner@aol.com', 'http://www.eaglesoftwareinc.com'),
('Gracia', 'Melnyk', 'Juvenile & Adult Super', '97 Airport Loop Dr', 'Jacksonville', 'Duval', 'FL', '32216', '904-235-3633', '904-627-4341', 'gracia@melnyk.com', 'http://www.juvenileadultsuper.com'),
('Jolanda', 'Hanafan', 'Perez, Joseph J Esq', '37855 Nolan Rd', 'Bangor', 'Penobscot', 'ME', '4401', '207-458-9196', '207-233-6185', 'jhanafan@gmail.com', 'http://www.perezjosephjesq.com'),
('Barrett', 'Toyama', 'Case Foundation Co', '4252 N Washington Ave #9', 'Kennedale', 'Tarrant', 'TX', '76060', '817-765-5781', '817-577-6151', 'barrett.toyama@toyama.org', 'http://www.casefoundationco.com'),
('Helga', 'Fredicks', 'Eis Environmental Engrs Inc', '42754 S Ash Ave', 'Buffalo', 'Erie', 'NY', '14228', '716-752-4114', '716-854-9845', 'helga_fredicks@yahoo.com', 'http://www.eisenvironmentalengrsinc.com'),
('Ashlyn', 'Pinilla', 'Art Crafters', '703 Beville Rd', 'Opa Locka', 'Miami-Dade', 'FL', '33054', '305-670-9628', '305-857-5489', 'apinilla@cox.net', 'http://www.artcrafters.com'),
('Fausto', 'Agramonte', 'Marriott Hotels Resorts Suites', '5 Harrison Rd', 'New York', 'New York', 'NY', '10038', '212-313-1783', '212-778-3063', 'fausto_agramonte@yahoo.com', 'http://www.marriotthotelsresortssuites.com'),
('Ronny', 'Caiafa', 'Remaco Inc', '73 Southern Blvd', 'Philadelphia', 'Philadelphia', 'PA', '19103', '215-605-7570', '215-511-3531', 'ronny.caiafa@caiafa.org', 'http://www.remacoinc.com'),
('Marge', 'Limmel', 'Bjork, Robert D Jr', '189 Village Park Rd', 'Crestview', 'Okaloosa', 'FL', '32536', '850-430-1663', '850-330-8079', 'marge@gmail.com', 'http://www.bjorkrobertdjr.com'),
('Norah', 'Waymire', 'Carmichael, Jeffery L Esq', '6 Middlegate Rd #106', 'San Francisco', 'San Francisco', 'CA', '94107', '415-306-7897', '415-874-2984', 'norah.waymire@gmail.com', 'http://www.carmichaeljefferylesq.com'),
('Aliza', 'Baltimore', 'Andrews, J Robert Esq', '1128 Delaware St', 'San Jose', 'Santa Clara', 'CA', '95132', '408-504-3552', '408-425-1994', 'aliza@aol.com', 'http://www.andrewsjrobertesq.com'),
('Mozell', 'Pelkowski', 'Winship & Byrne', '577 Parade St', 'South San Francisco', 'San Mateo', 'CA', '94080', '650-947-1215', '650-960-1069', 'mpelkowski@pelkowski.org', 'http://www.winshipbyrne.com'),
('Viola', 'Bitsuie', 'Burton & Davis', '70 Mechanic St', 'Northridge', 'Los Angeles', 'CA', '91325', '818-864-4875', '818-481-5787', 'viola@gmail.com', 'http://www.burtondavis.com'),
('Franklyn', 'Emard', 'Olympic Graphic Arts', '4379 Highway 116', 'Philadelphia', 'Philadelphia', 'PA', '19103', '215-558-8189', '215-483-3003', 'femard@emard.com', 'http://www.olympicgraphicarts.com'),
('Willodean', 'Konopacki', 'Magnuson', '55 Hawthorne Blvd', 'Lafayette', 'Lafayette', 'LA', '70506', '337-253-8384', '337-774-7564', 'willodean_konopacki@konopacki.org', 'http://www.magnuson.com'),
('Beckie', 'Silvestrini', 'A All American Travel Inc', '7116 Western Ave', 'Dearborn', 'Wayne', 'MI', '48126', '313-533-4884', '313-390-7855', 'beckie.silvestrini@silvestrini.com', 'http://www.aallamericantravelinc.com'),
('Rebecka', 'Gesick', 'Polykote Inc', '2026 N Plankinton Ave #3', 'Austin', 'Travis', 'TX', '78754', '512-213-8574', '512-693-8345', 'rgesick@gesick.org', 'http://www.polykoteinc.com'),
('Frederica', 'Blunk', 'Jets Cybernetics', '99586 Main St', 'Dallas', 'Dallas', 'TX', '75207', '214-428-2285', '214-529-1949', 'frederica_blunk@gmail.com', 'http://www.jetscybernetics.com'),
('Glen', 'Bartolet', 'Metlab Testing Services', '8739 Hudson St', 'Vashon', 'King', 'WA', '98070', '206-697-5796', '206-389-1482', 'glen_bartolet@hotmail.com', 'http://www.metlabtestingservices.com'),
('Freeman', 'Gochal', 'Kellermann, William T Esq', '383 Gunderman Rd #197', 'Coatesville', 'Chester', 'PA', '19320', '610-476-3501', '610-752-2683', 'freeman_gochal@aol.com', 'http://www.kellermannwilliamtesq.com'),
('Vincent', 'Meinerding', 'Arturi, Peter D Esq', '4441 Point Term Mkt', 'Philadelphia', 'Philadelphia', 'PA', '19143', '215-372-1718', '215-829-4221', 'vincent.meinerding@hotmail.com', 'http://www.arturipeterdesq.com'),
('Rima', 'Bevelacqua', 'Mcauley Mfg Co', '2972 Lafayette Ave', 'Gardena', 'Los Angeles', 'CA', '90248', '310-858-5079', '310-499-4200', 'rima@cox.net', 'http://www.mcauleymfgco.com'),
('Glendora', 'Sarbacher', 'Defur Voran Hanley Radcliff', '2140 Diamond Blvd', 'Rohnert Park', 'Sonoma', 'CA', '94928', '707-653-8214', '707-881-3154', 'gsarbacher@gmail.com', 'http://www.defurvoranhanleyradcliff.com'),
('Avery', 'Steier', 'Dill Dill Carr & Stonbraker Pc', '93 Redmond Rd #492', 'Orlando', 'Orange', 'FL', '32803', '407-808-9439', '407-945-8566', 'avery@cox.net', 'http://www.dilldillcarrstonbrakerpc.com'),
('Cristy', 'Lother', 'Kleensteel', '3989 Portage Tr', 'Escondido', 'San Diego', 'CA', '92025', '760-971-4322', '760-465-4762', 'cristy@lother.com', 'http://www.kleensteel.com'),
('Nicolette', 'Brossart', 'Goulds Pumps Inc Slurry Pump', '1 Midway Rd', 'Westborough', 'Worcester', 'MA', '1581', '508-837-9230', '508-504-6388', 'nicolette_brossart@brossart.com', 'http://www.gouldspumpsincslurrypump.com'),
('Tracey', 'Modzelewski', 'Kansas City Insurance Report', '77132 Coon Rapids Blvd Nw', 'Conroe', 'Montgomery', 'TX', '77301', '936-264-9294', '936-988-8171', 'tracey@hotmail.com', 'http://www.kansascityinsurancereport.com'),
('Virgina', 'Tegarden', 'Berhanu International Foods', '755 Harbor Way', 'Milwaukee', 'Milwaukee', 'WI', '53226', '414-214-8697', '414-411-5744', 'virgina_tegarden@tegarden.com', 'http://www.berhanuinternationalfoods.com'),
('Tiera', 'Frankel', 'Roland Ashcroft', '87 Sierra Rd', 'El Monte', 'Los Angeles', 'CA', '91731', '626-636-4117', '626-638-4241', 'tfrankel@aol.com', 'http://www.rolandashcroft.com'),
('Alaine', 'Bergesen', 'Hispanic Magazine', '7667 S Hulen St #42', 'Yonkers', 'Westchester', 'NY', '10701', '914-300-9193', '914-654-1426', 'alaine_bergesen@cox.net', 'http://www.hispanicmagazine.com'),
('Earleen', 'Mai', 'Little Sheet Metal Co', '75684 S Withlapopka Dr #32', 'Dallas', 'Dallas', 'TX', '75227', '214-289-1973', '214-785-6750', 'earleen_mai@cox.net', 'http://www.littlesheetmetalco.com'),
('Leonida', 'Gobern', 'Holmes, Armstead J Esq', '5 Elmwood Park Blvd', 'Biloxi', 'Harrison', 'MS', '39530', '228-235-5615', '228-432-4635', 'leonida@gobern.org', 'http://www.holmesarmsteadjesq.com'),
('Ressie', 'Auffrey', 'Faw, James C Cpa', '23 Palo Alto Sq', 'Miami', 'Miami-Dade', 'FL', '33134', '305-604-8981', '305-287-4743', 'ressie.auffrey@yahoo.com', 'http://www.fawjamesccpa.com'),
('Justine', 'Mugnolo', 'Evans Rule Company', '38062 E Main St', 'New York', 'New York', 'NY', '10048', '212-304-9225', '212-311-6377', 'jmugnolo@yahoo.com', 'http://www.evansrulecompany.com'),
('Eladia', 'Saulter', 'Tyee Productions Inc', '3958 S Dupont Hwy #7', 'Ramsey', 'Bergen', 'NJ', '7446', '201-474-4924', '201-365-8698', 'eladia@saulter.com', 'http://www.tyeeproductionsinc.com'),
('Chaya', 'Malvin', 'Dunnells & Duvall', '560 Civic Center Dr', 'Ann Arbor', 'Washtenaw', 'MI', '48103', '734-928-5182', '734-408-8174', 'chaya@malvin.com', 'http://www.dunnellsduvall.com'),
('Gwenn', 'Suffield', 'Deltam Systems Inc', '3270 Dequindre Rd', 'Deer Park', 'Suffolk', 'NY', '11729', '631-258-6558', '631-295-9879', 'gwenn_suffield@suffield.org', 'http://www.deltamsystemsinc.com'),
('Salena', 'Karpel', 'Hammill Mfg Co', '1 Garfield Ave #7', 'Canton', 'Stark', 'OH', '44707', '330-791-8557', '330-618-2579', 'skarpel@cox.net', 'http://www.hammillmfgco.com'),
('Yoko', 'Fishburne', 'Sams Corner Store', '9122 Carpenter Ave', 'New Haven', 'New Haven', 'CT', '6511', '203-506-4706', '203-840-8634', 'yoko@fishburne.com', 'http://www.samscornerstore.com'),
('Taryn', 'Moyd', 'Siskin, Mark J Esq', '48 Lenox St', 'Fairfax', 'Fairfax City', 'VA', '22030', '703-322-4041', '703-938-7939', 'taryn.moyd@hotmail.com', 'http://www.siskinmarkjesq.com'),
('Katina', 'Polidori', 'Cape & Associates Real Estate', '5 Little River Tpke', 'Wilmington', 'Middlesex', 'MA', '1887', '978-626-2978', '978-679-7429', 'katina_polidori@aol.com', 'http://www.capeassociatesrealestate.com'),
('Rickie', 'Plumer', 'Merrill Lynch', '3 N Groesbeck Hwy', 'Toledo', 'Lucas', 'OH', '43613', '419-693-1334', '419-313-5571', 'rickie.plumer@aol.com', 'http://www.merrilllynch.com'),
('Alex', 'Loader', 'Sublett, Scott Esq', '37 N Elm St #916', 'Tacoma', 'Pierce', 'WA', '98409', '253-660-7821', '253-875-9222', 'alex@loader.com', 'http://www.sublettscottesq.com'),
('Lashon', 'Vizarro', 'Sentry Signs', '433 Westminster Blvd #590', 'Roseville', 'Placer', 'CA', '95661', '916-741-7884', '916-289-4526', 'lashon@aol.com', 'http://www.sentrysigns.com'),
('Lauran', 'Burnard', 'Professionals Unlimited', '66697 Park Pl #3224', 'Riverton', 'Fremont', 'WY', '82501', '307-342-7795', '307-453-7589', 'lburnard@burnard.com', 'http://www.professionalsunlimited.com'),
('Ceola', 'Setter', 'Southern Steel Shelving Co', '96263 Greenwood Pl', 'Warren', 'Knox', 'ME', '4864', '207-627-7565', '207-297-5029', 'ceola.setter@setter.org', 'http://www.southernsteelshelvingco.com'),
('My', 'Rantanen', 'Bosco, Paul J', '8 Mcarthur Ln', 'Richboro', 'Bucks', 'PA', '18954', '215-491-5633', '215-647-2158', 'my@hotmail.com', 'http://www.boscopaulj.com'),
('Lorrine', 'Worlds', 'Longo, Nicholas J Esq', '8 Fair Lawn Ave', 'Tampa', 'Hillsborough', 'FL', '33614', '813-769-2939', '813-863-6467', 'lorrine.worlds@worlds.com', 'http://www.longonicholasjesq.com'),
('Peggie', 'Sturiale', 'Henry County Middle School', '9 N 14th St', 'El Cajon', 'San Diego', 'CA', '92020', '619-608-1763', '619-695-8086', 'peggie@cox.net', 'http://www.henrycountymiddleschool.com'),
('Marvel', 'Raymo', 'Edison Supply & Equipment Co', '9 Vanowen St', 'College Station', 'Brazos', 'TX', '77840', '979-718-8968', '979-809-5770', 'mraymo@yahoo.com', 'http://www.edisonsupplyequipmentco.com'),
('Daron', 'Dinos', 'Wolf, Warren R Esq', '18 Waterloo Geneva Rd', 'Highland Park', 'Lake', 'IL', '60035', '847-233-3075', '847-265-6609', 'daron_dinos@cox.net', 'http://www.wolfwarrenresq.com'),
('An', 'Fritz', 'Linguistic Systems Inc', '506 S Hacienda Dr', 'Atlantic City', 'Atlantic', 'NJ', '8401', '609-228-5265', '609-854-7156', 'an_fritz@hotmail.com', 'http://www.linguisticsystemsinc.com'),
('Portia', 'Stimmel', 'Peace Christian Center', '3732 Sherman Ave', 'Bridgewater', 'Somerset', 'NJ', '8807', '908-722-7128', '908-670-4712', 'portia.stimmel@aol.com', 'http://www.peacechristiancenter.com'),
('Rhea', 'Aredondo', 'Double B Foods Inc', '25657 Live Oak St', 'Brooklyn', 'Kings', 'NY', '11226', '718-560-9537', '718-280-4183', 'rhea_aredondo@cox.net', 'http://www.doublebfoodsinc.com'),
('Benedict', 'Sama', 'Alexander & Alexander Inc', '4923 Carey Ave', 'Saint Louis', 'Saint Louis City', 'MO', '63104', '314-787-1588', '314-858-4832', 'bsama@cox.net', 'http://www.alexanderalexanderinc.com');
INSERT INTO `us_users` (`first_name`, `last_name`, `company_name`, `address`, `city`, `country`, `state`, `zip`, `phone1`, `phone2`, `email`, `web`) VALUES
('Alyce', 'Arias', 'Fairbanks Scales', '3196 S Rider Trl', 'Stockton', 'San Joaquin', 'CA', '95207', '209-317-1801', '209-242-7022', 'alyce@arias.org', 'http://www.fairbanksscales.com'),
('Heike', 'Berganza', 'Cali Sportswear Cutting Dept', '3 Railway Ave #75', 'Little Falls', 'Passaic', 'NJ', '7424', '973-936-5095', '973-822-8827', 'heike@gmail.com', 'http://www.calisportswearcuttingdept.com'),
('Carey', 'Dopico', 'Garofani, John Esq', '87393 E Highland Rd', 'Indianapolis', 'Marion', 'IN', '46220', '317-578-2453', '317-441-5848', 'carey_dopico@dopico.org', 'http://www.garofanijohnesq.com'),
('Dottie', 'Hellickson', 'Thompson Fabricating Co', '67 E Chestnut Hill Rd', 'Seattle', 'King', 'WA', '98133', '206-540-6076', '206-295-5631', 'dottie@hellickson.org', 'http://www.thompsonfabricatingco.com'),
('Deandrea', 'Hughey', 'Century 21 Krall Real Estate', '33 Lewis Rd #46', 'Burlington', 'Alamance', 'NC', '27215', '336-822-7652', '336-467-3095', 'deandrea@yahoo.com', 'http://www.centurykrallrealestate.com'),
('Kimberlie', 'Duenas', 'Mid Contntl Rlty & Prop Mgmt', '8100 Jacksonville Rd #7', 'Hays', 'Ellis', 'KS', '67601', '785-629-8542', '785-616-1685', 'kimberlie_duenas@yahoo.com', 'http://www.midcontntlrltypropmgmt.com'),
('Martina', 'Staback', 'Ace Signs Inc', '7 W Wabansia Ave #227', 'Orlando', 'Orange', 'FL', '32822', '407-471-6908', '407-429-2145', 'martina_staback@staback.com', 'http://www.acesignsinc.com'),
('Skye', 'Fillingim', 'Rodeway Inn', '25 Minters Chapel Rd #9', 'Minneapolis', 'Hennepin', 'MN', '55401', '612-508-2655', '612-664-6304', 'skye_fillingim@yahoo.com', 'http://www.rodewayinn.com'),
('Jade', 'Farrar', 'Bonnet & Daughter', '6882 Torresdale Ave', 'Columbia', 'Richland', 'SC', '29201', '803-352-5387', '803-975-3405', 'jade.farrar@yahoo.com', 'http://www.bonnetdaughter.com'),
('Charlene', 'Hamilton', 'Oshins & Gibbons', '985 E 6th Ave', 'Santa Rosa', 'Sonoma', 'CA', '95407', '707-300-1771', '707-821-8037', 'charlene.hamilton@hotmail.com', 'http://www.oshinsgibbons.com'),
('Geoffrey', 'Acey', 'Price Business Services', '7 West Ave #1', 'Palatine', 'Cook', 'IL', '60067', '847-222-1734', '847-556-2909', 'geoffrey@gmail.com', 'http://www.pricebusinessservices.com'),
('Stevie', 'Westerbeck', 'Wise, Dennis W Md', '26659 N 13th St', 'Costa Mesa', 'Orange', 'CA', '92626', '949-867-4077', '949-903-3898', 'stevie.westerbeck@yahoo.com', 'http://www.wisedenniswmd.com'),
('Pamella', 'Fortino', 'Super 8 Motel', '669 Packerland Dr #1438', 'Denver', 'Denver', 'CO', '80212', '303-404-2210', '303-794-1341', 'pamella@fortino.com', 'http://www.supermotel.com'),
('Harrison', 'Haufler', 'John Wagner Associates', '759 Eldora St', 'New Haven', 'New Haven', 'CT', '6515', '203-801-6193', '203-801-8497', 'hhaufler@hotmail.com', 'http://www.johnwagnerassociates.com'),
('Johnna', 'Engelberg', 'Thrifty Oil Co', '5 S Colorado Blvd #449', 'Bothell', 'Snohomish', 'WA', '98021', '425-986-7573', '425-700-3751', 'jengelberg@engelberg.org', 'http://www.thriftyoilco.com'),
('Buddy', 'Cloney', 'Larkfield Photo', '944 Gaither Dr', 'Strongsville', 'Cuyahoga', 'OH', '44136', '440-989-5826', '440-327-2093', 'buddy.cloney@yahoo.com', 'http://www.larkfieldphoto.com'),
('Dalene', 'Riden', 'Silverman Planetarium', '66552 Malone Rd', 'Plaistow', 'Rockingham', 'NH', '3865', '603-315-6839', '603-745-7497', 'dalene.riden@aol.com', 'http://www.silvermanplanetarium.com'),
('Jerry', 'Zurcher', 'J & F Lumber', '77 Massillon Rd #822', 'Satellite Beach', 'Brevard', 'FL', '32937', '321-518-5938', '321-597-2159', 'jzurcher@zurcher.org', 'http://www.jflumber.com'),
('Haydee', 'Denooyer', 'Cleaning Station Inc', '25346 New Rd', 'New York', 'New York', 'NY', '10016', '212-792-8658', '212-782-3493', 'hdenooyer@denooyer.org', 'http://www.cleaningstationinc.com'),
('Joseph', 'Cryer', 'Ames Stationers', '60 Fillmore Ave', 'Huntington Beach', 'Orange', 'CA', '92647', '714-584-2237', '714-698-2170', 'joseph_cryer@cox.net', 'http://www.amesstationers.com'),
('Deonna', 'Kippley', 'Midas Muffler Shops', '57 Haven Ave #90', 'Southfield', 'Oakland', 'MI', '48075', '248-913-4677', '248-793-4966', 'deonna_kippley@hotmail.com', 'http://www.midasmufflershops.com'),
('Raymon', 'Calvaresi', 'Seaboard Securities Inc', '6538 E Pomona St #60', 'Indianapolis', 'Marion', 'IN', '46222', '317-825-4724', '317-342-1532', 'raymon.calvaresi@gmail.com', 'http://www.seaboardsecuritiesinc.com'),
('Alecia', 'Bubash', 'Petersen, James E Esq', '6535 Joyce St', 'Wichita Falls', 'Wichita', 'TX', '76301', '940-276-7922', '940-302-3036', 'alecia@aol.com', 'http://www.petersenjameseesq.com'),
('Ma', 'Layous', 'Development Authority', '78112 Morris Ave', 'North Haven', 'New Haven', 'CT', '6473', '203-721-3388', '203-564-1543', 'mlayous@hotmail.com', 'http://www.developmentauthority.com'),
('Detra', 'Coyier', 'Schott Fiber Optics Inc', '96950 Hidden Ln', 'Aberdeen', 'Harford', 'MD', '21001', '410-739-9277', '410-259-2118', 'detra@aol.com', 'http://www.schottfiberopticsinc.com'),
('Terrilyn', 'Rodeigues', 'Stuart J Agins', '3718 S Main St', 'New Orleans', 'Orleans', 'LA', '70130', '504-463-4384', '504-635-8518', 'terrilyn.rodeigues@cox.net', 'http://www.stuartjagins.com'),
('Salome', 'Lacovara', 'Mitsumi Electronics Corp', '9677 Commerce Dr', 'Richmond', 'Richmond City', 'VA', '23219', '804-550-5097', '804-858-1011', 'slacovara@gmail.com', 'http://www.mitsumielectronicscorp.com'),
('Garry', 'Keetch', 'Italian Express Franchise Corp', '5 Green Pond Rd #4', 'Southampton', 'Bucks', 'PA', '18966', '215-979-8776', '215-846-9046', 'garry_keetch@hotmail.com', 'http://www.italianexpressfranchisecorp.com'),
('Matthew', 'Neither', 'American Council On Sci & Hlth', '636 Commerce Dr #42', 'Shakopee', 'Scott', 'MN', '55379', '952-651-7597', '952-906-4597', 'mneither@yahoo.com', 'http://www.americancouncilonscihlth.com'),
('Theodora', 'Restrepo', 'Kleri, Patricia S Esq', '42744 Hamann Industrial Pky #82', 'Miami', 'Miami-Dade', 'FL', '33136', '305-936-8226', '305-573-1085', 'theodora.restrepo@restrepo.com', 'http://www.kleripatriciasesq.com'),
('Noah', 'Kalafatis', 'Twiggs Abrams Blanchard', '1950 5th Ave', 'Milwaukee', 'Milwaukee', 'WI', '53209', '414-263-5287', '414-660-9766', 'noah.kalafatis@aol.com', 'http://www.twiggsabramsblanchard.com'),
('Carmen', 'Sweigard', 'Maui Research & Technology Pk', '61304 N French Rd', 'Somerset', 'Somerset', 'NJ', '8873', '732-941-2621', '732-445-6940', 'csweigard@sweigard.com', 'http://www.mauiresearchtechnologypk.com'),
('Lavonda', 'Hengel', 'Bradley Nameplate Corp', '87 Imperial Ct #79', 'Fargo', 'Cass', 'ND', '58102', '701-898-2154', '701-421-7080', 'lavonda@cox.net', 'http://www.bradleynameplatecorp.com'),
('Junita', 'Stoltzman', 'Geonex Martel Inc', '94 W Dodge Rd', 'Carson City', 'Carson City', 'NV', '89701', '775-638-9963', '775-578-1214', 'junita@aol.com', 'http://www.geonexmartelinc.com'),
('Herminia', 'Nicolozakes', 'Sea Island Div Of Fstr Ind Inc', '4 58th St #3519', 'Scottsdale', 'Maricopa', 'AZ', '85254', '602-954-5141', '602-304-6433', 'herminia@nicolozakes.org', 'http://www.seaislanddivoffstrindinc.com'),
('Casie', 'Good', 'Papay, Debbie J Esq', '5221 Bear Valley Rd', 'Nashville', 'Davidson', 'TN', '37211', '615-390-2251', '615-825-4297', 'casie.good@aol.com', 'http://www.papaydebbiejesq.com'),
('Reena', 'Maisto', 'Lane Promotions', '9648 S Main', 'Salisbury', 'Wicomico', 'MD', '21801', '410-351-1863', '410-951-2667', 'reena@hotmail.com', 'http://www.lanepromotions.com'),
('Mirta', 'Mallett', 'Stephen Kennerly Archts Inc Pc', '7 S San Marcos Rd', 'New York', 'New York', 'NY', '10004', '212-870-1286', '212-745-6948', 'mirta_mallett@gmail.com', 'http://www.stephenkennerlyarchtsincpc.com'),
('Cathrine', 'Pontoriero', 'Business Systems Of Wis Inc', '812 S Haven St', 'Amarillo', 'Randall', 'TX', '79109', '806-703-1435', '806-558-5848', 'cathrine.pontoriero@pontoriero.com', 'http://www.businesssystemsofwisinc.com'),
('Filiberto', 'Tawil', 'Flash, Elena Salerno Esq', '3882 W Congress St #799', 'Los Angeles', 'Los Angeles', 'CA', '90016', '323-765-2528', '323-842-8226', 'ftawil@hotmail.com', 'http://www.flashelenasalernoesq.com'),
('Raul', 'Upthegrove', 'Neeley, Gregory W Esq', '4 E Colonial Dr', 'La Mesa', 'San Diego', 'CA', '91942', '619-509-5282', '619-666-4765', 'rupthegrove@yahoo.com', 'http://www.neeleygregorywesq.com'),
('Sarah', 'Candlish', 'Alabama Educational Tv Comm', '45 2nd Ave #9759', 'Atlanta', 'Fulton', 'GA', '30328', '770-732-1194', '770-531-2842', 'sarah.candlish@gmail.com', 'http://www.alabamaeducationaltvcomm.com'),
('Lucy', 'Treston', 'Franz Inc', '57254 Brickell Ave #372', 'Worcester', 'Worcester', 'MA', '1602', '508-769-5250', '508-502-5634', 'lucy@cox.net', 'http://www.franzinc.com'),
('Judy', 'Aquas', 'Plantation Restaurant', '8977 Connecticut Ave Nw #3', 'Niles', 'Berrien', 'MI', '49120', '269-756-7222', '269-431-9464', 'jaquas@aquas.com', 'http://www.plantationrestaurant.com'),
('Yvonne', 'Tjepkema', 'Radio Communications Co', '9 Waydell St', 'Fairfield', 'Essex', 'NJ', '7004', '973-714-1721', '973-976-8627', 'yvonne.tjepkema@hotmail.com', 'http://www.radiocommunicationsco.com'),
('Kayleigh', 'Lace', 'Dentalaw Divsn Hlth Care', '43 Huey P Long Ave', 'Lafayette', 'Lafayette', 'LA', '70508', '337-740-9323', '337-751-2326', 'kayleigh.lace@yahoo.com', 'http://www.dentalawdivsnhlthcare.com'),
('Felix', 'Hirpara', 'American Speedy Printing Ctrs', '7563 Cornwall Rd #4462', 'Denver', 'Lancaster', 'PA', '17517', '717-491-5643', '717-583-1497', 'felix_hirpara@cox.net', 'http://www.americanspeedyprintingctrs.com'),
('Tresa', 'Sweely', 'Grayson, Grant S Esq', '22 Bridle Ln', 'Valley Park', 'Saint Louis', 'MO', '63088', '314-359-9566', '314-231-3514', 'tresa_sweely@hotmail.com', 'http://www.graysongrantsesq.com'),
('Kristeen', 'Turinetti', 'Jeanerette Middle School', '70099 E North Ave', 'Arlington', 'Tarrant', 'TX', '76013', '817-213-8851', '817-947-9480', 'kristeen@gmail.com', 'http://www.jeanerettemiddleschool.com'),
('Jenelle', 'Regusters', 'Haavisto, Brian F Esq', '3211 E Northeast Loop', 'Tampa', 'Hillsborough', 'FL', '33619', '813-932-8715', '813-357-7296', 'jregusters@regusters.com', 'http://www.haavistobrianfesq.com'),
('Renea', 'Monterrubio', 'Wmmt Radio Station', '26 Montgomery St', 'Atlanta', 'Fulton', 'GA', '30328', '770-679-4752', '770-930-9967', 'renea@hotmail.com', 'http://www.wmmtradiostation.com'),
('Olive', 'Matuszak', 'Colony Paints Sales Ofc & Plnt', '13252 Lighthouse Ave', 'Cathedral City', 'Riverside', 'CA', '92234', '760-938-6069', '760-745-2649', 'olive@aol.com', 'http://www.colonypaintssalesofcplnt.com'),
('Ligia', 'Reiber', 'Floral Expressions', '206 Main St #2804', 'Lansing', 'Ingham', 'MI', '48933', '517-906-1108', '517-747-7664', 'lreiber@cox.net', 'http://www.floralexpressions.com'),
('Christiane', 'Eschberger', 'Casco Services Inc', '96541 W Central Blvd', 'Phoenix', 'Maricopa', 'AZ', '85034', '602-390-4944', '602-330-6894', 'christiane.eschberger@yahoo.com', 'http://www.cascoservicesinc.com'),
('Goldie', 'Schirpke', 'Reuter, Arthur C Jr', '34 Saint George Ave #2', 'Bangor', 'Penobscot', 'ME', '4401', '207-295-7569', '207-748-3722', 'goldie.schirpke@yahoo.com', 'http://www.reuterarthurcjr.com'),
('Loreta', 'Timenez', 'Kaminski, Katherine Andritsaki', '47857 Coney Island Ave', 'Clinton', 'Prince Georges', 'MD', '20735', '301-696-6420', '301-392-6698', 'loreta.timenez@hotmail.com', 'http://www.kaminskikatherineandritsaki.com'),
('Fabiola', 'Hauenstein', 'Sidewinder Products Corp', '8573 Lincoln Blvd', 'York', 'York', 'PA', '17404', '717-809-3119', '717-344-2804', 'fabiola.hauenstein@hauenstein.org', 'http://www.sidewinderproductscorp.com'),
('Amie', 'Perigo', 'General Foam Corporation', '596 Santa Maria Ave #7913', 'Mesquite', 'Dallas', 'TX', '75150', '972-419-7946', '972-898-1033', 'amie.perigo@yahoo.com', 'http://www.generalfoamcorporation.com'),
('Raina', 'Brachle', 'Ikg Borden Divsn Harsco Corp', '3829 Ventura Blvd', 'Butte', 'Silver Bow', 'MT', '59701', '406-318-1515', '406-374-7752', 'raina.brachle@brachle.org', 'http://www.ikgbordendivsnharscocorp.com'),
('Erinn', 'Canlas', 'Anchor Computer Inc', '13 S Hacienda Dr', 'Livingston', 'Essex', 'NJ', '7039', '973-767-3008', '973-563-9502', 'erinn.canlas@canlas.com', 'http://www.anchorcomputerinc.com'),
('Cherry', 'Lietz', 'Sebring & Co', '40 9th Ave Sw #91', 'Waterford', 'Oakland', 'MI', '48329', '248-980-6904', '248-697-7722', 'cherry@lietz.com', 'http://www.sebringco.com'),
('Kattie', 'Vonasek', 'H A C Farm Lines Co Optv Assoc', '2845 Boulder Crescent St', 'Cleveland', 'Cuyahoga', 'OH', '44103', '216-923-3715', '216-270-9653', 'kattie@vonasek.org', 'http://www.hacfarmlinescooptvassoc.com'),
('Lilli', 'Scriven', 'Hunter, John J Esq', '33 State St', 'Abilene', 'Taylor', 'TX', '79601', '325-631-1560', '325-667-7868', 'lilli@aol.com', 'http://www.hunterjohnjesq.com'),
('Whitley', 'Tomasulo', 'Freehold Fence Co', '2 S 15th St', 'Fort Worth', 'Tarrant', 'TX', '76107', '817-526-4408', '817-819-7799', 'whitley.tomasulo@aol.com', 'http://www.freeholdfenceco.com'),
('Barbra', 'Adkin', 'Binswanger', '4 Kohler Memorial Dr', 'Brooklyn', 'Kings', 'NY', '11230', '718-201-3751', '718-732-9475', 'badkin@hotmail.com', 'http://www.binswanger.com'),
('Hermila', 'Thyberg', 'Chilton Malting Co', '1 Rancho Del Mar Shopping C', 'Providence', 'Providence', 'RI', '2903', '401-893-4882', '401-885-7681', 'hermila_thyberg@hotmail.com', 'http://www.chiltonmaltingco.com'),
('Jesusita', 'Flister', 'Schoen, Edward J Jr', '3943 N Highland Ave', 'Lancaster', 'Lancaster', 'PA', '17601', '717-885-9118', '717-686-7564', 'jesusita.flister@hotmail.com', 'http://www.schoenedwardjjr.com'),
('Caitlin', 'Julia', 'Helderman, Seymour Cpa', '5 Williams St', 'Johnston', 'Providence', 'RI', '2919', '401-948-4982', '401-552-9059', 'caitlin.julia@julia.org', 'http://www.heldermanseymourcpa.com'),
('Roosevelt', 'Hoffis', 'Denbrook, Myron', '60 Old Dover Rd', 'Hialeah', 'Miami-Dade', 'FL', '33014', '305-622-4739', '305-302-1135', 'roosevelt.hoffis@aol.com', 'http://www.denbrookmyron.com'),
('Helaine', 'Halter', 'Lippitt, Mike', '8 Sheridan Rd', 'Jersey City', 'Hudson', 'NJ', '7304', '201-832-4168', '201-412-3040', 'hhalter@yahoo.com', 'http://www.lippittmike.com'),
('Lorean', 'Martabano', 'Hiram, Hogg P Esq', '85092 Southern Blvd', 'San Antonio', 'Bexar', 'TX', '78204', '210-856-4979', '210-634-2447', 'lorean.martabano@hotmail.com', 'http://www.hiramhoggpesq.com'),
('France', 'Buzick', 'In Travel Agency', '64 Newman Springs Rd E', 'Brooklyn', 'Kings', 'NY', '11219', '718-478-8504', '718-853-3740', 'france.buzick@yahoo.com', 'http://www.intravelagency.com'),
('Justine', 'Ferrario', 'Newhart Foods Inc', '48 Stratford Ave', 'Pomona', 'Los Angeles', 'CA', '91768', '909-993-3242', '909-631-5703', 'jferrario@hotmail.com', 'http://www.newhartfoodsinc.com'),
('Adelina', 'Nabours', 'Courtyard By Marriott', '80 Pittsford Victor Rd #9', 'Cleveland', 'Cuyahoga', 'OH', '44103', '216-230-4892', '216-937-5320', 'adelina_nabours@gmail.com', 'http://www.courtyardbymarriott.com'),
('Derick', 'Dhamer', 'Studer, Eugene A Esq', '87163 N Main Ave', 'New York', 'New York', 'NY', '10013', '212-304-4515', '212-225-9676', 'ddhamer@cox.net', 'http://www.studereugeneaesq.com'),
('Jerry', 'Dallen', 'Seashore Supply Co Waretown', '393 Lafayette Ave', 'Richmond', 'Richmond City', 'VA', '23219', '804-762-9576', '804-808-9574', 'jerry.dallen@yahoo.com', 'http://www.seashoresupplycowaretown.com'),
('Leota', 'Ragel', 'Mayar Silk Inc', '99 5th Ave #33', 'Trion', 'Chattooga', 'GA', '30753', '706-221-4243', '706-616-5131', 'leota.ragel@gmail.com', 'http://www.mayarsilkinc.com'),
('Jutta', 'Amyot', 'National Medical Excess Corp', '49 N Mays St', 'Broussard', 'Lafayette', 'LA', '70518', '337-515-1438', '337-991-8070', 'jamyot@hotmail.com', 'http://www.nationalmedicalexcesscorp.com'),
('Aja', 'Gehrett', 'Stero Company', '993 Washington Ave', 'Nutley', 'Essex', 'NJ', '7110', '973-544-2677', '973-986-4456', 'aja_gehrett@hotmail.com', 'http://www.sterocompany.com'),
('Kirk', 'Herritt', 'Hasting, H Duane Esq', '88 15th Ave Ne', 'Vestal', 'Broome', 'NY', '13850', '607-407-3716', '607-350-7690', 'kirk.herritt@aol.com', 'http://www.hastinghduaneesq.com'),
('Leonora', 'Mauson', 'Insty Prints', '3381 E 40th Ave', 'Passaic', 'Passaic', 'NJ', '7055', '973-412-2995', '973-355-2120', 'leonora@yahoo.com', 'http://www.instyprints.com'),
('Winfred', 'Brucato', 'Glenridge Manor Mobile Home Pk', '201 Ridgewood Rd', 'Moscow', 'Latah', 'ID', '83843', '208-252-4552', '208-793-4108', 'winfred_brucato@hotmail.com', 'http://www.glenridgemanormobilehomepk.com'),
('Tarra', 'Nachor', 'Circuit Solution Inc', '39 Moccasin Dr', 'San Francisco', 'San Francisco', 'CA', '94104', '415-411-1775', '415-284-2730', 'tarra.nachor@cox.net', 'http://www.circuitsolutioninc.com'),
('Corinne', 'Loder', 'Local Office', '4 Carroll St', 'North Attleboro', 'Bristol', 'MA', '2760', '508-942-4186', '508-618-7826', 'corinne@loder.org', 'http://www.localoffice.com'),
('Dulce', 'Labreche', 'Lee Kilkelly Paulson & Kabaker', '9581 E Arapahoe Rd', 'Rochester', 'Oakland', 'MI', '48307', '248-357-8718', '248-811-5696', 'dulce_labreche@yahoo.com', 'http://www.leekilkellypaulsonkabaker.com'),
('Kate', 'Keneipp', 'Davis, Maxon R Esq', '33 N Michigan Ave', 'Green Bay', 'Brown', 'WI', '54301', '920-353-6377', '920-355-1610', 'kate_keneipp@yahoo.com', 'http://www.davismaxonresq.com'),
('Kaitlyn', 'Ogg', 'Garrison, Paul E Esq', '2 S Biscayne Blvd', 'Baltimore', 'Baltimore City', 'MD', '21230', '410-665-4903', '410-773-3862', 'kaitlyn.ogg@gmail.com', 'http://www.garrisonpauleesq.com'),
('Sherita', 'Saras', 'Black History Resource Center', '8 Us Highway 22', 'Colorado Springs', 'El Paso', 'CO', '80937', '719-669-1664', '719-547-9543', 'sherita.saras@cox.net', 'http://www.blackhistoryresourcecenter.com'),
('Lashawnda', 'Stuer', 'Rodriguez, J Christopher Esq', '7422 Martin Ave #8', 'Toledo', 'Lucas', 'OH', '43607', '419-588-8719', '419-399-1744', 'lstuer@cox.net', 'http://www.rodriguezjchristopheresq.com'),
('Ernest', 'Syrop', 'Grant Family Health Center', '94 Chase Rd', 'Hyattsville', 'Prince Georges', 'MD', '20785', '301-998-9644', '301-257-4883', 'ernest@cox.net', 'http://www.grantfamilyhealthcenter.com'),
('Nobuko', 'Halsey', 'Goeman Wood Products Inc', '8139 I Hwy 10 #92', 'New Bedford', 'Bristol', 'MA', '2745', '508-855-9887', '508-897-7916', 'nobuko.halsey@yahoo.com', 'http://www.goemanwoodproductsinc.com'),
('Lavonna', 'Wolny', 'Linhares, Kenneth A Esq', '5 Cabot Rd', 'Mc Lean', 'Fairfax', 'VA', '22102', '703-483-1970', '703-892-2914', 'lavonna.wolny@hotmail.com', 'http://www.linhareskennethaesq.com'),
('Lashaunda', 'Lizama', 'Earnhardt Printing', '3387 Ryan Dr', 'Hanover', 'Anne Arundel', 'MD', '21076', '410-678-2473', '410-912-6032', 'llizama@cox.net', 'http://www.earnhardtprinting.com'),
('Mariann', 'Bilden', 'H P G Industrys Inc', '3125 Packer Ave #9851', 'Austin', 'Travis', 'TX', '78753', '512-223-4791', '512-742-1149', 'mariann.bilden@aol.com', 'http://www.hpgindustrysinc.com'),
('Helene', 'Rodenberger', 'Bailey Transportation Prod Inc', '347 Chestnut St', 'Peoria', 'Maricopa', 'AZ', '85381', '623-461-8551', '623-426-4907', 'helene@aol.com', 'http://www.baileytransportationprodinc.com'),
('Roselle', 'Estell', 'Mcglynn Bliss Pc', '8116 Mount Vernon Ave', 'Bucyrus', 'Crawford', 'OH', '44820', '419-571-5920', '419-488-6648', 'roselle.estell@hotmail.com', 'http://www.mcglynnblisspc.com'),
('Samira', 'Heintzman', 'Mutual Fish Co', '8772 Old County Rd #5410', 'Kent', 'King', 'WA', '98032', '206-311-4137', '206-923-6042', 'sheintzman@hotmail.com', 'http://www.mutualfishco.com'),
('Margart', 'Meisel', 'Yeates, Arthur L Aia', '868 State St #38', 'Cincinnati', 'Hamilton', 'OH', '45251', '513-617-2362', '513-747-9603', 'margart_meisel@yahoo.com', 'http://www.yeatesarthurlaia.com'),
('Kristofer', 'Bennick', 'Logan, Ronald J Esq', '772 W River Dr', 'Bloomington', 'Monroe', 'IN', '47404', '812-368-1511', '812-442-8544', 'kristofer.bennick@yahoo.com', 'http://www.loganronaldjesq.com'),
('Weldon', 'Acuff', 'Advantage Martgage Company', '73 W Barstow Ave', 'Arlington Heights', 'Cook', 'IL', '60004', '847-353-2156', '847-613-5866', 'wacuff@gmail.com', 'http://www.advantagemartgagecompany.com'),
('Shalon', 'Shadrick', 'Germer And Gertz Llp', '61047 Mayfield Ave', 'Brooklyn', 'Kings', 'NY', '11223', '718-232-2337', '718-394-4974', 'shalon@cox.net', 'http://www.germerandgertzllp.com'),
('Denise', 'Patak', 'Spence Law Offices', '2139 Santa Rosa Ave', 'Orlando', 'Orange', 'FL', '32801', '407-446-4358', '407-808-3254', 'denise@patak.org', 'http://www.spencelawoffices.com'),
('Louvenia', 'Beech', 'John Ortiz Nts Therapy Center', '598 43rd St', 'Beverly Hills', 'Los Angeles', 'CA', '90210', '310-820-2117', '310-652-2379', 'louvenia.beech@beech.com', 'http://www.johnortizntstherapycenter.com'),
('Audry', 'Yaw', 'Mike Uchrin Htg & Air Cond Inc', '70295 Pioneer Ct', 'Brandon', 'Hillsborough', 'FL', '33511', '813-797-4816', '813-744-7100', 'audry.yaw@yaw.org', 'http://www.mikeuchrinhtgaircondinc.com'),
('Kristel', 'Ehmann', 'Mccoy, Joy Reynolds Esq', '92899 Kalakaua Ave', 'El Paso', 'El Paso', 'TX', '79925', '915-452-1290', '915-300-6100', 'kristel.ehmann@aol.com', 'http://www.mccoyjoyreynoldsesq.com'),
('Vincenza', 'Zepp', 'Kbor 1600 Am', '395 S 6th St #2', 'El Cajon', 'San Diego', 'CA', '92020', '619-603-5125', '619-935-6661', 'vzepp@gmail.com', 'http://www.kboram.com'),
('Elouise', 'Gwalthney', 'Quality Inn Northwest', '9506 Edgemore Ave', 'Bladensburg', 'Prince Georges', 'MD', '20710', '301-841-5012', '301-591-3034', 'egwalthney@yahoo.com', 'http://www.qualityinnnorthwest.com'),
('Venita', 'Maillard', 'Wallace Church Assoc Inc', '72119 S Walker Ave #63', 'Anaheim', 'Orange', 'CA', '92801', '714-523-6653', '714-663-9740', 'venita_maillard@gmail.com', 'http://www.wallacechurchassocinc.com'),
('Kasandra', 'Semidey', 'Can Tron', '369 Latham St #500', 'Saint Louis', 'Saint Louis City', 'MO', '63102', '314-732-9131', '314-697-3652', 'kasandra_semidey@semidey.com', 'http://www.cantron.com'),
('Xochitl', 'Discipio', 'Ravaal Enterprises Inc', '3158 Runamuck Pl', 'Round Rock', 'Williamson', 'TX', '78664', '512-233-1831', '512-942-3411', 'xdiscipio@gmail.com', 'http://www.ravaalenterprisesinc.com'),
('Maile', 'Linahan', 'Thompson Steel Company Inc', '9 Plainsboro Rd #598', 'Greensboro', 'Guilford', 'NC', '27409', '336-670-2640', '336-364-6037', 'mlinahan@yahoo.com', 'http://www.thompsonsteelcompanyinc.com'),
('Krissy', 'Rauser', 'Anderson, Mark A Esq', '8728 S Broad St', 'Coram', 'Suffolk', 'NY', '11727', '631-443-4710', '631-288-2866', 'krauser@cox.net', 'http://www.andersonmarkaesq.com'),
('Pete', 'Dubaldi', 'Womack & Galich', '2215 Prosperity Dr', 'Lyndhurst', 'Bergen', 'NJ', '7071', '201-825-2514', '201-749-8866', 'pdubaldi@hotmail.com', 'http://www.womackgalich.com'),
('Linn', 'Paa', 'Valerie & Company', '1 S Pine St', 'Memphis', 'Shelby', 'TN', '38112', '901-412-4381', '901-573-9024', 'linn_paa@paa.com', 'http://www.valeriecompany.com'),
('Paris', 'Wide', 'Gehring Pumps Inc', '187 Market St', 'Atlanta', 'Fulton', 'GA', '30342', '404-505-4445', '404-607-8435', 'paris@hotmail.com', 'http://www.gehringpumpsinc.com'),
('Wynell', 'Dorshorst', 'Haehnel, Craig W Esq', '94290 S Buchanan St', 'Pacifica', 'San Mateo', 'CA', '94044', '650-473-1262', '650-749-9879', 'wynell_dorshorst@dorshorst.org', 'http://www.haehnelcraigwesq.com'),
('Quentin', 'Birkner', 'Spoor Behrins Campbell & Young', '7061 N 2nd St', 'Burnsville', 'Dakota', 'MN', '55337', '952-702-7993', '952-314-5871', 'qbirkner@aol.com', 'http://www.spoorbehrinscampbellyoung.com'),
('Regenia', 'Kannady', 'Ken Jeter Store Equipment Inc', '10759 Main St', 'Scottsdale', 'Maricopa', 'AZ', '85260', '480-726-1280', '480-205-5121', 'regenia.kannady@cox.net', 'http://www.kenjeterstoreequipmentinc.com'),
('Sheron', 'Louissant', 'Potter, Brenda J Cpa', '97 E 3rd St #9', 'Long Island City', 'Queens', 'NY', '11101', '718-976-8610', '718-613-9994', 'sheron@aol.com', 'http://www.potterbrendajcpa.com'),
('Izetta', 'Funnell', 'Baird Kurtz & Dobson', '82 Winsor St #54', 'Atlanta', 'Dekalb', 'GA', '30340', '770-844-3447', '770-584-4119', 'izetta.funnell@hotmail.com', 'http://www.bairdkurtzdobson.com'),
('Rodolfo', 'Butzen', 'Minor, Cynthia A Esq', '41 Steel Ct', 'Northfield', 'Rice', 'MN', '55057', '507-210-3510', '507-590-5237', 'rodolfo@hotmail.com', 'http://www.minorcynthiaaesq.com'),
('Zona', 'Colla', 'Solove, Robert A Esq', '49440 Dearborn St', 'Norwalk', 'Fairfield', 'CT', '6854', '203-461-1949', '203-938-2557', 'zona@hotmail.com', 'http://www.soloverobertaesq.com'),
('Serina', 'Zagen', 'Mark Ii Imports Inc', '7 S Beverly Dr', 'Fort Wayne', 'Allen', 'IN', '46802', '260-273-3725', '260-382-4869', 'szagen@aol.com', 'http://www.markiiimportsinc.com'),
('Paz', 'Sahagun', 'White Sign Div Ctrl Equip Co', '919 Wall Blvd', 'Meridian', 'Lauderdale', 'MS', '39307', '601-927-8287', '601-249-4511', 'paz_sahagun@cox.net', 'http://www.whitesigndivctrlequipco.com'),
('Markus', 'Lukasik', 'M & M Store Fixtures Co Inc', '89 20th St E #779', 'Sterling Heights', 'Macomb', 'MI', '48310', '586-970-7380', '586-247-1614', 'markus@yahoo.com', 'http://www.mmstorefixturescoinc.com'),
('Jaclyn', 'Bachman', 'Judah Caster & Wheel Co', '721 Interstate 45 S', 'Colorado Springs', 'El Paso', 'CO', '80919', '719-853-3600', '719-223-2074', 'jaclyn@aol.com', 'http://www.judahcasterwheelco.com'),
('Cyril', 'Daufeldt', 'Galaxy International Inc', '3 Lawton St', 'New York', 'New York', 'NY', '10013', '212-745-8484', '212-422-5427', 'cyril_daufeldt@daufeldt.com', 'http://www.galaxyinternationalinc.com'),
('Gayla', 'Schnitzler', 'Sigma Corp Of America', '38 Pleasant Hill Rd', 'Hayward', 'Alameda', 'CA', '94545', '510-686-3407', '510-441-4055', 'gschnitzler@gmail.com', 'http://www.sigmacorpofamerica.com'),
('Erick', 'Nievas', 'Soward, Anne Esq', '45 E Acacia Ct', 'Chicago', 'Cook', 'IL', '60624', '773-704-9903', '773-359-6109', 'erick_nievas@aol.com', 'http://www.sowardanneesq.com'),
('Jennie', 'Drymon', 'Osborne, Michelle M Esq', '63728 Poway Rd #1', 'Scranton', 'Lackawanna', 'PA', '18509', '570-218-4831', '570-868-8688', 'jennie@cox.net', 'http://www.osbornemichellemesq.com'),
('Mitsue', 'Scipione', 'Students In Free Entrprs Natl', '77 222 Dr', 'Oroville', 'Butte', 'CA', '95965', '530-986-9272', '530-399-3254', 'mscipione@scipione.com', 'http://www.studentsinfreeentrprsnatl.com'),
('Ciara', 'Ventura', 'Johnson, Robert M Esq', '53 W Carey St', 'Port Jervis', 'Orange', 'NY', '12771', '845-823-8877', '845-694-7919', 'cventura@yahoo.com', 'http://www.johnsonrobertmesq.com'),
('Galen', 'Cantres', 'Del Charro Apartments', '617 Nw 36th Ave', 'Brook Park', 'Cuyahoga', 'OH', '44142', '216-600-6111', '216-871-6876', 'galen@yahoo.com', 'http://www.delcharroapartments.com'),
('Truman', 'Feichtner', 'Legal Search Inc', '539 Coldwater Canyon Ave', 'Bloomfield', 'Essex', 'NJ', '7003', '973-852-2736', '973-473-5108', 'tfeichtner@yahoo.com', 'http://www.legalsearchinc.com'),
('Gail', 'Kitty', 'Service Supply Co Inc', '735 Crawford Dr', 'Anchorage', 'Anchorage', 'AK', '99501', '907-435-9166', '907-770-3542', 'gail@kitty.com', 'http://www.servicesupplycoinc.com'),
('Dalene', 'Schoeneck', 'Sameshima, Douglas J Esq', '910 Rahway Ave', 'Philadelphia', 'Philadelphia', 'PA', '19102', '215-268-1275', '215-380-8820', 'dalene@schoeneck.org', 'http://www.sameshimadouglasjesq.com'),
('Gertude', 'Witten', 'Thompson, John Randolph Jr', '7 Tarrytown Rd', 'Cincinnati', 'Hamilton', 'OH', '45217', '513-977-7043', '513-863-9471', 'gertude.witten@gmail.com', 'http://www.thompsonjohnrandolphjr.com'),
('Lizbeth', 'Kohl', 'E T Balancing Co Inc', '35433 Blake St #588', 'Gardena', 'Los Angeles', 'CA', '90248', '310-699-1222', '310-955-5788', 'lizbeth@yahoo.com', 'http://www.etbalancingcoinc.com'),
('Glenn', 'Berray', 'Griswold, John E Esq', '29 Cherry St #7073', 'Des Moines', 'Polk', 'IA', '50315', '515-370-7348', '515-372-1738', 'gberray@gmail.com', 'http://www.griswoldjohneesq.com'),
('Lashandra', 'Klang', 'Acqua Group', '810 N La Brea Ave', 'King of Prussia', 'Montgomery', 'PA', '19406', '610-809-1818', '610-378-7332', 'lashandra@yahoo.com', 'http://www.acquagroup.com'),
('Lenna', 'Newville', 'Brooks, Morris J Jr', '987 Main St', 'Raleigh', 'Wake', 'NC', '27601', '919-623-2524', '919-254-5987', 'lnewville@newville.com', 'http://www.brooksmorrisjjr.com'),
('Laurel', 'Pagliuca', 'Printing Images Corp', '36 Enterprise St Se', 'Richland', 'Benton', 'WA', '99352', '509-695-5199', '509-595-6485', 'laurel@yahoo.com', 'http://www.printingimagescorp.com'),
('Mireya', 'Frerking', 'Roberts Supply Co Inc', '8429 Miller Rd', 'Pelham', 'Westchester', 'NY', '10803', '914-868-5965', '914-883-3061', 'mireya.frerking@hotmail.com', 'http://www.robertssupplycoinc.com'),
('Annelle', 'Tagala', 'Vico Products Mfg Co', '5 W 7th St', 'Parkville', 'Baltimore', 'MD', '21234', '410-757-1035', '410-234-2267', 'annelle@yahoo.com', 'http://www.vicoproductsmfgco.com'),
('Dean', 'Ketelsen', 'J M Custom Design Millwork', '2 Flynn Rd', 'Hicksville', 'Nassau', 'NY', '11801', '516-847-4418', '516-732-6649', 'dean_ketelsen@gmail.com', 'http://www.jmcustomdesignmillwork.com'),
('Levi', 'Munis', 'Farrell & Johnson Office Equip', '2094 Ne 36th Ave', 'Worcester', 'Worcester', 'MA', '1603', '508-456-4907', '508-658-7802', 'levi.munis@gmail.com', 'http://www.farrelljohnsonofficeequip.com'),
('Sylvie', 'Ryser', 'Millers Market & Deli', '649 Tulane Ave', 'Tulsa', 'Tulsa', 'OK', '74105', '918-644-9555', '918-565-1706', 'sylvie@aol.com', 'http://www.millersmarketdeli.com'),
('Sharee', 'Maile', 'Holiday Inn Naperville', '2094 Montour Blvd', 'Muskegon', 'Muskegon', 'MI', '49442', '231-467-9978', '231-265-6940', 'sharee_maile@aol.com', 'http://www.holidayinnnaperville.com'),
('Cordelia', 'Storment', 'Burrows, Jon H Esq', '393 Hammond Dr', 'Lafayette', 'Lafayette', 'LA', '70506', '337-566-6001', '337-255-3427', 'cordelia_storment@aol.com', 'http://www.burrowsjonhesq.com'),
('Mollie', 'Mcdoniel', 'Dock Seal Specialty', '8590 Lake Lizzie Dr', 'Bowling Green', 'Wood', 'OH', '43402', '419-975-3182', '419-417-4674', 'mollie_mcdoniel@yahoo.com', 'http://www.docksealspecialty.com'),
('Brett', 'Mccullan', 'Five Star Limousines Of Tx Inc', '87895 Concord Rd', 'La Mesa', 'San Diego', 'CA', '91942', '619-461-9984', '619-727-3892', 'brett.mccullan@mccullan.com', 'http://www.fivestarlimousinesoftxinc.com'),
('Teddy', 'Pedrozo', 'Barkan, Neal J Esq', '46314 Route 130', 'Bridgeport', 'Fairfield', 'CT', '6610', '203-892-3863', '203-918-3939', 'teddy_pedrozo@aol.com', 'http://www.barkannealjesq.com'),
('Tasia', 'Andreason', 'Campbell, Robert A', '4 Cowesett Ave', 'Kearny', 'Hudson', 'NJ', '7032', '201-920-9002', '201-969-7063', 'tasia_andreason@yahoo.com', 'http://www.campbellroberta.com'),
('Hubert', 'Walthall', 'Dee, Deanna', '95 Main Ave #2', 'Barberton', 'Summit', 'OH', '44203', '330-903-1345', '330-566-8898', 'hubert@walthall.org', 'http://www.deedeanna.com'),
('Arthur', 'Farrow', 'Young, Timothy L Esq', '28 S 7th St #2824', 'Englewood', 'Bergen', 'NJ', '7631', '201-238-5688', '201-772-4377', 'arthur.farrow@yahoo.com', 'http://www.youngtimothylesq.com'),
('Vilma', 'Berlanga', 'Wells, D Fred Esq', '79 S Howell Ave', 'Grand Rapids', 'Kent', 'MI', '49546', '616-737-3085', '616-568-4113', 'vberlanga@berlanga.com', 'http://www.wellsdfredesq.com'),
('Billye', 'Miro', 'Gray, Francine H Esq', '36 Lancaster Dr Se', 'Pearl', 'Rankin', 'MS', '39208', '601-567-5386', '601-637-5479', 'billye_miro@cox.net', 'http://www.grayfrancinehesq.com'),
('Glenna', 'Slayton', 'Toledo Iv Care', '2759 Livingston Ave', 'Memphis', 'Shelby', 'TN', '38118', '901-640-9178', '901-869-4314', 'glenna_slayton@cox.net', 'http://www.toledoivcare.com'),
('Mitzie', 'Hudnall', 'Cangro Transmission Co', '17 Jersey Ave', 'Englewood', 'Arapahoe', 'CO', '80110', '303-402-1940', '303-997-7760', 'mitzie_hudnall@yahoo.com', 'http://www.cangrotransmissionco.com'),
('Bernardine', 'Rodefer', 'Sat Poly Inc', '2 W Grand Ave', 'Memphis', 'Shelby', 'TN', '38112', '901-901-4726', '901-739-5892', 'bernardine_rodefer@yahoo.com', 'http://www.satpolyinc.com'),
('Staci', 'Schmaltz', 'Midwest Contracting & Mfg Inc', '18 Coronado Ave #563', 'Pasadena', 'Los Angeles', 'CA', '91106', '626-866-2339', '626-293-7678', 'staci_schmaltz@aol.com', 'http://www.midwestcontractingmfginc.com'),
('Nichelle', 'Meteer', 'Print Doctor', '72 Beechwood Ter', 'Chicago', 'Cook', 'IL', '60657', '773-225-9985', '773-857-2231', 'nichelle_meteer@meteer.com', 'http://www.printdoctor.com'),
('Janine', 'Rhoden', 'Nordic Group Inc', '92 Broadway', 'Astoria', 'Queens', 'NY', '11103', '718-228-5894', '718-728-5051', 'jrhoden@yahoo.com', 'http://www.nordicgroupinc.com'),
('Ettie', 'Hoopengardner', 'Jackson Millwork Co', '39 Franklin Ave', 'Richland', 'Benton', 'WA', '99352', '509-755-5393', '509-847-3352', 'ettie.hoopengardner@hotmail.com', 'http://www.jacksonmillworkco.com'),
('Eden', 'Jayson', 'Harris Corporation', '4 Iwaena St', 'Baltimore', 'Baltimore City', 'MD', '21202', '410-890-7866', '410-429-4888', 'eden_jayson@yahoo.com', 'http://www.harriscorporation.com'),
('Lynelle', 'Auber', 'United Cerebral Palsy Of Ne Pa', '32820 Corkwood Rd', 'Newark', 'Essex', 'NJ', '7104', '973-860-8610', '973-605-6492', 'lynelle_auber@gmail.com', 'http://www.unitedcerebralpalsyofnepa.com'),
('Merissa', 'Tomblin', 'One Day Surgery Center Inc', '34 Raritan Center Pky', 'Bellflower', 'Los Angeles', 'CA', '90706', '562-579-6900', '562-719-7922', 'merissa.tomblin@gmail.com', 'http://www.onedaysurgerycenterinc.com'),
('Golda', 'Kaniecki', 'Calaveras Prospect', '6201 S Nevada Ave', 'Toms River', 'Ocean', 'NJ', '8755', '732-628-9909', '732-617-5310', 'golda_kaniecki@yahoo.com', 'http://www.calaverasprospect.com'),
('Catarina', 'Gleich', 'Terk, Robert E Esq', '78 Maryland Dr #146', 'Denville', 'Morris', 'NJ', '7834', '973-210-3994', '973-491-8723', 'catarina_gleich@hotmail.com', 'http://www.terkroberteesq.com'),
('Virgie', 'Kiel', 'Cullen, Terrence P Esq', '76598 Rd  I 95 #1', 'Denver', 'Denver', 'CO', '80216', '303-776-7548', '303-845-5408', 'vkiel@hotmail.com', 'http://www.cullenterrencepesq.com'),
('Jolene', 'Ostolaza', 'Central Die Casting Mfg Co Inc', '1610 14th St Nw', 'Newport News', 'Newport News City', 'VA', '23608', '757-682-7116', '757-940-1741', 'jolene@yahoo.com', 'http://www.centraldiecastingmfgcoinc.com'),
('Keneth', 'Borgman', 'Centerline Engineering', '86350 Roszel Rd', 'Phoenix', 'Maricopa', 'AZ', '85012', '602-919-4211', '602-442-3092', 'keneth@yahoo.com', 'http://www.centerlineengineering.com'),
('Rikki', 'Nayar', 'Targan & Kievit Pa', '1644 Clove Rd', 'Miami', 'Miami-Dade', 'FL', '33155', '305-968-9487', '305-978-2069', 'rikki@nayar.com', 'http://www.targankievitpa.com'),
('Elke', 'Sengbusch', 'Riley Riper Hollin & Colagreco', '9 W Central Ave', 'Phoenix', 'Maricopa', 'AZ', '85013', '602-896-2993', '602-575-3457', 'elke_sengbusch@yahoo.com', 'http://www.rileyriperhollincolagreco.com'),
('Hoa', 'Sarao', 'Kaplan, Joel S Esq', '27846 Lafayette Ave', 'Oak Hill', 'Volusia', 'FL', '32759', '386-526-7800', '386-599-7296', 'hoa@sarao.org', 'http://www.kaplanjoelsesq.com'),
('Trinidad', 'Mcrae', 'Water Office', '10276 Brooks St', 'San Francisco', 'San Francisco', 'CA', '94105', '415-331-9634', '415-419-1597', 'trinidad_mcrae@yahoo.com', 'http://www.wateroffice.com'),
('Mari', 'Lueckenbach', 'Westbrooks, Nelson E Jr', '1 Century Park E', 'San Diego', 'San Diego', 'CA', '92110', '858-793-9684', '858-228-5683', 'mari_lueckenbach@yahoo.com', 'http://www.westbrooksnelsonejr.com'),
('Selma', 'Husser', 'Armon Communications', '9 State Highway 57 #22', 'Jersey City', 'Hudson', 'NJ', '7306', '201-991-8369', '201-772-7699', 'selma.husser@cox.net', 'http://www.armoncommunications.com'),
('Antione', 'Onofrio', 'Jacobs & Gerber Inc', '4 S Washington Ave', 'San Bernardino', 'San Bernardino', 'CA', '92410', '909-430-7765', '909-665-3223', 'aonofrio@onofrio.com', 'http://www.jacobsgerberinc.com'),
('Luisa', 'Jurney', 'Forest Fire Laboratory', '25 Se 176th Pl', 'Cambridge', 'Middlesex', 'MA', '2138', '617-365-2134', '617-544-2541', 'ljurney@hotmail.com', 'http://www.forestfirelaboratory.com'),
('Clorinda', 'Heimann', 'Haughey, Charles Jr', '105 Richmond Valley Rd', 'Escondido', 'San Diego', 'CA', '92025', '760-291-5497', '760-261-4786', 'clorinda.heimann@hotmail.com', 'http://www.haugheycharlesjr.com'),
('Dick', 'Wenzinger', 'Wheaton Plastic Products', '22 Spruce St #595', 'Gardena', 'Los Angeles', 'CA', '90248', '310-510-9713', '310-936-2258', 'dick@yahoo.com', 'http://www.wheatonplasticproducts.com'),
('Ahmed', 'Angalich', 'Reese Plastics', '2 W Beverly Blvd', 'Harrisburg', 'Dauphin', 'PA', '17110', '717-528-8996', '717-632-5831', 'ahmed.angalich@angalich.com', 'http://www.reeseplastics.com'),
('Iluminada', 'Ohms', 'Nazette Marner Good Wendt', '72 Southern Blvd', 'Mesa', 'Maricopa', 'AZ', '85204', '480-293-2882', '480-866-6544', 'iluminada.ohms@yahoo.com', 'http://www.nazettemarnergoodwendt.com'),
('Joanna', 'Leinenbach', 'Levinson Axelrod Wheaton', '1 Washington St', 'Lake Worth', 'Palm Beach', 'FL', '33461', '561-470-4574', '561-951-9734', 'joanna_leinenbach@hotmail.com', 'http://www.levinsonaxelrodwheaton.com'),
('Caprice', 'Suell', 'Egnor, W Dan Esq', '90177 N 55th Ave', 'Nashville', 'Davidson', 'TN', '37211', '615-246-1824', '615-726-4537', 'caprice@aol.com', 'http://www.egnorwdanesq.com'),
('Stephane', 'Myricks', 'Portland Central Thriftlodge', '9 Tower Ave', 'Burlington', 'Boone', 'KY', '41005', '859-717-7638', '859-308-4286', 'stephane_myricks@cox.net', 'http://www.portlandcentralthriftlodge.com'),
('Quentin', 'Swayze', 'Ulbrich Trucking', '278 Bayview Ave', 'Milan', 'Monroe', 'MI', '48160', '734-561-6170', '734-851-8571', 'quentin_swayze@yahoo.com', 'http://www.ulbrichtrucking.com'),
('Annmarie', 'Castros', 'Tipiak Inc', '80312 W 32nd St', 'Conroe', 'Montgomery', 'TX', '77301', '936-751-7961', '936-937-2334', 'annmarie_castros@gmail.com', 'http://www.tipiakinc.com'),
('Shonda', 'Greenbush', 'Saint George Well Drilling', '82 Us Highway 46', 'Clifton', 'Passaic', 'NJ', '7011', '973-482-2430', '973-644-2974', 'shonda_greenbush@cox.net', 'http://www.saintgeorgewelldrilling.com'),
('Cecil', 'Lapage', 'Hawkes, Douglas D', '4 Stovall St #72', 'Union City', 'Hudson', 'NJ', '7087', '201-693-3967', '201-856-2720', 'clapage@lapage.com', 'http://www.hawkesdouglasd.com'),
('Jeanice', 'Claucherty', 'Accurel Systems Intrntl Corp', '19 Amboy Ave', 'Miami', 'Miami-Dade', 'FL', '33142', '305-988-4162', '305-306-7834', 'jeanice.claucherty@yahoo.com', 'http://www.accurelsystemsintrntlcorp.com'),
('Josphine', 'Villanueva', 'Santa Cruz Community Internet', '63 Smith Ln #8343', 'Moss', 'Clay', 'TN', '38575', '931-553-9774', '931-486-6946', 'josphine_villanueva@villanueva.com', 'http://www.santacruzcommunityinternet.com'),
('Daniel', 'Perruzza', 'Gersh & Danielson', '11360 S Halsted St', 'Santa Ana', 'Orange', 'CA', '92705', '714-771-3880', '714-531-1391', 'dperruzza@perruzza.com', 'http://www.gershdanielson.com'),
('Cassi', 'Wildfong', 'Cobb, James O Esq', '26849 Jefferson Hwy', 'Rolling Meadows', 'Cook', 'IL', '60008', '847-633-3216', '847-755-9041', 'cassi.wildfong@aol.com', 'http://www.cobbjamesoesq.com'),
('Britt', 'Galam', 'Wheatley Trucking Company', '2500 Pringle Rd Se #508', 'Hatfield', 'Montgomery', 'PA', '19440', '215-888-3304', '215-351-8523', 'britt@galam.org', 'http://www.wheatleytruckingcompany.com'),
('Adell', 'Lipkin', 'Systems Graph Inc Ab Dick Dlr', '65 Mountain View Dr', 'Whippany', 'Morris', 'NJ', '7981', '973-654-1561', '973-662-8988', 'adell.lipkin@lipkin.com', 'http://www.systemsgraphincabdickdlr.com'),
('Jacqueline', 'Rowling', 'John Hancock Mutl Life Ins Co', '1 N San Saba', 'Erie', 'Erie', 'PA', '16501', '814-865-8113', '814-481-1700', 'jacqueline.rowling@yahoo.com', 'http://www.johnhancockmutllifeinsco.com'),
('Lonny', 'Weglarz', 'History Division Of State', '51120 State Route 18', 'Salt Lake City', 'Salt Lake', 'UT', '84115', '801-293-9853', '801-892-8781', 'lonny_weglarz@gmail.com', 'http://www.historydivisionofstate.com'),
('Lonna', 'Diestel', 'Dimmock, Thomas J Esq', '1482 College Ave', 'Fayetteville', 'Cumberland', 'NC', '28301', '910-922-3672', '910-200-7912', 'lonna_diestel@gmail.com', 'http://www.dimmockthomasjesq.com'),
('Cristal', 'Samara', 'Intermed Inc', '4119 Metropolitan Dr', 'Los Angeles', 'Los Angeles', 'CA', '90021', '213-975-8026', '213-696-8004', 'cristal@cox.net', 'http://www.intermedinc.com'),
('Kenneth', 'Grenet', 'Bank Of New York', '2167 Sierra Rd', 'East Lansing', 'Ingham', 'MI', '48823', '517-499-2322', '517-867-8077', 'kenneth.grenet@grenet.org', 'http://www.bankofnewyork.com'),
('Elli', 'Mclaird', 'Sportmaster Intrnatl', '6 Sunrise Ave', 'Utica', 'Oneida', 'NY', '13501', '315-818-2638', '315-474-5570', 'emclaird@mclaird.com', 'http://www.sportmasterintrnatl.com'),
('Alline', 'Jeanty', 'W W John Holden Inc', '55713 Lake City Hwy', 'South Bend', 'St Joseph', 'IN', '46601', '574-656-2800', '574-405-1983', 'ajeanty@gmail.com', 'http://www.wwjohnholdeninc.com'),
('Sharika', 'Eanes', 'Maccani & Delp', '75698 N Fiesta Blvd', 'Orlando', 'Orange', 'FL', '32806', '407-312-1691', '407-472-1332', 'sharika.eanes@aol.com', 'http://www.maccanidelp.com'),
('Nu', 'Mcnease', 'Amazonia Film Project', '88 Sw 28th Ter', 'Harrison', 'Hudson', 'NJ', '7029', '973-751-9003', '973-903-4175', 'nu@gmail.com', 'http://www.amazoniafilmproject.com'),
('Daniela', 'Comnick', 'Water & Sewer Department', '7 Flowers Rd #403', 'Trenton', 'Mercer', 'NJ', '8611', '609-200-8577', '609-398-2805', 'dcomnick@cox.net', 'http://www.watersewerdepartment.com'),
('Cecilia', 'Colaizzo', 'Switchcraft Inc', '4 Nw 12th St #3849', 'Madison', 'Dane', 'WI', '53717', '608-382-4541', '608-302-3387', 'cecilia_colaizzo@colaizzo.com', 'http://www.switchcraftinc.com'),
('Leslie', 'Threets', 'C W D C Metal Fabricators', '2 A Kelley Dr', 'Katonah', 'Westchester', 'NY', '10536', '914-861-9748', '914-396-2615', 'leslie@cox.net', 'http://www.cwdcmetalfabricators.com'),
('Nan', 'Koppinger', 'Shimotani, Grace T', '88827 Frankford Ave', 'Greensboro', 'Guilford', 'NC', '27401', '336-370-5333', '336-564-1492', 'nan@koppinger.com', 'http://www.shimotanigracet.com'),
('Izetta', 'Dewar', 'Lisatoni, Jean Esq', '2 W Scyene Rd #3', 'Baltimore', 'Baltimore City', 'MD', '21217', '410-473-1708', '410-522-7621', 'idewar@dewar.com', 'http://www.lisatonijeanesq.com'),
('Tegan', 'Arceo', 'Ceramic Tile Sales Inc', '62260 Park Stre', 'Monroe Township', 'Middlesex', 'NJ', '8831', '732-730-2692', '732-705-6719', 'tegan.arceo@arceo.org', 'http://www.ceramictilesalesinc.com'),
('Ruthann', 'Keener', 'Maiden Craft Inc', '3424 29th St Se', 'Kerrville', 'Kerr', 'TX', '78028', '830-258-2769', '830-919-5991', 'ruthann@hotmail.com', 'http://www.maidencraftinc.com'),
('Joni', 'Breland', 'Carriage House Cllsn Rpr Inc', '35 E Main St #43', 'Elk Grove Village', 'Cook', 'IL', '60007', '847-519-5906', '847-740-5304', 'joni_breland@cox.net', 'http://www.carriagehousecllsnrprinc.com'),
('Vi', 'Rentfro', 'Video Workshop', '7163 W Clark Rd', 'Freehold', 'Monmouth', 'NJ', '7728', '732-605-4781', '732-724-7251', 'vrentfro@cox.net', 'http://www.videoworkshop.com'),
('Colette', 'Kardas', 'Fresno Tile Center Inc', '21575 S Apple Creek Rd', 'Omaha', 'Douglas', 'NE', '68124', '402-896-5943', '402-707-1602', 'colette.kardas@yahoo.com', 'http://www.fresnotilecenterinc.com'),
('Malcolm', 'Tromblay', 'Versatile Sash & Woodwork', '747 Leonis Blvd', 'Annandale', 'Fairfax', 'VA', '22003', '703-221-5602', '703-874-4248', 'malcolm_tromblay@cox.net', 'http://www.versatilesashwoodwork.com'),
('Ryan', 'Harnos', 'Warner Electric Brk & Cltch Co', '13 Gunnison St', 'Plano', 'Collin', 'TX', '75075', '972-558-1665', '972-961-4968', 'ryan@cox.net', 'http://www.warnerelectricbrkcltchco.com'),
('Jess', 'Chaffins', 'New York Public Library', '18 3rd Ave', 'New York', 'New York', 'NY', '10016', '212-510-4633', '212-428-9538', 'jess.chaffins@chaffins.org', 'http://www.newyorkpubliclibrary.com'),
('Sharen', 'Bourbon', 'Mccaleb, John A Esq', '62 W Austin St', 'Syosset', 'Nassau', 'NY', '11791', '516-816-1541', '516-749-3188', 'sbourbon@yahoo.com', 'http://www.mccalebjohnaesq.com'),
('Nickolas', 'Juvera', 'United Oil Co Inc', '177 S Rider Trl #52', 'Crystal River', 'Citrus', 'FL', '34429', '352-598-8301', '352-947-6152', 'nickolas_juvera@cox.net', 'http://www.unitedoilcoinc.com'),
('Gary', 'Nunlee', 'Irving Foot Center', '2 W Mount Royal Ave', 'Fortville', 'Hancock', 'IN', '46040', '317-542-6023', '317-887-8486', 'gary_nunlee@nunlee.org', 'http://www.irvingfootcenter.com'),
('Diane', 'Devreese', 'Acme Supply Co', '1953 Telegraph Rd', 'Saint Joseph', 'Buchanan', 'MO', '64504', '816-557-9673', '816-329-5565', 'diane@cox.net', 'http://www.acmesupplyco.com'),
('Roslyn', 'Chavous', 'Mcrae, James L', '63517 Dupont St', 'Jackson', 'Hinds', 'MS', '39211', '601-234-9632', '601-973-5754', 'roslyn.chavous@chavous.org', 'http://www.mcraejamesl.com'),
('Glory', 'Schieler', 'Mcgraths Seafood', '5 E Truman Rd', 'Abilene', 'Taylor', 'TX', '79602', '325-869-2649', '325-740-3778', 'glory@yahoo.com', 'http://www.mcgrathsseafood.com'),
('Rasheeda', 'Sayaphon', 'Kummerer, J Michael Esq', '251 Park Ave #979', 'Saratoga', 'Santa Clara', 'CA', '95070', '408-805-4309', '408-997-7490', 'rasheeda@aol.com', 'http://www.kummererjmichaelesq.com'),
('Alpha', 'Palaia', 'Stoffer, James M Jr', '43496 Commercial Dr #29', 'Cherry Hill', 'Camden', 'NJ', '8003', '856-312-2629', '856-513-7024', 'alpha@yahoo.com', 'http://www.stofferjamesmjr.com'),
('Refugia', 'Jacobos', 'North Central Fl Sfty Cncl', '2184 Worth St', 'Hayward', 'Alameda', 'CA', '94545', '510-974-8671', '510-509-3496', 'refugia.jacobos@jacobos.com', 'http://www.northcentralflsftycncl.com'),
('Shawnda', 'Yori', 'Fiorucci Foods Usa Inc', '50126 N Plankinton Ave', 'Longwood', 'Seminole', 'FL', '32750', '407-538-5106', '407-564-8113', 'shawnda.yori@yahoo.com', 'http://www.fioruccifoodsusainc.com'),
('Mona', 'Delasancha', 'Sign All', '38773 Gravois Ave', 'Cheyenne', 'Laramie', 'WY', '82001', '307-403-1488', '307-816-7115', 'mdelasancha@hotmail.com', 'http://www.signall.com'),
('Gilma', 'Liukko', 'Sammys Steak Den', '16452 Greenwich St', 'Garden City', 'Nassau', 'NY', '11530', '516-393-9967', '516-407-9573', 'gilma_liukko@gmail.com', 'http://www.sammyssteakden.com'),
('Janey', 'Gabisi', 'Dobscha, Stephen F Esq', '40 Cambridge Ave', 'Madison', 'Dane', 'WI', '53715', '608-967-7194', '608-586-6912', 'jgabisi@hotmail.com', 'http://www.dobschastephenfesq.com'),
('Lili', 'Paskin', 'Morgan Custom Homes', '20113 4th Ave E', 'Kearny', 'Hudson', 'NJ', '7032', '201-431-2989', '201-478-8540', 'lili.paskin@cox.net', 'http://www.morgancustomhomes.com'),
('Loren', 'Asar', 'Olsen Payne & Company', '6 Ridgewood Center Dr', 'Old Forge', 'Lackawanna', 'PA', '18518', '570-648-3035', '570-569-2356', 'loren.asar@aol.com', 'http://www.olsenpaynecompany.com'),
('Dorothy', 'Chesterfield', 'Cowan & Kelly', '469 Outwater Ln', 'San Diego', 'San Diego', 'CA', '92126', '858-617-7834', '858-732-1884', 'dorothy@cox.net', 'http://www.cowankelly.com'),
('Gail', 'Similton', 'Johnson, Wes Esq', '62 Monroe St', 'Thousand Palms', 'Riverside', 'CA', '92276', '760-616-5388', '760-493-9208', 'gail_similton@similton.com', 'http://www.johnsonwesesq.com'),
('Catalina', 'Tillotson', 'Icn Pharmaceuticals Inc', '3338 A Lockport Pl #6', 'Margate City', 'Atlantic', 'NJ', '8402', '609-373-3332', '609-826-4990', 'catalina@hotmail.com', 'http://www.icnpharmaceuticalsinc.com'),
('Lawrence', 'Lorens', 'New England Sec Equip Co Inc', '9 Hwy', 'Providence', 'Providence', 'RI', '2906', '401-465-6432', '401-893-1820', 'lawrence.lorens@hotmail.com', 'http://www.newenglandsecequipcoinc.com'),
('Carlee', 'Boulter', 'Tippett, Troy M Ii', '8284 Hart St', 'Abilene', 'Dickinson', 'KS', '67410', '785-347-1805', '785-253-7049', 'carlee.boulter@hotmail.com', 'http://www.tippetttroymii.com'),
('Thaddeus', 'Ankeny', 'Atc Contracting', '5 Washington St #1', 'Roseville', 'Placer', 'CA', '95678', '916-920-3571', '916-459-2433', 'tankeny@ankeny.org', 'http://www.atccontracting.com'),
('Jovita', 'Oles', 'Pagano, Philip G Esq', '8 S Haven St', 'Daytona Beach', 'Volusia', 'FL', '32114', '386-248-4118', '386-208-6976', 'joles@gmail.com', 'http://www.paganophilipgesq.com'),
('Alesia', 'Hixenbaugh', 'Kwikprint', '9 Front St', 'Washington', 'District of Columbia', 'DC', '20001', '202-646-7516', '202-276-6826', 'alesia_hixenbaugh@hixenbaugh.org', 'http://www.kwikprint.com'),
('Lai', 'Harabedian', 'Buergi & Madden Scale', '1933 Packer Ave #2', 'Novato', 'Marin', 'CA', '94945', '415-423-3294', '415-926-6089', 'lai@gmail.com', 'http://www.buergimaddenscale.com'),
('Brittni', 'Gillaspie', 'Inner Label', '67 Rv Cent', 'Boise', 'Ada', 'ID', '83709', '208-709-1235', '208-206-9848', 'bgillaspie@gillaspie.com', 'http://www.innerlabel.com'),
('Raylene', 'Kampa', 'Hermar Inc', '2 Sw Nyberg Rd', 'Elkhart', 'Elkhart', 'IN', '46514', '574-499-1454', '574-330-1884', 'rkampa@kampa.org', 'http://www.hermarinc.com'),
('Flo', 'Bookamer', 'Simonton Howe & Schneider Pc', '89992 E 15th St', 'Alliance', 'Box Butte', 'NE', '69301', '308-726-2182', '308-250-6987', 'flo.bookamer@cox.net', 'http://www.simontonhoweschneiderpc.com'),
('Jani', 'Biddy', 'Warehouse Office & Paper Prod', '61556 W 20th Ave', 'Seattle', 'King', 'WA', '98104', '206-711-6498', '206-395-6284', 'jbiddy@yahoo.com', 'http://www.warehouseofficepaperprod.com'),
('Chauncey', 'Motley', 'Affiliated With Travelodge', '63 E Aurora Dr', 'Orlando', 'Orange', 'FL', '32804', '407-413-4842', '407-557-8857', 'chauncey_motley@aol.com', 'http://www.affiliatedwithtravelodge.com');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `android`
--
ALTER TABLE `android`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `secret_code`
--
ALTER TABLE `secret_code`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `android`
--
ALTER TABLE `android`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT dla tabeli `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT dla tabeli `secret_code`
--
ALTER TABLE `secret_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

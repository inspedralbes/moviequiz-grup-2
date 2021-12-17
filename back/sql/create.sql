DROP TABLE IF EXISTS usu_peli;

DROP TABLE IF EXISTS usuari;

DROP TABLE IF EXISTS pelicula;

--
-- Base de dades: `projectepelis`
--

-- --------------------------------------------------------

--
-- Estructura de la taula `pelicula`
--

CREATE TABLE `pelicula` (
  `ImdbID` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `poster` varchar(150) NOT NULL,
  `estrena` int(11) NOT NULL,
  `nFavorits` int(11) NOT NULL
);

--
-- Bolcament de dades per a la taula `pelicula`
--

INSERT INTO `pelicula` (`ImdbID`, `nom`, `poster`, `estrena`) VALUES
('tt0317219', 'Cars', 'https://m.media-amazon.com/images/M/MV5BMTg5NzY0MzA2MV5BMl5BanBnXkFtZTYwNDc3NTc2._V1_SX300.jpg', 2006);

-- --------------------------------------------------------

--
-- Estructura de la taula `usuari`
--

CREATE TABLE `usuari` (
  `id` int(11) NOT NULL,
  `nomUsuari` varchar(20) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `cognom` varchar(25) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `karma` tinyint(4) NOT NULL DEFAULT 0
) ;

--
-- Bolcament de dades per a la taula `usuari`
--

INSERT INTO `usuari` (`id`, `nomUsuari`, `nom`, `cognom`, `password`, `email`, `karma`) VALUES
(1, 'SergioV', 'Sergio', 'Villacampa', 'sergio2002', 'a20servilrac@inspedralbes.cat', 0);

-- --------------------------------------------------------

--
-- Estructura de la taula `usu_peli`
--

CREATE TABLE `usu_peli` (
  `id` int(11) NOT NULL,
  `ImdbID` varchar(50) NOT NULL,
  `comentari` text NOT NULL,
  `puntuacio` int(11) NOT NULL
) ;

--
-- Índexs per a les taules bolcades
--

--
-- Índexs per a la taula `pelicula`
--
ALTER TABLE `pelicula`
  ADD PRIMARY KEY (`ImdbID`);

--
-- Índexs per a la taula `usuari`
--
ALTER TABLE `usuari`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nomUsuari` (`nomUsuari`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índexs per a la taula `usu_peli`
--
ALTER TABLE `usu_peli`
  ADD PRIMARY KEY (`ImdbID`, `id`),
  ADD KEY `fk_idUsuari` (`id`),
  ADD KEY `fk_idPelicula` (`ImdbID`);

--
-- Restriccions per a les taules bolcades
--

--
-- Restriccions per a la taula `usu_peli`
--
ALTER TABLE `usu_peli`
  ADD CONSTRAINT `fk_idPelicula` FOREIGN KEY (`ImdbID`) REFERENCES `pelicula` (`ImdbID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_idUsuari` FOREIGN KEY (`id`) REFERENCES `usuari` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;


CREATE TABLE `projectepelis`.`partida` ( `id` INT NOT NULL AUTO_INCREMENT , `nom` VARCHAR(50) NOT NULL , 
`dia` DATE NOT NULL , `encerts` INT NOT NULL , `errors` INT NOT NULL , `json_partida` JSON NOT NULL , PRIMARY KEY (`id`)) ; 


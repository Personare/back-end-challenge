-- --------------------------------------------------------

--
-- Table structure for table `moedas`
--

CREATE TABLE IF NOT EXISTS `moedas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `simbolo` varchar(10) NOT NULL,
  `sigla` varchar(5) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nome` (`nome`),
  KEY `simbolo` (`simbolo`,`sigla`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `moedas`
--

INSERT INTO `moedas` (`id`, `nome`, `simbolo`, `sigla`) VALUES
(1, 'Brazillian Real', 'R$', 'BRL'),
(2, 'U.S. Dollar', '$', 'USD'),
(3, 'Euro', '€', 'EUR');

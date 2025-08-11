-- Donaties tabel aanmaken
CREATE TABLE IF NOT EXISTS `donaties` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `voornaam` varchar(100) NOT NULL,
  `achternaam` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `bedrag` decimal(10,2) NOT NULL,
  `donatie_namens` enum('myself','organization','someone-else') DEFAULT NULL,
  `gehoord_via` varchar(100) DEFAULT NULL,
  `datum` date NOT NULL,
  `tijd` time NOT NULL,
  `status` enum('pending','completed','failed') DEFAULT 'pending',
  `betaalmethode` varchar(50) DEFAULT NULL,
  `transactie_id` varchar(255) DEFAULT NULL,
  `opmerkingen` text DEFAULT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_datum` (`datum`),
  KEY `idx_status` (`status`),
  KEY `idx_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Voorbeeld data toevoegen (optioneel)
INSERT INTO `donaties` (`voornaam`, `achternaam`, `email`, `bedrag`, `donatie_namens`, `gehoord_via`, `datum`, `tijd`, `status`, `betaalmethode`) VALUES
('Jan', 'Jansen', 'jan@example.com', 25.00, 'myself', 'website', '2024-01-15', '14:30:00', 'completed', 'iDEAL'),
('Maria', 'Smit', 'maria@example.com', 50.00, 'organization', 'social-media', '2024-01-16', '09:15:00', 'completed', 'PayPal'),
('Peter', 'Bakker', 'peter@example.com', 100.00, 'someone-else', 'friend', '2024-01-17', '16:45:00', 'completed', 'credit-card'),
('Lisa', 'Visser', 'lisa@example.com', 15.00, 'myself', 'search', '2024-01-18', '11:20:00', 'pending', 'iDEAL'),
('Mark', 'Meijer', 'mark@example.com', 75.00, 'organization', 'event', '2024-01-19', '13:10:00', 'completed', 'PayPal');

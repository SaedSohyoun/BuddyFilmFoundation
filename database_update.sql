-- Database update voor portfolio moderatie systeem
-- Voer dit uit in je database om de nieuwe velden toe te voegen

-- Voeg portfolio status en moderatie velden toe aan gebruikers tabel
ALTER TABLE gebruikers 
ADD COLUMN portfolio_status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending' AFTER stad,
ADD COLUMN portfolio_moderatie_datum TIMESTAMP NULL DEFAULT NULL AFTER portfolio_status,
ADD COLUMN portfolio_moderatie_opmerking TEXT NULL AFTER portfolio_moderatie_datum,
ADD COLUMN portfolio_laatste_wijziging TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP AFTER portfolio_moderatie_opmerking;

-- Maak een moderatie log tabel aan
CREATE TABLE IF NOT EXISTS portfolio_moderatie_log (
    id INT AUTO_INCREMENT PRIMARY KEY,
    filmmaker_id INT NOT NULL,
    admin_id INT NOT NULL,
    actie ENUM('approved', 'rejected', 'pending') NOT NULL,
    opmerking TEXT NULL,
    datum TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_filmmaker (filmmaker_id),
    INDEX idx_admin (admin_id),
    INDEX idx_datum (datum)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Update bestaande filmmakers naar 'approved' status (optioneel)
-- UPDATE gebruikers SET portfolio_status = 'approved' WHERE rol = 'filmmaker' AND portfolio_status = 'pending';

-- Voeg index toe voor snellere queries
CREATE INDEX idx_portfolio_status ON gebruikers(portfolio_status);
CREATE INDEX idx_portfolio_moderatie_datum ON gebruikers(portfolio_moderatie_datum);


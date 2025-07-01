CREATE DATABASE IF NOT EXISTS tourmate_db;
USE tourmate_db;

CREATE TABLE IF NOT EXISTS tourists (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    phone VARCHAR(20) NOT NULL,
    location VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS guides (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    phone VARCHAR(20) NOT NULL,
    location VARCHAR(255) NOT NULL,
    bio TEXT,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS unrevealed_places (
    id INT AUTO_INCREMENT PRIMARY KEY,
    guide_id INT NOT NULL,
    name VARCHAR(150) NOT NULL,
    description TEXT,
    location VARCHAR(255) NOT NULL,
    image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (guide_id) REFERENCES guides(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS tours (
    id INT AUTO_INCREMENT PRIMARY KEY,
    guide_id INT NOT NULL,
    tourist_id INT NOT NULL,
    title VARCHAR(150) NOT NULL,
    description TEXT,
    location VARCHAR(255) NOT NULL,
    scheduled_date DATE,
    status ENUM('pending','active','completed','cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (guide_id) REFERENCES guides(id) ON DELETE CASCADE,
    FOREIGN KEY (tourist_id) REFERENCES tourists(id) ON DELETE CASCADE
);

INSERT INTO tourists (name, email, phone, location, password) VALUES
('Suman Shrestha', 'suman.shrestha@example.com', '9800000001', 'Kathmandu, Nepal', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Anita Gurung', 'anita.gurung@example.com', '9800000002', 'Pokhara, Nepal', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

INSERT INTO guides (name, email, phone, location, bio, password) VALUES
('Bikash Rai', 'bikash.rai@example.com', '9800000003', 'Lalitpur, Nepal', 'Local expert in Patan and hidden food spots.', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Maya Lama', 'maya.lama@example.com', '9800000004', 'Bhaktapur, Nepal', 'Specializes in Bhaktapur heritage and secret temples.', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

INSERT INTO unrevealed_places (guide_id, name, description, location, image) VALUES
(1, 'Hidden Patan Courtyard', 'A peaceful courtyard in Patan, known only to locals.', 'Patan, Lalitpur', 'assets/patan_courtyard.jpg'),
(2, 'Secret Bhaktapur Alley', 'A narrow alley with ancient carvings and local snacks.', 'Bhaktapur Durbar Square', 'assets/bhaktapur_alley.jpg');

INSERT INTO tours (guide_id, tourist_id, title, description, location, scheduled_date, status) VALUES
(1, 1, 'Patan Food & Culture Walk', 'Explore Patan''s hidden courtyards and taste local delicacies.', 'Patan, Lalitpur', '2024-07-10', 'completed'),
(2, 2, 'Bhaktapur Heritage Secrets', 'Discover Bhaktapur''s secret temples and alleys.', 'Bhaktapur', '2024-07-12', 'active'); 
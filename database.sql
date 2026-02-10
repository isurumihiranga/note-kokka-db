-- NOTE KOKKA DATABASE SETUP
-- Run this SQL in your hosting cPanel phpMyAdmin or MySQL command line

-- Create database (if not already created by hosting)
CREATE DATABASE IF NOT EXISTS note_kokka_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE note_kokka_db;

-- Create subjects table
CREATE TABLE IF NOT EXISTS subjects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    icon VARCHAR(10) NOT NULL,
    drive_link TEXT NOT NULL,
    display_order INT DEFAULT 0,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_display_order (display_order),
    INDEX idx_is_active (is_active)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert sample subjects (you can modify these after setup)
INSERT INTO subjects (name, icon, drive_link, display_order) VALUES
('Mathematics', '📐', 'https://drive.google.com/drive/folders/your-folder-id-1', 1),
('Science', '🔬', 'https://drive.google.com/drive/folders/your-folder-id-2', 2),
('Languages', '📖', 'https://drive.google.com/drive/folders/your-folder-id-3', 3),
('Technology', '💻', 'https://drive.google.com/drive/folders/your-folder-id-4', 4),
('Arts', '🎨', 'https://drive.google.com/drive/folders/your-folder-id-5', 5),
('History', '🏛️', 'https://drive.google.com/drive/folders/your-folder-id-6', 6);

-- Create analytics table (optional - for future enhancements)
CREATE TABLE IF NOT EXISTS analytics (
    id INT AUTO_INCREMENT PRIMARY KEY,
    visit_date DATE NOT NULL,
    visit_count INT DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unique_date (visit_date)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create admin logs table (optional - for tracking changes)
CREATE TABLE IF NOT EXISTS admin_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    action VARCHAR(50) NOT NULL,
    subject_id INT DEFAULT NULL,
    details TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_created_at (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

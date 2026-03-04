CREATE DATABASE IF NOT EXISTS school_fee_db;
USE school_fee_db;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(30) DEFAULT 'admin',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_name VARCHAR(100) NOT NULL,
    class VARCHAR(50) NOT NULL,
    parent_phone VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    payment_date DATE NOT NULL,
    method VARCHAR(50) DEFAULT 'cash',
    created_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_payment_student FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE,
    CONSTRAINT fk_payment_user FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL
);

INSERT INTO users (full_name, email, password, role) VALUES
('Admin User', 'admin@example.com', 'admin123', 'admin');

INSERT INTO students (student_name, class, parent_phone) VALUES
('John Doe', 'Grade 8', '1234567890'),
('Mary Jane', 'Grade 9', '9876543210');

INSERT INTO payments (student_id, amount, payment_date, method, created_by) VALUES
(1, 1200.00, '2026-03-01', 'cash', 1),
(2, 1500.00, '2026-03-02', 'bank', 1);

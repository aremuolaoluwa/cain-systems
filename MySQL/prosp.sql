-- Table for Prospective students

CREATE TABLE student_profile (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    other_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    class ENUM('JSS1', 'JSS2', 'JSS3', 'SS1', 'SS2', 'SS3') NOT NULL,
    dob DATE NOT NULL,
    name_of_school VARCHAR(100) NOT NULL,
    state_of_origin VARCHAR(50) NOT NULL,
    gender ENUM('Male', 'Female') NOT NULL,
    guardian_name VARCHAR(100) NOT NULL,
    guardian_phone VARCHAR(20) NOT NULL,
    occupation VARCHAR(50) NOT NULL,
    guardian_address VARCHAR(255) NOT NULL
);

-- Table for Programs

CREATE TABLE programs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    program VARCHAR(255) NOT NULL,
)

-- Insert values into program column

Insert INTO program VALUES (
    'Mentorship Class',
    'Mathematics Tutorial',
    'English Tutorial',
    'Life Hacks',
    'Games Day',
    'Career Enrichment'
)
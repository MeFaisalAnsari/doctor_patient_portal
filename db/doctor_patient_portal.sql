-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2023 at 11:33 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `doctor_patient_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `dt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `dt`) VALUES
(1, 'admin', 'admin', '2023-03-05 01:56:55');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `appointment_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` time NOT NULL,
  `appointment_reason` varchar(255) NOT NULL,
  `appointment_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appointment_id`, `patient_id`, `doctor_id`, `appointment_date`, `appointment_time`, `appointment_reason`, `appointment_status`) VALUES
(5, 4, 9, '2023-03-16', '12:30:00', 'Breathing Problem', 'completed'),
(6, 5, 9, '2023-03-16', '13:00:00', 'Headache, vomiting', 'completed'),
(7, 1, 9, '2023-03-17', '09:00:00', 'Regular Chekup', 'scheduled'),
(8, 1, 14, '2023-03-17', '09:00:00', 'Fever', 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `blood_bank`
--

CREATE TABLE `blood_bank` (
  `blood_bank_id` int(11) NOT NULL,
  `blood_type` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `expiry_date` date NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blood_bank`
--

INSERT INTO `blood_bank` (`blood_bank_id`, `blood_type`, `quantity`, `expiry_date`, `location`) VALUES
(1, 'A+', 50, '2023-03-31', 'Community Hospital'),
(2, 'B+', 25, '2023-04-15', 'Red Cross Blood Center'),
(3, 'O-', 10, '2023-03-20', 'City Medical Center'),
(4, 'AB+', 30, '2023-05-01', 'Community Blood Drive'),
(5, 'A-', 20, '2023-03-31', 'Red Cross Blood Center');

-- --------------------------------------------------------

--
-- Table structure for table `blood_donation`
--

CREATE TABLE `blood_donation` (
  `blood_donation_id` int(11) NOT NULL,
  `donor_id` int(11) NOT NULL,
  `blood_group` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `donation_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blood_donation`
--

INSERT INTO `blood_donation` (`blood_donation_id`, `donor_id`, `blood_group`, `location`, `donation_date`) VALUES
(1, 1, 'A+', 'Community Hospital', '2023-03-01'),
(3, 2, 'O+', 'Community Blood Drive', '2023-02-20'),
(4, 2, 'O+', 'City Medical Center', '2023-03-24');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `doctor_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `qualification` varchar(255) NOT NULL,
  `specialisation` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `dt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`doctor_id`, `first_name`, `last_name`, `email`, `password`, `gender`, `dob`, `phone`, `address`, `qualification`, `specialisation`, `status`, `dt`) VALUES
(4, 'John', 'Smith', 'john.smith@example.com', '7h@kP9X&6jC', 'Male', '1985-05-10', '1234567890', '123 Main St, Anytown, USA', 'MD', 'Cardiology', 1, '2023-03-14 01:06:48'),
(5, 'Sarah', 'Lee', 'sarah.lee@example.com', 'uEd6HD9b', 'female', '1978-11-22', '1234567890', '456 Maple Ave, Anytown, USA', 'DDS', 'Dentistry', 1, '2023-03-14 01:11:18'),
(6, 'Muhammad', 'Ali', 'muhammad.ali@example.com', '9MzRFJjk', 'male', '1990-07-15', '1234567890', '789 Oak St, Anytown, USA', 'MBBS, MD', 'Oncology', 1, '2023-03-14 01:13:32'),
(7, 'William', 'Kim', 'william.kim@example.com', 'uTPCXT4e', 'male', '1975-09-12', '1234567890', '789 Main St, Anytown, USA', 'DVM', 'Veterinary Medicine', 1, '2023-03-14 01:15:07'),
(8, 'Emily', 'Chen', 'emily.chen@example.com', 'IZgSx49k', 'female', '1988-12-08', '1234567890', '222 Oak St, Anytown, USA', 'MD, MPH', 'Public Health', 1, '2023-03-14 01:16:21'),
(9, 'David', 'Garcia', 'david.garcia@example.com', 'CWFxis5n', 'male', '1995-02-08', '1234567890', '777 Main St, Anytown, USA', 'DO', 'Family Medicine', 1, '2023-03-14 01:17:50'),
(14, 'Anmol', 'Dwivedi', 'anmoldwivedi722@gmail.com', 'Q0Oy35et', 'male', '2002-02-12', '65465151', 'ergwerg', 'Bsc', 'refewre xf', 1, '2023-03-16 14:24:05');

-- --------------------------------------------------------

--
-- Table structure for table `medical_history`
--

CREATE TABLE `medical_history` (
  `medical_history_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `medical_condition` varchar(255) NOT NULL,
  `diagnosis_date` date NOT NULL DEFAULT current_timestamp(),
  `treatment` varchar(255) NOT NULL,
  `medication` varchar(255) NOT NULL,
  `notes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medical_history`
--

INSERT INTO `medical_history` (`medical_history_id`, `patient_id`, `medical_condition`, `diagnosis_date`, `treatment`, `medication`, `notes`) VALUES
(1, 1, 'Asthama', '2022-05-15', 'Inhaler, allergy testing', 'Albuterol', 'Patient also has a peanut allergy.'),
(2, 2, 'Hypertension', '2021-09-01', 'Exercise, low-sodium diet', 'Losartan', 'Blood pressure has been under control since starting treatment.'),
(3, 3, 'Type 2 Diabetes', '2023-01-10', 'Insulin injections, diet changes', 'Lantus, Metformin', 'Patient has been monitoring their blood sugar regularly and making necessary adjustments to their treatment plan.'),
(4, 1, 'Migraines', '2022-03-12', 'Avoiding triggers, stress-management techniques', 'Sumatriptan', 'Patient has experienced fewer migraines since implementing these changes.'),
(5, 1, 'Depression', '2021-12-01', 'Cognitive-behavioral therapy, medication', 'Zoloft, Prozac', 'Patient reports improved mood and better ability to manage symptoms.'),
(6, 2, 'Seasonal Allergies', '2022-06-18', 'Antihistamines', 'Zyrtec', 'Patient reports reduced allergy symptoms with the use of medication.'),
(8, 4, 'Asthama', '2023-03-16', 'Inhaler', 'Albuterol', 'Patient reports wheezing and shortness of breath during physical activity.'),
(9, 5, 'Hypertension', '2023-03-16', 'Lifestyle changes', 'Lisinopril', 'Patient has been monitoring blood pressure regularly and has made necessary changes to diet and exercise.'),
(10, 1, 'Fever', '2023-03-16', 'aiufh', 'iureher', 'This is notes');

-- --------------------------------------------------------

--
-- Table structure for table `organ_bank`
--

CREATE TABLE `organ_bank` (
  `organ_bank_id` int(11) NOT NULL,
  `organ_type` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `expiry_date` date NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `organ_bank`
--

INSERT INTO `organ_bank` (`organ_bank_id`, `organ_type`, `quantity`, `expiry_date`, `location`) VALUES
(1, 'Kidney', 5, '2023-03-31', 'Community Hospital'),
(2, 'Heart', 2, '2023-04-15', 'Red Cross Organ Center'),
(3, 'Liver', 3, '2023-03-20', 'City Medical Center'),
(4, 'Lung', 4, '2023-05-01', 'Community Organ Drive');

-- --------------------------------------------------------

--
-- Table structure for table `organ_donation`
--

CREATE TABLE `organ_donation` (
  `organ_donation_id` int(11) NOT NULL,
  `donor_id` int(11) NOT NULL,
  `organ_type` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `donation_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `patient_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `dt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`patient_id`, `first_name`, `last_name`, `email`, `password`, `dob`, `gender`, `phone`, `address`, `dt`) VALUES
(1, 'Alice', 'Jones', 'alice.jones@example.com', 'P@ssw0rd123', '1990-05-01', 'female', '1234567890', '123 Main St, Anytown, USA', '2023-03-14 02:28:37'),
(2, 'Bob', 'Smith', 'bob.smith@example.com', 'MyPwd456', '1985-09-10', 'male', '1234567890', '456 Maple Ave, Anytown, USA', '2023-03-14 02:52:17'),
(3, 'Charlie', 'Lee', 'charlie.lee@example.com', 'Secret123', '2000-01-05', 'male', '1234567890', '789 Oak St, Anytown, USA', '2023-03-14 02:57:05'),
(4, 'Emma', 'Davis', 'emma.davis@example.com', 'Password!', '1982-03-20', 'female', '1234567890', '10 Elm St, Anytown, USA', '2023-03-14 02:58:43'),
(5, 'Michael', 'Brown', 'michael.brown@example.com', 'mypwd123', '1994-08-12', 'male', '1234567890', '555 Oak St, Anytown, USA', '2023-03-14 03:01:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointment_id`);

--
-- Indexes for table `blood_bank`
--
ALTER TABLE `blood_bank`
  ADD PRIMARY KEY (`blood_bank_id`);

--
-- Indexes for table `blood_donation`
--
ALTER TABLE `blood_donation`
  ADD PRIMARY KEY (`blood_donation_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`doctor_id`);

--
-- Indexes for table `medical_history`
--
ALTER TABLE `medical_history`
  ADD PRIMARY KEY (`medical_history_id`);

--
-- Indexes for table `organ_bank`
--
ALTER TABLE `organ_bank`
  ADD PRIMARY KEY (`organ_bank_id`);

--
-- Indexes for table `organ_donation`
--
ALTER TABLE `organ_donation`
  ADD PRIMARY KEY (`organ_donation_id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`patient_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `blood_bank`
--
ALTER TABLE `blood_bank`
  MODIFY `blood_bank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `blood_donation`
--
ALTER TABLE `blood_donation`
  MODIFY `blood_donation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `doctor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `medical_history`
--
ALTER TABLE `medical_history`
  MODIFY `medical_history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `organ_bank`
--
ALTER TABLE `organ_bank`
  MODIFY `organ_bank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `organ_donation`
--
ALTER TABLE `organ_donation`
  MODIFY `organ_donation_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

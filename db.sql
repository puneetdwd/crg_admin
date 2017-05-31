-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2017 at 12:15 PM
-- Server version: 5.6.21
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `new_crg`
--

-- --------------------------------------------------------

--
-- Table structure for table `available_leaves`
--

CREATE TABLE IF NOT EXISTS `available_leaves` (
`id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `available_leaves` varchar(11) NOT NULL,
  `carry_forward` float NOT NULL DEFAULT '0',
  `available_half_leaves` varchar(5) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `available_leaves_bkp`
--

CREATE TABLE IF NOT EXISTS `available_leaves_bkp` (
`id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `available_leaves` varchar(11) NOT NULL,
  `carry_forward` float NOT NULL DEFAULT '0',
  `available_half_leaves` varchar(5) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `booking_requests`
--

CREATE TABLE IF NOT EXISTS `booking_requests` (
`id` int(11) NOT NULL,
  `code` varchar(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `date_of_request` date NOT NULL,
  `special_request` varchar(20) NOT NULL,
  `type` varchar(40) NOT NULL,
  `trip_type` varchar(40) NOT NULL,
  `travel_reason` varchar(150) NOT NULL,
  `client` varchar(150) NOT NULL,
  `engagement_type` varchar(20) NOT NULL,
  `account_manager` varchar(40) NOT NULL,
  `exp_reimbursable` varchar(20) NOT NULL,
  `approver` int(11) NOT NULL,
  `no_of_days` int(11) NOT NULL,
  `from_` varchar(40) NOT NULL,
  `to_` varchar(40) NOT NULL,
  `departure_date` date NOT NULL,
  `pref_time` varchar(255) NOT NULL,
  `r_from` varchar(40) NOT NULL,
  `r_to` varchar(40) NOT NULL,
  `r_departure_date` date NOT NULL,
  `r_pref_time` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  `decline_reason` varchar(255) NOT NULL,
  `action_date` date NOT NULL,
  `created_time` datetime NOT NULL,
  `modified_time` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=119 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `careers`
--

CREATE TABLE IF NOT EXISTS `careers` (
`id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `cv_name` varchar(100) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `type` enum('Sales','Services','Shared Services') NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `checks`
--

CREATE TABLE IF NOT EXISTS `checks` (
`check_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `client_id` int(10) NOT NULL,
  `check_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `check_status` varchar(255) NOT NULL,
  `latitude` varchar(50) NOT NULL,
  `longitude` varchar(50) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=77 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `comp_offs`
--

CREATE TABLE IF NOT EXISTS `comp_offs` (
`id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `reason` text NOT NULL,
  `reporting_person_id` int(11) NOT NULL,
  `for_date` date NOT NULL,
  `no_of_days` int(11) NOT NULL,
  `valid_from` date NOT NULL,
  `valid_upto` date NOT NULL,
  `is_used` enum('Yes','No') NOT NULL,
  `status` varchar(20) NOT NULL,
  `type` varchar(20) NOT NULL,
  `action_date` varchar(20) NOT NULL,
  `decline_reason` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=159 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `configuration`
--

CREATE TABLE IF NOT EXISTS `configuration` (
`id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `setting` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE IF NOT EXISTS `contact_us` (
`id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `comment` text NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `crg_subscribe`
--

CREATE TABLE IF NOT EXISTS `crg_subscribe` (
`id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cr_login`
--

CREATE TABLE IF NOT EXISTS `cr_login` (
`id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
`id` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `name` varchar(250) NOT NULL,
  `contact_person` varchar(250) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(150) NOT NULL,
  `type` varchar(15) NOT NULL,
  `address1` varchar(200) NOT NULL,
  `address2` varchar(200) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `post_code` varchar(10) NOT NULL,
  `country` varchar(50) NOT NULL,
  `website` varchar(200) NOT NULL,
  `turnover` int(11) NOT NULL,
  `employee_count` int(8) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `pan_no` varchar(20) NOT NULL,
  `tin_no` varchar(20) NOT NULL,
  `cin_no` varchar(20) NOT NULL,
  `cst_no` varchar(20) NOT NULL,
  `gst_no` varchar(20) NOT NULL,
  `stax_no` varchar(20) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `deleted_timesheets`
--

CREATE TABLE IF NOT EXISTS `deleted_timesheets` (
`id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `timesheet_for` enum('working','holiday','on_leave') NOT NULL DEFAULT 'working',
  `hours` int(11) NOT NULL,
  `minutes` int(11) NOT NULL,
  `tasks` text NOT NULL,
  `dashboard` text NOT NULL,
  `phase` varchar(55) NOT NULL,
  `others_phase` varchar(100) NOT NULL,
  `action_type` varchar(55) NOT NULL,
  `challenge_type` varchar(100) NOT NULL,
  `others_challenge_type` varchar(100) NOT NULL,
  `time_wait` varchar(25) NOT NULL,
  `task_status` varchar(25) NOT NULL,
  `assigned_to` varchar(100) NOT NULL,
  `action_on` varchar(25) NOT NULL,
  `others_action_on` varchar(100) NOT NULL,
  `challenges_sol` text NOT NULL,
  `customer_feedback` varchar(100) NOT NULL,
  `others_customer_feedback` varchar(100) NOT NULL,
  `remarks` text NOT NULL,
  `challanges` text NOT NULL,
  `next_action` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `can_edit` enum('Yes','No') NOT NULL,
  `status` enum('Pending','Approved','Declined','In_Question') NOT NULL,
  `decline_reason` text NOT NULL,
  `in_question_reason` text NOT NULL,
  `edit_request_decline_reason` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=35507 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE IF NOT EXISTS `departments` (
`id` int(11) NOT NULL,
  `dept_name` varchar(100) NOT NULL,
  `dept_head` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE IF NOT EXISTS `designations` (
`id` int(11) NOT NULL,
  `desg_name` varchar(100) NOT NULL,
  `band` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `designation_band`
--

CREATE TABLE IF NOT EXISTS `designation_band` (
`id` int(11) NOT NULL,
  `band` varchar(11) NOT NULL,
  `desg_level` varchar(30) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `download_leads`
--

CREATE TABLE IF NOT EXISTS `download_leads` (
`id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `org` varchar(255) NOT NULL,
  `desg` varchar(255) NOT NULL,
  `bus_email` varchar(255) NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `download_option` varchar(20) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `download_leads_track`
--

CREATE TABLE IF NOT EXISTS `download_leads_track` (
`id` int(11) NOT NULL,
  `lead_id` int(11) NOT NULL,
  `downloaded_from` varchar(20) NOT NULL,
  `downloaded_file_type` varchar(10) NOT NULL,
  `downloaded_file` varchar(200) NOT NULL,
  `created_datetime` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `drop_downs`
--

CREATE TABLE IF NOT EXISTS `drop_downs` (
`id` int(11) NOT NULL,
  `drop_down_name` varchar(100) NOT NULL,
  `drop_down_for` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `drop_down_list`
--

CREATE TABLE IF NOT EXISTS `drop_down_list` (
`id` int(11) NOT NULL,
  `drop_down_id` int(11) NOT NULL,
  `drop_down_list` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE IF NOT EXISTS `employees` (
`id` int(11) NOT NULL,
  `empID` varchar(10) NOT NULL,
  `gi_email` varchar(150) NOT NULL,
  `doj` date DEFAULT NULL,
  `designation_id` int(11) DEFAULT NULL,
  `band` varchar(11) NOT NULL,
  `department_id` int(11) DEFAULT NULL,
  `sub_dept_id` int(12) NOT NULL,
  `reporting_person_id` int(11) DEFAULT NULL,
  `location` varchar(30) NOT NULL,
  `father_name` varchar(150) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `blood_group` varchar(20) NOT NULL,
  `dob` date NOT NULL,
  `phone` varchar(15) NOT NULL,
  `emergency_phone` varchar(15) NOT NULL,
  `emergency_phone2` varchar(15) NOT NULL,
  `email` varchar(150) NOT NULL,
  `l_address1` varchar(200) NOT NULL,
  `l_address2` varchar(200) NOT NULL,
  `l_city` varchar(50) NOT NULL,
  `l_state` varchar(50) NOT NULL,
  `l_post_code` varchar(10) NOT NULL,
  `l_country` varchar(50) NOT NULL,
  `p_address1` varchar(200) NOT NULL,
  `p_address2` varchar(200) NOT NULL,
  `p_city` varchar(50) NOT NULL,
  `p_state` varchar(50) NOT NULL,
  `p_post_code` varchar(10) NOT NULL,
  `p_country` varchar(50) NOT NULL,
  `pan` varchar(40) NOT NULL,
  `bank_name` varchar(100) NOT NULL,
  `bank_account_number` varchar(20) NOT NULL,
  `bank_account_name` varchar(150) NOT NULL,
  `bank_ifsc` varchar(20) NOT NULL,
  `bank_address` text NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `image` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status_modified` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employment_request_form`
--

CREATE TABLE IF NOT EXISTS `employment_request_form` (
`id` int(11) NOT NULL,
  `ref_code` varchar(15) NOT NULL,
  `reffered_by` varchar(15) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `emergency_phone` varchar(11) NOT NULL,
  `full_data` text NOT NULL,
  `status` enum('Rejected','Selected','Discarded','Pending','Offered') NOT NULL,
  `status_modified` datetime DEFAULT NULL,
  `emp_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `festivals`
--

CREATE TABLE IF NOT EXISTS `festivals` (
`id` int(11) NOT NULL,
  `festival_name` varchar(255) NOT NULL,
  `festival_date` date NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `festivals_2016`
--

CREATE TABLE IF NOT EXISTS `festivals_2016` (
`id` int(11) NOT NULL,
  `festival_name` varchar(255) NOT NULL,
  `festival_date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `guest_details`
--

CREATE TABLE IF NOT EXISTS `guest_details` (
`id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `age` varchar(20) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `contact_no` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hr_notifications`
--

CREATE TABLE IF NOT EXISTS `hr_notifications` (
`id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `responsible_person_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `indian_cities`
--

CREATE TABLE IF NOT EXISTS `indian_cities` (
`id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `state_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5742 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE IF NOT EXISTS `leaves` (
`id` int(11) NOT NULL,
  `emp_id` varchar(30) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `total_days` varchar(5) NOT NULL,
  `type_of_leave` varchar(25) NOT NULL,
  `half_day_duration` varchar(15) NOT NULL,
  `deduct_from` varchar(25) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `medical_cert` varchar(255) NOT NULL,
  `reason` varchar(150) NOT NULL,
  `status` varchar(15) NOT NULL,
  `decline_reason` varchar(100) NOT NULL,
  `created_date` varchar(12) NOT NULL,
  `modified_date` varchar(12) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=390 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `leaves_bkp`
--

CREATE TABLE IF NOT EXISTS `leaves_bkp` (
`id` int(11) NOT NULL,
  `emp_id` varchar(30) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `total_days` varchar(5) NOT NULL,
  `type_of_leave` varchar(25) NOT NULL,
  `half_day_duration` varchar(15) NOT NULL,
  `deduct_from` varchar(25) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `medical_cert` varchar(255) NOT NULL,
  `reason` varchar(150) NOT NULL,
  `status` varchar(15) NOT NULL,
  `decline_reason` varchar(100) NOT NULL,
  `created_date` varchar(12) NOT NULL,
  `modified_date` varchar(12) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=352 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `leave_settings`
--

CREATE TABLE IF NOT EXISTS `leave_settings` (
`id` int(11) NOT NULL,
  `type_of_leave` int(11) NOT NULL,
  `max_days` varchar(3) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `leave_transactions`
--

CREATE TABLE IF NOT EXISTS `leave_transactions` (
`id` int(11) NOT NULL,
  `leave_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `available` float NOT NULL,
  `taken` float NOT NULL,
  `remaining` float NOT NULL,
  `created_date` datetime NOT NULL,
  `credited` int(11) NOT NULL DEFAULT '0',
  `type` enum('taken','credited') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=315 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `leave_types`
--

CREATE TABLE IF NOT EXISTS `leave_types` (
`id` int(11) NOT NULL,
  `type_of_leave` varchar(25) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mydashboard_config`
--

CREATE TABLE IF NOT EXISTS `mydashboard_config` (
`id` int(11) NOT NULL,
  `currency` varchar(10) NOT NULL,
  `conversion` varchar(10) NOT NULL,
  `target` varchar(50) NOT NULL,
  `headcount_tar` varchar(50) NOT NULL,
  `region_filter` varchar(10) NOT NULL,
  `service_type_filter` varchar(50) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `service_by` varchar(50) NOT NULL,
  `sales_by` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
`id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `notify_emp_id` int(11) NOT NULL,
  `sender_emp_id` int(11) NOT NULL,
  `target_id` varchar(15) NOT NULL,
  `level` smallint(6) NOT NULL DEFAULT '1',
  `status` enum('Pending','Approved','Declined','Assigned','In_Process','Completed','In_Question','On_hold','Disbursed') NOT NULL,
  `read` tinyint(1) NOT NULL,
  `notify_datetime` datetime NOT NULL,
  `modified_datetime` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=24693 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `other_expenses`
--

CREATE TABLE IF NOT EXISTS `other_expenses` (
`id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `bill_number` varchar(25) NOT NULL,
  `date` date NOT NULL,
  `description` text NOT NULL,
  `amount` float(10,2) NOT NULL,
  `has_bill` tinyint(1) NOT NULL,
  `status` enum('Pending','Approved','Declined','Disbursed','In_Question') NOT NULL DEFAULT 'Pending',
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `bill_file_name` varchar(50) NOT NULL,
  `decline_reason` text NOT NULL,
  `in_question_reason` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1261 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `passenger_details`
--

CREATE TABLE IF NOT EXISTS `passenger_details` (
`id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `age` varchar(40) NOT NULL,
  `gender` varchar(30) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `contact_no` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=125 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payable_invoices`
--

CREATE TABLE IF NOT EXISTS `payable_invoices` (
`id` int(11) NOT NULL,
  `vendor_code` varchar(20) NOT NULL,
  `invoice_date` date NOT NULL,
  `invoice_no` varchar(50) NOT NULL,
  `amount` int(11) NOT NULL,
  `tax_amt` int(11) NOT NULL,
  `status` enum('Pending','Approved','Declined','Disbursed') NOT NULL,
  `invoice_file` text NOT NULL,
  `action_date` date NOT NULL,
  `decline_reason` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
`id` int(11) NOT NULL,
  `p_name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `rate` varchar(150) NOT NULL,
  `currency` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
`id` int(11) NOT NULL,
  `code` varchar(30) NOT NULL,
  `name` varchar(100) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `sub_dept_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `customer_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `flag` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `project_assignments`
--

CREATE TABLE IF NOT EXISTS `project_assignments` (
`id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `assigned_by` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `work_as` varchar(20) NOT NULL,
  `role` varchar(20) NOT NULL,
  `responsible` varchar(5) NOT NULL,
  `comment` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=212 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `quotes`
--

CREATE TABLE IF NOT EXISTS `quotes` (
`id` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `quote_type` varchar(20) NOT NULL,
  `service_type` varchar(20) NOT NULL,
  `conversion_rate` varchar(20) NOT NULL,
  `sale_type` varchar(20) NOT NULL,
  `product_type` varchar(20) NOT NULL,
  `payment_terms` varchar(30) NOT NULL,
  `delivery_method` varchar(20) NOT NULL,
  `submit_by` varchar(100) NOT NULL,
  `discount_on` varchar(30) NOT NULL,
  `discount_type` varchar(30) NOT NULL,
  `disc_rate` varchar(11) NOT NULL,
  `flat` varchar(11) NOT NULL,
  `refer` varchar(11) NOT NULL,
  `refer_attachment` text NOT NULL,
  `validity` varchar(20) NOT NULL,
  `created_date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `quote_items`
--

CREATE TABLE IF NOT EXISTS `quote_items` (
`id` int(11) NOT NULL,
  `quote_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `qty` smallint(6) DEFAULT NULL,
  `rate` varchar(20) DEFAULT NULL,
  `pct_tax` varchar(11) NOT NULL,
  `amount` varchar(20) NOT NULL,
  `discount` varchar(30) NOT NULL,
  `flat_discount` varchar(20) NOT NULL,
  `disc_rate_item` varchar(20) NOT NULL,
  `discount_amt` varchar(20) NOT NULL,
  `days` varchar(11) NOT NULL,
  `work_as` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `room_booking_request`
--

CREATE TABLE IF NOT EXISTS `room_booking_request` (
`id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `request_date` date NOT NULL,
  `client` int(11) NOT NULL,
  `engagement_type` varchar(50) NOT NULL,
  `account_manager` varchar(100) NOT NULL,
  `exp_reimbursable` varchar(10) NOT NULL,
  `booking_reason` text NOT NULL,
  `location` varchar(50) NOT NULL,
  `check_in_date` date NOT NULL,
  `check_out_date` date NOT NULL,
  `rooms` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `approver` int(11) NOT NULL,
  `decline_reason` varchar(255) NOT NULL,
  `action_date` date NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `code` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `send_mail`
--

CREATE TABLE IF NOT EXISTS `send_mail` (
`id` int(11) NOT NULL,
  `subject` text NOT NULL,
  `to_email` varchar(255) NOT NULL,
  `cc_email` varchar(255) NOT NULL,
  `bcc_email` varchar(255) NOT NULL,
  `from_email` varchar(55) NOT NULL,
  `message` text NOT NULL,
  `is_multi_attachment` tinyint(1) NOT NULL,
  `attachment` text NOT NULL,
  `no_of_try` tinyint(4) NOT NULL,
  `status` enum('Not Send','Send') NOT NULL,
  `created_datetime` datetime NOT NULL,
  `modified_datetime` datetime NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=36050 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `service_agreements`
--

CREATE TABLE IF NOT EXISTS `service_agreements` (
`id` int(11) NOT NULL,
  `exe_date` date NOT NULL,
  `client` varchar(255) NOT NULL,
  `client_location` varchar(100) NOT NULL,
  `payment_terms` varchar(30) NOT NULL,
  `res_qty` varchar(20) NOT NULL,
  `band` varchar(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `service_requests`
--

CREATE TABLE IF NOT EXISTS `service_requests` (
`id` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `request_type` varchar(25) NOT NULL,
  `request_for` varchar(30) NOT NULL,
  `others` varchar(20) NOT NULL,
  `id_card_type` enum('New','Reprint') NOT NULL,
  `status` varchar(11) NOT NULL,
  `description` text NOT NULL,
  `no_of_cards` varchar(11) NOT NULL,
  `action_by` int(11) NOT NULL,
  `decline_reason` varchar(50) NOT NULL,
  `action_date` date NOT NULL,
  `request_time` datetime NOT NULL,
  `modified_time` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `short_leaves`
--

CREATE TABLE IF NOT EXISTS `short_leaves` (
`id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `reporting_person_id` int(11) NOT NULL,
  `date` varchar(12) NOT NULL,
  `timing` varchar(12) NOT NULL,
  `reason` text NOT NULL,
  `status` enum('Pending','Approved','Declined') NOT NULL,
  `action_date` varchar(12) NOT NULL,
  `decline_reason` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `state_list`
--

CREATE TABLE IF NOT EXISTS `state_list` (
`id` int(11) NOT NULL,
  `state_name` varchar(30) NOT NULL,
  `country_id` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sub_departments`
--

CREATE TABLE IF NOT EXISTS `sub_departments` (
`id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `sub_dept` varchar(50) NOT NULL,
  `short_form` varchar(10) NOT NULL,
  `dept_lead` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `thought_of_the_day`
--

CREATE TABLE IF NOT EXISTS `thought_of_the_day` (
`id` int(11) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `status` enum('Not Sent','Sent') NOT NULL,
  `sent_date` datetime NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=65 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `timesheets`
--

CREATE TABLE IF NOT EXISTS `timesheets` (
`id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `timesheet_for` enum('working','holiday','on_leave') NOT NULL DEFAULT 'working',
  `hours` int(11) NOT NULL,
  `minutes` int(11) NOT NULL,
  `tasks` text NOT NULL,
  `dashboard` text NOT NULL,
  `phase` varchar(55) NOT NULL,
  `others_phase` varchar(100) NOT NULL,
  `action_type` varchar(55) NOT NULL,
  `challenge_type` varchar(100) NOT NULL,
  `others_challenge_type` varchar(100) NOT NULL,
  `time_wait` varchar(25) NOT NULL,
  `task_status` varchar(25) NOT NULL,
  `assigned_to` varchar(100) NOT NULL,
  `action_on` varchar(25) NOT NULL,
  `others_action_on` varchar(100) NOT NULL,
  `challenges_sol` text NOT NULL,
  `customer_feedback` varchar(100) NOT NULL,
  `others_customer_feedback` varchar(100) NOT NULL,
  `remarks` text NOT NULL,
  `challanges` text NOT NULL,
  `next_action` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `can_edit` enum('Yes','No') NOT NULL,
  `status` enum('Pending','Approved','Declined','In_Question') NOT NULL,
  `decline_reason` text NOT NULL,
  `in_question_reason` text NOT NULL,
  `edit_request_decline_reason` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=35538 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `travel_expenses`
--

CREATE TABLE IF NOT EXISTS `travel_expenses` (
`id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `bill_number` varchar(25) NOT NULL,
  `project_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `travel_mode` enum('Two Wheeler','Four Wheeler','Taxi','Train','Bus','Air','Auto','Others','Per Diem') NOT NULL DEFAULT 'Train',
  `travel_type` enum('out_of_station','local','per_diem') NOT NULL,
  `misc` varchar(200) NOT NULL,
  `kms` int(11) NOT NULL,
  `parking` int(10) DEFAULT NULL,
  `toll` int(10) DEFAULT NULL,
  `amount` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `description` text NOT NULL,
  `has_bill` tinyint(1) NOT NULL,
  `status` enum('Pending','Approved','Declined','Disbursed','In_Question') NOT NULL DEFAULT 'Pending',
  `archived` tinyint(1) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `bill_file_name` varchar(50) NOT NULL,
  `decline_reason` text NOT NULL,
  `in_question_reason` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7974 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `first_name` varchar(150) NOT NULL,
  `middle_name` varchar(30) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `type` varchar(11) NOT NULL,
  `employee_id` varchar(11) DEFAULT NULL,
  `reset_token` varchar(50) NOT NULL,
  `reset_request_time` datetime NOT NULL,
  `last_login` datetime NOT NULL,
  `check_status` varchar(255) NOT NULL DEFAULT 'out'
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE IF NOT EXISTS `vendors` (
`id` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `encrypt_code` varchar(50) NOT NULL,
  `name` varchar(250) NOT NULL,
  `contact_person` varchar(250) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(150) NOT NULL,
  `address1` varchar(200) NOT NULL,
  `address2` varchar(200) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `post_code` varchar(10) NOT NULL,
  `country` varchar(50) NOT NULL,
  `vat_no` varchar(40) NOT NULL,
  `service_tax_no` varchar(40) NOT NULL,
  `pan` varchar(40) NOT NULL,
  `cheque_no` varchar(40) NOT NULL,
  `tin_no` varchar(40) NOT NULL,
  `bank_name` varchar(100) NOT NULL,
  `bank_account_number` varchar(20) NOT NULL,
  `bank_account_name` varchar(150) NOT NULL,
  `bank_ifsc` varchar(20) NOT NULL,
  `bank_address` text NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `type` varchar(30) NOT NULL,
  `cancel_cheque` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `available_leaves`
--
ALTER TABLE `available_leaves`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `available_leaves_bkp`
--
ALTER TABLE `available_leaves_bkp`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_requests`
--
ALTER TABLE `booking_requests`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `careers`
--
ALTER TABLE `careers`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `checks`
--
ALTER TABLE `checks`
 ADD PRIMARY KEY (`check_id`);

--
-- Indexes for table `comp_offs`
--
ALTER TABLE `comp_offs`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `configuration`
--
ALTER TABLE `configuration`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crg_subscribe`
--
ALTER TABLE `crg_subscribe`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cr_login`
--
ALTER TABLE `cr_login`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deleted_timesheets`
--
ALTER TABLE `deleted_timesheets`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designation_band`
--
ALTER TABLE `designation_band`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `download_leads`
--
ALTER TABLE `download_leads`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `download_leads_track`
--
ALTER TABLE `download_leads_track`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `drop_downs`
--
ALTER TABLE `drop_downs`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drop_down_list`
--
ALTER TABLE `drop_down_list`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
 ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `employment_request_form`
--
ALTER TABLE `employment_request_form`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `festivals`
--
ALTER TABLE `festivals`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `festivals_2016`
--
ALTER TABLE `festivals_2016`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guest_details`
--
ALTER TABLE `guest_details`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hr_notifications`
--
ALTER TABLE `hr_notifications`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `indian_cities`
--
ALTER TABLE `indian_cities`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leaves`
--
ALTER TABLE `leaves`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leaves_bkp`
--
ALTER TABLE `leaves_bkp`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_settings`
--
ALTER TABLE `leave_settings`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_transactions`
--
ALTER TABLE `leave_transactions`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_types`
--
ALTER TABLE `leave_types`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mydashboard_config`
--
ALTER TABLE `mydashboard_config`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `other_expenses`
--
ALTER TABLE `other_expenses`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `passenger_details`
--
ALTER TABLE `passenger_details`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payable_invoices`
--
ALTER TABLE `payable_invoices`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_assignments`
--
ALTER TABLE `project_assignments`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotes`
--
ALTER TABLE `quotes`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quote_items`
--
ALTER TABLE `quote_items`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_booking_request`
--
ALTER TABLE `room_booking_request`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `send_mail`
--
ALTER TABLE `send_mail`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_agreements`
--
ALTER TABLE `service_agreements`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_requests`
--
ALTER TABLE `service_requests`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `short_leaves`
--
ALTER TABLE `short_leaves`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `state_list`
--
ALTER TABLE `state_list`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_departments`
--
ALTER TABLE `sub_departments`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `thought_of_the_day`
--
ALTER TABLE `thought_of_the_day`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timesheets`
--
ALTER TABLE `timesheets`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `travel_expenses`
--
ALTER TABLE `travel_expenses`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `available_leaves`
--
ALTER TABLE `available_leaves`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=82;
--
-- AUTO_INCREMENT for table `available_leaves_bkp`
--
ALTER TABLE `available_leaves_bkp`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=79;
--
-- AUTO_INCREMENT for table `booking_requests`
--
ALTER TABLE `booking_requests`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=119;
--
-- AUTO_INCREMENT for table `careers`
--
ALTER TABLE `careers`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `checks`
--
ALTER TABLE `checks`
MODIFY `check_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=77;
--
-- AUTO_INCREMENT for table `comp_offs`
--
ALTER TABLE `comp_offs`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=159;
--
-- AUTO_INCREMENT for table `configuration`
--
ALTER TABLE `configuration`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `crg_subscribe`
--
ALTER TABLE `crg_subscribe`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `cr_login`
--
ALTER TABLE `cr_login`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=79;
--
-- AUTO_INCREMENT for table `deleted_timesheets`
--
ALTER TABLE `deleted_timesheets`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35507;
--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `designation_band`
--
ALTER TABLE `designation_band`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `download_leads`
--
ALTER TABLE `download_leads`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `download_leads_track`
--
ALTER TABLE `download_leads_track`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `drop_downs`
--
ALTER TABLE `drop_downs`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `drop_down_list`
--
ALTER TABLE `drop_down_list`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=87;
--
-- AUTO_INCREMENT for table `employment_request_form`
--
ALTER TABLE `employment_request_form`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=65;
--
-- AUTO_INCREMENT for table `festivals`
--
ALTER TABLE `festivals`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `festivals_2016`
--
ALTER TABLE `festivals_2016`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `guest_details`
--
ALTER TABLE `guest_details`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hr_notifications`
--
ALTER TABLE `hr_notifications`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `indian_cities`
--
ALTER TABLE `indian_cities`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5742;
--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=390;
--
-- AUTO_INCREMENT for table `leaves_bkp`
--
ALTER TABLE `leaves_bkp`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=352;
--
-- AUTO_INCREMENT for table `leave_settings`
--
ALTER TABLE `leave_settings`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `leave_transactions`
--
ALTER TABLE `leave_transactions`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=315;
--
-- AUTO_INCREMENT for table `leave_types`
--
ALTER TABLE `leave_types`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `mydashboard_config`
--
ALTER TABLE `mydashboard_config`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24693;
--
-- AUTO_INCREMENT for table `other_expenses`
--
ALTER TABLE `other_expenses`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1261;
--
-- AUTO_INCREMENT for table `passenger_details`
--
ALTER TABLE `passenger_details`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=125;
--
-- AUTO_INCREMENT for table `payable_invoices`
--
ALTER TABLE `payable_invoices`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=108;
--
-- AUTO_INCREMENT for table `project_assignments`
--
ALTER TABLE `project_assignments`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=212;
--
-- AUTO_INCREMENT for table `quotes`
--
ALTER TABLE `quotes`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `quote_items`
--
ALTER TABLE `quote_items`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `room_booking_request`
--
ALTER TABLE `room_booking_request`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `send_mail`
--
ALTER TABLE `send_mail`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36050;
--
-- AUTO_INCREMENT for table `service_agreements`
--
ALTER TABLE `service_agreements`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `service_requests`
--
ALTER TABLE `service_requests`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `short_leaves`
--
ALTER TABLE `short_leaves`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `state_list`
--
ALTER TABLE `state_list`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `sub_departments`
--
ALTER TABLE `sub_departments`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `thought_of_the_day`
--
ALTER TABLE `thought_of_the_day`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=65;
--
-- AUTO_INCREMENT for table `timesheets`
--
ALTER TABLE `timesheets`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35538;
--
-- AUTO_INCREMENT for table `travel_expenses`
--
ALTER TABLE `travel_expenses`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7974;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=92;
--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



ALTER TABLE `customers` ADD `latitude` VARCHAR(255) NOT NULL , ADD `longitude` VARCHAR(255) NOT NULL ;
ALTER TABLE `users` CHANGE `check_status` `check_status` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'out';

CREATE TABLE IF NOT EXISTS `checks` (
  `check_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `client_id` int(10) NOT NULL,
  `check_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `check_status` varchar(255) NOT NULL,
  `latitude` varchar(50) NOT NULL,
  `longitude` varchar(50) NOT NULL,
  PRIMARY KEY (`check_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=77 ;

--
-- Dumping data for table `checks`
--

INSERT INTO `checks` (`check_id`, `email`, `client_id`, `check_date`, `check_status`, `latitude`, `longitude`) VALUES
(68, 'vasnanipriyanka@gmail.com', 2, '2017-05-15 13:46:20', 'in', '', ''),
(69, 'vasnanipriyanka@gmail.com', 3, '2017-05-15 14:15:39', 'out', '23.0118522', '72.5226549'),
(70, 'vasnanipriyanka@gmail.com', 3, '2017-05-15 14:15:39', 'out', '23.0118522', '72.5226549'),
(71, 'vasnanipriyanka@gmail.com', 2, '2017-05-15 14:20:54', 'in', '', ''),
(72, 'vasnanipriyanka@gmail.com', 2, '2017-05-15 14:21:07', 'out', '23.0118522', '72.5226549'),
(73, 'vasnanipriyanka@gmail.com', 2, '2017-05-15 15:12:45', 'in', '', ''),
(74, 'vasnanipriyanka@gmail.com', 2, '2017-05-15 15:12:53', 'out', '23.0118522', '72.5226549'),
(67, 'samarth.modh@gmail.com', 4, '2017-05-15 12:15:18', 'out', '23.0117727', '72.5227473'),
(75, 'vasnanipriyanka@gmail.com', 2, '2017-05-15 15:13:13', 'in', '', ''),
(76, 'vasnanipriyanka@gmail.com', 2, '2017-05-15 15:20:54', 'out', '23.0118522', '72.5226549');


CREATE TABLE IF NOT EXISTS `cr_login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `cr_login`
--

INSERT INTO `cr_login` (`id`, `username`, `password`) VALUES
(1, 'pranay@cypherincorporated.org.in', 'pranay');

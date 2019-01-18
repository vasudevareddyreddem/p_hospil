ALTER TABLE `hospital`.`coupon_codes`   
  ADD COLUMN `hospital_id` INT(11) NULL AFTER `id`;
  
  /* ward managemtn */
  
CREATE TABLE `ward_name` (
  `w_id` int(11) NOT NULL AUTO_INCREMENT,
  `hos_id` int(11) DEFAULT NULL,
  `ward_name` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `create_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`w_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1

  
CREATE TABLE `ward_type` (
  `ward_id` int(11) NOT NULL AUTO_INCREMENT,
  `hos_id` int(11) DEFAULT NULL,
  `ward_type` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `create_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`ward_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1

CREATE TABLE `ward_floors` (
  `w_f_id` INT(11) NOT NULL AUTO_INCREMENT,
  `hos_id` INT(11) DEFAULT NULL,
  `ward_floor` VARCHAR(250) DEFAULT NULL,
  `status` INT(11) DEFAULT '1',
  `create_at` DATETIME DEFAULT NULL,
  `created_by` INT(11) DEFAULT NULL,
  PRIMARY KEY (`w_f_id`)
) ENGINE=INNODB DEFAULT CHARSET=latin1



CREATE TABLE `ward_room_type` (
  `w_r_t_id` INT(11) NOT NULL AUTO_INCREMENT,
  `hos_id` INT(11) DEFAULT NULL,
  `room_type` VARCHAR(250) DEFAULT NULL,
  `status` INT(11) DEFAULT '1',
  `create_at` DATETIME DEFAULT NULL,
  `created_by` INT(11) DEFAULT NULL,
  PRIMARY KEY (`w_r_t_id`)
) ENGINE=INNODB DEFAULT CHARSET=latin1

CREATE TABLE `ward_room_number` (
  `w_r_n_id` INT(11) NOT NULL AUTO_INCREMENT,
  `hos_id` INT(11) DEFAULT NULL,
  `room_num` VARCHAR(250) DEFAULT NULL,
  `status` INT(11) DEFAULT '1',
  `create_at` DATETIME DEFAULT NULL,
  `created_by` INT(11) DEFAULT NULL,
  PRIMARY KEY (`w_r_n_id`)
) ENGINE=INNODB DEFAULT CHARSET=latin1



CREATE TABLE `ward_room_beds` (
  `r_b_id` int(11) NOT NULL AUTO_INCREMENT,
  `hos_id` int(11) DEFAULT NULL,
  `w_r_n_id` int(11) DEFAULT NULL,
  `bed` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `create_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`r_b_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1


/* patient check ip or op purose

  ALTER TABLE `ehealthinfra_db`.`patient_billing`   
  ADD COLUMN `patient_type` INT(11) NULL  COMMENT '1=ip;0=op' AFTER `p_id`;
  
  ALTER TABLE `hospital`.`patient_billing`   
  CHANGE `patient_type` `patient_type` INT(11) DEFAULT 1  NULL  COMMENT '1=ip;0=op';
 

  ALTER TABLE `hospital`.`ward_room_number`   
  ADD COLUMN `bed_count` VARCHAR(250) NULL AFTER `room_num`;
  
  ALTER TABLE `hospital`.`ward_room_number`   
  ADD COLUMN `f_id` INT(11) NULL AFTER `hos_id`;
  
  ALTER TABLE `hospital`.`ward_floors`   
  ADD COLUMN `updated_at` DATETIME NULL AFTER `create_at`;
  
  ALTER TABLE `hospital`.`ward_name`   
  ADD COLUMN `updated_at` DATETIME NULL AFTER `create_at`;
  
  ALTER TABLE `hospital`.`ward_room_beds`   
  ADD COLUMN `updated_at` DATETIME NULL AFTER `create_at`;
  
  ALTER TABLE `hospital`.`ward_room_number`   
  ADD COLUMN `updated_at` DATETIME NULL AFTER `create_at`;

  ALTER TABLE `hospital`.`ward_room_type`   
  ADD COLUMN `updated_at` DATETIME NULL AFTER `create_at`;
  
  ALTER TABLE `hospital`.`ward_type`   
  ADD COLUMN `updated_at` DATETIME NULL AFTER `create_at`;

ALTER TABLE `hospital`.`patient_billing`   
  ADD COLUMN `patient_type` VARCHAR(250) NULL AFTER `bill`;
  
  CREATE TABLE `hospital`.`admitted_patient_list`(  
  `a_p_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pt_id` INT(11),
  `bill_id` INT(11),
  `p_name` VARCHAR(250),
  `w_name` VARCHAR(250),
  `w-type` VARCHAR(250),
  `room_type` VARCHAR(250),
  `floor_no` VARCHAR(250),
  `room_no` VARCHAR(250),
  `bed_no` VARCHAR(250),
  PRIMARY KEY (`a_p_id`)
);

  
  
  ALTER TABLE `hospital`.`patient_billing`   
  CHANGE `patient_type` `patient_type` INT(11) DEFAULT 1  NULL;
  
  ALTER TABLE `hospital`.`admitted_patient_list`   
  ADD COLUMN `hos_id` INT(11) NULL AFTER `a_p_id`;

  ALTER TABLE `hospital`.`admitted_patient_list`   
  DROP COLUMN `p_name`;
  
  ALTER TABLE `hospital`.`admitted_patient_list`   
  CHANGE `w-type` `w_type` VARCHAR(250) CHARSET latin1 COLLATE latin1_swedish_ci NULL;

  ALTER TABLE `hospital`.`admitted_patient_list`   
  ADD COLUMN `status` INT(11) DEFAULT 1  NULL AFTER `bed_no`,
  ADD COLUMN `date_of_admit` DATETIME NULL AFTER `status`;

  ALTER TABLE `hospital`.`admitted_patient_list`   
  ADD COLUMN `updated_at` DATETIME NULL AFTER `date_of_admit`;
  
  
  /* added by vasu*/
  for card  numbers
  
CREATE TABLE `card_numbers` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `card_number` varchar(250) DEFAULT NULL,
  `count` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `print_status` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `pdf_name` varchar(250) DEFAULT NULL,
  `assign_seller` int(11) DEFAULT '0',
  `updated_at` datetime DEFAULT NULL,
  `cust_name` varchar(250) DEFAULT NULL,
  `mobile` varchar(45) DEFAULT NULL,
  `whatsapp_number` varchar(45) DEFAULT NULL,
  `aadhar_number` varchar(250) DEFAULT NULL,
  `email_id` varchar(250) DEFAULT NULL,
  `gender` varchar(45) DEFAULT NULL,
  `assign_customer` int(11) DEFAULT '0' COMMENT '0=unassign;1=assign',
  `customer_assign_time` datetime DEFAULT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB AUTO_INCREMENT=250 DEFAULT CHARSET=latin1

CREATE TABLE `card_sellers` (
  `s_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) DEFAULT NULL,
  `mobile` varchar(250) DEFAULT NULL,
  `email_id` varchar(250) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `org_password` varchar(250) DEFAULT NULL,
  `address` text,
  `bank_account` varchar(250) DEFAULT NULL,
  `bank_name` varchar(250) DEFAULT NULL,
  `ifsccode` varchar(250) DEFAULT NULL,
  `bank_holder_name` varchar(250) DEFAULT NULL,
  `kyc` varchar(250) DEFAULT NULL,
  `profile_pic` varchar(250) DEFAULT NULL,
  `token` text,
  `status` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`s_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1



CREATE TABLE `coupon_codes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hospital_id` int(11) DEFAULT NULL,
  `coupon_code` varchar(250) DEFAULT NULL,
  `type` varchar(250) DEFAULT NULL,
  `percentage_amount` varchar(250) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `updated_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1

  
  
CREATE TABLE `appointment_bidding_list` (
  `b_id` int(11) NOT NULL AUTO_INCREMENT,
  `hos_id` int(11) DEFAULT NULL,
  `city` varchar(250) DEFAULT NULL,
  `patinet_name` varchar(250) DEFAULT NULL,
  `age` varchar(45) DEFAULT NULL,
  `mobile` varchar(45) DEFAULT NULL,
  `department` varchar(250) DEFAULT NULL,
  `specialist` varchar(250) DEFAULT NULL,
  `date` varchar(250) DEFAULT NULL,
  `time` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT '0' COMMENT '0=pending;1=accept;2=reject',
  `create_at` datetime DEFAULT NULL,
  `coming_through` int(11) DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`b_id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=latin1


CREATE TABLE `appointment_users` (
  `a_u_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `mobile` varchar(45) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `org_password` varchar(250) DEFAULT NULL,
  `profile_pic` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `create_at` datetime DEFAULT NULL,
  `token` text,
  PRIMARY KEY (`a_u_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1



CREATE TABLE `appointments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hos_id` int(11) DEFAULT NULL,
  `city` varchar(250) DEFAULT NULL,
  `patinet_name` varchar(250) DEFAULT NULL,
  `age` varchar(250) DEFAULT NULL,
  `mobile` varchar(45) DEFAULT NULL,
  `department` varchar(250) DEFAULT NULL,
  `specialist` varchar(45) DEFAULT NULL,
  `doctor_id` varchar(45) DEFAULT NULL,
  `date` varchar(250) DEFAULT NULL,
  `time` varchar(250) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '1= confirm, 0=pending,2 reject',
  `create_at` datetime DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  `coming_through` int(11) DEFAULT NULL,
  `patient_id` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1

ALTER TABLE `hospital`.`admitted_patient_list`   
  ADD COLUMN `created_by` INT(11) NULL AFTER `updated_at`;

  ALTER TABLE `hospital`.`ward_type`   
  ADD COLUMN `wid` INT(11) NULL AFTER `hos_id`;
  
 ALTER TABLE `hospital`.`ward_room_type`   
  ADD COLUMN `w_type_id` INT(11) NULL AFTER `hos_id`;
  
  
  ALTER TABLE `hospital`.`ward_floors`   
  ADD COLUMN `w_r_type_id` INT(11) NULL AFTER `hos_id`;

  
  
  
  
  
  
 ALTER TABLE `hospital`.`admitted_patient_list`   
  ADD COLUMN `d_id` INT(11) NULL AFTER `bill_id`;
 
  
  ALTER TABLE `hospital`.`admitted_patient_list`   
  ADD COLUMN `discharge_date` DATETIME NULL AFTER `updated_at`,
  ADD COLUMN `completed` INT(0) NULL AFTER `discharge_date`;

  ALTER TABLE `hospital`.`patient_medicine_list`   
  ADD COLUMN `food` VARCHAR(250) NULL AFTER `frequency`;

  
 ALTER TABLE `hospital`.`medicine_list`   
  ADD COLUMN `batchno` VARCHAR(250) NULL AFTER `othercode`;
  
  ALTER TABLE `hospital`.`patient_medicine_list`   
  ADD COLUMN `medicine_type` VARCHAR(250) NULL AFTER `medicine_name`;
  
ALTER TABLE `hospital`.`patient_medicine_list`   
  ADD COLUMN `batchno` VARCHAR(250) NULL AFTER `medicine_type`,
  ADD COLUMN `expiry_date` VARCHAR(250) NULL AFTER `org_amount`;

   ALTER TABLE `hospital`.`patient_medicine_list`   
  ADD COLUMN `no_of_days` VARCHAR(250) NULL AFTER `food`;
  
  
/* executive_list */

CREATE TABLE `executive_list` (
  `e_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) DEFAULT NULL,
  `mobile` varchar(250) DEFAULT NULL,
  `email_id` varchar(250) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `org_password` varchar(250) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `bank_account` varchar(250) DEFAULT NULL,
  `bank_name` varchar(250) DEFAULT NULL,
  `ifsccode` varchar(250) DEFAULT NULL,
  `bank_holder_name` varchar(250) DEFAULT NULL,
  `kyc` varchar(250) DEFAULT NULL,
  `profile_pic` varchar(250) DEFAULT NULL,
  `location` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT '1' COMMENT 'status=1;delete=2;',
  `create_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`e_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1



ALTER TABLE `hospital`.`appointment_bidding_list`   
  ADD COLUMN `event_status` INT(11) DEFAULT 0  NULL AFTER `status`;

  
  /* appointment user changes purpose*/
  ALTER TABLE `ehealthinfra_db`.`appointment_users`   
  ADD COLUMN `updated_at` DATETIME NULL AFTER `create_at`;

  
  /* aapoinment fee purpose*/
  ALTER TABLE `ehealthinfra_dbinfra_db`.`hospital`   
  ADD COLUMN `appointment_fee` VARCHAR(250) NULL AFTER `barcode`;

  
  
  
  
  ALTER TABLE `hospital`.`resource_list`   
  ADD COLUMN `in_time` VARCHAR(250) NULL AFTER `out_source_lab`,
  ADD COLUMN `out_time` VARCHAR(250) NULL AFTER `in_time`;


  /* lab_test_list */
  ALTER TABLE `hospital`.`lab_test_list`   
  CHANGE `test_type` `test_type` VARCHAR(250) NULL;


/* appointment  changes */
ALTER TABLE `hospital`.`appointment_bidding_list`   
  ADD COLUMN `doctor_id` VARCHAR(250) NULL AFTER `specialist`;
  
  24/10/2018
  
  ALTER TABLE `ehealthinfra_db`.`appointment_bidding_list`   
  CHANGE `event_status` `event_status` INT(11) DEFAULT 0  NULL;
  
  25-10-2018
  ALTER TABLE `ehealthinfra_db`.`seller_card_assign_munber_list`   
  ADD COLUMN `a_u_id` INT(11) NULL AFTER `created_by`;
  
  ALTER TABLE `hospital`.`seller_card_assign_munber_list`   
  ADD COLUMN `razorpay_payment_id` VARCHAR(250) NULL AFTER `a_u_id`,
  ADD COLUMN `razorpay_order_id` VARCHAR(250) NULL AFTER `razorpay_payment_id`,
  ADD COLUMN `razorpay_signature` VARCHAR(250) NULL AFTER `razorpay_order_id`,
  ADD COLUMN `payment_statu` VARCHAR(250) NULL AFTER `razorpay_signature`;

ALTER TABLE `hospital`.`seller_card_assign_munber_list`   
  ADD COLUMN `amount` VARCHAR(250) NULL AFTER `payment_statu`,
  ADD COLUMN `payment_date` DATETIME NULL AFTER `amount`;



  
CREATE TABLE `appointment_user_prescription` (
  `a_p_id` int(11) NOT NULL AUTO_INCREMENT,
  `a_u_id` int(11) DEFAULT NULL,
  `prescription` varchar(250) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  PRIMARY KEY (`a_p_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1

/* 28-11-2018  */

ALTER TABLE `staging_ehealthinfra_db`.`resource_list`   
  ADD COLUMN `consultation_fee` VARCHAR(250) NULL AFTER `resource_name`;

  
  /* unwanted data removing */
  ALTER TABLE `hospital`.`patients_list_1`   
  DROP COLUMN `religion`, 
  DROP COLUMN `caste`, 
  DROP COLUMN `language`, 
  DROP COLUMN `citizen_proof`;
  
  
  
  ALTER TABLE `hospital`.`appointment_users`   
  ADD COLUMN `ip_wallet_amount` VARCHAR(250) NULL AFTER `token`,
  ADD COLUMN `op_wallet_amount` VARCHAR(250) NULL AFTER `ip_wallet_amount`,
  ADD COLUMN `lab_wallet_amount` VARCHAR(250) NULL AFTER `op_wallet_amount`;

  
  ALTER TABLE `hospital`.`appointment_users`   
  ADD COLUMN `wallet_amount_id` VARCHAR(250) NULL AFTER `lab_wallet_amount`;

  
  ALTER TABLE `hospital`.`appointment_users`   
  ADD COLUMN `remaining_ip_wallet` VARCHAR(250) NULL AFTER `wallet_amount_id`,
  ADD COLUMN `remaining_op_wallet_amount` VARCHAR(250) NULL AFTER `remaining_ip_wallet`,
  ADD COLUMN `remaining_lab_wallet` VARCHAR(250) NULL AFTER `remaining_op_wallet_amount`;

  
  ALTER TABLE `hospital`.`wallet_amount`   
  ADD COLUMN `ip_amount_percentage` VARCHAR(250) NULL AFTER `lab_amount`,
  ADD COLUMN `op_amount_percentage` VARCHAR(250) NULL AFTER `ip_amount_percentage`,
  ADD COLUMN `lab_amount_percentage` VARCHAR(250) NULL AFTER `op_amount_percentage`;

  
  ALTER TABLE `hospital`.`appointments`   
  ADD COLUMN `b_id` INT(11) NULL AFTER `remainder_sent`;
  
  
  ALTER TABLE `hospital`.`coupon_code_list`   
  CHANGE `ip_percentage` `ip_amount_percentage` VARCHAR(250) CHARSET latin1 COLLATE latin1_swedish_ci NULL,
  CHANGE `op_percentage` `op_amount_percentage` VARCHAR(250) CHARSET latin1 COLLATE latin1_swedish_ci NULL,
  CHANGE `lab_percentage` `lab_amount_percentage` VARCHAR(250) CHARSET latin1 COLLATE latin1_swedish_ci NULL;



  
  ALTER TABLE `hospital`.`coupon_code_history`   
  ADD COLUMN `appointment_user_id` INT(11) NULL AFTER `created_by`;

  
  
CREATE TABLE `billing_history` (
  `b_h_id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) DEFAULT NULL,
  `billing_id` int(11) DEFAULT NULL,
  `card_number` varchar(45) DEFAULT NULL,
  `p_name` varchar(250) DEFAULT NULL,
  `p_mobile` varchar(45) DEFAULT NULL,
  `p_amount` varchar(250) DEFAULT NULL,
  `coupon_code` varchar(250) DEFAULT NULL,
  `pay_amount` varchar(250) DEFAULT NULL,
  `category_type` int(11) DEFAULT NULL,
  `payment_type` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`b_h_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1


ALTER TABLE `hospital`.`coupon_code_history`   
  ADD COLUMN `type_id` INT(11) NULL AFTER `appointment_user_id`;

  
  ALTER TABLE `hospital`.`billing_history`   
  ADD COLUMN `hos_id` INT(11) NULL AFTER `b_h_id`;


  ALTER TABLE `staging_ehealthinfra_db`.`patient_vitals_list`   
  ADD COLUMN `created_by` INT(11) NULL AFTER `date`;

  
  ALTER TABLE `staging_ehealthinfra_db`.`coupon_code_history`   
  ADD COLUMN `amount` VARCHAR(250) NULL AFTER `type`;

  
  /* wallet amount single  filed */
  ALTER TABLE `hospital`.`wallet_amount`   
  DROP COLUMN `op_amount`, 
  DROP COLUMN `lab_amount`, 
  DROP COLUMN `ip_amount_percentage`, 
  DROP COLUMN `op_amount_percentage`, 
  DROP COLUMN `lab_amount_percentage`, 
  CHANGE `ip_amount` `wallet_amount` VARCHAR(250) CHARSET latin1 COLLATE latin1_swedish_ci NULL;

  
  
  
  ALTER TABLE `hospital`.`appointment_users`   
  DROP COLUMN `op_wallet_amount`, 
  DROP COLUMN `lab_wallet_amount`, 
  DROP COLUMN `remaining_op_wallet_amount`, 
  DROP COLUMN `remaining_lab_wallet`, 
  CHANGE `ip_wallet_amount` `wallet_amount` VARCHAR(250) CHARSET latin1 COLLATE latin1_swedish_ci NULL,
  CHANGE `remaining_ip_wallet` `remaining_wallet_amount` VARCHAR(250) CHARSET latin1 COLLATE latin1_swedish_ci NULL;
  
  
   op module  sql c hanges 
   
   
   ALTER TABLE `hospital`.`manual_prescription_list`   
  ADD COLUMN `batchno` VARCHAR(250) NULL AFTER `p_id`;


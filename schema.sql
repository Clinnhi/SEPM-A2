drop database if exists SEPM;
create database SEPM;
use SEPM;

CREATE TABLE `Employee` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(8) NOT NULL,
  `phone_number` varchar(14) NOT NULL,
  `dob` date NOT NULL,
  `name` varchar(70) NOT NULL,
  `preferred_name` varchar(70) NOT NULL,
  `address` varchar(100) NOT NULL,
  `is_manager` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `Employee`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `Employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;
COMMIT;

CREATE TABLE `Shifts` (
  `shift_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `location` varchar(100) NOT NULL,
  `duration` int(2) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `accepted` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `Shifts`
  ADD PRIMARY KEY (`shift_id`),
  ADD KEY `employee_id` (`employee_id`);

ALTER TABLE `Shifts`
  MODIFY `shift_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

ALTER TABLE `Shifts`
  ADD CONSTRAINT `shifts_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `Employee` (`id`);
COMMIT;

CREATE TABLE `Unavailabilities` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `employee_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `Unavailabilities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`);

ALTER TABLE `Unavailabilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

ALTER TABLE `Unavailabilities`
  ADD CONSTRAINT `unavailabilities_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `Employee` (`id`);
COMMIT;

CREATE TABLE `hour_limits` (
  `employee_id` int(11) NOT NULL,
  `hour_limit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `hour_limits`
  ADD PRIMARY KEY (`employee_id`);

ALTER TABLE `hour_limits`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `hour_limits`
ADD CONSTRAINT `hour_limits_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `Employee` (`id`);
COMMIT;

delimiter ;;
CREATE FUNCTION `get_shift_hour`(employee_id int)
 RETURNS int(11)
BEGIN
  declare current_hour int;
  select count(shift_id)*8 into current_hour from shifts where shifts.employee_id=employee_id;

  RETURN current_hour;
END
;;
delimiter ;

delimiter ;;
CREATE TRIGGER `add_hour_limit` AFTER INSERT ON `employee` FOR EACH ROW begin
insert into hour_limits values (new.id, 40);
end
;;
delimiter ;

INSERT INTO `Employee` (`id`, `email`, `password`, `phone_number`, `dob`, `name`, `preferred_name`, `address`, `is_manager`) VALUES (NULL, 'test@gmail.com', 'Abc123!!', '0000000000', '2021-04-07', 'Test Tester', 'Test Person', '123 Test St', '1');

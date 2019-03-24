	
	CREATE TABLE `msgs` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `username` varchar(25) NOT NULL DEFAULT '',
 `email` varchar(50) NOT NULL DEFAULT '',
 `msg` text,
 `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8
CREATE TABLE IF NOT EXISTS `twitterwidget_settings` (
      `idx` int(11) NOT NULL AUTO_INCREMENT,
      `count_status` int(11) NOT NULL,
      `username` varchar(50) NOT NULL,
      `skin_flag` int(1) NOT NULL,
      `width_type` varchar(100) NOT NULL,
      `percent_pixel` int(11) DEFAULT NULL,
      `width_size_type` varchar(100) NOT NULL,
      `pm_idx` int(11) NOT NULL,
      PRIMARY KEY (`idx`)
);

CREATE TABLE IF NOT EXISTS `twitterwidget_token` (
        `idx` int(11) NOT NULL auto_increment,
        `auth` varchar(100) NOT NULL,
        `auth_secret` varchar(100) NOT NULL,
        `ts_idx` int(11) NOT NULL,
        `username` varchar(50) NOT NULL,
PRIMARY KEY (`idx`)) ENGINE=InnoDB DEFAULT CHARSET=utf8
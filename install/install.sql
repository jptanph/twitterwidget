CREATE TABLE IF NOT EXISTS `twitterwidget_settings` (
      `idx` int(11) NOT NULL AUTO_INCREMENT,
      `seq` int(11)NOT NULL,
      `post_count` int(11) NOT NULL,
      `username` varchar(50) NOT NULL,
      PRIMARY KEY (`idx`)
);


CREATE TABLE `tbuser` (
  `userid` int NOT NULL primary key auto_increment,
  `username` char(10) NOT NULL,
  `userpwd` char(10) NOT NULL,
  `isadmin` int not NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



CREATE TABLE `repair` (
    id_ int NOT NULL primary key auto_increment,
  `dornum` char(3) NOT NULL DEFAULT '--',
  `faulteqiupment` char(20) DEFAULT '--',
  `reportdate`  timestamp DEFAULT CURRENT_TIMESTAMP,
  `iscomplete` char(16) DEFAULT '未完成',
  `repairman` char(14) DEFAULT '未定',
  `who` char(40) DEFAULT '匿名'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
create table (
    id_ int 
)


CREATE TABLE picture_space (
  `id_` int NOT NULL AUTO_INCREMENT,
  `who_upload` VARCHAR(40) NOT NULL,
  `upload_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `note` varchar(400) DEFAULT 'Mary&jack Together Forever',
  title VARCHAR(200) DEFAULT 'Mary&jack',
  PRIMARY KEY (id_)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;
alter table picture_space AUTO_INCREMENT 1;
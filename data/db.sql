----管理员表
create table qq_admin(
id int(11) unsigned primary key auto_increment,
username varchar(50) not null default '' comment '用户名',
password char(40) not null comment '密码',
login_lasttime int not null default 0 comment '最后登录时间',
login_ip char(15) not null default '' comment '登录ip',
status tinyint(1) not null default 0 comment '管理员状态',
remark varchar(100) not null default '' comment '管理员备注'
)engine=Innodb charset=utf8;

----栏目表
create table qq_categroy(
id int(11) unsigned primary key auto_increment,
pid int(11) unsigned not null default 0 comment '父级id',
catename varchar(50) not null default '' comment '栏目名称',
)engine=Innodb charset utf8;

----内容表
create table qq_news(
id int(11) unsigned primary key auto_increment,
cid int(11) unsigned not null comment '栏目id',
bigtitle varchar(255) not null default '' comment '主标题',
title varchar(255) not null default '' comment '标题',
author varchar(50) not null default '' comment '作者',
content text,
addtime int(11) not null comment '添加时间',
uptime int(11) not null comment '修改时间'
)engine=Innodb charset=utf8;





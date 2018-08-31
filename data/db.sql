----管理员表
create table qq_admin(
id int(11) unsigned primary key auto_increment,
username varchar(50) not null default '' comment '用户名',
password char(40) not null comment '密码',
login_lasttime int not null default 0 comment '最后登录时间',
login_ip char(15) not null default '' comment '登录ip',
status tinyint(1) not null default 0 comment '管理员状态',
remark varchar(100) not null default '' comment '管理员备注'
)engine=Innodb charset=utf8 comment '管理员表';

----栏目表
create table qq_category(
id int(11) unsigned primary key auto_increment,
pid int(11) unsigned not null default 0 comment '父级id',
catename varchar(50) not null default '' comment '栏目名称'
)engine=Innodb charset utf8 comment '栏目表';

----文章表
create table qq_article(
id int(11) unsigned primary key auto_increment,
cid int(11) unsigned not null comment '栏目id',
bigtitle varchar(255) not null default '' comment '主标题',
title varchar(255) not null default '' comment '标题',
author varchar(50) not null default '' comment '作者',
content text,
addtime int(11) not null comment '添加时间',
uptime int(11) not null comment '修改时间'
)engine=Innodb charset=utf8 comment '内容表';

----en栏目表
create table qq_encategory(
id int(11) unsigned primary key auto_increment,
pid int(11) unsigned not null default 0 comment '父级id',
catename varchar(50) not null default '' comment '栏目名称'
)engine=Innodb charset utf8 comment '栏目表';

----文章表
create table qq_enarticle(
id int(11) unsigned primary key auto_increment,
cid int(11) unsigned not null comment '栏目id',
bigtitle varchar(255) not null default '' comment '主标题',
title varchar(255) not null default '' comment '标题',
author varchar(50) not null default '' comment '作者',
content text,
addtime int(11) not null comment '添加时间',
uptime int(11) not null comment '修改时间'
)engine=Innodb charset=utf8 comment '内容表';


----订阅表
create table qq_feeds(
id int(11) unsigned primary key auto_increment,
fcompany varchar(120) not null default '' comment '订阅单位',
fusername varchar(120) not null default '' comment '订阅联系人',
fsex tinyint(1) unsigned not null default 0 comment '默认0为男，1为女',
fphone varchar(20) not null default '' comment '联系电话',
fax varchar(15) not null default '' comment '传真',
fcnnum int unsigned not null default 0 comment '中文订阅数量',
fennum int unsigned not null default 0 comment '英文订阅数量',
femail varchar(80) not null default '' comment '邮箱',
fcode char(6) not null default '' comment '邮编',
faddress varchar(200) not null default '' comment '通信地址',
is_invoice tinyint(1) not null default 0 comment '是否开发票',
company varchar(120) not null default '' comment '开票单位',
identnum varchar(50) not null default '' comment '纳税人识别号',
regaddress varchar(50) not null default '' comment '注册地址',
regphone varchar(50) not null default '' comment '注册电话',
bank varchar(200) not null default 0 comment '开户银行',
bankcard int(50) not null default 0 comment '银行账户',
addtime int not null comment '提交时间'
)engine=Innodb charset=utf8 comment '订阅表';


































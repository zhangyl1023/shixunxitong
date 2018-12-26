

#创建一个管理员表
create table sx_admin(
	id int unsigned primary key auto_increment,
	admin_name varchar(32) not null comment '管理员名称',
	admin_password char(32) not null comment '管理员密码',
	salt char(6) not null comment '密码的密钥'
)engine myisam charset utf8;
#密码的生成方式是，md5(md5(名文密码).salt)
#在建立表时我们手动创建一个超级管理员，$salt = 'saffdw';  明文密码是'admin',
#生成密码是：d47dc10901670e52e26958c06e9510d6
insert into sx_admin values(null,'admin','d47dc10901670e52e26958c06e9510d6','saffdw');
#创建一个角色表
create table sx_role(
	id int unsigned primary key auto_increment,
	role_name varchar(32) not null comment '角色名称'
)engine myisam charset utf8;
#创建一个权限表
create table sx_privilege(
	id int unsigned primary key auto_increment,
	priv_name varchar(32) not null comment '权限名称',
	parent_id  int not null default 0 comment '父级权限的id',
	module_name varchar(32) not null default '' comment '该权限对应的模块名称',
	controller_name varchar(32) not null default '' comment '该权限对应的控制器名称',
	action_name varchar(32) not null default '' comment '该权限对应的方法名称'
)engine myisam charset utf8;

#创建一个管理员与角色表中间表
create table sx_admin_role(
	admin_id int not null comment '管理员的id',
	role_id int not null comment '角色的id'
)engine myisam charset utf8;

#创建一个角色表与权限的中间表
create table sx_role_privilege(
	role_id int not null comment '角色的id',
	priv_id int not null comment '权限的id'
)engine myisam charset utf8;

#创建一个耗材表
create table sx_consumable(
  id int unsigned primary key auto_increment,
  consumable varchar(32) default '' comment'耗材'
)engine myisam charset utf8;

#创建一个专业教学计划表
create table sx_profession_plan(
  id int unsigned primary key auto_increment,
  title varchar(150) not null comment '标题',
  content varchar(65532) not null comment '内容',
  Path varchar(100) comment '路径',
  profession varchar(150) not null comment '专业',
  class varchar(150) comment '班级',
  author varchar(32) comment '作者',
  add_time int not null default 0 comment '时间',
  status tinyint not null default 1 comment '状态0位表示已被移除'
)engine myisam charset utf8;
alter table sx_profession_plan CHANGE profession profession_id int comment '专业id';

#创建一个学期表
create table sx_semester(
  id int unsigned primary key auto_increment,
  semester varchar(40) not null comment '学期',
  index (semester)
)engine myisam charset utf8;

#创建一个专业表
create table sx_profession(
  id tinyint unsigned primary key auto_increment,
  profession_name varchar(32) not null comment '专业名称'
)engine myisam charset utf8;
alter table sx_profession CHANGE profession_name profession VARCHAR(32) not null comment '专业名称';

#创建一个学期计划表title 	content	class_id	author	add_time	teacher_id
create table sx_semester_plan(
  id int unsigned primary key auto_increment,
  title varchar(150) not null comment '标题',
  content varchar(65532) not null comment '内容',
  author varchar(32) comment '作者',
  class_id int comment '班级ID',
  semester_id int comment '学期ID',
  teacher_id int comment '教师ID',
  add_time int not null default 0 comment '时间',
  status tinyint not null default 1
)engine myisam charset utf8;
alter table sx_semester_plan add sourse_id int comment'课程id';

#创建一个所有课程表
create table sx_sourse (
  id            INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  profession_id INT COMMENT '专业',
  semester_id int comment '学期',
  sourse varchar(150) comment '课程',
  period char comment '学时',
  money DECIMAL(9,2) comment '费用',
  content text comment '内容'
)ENGINE myisam CHARSET utf8;

#创建一个学期实训课程总表
create table sx_semester_sourse(
  id int unsigned primary key auto_increment,
  course varchar(150)  comment '课程',
  long_week tinyint comment '几周',
  class varchar(150) comment '班级',
  teacher varchar(32) comment '教师',
  plan_time tinyint comment '安排第几周',
  exam_time int comment '考试时间',
  whereexam varchar(32) comment '考试地点',
  add_time int comment '编辑时间'
)engine myisam charset utf8;

#创建一个教师花名册表
create table sx_teacher(
  id int unsigned primary key AUTO_INCREMENT,
  teacher VARCHAR(32) comment '教师姓名',
  teacher_tel int(11) comment'教师电话',
  index (teacher)
)ENGINE myisam charset utf8;

#创建一个专业班级表
create table sx_class(
  id int UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  profession_id int comment '专业',
  class varchar(150) comment '班级',
  start_time int comment '开班时间'
)ENGINE myisam CHARSET utf8;

#创建一个课程教师表
create table sx_sourse_teacher(
  id int UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  sourse_id int,
  teacher_id int
)ENGINE myisam CHARSET utf8;

  #创建一个课程班级教师表
create table sx_sourse_class_teacher(
  id int UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  sourse_id int,
  class_id int,
  teacher_id int
)ENGINE myisam CHARSET utf8;

#创建一个耗材清单
create table sx_consumable_list(
  id int UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  listname VARCHAR(33) comment '耗材',
  numb int comment '数量',
  p_id int COMMENT '教师课程学期id',
  unit char(6) comment'单位',
  brand VARCHAR(32) comment '品牌',
  version VARCHAR(32) COMMENT '型号',
  status TINYINT not null DEFAULT 1,
  add_time int comment '编辑时间'
)ENGINE myisam CHARSET utf8;

#创建一个课程班级教师耗材连表
create table sx_sct_consumablelist(
  id int UNSIGNED PRIMARY KEY  AUTO_INCREMENT,
  sct_id int,
  list_id int,
  suoshu_id TINYINT comment '1为耗材表，2为工量具表'
)ENGINE myisam charset utf8;

#创建一个工量具清单
create table sx_tool_list(
  id int UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  listname VARCHAR(33) comment '工量具',
  numb int comment '数量',
  p_id int COMMENT '教师课程学期id',
  unit char(6) comment'单位',
  brand VARCHAR(32) comment '品牌',
  version VARCHAR(32) COMMENT '型号',
  status TINYINT not null DEFAULT 1,
  add_time int comment '编辑时间'
)ENGINE myisam CHARSET utf8;


#创建一个耗材登记表
create table sx_consumable_temp(
  id int UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  listname VARCHAR(33) comment '耗材',
  numb int comment '数量',
  unit char(6) comment'单位',
  brand VARCHAR(32) comment '品牌',
  version VARCHAR(32) COMMENT '型号',
  sct_id int comment '所属课程id',
  status TINYINT not null DEFAULT 1,
  add_time int comment '编辑时间'
)ENGINE myisam CHARSET utf8;

#创建一个工量具登记表
create table sx_tool_temp(
  id int UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  listname VARCHAR(33) comment '工量具',
  numb int comment '数量',
  unit char(6) comment'单位',
  brand VARCHAR(32) comment '品牌',
  version VARCHAR(32) COMMENT '型号',
  sct_id int comment '所属课程id',
  status TINYINT not null DEFAULT 1,
  add_time int comment '编辑时间'
)ENGINE myisam CHARSET utf8;

#创建一个耗材登记表
create table sx_consumable(
  id int UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  si_id int COMMENT '课程项目id',
  numb int comment '数量',
  list_id int comment 'consumable_list_id',
  status TINYINT not null DEFAULT 1,
  add_time int comment '编辑时间'
)ENGINE myisam CHARSET utf8;

#创建一个工量具登记表
create table sx_tool(
  id int UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  si_id int COMMENT '课程项目id',
  numb int comment '数量',
  list_id int comment 'tool_list_id',
  status TINYINT not null DEFAULT 1,
  add_time int comment '编辑时间'
)ENGINE myisam CHARSET utf8;

#创建一个实训课程项目表
create table sx_sourse_item(
  id int UNSIGNED PRIMARY KEY  AUTO_INCREMENT,
  sct_id int comment '课程id',
  itemname VARCHAR(50) comment '项目名',
  content TEXT comment '内容',
  teacher VARCHAR(32) comment '教师',
  add_time int comment '申请时间',
  consumable_id VARCHAR(200) comment '耗材id',
  tool_id VARCHAR(200) comment '工量具id'
)ENGINE myisam CHARSET utf8;

#创建一个地址表
create table sx_addr(
  id int UNSIGNED PRIMARY KEY  AUTO_INCREMENT,
  type char comment '场地类型',
  content varchar (60) comment '详细地址',
  seatnumb int comment '座位数',
  facility VARCHAR(60) COMMENT '设施',
  status TINYINT comment '状态',
  usetime int COMMENT '使用开始时间',
  longtime int COMMENT '使用多少分钟'
)ENGINE myisam CHARSET utf8;

#创建一个学期详情表
create table sx_sourse_details(
  id int UNSIGNED PRIMARY KEY  AUTO_INCREMENT,
  s_id int COMMENT  '学期id',
  derectoryname varchar(255) COMMENT '目录名',
  p_id int not null DEFAULT 0 COMMENT '父级id',
  content text COMMENT '介绍',
  videopath VARCHAR(255) COMMENT '视频路径'
)ENGINE myisam CHARSET utf8;
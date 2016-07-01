/*
Navicat MySQL Data Transfer

Source Server         : 我的数据库
Source Server Version : 50520
Source Host           : localhost:3306
Source Database       : my_project

Target Server Type    : MYSQL
Target Server Version : 50520
File Encoding         : 65001

Date: 2016-07-01 19:45:17
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for my_admin
-- ----------------------------
DROP TABLE IF EXISTS `my_admin`;
CREATE TABLE `my_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL COMMENT '账号',
  `password` char(40) NOT NULL COMMENT '密码(使用sha1()加密)',
  `email` varchar(50) DEFAULT NULL COMMENT '管理员邮箱',
  `roles` varchar(255) DEFAULT NULL COMMENT '权限',
  `auto_key` char(20) DEFAULT NULL COMMENT '自动登录的KEY',
  `access_token` char(40) DEFAULT NULL COMMENT '自动登录TOKEN',
  `status` tinyint(2) NOT NULL COMMENT '管理员状态',
  `create_id` int(11) NOT NULL COMMENT '创建管理员',
  `create_time` int(11) DEFAULT NULL COMMENT '注册时间',
  `last_time` int(11) DEFAULT NULL COMMENT '最后登录的时间',
  `last_ip` varchar(20) DEFAULT NULL COMMENT '最后登录IP',
  `update_time` int(11) NOT NULL DEFAULT '1' COMMENT '修改时间',
  `update_id` int(11) NOT NULL DEFAULT '1' COMMENT '修改用户',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='后台管理员信息表';

-- ----------------------------
-- Records of my_admin
-- ----------------------------
INSERT INTO `my_admin` VALUES ('1', 'admin', 'f865b53623b121fd34ee5426c792e5c33af8c227', 'admin@qq.com', '', '', '', '1', '0', '1457604078', '1467279537', '127.0.0.1', '1', '1');
INSERT INTO `my_admin` VALUES ('2', 'liujinxing', 'e74057e4af210894e68ae86918e051929bb6d85f', '821901008@qq.com', 'admin', '', '', '1', '0', '1457606311', '1467368469', '127.0.0.1', '1', '1');
INSERT INTO `my_admin` VALUES ('3', 'admin123', 'e74057e4af210894e68ae86918e051929bb6d85f', '1136261505@qq.com', 'user', null, null, '1', '1', '1467367735', '1467367735', '127.0.0.1', '1467367735', '1');

-- ----------------------------
-- Table structure for my_article
-- ----------------------------
DROP TABLE IF EXISTS `my_article`;
CREATE TABLE `my_article` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '文章标题',
  `content` text NOT NULL COMMENT '文字内容',
  `img` varchar(100) DEFAULT '' COMMENT '文章的图片',
  `type` tinyint(2) NOT NULL DEFAULT '1' COMMENT '文章的分类（1 普通文章 ...）',
  `see_num` int(11) NOT NULL DEFAULT '0' COMMENT '浏览量',
  `comment_num` int(11) NOT NULL DEFAULT '0' COMMENT '评论量',
  `recommend` tinyint(1) DEFAULT '0' COMMENT '是否推荐（0 不推荐 1 推荐）',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态（0 停用 1 启用）',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `create_id` int(11) NOT NULL,
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '修改时间',
  `update_id` int(11) NOT NULL DEFAULT '0' COMMENT '修改的用户',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COMMENT='文章信息表';

-- ----------------------------
-- Records of my_article
-- ----------------------------
INSERT INTO `my_article` VALUES ('1', '住在手机里的朋友', '通信时代，无论是初次相见还是老友重逢，交换联系方式，常常是彼此交换名片，然后郑重或是出于礼貌用手机记下对方的电话号码。在快节奏的生活里，我们不知不觉中就成为住在别人手机里的朋友。又因某些意外，变成了别人手机里匆忙的过客，这种快餐式的友谊 ...', '/static/uploads/20160316/56e927cb5a057.jpg', '1', '0', '0', '1', '1', '1458110398', '1', '1458120653', '1');
INSERT INTO `my_article` VALUES ('2', '你面对的是生活而不是手机', '每一次与别人吃饭，总会有人会拿出手机。以为他们在打电话或者有紧急的短信，但用余光瞟了一眼之后发现无非就两件事：1、看小说，2、上人人或者QQ...', '/static/uploads/20160317/56ea6d1dd9f24.jpg', '1', '0', '0', '0', '1', '1458126033', '1', '1458203938', '1');
INSERT INTO `my_article` VALUES ('3', '手机的16个惊人小秘密，据说99.999%的人都不知的人都不知12121', '知道么，手机有备用电池，手机拨号码12593+电话号码=陷阱……手机具有很多你不知道的小秘密，说出来一定很惊奇！不信的话就来看看吧！...', '/static/uploads/20160317/56ea6d3f8c664.jpg', '1', '0', '0', '0', '1', '1458201880', '1', '1458203969', '1');
INSERT INTO `my_article` VALUES ('4', '我的测试数据哦！！！', '知道么，手机有备用电池，手机拨号码12593+电话号码=陷阱……手机具有很多你不知道的小秘密，说出来一定很惊奇！不信的话就来看看吧！...', '', '1', '0', '0', '0', '1', '1458201972', '1', '1458201972', '0');
INSERT INTO `my_article` VALUES ('5', '豪雅手机正式发布! 在法国全手工打造的奢侈品', '现在跨界联姻，时尚、汽车以及运动品牌联合手机制造商联合发布手机产品在行业里已经不再新鲜，上周我们给大家报道过著名手表制造商瑞士泰格·豪雅（Tag Heuer） 联合法国的手机制造商Modelabs发布的一款奢华手机的部分谍照，而近日该手机终于被正式发布了...', '/static/uploads/20160317/56ea6cdca97ad.jpg', '1', '0', '0', '0', '1', '1458203028', '1', '1458203876', '1');
INSERT INTO `my_article` VALUES ('6', '我的第一个GO项目', '学习GO语言有两个星期了，使用Beego开发了一个简单的后台管理项目，就是简单的CURD操作和文件上传', '/static/uploads/20160317/56ea767de7dd2.png', '1', '0', '0', '0', '1', '1458204487', '1', '1458206336', '1');
INSERT INTO `my_article` VALUES ('7', '我的第一个GO项目', '学习GO语言有两个星期了，使用Beego开发了一个简单的后台管理项目，就是简单的CURD操作和文件上传', '', '1', '0', '0', '0', '1', '1458204776', '1', '1458204776', '0');
INSERT INTO `my_article` VALUES ('8', '我的测试', '我的测试', '/static/uploads/20160318/56eb731c86271.png', '1', '0', '0', '0', '1', '1458271132', '2', '1458271132', '0');
INSERT INTO `my_article` VALUES ('9', '我的测试数据', '我的测试数据', '/static/uploads/20160318/56eb7445ea019.jpg', '1', '0', '0', '0', '1', '1458271303', '2', '1458271303', '0');
INSERT INTO `my_article` VALUES ('10', '我的测试数据01哦哦哦！', '我的测试数据哦！', '/static/uploads/20160318/56eb7b3009d33.png', '1', '0', '0', '0', '1', '1458273086', '2', '1458273086', '0');
INSERT INTO `my_article` VALUES ('11', '我的测试数据', '测试数据哦！', '/static/uploads/20160318/56eb7b3009d33.png', '1', '0', '0', '0', '1', '1458273126', '2', '1458273126', '0');
INSERT INTO `my_article` VALUES ('12', 'Mongo', '1.1 集合查询方法 find()\r\n\r\ndb.collection.find()  查询集合中文档并返回结果为游标的文档集合。\r\n\r\n语法：db.collection.find(query, projection)\r\n参数 　　　　　类型 　　　　描述 \r\nquery	　　　 文档	　 可选. 使用查询操作符指定查询条件\r\nprojection  　 文档	　 可选.使用投影操作符指定返回的键。查询时返回文档中所有键值， 只需省略该参数即可（默认省略）.\r\n\r\n返回值: 匹配查询条件的文档集合的游标. 如果指定投影参数，查询出的文档返回指定的键 ,&quot;_id&quot;键也可以从集合中移除掉。　\r\n注意:在mongo shell中我们不需要JavaScript游标处理方法就可以直接访问作为查询结果的文档集合。mongo shell默认返回游标中的前20条文档。当执行查询操作时，mongo shell直接自动的对游标执行迭代操作并显示前20条文档。输入&quot;it&quot;显示接下来的20条文档。\r\n\r\n　　find的第一个参数是查询条件，其形式也是一个文档，决定了要返回哪些文档，空的査询文档{}会匹配集合的全部内容。要是不指定査询文档，默认就是{}，如同SQL中&quot;SELECT * FROM TABLENAME&quot;语句。\r\n\r\n//将返回集合中所有文档\r\ndb.collection.find()\r\n//或者\r\ndb.collection.find({})\r\n　　第一个参数若为键/值对时，查询过程中就意味着执行了条件筛选，就如同我们使用Linq查询数据库一样。下面查询操作将返回user集合中age键值为16的文档集合。\r\n\r\n//mongo db\r\ndb.user.find({age:16})\r\n\r\n//Linq to sql\r\ndbContext.user.select(p=&gt;p.age==16)\r\n　　上面的查询默认执行“==”操作(就如同linq中 p.age==16)，文档中若存在相同键的值和查询文档中键的值相等的话，就会返回该文档。\r\n\r\n　　第一个参数若包含多个键/值对(逗号分隔)，则相当于查询AND组合条件，“条件1 AND条件2 AND…AND 条件N&quot;.例如查询年龄为28且性别为男性的文档集合：\r\n\r\n复制代码\r\n//mongo db\r\ndb.user.find({age:28,sex:&quot;male&quot;})\r\n\r\n//Linq to sql\r\ndbContext.user.select(p=&gt;p.age==28&amp;&amp;p.sex==&quot;male&quot;)\r\n\r\n//SQL\r\nSELECT * FROM user WHERE age=28 AND sex=&quot;male&quot;\r\n复制代码\r\n \r\n\r\n指定返回的键\r\n\r\n　　我们可以通过find 的第二个参数来指定返回的键。\r\n\r\n　　若find不指定第二个参数，查询操作默认返回查询文档中所有键值。像SQL中我们可以指定查询返回字段一样 ，mongo中也可以指定返回的键，这样我们就可以避免查询无用键值查询所消耗的资源、会节省传输的数据量和内存消耗。\r\n\r\n 　  集合user包含 _id,name,age,sex，email等键,如果查询结果想只显示集合中的&quot;name&quot;和&quot;age&quot;键，可以使用如下查询返回这些键,。\r\n\r\n&gt; db.users.find({}, {&quot;name&quot; ： 1, &quot;age&quot; ： 1})\r\n　　上面查询结果中，&quot;_id&quot;这个键总是被返回，即便是没有指定也一样。但是我们可以显示的将其从查询结果中移除掉。\r\n\r\n&gt; db.users.find({}, {&quot;name&quot; ： 1, &quot;age&quot; ： 1, &quot;_id&quot;：0})\r\n\r\n\r\n　　在第二个参数中，指定键名且值为1或者true则是查询结果中显示的键；若值为0或者false，则为不显示键。文档中的键若在参数中没有指定，查询结果中将不会显示（_id例外）。这样我们就可以灵活显示声明来指定返回的键。\r\n\r\n　　我们在使用RDMS时，有时会对表中多个字段之间进行比较。如表store中，有销售数量soldnum和库存数量stocknum两个字段，我们要查询表中销售数量等于库存数量的记录时可以使用下面的sql语句：\r\n\r\nSELECT * FROM store WHERE soldnum=stocknum\r\n　　那么换成mongodb呢，使用find()能实现类似的功能吗？ \r\n\r\n&gt; db.store.find ({ &quot;soldnum&quot; : &quot;stocknum&quot;})\r\n//或者\r\n&gt; db.store.find ({ &quot;stocknum&quot;:&quot;soldnum&quot; })\r\n　　结果是不行的！！我们可以使用$where运算符来进行相应的操作。\r\n\r\n1.2  查询内嵌文档\r\n　　查询文档有两种方式，一种是完全匹查询，另一种是针对键/值对查询。\r\n\r\n&gt; db.profile.find()\r\n{ &quot;_id&quot; : ObjectId(&quot;51d7b0d436332e1a5f7299d6&quot;), &quot;name&quot; : { &quot;first&quot; : Barack&quot;, &quot;last&quot; : &quot;Obama&quot; } }\r\n&gt;\r\n　　内嵌文档的完全匹配查询和数组的完全匹配查询一样，内嵌文档内键值对的数量，顺序都必须一致才会匹配:\r\n\r\n复制代码\r\n&gt; db.profile.find({ name : { first : &quot;Barack&quot;, last : &quot;Obama&quot; } });\r\n{ &quot;_id&quot; : ObjectId(&quot;51d7b0d436332e1a5f7299d6&quot;), &quot;name&quot; : { &quot;first&quot; : Barack&quot;, &quot;last&quot; : &quot;Obama&quot; } }\r\n&gt;\r\n//无任何返回值\r\n&gt; db.profile.find({ name : {  last : &quot;Obama&quot; , first : &quot;Barack&quot;} });\r\n&gt;\r\n复制代码\r\n　　推荐采用针对键/值对查询，通过点表示法来精确表示内嵌文档的键：\r\n\r\n//查询结果一样\r\ndb.profile.find({  &quot;name.first&quot; : &quot;Barack&quot; , &quot;name.last&quot; : &quot;Obama&quot;});\r\n//或者\r\ndb.profile.find({  &quot;name.last&quot; : &quot;Obama&quot; , &quot;name.first&quot; : &quot;Barack&quot;} );\r\n　　运行结果：\r\n\r\n\r\n\r\n \r\n\r\n \r\n\r\n査询文档可以包含点，来表达“深入内嵌文档内部”的意思，点表示法也是待插入的文档不能包含的原因。当内嵌文档变得复杂后，如键的值为内嵌文档的数组，内嵌文档的匹配需要些许技巧，例如使用$elemMatch操作符。\r\n\r\n集合blogs有如下文档：\r\n\r\n复制代码\r\n{\r\n        &quot;content&quot; : &quot;.....&quot;,\r\n        &quot;comment&quot; : [\r\n                {\r\n                        &quot;author&quot; : &quot;zhangsan&quot;,\r\n                        &quot;score&quot; : 3,\r\n                        &quot;comment&quot; : &quot;shafa!&quot;\r\n                },\r\n                {\r\n                        &quot;author&quot; : &quot;lisi&quot;,\r\n                        &quot;score&quot; : 5,\r\n                        &quot;comment&quot; : &quot;lzsb!&quot;\r\n                }\r\n        ]\r\n}\r\n复制代码\r\n我们想查询评论中用户“zhangsan”是否有评分超过4分的评论内容，但我们利用“点表示法”直接写是有问题的，这条查询条件和数组中不同的文档进行了匹配！\r\n\r\n&gt; db.blogs.find({&quot;comment.author&quot;:&quot;zhangsan&quot;, &quot;comment.score&quot;:{&quot;$gte&quot;:4}});\r\n\r\n\r\n上面的结果不是我们期望的，下面使用“$elemMatch”操作符即可将一组条件限定到数组中单条文档的匹配上：\r\n\r\n&gt; db.blogs.find({&quot;comment&quot;:{&quot;$elemMatch&quot;:{&quot;author&quot;:&quot;zhangsan&quot;,&quot;score&quot;:{&quot;$gt&quot;:4}}}});\r\n&gt; db.blogs.find({&quot;comment&quot;:{&quot;$elemMatch&quot;:{&quot;author&quot;:&quot;zhangsan&quot;,&quot;score&quot;:{&quot;$gt&quot;:2}}}});\r\n\r\n\r\n \r\n\r\n \r\n\r\n\r\n \r\n\r\n \r\n\r\n \r\n\r\n1.3 查询操作符　　\r\n　　下面我们将配合查询操作符来执行复杂的查询操作，比如元素查询、 逻辑查询 、比较查询操作。　\r\n\r\n　　我们使用下面的比较操作符&quot;$gt&quot; 、&quot;$gte&quot;、 &quot;$lt&quot;、 &quot;$lte&quot;(分别对应&quot;&gt;&quot;、 &quot;&gt;=&quot; 、&quot;&lt;&quot; 、&quot;&lt;=&quot;)，组合起来进行范围的查找。例如查询年龄为16-18岁(包含16但不含18)的用户：\r\n\r\n&gt;db.user.find( { age: { $gte: 16 ,$lt:18} } \r\n　　我们可以使用&quot;$ne&quot;来进行&quot;不相等&quot;操作。例如查询年龄不为18岁的用户：\r\n\r\n&gt;db.user.find( { age: {$ne:18} } \r\n　　精确匹配日期要精确到毫秒,然而我们通常只是想得到关于一天、一周或者是一个月的数据，我们可以使用&quot;gt&quot;、&quot;gt&quot;、&quot;lt&quot;进行范围査询。例如，要査找在1990年1月1日出生的用户：\r\n\r\n&gt;    start = new Date(&quot;1990/01/01&quot;)\r\n&gt;    db.users.find({&quot;birthday&quot; ： {&quot;$lt&quot; ： start}})\r\n \r\n\r\n键值为null查询操作\r\n\r\n　　如何检索出sex键值为null的文档，我们使用&quot;in&quot;、&quot;in&quot;、&quot;where&quot;操作符，&quot;$in&quot;判断键值是否为null,&quot;$exists&quot;判定集合中文档是否包含该键。\r\n\r\n复制代码\r\n//集合中有一条sex键值为null的文档\r\n{&quot;name&quot;:&quot;xiaoming&quot;,&quot;age&quot;:20,&quot;sex&quot;:&quot;male&quot;}\r\n{&quot;name&quot;:&quot;xiaohong&quot;,&quot;age&quot;:22,&quot;sex&quot;:&quot;female&quot;}\r\n{&quot;name&quot;:&quot;lilei&quot;,&quot;age&quot;:24,&quot;sex&quot;:null}\r\n\r\n//返回文档中存在sex键，且值为null的文档  \r\ndb.users.find({sex:{$in:[null],$exists:true }})\r\n\r\n//返回文档中存在birthday键，且值为null的文档 \r\n//文档没有birthday键，所以结果为空\r\ndb.users.find({birthday:{$in:[null],$exists:true }})\r\n复制代码\r\n　　运行截图：\r\n\r\n\r\n\r\n 　　我们也可以运行如下语句：\r\n\r\n&gt; db.users.find({sex:null})\r\n　　查询结果跟语句&quot;db.users.find({sex:{in:[null],in:[null],exists:true }})&quot;一样\r\n\r\n\r\n\r\n　　但是当为我们运行下面语句时，发现查询结果跟语句&quot;db.users.find({birthday:{in:[null],in:[null],exists:true }})&quot;不一样！\r\n\r\n&gt; db.users.find({birthday:null})\r\n　　查询返回了所有的文档！\r\n\r\n\r\n\r\n 　　因为null不仅仅匹配自身，而且匹配键“不存在的”文档，集合众文档都不存在&quot;birthday&quot;键,都匹配查询条件，所以上面的语句会返回所有的文档！\r\n\r\n　　我们最好使用db.users.find({sex:{in:[null],in:[null],exists:true }})这种格式。\r\n\r\n \r\n\r\n　　下面先向集合inventory插入3条数据（下面的演示基于此数据），文档内容如下：\r\n\r\n　　{&quot;name&quot;:&quot;t1&quot;,&quot;amount&quot;:16,&quot;tags&quot;:[ &quot;school&quot;, &quot;book&quot;, &quot;bag&quot;, &quot;headphone&quot;, &quot;appliances&quot; ]}\r\n　　{&quot;name&quot;:&quot;t2&quot;,&quot;amount&quot;:50,&quot;tags&quot;:[ &quot;appliances&quot;, &quot;school&quot;, &quot;book&quot; ]}\r\n　　{&quot;name&quot;:&quot;t3&quot;,&quot;amount&quot;:58,&quot;tags&quot;:[ &quot;bag&quot;, &quot;school&quot;, &quot;book&quot; ]}\r\n\r\n\r\n\r\n \r\n&quot;$all&quot;\r\n\r\n　　匹配那些指定键的键值中包含数组，而且该数组包含条件指定数组的所有元素的文档,数组中元素顺序不影响查询结果。\r\n\r\n语法: { field: { $all: [ &lt;value&gt; , &lt;value1&gt; ... ] }\r\n　　查询出在集合inventory中 tags键值包含数组，且该数组中包含appliances、school、 book元素的所有文档:\r\n\r\ndb.inventory.find( { tags: { $all: [ &quot;appliances&quot;, &quot;school&quot;, &quot;book&quot; ] } } )\r\n　　该查询将匹配tags键值包含如下任意数组的所有文档:\r\n\r\n[ &quot;school&quot;, &quot;book&quot;, &quot;bag&quot;, &quot;headphone&quot;, &quot;appliances&quot; ]\r\n[ &quot;appliances&quot;, &quot;school&quot;, &quot;book&quot; ]\r\n　　查询结果：\r\n\r\n\r\n\r\n　　文档中键值类型不是数组，也可以使用$all操作符进行查询操作，如下例所示&quot;$all&quot;对应的数组只有一个值，那么和直接匹配这个值效果是一样的。\r\n\r\n//查询结果是相同的，匹配amount键值等于50的文档\r\ndb.inventory.find( { amount: {$all:[50]}} )\r\ndb.inventory.find( { amount: 50}} )\r\n\r\n \r\n　　要是想查询数组指定位置的元素，则需使用key.index语法指定下标，例如下面查询出tags键值数组中第2个元素为&quot;school&quot;的文档：\r\n\r\n&gt; db.inventory.find({&quot;tags.1&quot;:&quot;school&quot;})\r\n　　数组下标都是从0开始的，所以查询结果返回数组中第2个元素为&quot;school&quot;的文档：\r\n\r\n\r\n \r\n \r\n&quot;$size&quot;\r\n\r\n　　用其查询指定长度的数组。\r\n语法：{field: {$size: value} }\r\n　　查询集合中tags键值包含有3个元素的数组的所有文档：\r\n\r\n&gt; db.inventory.find({tags:{$size:3}})\r\n 　　文档&quot;{&quot;name&quot;:&quot;t1&quot;,&quot;amount&quot;:16,&quot;tags&quot;:[ &quot;school&quot;, &quot;book&quot;, &quot;bag&quot;, &quot;headphone&quot;, &quot;appliances&quot; ]}&quot;,tags键值数组包含四个元素，所以不匹配查询条件。查询结果：\r\n\r\n\r\n\r\n　　size必须制定一个定值，不能接受一个范围值，不能与其他查询子句组合(比如&quot;size必须制定一个定值，不能接受一个范围值，不能与其他查询子句组合(比如&quot;gt&quot;)。但有时查询需求就是需要一个长度范围，这种情况创建一个计数器字段，当你增加元素的同时增加计数器字段值。\r\n\r\n//每一次向指定数组添加元素的时候,&quot;count&quot;键值增加1(充当计数功能)\r\ndb.collection.update({ $push : {field: value}, $inc ：{count ： 1}})\r\n//比较count键值实现范围查询\r\ndb.collection.find({count : {$gt:2}})\r\n \r\n\r\n&quot;$in&quot;  \r\n\r\n　　匹配键值等于指定数组中任意值的文档。类似sql中in.\r\n语法: { field: { $in: [&lt;value1&gt;, &lt;value2&gt;, ... &lt;valueN&gt; ] } }\r\n&quot;$nin&quot;  \r\n\r\n　　匹配键不存在或者键值不等于指定数组的任意值的文档。类似sql中not in(SQL中字段不存在使用会有语法错误).\r\n\r\n语法: { field: { $nin: [ &lt;value1&gt;, &lt;value2&gt; ... &lt;valueN&gt; ]} }　　\r\n　\r\n\r\n　查询出amount键值为16或者50的文档：\r\n\r\ndb.inventory.find( { amount: { $in: [ 16, 50 ] } } )\r\n\r\n\r\n//查询出amount键值不为16或者50的文档\r\ndb.inventory.find( { amount: { $nin: [ 16, 50 ] } } )\r\n//查询出qty键值不为16或50的文档，由于文档中都不存在键qty,所以返回所有文档\r\ndb.inventory.find( { qty: { $nin: [ 16, 50 ] } } )\r\n\r\n\r\n　　文档中键值类型不是数组，也可以使用$all操作符进行查询操作，如下例所示&quot;$in&quot;对应的数组只有一个值，那么和直接匹配这个值效果是一样的。\r\n\r\n//查询结果是相同的，匹配amount键值等于50的文档\r\ndb.inventory.find( { amount: {$in:[50]}} )\r\ndb.inventory.find( { amount: 50}} )\r\n \r\n\r\n &quot;$and&quot; \r\n\r\n　　指定一个至少包含两个表达式的数组，选择出满足该数组中所有表达式的文档。$and操作符使用短路操作，若第一个表达式的值为“false”,余下的表达式将不会执行。\r\n\r\n语法: { $and: [ { &lt;expression1&gt; }, { &lt;expression2&gt; } , ... , { &lt;expressionN&gt; } ] }\r\n　　查询name键值为“t1”,amount键值小于50的文档：\r\n\r\ndb.inventory.find({ $and: [ { name: &quot;t1&quot; }, { amount: { $lt：50 } } ] } )\r\n\r\n\r\n \r\n\r\n　　对于下面使用逗号分隔符的表达式列表，MongoDB会提供一个隐式的$and操作：\r\n\r\n//等同于{ $and: [ { name: &quot;t1&quot; }, { amount: { $lt：50 } } ] }\r\n db.inventory.find({ name: &quot;t1&quot; , amount: { $lt：50 }} )\r\n\r\n\r\n　　\r\n\r\n&quot;$nor&quot;\r\n\r\n　　执行逻辑NOR运算,指定一个至少包含两个表达式的数组，选择出都不满足该数组中所有表达式的文档。\r\n\r\n语法: { $nor: [ { &lt;expression1&gt; }, { &lt;expression2&gt; }, ... { &lt;expressionN&gt; } ] }\r\n　　查询name键值不为“t1”,amount键值不小于50的文档：\r\n\r\ndb.inventory.find( { $nor: [ { name: &quot;t1&quot; }, { qty: { $lt: 50 } } ] } )\r\n\r\n\r\n　　\r\n\r\n　　若是文档中不存在表达式中指定的键，表达式值为false; false nor false 等于 true,所以查询结果返回集合中所有文档：\r\n\r\ndb.inventory.find( { $nor: [ { sale: true }, { qty: { $lt: 50 } } ] } )\r\n\r\n\r\n \r\n\r\n&quot;$not&quot;\r\n\r\n　　执行逻辑NOT运算，选择出不能匹配表达式的文档 ，包括没有指定键的文档。$not操作符不能独立使用，必须跟其他操作一起使用（除$regex）。\r\n\r\n语法: { field: { $not: { &lt;operator-expression&gt; } } }\r\n　　查询amount键值不大于50（即小于等于50）的文档数据\r\n\r\ndb.inventory.find( { amount: { $not: { $gt: 50 } } } ) //等同于db.inventory.find( { amount:  { $lte: 50 } } )\r\n \r\n\r\n\r\n\r\n　　查询条件中的键gty，文档中都不存在无法匹配表示，所以返回集合所有文档数据。\r\ndb.inventory.find( { gty: { $not: { $gt: 50 } } } ）\r\n \r\n\r\n \r\n\r\n&quot;$or&quot; \r\n\r\n　　执行逻辑OR运算,指定一个至少包含两个表达式的数组，选择出至少满足数组中一条表达式的文档。\r\n\r\n语法: { $or: [ { &lt;expression1&gt; }, { &lt;expression2&gt; }, ... , { &lt;expressionN&gt; } ] }\r\n　　查询集合中amount的键值大于50或者name的键值为“t1”的文档：\r\n\r\ndb.inventory.find( { $or: [ { amount: { $gt: 50 } }, { name: &quot;t1&quot; } ] } )\r\n\r\n\r\n \r\n\r\n&quot;$exists&quot;   \r\n\r\n　　如果$exists的值为true,选择存在该字段的文档；若值为false则选择不包含该字段的文档(我们上面在查询键值为null的文档时使用&quot;$exists&quot;判定集合中文档是否包含该键)。\r\n\r\n语法: { field: { $exists: &lt;boolean&gt; } }\r\n　　\r\n\r\n//查询不存在qty字段的文档（所有文档）\r\ndb.inventory.find( { qty: { $exists: false } })\r\n//查询amount字段存在，且值不等于16和58的文档\r\ndb.inventory.find( { amount: { $exists: true, $nin: [ 16, 58 ] } } )\r\n\r\n\r\n　　如果该字段的值为null，$exists的值为true会返回该条文档，false则不返回。\r\n\r\n复制代码\r\n//向集合中插入一条amount键值为null的文档\r\n{&quot;name&quot;:&quot;t4&quot;,&quot;amount&quot;:null,&quot;tags&quot;:[ &quot;bag&quot;, &quot;school&quot;, &quot;book&quot; ]}\r\n\r\n//0条数据\r\ndb.inventory.find( { amount: { $exists: false } } )\r\n//所有的数据\r\ndb.inventory.find( { amount: { $exists: true } } )\r\n复制代码\r\n\r\n\r\n   \r\n\r\n&quot;$mod&quot;  \r\n\r\n　　匹配字段值对（divisor）取模，值等于（remainder）的文档。\r\n\r\n语法: { field: { $mod: [ divisor, remainder ]} }\r\n　　查询集合中 amount 键值为 4 的 0 次模数的所有文档，例如 amount 值等于 16 的文档\r\n\r\ndb.inventory.find( { amount: { $mod: [ 4, 0 ] } } )\r\n\r\n\r\n　\r\n\r\n　　有些情况下(特殊情况键值为null时)，我们可以使用mod操作符替代使用求模表达式的mod操作符替代使用求模表达式的where操作符，因为后者代价昂贵。\r\n\r\ndb.inventory.find( { $where: &quot;this.amount % 4 == 0&quot; } )\r\n\r\n\r\n　　注意：返回结果怎么不一样。因为有一条文档的amount键值为null,javascript中null进行数值转换，会返回&quot;0&quot;。所以该条文档匹配where操作符求模式了表达式。当文档中字段值不存在null，就可以使用where操作符求模式了表达式。当文档中字段值不存在null，就可以使用mod替代$where的表达式.\r\n\r\n \r\n\r\n&quot;$regex&quot;\r\n\r\n　　操作符查询中可以对字符串的执行正则匹配。 MongoDB使用Perl兼容的正则表达式（PCRE)库来匹配正则表达式.\r\n\r\n　　我们可以使用正则表达式对象或者$regex操作符来执行正则匹配：\r\n\r\n//查询name键值以“4”结尾的文档\r\ndb.inventory.find( { name: /.4/i } );\r\ndb.inventory.find( { name: { $regex: \'.4\', $options: \'i\' } } );\r\n\r\n\r\n　　options（使用options（使用regex ）\r\n\r\ni  　如果设置了这个修饰符，模式中的字母会进行大小写不敏感匹配。\r\nm   默认情况下，PCRE 认为目标字符串是由单行字符组成的(然而实际上它可能会包含多行).如果目标字符串 中没有 &quot;\\n&quot;字符，或者模式中没有出现“行首”/“行末”字符，设置这个修饰符不产生任何影响。\r\ns    如果设置了这个修饰符，模式中的点号元字符匹配所有字符，包含换行符。如果没有这个修饰符，点号不匹配换行符。\r\nx    如果设置了这个修饰符，模式中的没有经过转义的或不在字符类中的空白数据字符总会被忽略，并且位于一个未转义的字符类外部的#字符和下一个换行符之间的字符也被忽略。 这个修饰符使被编译模式中可以包含注释。 注意：这仅用于数据字符。 空白字符 还是不能在模式的特殊字符序列中出现，比如序列 。\r\n　　注：JavaScript只提供了i和m选项，x和s选项必须使用$regex操作符。\r\n\r\n \r\n\r\n&quot;$where&quot;\r\n\r\n　　操作符功能强大而且灵活，他可以使用任意的JavaScript作为查询的一部分,包含JavaScript表达式的字符串或者JavaScript函数。\r\n\r\n　　新建fruit集合并插入如下文档：\r\n\r\n//插入两条数据\r\ndb.fruit.insert({&quot;apple&quot;:1, &quot;banana&quot;: 4, &quot;peach&quot; : 4})\r\ndb.fruit.insert({&quot;apple&quot;:3, &quot;banana&quot;: 3, &quot;peach&quot; : 4})\r\n　　比较文档中的两个键的值是否相等.例如查找出banana等于peach键值的文档（4种方法）：\r\n\r\n复制代码\r\n//JavaScrip字符串形式\r\ndb.fruit.find( { $where: &quot;this.banana == this.peach&quot; } )\r\ndb.fruit.find( { $where: &quot;obj.banana == obj.peach&quot; } )\r\n\r\n//JavaScript函数形式\r\ndb.fruit.find( { $where: function() { return (this.banana == this.peach) } } )\r\ndb.fruit.find( { $where: function() { return obj.banana == obj.peach; } } )\r\n复制代码\r\n\r\n\r\n \r\n\r\n　　查出文档中存在的两个键的值相同的文档，JavaScript函数会遍历集合中的文档：\r\n\r\n复制代码\r\n&gt;db.fruit.find({$where:function () {\r\n        for (var current in this) {\r\n            for (var other in this) {\r\n                if (current != other &amp;&amp; this[current] == this[other]) {\r\n                return true;\r\n                }\r\n            }\r\n        }\r\n        return false;\r\n    }});\r\n复制代码\r\n\r\n\r\n　　注意：我们尽量避免使用&quot;Where&quot;査询，因为它们在速度上要比常规査询慢很多。每个文档都要从BSON转换成JavaScript对象，然后通过&quot;Where&quot;査询，因为它们在速度上要比常规査询慢很多。每个文档都要从BSON转换成JavaScript对象，然后通过&quot;where&quot;的表达式来运行;同样还不能利用索引。\r\n\r\n \r\n\r\n&quot;$slice (projection)&quot; \r\n\r\n　　$slice操作符控制查询返回的数组中元素的个数。\r\n\r\n语法：db.collection.find( { field: value }, { array: {$slice: count } } );\r\n　　此操作符根据参数&quot;{ field: value }&quot; 指定键名和键值选择出文档集合，并且该文档集合中指定&quot;array&quot;键将返回从指定数量的元素。如果count的值大于数组中元素的数量，该查询返回数组中的所有元素的。\r\n\r\n　　$slice接受多种格式的参数 包含负数和数组:\r\n\r\n//选择comments的数组键值中前五个元素。\r\ndb.posts.find( {}, { comments: { $slice: 5 } } );\r\n\r\n//选择comments的数组键值中后五个元素。\r\ndb.posts.find( {}, { comments: { $slice: -5 } } );\r\n　　下面介绍指定一个数组作为参数。数组参数使用[ skip , limit ] 格式，其中第一个值表示在数组中跳过的项目数,第二个值表示返回的项目数。\r\n\r\n//选择comments的数组键值中跳过前20项之后前10项元素\r\ndb.posts.find( {}, { comments: { $slice: [ 20, 10 ] } } );\r\n\r\n//选择comments的数组键值中倒数第20项起前10项元素\r\ndb.posts.find( {}, { comments: { $slice: [ -20, 10 ] } } );\r\n \r\n&quot;$elemMatch(projection)&quot; \r\n\r\nelemMatch投影操作符将限制查询返回的数组字段的内容只包含匹配elemMatch投影操作符将限制查询返回的数组字段的内容只包含匹配elemMatch条件的数组元素。\r\n\r\n注意：\r\n\r\n数组中元素是内嵌文档。\r\n如果多个元素匹配$elemMatch条件，操作符返回数组中第一个匹配条件的元素。\r\n假设集合school有如下数据：\r\n\r\n \r\n\r\n复制代码\r\n{\r\n _id: 1,\r\n zipcode: 63109,\r\n students: [\r\n              { name: &quot;john&quot;, school: 102, age: 10 },\r\n              { name: &quot;jess&quot;, school: 102, age: 11 },\r\n              { name: &quot;jeff&quot;, school: 108, age: 15 }\r\n           ]\r\n}\r\n{\r\n _id: 2,\r\n zipcode: 63110,\r\n students: [\r\n              { name: &quot;ajax&quot;, school: 100, age: 7 },\r\n              { name: &quot;achilles&quot;, school: 100, age: 8 },\r\n           ]\r\n}\r\n\r\n{\r\n _id: 3,\r\n zipcode: 63109,\r\n students: [\r\n              { name: &quot;ajax&quot;, school: 100, age: 7 },\r\n              { name: &quot;achilles&quot;, school: 100, age: 8 },\r\n           ]\r\n}\r\n\r\n{\r\n _id: 4,\r\n zipcode: 63109,\r\n students: [\r\n              { name: &quot;barney&quot;, school: 102, age: 7 },\r\n           ]\r\n}\r\n复制代码\r\n \r\n\r\n下面的操作将查询邮政编码键值是63109的所有文档。 $elemMatch操作符将返回 students数组中的第一个匹配条件（内嵌文档的school键且值为102）的元素。\r\n\r\ndb.school.find( { zipcode: 63109 },{ students: { $elemMatch: { school: 102 } } } );\r\n查询结果：\r\n\r\n_id为1的文档，students数组包含多个元素中存在school键且值为102的元素，$elemMatch只返回一个匹配条件的元素。\r\n\r\n_id为3中的文档，因为students数组中元素无法匹配$elemMatch条件，所以查询结果不包含&quot;students&quot;字段。\r\n\r\n\r\n\r\n \r\n\r\n$elemMatch可以指定多个字段的限定条件，下面的操作将查询邮政编码键值是63109的所有文档。 $elemMatch操作符将返回 students数组中的第一个匹配条件（内嵌文档的school键且值为102且age键值大于10）的元素。\r\n\r\ndb.school.find( { zipcode: 63109 },{ students: { $elemMatch: { school: 102, age: { $gt: 10} } } } );\r\n_id等于3 和4的文档，因为students数组中没有元素匹配的$elemMatch条件，查询结果不包含“ students”字段。\r\n', '/static/uploads/20160318/56ebad0fe120b.png', '1', '0', '0', '0', '1', '1458283032', '1', '1458283032', '0');
INSERT INTO `my_article` VALUES ('13', '21212', '', '', '1', '0', '0', '0', '1', '1464835501', '2', '1464835501', '2');
INSERT INTO `my_article` VALUES ('14', '121212', '12121212121212121212', '', '1', '0', '0', '0', '1', '1464835641', '2', '1464835641', '2');
INSERT INTO `my_article` VALUES ('15', '我的测试数据', '123123123123123', '', '1', '0', '0', '0', '1', '1464836072', '2', '1464836072', '2');
INSERT INTO `my_article` VALUES ('16', '121212', '12121212', '', '1', '0', '0', '0', '1', '1464836128', '2', '1464836128', '2');
INSERT INTO `my_article` VALUES ('17', '1212121212', '1212121212', '', '1', '0', '0', '0', '1', '1464836254', '2', '1464836254', '2');
INSERT INTO `my_article` VALUES ('18', '121212', '1212121', '', '1', '0', '0', '0', '1', '1464837486', '2', '1464837486', '2');
INSERT INTO `my_article` VALUES ('19', '12121212', '121212121212', '/static/uploads/201606/8674665223082153551.png', '1', '0', '0', '0', '1', '1464850148', '1', '1464850148', '1');
INSERT INTO `my_article` VALUES ('20', '12121212', '12121212', '/static/uploads/201606/5577006791947779410.png', '1', '0', '0', '0', '1', '1464857975', '2', '1464857975', '2');
INSERT INTO `my_article` VALUES ('21', '1212', '121212', '/static/uploads/201606/5577006791947779410.jpg', '1', '0', '0', '0', '1', '1465292314', '2', '1465292314', '2');

-- ----------------------------
-- Table structure for my_auth_child
-- ----------------------------
DROP TABLE IF EXISTS `my_auth_child`;
CREATE TABLE `my_auth_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `jc_auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `my_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `jc_auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `my_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of my_auth_child
-- ----------------------------
INSERT INTO `my_auth_child` VALUES ('admin', '/1/index');
INSERT INTO `my_auth_child` VALUES ('admin', '/1/search');
INSERT INTO `my_auth_child` VALUES ('admin', '/1/update');
INSERT INTO `my_auth_child` VALUES ('admin', '/admin/admin/index');
INSERT INTO `my_auth_child` VALUES ('user', '/admin/admin/index');
INSERT INTO `my_auth_child` VALUES ('admin', '/admin/admin/login');
INSERT INTO `my_auth_child` VALUES ('tourist', '/admin/admin/login');
INSERT INTO `my_auth_child` VALUES ('user', '/admin/admin/login');
INSERT INTO `my_auth_child` VALUES ('admin', '/admin/admin/search');
INSERT INTO `my_auth_child` VALUES ('user', '/admin/admin/search');
INSERT INTO `my_auth_child` VALUES ('admin', '/admin/admin/update');
INSERT INTO `my_auth_child` VALUES ('user', '/admin/admin/update');
INSERT INTO `my_auth_child` VALUES ('admin', '/admin/auth/index');
INSERT INTO `my_auth_child` VALUES ('admin', '/admin/auth/search');
INSERT INTO `my_auth_child` VALUES ('admin', '/admin/auth/update');
INSERT INTO `my_auth_child` VALUES ('user', '/admin/auth/update');
INSERT INTO `my_auth_child` VALUES ('admin', '/admin/image/index');
INSERT INTO `my_auth_child` VALUES ('admin', '/admin/image/search');
INSERT INTO `my_auth_child` VALUES ('admin', '/admin/image/update');
INSERT INTO `my_auth_child` VALUES ('admin', '/admin/menu/index');
INSERT INTO `my_auth_child` VALUES ('admin', '/admin/menu/search');
INSERT INTO `my_auth_child` VALUES ('admin', '/admin/menu/update');
INSERT INTO `my_auth_child` VALUES ('admin', '/admin/module/create');
INSERT INTO `my_auth_child` VALUES ('admin', '/admin/module/index');
INSERT INTO `my_auth_child` VALUES ('admin', '/admin/role/allocation');
INSERT INTO `my_auth_child` VALUES ('user', '/admin/role/allocation');
INSERT INTO `my_auth_child` VALUES ('admin', '/admin/role/create');
INSERT INTO `my_auth_child` VALUES ('user', '/admin/role/create');
INSERT INTO `my_auth_child` VALUES ('admin', '/admin/role/index');
INSERT INTO `my_auth_child` VALUES ('user', '/admin/role/index');
INSERT INTO `my_auth_child` VALUES ('admin', '/admin/role/search');
INSERT INTO `my_auth_child` VALUES ('user', '/admin/role/search');
INSERT INTO `my_auth_child` VALUES ('admin', '/admin/role/update');
INSERT INTO `my_auth_child` VALUES ('user', '/admin/role/update');
INSERT INTO `my_auth_child` VALUES ('admin', '/admin/role/view');
INSERT INTO `my_auth_child` VALUES ('user', '/admin/role/view');
INSERT INTO `my_auth_child` VALUES ('admin', 'deleteAuth');
INSERT INTO `my_auth_child` VALUES ('admin', 'deleteRole');
INSERT INTO `my_auth_child` VALUES ('admin', 'deleteUser');
INSERT INTO `my_auth_child` VALUES ('user', 'deleteUser');
INSERT INTO `my_auth_child` VALUES ('admin', 'updateAuth');

-- ----------------------------
-- Table structure for my_auth_item
-- ----------------------------
DROP TABLE IF EXISTS `my_auth_item`;
CREATE TABLE `my_auth_item` (
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '权限或者角色名',
  `type` tinyint(2) NOT NULL DEFAULT '1' COMMENT '类型 1 角色 2 权限',
  `desc` varchar(255) NOT NULL DEFAULT '' COMMENT '说明信息',
  `data` varchar(255) DEFAULT NULL COMMENT '其他配置信息',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL,
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='权限和角色信息表';

-- ----------------------------
-- Records of my_auth_item
-- ----------------------------
INSERT INTO `my_auth_item` VALUES ('/1/index', '2', '图片管理显示', null, '1467373482', '1467373482');
INSERT INTO `my_auth_item` VALUES ('/1/search', '2', '图片管理搜索', null, '1467373482', '1467373482');
INSERT INTO `my_auth_item` VALUES ('/1/update', '2', '图片管理编辑', null, '1467373482', '1467373482');
INSERT INTO `my_auth_item` VALUES ('/admin/admin/index', '2', '管理员信息显示', null, '1467103547', '1467103547');
INSERT INTO `my_auth_item` VALUES ('/admin/admin/login', '2', '管理员欢迎页面显示', null, '1467191163', '1467191163');
INSERT INTO `my_auth_item` VALUES ('/admin/admin/search', '2', '管理员信息搜索', null, '1467103592', '1467103592');
INSERT INTO `my_auth_item` VALUES ('/admin/admin/update', '2', '管理员信息编辑', null, '1467103571', '1467103571');
INSERT INTO `my_auth_item` VALUES ('/admin/auth/index', '2', '权限管理显示', null, '1467103726', '1467103726');
INSERT INTO `my_auth_item` VALUES ('/admin/auth/search', '2', '权限信息搜索', null, '1467103781', '1467103781');
INSERT INTO `my_auth_item` VALUES ('/admin/auth/update', '2', '权限信息编辑', null, '1467103757', '1467103757');
INSERT INTO `my_auth_item` VALUES ('/admin/image/index', '2', '图片管理显示', null, '1467372709', '1467372709');
INSERT INTO `my_auth_item` VALUES ('/admin/image/search', '2', '图片管理搜索', null, '1467372709', '1467372709');
INSERT INTO `my_auth_item` VALUES ('/admin/image/update', '2', '图片管理编辑', null, '1467372709', '1467372709');
INSERT INTO `my_auth_item` VALUES ('/admin/menu/index', '2', '导航栏目显示', null, '1467082001', '1467082001');
INSERT INTO `my_auth_item` VALUES ('/admin/menu/search', '2', '导航栏目搜索', null, '1467082050', '1467082050');
INSERT INTO `my_auth_item` VALUES ('/admin/menu/update', '2', '导航栏目编辑', null, '1467082073', '1467082073');
INSERT INTO `my_auth_item` VALUES ('/admin/module/create', '2', '模块生成编辑', null, '1467103886', '1467103886');
INSERT INTO `my_auth_item` VALUES ('/admin/module/index', '2', '模块生成显示', null, '1467103861', '1467103861');
INSERT INTO `my_auth_item` VALUES ('/admin/role/allocation', '2', '角色权限分配', null, '1467279058', '1467279058');
INSERT INTO `my_auth_item` VALUES ('/admin/role/create', '2', '角色分配权限操作', null, '1467280201', '1467347971');
INSERT INTO `my_auth_item` VALUES ('/admin/role/index', '2', '角色管理显示', null, '1467103645', '1467103645');
INSERT INTO `my_auth_item` VALUES ('/admin/role/search', '2', '角色信息搜索', null, '1467103694', '1467103694');
INSERT INTO `my_auth_item` VALUES ('/admin/role/update', '2', '角色管理编辑', null, '1467103674', '1467351824');
INSERT INTO `my_auth_item` VALUES ('/admin/role/view', '2', '角色信息详情', null, '1467351856', '1467351856');
INSERT INTO `my_auth_item` VALUES ('admin', '1', '超级管理员', null, '1467081917', '1467081917');
INSERT INTO `my_auth_item` VALUES ('deleteAuth', '2', '删除权限的权限', null, '1467274356', '1467274356');
INSERT INTO `my_auth_item` VALUES ('deleteRole', '2', '删除角色信息权限', null, '1467274307', '1467274307');
INSERT INTO `my_auth_item` VALUES ('deleteUser', '2', '删除管理员权限', null, '1467274151', '1467274151');
INSERT INTO `my_auth_item` VALUES ('tourist', '1', '普通游客', null, '1467279464', '1467367815');
INSERT INTO `my_auth_item` VALUES ('updateAuth', '2', '权限信息操作', null, '1467351871', '1467351871');
INSERT INTO `my_auth_item` VALUES ('user', '1', '普通管理员', null, '1467081958', '1467366334');

-- ----------------------------
-- Table structure for my_category
-- ----------------------------
DROP TABLE IF EXISTS `my_category`;
CREATE TABLE `my_category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '分类ID',
  `pid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '父类ID(0最高级)',
  `path` varchar(255) NOT NULL DEFAULT '0' COMMENT '分类路径',
  `cate_name` varchar(255) NOT NULL COMMENT '分类名称',
  `sort` int(11) NOT NULL DEFAULT '1' COMMENT '分类排序',
  `recommend` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否为推荐',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '分类状态(1启用2 停用)',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `create_id` int(11) NOT NULL COMMENT '创建用户',
  `update_time` int(11) NOT NULL COMMENT '修改时间',
  `update_id` int(11) NOT NULL COMMENT '修改者',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COMMENT='文章分类信息表';

-- ----------------------------
-- Records of my_category
-- ----------------------------
INSERT INTO `my_category` VALUES ('1', '0', '', '新闻公告', '1', '1', '1', '1453270463', '0', '1465961101', '1');
INSERT INTO `my_category` VALUES ('2', '0', '', '游戏资料', '2', '1', '1', '1450921203', '0', '0', '1');
INSERT INTO `my_category` VALUES ('3', '0', '', '游戏攻略', '3', '1', '1', '1450921233', '0', '1465977462', '1');
INSERT INTO `my_category` VALUES ('4', '1', '0', '公告', '1', '1', '1', '1450921565', '0', '0', '0');
INSERT INTO `my_category` VALUES ('5', '1', '0', '新闻', '2', '1', '1', '1450921585', '0', '0', '0');
INSERT INTO `my_category` VALUES ('6', '1', '0', '活动', '3', '1', '1', '1450921606', '0', '0', '0');
INSERT INTO `my_category` VALUES ('7', '2', '0', '新手指南', '1', '1', '1', '1450921661', '0', '0', '0');
INSERT INTO `my_category` VALUES ('8', '2', '0', '系统介绍', '2', '1', '1', '1450921705', '0', '0', '0');
INSERT INTO `my_category` VALUES ('9', '2', '0', '高手进阶', '3', '1', '1', '1450921730', '0', '0', '0');
INSERT INTO `my_category` VALUES ('10', '2', '0', '特色玩法', '4', '1', '1', '1450921749', '0', '0', '0');
INSERT INTO `my_category` VALUES ('11', '0', '', '攻略指南', '1', '1', '1', '1450921885', '0', '1465960979', '1');
INSERT INTO `my_category` VALUES ('12', '0', '0', '我的测试数据', '1', '1', '1', '1453195665', '1', '1466042008', '1');
INSERT INTO `my_category` VALUES ('13', '11', '0', '测试数据3451', '1', '0', '1', '1456736196', '1', '1465960530', '1');
INSERT INTO `my_category` VALUES ('14', '3', '', '测试数据', '2', '1', '1', '1465701355', '0', '1465790127', '0');
INSERT INTO `my_category` VALUES ('15', '13', '', '我的测数据111', '100', '1', '1', '1465803976', '0', '1465803976', '0');
INSERT INTO `my_category` VALUES ('16', '0', '', '12121212', '100', '100', '1', '1465988375', '0', '1465988375', '0');

-- ----------------------------
-- Table structure for my_image
-- ----------------------------
DROP TABLE IF EXISTS `my_image`;
CREATE TABLE `my_image` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT '' COMMENT '图片标题',
  `desc` varchar(255) DEFAULT NULL COMMENT '图片描述',
  `url` varchar(100) DEFAULT NULL COMMENT '图片地址',
  `type` tinyint(1) DEFAULT NULL COMMENT '图片类型（1 首页轮播图片 2 首页广告图片）',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '图片状态',
  `sort` tinyint(4) NOT NULL DEFAULT '100' COMMENT '图片排序',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `create_id` int(11) NOT NULL COMMENT '创建用户',
  `update_time` int(11) NOT NULL COMMENT '修改时间',
  `update_id` int(11) NOT NULL COMMENT '修改用户',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='图片信息';

-- ----------------------------
-- Records of my_image
-- ----------------------------
INSERT INTO `my_image` VALUES ('2', '我的博客哦02', '我的博客哦02', '/static/uploads/20160316/56e92c3f17a22.jpg', '1', '1', '2', '1458121795', '1', '1458121795', '1');
INSERT INTO `my_image` VALUES ('3', '我的图片03', '我的图片03', '/static/uploads/20160317/56ea162c15326.jpg', '1', '1', '3', '1458181681', '1', '1458181681', '1');
INSERT INTO `my_image` VALUES ('4', '我的测试文件哦！', '呵呵', '/static/uploads/20160318/56ebe0e8b951d.jpg', '2', '1', '100', '1458299436', '2', '1458299436', '2');
INSERT INTO `my_image` VALUES ('5', '121212', '121212', '/static/uploads/201606/5577006791947779410.png', '2', '1', '100', '1464850099', '1', '1464850099', '1');

-- ----------------------------
-- Table structure for my_menu
-- ----------------------------
DROP TABLE IF EXISTS `my_menu`;
CREATE TABLE `my_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '栏目ID',
  `pid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '父类ID(只支持两级分类)',
  `menu_name` varchar(50) NOT NULL COMMENT '栏目名称',
  `icons` varchar(50) NOT NULL DEFAULT 'icon-desktop' COMMENT '使用的icons',
  `url` varchar(50) DEFAULT NULL COMMENT '访问地址',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态（1启用 0 停用）',
  `sort` int(4) NOT NULL DEFAULT '100' COMMENT '排序字段',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `create_id` int(11) NOT NULL DEFAULT '0' COMMENT '创建用户',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '修改时间',
  `update_id` int(11) NOT NULL DEFAULT '0' COMMENT '修改用户',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='使用SimpliQ的样式的导航栏样式';

-- ----------------------------
-- Records of my_menu
-- ----------------------------
INSERT INTO `my_menu` VALUES ('1', '0', '后台管理', ' icon-cog', '#', '1', '1', '1467007846', '2', '1467007846', '2');
INSERT INTO `my_menu` VALUES ('2', '1', '导航栏目', ' icon-align-justify', '/admin/menu/index', '1', '100', '1467008425', '2', '1467008594', '2');
INSERT INTO `my_menu` VALUES ('3', '1', '管理员信息', ' icon-user', '/admin/admin/index', '1', '2', '1467009023', '2', '1467009023', '2');
INSERT INTO `my_menu` VALUES ('4', '1', '权限管理', 'icon-fire', '/admin/auth/index', '1', '3', '1467009344', '2', '1467104026', '2');
INSERT INTO `my_menu` VALUES ('5', '1', '角色管理', 'icon-flag', '/admin/role/index', '1', '2', '1467009415', '2', '1467009415', '2');
INSERT INTO `my_menu` VALUES ('6', '1', '模块生成', ' icon-magic', '/admin/module/index', '1', '101', '1467010590', '2', '1467010590', '2');
INSERT INTO `my_menu` VALUES ('12', '0', '图片管理', 'icon-cog', '/admin/image/index', '1', '100', '1467372709', '1', '1467372709', '1');

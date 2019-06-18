-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2019-05-13 11:03:32
-- 服务器版本： 5.5.62-0ubuntu0.14.04.1
-- PHP 版本： 5.5.9-1ubuntu4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `jol`
--

-- --------------------------------------------------------

--
-- 表的结构 `blog`
--

CREATE TABLE `blog` (
  `blog_id` int(11) NOT NULL COMMENT '文章id',
  `title` varchar(100) CHARACTER SET utf8 NOT NULL COMMENT '文章标题',
  `content` text CHARACTER SET utf8 NOT NULL COMMENT '文章内容',
  `language` int(11) NOT NULL DEFAULT '-1' COMMENT '题解文章采用的编程语言描述',
  `problem_id` int(11) NOT NULL COMMENT '题解文章针对的题目id',
  `user_id` varchar(48) CHARACTER SET utf8 NOT NULL COMMENT '发布者用户id',
  `post_time` datetime NOT NULL COMMENT '发布时间',
  `status` int(2) NOT NULL COMMENT '删除等状态',
  `hq` int(2) NOT NULL DEFAULT '0',
  `nice` int(11) NOT NULL COMMENT '点赞数',
  `scan` int(11) NOT NULL COMMENT '浏览量'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `blog_comment`
--

CREATE TABLE `blog_comment` (
  `comment_id` int(11) NOT NULL COMMENT '文章评论的留言id',
  `discuss_id` int(11) NOT NULL COMMENT '该留言针对的文章评论id',
  `user_id` varchar(48) NOT NULL COMMENT '发布者用户id',
  `content` text NOT NULL COMMENT '留言内容',
  `status` int(2) NOT NULL COMMENT '删除等状态',
  `post_time` datetime NOT NULL COMMENT '发布时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `blog_discuss`
--

CREATE TABLE `blog_discuss` (
  `discuss_id` int(11) NOT NULL COMMENT '文章评论id',
  `blog_id` int(11) NOT NULL COMMENT '该评论针对的文章id',
  `user_id` varchar(48) NOT NULL COMMENT '发布者用户id',
  `content` text NOT NULL COMMENT '评论内容',
  `status` int(2) NOT NULL COMMENT '删除等状态',
  `nice` int(11) NOT NULL COMMENT '点赞数',
  `post_time` datetime NOT NULL COMMENT '发布时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `broadcast`
--

CREATE TABLE `broadcast` (
  `mail_id` int(11) DEFAULT NULL,
  `user_id` varchar(48) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL COMMENT '留言自增id',
  `user_id` varchar(48) NOT NULL COMMENT '此留言的用户id',
  `post_time` datetime NOT NULL COMMENT '发布时间',
  `content` text NOT NULL COMMENT '留言内容',
  `discuss_id` int(11) NOT NULL COMMENT '此留言针对的讨论id',
  `status` int(2) NOT NULL COMMENT '删除等状态（默认1，目前没有其他状态）',
  `inform_user_id` varchar(48) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `compileinfo`
--

CREATE TABLE `compileinfo` (
  `solution_id` int(11) NOT NULL DEFAULT '0',
  `error` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `contest`
--

CREATE TABLE `contest` (
  `contest_id` int(11) NOT NULL COMMENT '比赛id',
  `ctype` varchar(50) NOT NULL DEFAULT 'main',
  `title` varchar(255) DEFAULT NULL COMMENT '比赛名称',
  `start_time` datetime DEFAULT NULL COMMENT '比赛开始时间',
  `end_time` datetime DEFAULT NULL COMMENT '比赛结束时间',
  `defunct` char(1) NOT NULL DEFAULT 'N',
  `description` text COMMENT '详细描述',
  `private` tinyint(4) NOT NULL DEFAULT '0' COMMENT '比赛公开或私有',
  `langmask` int(11) NOT NULL DEFAULT '0' COMMENT 'bits for LANG to mask',
  `password` char(16) NOT NULL DEFAULT '' COMMENT '私有比赛密码'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `contest_problem`
--

CREATE TABLE `contest_problem` (
  `problem_id` int(11) NOT NULL DEFAULT '0',
  `contest_id` int(11) DEFAULT NULL,
  `title` char(200) NOT NULL DEFAULT '',
  `num` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `cpn_pending`
--

CREATE TABLE `cpn_pending` (
  `id` int(15) NOT NULL,
  `compname` varchar(100) NOT NULL,
  `loginemail` varchar(50) NOT NULL,
  `pwd` varchar(32) NOT NULL,
  `reg_time` datetime NOT NULL,
  `ip` varchar(20) NOT NULL,
  `token` varchar(50) NOT NULL,
  `token_exptime` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='企业用户正在验证中';

-- --------------------------------------------------------

--
-- 表的结构 `custominput`
--

CREATE TABLE `custominput` (
  `solution_id` int(11) NOT NULL DEFAULT '0',
  `input_text` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `discuss`
--

CREATE TABLE `discuss` (
  `discuss_id` int(11) NOT NULL COMMENT '讨论id',
  `content` text NOT NULL COMMENT '讨论内容',
  `status` int(2) NOT NULL COMMENT '删除等状态',
  `nice` int(11) DEFAULT NULL COMMENT '点赞数',
  `problem_id` int(11) NOT NULL COMMENT '此讨论针对的题目id',
  `user_id` varchar(48) NOT NULL COMMENT '发布讨论的用户id',
  `post_time` datetime NOT NULL COMMENT '发布时间',
  `inform_user_id` varchar(48) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `friend_link`
--

CREATE TABLE `friend_link` (
  `link_id` int(11) NOT NULL,
  `url` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `goods`
--

CREATE TABLE `goods` (
  `name_goods` varchar(50) NOT NULL,
  `id_goods` int(10) NOT NULL,
  `amount` varchar(20) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `goods`
--

INSERT INTO `goods` (`name_goods`, `id_goods`, `amount`, `status`) VALUES
('VIP学习系统-C语言课程1个月', 100101, '89', 1),
('VIP学习系统-C语言课程3个月', 100103, '239', 1),
('VIP学习系统-C语言课程6个月', 100106, '379', 1),
('VIP学习系统-C语言课程12个月', 100112, '539', 1),
('VIP学习系统-C++课程1个月', 200101, '139', 1),
('VIP学习系统-C++课程6个月', 200106, '589', 1),
('VIP学习系统-C++课程12个月', 200112, '839', 1),
('VIP学习系统-算法课程1个月', 300101, '189', 1),
('VIP学习系统-算法课程6个月', 300106, '799', 1),
('VIP学习系统-算法课程12个月', 300112, '1139', 1);

-- --------------------------------------------------------

--
-- 表的结构 `job_list`
--

CREATE TABLE `job_list` (
  `id` int(15) NOT NULL,
  `compname` varchar(100) NOT NULL,
  `cpnuser` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `release_time` datetime NOT NULL,
  `position` varchar(90) NOT NULL,
  `place` varchar(30) NOT NULL,
  `propt` varchar(30) NOT NULL,
  `salary` varchar(30) NOT NULL,
  `salary_min` int(15) NOT NULL,
  `salary_max` int(15) NOT NULL,
  `exp` varchar(30) NOT NULL,
  `edu` varchar(30) NOT NULL,
  `descrp` varchar(4500) NOT NULL,
  `status` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='发布的招聘';

-- --------------------------------------------------------

--
-- 表的结构 `job_list_modify`
--

CREATE TABLE `job_list_modify` (
  `id` int(15) NOT NULL,
  `compname` varchar(100) NOT NULL,
  `cpnuser` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `release_time` datetime NOT NULL,
  `position` varchar(90) NOT NULL,
  `place` varchar(30) NOT NULL,
  `propt` varchar(30) NOT NULL,
  `salary` varchar(30) NOT NULL,
  `salary_min` int(15) NOT NULL,
  `salary_max` int(15) NOT NULL,
  `exp` varchar(30) NOT NULL,
  `edu` varchar(30) NOT NULL,
  `descrp` varchar(4500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='发布的招聘重编辑待审核';

-- --------------------------------------------------------

--
-- 表的结构 `liveshow`
--

CREATE TABLE `liveshow` (
  `id` int(8) NOT NULL,
  `state` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `teacher` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `url` varchar(80) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'live.html'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `loginlog`
--

CREATE TABLE `loginlog` (
  `user_id` varchar(48) NOT NULL DEFAULT '',
  `password` varchar(40) DEFAULT NULL,
  `ip` varchar(100) DEFAULT NULL,
  `time` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `mail`
--

CREATE TABLE `mail` (
  `mail_id` int(11) NOT NULL COMMENT '站内信id',
  `to_user` varchar(48) NOT NULL DEFAULT '' COMMENT '发送目标用户id',
  `from_user` varchar(48) NOT NULL DEFAULT '' COMMENT '发送者用户id',
  `title` varchar(200) NOT NULL DEFAULT '' COMMENT '信息标题',
  `content` text COMMENT '信息内容',
  `new_mail` tinyint(1) NOT NULL DEFAULT '1',
  `reply` tinyint(4) DEFAULT '0',
  `in_date` datetime DEFAULT NULL,
  `defunct` char(1) NOT NULL DEFAULT 'N'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `news`
--

CREATE TABLE `news` (
  `news_id` int(11) NOT NULL,
  `user_id` varchar(48) NOT NULL DEFAULT '',
  `title` varchar(200) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `importance` tinyint(4) NOT NULL DEFAULT '0',
  `defunct` char(1) NOT NULL DEFAULT 'N'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `online`
--

CREATE TABLE `online` (
  `hash` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(20) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `ua` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `refer` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastmove` int(10) NOT NULL,
  `firsttime` int(10) DEFAULT NULL,
  `uri` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MEMORY DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `order_vippay`
--

CREATE TABLE `order_vippay` (
  `order_id` varchar(20) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `user_id` varchar(48) NOT NULL,
  `pay_time` datetime NOT NULL,
  `pay_amount` varchar(20) NOT NULL,
  `goods` varchar(48) NOT NULL,
  `goods_id` varchar(11) NOT NULL,
  `descrp` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='支付订单';

-- --------------------------------------------------------

--
-- 表的结构 `others`
--

CREATE TABLE `others` (
  `attr_name` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `attr_value` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `others`
--

INSERT INTO `others` (`attr_name`, `attr_value`) VALUES
('mark0', '编程练习'),
('mark1', '计算机二级考试'),
('mark2', 'ACM训练'),
('mark3', 'OI赛题'),
('mark4', 'PAT题'),
('mark5', '数据结构训练'),
('mark6', '蓝桥杯训练'),
('mark7', '名校训练');

-- --------------------------------------------------------

--
-- 表的结构 `privilege`
--

CREATE TABLE `privilege` (
  `user_id` char(48) NOT NULL DEFAULT '',
  `rightstr` char(30) NOT NULL DEFAULT '' COMMENT '该用户的权限',
  `defunct` char(1) NOT NULL DEFAULT 'N'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `problem`
--

CREATE TABLE `problem` (
  `problem_id` int(11) NOT NULL COMMENT '题目id',
  `title` varchar(200) NOT NULL DEFAULT '' COMMENT '题目标题',
  `description` text COMMENT '题目详细描述',
  `input` text COMMENT '输入格式（在题目内页显示，与题目描述意义相似）',
  `output` text COMMENT '输出格式（在题目内页显示，与题目描述意义相似）',
  `sample_input` text COMMENT '样例输入（在题目内页显示，与题目描述意义相似）',
  `sample_output` text COMMENT '样例输出（在题目内页显示，与题目描述意义相似）',
  `spj` char(1) NOT NULL DEFAULT '0',
  `hint` text COMMENT '题目提示',
  `source` varchar(100) DEFAULT NULL COMMENT '题目来源',
  `in_date` datetime DEFAULT NULL,
  `time_limit` int(11) NOT NULL DEFAULT '0' COMMENT '时限',
  `memory_limit` int(11) NOT NULL DEFAULT '0' COMMENT '内存限制',
  `defunct` char(1) NOT NULL DEFAULT 'N',
  `vip` int(2) NOT NULL,
  `accepted` int(11) DEFAULT '0' COMMENT '答题通过数',
  `submit` int(11) DEFAULT '0' COMMENT '答题提交数',
  `solved` int(11) DEFAULT '0',
  `mark` int(2) DEFAULT '-1' COMMENT '分类标签',
  `difficulty` int(2) DEFAULT '-1' COMMENT '难度标签'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `resume`
--

CREATE TABLE `resume` (
  `user_id` varchar(48) NOT NULL,
  `name` varchar(30) NOT NULL,
  `age` int(10) NOT NULL,
  `sex` varchar(5) NOT NULL,
  `birth` varchar(30) NOT NULL,
  `address` varchar(300) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `school` varchar(50) NOT NULL,
  `edu` varchar(30) NOT NULL,
  `gra` varchar(30) NOT NULL,
  `prize` varchar(900) NOT NULL,
  `skill` varchar(900) NOT NULL,
  `lang` varchar(900) NOT NULL,
  `jobs` varchar(900) NOT NULL,
  `descrp` varchar(900) NOT NULL,
  `photo` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='简历';

-- --------------------------------------------------------

--
-- 表的结构 `resume_send`
--

CREATE TABLE `resume_send` (
  `send_id` int(11) NOT NULL,
  `user_id` varchar(48) NOT NULL,
  `job_id` int(11) NOT NULL,
  `send_time` datetime NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='简历投递记录';

-- --------------------------------------------------------

--
-- 表的结构 `runtimeinfo`
--

CREATE TABLE `runtimeinfo` (
  `solution_id` int(11) NOT NULL DEFAULT '0',
  `error` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `sim`
--

CREATE TABLE `sim` (
  `s_id` int(11) NOT NULL,
  `sim_s_id` int(11) DEFAULT NULL,
  `sim` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `solution`
--

CREATE TABLE `solution` (
  `solution_id` int(11) NOT NULL COMMENT '提交结果状态id',
  `problem_id` int(11) NOT NULL DEFAULT '0' COMMENT '该次提交针对的题目id',
  `user_id` char(48) NOT NULL COMMENT '提交者用户id',
  `time` int(11) NOT NULL DEFAULT '0' COMMENT '耗时',
  `memory` int(11) NOT NULL DEFAULT '0' COMMENT '内存',
  `in_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `result` smallint(6) NOT NULL DEFAULT '0' COMMENT 'judge结果',
  `language` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '编程语言',
  `ip` char(15) NOT NULL,
  `contest_id` int(11) DEFAULT NULL COMMENT '该次提交针对的比赛id',
  `valid` tinyint(4) NOT NULL DEFAULT '1',
  `num` tinyint(4) NOT NULL DEFAULT '-1',
  `code_length` int(11) NOT NULL DEFAULT '0' COMMENT '代码长度',
  `judgetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'judge时间',
  `pass_rate` decimal(2,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `lint_error` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `judger` char(16) NOT NULL DEFAULT 'LOCAL'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `source_code`
--

CREATE TABLE `source_code` (
  `solution_id` int(11) NOT NULL COMMENT '提交结果状态id',
  `source` text NOT NULL COMMENT '提交的源代码文本'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `tutorial`
--

CREATE TABLE `tutorial` (
  `class_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `section` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE `users` (
  `user_id` varchar(48) NOT NULL DEFAULT '',
  `email` varchar(100) DEFAULT NULL COMMENT '用户邮箱',
  `vip_end` datetime NOT NULL,
  `vip_end_cpp` datetime NOT NULL,
  `vip_end_suanfa` datetime NOT NULL,
  `user_exp` int(11) NOT NULL,
  `user_lvl` int(11) NOT NULL DEFAULT '0',
  `blog_cnt` int(11) NOT NULL,
  `submit` int(11) DEFAULT '0' COMMENT '提交总量',
  `solved` int(11) DEFAULT '0' COMMENT '题目解决数量',
  `defunct` char(1) NOT NULL DEFAULT 'N',
  `ip` varchar(20) NOT NULL DEFAULT '',
  `accesstime` datetime DEFAULT NULL,
  `volume` int(11) NOT NULL DEFAULT '1',
  `language` int(11) NOT NULL DEFAULT '1',
  `password` varchar(32) DEFAULT NULL,
  `reg_time` datetime DEFAULT NULL COMMENT '注册时间',
  `user_sign` varchar(100) NOT NULL DEFAULT '' COMMENT '签名',
  `user_intro` varchar(600) NOT NULL COMMENT '自我简介',
  `school` varchar(100) NOT NULL DEFAULT '' COMMENT '院校',
  `nick` varchar(48) NOT NULL DEFAULT '' COMMENT '昵称',
  `subject` varchar(20) NOT NULL DEFAULT '' COMMENT '专业',
  `phone` varchar(13) NOT NULL DEFAULT '' COMMENT '电话',
  `address` varchar(100) NOT NULL DEFAULT '' COMMENT '地址',
  `age` int(2) NOT NULL COMMENT '年龄',
  `work_field` varchar(20) NOT NULL DEFAULT '',
  `is_work` int(2) NOT NULL COMMENT '工作状况',
  `scan` int(11) NOT NULL COMMENT '个人主页访问量',
  `last_nick_time` datetime NOT NULL COMMENT '修改昵称最后时间',
  `mail_verify` varchar(1) NOT NULL DEFAULT 'N',
  `order_contest` text NOT NULL COMMENT '预约过的比赛',
  `vipclass_unlock` text NOT NULL COMMENT 'VIP课程解锁'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `users_cpn`
--

CREATE TABLE `users_cpn` (
  `cpnuser` varchar(100) NOT NULL,
  `compname` varchar(100) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `address` varchar(100) NOT NULL,
  `website` varchar(50) NOT NULL,
  `industry` varchar(20) NOT NULL,
  `stage` varchar(30) NOT NULL,
  `size` varchar(30) NOT NULL,
  `reg_time` datetime NOT NULL,
  `ip` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `token` varchar(50) NOT NULL,
  `status` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='企业用户';

-- --------------------------------------------------------

--
-- 表的结构 `vipclass`
--

CREATE TABLE `vipclass` (
  `class_id` int(11) NOT NULL,
  `lock_id` int(11) NOT NULL,
  `section` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descrp` text COLLATE utf8_unicode_ci NOT NULL,
  `video` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `vipclass_problem`
--

CREATE TABLE `vipclass_problem` (
  `class_id` int(11) DEFAULT NULL,
  `problem_id` int(11) NOT NULL,
  `num` int(2) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `vip_paykey`
--

CREATE TABLE `vip_paykey` (
  `paykey` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `end_time` datetime NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `type` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `amount` varchar(12) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `create_time` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转储表的索引
--

--
-- 表的索引 `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`blog_id`),
  ADD KEY `blog_id` (`blog_id`),
  ADD KEY `blog_id_2` (`blog_id`);

--
-- 表的索引 `blog_comment`
--
ALTER TABLE `blog_comment`
  ADD PRIMARY KEY (`comment_id`);

--
-- 表的索引 `blog_discuss`
--
ALTER TABLE `blog_discuss`
  ADD PRIMARY KEY (`discuss_id`);

--
-- 表的索引 `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`);

--
-- 表的索引 `compileinfo`
--
ALTER TABLE `compileinfo`
  ADD PRIMARY KEY (`solution_id`);

--
-- 表的索引 `contest`
--
ALTER TABLE `contest`
  ADD PRIMARY KEY (`contest_id`);

--
-- 表的索引 `cpn_pending`
--
ALTER TABLE `cpn_pending`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `custominput`
--
ALTER TABLE `custominput`
  ADD PRIMARY KEY (`solution_id`);

--
-- 表的索引 `discuss`
--
ALTER TABLE `discuss`
  ADD PRIMARY KEY (`discuss_id`);

--
-- 表的索引 `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`id_goods`);

--
-- 表的索引 `job_list`
--
ALTER TABLE `job_list`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `job_list_modify`
--
ALTER TABLE `job_list_modify`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `liveshow`
--
ALTER TABLE `liveshow`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `mail`
--
ALTER TABLE `mail`
  ADD PRIMARY KEY (`mail_id`),
  ADD KEY `uid` (`to_user`);

--
-- 表的索引 `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_id`);

--
-- 表的索引 `online`
--
ALTER TABLE `online`
  ADD PRIMARY KEY (`hash`),
  ADD UNIQUE KEY `hash` (`hash`);

--
-- 表的索引 `order_vippay`
--
ALTER TABLE `order_vippay`
  ADD PRIMARY KEY (`order_id`);

--
-- 表的索引 `problem`
--
ALTER TABLE `problem`
  ADD PRIMARY KEY (`problem_id`);

--
-- 表的索引 `resume`
--
ALTER TABLE `resume`
  ADD PRIMARY KEY (`user_id`);

--
-- 表的索引 `resume_send`
--
ALTER TABLE `resume_send`
  ADD PRIMARY KEY (`send_id`);

--
-- 表的索引 `runtimeinfo`
--
ALTER TABLE `runtimeinfo`
  ADD PRIMARY KEY (`solution_id`);

--
-- 表的索引 `sim`
--
ALTER TABLE `sim`
  ADD PRIMARY KEY (`s_id`);

--
-- 表的索引 `solution`
--
ALTER TABLE `solution`
  ADD PRIMARY KEY (`solution_id`),
  ADD KEY `uid` (`user_id`),
  ADD KEY `pid` (`problem_id`),
  ADD KEY `res` (`result`),
  ADD KEY `cid` (`contest_id`);

--
-- 表的索引 `source_code`
--
ALTER TABLE `source_code`
  ADD PRIMARY KEY (`solution_id`);

--
-- 表的索引 `tutorial`
--
ALTER TABLE `tutorial`
  ADD PRIMARY KEY (`class_id`);

--
-- 表的索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- 表的索引 `users_cpn`
--
ALTER TABLE `users_cpn`
  ADD PRIMARY KEY (`cpnuser`);

--
-- 表的索引 `vipclass`
--
ALTER TABLE `vipclass`
  ADD PRIMARY KEY (`class_id`);

--
-- 表的索引 `vipclass_problem`
--
ALTER TABLE `vipclass_problem`
  ADD KEY `class_id` (`class_id`);

--
-- 表的索引 `vip_paykey`
--
ALTER TABLE `vip_paykey`
  ADD PRIMARY KEY (`paykey`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `blog`
--
ALTER TABLE `blog`
  MODIFY `blog_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '文章id';

--
-- 使用表AUTO_INCREMENT `blog_comment`
--
ALTER TABLE `blog_comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '文章评论的留言id';

--
-- 使用表AUTO_INCREMENT `blog_discuss`
--
ALTER TABLE `blog_discuss`
  MODIFY `discuss_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '文章评论id';

--
-- 使用表AUTO_INCREMENT `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '留言自增id';

--
-- 使用表AUTO_INCREMENT `contest`
--
ALTER TABLE `contest`
  MODIFY `contest_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '比赛id';

--
-- 使用表AUTO_INCREMENT `cpn_pending`
--
ALTER TABLE `cpn_pending`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `discuss`
--
ALTER TABLE `discuss`
  MODIFY `discuss_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '讨论id';

--
-- 使用表AUTO_INCREMENT `job_list`
--
ALTER TABLE `job_list`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `liveshow`
--
ALTER TABLE `liveshow`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `mail`
--
ALTER TABLE `mail`
  MODIFY `mail_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '站内信id';

--
-- 使用表AUTO_INCREMENT `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `problem`
--
ALTER TABLE `problem`
  MODIFY `problem_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '题目id';

--
-- 使用表AUTO_INCREMENT `resume_send`
--
ALTER TABLE `resume_send`
  MODIFY `send_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `solution`
--
ALTER TABLE `solution`
  MODIFY `solution_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '提交结果状态id';

--
-- 使用表AUTO_INCREMENT `tutorial`
--
ALTER TABLE `tutorial`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `vipclass`
--
ALTER TABLE `vipclass`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 限制导出的表
--

--
-- 限制表 `vipclass_problem`
--
ALTER TABLE `vipclass_problem`
  ADD CONSTRAINT `vipclass_problem_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `vipclass` (`class_id`);
COMMIT;

-- 分销科目与商品关联表
DROP TABLE IF EXISTS `goods_subject`;
CREATE TABLE `goods_subject` (
                                 `goods_id` int(10) DEFAULT NULL COMMENT '商品id',
                                 `subject` varchar(32) DEFAULT NULL COMMENT '科目',
                                 KEY `goods_id` (`goods_id`),
                                 KEY `subject` (`subject`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of goods_subject
-- ----------------------------
BEGIN;
INSERT INTO `goods_subject` VALUES (100101, 'c');
INSERT INTO `goods_subject` VALUES (100103, 'c');
INSERT INTO `goods_subject` VALUES (100106, 'c');
INSERT INTO `goods_subject` VALUES (100112, 'c');
INSERT INTO `goods_subject` VALUES (200101, 'cpp');
INSERT INTO `goods_subject` VALUES (200103, 'cpp');
INSERT INTO `goods_subject` VALUES (200106, 'cpp');
INSERT INTO `goods_subject` VALUES (200112, 'cpp');
INSERT INTO `goods_subject` VALUES (300101, 'suanfa');
INSERT INTO `goods_subject` VALUES (300103, 'suanfa');
INSERT INTO `goods_subject` VALUES (300106, 'suanfa');
INSERT INTO `goods_subject` VALUES (300112, 'suanfa');
COMMIT;


-- 推广码表
DROP TABLE IF EXISTS `promotion_code`;
CREATE TABLE `promotion_code` (
                                  `user_id` varchar(48) NOT NULL COMMENT '用户id',
                                  `promotion_code` varchar(8) DEFAULT NULL COMMENT '推广码',
                                  `parent_code` varchar(8) DEFAULT NULL COMMENT '上级推广码',
                                  `level` int(11) unsigned NOT NULL DEFAULT '1' COMMENT '分销xekl',
                                  `create_time` datetime NOT NULL COMMENT '创建时间',
                                  `subject` varchar(32) DEFAULT NULL COMMENT '推广科目',
                                  `state` tinyint(255) unsigned DEFAULT '1' COMMENT '状态，1为正常，0为禁用',
                                  KEY `promotion_code` (`promotion_code`),
                                  KEY `create_tim` (`create_time`),
                                  KEY `parent_id` (`parent_code`) USING BTREE,
                                  KEY `user_id` (`user_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 分销收入表
DROP TABLE IF EXISTS `distribution_amount`;
CREATE TABLE `distribution_amount` (
                                       `id` bigint(20) NOT NULL AUTO_INCREMENT,
                                       `user_id` varchar(48) DEFAULT NULL COMMENT '分销用户',
                                       `order_id` varchar(20) DEFAULT NULL COMMENT '商品id',
                                       `order_amount` int(11) DEFAULT NULL COMMENT '订单金额',
                                       `amount` int(11) DEFAULT NULL COMMENT '分销收入',
                                       `pay_user_id` varchar(48) DEFAULT NULL COMMENT '下单用户',
                                       `distribution_level` tinyint(4) DEFAULT NULL COMMENT '分销级别',
                                       `goods_id` int(10) DEFAULT NULL COMMENT '课程商品id',
                                       `settle_state` tinyint(4) DEFAULT '0' COMMENT '结算状态，0为未结算，1为已结算',
                                       `order_time` datetime NOT NULL COMMENT '下单时间',
                                       `settle_time` datetime DEFAULT NULL COMMENT '结算时间',
                                       PRIMARY KEY (`id`),
                                       KEY `user_id` (`user_id`),
                                       KEY `order_id` (`order_id`),
                                       KEY `pay_user_id` (`pay_user_id`),
                                       KEY `settle_state` (`settle_state`),
                                       KEY `order_time` (`order_time`),
                                       KEY `settle_time` (`settle_time`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- 用户添加支付宝信息
ALTER TABLE `jol`.`users`
    ADD COLUMN `alipay_account` varchar(40) NULL COMMENT '支付宝账号' AFTER `vipclass_unlock`,
    ADD COLUMN `alipay_user` varchar(40) NULL COMMENT '支付宝用户名' AFTER `alipay_account`;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

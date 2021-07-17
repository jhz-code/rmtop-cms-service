-- 导出  表 rmtop.rtop_admin 结构
CREATE TABLE IF NOT EXISTS `rtop_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL COMMENT '登陆账户',
  `password` varchar(255) DEFAULT NULL COMMENT '登录密码',
  `mobile` varchar(16) DEFAULT NULL,
  `email` varchar(120) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL COMMENT '有效状态，1正常，0禁用',
  `group_id` int(11) DEFAULT NULL,
  `loginip` varchar(20) DEFAULT NULL,
  `logintime` int(11) DEFAULT NULL,
  `logintimes` int(11) DEFAULT '0' COMMENT '登陆次数',
  `delete_time` int(11) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `lasttime` int(11) DEFAULT NULL COMMENT '所属用户组',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=63 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='管理员列表';

-- 数据导出被取消选择。

-- 导出  表 rmtop.rtop_admin_role 结构
CREATE TABLE IF NOT EXISTS `rtop_admin_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(80) DEFAULT NULL COMMENT '角色名称',
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='管理员角色列表';

-- 数据导出被取消选择。

-- 导出  表 rmtop.rtop_admin_rules 结构
CREATE TABLE IF NOT EXISTS `rtop_admin_rules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(80) DEFAULT NULL COMMENT '规则名称',
  `url` varchar(120) DEFAULT NULL COMMENT '权限URL',
  `status` int(11) DEFAULT '0' COMMENT '1 启用 0 未启用',
  `create_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='管理员权限规则';

-- 数据导出被取消选择。

-- 导出  表 rmtop.rtop_auth_group 结构
CREATE TABLE IF NOT EXISTS `rtop_auth_group` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL COMMENT '用户组名称',
  `ico` varchar(20) DEFAULT NULL COMMENT '导航图标',
  `rules` text,
  `status` tinyint(1) DEFAULT '1' COMMENT '有效状态，1启用，0禁用',
  `sort` int(11) DEFAULT '0' COMMENT '排序',
  `create_time` int(11) DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- 数据导出被取消选择。

-- 导出  表 rmtop.rtop_auth_rules 结构
CREATE TABLE IF NOT EXISTS `rtop_auth_rules` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT '0' COMMENT '上级权限规则ID',
  `title` varchar(30) DEFAULT NULL COMMENT '规则名称',
  `ico` varchar(100) DEFAULT NULL COMMENT '导航图标',
  `url` varchar(255) DEFAULT NULL COMMENT '规则地址',
  `type` tinyint(1) DEFAULT '1' COMMENT '验证类型，1实时验证，2登录验证',
  `status` tinyint(1) DEFAULT '1' COMMENT '有效状态，1启用，0禁用',
  `show` tinyint(1) DEFAULT '1' COMMENT '显示状态，1菜单显示，0菜单隐藏',
  `sort` int(11) DEFAULT NULL COMMENT '排序',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  `update_time` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COMMENT='管理权限规则';

-- 数据导出被取消选择。

-- 导出  表 rmtop.rtop_blog 结构
CREATE TABLE IF NOT EXISTS `rtop_blog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `org_img` varchar(255) DEFAULT NULL,
  `title` varchar(120) DEFAULT NULL,
  `content` text,
  `views` int(11) DEFAULT '0',
  `hot` int(11) DEFAULT '0',
  `create_time` int(11) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- 数据导出被取消选择。

-- 导出  表 rmtop.rtop_column 结构
CREATE TABLE IF NOT EXISTS `rtop_column` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT '0' COMMENT '父级别ID',
  `sort` int(10) DEFAULT '0',
  `title` varchar(100) DEFAULT NULL COMMENT '名称',
  `en_title` char(120) DEFAULT NULL COMMENT '英文别名',
  `org_img` varchar(150) DEFAULT NULL COMMENT '栏目图片',
  `type` tinyint(1) unsigned DEFAULT '1' COMMENT '栏目类型 1外部url 2内部',
  `type_url` varchar(225) DEFAULT NULL COMMENT 'url 链接',
  `directory_name` varchar(120) DEFAULT NULL COMMENT '目录名称',
  `model` varchar(80) DEFAULT NULL COMMENT '栏目模型',
  `model_title` varchar(150) DEFAULT NULL COMMENT '模型名称',
  `list_tmp` varchar(100) DEFAULT NULL COMMENT '列表模版',
  `info_tmp` varchar(100) DEFAULT NULL COMMENT '详情模板',
  `seo_title` varchar(225) DEFAULT NULL COMMENT 'Seo标题',
  `seo_key` varchar(200) DEFAULT NULL COMMENT 'Seo 关键词',
  `seo_des` text COMMENT 'Seo 描述',
  `is_show` tinyint(1) DEFAULT '0' COMMENT '1 隐藏 0 不隐藏',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- 数据导出被取消选择。

-- 导出  表 rmtop.rtop_column_model 结构
CREATE TABLE IF NOT EXISTS `rtop_column_model` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(150) DEFAULT NULL COMMENT '模型名称',
  `model_type` varchar(100) DEFAULT NULL COMMENT '模型标识',
  `sort` int(3) DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='栏目模型';

-- 数据导出被取消选择。

-- 导出  表 rmtop.rtop_config 结构
CREATE TABLE IF NOT EXISTS `rtop_config` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `zh_name` varchar(80) DEFAULT NULL COMMENT '中文名称',
  `en_name` varchar(80) DEFAULT NULL COMMENT '英文名称',
  `value` text COMMENT '配置值',
  `is_true` int(11) DEFAULT '0',
  `sort` int(11) DEFAULT '0',
  `group_id` int(11) DEFAULT '0' COMMENT '配置分组',
  `delete_time` int(11) DEFAULT NULL COMMENT '1 不可删除 0可删除',
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

-- 数据导出被取消选择。

-- 导出  表 rmtop.rtop_config_group 结构
CREATE TABLE IF NOT EXISTS `rtop_config_group` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(11) DEFAULT NULL COMMENT '分组名称',
  `sort` int(11) DEFAULT NULL COMMENT '排序',
  `ident` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- 数据导出被取消选择。

-- 导出  表 rmtop.rtop_extends_article 结构
CREATE TABLE IF NOT EXISTS `rtop_extends_article` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uqid` varchar(80) NOT NULL DEFAULT '0' COMMENT '唯一ID',
  `col_id` int(11) DEFAULT NULL COMMENT '模型标识',
  `seo_title` varchar(150) DEFAULT NULL,
  `seo_key` varchar(80) DEFAULT NULL,
  `seo_des` varchar(160) DEFAULT NULL,
  `doc_type` int(11) DEFAULT '0' COMMENT '头条 推荐 热门 其他',
  `title` varchar(200) DEFAULT NULL COMMENT '标题',
  `org_img` varchar(100) DEFAULT NULL COMMENT '首图',
  `img_lists` varchar(250) DEFAULT NULL,
  `content` text COMMENT '内容',
  `tags` varchar(250) DEFAULT '' COMMENT '标签内容',
  `view_path` varchar(100) DEFAULT NULL,
  `author` varchar(100) DEFAULT NULL,
  `access` int(11) DEFAULT '0' COMMENT '阅读权限',
  `views` int(11) DEFAULT '0',
  `create_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='模型额外信息';

-- 数据导出被取消选择。

-- 导出  表 rmtop.rtop_extends_atlas 结构
CREATE TABLE IF NOT EXISTS `rtop_extends_atlas` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uqid` varchar(80) NOT NULL DEFAULT '0',
  `col_id` varchar(100) DEFAULT NULL COMMENT '模型标识',
  `title` varchar(120) DEFAULT NULL COMMENT '图片名称',
  `org_img` varchar(120) DEFAULT NULL COMMENT '图片',
  `img_lists` varchar(255) DEFAULT NULL,
  `create_time` varchar(20) DEFAULT NULL,
  `doc_type` int(11) DEFAULT '0' COMMENT '类型',
  `tags` varchar(120) DEFAULT NULL COMMENT '标签',
  `views` int(11) DEFAULT '0' COMMENT '浏览次数',
  `author` varchar(50) DEFAULT NULL,
  `seo_title` varchar(120) DEFAULT NULL,
  `seo_key` varchar(120) DEFAULT NULL,
  `seo_des` varchar(120) DEFAULT NULL,
  `access` int(11) DEFAULT '0',
  `turl` varchar(80) DEFAULT NULL,
  `view_path` varchar(120) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- 数据导出被取消选择。

-- 导出  表 rmtop.rtop_extends_download 结构
CREATE TABLE IF NOT EXISTS `rtop_extends_download` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uqid` varchar(80) NOT NULL DEFAULT '0',
  `col_id` varchar(50) DEFAULT NULL COMMENT '模型标识',
  `title` varchar(100) DEFAULT NULL COMMENT '标题',
  `org_img` varchar(120) DEFAULT NULL COMMENT '首图',
  `img_lists` varchar(255) DEFAULT NULL,
  `file_name` varchar(120) DEFAULT NULL COMMENT '文件名',
  `file_url` varchar(150) DEFAULT NULL COMMENT '文件地址',
  `load_times` int(11) DEFAULT '0' COMMENT '下载次数',
  `content` text COMMENT '内容',
  `create_time` varchar(20) DEFAULT NULL,
  `seo_title` varchar(120) DEFAULT NULL,
  `seo_key` varchar(120) DEFAULT NULL,
  `seo_des` varchar(150) DEFAULT NULL,
  `doc_type` int(11) DEFAULT '0',
  `tags` varchar(255) DEFAULT NULL,
  `sort` int(11) DEFAULT '0',
  `view_path` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COMMENT='下载模型';

-- 数据导出被取消选择。

-- 导出  表 rmtop.rtop_extends_job 结构
CREATE TABLE IF NOT EXISTS `rtop_extends_job` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uqid` varchar(80) NOT NULL DEFAULT '0',
  `title` varchar(120) DEFAULT NULL COMMENT '标题',
  `online` int(11) DEFAULT '0' COMMENT '在线招聘 1 开启 2 关闭',
  `col_id` int(11) DEFAULT NULL COMMENT '模型标识',
  `jod_place` varchar(100) DEFAULT NULL COMMENT '工作地点',
  `edu` varchar(60) DEFAULT NULL COMMENT '学历要求',
  `salary` varchar(60) DEFAULT NULL COMMENT '薪资待遇',
  `jod_nature` varchar(60) DEFAULT NULL COMMENT '工作性质',
  `jod_years` varchar(60) DEFAULT NULL COMMENT '工作年限',
  `people` int(11) DEFAULT '0' COMMENT '招聘人数',
  `content` text COMMENT '内容',
  `seo_title` varchar(120) DEFAULT NULL,
  `seo_key` varchar(120) DEFAULT NULL,
  `seo_des` varchar(120) DEFAULT NULL,
  `view_path` varchar(120) DEFAULT NULL COMMENT '模板',
  `views` int(11) DEFAULT '0' COMMENT '浏览次数',
  `create_time` varchar(20) DEFAULT NULL,
  `hits` int(11) DEFAULT '0' COMMENT '点击',
  `sort` int(11) DEFAULT '0' COMMENT '排序',
  `tags` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COMMENT='招聘模型';

-- 数据导出被取消选择。

-- 导出  表 rmtop.rtop_extends_message 结构
CREATE TABLE IF NOT EXISTS `rtop_extends_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL COMMENT '留言姓名',
  `mobile` varchar(12) DEFAULT NULL COMMENT '手机号',
  `demand` varchar(200) DEFAULT NULL COMMENT '需求',
  `img_lists` varchar(255) DEFAULT NULL,
  `state` int(11) DEFAULT '0' COMMENT '状态',
  `create_time` varchar(20) DEFAULT NULL,
  `ip` varchar(20) DEFAULT NULL COMMENT '提交ip',
  `email` varchar(80) DEFAULT NULL,
  `col_id` int(11) DEFAULT NULL,
  `title` varchar(120) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='留言模型';

-- 数据导出被取消选择。

-- 导出  表 rmtop.rtop_extends_product 结构
CREATE TABLE IF NOT EXISTS `rtop_extends_product` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uqid` varchar(80) NOT NULL DEFAULT '0',
  `col_id` int(11) DEFAULT NULL,
  `seo_title` varchar(120) DEFAULT NULL,
  `seo_key` varchar(80) DEFAULT NULL,
  `seo_des` varchar(160) DEFAULT NULL,
  `property` varchar(30) DEFAULT '0' COMMENT '属性类别',
  `title` varchar(200) DEFAULT NULL,
  `org_img` varchar(80) DEFAULT NULL,
  `img_lists` varchar(160) DEFAULT NULL,
  `product_type` int(11) DEFAULT '0' COMMENT '产品类型',
  `content` text COMMENT '产品描述',
  `tags` varchar(100) DEFAULT '' COMMENT '产品标签',
  `view_path` varchar(160) DEFAULT NULL COMMENT '产品模版',
  `turl` varchar(160) DEFAULT NULL COMMENT '跳转url',
  `create_time` int(11) DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) DEFAULT '0' COMMENT '更新时间',
  `delete_time` int(11) DEFAULT '0' COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- 数据导出被取消选择。

-- 导出  表 rmtop.rtop_extends_product_params 结构
CREATE TABLE IF NOT EXISTS `rtop_extends_product_params` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sid` int(11) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `key` varchar(50) DEFAULT NULL,
  `title` varchar(80) DEFAULT NULL,
  `value` varchar(225) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

-- 数据导出被取消选择。

-- 导出  表 rmtop.rtop_extends_single 结构
CREATE TABLE IF NOT EXISTS `rtop_extends_single` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uqid` varchar(80) NOT NULL DEFAULT '0',
  `seo_title` varchar(255) DEFAULT NULL,
  `seo_key` varchar(255) DEFAULT NULL,
  `seo_des` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL COMMENT '单页标题',
  `img_lists` varchar(255) DEFAULT NULL,
  `text` text COMMENT '单页内容',
  `view_path` varchar(255) DEFAULT NULL COMMENT '模板',
  `views` int(11) DEFAULT '0' COMMENT '浏览次数',
  `create_time` varchar(255) DEFAULT NULL,
  `doc_type` varchar(255) DEFAULT NULL,
  `col_id` int(11) DEFAULT NULL COMMENT '模型标识',
  `author` varchar(120) DEFAULT NULL,
  `access` int(11) DEFAULT '0',
  `tags` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- 数据导出被取消选择。

-- 导出  表 rmtop.rtop_extends_single_params 结构
CREATE TABLE IF NOT EXISTS `rtop_extends_single_params` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sid` int(11) NOT NULL DEFAULT '0',
  `type` varchar(50) NOT NULL DEFAULT 'text',
  `key` varchar(50) NOT NULL DEFAULT '0',
  `title` varchar(80) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COMMENT='单面额外参数';

-- 数据导出被取消选择。

-- 导出  表 rmtop.rtop_extends_video 结构
CREATE TABLE IF NOT EXISTS `rtop_extends_video` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uqid` varchar(80) NOT NULL DEFAULT '0',
  `seo_title` varchar(120) DEFAULT NULL,
  `seo_key` varchar(120) DEFAULT NULL,
  `seo_des` varchar(255) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL COMMENT '视频标题',
  `img_lists` varchar(255) DEFAULT NULL,
  `video_url` varchar(80) DEFAULT NULL COMMENT '视频链接',
  `create_time` varchar(20) DEFAULT NULL,
  `top` int(11) DEFAULT '0' COMMENT '1 为推荐',
  `author` varchar(20) DEFAULT NULL COMMENT '作者',
  `tags` varchar(255) DEFAULT NULL COMMENT '标签',
  `views` int(11) DEFAULT '0' COMMENT '浏览量',
  `view_path` varchar(120) DEFAULT NULL COMMENT '模板',
  `org_img` varchar(150) DEFAULT NULL COMMENT '首图',
  `content` text COMMENT '内容',
  `col_id` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- 数据导出被取消选择。

-- 导出  表 rmtop.rtop_information 结构
CREATE TABLE IF NOT EXISTS `rtop_information` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uqid` varchar(80) NOT NULL DEFAULT '0',
  `col_id` int(11) DEFAULT '0' COMMENT '栏目ID',
  `seo_title` varchar(100) DEFAULT NULL COMMENT '文档属性 头条1 推荐2  3加粗 4 图片 5 jump ',
  `seo_key` varchar(80) DEFAULT NULL COMMENT 'seo标题',
  `seo_des` varchar(200) DEFAULT NULL COMMENT 'seo描述',
  `tag` varchar(100) DEFAULT NULL COMMENT 'seo标签',
  `view_path` varchar(150) DEFAULT '0' COMMENT '文档模版',
  `create_time` int(11) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='文章列表';

-- 数据导出被取消选择。

-- 导出  表 rmtop.rtop_migrations 结构
CREATE TABLE IF NOT EXISTS `rtop_migrations` (
  `version` bigint(20) NOT NULL,
  `migration_name` varchar(100) DEFAULT NULL,
  `start_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `end_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `breakpoint` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 数据导出被取消选择。

-- 导出  表 rmtop.rtop_navs 结构
CREATE TABLE IF NOT EXISTS `rtop_navs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(11) DEFAULT NULL COMMENT '分组ID',
  `pid` int(11) DEFAULT '0' COMMENT '父级ID',
  `title` varchar(150) DEFAULT NULL COMMENT '导航名称',
  `url` varchar(255) DEFAULT NULL COMMENT '导航URl',
  `click_times` int(11) DEFAULT NULL COMMENT '点击次数',
  `target` varchar(60) DEFAULT NULL COMMENT '打开方式',
  `create_time` int(11) DEFAULT '0',
  `update_time` int(11) DEFAULT '0',
  `delete_time` int(11) DEFAULT '0',
  `sort` int(11) DEFAULT '0' COMMENT '排序',
  `status` int(11) DEFAULT '0',
  `nav_type` int(11) DEFAULT '0' COMMENT '内部栏目',
  `column_id` varchar(11) DEFAULT NULL COMMENT '栏目ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

-- 数据导出被取消选择。

-- 导出  表 rmtop.rtop_navs_category 结构
CREATE TABLE IF NOT EXISTS `rtop_navs_category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(150) DEFAULT NULL COMMENT '分组名称',
  `sort` int(11) DEFAULT '0' COMMENT '排序',
  `create_time` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- 数据导出被取消选择。

-- 导出  表 rmtop.rtop_rules 结构
CREATE TABLE IF NOT EXISTS `rtop_rules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ptype` varchar(255) DEFAULT NULL,
  `v0` varchar(255) DEFAULT NULL,
  `v1` varchar(255) DEFAULT NULL,
  `v2` varchar(255) DEFAULT NULL,
  `v3` varchar(255) DEFAULT NULL,
  `v4` varchar(255) DEFAULT NULL,
  `v5` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 数据导出被取消选择。

-- 导出  表 rmtop.rtop_system_log 结构
CREATE TABLE IF NOT EXISTS `rtop_system_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `create_time` varchar(255) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='系统运行日志';

-- 数据导出被取消选择。

-- 导出  表 rmtop.rtop_system_visitor 结构
CREATE TABLE IF NOT EXISTS `rtop_system_visitor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `create_time` varchar(20) DEFAULT NULL,
  `ip` varchar(20) DEFAULT NULL COMMENT '访问ip',
  `times` int(11) DEFAULT '0' COMMENT '访问次数',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='网站访客记录';

-- 数据导出被取消选择。

-- 导出  表 rmtop.rtop_sys_role 结构
CREATE TABLE IF NOT EXISTS `rtop_sys_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_title` varchar(100) NOT NULL DEFAULT '' COMMENT '角色名称',
  `role_sym` varchar(100) NOT NULL DEFAULT '' COMMENT '角色标识符',
  `role_org_img` varchar(150) NOT NULL DEFAULT '' COMMENT '角色图标',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 数据导出被取消选择。

-- 导出  表 rmtop.rtop_sys_rule 结构
CREATE TABLE IF NOT EXISTS `rtop_sys_rule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `flag` varchar(10) NOT NULL DEFAULT '' COMMENT '目录名称',
  `des` varchar(100) NOT NULL DEFAULT '' COMMENT '操作描述',
  `file_name` varchar(100) NOT NULL DEFAULT '' COMMENT '文件位置',
  `controller` varchar(50) NOT NULL DEFAULT '' COMMENT '控制',
  `action` varchar(50) NOT NULL DEFAULT '' COMMENT '方法',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


全球能源互联网 tp5
#### 7.05 后台优化文章作者显示修复

编辑器优化 前端显示优化 数据库备份

#### 7.04 优化模糊搜索

实现多词加空格搜索

#### 7.02 后台栏目增加上传图片

1.实现每期一张图片 2.前端搜索统计

#### 6.14 18 优化图片上的期数

在栏目表中添加别名字段
获取栏目别名字段显示到前端图片上
#### 6.14 后台文章列表

查询当前文章所属栏目的上级栏目

#### 6.10-6.14 优化前端，增加英文版发布

后台 增加英文发布栏目，英文文章发布

前端

优化列表页，获取同栏目下所有文章
优化搜索页面，实现选择时间，期数关键词搜索结果
优化内容页，实现层级目录
#### 6.10 完成英文期刊的添加

wangeditor编辑器结合tp5框架进行多图上传
#### 6.08 后台修改用户密码

优化搜索样式
#### 6.07 实现搜索效果

修复后台部分bug

#### 6.06 前端搜索布局

#### 6.05 前端显示层级列表

解决无法生产层级的问题
搜索页面 后台(待完成)
解决顶级栏目下有子栏目的话，不允许删除
如果有子栏目，不允许在顶级栏目下发布文章
解决图片上传的问题
管理员修改密码
#### 6.04 内容表新增字段
1. 后台添加表单中增加新增字段
2. 处理内容添加，编辑
3. 引入mathjax插件处理前端显示数学公式的正确性

#### 6.03 引入前台模版
1. 获取栏目列表
2. 获取二级栏目列表

#### 6.02 配置扩展 引入第三方类库
1. 处理无限极分类
2. 引入前端模版
3. 待修复bug：编辑文章时，内容为空

#### 6.01
1. 完成文章的添加，编辑，删除
2. 引入select2对选择栏目进行搜索
3. 添加文章测试

#### 5.30 文章内容编辑器嵌套
1. wangEditor富文本编辑器嵌套
2. 文章添加页面引入布局
3. 部分细节修改
4. 待研究mathjax插件

#### 5.30 栏目增删改查

1. 添加栏目
2. 栏目列表

#### 5.29 完成后台登录

1.使用ajax完成登录
2.创建栏目控制器,及导入模版

#### 5.27 创建后台
1. 创建后台入口文件admin.php，在public下
 
	1.1 命令行：
```
php think build --module admin 
```
	在app 自动生成 admin 目录
2. 访问域名/admin.php 是否可以访问？
	
	注：需要在config找到auto_bind_module 设置为true 即可访问
3. 引入后台模版

#### 5.26创建数据库
	管理员表，栏目表，内容表

	
	

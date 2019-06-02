sudo unzip dotcpp123.zip && sudo chmod 744 ./dotcpp123/src/install/* && sudo ./dotcpp123/src/install/install-ubuntu14.04.sh

其实跟首师那个项目一样的，web部分替换一下就行。
数据库结构不一样，清空或者重建一下jol，导入jol.sql。
记得配置文件要对应修改。
有一部分链接打不开可能需要调整一下nginx配置里rewrite规则(/etc/nginx/sites-enabled/default)。
压缩包里有本站default文件，rewrite规则都在里面。
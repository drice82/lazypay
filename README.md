# lazypay
## 1. 部署docker

### 新建用户 ptuser
```
adduser --disabled-login ptuser
```
### 查看用户ID
```
id ptuser
```
### 下载lazypt
```
docker pull drice64/lazypt:0.2
docker images

docker create --name=lazypt \
-v /home/ptuser/config:/config \
-v /home/ptuser/downloads:/downloads \
-e PGID=1000 -e PUID=1000 \
-e TZ=Asia/Shanghai \
-p 80:80 -p 5000:5000 \
-p 51413:51413 -p 6881:6881/udp \
drice64/lazypt:0.2

docker start lazypt

```
### 进入docker
```
docker exec -it lazypt /bin/bash
```
### 配置web数据库信息
```
数据库：
/home/ptuser/config/web/inc.php
密码：
/home/ptuser/config/web/.htpasswd
内容：用户名:密文，如：
10001:mhp9zzLd8PwaA
不能多回车
```

## 配置控制程序
```
文件放置在：
/home/lazypt/watch.py
配置用户名和数据库
设定定时执行
* * * * * python /home/lazypt/watch.py
```

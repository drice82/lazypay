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

```

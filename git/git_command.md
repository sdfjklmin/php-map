## 常用命令
#### [官网](https://git-scm.com/book/zh/v2)
#### [命令集合](http://www.ctolib.com/cheatsheets-Git-common-command-list.html)

##### 安装
~~~
官网下载系统对应的安装包，安装后设置全局变量。
~~~

##### 克隆，提交，推送
~~~
#克隆地址，分为 https(推送代码需要输入用户信息) 和 ssh(配置rsa，不需要输入用户信息) 。
git clone git@github.com:sdfjklmin/laraval.git

#添加版本控制
git add .

#添加版本控制(推荐)
git add -A 

#添加本次修改备注
git commit -m '我修改的'

#推送代码
git push 
~~~

##### SSH KEY
~~~
#测试
ssh -T git@github.com

#生成信息，然后一直下一步
ssh-keygen -t rsa -C 'git账号' 

#生成对应的key,根据生成的对应提示cat,复制key

#添加到git
~~~
##### 克隆到非空文件
~~~
克隆到一个空的文件中然后将
.git文件夹移到对应的文件目录中	
~~~

##### 更新提交代码
```
#git初始化
git init

#更新对应的分支
git pull -u origin master:master

#修改了哪些文件
git status    			

#对应变化
git diff 				

#新添加文件
git add file1.py 		

#删除文件
git rm file2.py    		

#把abc.php文件更新到本地
git checkout abc.php

#这个命令表示新增修改的文件到缓存列表
git add -A

#备注
git commit -m "备注说明"

git push -u origin master:master 
对应问题 :
    1.冲突
        git reset --hard  #放弃本地冲突代码
        git pull
```
##### 分支管理
```
#查看本地分支
git branch

#查看远程分支
git branch -a

#创建test分支
git branch test

#把test分支同步到远程
git push origin test

#分支切换到test上
git checkout test

#本地删除test分支
git branch -d test

#查看执行结果
git remote -v

#删除远程的test分支
git branch -r -d origin /test
git push origin :test

#提交test分支的代码
git push --set-upstream origin test

#创建test分支并且切换到test上
git checkout -b test

#同步远程ts_3
git push origin ts_3:ts_3

#更新远程分支
git fetch -p

#切换分支之前要提交代码
##在master分支下合并test分支
git merge test

##分支合并到主干后要提交
git push

#设置推送分支
git push --set-upstream origin mantis_80_withdraw

```
##### 忽略管理:
    .gitignore 文件
 	.git/info/exclude 增加忽略的内容 

##### 将远程分支和本来分支建立联系
    git branch --set-upstream-to=origin/远程分支的名字 本地分支的名字 

##### 代码冲突解决 stash(藏) pop(抛出)
    git stash #将本地文件存入缓存,先藏起来
    git pull  #更新代码
    git stash pop #将 藏 起来的代码 抛出
    git diff #本次代码的不同之处
    git diff -w test.php #单一文件的不同之处


##### 扩展只有文件文件内容无法提交(删除缓存,再添加)
    git rm -rf --cached vendor/crazyfd/yii2-qiniu
    git add vendor/crazyfd/yii2-qiniu/*
    再次使用git status查看发现文件已经成功添加： 
    Changes to be committed: 
    (use "git reset HEAD <file>..." to unstage) 
    deleted: vendor/crazyfd/yii2-qiniu 
    new file: vendor/crazyfd/yii2-qiniu/LICENSE 
    new file: vendor/crazyfd/yii2-qiniu/Qiniu.php 
    new file: vendor/crazyfd/yii2-qiniu/README.md 
    new file: vendor/crazyfd/yii2-qiniu/composer.json
    DONE
    
    git rm -r --cached . #删除当前项目的缓存
    
    git reset --hard origin/master

##### git rm --cached 
    删除暂存区或分支上的文件，但是本地 '需要' 这个文件，只是 '不希望加入版本控制'，
    可以使用 'git rm --cached'
    git rm --cached -r vendor/

##### 删除暂存区或分支上的文件，同时工作区 '不需要' 这个文件，可以使用 'git rm'

##### git 新项目 新增文件
    echo "# chrome-extension" >> README.md
    git init
    git add README.md
    git commit -m "first commit"
    git remote add origin https://web.com
    git push -u origin master

##### 项目拉取 建议用 ssh 而不是 https(每次都要输入用户名和密码,若配置个人信息 不安全 .. )

##### 修改git项目标记
    #github是使用 Linguist 来detect所使用的语言,通过统计哪种语言代码数量最多的作为当前项目主语言
    .gitattributes
    *.html linguist-language=python
    *.js   linguist-language=python
    *.css  linguist-language=python
    # 将.js、.css、.html当作python语言来统计

##### 查看git全局配置
    git config --global --list
    //新增全局配置
    git config --global --add key value
    //新增别名 st 对应 status
    git config --global --add alias.st status
    git config --global --add alias.ps push
    git config --global --add alias.pl pull
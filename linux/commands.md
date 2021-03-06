### 系统命令

- top  **显示当前系统中耗费资源最多的进程**
- date  **显示系统当前时间**

      date "+[params]"      #特定输入要带上+ 
      date "+%d"            #输出当日
      date "+%Y-%m-%d"      #2019-09-06
      date "+现在时间是: %Y-%m-%d %H:%M:%S"
      
      date +%Y%m%d               #显示前天年月日 
      date -d "+1 minute" +%Y%m%d   #显示前一分钟的日期 
      date -d "+1 day" +%Y%m%d      #显示前一天的日期 
      date -d "-1 day" +%Y%m%d      #显示后一天的日期 
      date -d "-1 month" +%Y%m%d    #显示上一月的日期 
      date -d "+1 month" +%Y%m%d    #显示下一月的日期 
      date -d "-1 year" +%Y%m%d     #显示前一年的日期 
      date -d "+1 year" +%Y%m%d     #显示下一年的日期


- 命令替换
 
      $( ) 与 ` `（反引号）都是用来作命令替换的。
      与变量替换差不多，都是用来重组命令行的，先完成引号里的命令行，然后将其结果替换出来，再重组成新的命令行。

- df(disk file system) 显示系统可用空间, df -h 便于可读方式

- du(disk usage) 显示指定目录以及子目录已使用磁盘空间的总和

      du -s(summarize)     #指定目录的总和,以目录显示。 du -s * , 当前所有
      du -h(human-readable)     #便于可读方式
      du -sh    #结合使用
      du -sh *  #当前目录所有的
      du -h --max-depth=1 #统计一级目录中的文件大小,便于逐层分析
      
- 使用 `df -h` 查看磁盘使用情况,如果某个磁盘满了,进入挂载点使用 `du -h --max-depth=1` 逐层分析,删除不必要的文件
      
- free 当前内存和交换空间的使用情况

- 查看cpu : `cat /proc/cpuinfo`

- 查看内存(memory) : `cat /proc/meminfo`

- 查看硬盘及分区信息 : `fdisk -l` 
      
- hostname 当前主机名称      

- `man` 查看命令介绍 : `man ls`, `man free` ...
### 操作命令

##### Folder(目录介绍)
    /bin (binaries)二进制可执行命令
    /dev (devices)设备特殊文件
    /etc (etcetera)系统管理和配置文件
    /etc/rc.d 启动的配置文件和脚本
    /home 用户主目录的基点，比如用户user的主目录就是/home/user，可以用~user表示
    /lib (library)标准程序设计库，又叫动态链接共享库，作用类似windows里的.dll文件
    /sbin (super user binaries)存放二进制可执行文件，只有root才能访问,超级管理命令，这里存放的是系统管理员使用的管理程序
    /tmp (temporary)公共的临时文件存储点
    /root 系统管理员的主目录
    /mnt (mount)系统提供这个目录是让用户临时挂载其他的文件系统
    /lost+found这个目录平时是空的，系统非正常关机而留下“无家可归”的文件（windows下叫什么.chk）就在这里
    /proc 虚拟的目录，是系统内存的映射。可直接访问这个目录来获取系统信息。
    /var (variable)用于存放运行时需要改变数据的文件,某些大文件的溢出区，比方说各种服务的日志文件
    /usr (unix shared resources)最庞大的目录，要用到的应用程序和文件几乎都在这个目录
    /usr/local/bin (该目录下的执行命令为全局执行命令,自定义的需要 chmod +x command,在执行)

##### 系统小命令
    whereis  abc   		#abc在哪里
    who i am 			#显示当前登录的人    
    whoami 			    #显示当前登录的人    

##### 关机重启
    halt  				#立刻关机 
    poweroff  			#立刻关机 
    shutdown -h now 	#立刻关机(root用户使用) 
    shutdown -h 10 		#10分钟后自动关机
    reboot 				#重启
    
##### 查看网络
    ip addr #基于ip table
    ifconfig     
    
##### echo
    echo > file             #清空file    
    echo 'test' > file      #覆盖file文件,填入内容test
    echo 'test' >> file     #向file文件中,追加内容test
    echo '32'               #输出32
    
##### cat
    cat file                #查看file内容
    cat -n file             #查看file内容带数字编号
    cat -b file             #查看file内容带数字编号但不对空白行编号
    cat -n file1 > file2    #把file1内容带编号输入到file2中
    cat --help              #查看更多
    cat -n 20.log | head -n 500 | tail -n +450  #查看　450 - 500 行
       
##### more less head tail
    more :
         -d          显示帮助而非响铃
         -f          计算逻辑行数，而非屏幕行数
         -l          屏蔽换页(form feed)后的暂停
         -c          不滚动，显示文本并清理行末
         -p          不滚动，清除屏幕并显示文本
         -s          将多行空行压缩为一行
         -u          屏蔽下划线
         -<数字>     每屏的行数
         +<数字>     从指定行开始显示文件
         +/<字符串>  从匹配搜索字符串的位置开始显示文件

    more +100 abc.php 从100行开始显示  逐行显示

    more -2 abc.php 显示前5行,后面的以跟多的方式查看
    eg: 
    我是第一行
    我是第二行
    -- 更多 --(4%)
    
    more +100 -2 abc.php 从100行开始显示,显示两行,其它以更多的方式查看
    
    less +100 abc.php 从100行开始显示  支持上下滚动查看
    
    head    file           #查看文本开头部分,默认10行
        -[num]          #指定行数
         
    tail    file           #查看文本结尾部分,默认10行,
        -[num]          #指定行数
        -f              #循环滚动读取文件并动态显示在屏幕上,根据文件属性跟踪
        -F              #循环滚动读取文件并动态显示在屏幕上,文件文件名跟踪
        
    tail -f log.log | nl  #带行号
    
    tail -10 log.log #显示10行
    tail +10 log.log #从第10行开始，显示到末尾
    
    tail -f index.php  | grep -e error -e ERROR -n
    #显示error和ERROR并带上行号
   
    tail -f  $(date +%d).log | grep -n error
    #显示当前日期的.log文件中的 error
    
    tail -F log
    #动态查看log

##### 文本统计
    wc      file        #统计文本的 行数、字数、字符数
       -m               #字符数    
       -w               #文本字数
       -l               #文本行数
    
##### 移动删除复制
    mv file /home/ 		#移动file到/home下 
    mv file file2       #重命名
    rm  				#删除 rm -r 删除文件和文件夹   
    rm -rf              #删除文件和文件夹不用提示
    cp  				#复制
    cp -r dir dir       #复制文件夹 
    scp                 #从本地复制到远程,secure cp
    scp local_file remote_username@remote_ip:remote_folder 
    scp test.txt proUser@123.456.789:/home/www/tmp 
    scp -r dir/ tt@10.10.10.10:/home/tt/down
    
##### 创建文件夹
    mkdir dir #创建文件夹dir
    mkdir -p ~/nginx/www ~/nginx/logs ~/nginx/conf  #批量创建目录      

##### 创建文件
    touch file  #创建file文件

##### 包管理    

###### yum(centos)    
    yum --help          #查看yum相关的帮助
    yum clean all       #清除所有安装记录
    yum update          #更新yum
    yum remove php      #移除php
    yum install php
    yum install -y epel-relase #自动安装依赖
    yum search php
    
    #安装本地包
    yum localinstall pkg.rpm
    
    #安装本地包，不验证签名
    yum localinstall pkg.rpm --nogpgcheck
###### dpkg(ubuntu)

###### apt|apt-get(deb包管理式)
    #安装
    sudo apt install <deb name>

    # 删除软件及其配置文件
    apt-get --purge remove <package>
    
    # 删除没用的依赖包
    apt-get autoremove <package>
    
    # 此时dpkg的列表中有“rc”状态的软件包，可以执行如下命令做最后清理：
    dpkg -l |grep ^rc|awk '{print $2}' |sudo xargs dpkg -P

###### rpm(软件包管理器)

##### 解压
###### tar 主要用于创建归档文件,和解压归档文件,其本身是没有压缩功能的,但可以调用 gzip bzip2 进行压缩处理.
    参数解释：
        -c 创建归档
        -x 解压归档
        -v 显示处理过程
        -f 目标文件，其后必须紧跟 目标文件
        -j 调用 bzip2 进行解压缩
        -z 调用 gzip 进行解压缩
        -t 列出归档中的文件

    eg:
    $ tar -cvf filename.tar .       ### 将当前目录所有文件归档,不压缩,后面有个.代表当前目录的意思 
    $ tar -xvf filename.tar         ### 解压 filename.tar 到当前文件夹
    $ tar -cvjf filename.tar.bz2 .  ### 使用 bzip2 压缩
    $ tar -xvjf  filename.tar.bz2   ### 解压 filename.tar.bz2 到当前文件夹
    $ tar -cvzf filename.tar.gz     ### 使用 gzip  压缩
    $ tar -xvzf filename.tar.gz     ### 解压 filename.tar.gz 到当前文件夹
    $ tar -tf   filename            ### 只查看 filename 归档中的文件，不解压
    ### 解压 filename.tar.gz 到 /ttt下
    $ tar -xvzf filename.tar.gz -C /ttt    
    
###### rar解压:
    sudo apt-get install rar
    sudo apt-get install unrar
    rar x test.rar

###### zip解压:
    #安装unar解压工具
    sudo apt-get install unar

    #瞬间就能解决zip解压中文乱码的问题。
    #解压相应的zip文件
    unar document.zip 

    #归档,将 ttFile 压缩至 tt.zip
    zip -r tt.zip ttFile/

##### 分组,权限
    chown 用于改变一个文件的所有者及所在的组。
    #改变 用户[:组] 文件
    chown user filename        ### 改变 filename 的所有者为 user
    chown user:group filename  ### 改变 filename 的所有者为 user，组为 group
    chown -R root folder       ### 改变 folder 文件夹及其子文件的所有者为 root
    
    chmod 永远更改一个文件的权限,主要有读取,写入,执行其中 所有者,用户组,其他 各占三个,
    ls -l :
    -rwxr--r-- 1 locez users   154 Aug 30 18:09 filename
    drwxr--r-- 1 locez users   154 Aug 30 18:09 filename
    解释:
        -|d        rwx    r--    r---   1    locez  users  1540 月份 日期 时间 文件    
        非目录|目录  user  group  others  num  用户   用户组  大写
        1540 : (-h | 1.5K,默认单位为K,当小于K时无法显示单位,以字节数显示)
    
    说明:r=read ， w=write ， x=execute
        4		  2			1
        		
    常用权限:
        文件夹:755   普通文本:644 | 664
        find -type d | xargs chmod 755
        find -type f | xargs chmod 644

    使用sudo进行操作:
        sudo find -type f | sudo xargs chmod 644
        
    chmod +x filename                               ### 为 user ，group ，others 添加执行权限
    chmod -x filename                               ### 取消 user ， group ，others 的执行权限
    chmod +w filename                               ### 为 user 添加写入权限
    chmod o+x filename                              ### 为 others 添加 x 权限
    chmod o-x filename                              ### 为 others 取消 x 权限  
    chmod ugo=rwx filename                          ### 设置 user ，group ，others 具有 读取、写入、执行权限
    chmod ug=rw filename                            ### 设置 user ，group 添加 读取、写入权限
    chmod ugo=--- filename                          ### 取消所有权限
    chmod -R [777|+x|-x|ugo=---|...] /minPro	    ### 把minPro下的所有文件赋予权限
    drwxr-xr-x =>d rwx r-x r-x                      ### d:文件类型 rwx:文件拥有者的权限 r-x:与文件拥有者同用户组的其它用户 r-x:其它用户组用户权限
    
    #创建abc目录,让该组成员能够在目录下创建和访问文件,并且除了创作者之外的人不能删除
    mkdir abc
    chmod g+wx abc
    #限位最后的‘+t’是‘粘滞位,防删位’，它用来替换‘x’，表明在这个目录中，文件只能被它们的拥有者、目录的拥有者或者是超级用户root删除
    chmod +t abc

##### 查找
    find:
        find path -option parm [ -print ] [ -exec -ok command ] {} /;
        find /(查找范围) -name (查找内容) [-type d|-print]
        find /home -name test -type d  查找home下名字为test的文件目录
        find /home -name test -print   查找home下名字为test的文件
        find /home -name test		  查找home下名为test
        find /home -name *test* | test*	
                  -name filename              #查找名为filename的文件
                  -perm                       #按执行权限来查找
                  -user   username            #按文件属主来查找
                  -group groupname            #按组来查找
                  -mtime -n +n                #按文件更改时间来查找文件，-n指n天以内，+n指n天以前
                  -atime   -n +n              #按文件访问时间来查
        
        find   / -amin   -10       # 查找在系统中最后10分钟访问的文件
        find   / -atime -2         # 查找在系统中最后48小时访问的文件
        find   / -empty              # 查找在系统中为空的文件或者文件夹
        find   / -group cat        # 查找在系统中属于 groupcat的文件
        find   / -mmin -5         # 查找在系统中最后5分钟里修改过的文件
        find   / -mtime -1        #查找在系统中最后24小时里修改过的文件
        find   / -nouser             #查找在系统中属于作废用户的文件
        find   / -user   fred       #查找在系统中属于FRED这个用户的文件
        
        find  / -type f -name "*.txt" | xargs grep "Hello"
        
        #找到当前目录下，以 .tar 结尾的，执行移动命令
        find . -name “*.tar” -exec mv {}./backup/
##### grep   
    在文本中查找
    grep a1 /home/test/t1.php  /home/test/t2.php  在t1.php,t2.php中查找a1
    grep a1 /home/test/t1.php    在/home/test/t1.php中查找a1
    grep -n a1 /home/test/t1.php    在/home/test/t1.php中查找a1
    grep -l  -option	path 		 	列出文件名(扯淡)
         -n  -option	path 			显示行号
         -v  -option	path			输出不是a1的
         -w  -option	    			完全匹配 grep -w error
         -l  -option	path			文件匹配 grep -w error -l *.log
         ^a1 			path 		 	^符号视作特殊字符,用于指定一行或者一个单词的开始
         a1$ 			path 		 	以a1结尾的 $符号视作特殊字符,用于指定一行或者一个单词的结尾。
         -r  -option	path      		递归去查找(文件夹)
         ^ $   	path      				查找所有空行
         -i  -option	path 			忽略大小写
         -e a1 -e a1 -option	path    多个查找
         -B 4 -option	path 			匹配行的前4行
         -A 4 -option	path 			匹配行的后4行
         -C 4 -option	path 			匹配行的前后4行
    
    ls	| gerp a1    					组合使用,在当前目录下查找 
    ls  | find a1	
    grep -option parm path ;    操作参数 路径
    find path -option parm ;    路径 	 操作参数 
    grep -w error -l *.log #显示　*.log　中　有　error　的的文件
    cat 20.log | grep -n -w error #显示20.log中带 error 的,带行号
    
    cat 20.log | grep -10 -n -w error #显示文件中带error的带行号,并且显示error附近的(上下)10行
     
    #显示目录
    ls -l | grep '^d'
           
    #显示文件
    ls -l | grep '^-'       
    
    #递归查找,显示哪些文件中包含 Hello
    grep -rn "Hello" ./
    
    //-------------------------------
    // grep --help                  |
    //-------------------------------
    用法: grep [选项]... PATTERN [FILE]...
    Search for PATTERN in each FILE.
    Example: grep -i 'hello world' menu.h main.c
    
    Pattern selection and interpretation:
      -E, --extended-regexp     PATTERN is an extended regular expression
      -F, --fixed-strings       PATTERN is a set of newline-separated strings
      -G, --basic-regexp        PATTERN is a basic regular expression (default)
      -P, --perl-regexp         PATTERN is a Perl regular expression
      -e, --regexp=PATTERN      用 PATTERN 来进行匹配操作
      -f, --file=FILE           从 FILE 中取得 PATTERN
      -i, --ignore-case         忽略大小写
      -w, --word-regexp         强制 PATTERN 仅完全匹配字词
      -x, --line-regexp         强制 PATTERN 仅完全匹配一行
      -z, --null-data           一个 0 字节的数据行，但不是空行
    
    杂项:
      -s, --no-messages         不显示错误信息
      -v, --invert-match        选中不匹配的行
      -V, --version             显示版本信息并退出
          --help                显示此帮助并退出
    
    Output control:
      -m, --max-count=NUM       stop after NUM selected lines
      -b, --byte-offset         print the byte offset with output lines
      -n, --line-number         print line number with output lines
          --line-buffered       flush output on every line
      -H, --with-filename       print file name with output lines
      -h, --no-filename         suppress the file name prefix on output
          --label=LABEL         use LABEL as the standard input file name prefix
      -o, --only-matching       只显示匹配PATTERN 部分的行
      -q, --quiet, --silent     不显示所有常规输出
          --binary-files=TYPE   设定二进制文件的TYPE 类型；
                                TYPE 可以是`binary', `text', 或`without-match'
      -a, --text                等同于 --binary-files=text
      -I                        等同于 --binary-files=without-match
      -d, --directories=ACTION  读取目录的方式；
                                ACTION 可以是`read', `recurse',或`skip'
      -D, --devices=ACTION      读取设备、先入先出队列、套接字的方式；
                                ACTION 可以是`read'或`skip'
      -r, --recursive           等同于--directories=recurse
      -R, --dereference-recursive       同上，但遍历所有符号链接
          --include=FILE_PATTERN  只查找匹配FILE_PATTERN 的文件
          --exclude=FILE_PATTERN  跳过匹配FILE_PATTERN 的文件和目录
          --exclude-from=FILE   跳过所有除FILE 以外的文件
          --exclude-dir=PATTERN  跳过所有匹配PATTERN 的目录。
      -L, --files-without-match  print only names of FILEs with no selected lines
      -l, --files-with-matches  print only names of FILEs with selected lines
      -c, --count               print only a count of selected lines per FILE
      -T, --initial-tab         make tabs line up (if needed)
      -Z, --null                print 0 byte after FILE name
    
    文件控制:
      -B, --before-context=NUM  打印文本及其前面NUM 行
      -A, --after-context=NUM   打印文本及其后面NUM 行
      -C, --context=NUM         打印NUM 行输出文本
      -NUM                      same as --context=NUM
          --color[=WHEN],
          --colour[=WHEN]       use markers to highlight the matching strings;
                                WHEN is 'always', 'never', or 'auto'
      -U, --binary              do not strip CR characters at EOL (MSDOS/Windows)

##### Vi
    i   #在光标前插入
    A   #在光标当前行末尾插入
    o   #在光标当前行的下一行插入
    O   #在光标当前行的上一行插入
    wq! #强制保存退出
    :/a #文本中搜索a   n下一个  N上一个
    :nu #显示行号
    :set nu #全文显示行号 	
    :set nonu #取消行号显示
    gg  #跳到首行
    G   #跳到末行
    :n  #跳到值定行 :4
    r   #替换光标当前的字符
    R   #从光标开始处替换,ESC结束
    u #撤回命令
    yy #复制一行
    nyy #复制n行,n为行数,如: 5yy,当前向下复制5行,包括当前行
    p #在光标下一行粘贴
    P #在光标上一行粘贴
    dd #删除一行
    ndd #刪除n行,n为行数,如: 5dd,当前向下删除5行,包括当前行
    dG #删除当前光标所在行到末尾的内容
    :5,7d #删除指定行的内容
    shift + zz #保存退出等同于 :wq
    
    安装vim,移除自带的
    sudo apt-get remove vim-common
    sudo apt-get update
    sudo apt-get install
    sudo apt-get install vim
    
    
### 常用命令

##### 1.添加用户和密码
	adduser  test  
	useradd -m -g users -G audio -s /usr/bin/bash newuser     
     -m 创建home目录 -g 所属的主组 -G 指定该用户在哪些附加组 -s 设定默认的 shell,newuser 为新的用户名
	passwd  test
	
	#删除用户
	userdel test 
	
##### 2.赋予root权限
	修改 etc/sudoers 
	方法一：找到下面一行，把前面的注释（#）去掉
	## Allows people in group wheel to run all commands
	%wheel    ALL=(ALL)    ALL
	然后修改用户，使其属于root组（wheel），命令如下：
	#usermod -g root tommy
	修改完毕，现在可以用tommy帐号登录，然后用命令 su - ，即可获得root权限进行操作。

	方法二：找到下面一行，在root下面添加一行，如下所示：
	## Allow root to run any commands anywhere
	root    ALL=(ALL)     ALL
	tommy   ALL=(ALL)     ALL
	修改完毕，现在可以用tommy帐号登录，然后用命令 su - ，即可获得root权限进行操作。
	
##### 3.禁止root登陆
	vi /etc/ssh/sshd_config	
	PermitRootLogin no

##### 4.登录提示信息
	CentOs: 编辑 vi /etc/motd 即可
    Ubuntu: cd /etc/update-motd.d, 这里面都是 shell,
            可以发现目录中的文件名都是数字开头的, 数字越小的文件越先加载
            可以修改也可以新增

##### 5.自定义命令
    a.直接修改系统命令
        vi /etc/bashrc | vi /etc/bash.bashrc | vi ~/.bashrc(只针对当前用户生效，其它为全局生效)
        在最后一行添加
        alias test="cd /minCmd"	
        source /etc/bashrc  # 使更改配置生效
    a1. alias 
        #显示所有别名
        alias
      
        #设置别名
        alias sshpro="/usr/bin/expect sshLogin.sh"
    b.建立shell脚本
    c.linux自定义service
        tt.service
        [Unit]
        Description=Yii Queue Worker1 %I
    
        [Service]
        User=www
        Group=www
        ExecStart=/usr/local/php/bin/php /var/www/passport/yii queue/listen
        Restart=on-failure
    
        [Install]
        WantedBy=multi-user.target
        
    c.b linux自定义service说明
        vi /lib/systemd/system/nginx.service
        内容：
        [Unit]
        Description=nginx
        After=network.target
        [Service]
        Type=forking
        ExecStart=/usr/local/nginx/sbin/nginx
        ExecReload=/usr/local/nginx/sbin/nginx -s reload
        ExecStop=/usr/local/nginx/sbin/nginx -s stop
        PrivateTmp=true
        [Install]
        WantedBy=multi-user.target
        
        解释
        Description:描述服务
        After:描述服务类别
        [Service]服务运行参数的设置
        Type=forking是后台运行的形式
        ExecStart为服务的具体运行命令
        ExecReload为重启命令
        ExecStop为停止命令
        PrivateTmp=True表示给服务分配独立的临时空间
        注意：[Service]的启动、重启、停止命令全部要求使用绝对路径
        [Install]运行级别下服务安装的相关设置，可设置为多用户，即系统运行级别为3
        
    c.c systemctl [option] {command}
        systemctl restart  firewalld.service
        
        service  network restart 
        service  < option > | --status-all | [ service_name [ command | --full-restart ] ]
        
        # 开机启动        
        systemctl enable supervisord
        
        # 是否已经开机启动
        systemctl is-enabled supervisord

##### 6.修改主机信息
    a.使用hostname
        hostname 主机名称
        su #使修改生效
    b. vi /etc/hosts	  	
        新增:
        192.169.124.130 hostname

##### 7.将安装命令加入到系统环境中
	a.永久生效
        vi /etc/profile
        添加
            PATH=$PATH:/(对应php的安装运行目录[bin])
            PATH=$PATH:/(对应mongo的安装运行目录[bin])
            export PATH
        source /etc/profile  配置生效
        echo $PATH 查看

	b.  当前用户生效
        cd ~
        vi .bash_profile|.bashrc 修改文件中PATH一行，将路径加入到PATH=$PATH:$HOME/bin一行之后
        或 新增 export PATH=$PATH:/(对应可执行命令的地址)

    c.临时生效
		export PATH=$PATH:/(对应php的安装运行目录)

    /home/sjm/php-lib/version/php-7.3.10/main/bin

##### 8.ctrl + 回撤键	 #命令行模式输入删除

##### 9.往文件中追加信息
	echo '追加信息' >> addinfo.php

##### 10.覆盖文件中的信息
	echo '' > addinfo.php

##### 11.如果命令太长可以使用反斜杠Enter来输出  \[Enter] 
    cd /usr/local/\
    php

##### 12.env查看所有环境变量的信息

##### 13.用set可以查看所有的变量

##### 14.alias查看所有的别名

##### 15.type cd #查看cd命令的说明

##### 16.杀死进程
	a.查看进程
		ps -aux 或者 ps -ef
	b.查看某个进程 [管道]
		ps -aux | grep php-fpm	 或者 pgrep php-fpm
	c.查看xx的PID	
		pidof php-fpm   
	
	1.pidof php-fpm | xargs kill #杀死php-fpm
	2.pgrep和kill！pkill＝pgrep+kill。
	  pkill php-fpm
	  pkill -9 php-fpm
	3.kill -s 9 [pid]  
	  -s 9 制定了传递给进程的信号是９，即强制、尽快终止进程。各个终止信号及其作用见附录
	4.killall php-fpm #杀死全部php-fpm  

##### 17.查看用户的历史命令记录
	cat ~/.bash_history 

##### 18.telnet
	yum install telnet
	yum install telnet-server	
	/usr/bin/telnet ip prot

##### 19.开机自启
	/etc/rc.local 加入你需要启动的命令
	/etc/rc.d/init.d/	加入你需要启动的脚本服务

##### 20.开启端口(centos7)
	firewall-cmd --zone=public --add-port=80/tcp --permanent
	重启 systemctl restart firewalld.service

##### 21.查看本机外网IP
    curl ifconfig.me

##### 22.修改root密码(CentOS7)
    选择系统,看下面的提示,然后按e,
    编辑修改两处：ro改为rw,在LANG=en_US.UFT-8后面添加init=/bin/sh
    按Ctrl+X重启，并修改密码
        echo '123456' |passwd --stdin root
    由于selinux开启着的需要执行以下命令更新系统信息,否则重启之后密码未生效
        touch /.autorelabel
    重启系统
        exec /sbin/init
        
##### 23.网络连接
    进入  /etc/sysconfig/network-scripts 编辑第一个网卡	将 ONBOOT改为yes(激活网卡)
    vi ifcfg-eno..
    
    BOOTPROTO=static[静态ip]|dhcp[动态ip]
    IPADDR=192.168.124.129
    NETMASK=255.255.255.0
    
    eg:最简单的配置
    将网络设置桥接服务物理地址
    BOOTPROTO=dhcp
    ONBOOT=yes
    
    eg:固定ip
    DEVICE="eth2"	            #网卡名称
    NETMASK="255.255.255.0"     #网关
    IPADDR="192.168.1.48"		#IP地址
    GATEWAY="192.168.1.1"		#默认网关
    DNS='192.168.1.1'			#dns地址 ipconfig /all windows上的对应
    DNS1=61.139.2.69			#dns地址
    
    eg:
    DIVICE=eth7
    TYPE=Ethernet
    BOOTPROTO=static
    DEFROUTE=yes
    PEERDNS=yes
    PEERROUTES=yes
    IPV4_FAILURE_FATAL=no
    IPV6INIT=yes
    IPV6_AUTOCONF=yes
    IPV6_DEFROUTE=yes
    IPV6_PEERDNS=yes
    IPV6_PEERROUTES=yes
    IPV6_FAILURE_FATAL=no
    UUID=ab975ea9-2c4f-4df1-9601-b8a68385b1fe
    ONBOOT=yes
    NETMASK="255.255.255.0"
    IPADDR="192.168.1.108"
    GATEWAY="192.168.1.1"
    DNS1=192.168.1.1
    
    service network restart (重启网卡)
    
##### 24.删除文件夹下的特定文件
    find . -name "file_name" | xargs rm -Rf 
    xargs:支持|管道来传递参数,然后进行处理 
    
##### 25.netstat 
    介绍: Netstat 是一款命令行工具，可用于列出系统上所有的网络套接字连接情况，
         包括 tcp, udp 以及 unix 套接字，另外它还能列出处于监听状态（即等待接入请求）的套接字
    查看端口情况: netstat -anp | grep 9501
    列出所有连接: netstat -a
    只列出 TCP 或 UDP 协议的连接: netstat -at , netstat -au
    
##### 26.crontab : no crontab for root - using an empty one 
    #选择编辑器,可选vim.basic。
    select-editor   
    
    crontab -e
    
    service cron status|start|restart 
    
##### 27. htop 显示进程、cpu、io等系统信息，top已经老了O(∩_∩)O
    sudo apt install htop
    
    #进入显示界面
    htop
    
    #具体操作可根据下方提示进行操作，F1很好用
    
    VIRT：virtual memory usage 虚拟内存
    1、进程“需要的”虚拟内存大小，包括进程使用的库、代码、数据等
    2、假如进程申请100m的内存，但实际只使用了10m，那么它会增长100m，而不是实际的使用量
    
    RES：resident memory usage 常驻内存
    1、进程当前使用的内存大小，但不包括swap out
    2、包含其他进程的共享
    3、如果申请100m的内存，实际使用10m，它只增长10m，与VIRT相反
    4、关于库占用内存的情况，它只统计加载的库文件所占内存大小
    
    SHR：shared memory 共享内存
    1、除了自身进程的共享内存，也包括其他进程的共享内存
    2、虽然进程只使用了几个共享库的函数，但它包含了整个共享库的大小
    3、计算某个进程所占的物理内存大小公式：RES – SHR
    4、swap out后，它将会降下来
    
##### 28.  systemctl 和 service
命令语法
```
systemctl [option] {command}
#通过系统控制中心 重启 firewalld.服务
systemctl restart  firewalld.service

service  < option > | --status-all | [ service_name [ command | --full-restart ] ]
#重启 network 服务
service network restart 
```
两者对比
~~~
service : Linux 的启动一直采用init进程。
    $ sudo /etc/init.d/apache2 start
    # 或者
    $ service apache2 start
    缺点:
        一是启动时间长。init进程是串行启动，只有前一个进程启动完，才会启动下一个进程。
        二是启动脚本复杂。init进程只是执行启动脚本，不管其他事情。脚本需要自己处理各种情况，这往往使得脚本变得很长。

systemd : 为了解决这些问题而诞生的。它的设计目标是，为系统的启动和管理提供一套完整的解决方案。
    根据 Linux 惯例，字母d是守护进程（daemon）的缩写。 Systemd 这个名字的含义，就是它要守护整个系统。
    使用了 Systemd，就不需要再用init了。Systemd 取代了initd，成为系统的第一个进程（PID 等于 1），其他进程都是它的子进程。
    $ systemctl --version
    上面的命令查看 Systemd 的版本。
    Systemd 的优点是功能强大，使用方便，缺点是体系庞大，非常复杂。
    事实上，现在还有很多人反对使用 Systemd，理由就是它过于复杂，与操作系统的其他部分强耦合，违反"keep simple, keep stupid"的Unix 哲学。
其它知识请自行扩展
~~~

##### 29. 配置host域名访问
    #修改信息
    sudo vim /etc/hosts
    
    #dns-clean start
    sudo /etc/init.d/dns-clean start
    
    #networking restart
    sudo /etc/init.d/networking restart
    
##### 30. 系统用户和用户组 (/etc/passwd, /etc/shadow, /etc/group)    
* /etc/passwd文件是用户管理工作涉及的最重要的一个文件
    * 规则 `用户名:口令:用户标识号:组标识号:注释性描述:主目录:登录shell`
    * 示例 `sjm:x:1000:1000:sjm,,,:/home/sjm:/bin/bash`
    * 说明
        ~~~
        用户名     用户账号的字符串(应当避免特殊符号，如 : 避免不必要的冲突)
        口令       存放着加密后的用户口令字,通过 shadow 技术,把真正的加密口令存放于 /etc/shadow中,这里只用特殊符号标示, 'x' 或者 '*' 或其它
        用户标示    是一个整数，系统内部用它来标识用户
        组标识号    字段记录的是用户所属的用户组
        注释性描述  字段记录着用户的一些个人情况
        主目录     也就是用户的起始工作目录
        登录shell  用户登录后，要启动一个进程，负责将用户的操作传给内核，这个进程是用户登录到系统后运行的命令解释器或某个特定的程序，即Shell
        ~~~
     * 伪用户
       ~~~
       在/etc/passwd文件中也占有一条记录，但是不能登录，因为它们的登录Shell为空。它们的存在主要是方便系统管理，满足相应的系统进程对文件属主的要求
       
       伪 用 户 含 义
       bin 拥有可执行的用户命令文件
       sys 拥有系统文件
       adm 拥有帐户文件
       uucp UUCP使用
       lp lp或lpd子系统使用
       nobody NFS使用
       ~~~ 
* /etc/shadow中的记录行与/etc/passwd中的一一对应，它由pwconv命令根据/etc/passwd中的数据自动产生
    * 规则 `登录名:加密口令:最后一次修改时间:最小时间间隔:最大时间间隔:警告时间:不活动时间:失效时间:标志`
* /etc/group 中存放用户组的所有信息
    * 规则 `组名:口令:组标识号:组内用户列表`   

##### 31. ln 软链接
    #设置软链接,这里使用的是对应的绝对路径
    ln -s [source] [target]
    
    #修改软链接
    ln -snf  [new_source] [targert]
    
    #删除软链接
    rm -rf 
    
    #将node配置到系统命令中
    ln -s /usr/local/node-v10.14.1-linux-x64/bin/node /usr/local/bin/node

##### 32. 查看端口占用情况
```
##统一以 80 端口为例

#查看所有80清空
netstat -anlp | grep 80

#查看进程占用哪些文件的(list open files)
lsof -i:80

#查看 80端口/tcp协议 的情况 (file user)
fuser 80/tcp -v

#nmap工具
 
#pidof
pidof php-fpm
```

##### 33. 查看系统开启服务耗时 
analyze(分析) blame(责备) `systemd-analyze blame`

##### 34. ssh 
    登录:  ssh username@ip
    
    
##### 35. strace 跟踪,性能分析,问题诊断 ,内核态的函数调用跟踪用「strace」，用户态的函数调用跟踪用「ltrace」
    #跟踪包含forks出来的PID
    strace -f -p [PID]   
    
    #以时间收集PID 
    strace -cp [PID]
    
##### 36. ulimit 控制shell程序的资源
    
    #同一时间最多可开启的文件数
    ulimit -n
    
##### 37. CTRL+Z 挂起进程并放入后台    

##### 38. `cd -` 切回到上一个工作目录

##### 39. 别名使用 `ll, la` 具体看操作系统

##### 40. 用`;`一个接一个的运行命令 ` command_1; command_2; command_3`

##### 41. 用`&&`仅在上一个命令成功的情况下，才能在一个命令中运行多个命令 ` command_1 && command_2 && command_3`

##### 42. Ctrl-Q 解除Linux终端意外冻结的

##### 43. 移至行首`Ctrl + A`或行尾`Ctrl + E`

##### 44. 使用 `!$` 重新使用上一个命令中的最后一项
~~~
-> mkdir abc
-> cd !$ 等同于 cd abc
~~~

##### 45. 用 `!!` 重用当前命令中的上一个命令。一般用户需要验证root的时候
~~~
-> vi abc.txt
-> sudo !! 等同于 sudo vi abc.txt
~~~

##### 46. gdb 调试
```
#进入gdb 加载php相关模块
gdb php

#运行文件
gdb:>run file.php

#打印数据
gdb:>print 参数

#启动
gdb:>start

#显示堆栈
gdb:>bt
```

##### 47. awk 取第几列
```
#table.txt
1 bom 13 成都
2 toy 18 日本

#取第二列
cat table.txt | awk '{print $2}'
#bom
#toy

cat table.txt | awk  -F: '{print $2}'  # -F:, 以 : 

#统计第一列出现的次数和内容
tail -3000 access.log | awk '{print $1}' | sort | uniq -c
```

##### 48. seq 1 15 
```
#生成 1 - 15
echo `seq 1 15`
```

##### 49. 查看CPU,内存,等信息
    #查看cup
    sudo grep "model name" /proc/cpuinfo |awk -F ':' '{print $NF}'

    #内存支持类型
    sudo dmidecode -t memory |grep -A16 "Memory Device$" |grep "Type:"

    #每个内存频率
    sudo dmidecode -t memory |grep -A16 "Memory Device$" |grep "Speed:"

    #每个内存大小
    sudo dmidecode -t memory |grep -A16 "Memory Device$" |grep "Size:"
    
    #内存购买信息
    #SO-DIMM    :   small outline dual in-line memory module,多用于笔记本
    #DIMM       :   电脑
    #规格 : 具体规格需要查看笔记本或者电脑的支持,需要购买相同规格的才能支持
    #   DDR4:内存是新一代的内存规格。DDR4相比DDR3最大的区别有三点：16bit预取机制（DDR3为8bit）。速度更快。
    #   DDR3:预取机制 8bit
    #规格    内存大小     笔记本类型            频率(一般高频会向低频同步,A:1600,B:2666,处理为B:1600)
    DDR4    4G          SO-DIMM             2666
   
    #显卡
    nvidia-smi
    
    #内存
    dmidecode -t memory
    
    #快捷查看
    lscpu
    每个单位时间内，一个单运行管线的CPU只能处理一个线程（操作系统：thread），
    以这样的单位进行，如果想要在一单位时间内处理超过一个线程是不可能的，除非是有两个CPU的实体单元。
    双核心技术是将两个一样的CPU放置于一个封装内（或直接将两个CPU做成一个芯片），而英特尔的多线程技术是在CPU内部仅复制必要的资源、
    让两个线程可同时运行；在一单位时间内处理两个线程的工作，模拟实体双核心、双线程运作。
    一个CPU,2核,4个逻辑CPU
    CPU个数为一个
    2核:CPU有两个物理处理器即核心芯片
    4个逻辑CPU:一个物理处理器通过超线程技术(HT,Hyper-Threading)在软件层变成两个逻辑处理器
    CPU可以看成工厂,2核即两个工人,4个逻辑CPU即一个工人可以同时做两个人(HT,2核×2)的事情
    -----------------------------------------------------------------------------
    Architecture:          x86_64
    CPU op-mode(s):        32-bit, 64-bit
    Byte Order:            Little Endian
    CPU(s):                2                (两个逻辑CPU)
    On-line CPU(s) list:   0,1
    Thread(s) per core:    1                (支持超线程)
    Core(s) per socket:    2                (2核)
    Socket(s):             1                (一个CPU)(Socket:插座,有多少个就可以插多少芯片)
    NUMA node(s):          1
    Vendor ID:             GenuineIntel
    CPU family:            6
    Model:                 79
    Model name:            Intel(R) Xeon(R) CPU E5-26xx v4
    Stepping:              1
    CPU MHz:               2394.452
    BogoMIPS:              4788.90
    Hypervisor vendor:     KVM
    Virtualization type:   full
    L1d cache:             32K
    L1i cache:             32K
    L2 cache:              4096K
    NUMA node0 CPU(s):     0,1
    
    #U盘单个复制的最大文件,如果超出限制则无法复制
    NTFS ：最大文件2TB
    FAT16：最大文件2GB
    FAT32：最大文件4GB(默认)
    
    #U盘挂载 ntfs 类型
    sudo ntfsfix /dev/sdb1
 
##### 50.expect
* expect    ` 实现自动登录,交互通信,指定字符串命令(实现自动交互功能的软件)`
* send       用于向进程发送字符串
* send_user  向用户提供反馈,类似于 echo,不会自动换行
* puts       向用户提供反馈,类似于 echo,会自动换行
* expect     从进程接收字符串
* spawn      启动新的进程
* set 设定变量为某个值
* exp_continue 重新执行expect命令分支
* [lindex $argv 0] 获取expect脚本的第1个参数 `set user [lindex $argv 0]`
* [lindex $argv 1] 获取expect脚本的第2个参数
* set timeout -1 设置超时方式为永远等待
* set timeout 30 设置超时时间为30秒
* interact 将脚本的控制权交给用户，用户可继续输入命令
* expect eof 等待spawn进程结束后退出信号eof
* 普通用法
```
#!/usr/bin/expect
#shll name : sshLogin.sh
#声明shell运行环境

#设置变量
set timeout 30
set host "101.200.241.109"
set username "root"
set password "123456"

#启动新进程
spawn ssh $username@$host

#从进程接收字符串,并发送字符串
#模式-动作
#expect "*password*" {send "$password\r"}

#动作分解形
#从进程接收字符串
expect "*password*"

#向进程发送字符串
send "password\r"

#定义命令的开始1(有延迟)
expect "*]#"                                        
#发送要执行的命令
send "df -h\r" 

#定义命令的开始2(无延迟)
expect "]*"
send "df -h\r"

#允许用户交互,如果没有这一句登录完成后会退出,而不是留在远程终端上
interact
```
`whereis expect` => `/usr/bin/expect`

`/usr/bin/expect sshLogin.sh`

`alias sshpro="/usr/bin/expect sshLogin.sh"`

`sshpro`

* 其它使用
```
#单一分支
set password 123456
expect "*assword:" { send "$password\r" }

#多分支
set password 123456
expect {
      "(yes/no)?" { send "yes\r"; exp_continue }
      "*assword:" { send "$password\r" }
}

#会了 Python,再看 expect 就是个 didi
```
* 完整例子
```
#!/usr/bin/expect
#shll name : sshPull.sh
#自动登录服务器并且更新代码
#by author sjm

#设置基础参数
set timeout 30
set host "101.200.241.109"
set username "root"
set password "123456"
set dirPath "/www/object/test"
set dirPathPwd "123456"

#执行ssh
spawn ssh $username@$host
expect {
      "(yes/no)?" { send "yes\r"; exp_continue }
      "*password*:" { send "$password\r" }
}

#发送命令,进入项目
expect "]*"
send "cd $dirPath\r"

#执行更新
expect "]*"
send "git pull\r"

#执行密码
expect "git@test.cn password:*"
send "$dirPathPwd\r"

#停留在远程终端
interact
```
##### 51. rsync `多台服务器同步代码, 负载均衡, SLB`
    自行了解
    
##### 60. 移除文件头 `sed`
```
#语法
命令     语法         脚本        文件   
sed     [-i|n|e|..] [script]    [文件]
sed                 '1 d'       file.txt
sed     -i          '1 d'       file.txt


#输出不带首行的文件内容
sed '1 d' file.txt

#删除 2 - 5 行
sed '2,5d' file.txt

#将2-5行的内容替换为2-5replace, 2 - 5行变为 1行
sed '2,5c 2-5replace' file.txt

#保存文件
sed '1 d' file.txt > file2.txt

#直接操作
sed -i '1 d' file.txt

#部分操作可以参考vi
#/world(需要匹配的文字)/d(delete删除)
#/world(需要匹配的文字)/p(print标准输出)
#/world(需要匹配的文字)/c(替换)

sed -i '/world/d' file.txt #删除有world的行
sed -n '/world/p' file.txt #匹配有world的行
sed -i '/world/c ttt' file.txt #匹配有world的行,将整行的内容替换成ttt
sed 's/search/replace/g' file.txt #搜索替换,遵循正则匹配

#获取文件第5行的长度
#‘sed -n ‘n p’ file.txt’，这里‘n’表示行号，‘p’打印出匹配内容（标准输出），该命令通常与-n命令行选项连用
sed -n '5 p' file.txt | wc -c
```
##### 60.1 awk sed grep find 四剑客
```
# 获取IP地址
# ip addr show 获取所有的IP信息,通过 dynamic 过滤掉其它的,awk 获取第二行,sed去除末尾
# inet 192.168.1.125/24 brd 192.168.1.255 scope global dynamic noprefixroute enp0s25
ip addr show | grep dynamic | awk '{print $2}' | sed 's/\/24//g'

# 获取文本中最大的数字
# number.txt
123 4322
4334 4334223 54
223
112 23 433456
23
543
# sed 将 空格 替换成 换行符, sort 进行排序 -g 数字排序,默认小到大, r 反转, head -1 取头部一行 
cat number.txt | sed 's/ /\n/g' | sort -gr | head -1

```

##### 61. Linux进程在它的一生中，通常经历了四个主要阶段
* 等待：Linux进程等待资源。
* 运行：Linux进程当前正在执行中。
* 停止：Linux进程在成功执行后或收到杀死进程信号后停止。
* 僵尸：如果该进程已经结束，但仍然留在进程表中，被称为‘僵尸’。

###### 62. 截取列 `cut`
* -b ：以字节为单位进行分割。这些字节位置将忽略多字节字符边界，除非也指定了 -n 标志。
* -c ：以字符为单位进行分割。
* -d ：自定义分隔符，默认为制表符。
* -f ：与-d一起使用，指定显示哪个区域。
* -n ：取消分割多字节字符。仅和 -b 标志一起使用。如果字符的最后一个字节落在由 -b 标志的 List 参数指示的
范围之内，该字符将被写出；否则，该字符将被排除
```
file.txt
内容:
    12345 678 9 10 11
    12345 678 9 10 11

# 截取 -c 字符
cut -c '1-3' file.txt # 截取 1 到 3 列  =>  123
cut -c '1,3' file.txt # 截取 第一和第三列=>  13 

# -f 列
cut  -f '3,4' -d ' ' file.txt #截取 3 和 4 字段,以 空格 分割 => 9 10 
```

##### 63. Ubuntu 18 Wi-Fi 热点分享
    设置 -> Wi-Fi -> 点击右上角[列表ICON|横着的三杠] -> 打开 Wi-Fi 热点
    配置具体信息: 命令行输入 nm-connection-editor -> 界面交互 -> Hotspot (热点区域) 
    
    nm-connection-editor : 
        创建一个网桥，使用网络管理器创建网桥最简单的方式。
        这款GUI(图形用户界面)的工具允许你傻瓜式地配置一个网桥
        
##### 64. lsb_release -a `查看系统版本`
    LSB是Linux Standard Base的缩写，lsb_release命令用来显示LSB和特定版本的相关信息
    
##### 65. linux cd 进入目录提示 -bash: cannot create temp file for here-document
    #想进入 www 目录, 输入 cd /ww ,按 tab 想自动补全, 结果报错
    #简单分析
    1.权限是否正确
    2.磁盘已满
    3.对应文件夹的占用过大,出于保护拒绝
    
##### 66. Ubuntu 18 启动失败 Started Hold until boot procss finishes up
    原因:磁盘满了
    解决:
        启动 -> 快捷键(Shift,F2,F12,U盘启动盘,...具体看电脑) -> 选择 'Ubuntu高级选项|Advanced options for Ubuntu'
        -> 最新的一个(recovery mode) -> 点击 'root' -> 根据 'df | du' 进行逐步删除

##### 67. Ubuntu:  cannot install "xx": snap "xx"  has "install-snap" change in progress
    # 查看未安装完成的软件
    snap changes

    #终止对应的ID
    sudo snap abort 5
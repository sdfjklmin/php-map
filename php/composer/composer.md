## 网址
#### [phpComposer](https://www.phpcomposer.com/)
#### [getComposer](https://getcomposer.org/)
#### [packagist](https://packagist.org/)
#### [kancloud](https://www.kancloud.cn/thinkphp/composer/35668) 

## 命令
#### 安装
    #安装包下载 php为系统的全局变量，即安装的php的bin地址，可以手动指定地址
    #   curl -sS https://getcomposer.org/installer | /usr/local/php/bin/php  
    
    #局部下载
    1.  curl -sS https://getcomposer.org/installer | php    
    2.  php -r "readfile('https://getcomposer.org/installer');" | php
    
    #下载成功后会获得 composer.phar ，这是 composer 的二进制文件。
    #这是一个 PHAR 包（PHP 的归档），这是 PHP 的归档格式可以帮助用户在命令行中执行一些操作
    
    #设置全局
    3.  sudo  mv composer.phar /usr/local/bin/composer
    
#### 使用
    composer init // 初始化默认信息(composer.json的信息)
    composer install //安装composer.json中的依赖文件 如果有composer.lock文件则获取它的安装信息
    composer update //依赖升级
    composer update vendor/package vendor/package2 //单独升级某几个包
    php composer update vendor/* // 批量升级
    composer require //申明依赖
    composer.phar require phpunit/phpunit:1.* // 申明phpunit依赖
    composer.phar search monolog // 搜索monolog
    composer.phar show //列出所有可用的软件包
    php composer.phar show monolog/monolog // 显示详细信息
    composer.phar depends  monolog/monolog // depends依赖检测,并列出相关依赖
    php composer.phar validate // 检测composer.json是否有效
    composer.phar status // 检测依赖包是否有修改
    composer.phar self-update // 自我更新到最新的版本
    composer config --list // 查看,更改配置
    composer.phar create-project doctrine/orm path 2.2.* // create-project创建项目
    composer.phar diagnose // 诊断问题
    composer.phar help install //获取帮助
    
    composer默认使用是当前系统环境变量中的php地址，如果想要换不同版本的可以使用如下命令:
    php7.3 composer --h
    [配置的php7.3的版本命令] [系统中的composer命令]
    =>原始命令为
    /usr/local/php/bin/php /usr/local/bin/composer
    
    require 'vendor/autoload.php'; //引入composer安装生成的文件,自动加载

#### Question
    composer中vendor入库:(https://docs.phpcomposer.com/faqs/should-i-commit-the-dependencies-in-my-vendor-directory.html)
        限制自己安装标记版本（无 dev 版本），这样你只会得到 zip 压缩的安装，并避免 git“子模块”出现的问题。
        使用 --prefer-dist 或在 config 选项中设置 preferred-install 为 dist。
        在每一个依赖安装后删除其下的 .git 文件夹，然后你就可以添加它们到你的 git repo 中。你可以运行 rm -rf vendor/**/.git 命令快捷的操作，但这意味着你在运行 composer update 命令前需要先删除磁盘中的依赖文件。
        新增一个 .gitignore 规则（vendor/.git）来忽略 vendor 下所有 .git 目录。这种方法不需要你在运行 composer update 命令前删除你磁盘中的依赖文件。
    为什么说“比较符”和“通配符”相结合的版本约束是?
        这是人们常犯的一个错误，定义了类似 >=2.* 或 >=1.1.* 的版本约束。
        >=2 表示资源包应该是 2.0.0 或以上版本。
        2.* 表示资源包版本应该介于 2.0.0 （含）和 3.0.0（不含）之间。
        Composer 将抛出一个错误，并告诉你这是无效的。想要确切的表达你意思，最简单的方法就是仅使用“比较符”和“通配符”其中的一种来定义约束。
        eg: "php":">=7.0.0" ,"packet": "~2.1.0"

#### composer.json
    {
        "name": "包名",
        "description": "描述",
        "keywords": "关键字,用于搜索",
        //引入的安装包
        "require": {
            "fzaninotto/faker": "^1.8"
        },
        //自动加载其他文件
        "autoload": {
            //psr-4文件加载,有命名空间 one
            "psr-4": {
                // 文件名\\: 文件夹路径(所有文件,需要命名空间)
                "bookLog\\": "bookLog",
                // lib文件夹下的main文件中的文件
                "lib\\main\\": "lib/main"
            },
            //psr-4 two
            "psr-4": { "Monolog\\": ["src/", "lib/"] }
            //可以用 classmap 生成支持支持自定义加载的不遵循 PSR-0/4 规范的类库
            "classmap": ["src/", "lib/", "Something.php"]
            //文件加载,无命名空间,作为函数库的载入方式（而非类库）
            "files": [
                "comFunction/function.php"
            ]
        },
        //配置信息 (详情 https://docs.phpcomposer.com/04-schema.html )
        "config": {
            "process-timeout": 1800,
            "preferred-install": "dist"
        },
        //使用自定义的包资源库
        "repositories": {
            "packagist": {
              "type": "composer",
              "url": "https://packagist.phpcomposer.com"
            }
        }
    }
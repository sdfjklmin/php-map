<?php
# 设计模式
# 参考地址
# http://www.ctolib.com/docs-php-design-patterns-c-7860.html

# 输出格式
echo "<pre>"; 

# 模式简码对应的文件
$mode = [
	'sin'=>'Singleton',  		# 单例模式
	'fac'=>'Factory',     		# 工厂模式
	'obs'=>'Observerable',      # 观察者模式
	'pro'=>'Proxy',				# 代理模式
] ;

# 对应文件前三个字母
$arg = 'sin' ; 	
# 判断模式简码是否存在
if (empty($mode[$arg]) && !isset($mode[$arg])) {
	 exit('not find design mode');
}

# 判断对应简码文件是否存在
if (!file_exists($mode[$arg].'.php')) {
	exit('no file match');	
}


# 引入文件
require_once './'.$mode[$arg] .'.php';

# 自动加载 php 自带加载类(设计模式中有些是接口实现)
/* function __autoload($class_name) {
     require_once $class_name . '.php';
 }*/
